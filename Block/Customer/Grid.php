<?php

namespace Block\Customer;

class Grid extends \Block\Core\Template {
	
	protected $customers = null;

	public function __construct() {
		$this->setTemplate('Customer\view.php');
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