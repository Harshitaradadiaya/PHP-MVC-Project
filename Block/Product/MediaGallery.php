<?php

namespace Block\Product;

class MediaGallery extends \Block\Core\Template {
	protected $product = null;
	function __construct()
	{
		$this->setTemplate('Product/mediaGallery.php');
		$this->setProduct();
		$this->setProductImages();
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

	public function setProductImages($productImages = null) {
		if (!$productImages) {
			$productImages = \Ccc::objectManager('\Model\Product\Image');
		}
		$this->productImages = $productImages;
		return $this;
	}

	public function getProductImages() {
		return $this->productImages;
	}

}