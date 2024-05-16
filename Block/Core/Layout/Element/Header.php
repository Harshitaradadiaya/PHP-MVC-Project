<?php

namespace Block\Core\Layout\Element;

class Header extends \Block\Core\Template {
	
	public function __construct() {
		$this->setTemplate('Core/Layout/Element/header.php');
	}
}