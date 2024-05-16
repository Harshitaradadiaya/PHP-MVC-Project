<?php

namespace Model\Product;


class Image extends \Model\Core\Row {
	
	public function __construct() {
		parent::__construct();
		$this->setTableName('productimage');
		$this->setPrimaryKey('id');
	}

	public function resetExcludeMedia($productId) {
		$images = $this->fetchAll("SELECT `id` FROM `productimage` WHERE `productId` = {$productId}");
		return $images;
	} 
	
}