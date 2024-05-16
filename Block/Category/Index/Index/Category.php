<?php

namespace Block\Category\Index\Index;

class Category extends \Block\Core\TextLine {
	
	protected $category = null;
	protected $categories = null;
	protected $categorySelected = null;


	public function __construct() {
		parent::__construct();
		$this->setTemplate('Category\Index\Index\category.php');
		$this->setCategory();
		$this->setCategories();
	}

	public function categorySelected($category) {
		if (!isset($_SESSION['currentCategory'])) {
			foreach ($category as $key => $value) {
				$selectedCategory = [$key => $value];
				break;
			}
			$this->categorySelected = $selectedCategory;
			return $this;
		}
		$categoryId = $_SESSION['currentCategory'];
		if (!$category[$categoryId]) {
			throw new \Exception("Invalid Request");
		}
		$this->categorySelected = [$categoryId => $category[$categoryId]];
	}

	public function getSelectedCategory() {
		return $this->categorySelected;
	}

	public function setCategory($category = null) {
		if (!$category) {
			$category = \Ccc::objectManager('\Model\Category');
		}
		$this->category = $category;
		return $this;
	}

	public function getCategories() {
		return $this->categories;
	}

	public function setCategories($categories = null) {
		
		try {
			if (is_null($categories)) {
			$categories = $this->getCategory()
				->getAdapter()
				->fetchPair(
					"SELECT `id`,`name` 
					FROM {$this->getCategory()->getTableName()} 
					WHERE `status` = '1' ;");
			$categoriesPaths = $this->getCategory()
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
		$this->categorySelected($categoriesPaths);
		return $this;
		} catch (\Exception $e) {
			
		}
	}

	public function getCategory() {
		return $this->category;
	}


}