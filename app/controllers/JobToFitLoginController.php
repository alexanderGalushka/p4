<?php

class JobToFitLoginController extends BaseController
{
    
	public function __construct()
	{
        $this->beforeFilter('guest', array('only' => array('GetLogin')));	
    }


	public function GetLogin()
	{
		
		return View::make('user_login');
		
	}
	
	public function PostLogin()
	{
		
		$credentials = Input::only('email', 'password');
		
		print_r($credentials);
	
		if (Auth::attempt($credentials, $remember = true)) {
			return Redirect::intended('/')->with('flash_message', 'Welcome Back!');
		}
		else {
			return Redirect::to('/jobtofit/login')
				->with('flash_message', 'Log in failed; please try again.')
				->withInput();
		}
		
		return Redirect::to('/');
				
	}
	
	
	public function GetLogout()
	{
		
		# Log out
		Auth::logout();
	
		# Send them to the homepage
		return Redirect::to('/');

	}
}