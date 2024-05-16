<?php

namespace Model\Customer;

class Address extends \Model\Core\Row {

	public function __construct() {
		parent::__construct();
		$this->setTableName('customer_address');
		$this->setPrimaryKey('id');
	}
}