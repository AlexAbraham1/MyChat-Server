<?php

class HomeController extends BaseController {

	//GET METHODS

	public function showHome()
	{
		return View::make('home');
	}

	public function showLogin()
	{
		return View::make('login');
	}

	public function showNewUser()
	{
		return View::make('create_user');
	}

	public function showProfile()
	{
		return View::make('profile');
	}

	public function logout()
	{
		Auth::logout();

    	return Redirect::route('home')
    		->with('flash_notice', 'You are successfully logged out.');
	}





	//POST METHODS

	public function login()
	{
		$user = array(
            'username' => Input::get('username'),
            'password' => Input::get('password')
        );
        
        if (Auth::attempt($user)) {
            return Redirect::route('home')
                ->with('flash_notice', 'You are successfully logged in.');
        }

        // authentication failure! lets go back to the login page
        return Redirect::route('login')
            ->with('flash_error', 'Your username/password combination was incorrect.')
            ->withInput();
	}

	public function createNewUser()
	{
		$username = Input::get('username');
		$newUser = array(
			'username' => $username,
			'password' => Hash::make(Input::get('password'))
		);

		$rules = array('username' => 'unique:users,username', 'password' => 'required');

		$validator = Validator::make(Input::only('username', 'password'), $rules);

		if ($validator->fails()) {

			$messages = $validator->messages();

			return Redirect::route('create_user')
	            ->with('flash_error', $messages->first())
	            ->withInput();
		} else {
			User::create($newUser);

			$user = User::where('username', '=', $username)->first();

			Auth::login($user);

	        return Redirect::route('home')
	                ->with('flash_notice', 'Your account was successfully created!');
        }
	}

}
