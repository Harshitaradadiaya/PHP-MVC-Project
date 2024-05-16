<?php

namespace Model;
use Model\Core\Row;

class Customer extends Row {

    public function __construct($tableName = null , $primaryKey = null)
    {
        parent::__construct();
        $this->setTableName('customer');
        $this->setPrimaryKey('id');
    }

}