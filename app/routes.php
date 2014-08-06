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

View::share('liStatus', 'LinkedinLoginController@GetLoginLinkedinStatus');
View::share('outputArray', 'LinkedinLoginController@GetUsersDataArray');


Route::get('/', function()
{
	return View::make('index');
});


Route::get('/indeed', function()
{
    $data = Session::get('data');
    return View::make('user')->with('data', $data);
});


Route::get('/get-environment',function() {

    echo "Environment: ".App::environment();

});

//User's credentials
Route::get('/linkedin/login', 'LinkedinLoginController@Login');

Route::get('/jobtofit/signup', 'JobToFitSignupController@GetSignup');

Route::post('/jobtofit/signup', ['before' => 'csrf', 'uses' => 'JobToFitSignupController@PostSignup']);

Route::get('/jobtofit/login', 'JobToFitLoginController@GetLogin');

Route::post('/jobtofit/login', ['before' => 'csrf', 'uses' => 'JobToFitLoginController@PostLogin'] );

//Route::get('/jobtofit/logout', ['before' => 'auth', 'uses' => 'JobToFitLoginController@GetLogout'] );

Route::get('/jobtofit/logout',  'JobToFitLoginController@GetLogout' );

Route::get('/login',function() {

    echo "Environment: ".App::environment();

});

Route::get('/indeed', 'IndeedController@GetIndeed');

Route::get('/indeed/search', 'IndeedController@search');