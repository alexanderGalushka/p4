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
					$resource = '/v1/people/~:(firstName,lastName,positions,educations,threeCurrentPositions,threePastPositions,skills,location)';
					$params = array('oauth2_access_token' => $t->accessToken, 'format' => 'json');
					$url = 'https://api.linkedin.com' . $resource . '?' . http_build_query($params);
					$context = stream_context_create(array('http' => array('method' => 'GET')));
					//pull out the user's data
					$response = file_get_contents($url, false, $context);
					$this->usersDataArray = json_decode($response, true);
					$data = $this->ProcessLinkedInData ( $this->usersDataArray );
					$this->loginLinkedinStatus = true;
					return Redirect::to('/indeed')							   
								   ->with('data',$data);
				} catch (Exception $e)
				{
					return 'Unable to get user details';
				}

			} catch (Exception $e)
			{
				return 'Unable to get access token';
			}
		}
	}
	
	public function GetLoginLinkedinStatus ()
	{
		return $this->loginLinkedinStatus;
	}
	
	public function GetUsersDataArray ()
	{
		return $this->usersDataArray;
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

}	