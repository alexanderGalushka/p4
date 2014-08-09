<?php

class LinkedinLoginController extends BaseController
{
    
	private $loginLinkedinStatus;
	private $provider;
	private $usersDataArray;
	
	public function __construct()
	{
        $this->loginLinkedinStatus = false;
		$this->provider = new Linkedin(Config::get('linkedin.linkedin'));
		$this->usersDataArray = array();
    }

	//LinkedinLoginController@Login
	public function Login()
	{
		if ( !Input::has('code'))
		{
			// If we don't have an authorization code, get one
			$this->provider->authorize();
		}
		else 
		{
			try 
			{
				// Try to get an access token (using the authorization code grant)
				$t = $this->provider->getAccessToken('authorization_code', array('code' => Input::get('code')));
				try
				{
					// We got an access token, let's now get the user's details
					$userDetails = $this->provider->getUserDetails($t);
					$resource = '/v1/people/~:(firstName,lastName,positions,educations,threeCurrentPositions,threePastPositions,skills,location,email-address)';
					$params = array('oauth2_access_token' => $t->accessToken, 'format' => 'json');
					$url = 'https://api.linkedin.com' . $resource . '?' . http_build_query($params);
					$context = stream_context_create(array('http' => array('method' => 'GET')));
					//pull out the user's data
					$response = file_get_contents($url, false, $context);
					$this->usersDataArray = json_decode($response, true);
					$data = $this->ProcessLinkedInData ( $this->usersDataArray );
					$this->loginLinkedinStatus = true;
					Cache::forever('loginLinkedinStatus', $this->loginLinkedinStatus);
					
		            $linkedin_email = $data['email'];
					
					$output = UserProfile::where('email', '=', $linkedin_email)->first();
                    if ($output == NULL)
					{
						return Redirect::to('/profile/configure')							   
									        ->with('data',$data);
					}
					else
					{
					    $retrievedData = $this->GetDataFromDB($linkedin_email);
						return Redirect::to('/profile/retrieve')							   
									        ->with('retrievedData',$retrievedData);
					}
				} catch (Exception $e)
				{
					return $e.'   Unable to get user details';
				}

			} catch (Exception $e)
			{
				return 'Unable to get access token';
			}
		}
	}
	
	
	static function ProcessLinkedInData ( $rawData )
	{
		$parsedData =array();
	    //get education information
		if ( !isset($rawData['educations']['_total']) ||  $rawData['educations']['_total'] == '0'  )
		{
			$parsedData['fieldOfStudy']  = 'UNKNOWN';
			$parsedData['degree']  = 'UNKNOWN';				
		}
		//highest education usually takes place '0'
		else 
		{
			if ( isset($rawData['educations']['values']['0']['fieldOfStudy']) )
			{  
				$parsedData['fieldOfStudy'] = $rawData['educations']['values']['0']['fieldOfStudy'];
				$parsedData['degree']  = $rawData['educations']['values']['0']['degree'];
			}
		}			
		
		if (array_key_exists('firstName', $rawData))
		{
			$parsedData['firstName'] = $rawData['firstName'] ;
		}
		if (array_key_exists('lastName', $rawData))
		{
			$parsedData['lastName'] = $rawData['lastName'] ;
		}
		// if ( isset($rawData['location']['country']['code']) ) - GeoIP is used to to locate the user
		// if ( isset($rawData['location']['name']) ) 
		if (array_key_exists('emailAddress', $rawData))
		{
			$parsedData['email'] = $rawData['emailAddress'];
		}
	    
		//job titles
		if ( isset($rawData['positions']['_total']) && $rawData['positions']['_total'] > 0 )
		{
			if ( $rawData['positions']['_total'] == 1 )
			{
				if ( isset($rawData['positions']['values']['0']['title']) )
				{
					$parsedData['currentJobTitle'] = $rawData['positions']['values']['0']['title'];
					$parsedData['previousJobTitle'] = 'UNKNOWN';
				}
				else
				{
					$parsedData['currentJobTitle'] = 'UNKNOWN';
					$parsedData['previousJobTitle'] = 'UNKNOWN';
				}
			}
			else
			{
				if ( isset($rawData['positions']['values']['0']['title']) )
				{
					$parsedData['currentJobTitle'] = $rawData['positions']['values']['0']['title'];
				}
				else
				{
					$parsedData['currentJobTitle'] = 'UNKNOWN';
				}
				if ( isset($rawData['positions']['values']['1']['title']) )
				{
					$parsedData['previousJobTitle'] = $rawData['positions']['values']['1']['title'];
				}
				else
				{
					$parsedData['previousJobTitle'] = 'UNKNOWN';
				}
			}
		}
		else
		{
			$parsedData['currentJobTitle'] = 'UNKNOWN';
			$parsedData['previousJobTitle'] = 'UNKNOWN';
		}
		
		//skills 
		$skillSet = array();		
		if ( isset($rawData['skills']['_total']) && $rawData['skills']['_total'] > 0 )
		{
			for ($i = 0; $i < $rawData['skills']['_total']; $i++)
			{
				array_push( $skillSet, $rawData['skills']['values'][$i]['skill']['name'] );
			}
		}
		$parsedData['skillSet'] = $skillSet;
		
		
		return $parsedData;
	}
	
	static function GetDataFromDB($myEmail)
	{
		$profile = UserProfile::where('email', '=', $myEmail)->get();
		$mult_arr = $profile->toArray();
	    $arr = $mult_arr['0'];
		
		$id_profile = $arr['id'];
		
		unset($arr['id'],$arr['updated_at'],$arr['created_at']);
		
		$skils = UserSkills::where('user_profile_id', '=', $id_profile)->get();
		
		$mult_arr2 = $skils->toArray();
	    $arr2 = $mult_arr2['0'];
		
		unset($arr2['id'],$arr['user_profile_id'],$arr['created_at']);		
		
		$result = Array();
		
		$result['profile'] = $arr;
		$result['skills'] = $arr2;
		$result['id'] = $id_profile;
		$result['email'] = $myEmail;
		
		return $result;
		
	}

	//shared variable across the views
	public function CheckLogin()
	{		
		$this->loginLinkedinStatus;
	}	
}	