<?php 

namespace Controller\Category;

class Index extends \Controller\Core\Base {

	public function indexAction() {
		
		$indexBlock = $this->getLayout()
			->createBlock('\Block\Category\Index\Index');
		if (isset($_SESSION['currentCategory'])) {
			$id = $_SESSION['currentCategory'];
			$indexBlock->getChild('index');
			$product = $indexBlock->getChild('product');
			$product->setProducts($id);
		}
		$indexBlock = $this->_addContent($indexBlock, 'index');
		// echo "<pre>";
		// print_r($indexBlock);
		// die();
		$this->renderLayout();
	}

	public function productAction() {
		if (!$id = $this->getRequest()->getRequest('i')) {
			throw new \Exception("Invalid Request");
		}
		$_SESSION['currentCategory'] = $id;
		$indexBlock = $this->getLayout()
			->createBlock('\Block\Category\Index\Index');
		$indexBlock->getChild('index');
		$product = $indexBlock->getChild('product');
		$product->setProducts($id);
		$indexBlock = $indexBlock->toHtml();
		$this->response(null, $indexBlock);
	}
}