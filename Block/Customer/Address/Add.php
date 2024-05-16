<?php

namespace Block\Customer\Address;

class Add extends \Block\Core\Template {

	public function __construct() {
		$this->setTemplate('Customer\Address\add.php');
		$this->setAddress();
	}

	public function setCustomerId($id) {
		$this->user = $id;
	}

	public function setAddress($address = null) {
		if (!$address) {
			$address = \Ccc::objectManager('\Model\Customer\Address');
		}
		$this->address = $address;
		return $this;
	}

	public function getAddress() {
		return $this->address;
	}
}