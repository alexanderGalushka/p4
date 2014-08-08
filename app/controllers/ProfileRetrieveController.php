<?php

class ProfileRetrieveController extends BaseController
{
    private $profile;
    public function __construct()
	{   
	
		# Only logged in users should have access to this controller
		//$this->beforeFilter('auth'); //not sure if the user logged in from LinkedIn will be let im
    }
	
	// ProfileConfigureController@GetProfile
   	public function GetProfile() 
	{
	    //$data = Session::get('data');
		
		//$email = $data['email'];
		//$this->profile = $this->GetDataFromDB($email);
		//Cache::forever('profile', $this->profile);

		return View::make('profile_retrieve');
	}  

	
	static function GetDataFromDB($myEmail)
	{

		$result = UserProfile::where('email', '=', $myEmail)->get();
		//$result = UserSkills::with('userProfile')->get();
		//$q->where('name', 'LIKE', "%$query%");
		return $array;//$result;
		
	}
}