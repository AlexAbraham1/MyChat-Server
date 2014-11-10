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
		$text = Input::get('text');

		try {
			$message['data'] = $this->message->addMessage($text);
		} catch (Exception $e) {

			$issue = $e->getMessage();
			$error = array('message'=>$issue);
			return $this->error($error);

		}
		
		if (Request::ajax()) {
			return Response::json($message);
		} else {
			return Redirect::route('me')
                ->with('flash_notice', 'Your message was successfully added');
		}
			
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
