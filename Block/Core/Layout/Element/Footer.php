<?php

namespace Block\Core\Layout\Element;

class Footer extends \Block\Core\Template {
	
	public function __construct() {
		$this->setTemplate('Core/Layout/Element/footer.php');
	}
}