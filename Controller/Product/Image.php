<?php

namespace Controller\Product;

class Image extends \Controller\Core\Base {
	public function mediaGalleryAction() {
		try {
			if (!$id = $this->getRequest()->getRequest('i')) {
				throw new \Exception("Invalid Id.");
			}

			$product = \Ccc::objectManager('\Model\Product');
			$product = $product->load($id);

			if (!$product) {
				throw new \Exception("No Record Found With This Id");
			}

			$mediaGallery = \Ccc::objectManager('\Block\Product\MediaGallery');
			$mediaGallery->setProduct($product);

			$image = new \Model\Product\Image();
			$img = $image->fetchAll(
				"SELECT * 
				FROM `productimage` 
				WHERE `productId` = {$id}");
			

			$mediaGallery->setProductImages($img);
			// echo "string";
			// print_r($mediaGallery);
			// die;
			$mediaGallery->toHtml();
			$this->responce('c' , $mediaGallery);

		} catch (\Exception $e) {
			echo $e->getMessage();
			// $this->getMessageModel->setMessage('failure', $e->getMessage);
		}
	}

	public function changeMediaAction() {
		try {
			if (!$this->getRequest()->isPost()) {
				throw new Exception("Invalid Request");
			}

			$product = \Ccc::objectManager('\Model\Product');

			if (!$id = $this->getRequest()->getRequest('i')) {
				throw new Exception("Invalid Id");
			}

			if (!$product = $product->load($id)) {
				throw new Exception("Data Not Found From Id");
			}

			$product->setData($this->getRequest()->getPost('ImageStatus'));
			$product->save();
			$image = \Ccc::objectManager('\Model\Product\Image');
			echo '<pre>';
			$resetImages = $image->resetExcludeMedia($id);
			foreach ($resetImages as $key => &$img) {
				$img->setTableName($image->getTableName());
				$img->setPrimaryKey($image->getPrimaryKey());
				$img->load($img->id);
				$img->excludeImageStatus = 0;
				$img->save();
			}
			$excludeMedia = $this->getRequest()->getPost('excludeStatus');
			$image->setData();
			foreach ($excludeMedia as $key => $value) {
				$image->load($value);
				$image->excludeImageStatus = 1;
				$image->save();
			}
			$this->redirect('view', 'product');
		} catch (\Exception $e) {
			echo $e->getMessage();	
		}
	}

	public function saveImageAction() {
		try {
			if (!$this->getRequest()->isPost()) {
				throw new \Exception("Invalid Request");
			}

			if (!$id = $this->getRequest()->getRequest('i')) {
				throw new \Exception("Invalid Id");
			}

			$product = \Ccc::objectManager('\Model\Product');

			if (!$product->load($id)) {
				throw new \Exception("Invalid Data From Id");
			}

			if (!array_key_exists('image', $_FILES)) {
				throw new \Exception("Image Not Found");
			}

			$image = \Ccc::objectManager('\Model\Product\Image');
			$image->productId = $product->id;
			$image->name = $product->uploadImage($_FILES['image']);
			$image->save();
			$this->redirect('mediaGallery', 'product_image', ['i' => $product->id]);
		} catch (\Exception $e) {
			echo $e->getMessage();
		}
	}

	public function deleteImageAction() {
		try {
			if (!$id = $this->getRequest()->getRequest('i')) {
				throw new \Exception("Invalid Request");
			}

			$image = \Ccc::objectManager('\Model\Product\Image');
			$image = $image->load($id);

			if (!$image) {
				throw new \Exception("Image Not Found");
			}
			$image->delete();
			$this->redirect('mediaGallery', 'product_image', ['i' => $this->getRequest()->getRequest('id')]); 
		} catch (\Exception $e) {
			
		}
	}
}