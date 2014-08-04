<?php

class JobToFitSignupController extends BaseController
{
    
	public function __construct() 
	{
        $this->beforeFilter('guest', array('only' => array('GetSignup')));	
    }

	
	public function GetSignup() 
	{
		
		return View::make('user_signup');
		
	}
	
	public function PostSignup()
	{
		
		$rules = array(
			'email' => 'required|email|unique:users,email',
			'password' => 'required|min:6'	
		);			
			
		$validator = Validator::make(Input::all(), $rules);
		
		if($validator->fails()) 
		{
			
			return Redirect::to('/jobtofit/signup')
				->with('flash_message', 'Sign up failed; please fix the errors listed below.')
				->withInput()
				->withErrors($validator);
		}
					
		$user = new User;
		$user->email    = Input::get('email');
		$user->password = Hash::make(Input::get('password'));
		
		try
		{
		//save to the jobtofit DB, users table
			$user->save();
		}
		catch (Exception $e) 
		{
			return Redirect::to('/jobtofit/signup')
				->with('flash_message', 'Sign up failed; please try again.')
				->withInput();
		}
		
		// Login
		Auth::login($user);
		
		return Redirect::to('/')->with('flash_message', 'Welcome to Foobooks!');
				
	}
		
}