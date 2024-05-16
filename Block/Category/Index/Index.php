<?php

namespace Block\Category\Index;

class Index extends \Block\Core\Template {

	public function __construct() {
		parent::__construct();
		$this->setTemplate('Category\Index\index.php');
		$this->addChild("\Block\Category\Index\Index\Category",'category');	
		$this->addChild("\Block\Category\Index\Index\Product",'product');	
		$this->addChild("\Block\Cart\Cart",'cart');	
		$this->addChild("\Block\Category\Index\Index\Customer",'customer');	
	}
}