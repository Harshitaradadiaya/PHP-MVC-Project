<?php

namespace Block\Customer\Address;

class Grid extends \Block\Core\Template {

	protected $address = null;

	public function __construct() {
		$this->setTemplate('Customer\Address\view.php');
	}

	public function setAddress($address = null, $id = null) {
		
		if (!$address) {
			$address = \Ccc::objectManager('\Model\Customer\Address');
		}

		if ($id != null) {
			$this->user = $id;
			$address = $address->fetchAll("SELECT * FROM `customer_address` WHERE `user_id` = {$id}");
		}

		$this->address = $address;
		return $this;
	}

	public function getAddress() {
		return $this->address;
	}
}