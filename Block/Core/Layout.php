<?php

namespace Block\Core;

class Layout extends Template {
	public function __construct() {
		$this->setTemplate('Core/Layout/one-column.php');
		$this->addChild('\Block\Core\Layout\Element\Header', 'header');
		$this->addChild('\Block\Core\Layout\Element\Content', 'content');
		$this->addChild('\Block\Core\Layout\Element\Footer', 'footer');
		// $this->addChild('\Block\Core\Layout\Element\left', 'left');
		// $this->addChild('\Block\Core\Layout\Element\right', 'right');
	}

	public function createBlock($class) {
		$class = \Ccc::objectManager($class);
		$class->setLayout($this);
		return $class;
	}
}