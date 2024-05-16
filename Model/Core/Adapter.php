<?php

namespace Model\Core;

class Adapter {

    protected $config = [
        'host' => 'localhost',
        'dbname' => 'project',
        'user' => 'root',
        'password' => '1234'
    ];

    protected $connect;

    protected $query;

    public function setConfig($config) {
        if (!is_array($config)) {
            throw new Exception("Config Must Be Array");
        }
        $this->config = array_merge($this->config, $config);
        return $this;
    }

    public function getConfig() {
        return $this->config;
    }
    
    public function setConnect($connect) {
        $this->connect = $connect;
        return $this;
    }
    public function getConnect() {
        return $this->connect;
    }


    public function connect() {
        $connect = new \mysqli($this->config['host'], $this->config['user'], $this->config['password'], $this->config['dbname']);
        $this->setConnect($connect);
        return $this;
    }

    public function setQuery($query) {
        $this->query = $query;
        return $this; 
    }

    public function getQuery() {
        return $this->query;
    }

    public function isConnect() {
        if (!$this->getConnect()) {
            return false;
        }
        return true;
    }

    public function query($query) {
        if (!$this->isConnect()) {
            $this->connect();
        }
        $this->setQuery($query);
        return $this->getConnect()->query($this->getQuery());
    }

    public function insert($query) {
        $result = $this->query($query);
        if (!$result) {
            return false;
        }
        return true;
    }

    public function update($query) {
        $result = $this->query($query);
        if (!$result) {
            return false;
        }
        return true;
    }

    public function delete($query) {
        $result = $this->query($query);
        if (!$result) {
            return false;
        }
        return true;
    }

    public function select($query) {
        $result = $this->query($query);
        if (!$result) {
            return $result;
        }
        return true;
    }

    public function fetchAll($result) {

        $result = $this->query($result);
        if (!$result) {
            return null;
        }
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function fetchRow($query) {
        $result = $this->query($query);
        $result = mysqli_fetch_row($result);
        return $result;
    }

    public function fetchOne($result) {
        return $result->num_rows;
    }

    public function fetchPair($query) {
        $result = $this->query($query);
        $ex = mysqli_fetch_assoc($result);
        $column1 = array_keys($ex)[0];
        $column2 = array_keys($ex)[1];
        $arr = [];
        $result = $this->query($query);

        while ($res = mysqli_fetch_assoc($result)) {
            array_push($arr, $res);
        }

        if (!isset(array_keys($ex)[1])) {
            $temp = array_column($arr, $column1);
            $result = array_fill_keys($temp, "");
            return $result;
        }

        $result = array_column($arr, $column2, $column1);
        return $result;

    }
}


?>