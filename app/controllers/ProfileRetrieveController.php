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
		return View::make('profile_retrieve');
	}  
	
	public function ProcessProceed()
	{
		$inputData = Input::all();
		unset($inputData['_token']);
		
		$ifUpdateProfile = array_key_exists('updateProfile', $inputData);
		$ifIndeedSearch = array_key_exists('indeedSearch', $inputData);
		
		unset($inputData['updateProfile'],$inputData['indeedSearch']);
		
		if ($ifUpdateProfile)
		{
			//$this->UpdateProfile($inputData);
		}
		
		$indeedArray = Array();
		
		//get the checked inputs for search with indeed
		if ($ifIndeedSearch)
		{
			foreach($inputData as $key => $value)
			{
				if(strpos($key, '_check'))
				{
					array_push($indeedArray, $value);
				}
			}
			//provide default search value as a zipcode if the indeedArray is empty
			if(count($indeedArray) == 0)
			{
				array_push($indeedArray, $inputData['zipcode']);
			}
		}
		
		if ($ifIndeedSearch)
		{
			return Redirect::to('/indeed/search')							   
				   ->with('indeedArray',$indeedArray);
		}
	}
	
	static function UpdateProfile($input)
	{
		
	}

}