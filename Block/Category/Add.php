<?php

namespace Block\Category;

class Add extends \Block\Core\Template {
	protected $category = null;

	public function __construct() {
		$this->setTemplate('Category/add.php');
		$this->setCategory();
		$this->setCategories();
	}

	public function setCategory($category = null) {
		if (!$category) {
			$category = \Ccc::objectManager('\Model\Category');
		}
		$this->category = $category;
		return $this;
	}

	public function setCategories($categories = null) {
		
		try {
			if (is_null($categories)) {
			// echo $category->getTableName();
			$category = \Ccc::objectManager('\Model\Category');
			$categories = $category
				->getAdapter()
				->fetchPair(
					"SELECT `id`,`name` 
					FROM {$this->getCategory()->getTableName()} 
					WHERE `status` = '1' ;");
			$categoriesPaths = $category
				->getAdapter()
				->fetchPair(
					"SELECT `id`,`path` 
					FROM `category` 
					WHERE `status` = '1'
					ORDER BY `path` ASC ;");
		}
		
		foreach ($categoriesPaths as $key => &$value) {
			$value = explode('_', $value);
			foreach ($value as $k => &$val) {
				$val = $categories[$val];
			}
			$value = implode(' > ', $value);
		}
		$this->categories = $categoriesPaths;
		return $this;
		} catch (\Exception $e) {
			
		}
	}

	public function getCategories() {
		return $this->categories;
	}

	public function getCategory() {
		return $this->category;
	}

	public function setController($controller) {
		$this->controller = $controller;
		return $this;
	}

	public function getController() {
		return $this->controller;
	}
}