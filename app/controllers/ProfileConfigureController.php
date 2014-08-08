<?php

class ProfileConfigureController extends BaseController
{

    public function __construct()
	{   
	
		# Only logged in users should have access to this controller
		//$this->beforeFilter('auth'); //not sure if the user logged in from LinkedIn will be let im
    }
	
	// ProfileConfigureController@GetProfile
   	public function GetProfile() 
	{
		return View::make('profile_configure');
	}  

	//ProfileConfigureController@SaveProfile	
	public function SaveProfile()
	{
	    $userProfile = new UserProfile();
		
		$inputProfileData = Input::all();
		unset($inputProfileData['_token']);
		
		$email = UserProfile::where('email', '=', $inputProfileData['email'])->first();
		
		if ($email == NULL)
		{
			try
			{
				$userProfile->email = $inputProfileData['email'];
				$userProfile->firstName = $inputProfileData['firstName'];
				$userProfile->lastName = $inputProfileData['lastName'];
				$userProfile->zipcode = $inputProfileData['zipcode'];
				$userProfile->degree = $inputProfileData['degree'];
				$userProfile->fieldOfStudy = $inputProfileData['fieldOfStudy'];
				$userProfile->currentJobTitle = $inputProfileData['currentJobTitle'];
				$userProfile->previousJobTitle = $inputProfileData['previousJobTitle'];
				$userProfile->save();
				
				unset($inputProfileData['firstName'], $inputProfileData['lastName'],
					  $inputProfileData['zipcode'],$inputProfileData['email'],
					  $inputProfileData['degree'], $inputProfileData['fieldOfStudy'],
					  $inputProfileData['currentJobTitle'], $inputProfileData['previousJobTitle']);
				
				$skills = array_keys($inputProfileData);
				
				//10 entries have to be in 'skills' array, append 'none' value if less than 10
				
				if ( count($skills) < 10 )
				{   
					$toAddCount = 10 - count($skills);
					for ($toAddCount; $toAddCount> 0; $toAddCount--)
					{
						array_push($skills, "none");
					}
				}
				
				$skillsFixed = Array();
				for ($i=1; $i<11; $i++)
				{ 
					$key = "skill_".$i;
					$skillsFixed[$key] = $skills[$i-1];
				}
				
				$skillSet = new UserSkills;
				$skillSet->fill($skillsFixed);
				$skillSet->userProfile()->associate($userProfile);
				$skillSet->save();
				
				$didProfileExist = "no";
				$message = "Profile has been saved successfully.";
			}
			catch (Exception $e)
			{
				$didProfileExist = "no";
				$message = $e;
			}
		}
		else
		{
		    $didProfileExist = "yes";
			$message = "Profile is already exist. Would you like to edit it?";
		}

		$output = array();
		$output['message'] = $message;
		$output['didProfileExist'] = $didProfileExist;
			
		return Redirect::to('/indeed')							   
			   ->with('inputProfileData',$output);
	}
}