<?php

class IndeedController extends BaseController{

    public function SearchJoB()
	{
	    $client = new Indeed("9829229899548156"); //publisher number
				
	    $zipcode = "01821"; //default
		$formInput = Input::all();
		unset($formInput['_token']);
		
		$params = Array();
		$params['q'] = $formInput ;//skills and etc
		$params['l'] = $zipcode;
		$params['co'] = "US";
		$params['limit'] = 10;
		$params['userip'] = $_SERVER["REMOTE_ADDR"];
		$params['useragent'] = $_SERVER["HTTP_USER_AGENT"];
		$params['format'] = "json";
		$params['sort'] = "date";
		$params['start'] = 0;
		$params['end'] = 10;
		
	
		$allJobs = $client->search($params);
	
		return Redirect::to('/indeed/display')							   
					->with('allJobs',$allJobs);
		
	}
	
	public function GetIndeedDisplay()
	{
		return View::make('indeed_display');
	}
    
	//IndeedController@GetIndeed
	public function GetIndeed() 
	{
		return View::make('indeed');
	} 
	
	public function GetIndeedSearch()
	{
		return View::make('indeed_search');
	}
	
}