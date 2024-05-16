<?php

namespace Model\Core;

class Row {
    protected $tableName = null;
    protected $primaryKey = null;
    protected $rowChanged = false;
    protected $data = [];
    protected $adapter = null;
    
    public function __construct($tableName = null, $primaryKey = null) {
        $this->setPrimaryKey($primaryKey);
        $this->setTableName($tableName);
        $this->setAdapter();
        return $this;
    }
 
    public function setTableName($tableName) {
        $this->tableName = $tableName;
        return $this;
    }

    public function getTableName() {
        return $this->tableName;
    }

    public function setPrimaryKey($primaryKey) {
        $this->primaryKey = $primaryKey;
        return $this;
    }

    public function getPrimaryKey() {
        return $this->primaryKey;
    }

    public function setRowChanged($rowChanged) {
        $this->rowChanged = $rowChanged;
        return $this;
    }

    public function getRowChanged() {
        return $this->rowChanged;
    }

    public function setData($data = null) {
        if (!$data) {
            $this->data = [];
            return $this;
        }
        if(is_array($data)) {
            $this->data = array_merge($this->data,$data);
        } else {
            $this->data = $data;
        }
        return $this;
    }

    public function getData() {
        return $this->data;
    }

    public function setAdapter($adapter = null) {
        if (!is_null($adapter)) {
            $this->adapter = $adapter;
            return $this;
        }
        $this->adapter = new Adapter();
        return $this;
    }

    public function getAdapter() {
        return $this->adapter;
    }

    function validateDate($date, $format = 'Y-m-d H:i:s')
    {
        $d = \DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }

    public function __set($name, $value) {
        $this->data[$name] = $value;
        $this->setRowChanged(true);
        return $this;
    }

    public function __get($name) {
        if (!array_key_exists($name, $this->getData())) {
            return null;
        }
        return $this->getData()[$name] ;
    }

    public function unsetData($key = null) {
        if (!$key) {
            $this->data = [];
        }
        if (!array_key_exists($key, $this->getData)) {
            throw new \Exception("Invalid Request For Unset Data");
        }
        unset($this->data[$key]);
        return $this;
    }

    public function insert() {
        $column = '`'.implode("`, `",array_keys($this->getData())).'`';
        $value = '\''.implode("', '",$this->getData()).'\'';
        $query = "INSERT INTO `{$this->getTableName()}`({$column}) VALUES ({$value})";
        $this->getAdapter()->query($query);
        $this->load($this->getAdapter()->getConnect()->insert_id);
        return $this;
    }

    public function update() {
        $id = $this->__get('id');
        if (array_key_exists($this->getPrimaryKey(), $this->getData())) {
            unset($this->data[$this->getPrimaryKey()]);
        }
        $query = 'UPDATE '.$this->getTableName().' SET ';
        foreach ($this->getData() as $key => $value) {
            $query .= "`{$key}` = '$value',";
        }
        $query = substr($query, 0 , -1);
        $query .= ' WHERE '.$this->getPrimaryKey() .' = '.$id;
        $this->getAdapter()->query($query);
        $this->load($id);
        return $this;
    }

    public function delete($id = null) {
        if (!$id) {
            if (!is_array($this->__get($this->getPrimaryKey()))) {
                $id = $this->__get($this->getPrimaryKey());
                $query = "DELETE FROM  `{$this->getTableName()}` WHERE `{$this->getPrimaryKey()}` = {$id}";
            } else {
                $id = implode(',', $this->__get($this->getPrimaryKey()));
                $query = "DELETE FROM  `{$this->getTableName()}` WHERE `{$this->getPrimaryKey()}` IN ({$id})";
            }
        } else {
            $query = "DELETE FROM `{$this->getTableName()}` WHERE ".$this->getPrimaryKey() .' = '.$id;
        }
        $this->getAdapter()->query($query);
        return $this;
    }

    public function load($id) {
        $query = "SELECT * 
                  FROM `{$this->getTableName()}` 
                  WHERE ".$this->getPrimaryKey().'='.$id;
        $result = $this->getAdapter()->query($query);
        $result = mysqli_fetch_assoc($result);
        $this->setData($result);
        $this->setRowChanged(false);
        return $this;
    }

    public function save() {
        if (!array_key_exists($this->getPrimaryKey(), $this->getData())) {
            return $this->insert();
        }
        return $this->update();
    }

    public function fetchAll($query = null) {
        if ($query === null) {
            $query = "SELECT * 
                      FROM `{$this->getTableName()}`";
        }

        $rows = $this->getAdapter()->fetchAll($query);

        foreach($rows as $key => &$row){
            $row = (new $this)->setData($row);
        }

        $this->setData($rows);
        $this->setRowChanged(false);
        return $rows;
    }

    public function fetchOne($query = null,$id = null) {
        if ($query == null) {
            $column = '`'.implode("`, `",array_keys($this->data)).'`';
            $query = "SELECT {$column} 
                      FROM `{$this->getTableName()}` 
                      WHERE ".$this->getPrimaryKey()." = $id";
        }

        $row = mysqli_fetch_assoc($this->getAdapter()->query($query));
        $this->data = $row;
        return $row;
    }

}

?>