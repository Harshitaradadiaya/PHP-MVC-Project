<?php

 namespace Block\Core;

 class Message {
 	public function getMessage($key = null)
	{
		$message = \Ccc::objectManager('\Model\Core\Message');
		return $message->getMessage($key);
	}

	public function clearMessage()
	{
		$message = new \Model\Core\Message();
		$message->clearMessage();
	}
 }