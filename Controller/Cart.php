<?php

namespace Controller;

class Cart extends Core\Base {
	public function addToCartAction() {
		if (!$productId = $this->getRequest()->getRequest('i')) {
			throw new \Exception("Invalid Request");
		}
		
		$cart =\Ccc::objectManager('Block\Cart\Cart'); 

		if (!isset($_SESSION['customerId'])) {
			$_SESSION['customerId'] = 3;
		}

		if(!$cart->checkCustomerExists()) {
			$cart->createCustomerCart();
		}

		if (!$cart->checkItemIntoCart($productId)) {
			$cart->addItemToCart($productId);
		}
		
		$this->_addContent($cart, 'cart');
		$this->renderLayout();
		// echo $cart->toHtml();
	}
}