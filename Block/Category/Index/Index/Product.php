<?php

namespace Block\Category\Index\Index;

class Product extends \Block\Core\TextLine {
	
	protected $product = null;
	protected $products = null;

	public function __construct() {
		parent::__construct();
		$this->setTemplate('Category\Index\Index\product.php');
		$this->setProduct();
		$this->setProducts();
	}

	public function setProduct($product = null) {
		if (!$product) {
			$product = \Ccc::objectManager('\Model\Product');
		}
		$this->product = $product;
		return $this;
	}

	public function getProduct() {
		return $this->product;
	}

	public function setProducts ($categoryId = null) {
		if (!$categoryId) {
			$categoryId = 17;
		}
		$products = $this->getProduct()->fetchAll('SELECT `id`, `name`,`price` FROM `product` AS p , (SELECT `productId` FROM `categoryproduct` WHERE `categoryId` = '.$categoryId.') AS T WHERE `id` = T.`productId`');
		$this->products = $products;
		return $this;
	}

	public function getProducts() {
		return $this->products;
	}
}