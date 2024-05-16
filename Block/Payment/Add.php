<?php

namespace Block\Payment;

class Add extends \Block\Core\Template {

	protected $method = null;

	public function __construct() {
		$this->setTemplate('Payment\add.php');
		$this->setMethod();
	}

	public function setMethod($method = null) {
		if (!$method) {
			$method = \Ccc::objectManager('\Model\Payment\Method');
		}
		$this->method = $method;
		return $this;
	}

	public function getMethod() {
		return $this->method;
	}
}