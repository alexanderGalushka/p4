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
			$this->UpdateProfile($inputData);
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
				array_push($indeedArray, $inputData['degree']);
			}
			
			$indeedArray['zipcode'] = $inputData['zipcode'];
		}
		
		if ($ifIndeedSearch)
		{
			return Redirect::to('/indeed/search')							   
				   ->with('indeedArray',$indeedArray);
		}
	}
	
	static function UpdateProfile($input)
	{
		$profile = UserProfile::where('email', '=', $input['email'])->get();
		$mult_arr = $profile->toArray();
	    $arr = $mult_arr['0'];
		$id_profile = $arr['id'];
		
		$skills = UserSkills::where('user_profile_id', '=', $id_profile)->get();
		$mult_arr2 = $profile->toArray();
	    $arr2 = $mult_arr['0'];
		$id_skills = $arr2['id'];
		
		$userProfile = UserProfile::find($id_profile);
 
		$userProfile->email = $input['email'];
		$userProfile->zipcode = $input['zipcode'];
		$userProfile->degree = $input['degree'];
		$userProfile->fieldOfStudy = $input['fieldOfStudy'];
		$userProfile->currentJobTitle = $input['currentJobTitle'];
		$userProfile->previousJobTitle = $input['previousJobTitle'];
		$userProfile->save();
		 
		$userSkills = UserSkills::find($id_skills);
		//Creating default object from empty value ERROR - can't figure out why...
		/*$userSkills->skill_1 = $input['skill_1'];
		$userSkills->skill_2 = $input['skill_2'];
		$userSkills->skill_3 = $input['skill_3'];	
		$userSkills->skill_4 = $input['skill_4'];
		$userSkills->skill_5 = $input['skill_5'];
		$userSkills->skill_6 = $input['skill_6'];
		$userSkills->skill_7 = $input['skill_7'];
		$userSkills->skill_8 = $input['skill_8'];		
		$userSkills->skill_9 = $input['skill_9'];
		$userSkills->skill_10 = $input['skill_10'];		
		$userSkills->save();*/		
			
	}
}