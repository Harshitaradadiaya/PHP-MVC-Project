<?php

namespace Model;
use Model\Core\Row;

class CategoryProduct extends Row {
	
	public function __construct()
	{
		parent::__construct();
		$this->setTableName('categoryproduct');
		$this->setPrimaryKey('id'); 
	}

	public function save () {
		if (array_key_exists($this->getPrimaryKey(), $this->getData())) {
			unset($this->data[$this->getPrimaryKey()]);
		}
		parent::save();
	}

	public function deleteCategoryProduct($productId) {
		$query = 'DELETE FROM `categoryproduct` WHERE `productId` = '.$productId;
		$this->getAdapter()->query($query);
        return $this;
	}
}