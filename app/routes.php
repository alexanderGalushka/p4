<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

View::share('loginLinkedinStatus', 'LinkedinLoginController@GetloginLinkedinStatus');

Route::get('/', function()
{
	return View::make('index');
});


Route::get('/get-environment',function() {

    echo "Environment: ".App::environment();

});

//User's credentials
Route::get('linkedin/login', 'LinkedinLoginController@Login');

Route::get('jobtofit/signup', 'JobToFitSignupController@GetSignup');

Route::post('jobtofit/signup', ['before' => 'csrf', 'uses' => 'JobToFitSignupController@PostSignup']);

Route::get('jobtofit/login', 'JobToFitLoginController@GetLogin');

Route::post('jobtofit/login', ['before' => 'csrf', 'uses' => 'JobToFitLoginController@PostLogin'] );

Route::get('/logout', ['before' => 'auth', 'uses' => 'JobToFitLoginController@GetLogout'] );


Route::get('indeed/search', 'IndeedController@search');