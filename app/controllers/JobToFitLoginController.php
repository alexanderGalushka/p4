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
	
		if (Auth::attempt($credentials, $remember = true)) {
			return Redirect::intended('/')->with('flash_message', 'Welcome Back!');
		}
		else {
			return Redirect::to('/login')
				->with('flash_message', 'Log in failed; please try again.')
				->withInput();
		}
		
		return Redirect::to('/');
				
	}
	
	
	public function GetLogout()
	{
	
		//for LinkedIn: 'https://www.linkedin.com/secure/login?session_full_logout=&trk=hb_signout'
		// Logout
		Auth::logout();
		// Send them to the homepage
		
		Session::flush();
		return Redirect::to('/login');
	}
}