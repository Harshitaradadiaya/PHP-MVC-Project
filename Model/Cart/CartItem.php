<?php


namespace Model\Cart;

class CartItem extends \Model\Core\Row {

	public function __construct() {
		parent::__construct();
		$this->setTableName('cart_item');
		$this->setPrimaryKey('id');
	}
}