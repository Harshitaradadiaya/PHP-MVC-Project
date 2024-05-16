<?php

namespace Model\Core;

class Url {

	public function getRequest() {
		return new Request();
	}

	public function getBaseUrl($url = null) {
		// echo "$url<br>";
		// die;
		return \Ccc::getBaseUrl($url);
	}

	public function getUrl ($action = null , $controller = null , $params = []) {
		$parameters = [
			'c' => null,
			'a' => null
		];

		if (is_null($controller)) {
			$parameters['c'] = $this->getRequest()->getControllerName();
		} else {
			$parameters['c'] = $controller;
		}

		if (is_null($action)) {
			$parameters['a'] = $this->getRequest()->getActionName();
		} else {
			$parameters['a'] = $action;
		}

		if (is_array($params)) {
			$parameters = array_merge($parameters, $params);
		}

		$parameters = array_filter($parameters);
		$queryString = http_build_query($parameters);
		return $this->getBaseUrl("?$queryString");
	}
}