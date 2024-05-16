<?php

namespace Model;

class Cart extends Core\Row {
	public function __construct() {
		parent::__construct();
		$this->setTableName('cart');
		$this->setPrimaryKey('id');
	}

}