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

Route::post('/profile/retrieve', 'ProfileRetrieveController@ProcessProceed');

Route::get ('/indeed/search', 'IndeedController@GetIndeedSearch');

Route::post ('/indeed/search', 'IndeedController@SearchJob');

Route::get('/indeed', 'IndeedController@GetIndeed'); 

Route::get('/indeed/display', 'IndeedController@GetIndeedDisplay');

Route::get('/', function()
{
	return View::make('index');
});


Route::get('/get-environment',function() {

    echo "Environment: ".App::environment();

});


Route::get('/debug', function() {

    echo '<pre>';

    echo '<h1>environment.php</h1>';
    $path   = base_path().'/environment.php';

    try {
        $contents = 'Contents: '.File::getRequire($path);
        $exists = 'Yes';
    }
    catch (Exception $e) {
        $exists = 'No. Defaulting to `production`';
        $contents = '';
    }

    echo "Checking for: ".$path.'<br>';
    echo 'Exists: '.$exists.'<br>';
    echo $contents;
    echo '<br>';

    echo '<h1>Environment</h1>';
    echo App::environment().'</h1>';

    echo '<h1>Debugging?</h1>';
    if(Config::get('app.debug')) echo "Yes"; else echo "No";

    echo '<h1>Database Config</h1>';
    print_r(Config::get('database.connections.mysql'));

    echo '<h1>Test Database Connection</h1>';
    try {
        $results = DB::select('SHOW DATABASES;');
        echo '<strong style="background-color:green; padding:5px;">Connection confirmed</strong>';
        echo "<br><br>Your Databases:<br><br>";
        print_r($results);
    } 
    catch (Exception $e) {
        echo '<strong style="background-color:crimson; padding:5px;">Caught exception: ', $e->getMessage(), "</strong>\n";
    }

    echo '</pre>';

});


