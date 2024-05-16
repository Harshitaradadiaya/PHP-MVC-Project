<?php

namespace Block\Core;

class TextLine {
	protected $template;
	protected $layout = null;
	protected $children = [];

	public function __construct() {
		$this->setTemplate('Core\textline.php');
	}

	public function setTemplate($template) {
		$this->template = $template;
		return $this;
	}

	public function getTemplate() {
		return $this->template;
	}

	public function toHtml() {
		ob_start();
		require 'View' . DIRECTORY_SEPARATOR . $this->getTemplate();
		$content = ob_get_clean();
		return $content;
	}

	public function setLayout($layout = null) {
		if (!$layout) {
			$layout = \Ccc::objectManager('\Block\Core\layout');
		}
		$this->layout = $layout;
		return $this;
 	}

 	public function getLayout() {
 		return $this->layout;
 	}

	public function getUrl($action = null, $controller = null , $params = []) {
		$url = \Ccc::objectManager('\Model\Core\Url');
		return $url->getUrl($action, $controller, $params);
	}

	public function addChild($class, $key) {
		if (!is_object($class)) {
			$class = \Ccc::objectManager($class);
		}
		$this->children[$key] = $class;
		return $this;
	}

	public function getChild($key) {
		if (!array_key_exists($key, $this->children)) {
			return null;
		}
		return $this->children[$key];
	}

	public function getChildHtml($class) {
		$class = \Ccc::objectManager($class);
		return $class->toHtml();
	}

	public function getAllChild() {
		return $this->children;
	}

	public function getMessage($key = null) {
		$message = \Ccc::objectManager('\Block\Core\Message');
		$msg = $message->getMessage($key);
		$message->clearMessage();
		return $msg;
	}
}