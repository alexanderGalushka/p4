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


Route::get('/', function()
{
	return View::make('index');
});


Route::get('/get-environment',function() {

    echo "Environment: ".App::environment();

});

View::share('loginLinkedinStatus','LinkedinLoginController@CheckLogin'); 

//User's credentials
Route::get('/linkedin/login', 'LinkedinLoginController@Login');

Route::get('/signup', 'JobToFitSignupController@GetSignup');

Route::post('/signup', ['before' => 'csrf', 'uses' => 'JobToFitSignupController@PostSignup']);

Route::get('/login', 'JobToFitLoginController@GetLogin');

Route::post('/login', ['before' => 'csrf', 'uses' => 'JobToFitLoginController@PostLogin'] );

Route::get('/logout',  ['before' => 'auth', 'uses' => 'JobToFitLoginController@GetLogout'] );

Route::get('/profile/configure', 'ProfileConfigureController@GetProfile');

Route::post('/profile/configure', 'ProfileConfigureController@SaveProfile');

Route::get('/profile/retrieve', 'ProfileRetrieveController@GetProfile');


Route::get('/indeed', 'IndeedController@GetIndeed'); 


