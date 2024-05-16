<?php

namespace Block\Product;

class Add extends \Block\Core\Template {
	protected $product = null;

	public function __construct() {
		$this->setTemplate('Product/add.php');
		$this->setProduct();
		$this->setCategories();
	}

	public function setProduct($product = null) {
		if (is_null($product)) {
			$product = \Ccc::objectManager('\Model\Product');
		}
		$this->product = $product;
		return $this;
	}

	public function getProduct() {
		return $this->product;
	}

	public function setCategories($categories = null) {
		if (is_null($categories)) {
			$category = \Ccc::objectManager('\Model\Category');
			$categories = $category->fetchAll("SELECT `id`,`name` 
											   FROM {$category->getTableName()} 
											   WHERE `status` = '1';");
		}
		$this->categories = $categories;
		return $this;
	}

	public function getSelectedCategories() {
		if (!$id = $this->getProduct()->__get('id')) {
			return null;
		}
		$category = \Ccc::objectManager('\Model\Category');
		$query = "SELECT `categoryId` 
				  FROM `categoryproduct` 
				  WHERE `productId` = ".$id;
		$categories = $category->fetchAll($query);
		return $categories;
	}

	public function getCategories() {
		return $this->categories;
	}

	public function setController($controller){
		$this->controller = $controller;
		return $this;
	}

	public function getController(){
		return $this->controller;
	}
}