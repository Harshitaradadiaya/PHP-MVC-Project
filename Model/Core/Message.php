<?php

namespace Model\Core;


class Message {
	
	const SUCCESS = 'SUCCESS';
	const FAILURE = 'FAILURE';
	const NOTICE = 'NOTICE';

	public function getType() {
		return [
			self::SUCCESS => self::SUCCESS,
			self::FAILURE => self::FAILURE,
			self::NOTICE => self::NOTICE
		];
	}

	public function setMessage($key , $message) {
		$key = strtoupper($key);
		if (array_key_exists($key, $this->getType())) {
			$this->getSession()->message = [$key => $message];
		}
		return $this;
	}

	public function getMessage($key = null) {
		if (!$key) {
			return $this->getSession()->message;
		}
		$key = strtoupper($key);
		if (array_key_exists($key, $this->getType())) {
			return $this->getSession()->message[$key];
		}
	}

	public function clearMessage() {
		unset($this->getSession()->message);
	}

	public function getSession() {
		$session = new Session();
		return $session->setNamespace('admin');
	}
}