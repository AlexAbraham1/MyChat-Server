<?php

class Message extends Eloquent implements MessageRepository {

	public function getAllMessages() 
	{
		$messages = $this->get();

		foreach ($messages as $message) {
			$message = $message->formatted();
		}

		return $messages->toArray();
	}

	public function getMessageByID($id)
	{

		$message = $this->find($id);

		if ($message != null) {

			return $message->formatted();

		} else {

			throw new Exception("Sorry, Message ID Not Found"); die();
			
		}
	}

	public function addMessage($jsonobject)
	{
		$newMessage = new Message();

		if (is_array($jsonobject) AND count($jsonobject)) {

			if (isset($jsonobject['text']) && $text = $jsonobject['text']) {
				$newMessage->text = $text;
			} else {
				throw new Exception("'text' field is missing"); die();
			}

			$newMessage->save();

			return $newMessage->formatted();

		} else {
			throw new Exception('Invalid JSON'); die();
		}

	}

	public function removeMessage($id)
	{
		$message = $this->find($id);

		if ($message != null) {
			
			$message->delete();

		} else {
			throw new Exception("Sorry, that message ID does not exist."); die();
		}

		return $message;
	}

	public function formatted()
	{	
		return $this->toArray();
	}
}