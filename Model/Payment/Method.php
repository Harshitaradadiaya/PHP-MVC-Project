<?php

namespace Model\Payment;
use Model\Core\Row;

class Method extends Row {
	
	const STATUS_ENABLE = 1;
    const STATUS_DISABLE = 0;
    const STATUS_ENABLE_LABEL = "Enable";           
    const STATUS_DISABLE_LABEL = "Disable";
    protected $status = [
        self::STATUS_ENABLE => self::STATUS_ENABLE_LABEL,
        self::STATUS_DISABLE => self::STATUS_DISABLE_LABEL
    ];


    public function __construct(){
        parent::__construct();
        $this->setTableName('payment_method');
        $this->setPrimaryKey('id');
    }

    public function getStatusOptions(){
        return $this->status; 
    }
}