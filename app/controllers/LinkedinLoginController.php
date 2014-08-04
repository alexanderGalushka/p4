<?php

class LinkedinLoginController extends BaseController
{
    
	private $loginLinkedinStatus;
	private $provider;
	
	public function __construct()
	{
        $this->loginLinkedinStatus = false;
		$this->provider = new Linkedin(Config::get('linkedin.linkedin'));
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
					$resource = '/v1/people/~:(firstName,lastName,pictureUrl,positions,educations,threeCurrentPositions,threePastPositions,dateOfBirth,location)';
					$params = array('oauth2_access_token' => $t->accessToken, 'format' => 'json');
					$url = 'https://api.linkedin.com' . $resource . '?' . http_build_query($params);
					$context = stream_context_create(array('http' => array('method' => 'GET')));
					$response = file_get_contents($url, false, $context);
					$data = json_decode($response);
					return Redirect::to('/')->with('data',$data);
					$this->loginLinkedinStatus = true;
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
	
	public function GetloginLinkedinStatus ()
	{
		return $this->loginLinkedinStatus;
	}
}