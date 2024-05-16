<?php

namespace Block\Customer;

class Add extends \Block\Core\Template {

	protected $customer = null;

	public function __construct() {
		$this->setTemplate('Customer\add.php');
		$this->setCustomer();
	}

	public function setCustomer($customer = null) {
		if (!$customer) {
			$customer = \Ccc::objectManager('\Model\Customer');
		}
		$this->customer = $customer;
		return $this;
	}

	public function getCustomer() {
		return $this->customer;
	}
}