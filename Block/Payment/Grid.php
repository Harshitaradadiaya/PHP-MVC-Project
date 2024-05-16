<?php

namespace Block\Payment;

class Grid extends \Block\Core\Template {
	
	protected $methods = null;

	public function __construct() {
		$this->setTemplate('Payment\view.php');
		$this->setMethods();
	}

	public function setMethods($method = null) {
		if (!$method) {
			$method = \Ccc::objectManager('\Model\Payment\Method');
			$methods = $method->fetchAll();
		}
		$this->methods = $methods;
	}

	public function getMethods() {
		return $this->methods;
	}

	public function setController($controller) {
		$this->controller = $controller;
		return $this;
	}

	public function getController() {
		return $this->controller;
	}
}