<?php

namespace Block\Core\Layout\Element;

class Content extends \Block\Core\Template {
	
	public function __construct() {
		$this->setTemplate('Core/Layout/Element/content.php');
	}
}