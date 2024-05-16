<?php

namespace Block\Category;

class Grid extends \Block\Core\Template {
	protected $categories = null;

	public function __construct() {
		$this->setTemplate('Category/view.php');
		$this->setCategories();
	}

	public function setCategories($categories = null) {
		if (!$categories) {
			$category = \Ccc::objectManager('\Model\Category');
			$categories = $category->fetchAll();
		}
		$this->categories = $categories;
	}

	public function getCategories() {
		return $this->categories;
	}

	public function getController() {
		return $this->controller;
	}

	public function setController($controller) {
		$this->controller = $controller;
		return $this;
	}
}