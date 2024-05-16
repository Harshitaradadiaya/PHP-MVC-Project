<?php

namespace Controller\Core;

use Model\Core\Request;

class Base {
	
	protected $request = null;
	protected $messageModel = null;
	protected $layout = null;
	protected $response = null;

	function __construct()
	{
		$this->setRequest();
		$this->setLayout();
	}

	public function setLayout($layout = null) {
		if (!$layout) {
			$layout = \Ccc::objectManager('\Block\Core\Layout');
		}
		$this->layout = $layout;
		return $this;
	}

	public function getLayout() {
		return $this->layout;
	}

	public function setRequest($request = null) {
		if (is_null($request)) {
			$request = \Ccc::objectManager('\Model\Core\Request');
		}
		$this->request = $request;
		return $this;
	}

	public function getRequest() {
		return $this->request;
	}

	public function renderLayout() {
		echo $this->getLayout()->toHtml();
	}

	public function redirect ($action, $controller = null, $params = []) {
		$url = \Ccc::objectManager('\Model\Core\Url');
		$path = $url->getUrl($action, $controller, $params);
		header("Location:{$path}");
	}

	public function getMessageModel ($messageModel = null) {
		if (is_null($this->messageModel)) {
			$messageModel = \Ccc::objectManager('\Model\Core\Message');
		}
		return $this->messageModel = $messageModel;    
	}

	public function getResponse() {
		if ($this->response == null) {
			$this->setResponse();
		}
		return $this->response;
	}

	public function setResponse($response = null) {
		if (!$response) {
			$response = \Ccc::objectManager('\Model\Core\Response');
		}
		$this->response = $response;
		return $this;
	}

	public function _addContent($block , $key) {
		$this->getLayout()->getChild('content')->addChild($block, $key);
		return $this;
	}

	public function responce($class , $setClass = null) {
		if (!$setClass) {
			$html = $this->getLayout()
				->createBlock($class)
				->toHtml();
		} else {
			$html = $setClass;
		}
		$responseData = [
			'responceType' => 'success',
			'elements' => [
				[
					'identifier' => 'content',
					'html' => $html
				]
			]
		];

		$response = json_encode($responseData);
		$this->getResponse()->setBody($response);
	}

	public function response($class , $setClass = null) {
		if (!$setClass) {
			$html = $this->getLayout()
				->createBlock($class)
				->toHtml();
		} else {
			$html = $setClass;
		}
		$responseData = [
			'responceType' => 'success',
			'elements' => [
				[
					'identifier' => 'content',
					'html' => $html
				]
			]
		];

		$response = json_encode($responseData);
		$this->getResponse()->setBody($response);
	}
}