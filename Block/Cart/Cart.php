<?php

namespace Block\Cart;

class Cart extends \Block\Core\Template {
	
	protected $cart = null;

	public function __construct() {
		$this->setTemplate('Cart\view.php');
		$this->setCart();
	}

	public function setCart($cart = null) {
		if (!$cart) {
			$cart = \Ccc::objectManager('Model\Cart');
		}
		$this->cart = $cart;
		return $this;
	}

	public function getCart() {
		return $this->cart;
	}

	public function getCartItems() {
		$cart = $this->getCart();
		$cartItem = \Ccc::objectManager('Model\Cart\CartItem');
		$product = \Ccc::objectManager('Model\Product');
		$cart->fetchOne("SELECT `id`, `customerId` FROM `cart` WHERE `customerId` = {$_SESSION['customerId']}");
		$cartItems = $cartItem->fetchAll("SELECT * FROM `cart_item` WHERE `cartId` = {$cart->id}");
		$cartProduct = [];
		$temp = [];
		foreach ($cartItems as $key => $cartItem) {
			$temp = $cartItem->getData();
			$itemDetail = $product->load($cartItem->productId)->getData();
			foreach ($itemDetail as $key => $value) {
				if ($key == 'name') {
					$temp['productName'] = $value;
				} 
				if ($key == 'price') {
					$temp['productPrice'] = $value;	
				}
			}
			$temp['total'] = $temp['productPrice'] * $temp['quantity'];
			array_push($cartProduct, $temp);
		}
		return $cartProduct;
	}

	public function addItemToCart($itemId) {
		$cart = $this->getCart();
		$product = \Ccc::objectManager('Model\Product');
		$cartItem = \Ccc::objectManager('Model\Cart\CartItem');
		$cart->fetchOne("SELECT `id`, `customerId` FROM `cart` WHERE `customerId` = {$_SESSION['customerId']}");
		$product->load($itemId);
		$cartItem->cartId = $cart->id;
		$cartItem->productId = $itemId;
		$cartItem->quantity = 1;
		$cartItem->sku = $product->sku;
		$cartItem->insert();
	}

	public function checkItemIntoCart($itemId) {
		$cartItem = \Ccc::objectManager('Model\Cart\CartItem');
		$result = $cartItem->fetchOne("SELECT `id`, `cartId`, `productId` FROM `cart_item` WHERE `productId` = {$itemId}");
		if (!empty($result)) {
			return true;
		}
		return false;
	}

	public function checkCustomerExists() {
		$cart = $this->getCart();
		$result = $cart->fetchAll("SELECT * FROM `cart` WHERE `customerId` = {$_SESSION['customerId']}");
		if (!empty($result)) {
			return true;
		}
		return false;
	}

	public function createCustomerCart() {
		$cart = $this->getCart();
		$cart->createdAt = date('Y-m-d H:i:s');
		$cart->customerId = $_SESSION['customerId'];
		$cart->insert();
		return true;
	}
}