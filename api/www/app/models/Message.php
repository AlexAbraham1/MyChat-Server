<?php

class Message extends BaseModel implements MessageRepository {

	protected $guarded = ['id'];

	protected static $rules = [
		'text' => 'required'
	];

	public function getAllMessages($username = null) 
	{
		$messages = $this->with('user')->get();

		foreach ($messages as $message) {

			if ($username and $message->user->username !== $username) {

				throw new Illuminate\Database\Eloquent\ModelNotFoundException;

			} else {

				$message = $message->formatted();

			}

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

	public function user()
	{
		return $this->belongsTo('User');
	}
}