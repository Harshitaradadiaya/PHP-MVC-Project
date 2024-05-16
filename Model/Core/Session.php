<?php

namespace Model\Core;

class Session {
	protected $namespace = null;

	public function setNamespace ($namespace) {
		$this->namespace = $namespace;
		return $this;
	}

	public function getNamespace () {
		return $this->namespace;
	}

	public function __set($key, $value) {
		$_SESSION[$this->getNamespace()][$key] = $value;
	}

	public function __get($key) {
		$_SESSION[$this->getNamespace()] = ($_SESSION[$this->getNamespace()] != null) ? $_SESSION[$this->getNamespace()] : [];
		if (!array_key_exists($key, $_SESSION[$this->getNamespace()])) {
			return null;
		}
		return $_SESSION[$this->getNamespace()][$key];
	}

	public function __unset($key) {
		unset($_SESSION[$this->getNamespace()][$key]);
	}
}