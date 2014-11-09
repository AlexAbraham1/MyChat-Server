<?php

class Message extends Eloquent implements MessageRepository {

	protected $guarded = array('id');

	public function getAllMessages($username = null) 
	{
		$messages = Auth::user()->messages;

		foreach ($messages as $message) {

			$message = $message->formatted();
		
		}

		return $messages->toArray();
	}

	public function getMessageByID($id, $username = null)
	{

		$message = $this->with('user')->find($id);

		if ($username and $message->user->username !== $username) {

			throw new Illuminate\Database\Eloquent\ModelNotFoundException;

		} else {

			return $message->formatted();

		}
	}

	public function addMessage($jsonobject)
	{

		if (Auth::check()) {


			$user = User::find(Auth::user()->id);

			$newMessage = new Message();

			if (is_array($jsonobject) AND count($jsonobject)) {

				if (isset($jsonobject['text']) && $text = $jsonobject['text']) {
					$newMessage->text = $text;
				} else {
					throw new Exception("'text' field is missing"); die();
				}

				$newMessage->save();

				$user->messages()->save($newMessage);

				return $newMessage->formatted();

			} else {
				throw new Exception('Invalid JSON'); die();
			}

		} else {
			throw new Exception('User is not logged in!'); die();
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

	public function user()
	{
		return $this->belongsTo('User');
	}
}