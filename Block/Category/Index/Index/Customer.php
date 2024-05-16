<?php

namespace Block\Category\Index\Index;

class Customer extends \Block\Core\TextLine {

	protected $customers = null;

	public function __construct() {
		$this->setTemplate('Category\Index\Index\customer.php');
		$this->setCustomers();
	}

	public function setCustomers($customers = null) {
		if (!$customers) {
			$customer = \Ccc::objectManager('\Model\Customer');
			$customers = $customer->fetchAll();
		}
		$this->customers = $customers;
		return $this;
	}

	public function getCustomers() {
		return $this->customers;
	}
}