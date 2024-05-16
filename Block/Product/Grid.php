<?php

namespace Block\Product;

class Grid extends \Block\Core\Template{

	protected $products = null;

	public function __construct()
	{
		$this->setTemplate('Product/view.php');
		$this->setProducts();
	}

	public function setProducts($product = null){
		if (is_null($product)) {
			$products = \Ccc::objectManager('\Model\Product');
			$products = $products->fetchAll();
		}
		$this->products = $products;
		return $this;
	}

	public function getProducts(){
		return $this->products;		
	}

	public function setController($controller){
		$this->controller = $controller;
		return $this;
	}

	public function getController(){
		return $this->controller;
	}
}