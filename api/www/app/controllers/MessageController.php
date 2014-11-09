<?php

class MessageController extends BaseController {

	public function __construct(MessageRepository $message)
	{
		$this->message = $message;
	}

	//GET Methods
	public function getAllMessages()
	{
		try {
			$messages['data'] = $this->message->getAllMessages();
		} catch (Exception $e) {
			
			$issue = $e->getMessage();
			$error = array('message'=>$issue);
			return $this->error($error);

		}

		return Response::json($messages);
	}

	public function getMessageById($id)
	{
		$message['data'] = $this->message->getMessageByID($id);
		return Response::json($message);
	}


	//POST Methods

	public function addMessage()
	{
		$json = Input::get();

		try {
			$message['data'] = $this->message->addMessage($json);
		} catch (Exception $e) {

			$issue = $e->getMessage();
			$error = array('message'=>$issue);
			return $this->error($error);

		}
		
		return Response::json($message);	
	}

	//DELETE Methods

	public function removeMessage($id)
	{
		try {

			$message['data'] = $this->message->removeMessage($id);

		} catch (Exception $e) {

			$issue = $e->getMessage();
			$error = array('message'=>$issue);
			return $this->error($error);
			
		}

		return Response::json($message);
	}

}
