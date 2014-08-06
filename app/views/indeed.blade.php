@extends('_master')

@section('title')
	Login
@stop

@section('content')
    
	<nav class="navbar navbar-inverse" role="navigation">
	<a class="navbar-text navbar-left" href='/'>← Home</a> 
	</nav

	<br><br>
	
	@foreach($errors->all() as $message) 
		<div class='error'>{{ $message }}</div>
	@endforeach
		  
		  
	<p><?php
	
	$result= Session::get('data');
	
	print_r ($result);
	echo "<br><br>";
    //education part
	if (array_key_exists('educations', $result))
	{
		if ( !isset($result['educations']['_total']) ||  $result['educations']['_total'] == '0'  )
		{
		  //unkown education
		}
		
		//highest education usually takes place '0'
		else 
        {
		    //$check = "";
			//interested in the user's major
			// && ( $check != result['educations']['values']['0']['fieldOfStudy'] ) - LARAVEL/PHP BUG!!!
			if ( isset($result['educations']['values']['0']['fieldOfStudy']) )
			{  
			    echo "<br><br>";
				echo $result['educations']['values']['0']['fieldOfStudy'];
				echo "<br><br>";
				echo $result['educations']['values']['0']['degree'];
			}
	    }			
		
	}
	else{ echo "JOPA!";}
	//personal info
	
	if (array_key_exists('firstName', $result))
	{
	//fistName
	}
	if (array_key_exists('lastName', $result))
	{
	//lastName
	}
	if ( isset($result['location']['country']['code']))
	{
	//country code
	}
	if ( isset($result['location']['name']) ) 
	{
	//
	}
	
	
	//location definitions between LinkedIn and Indeed are a little different 
	//LinkedIn uses areas, so there is should a conversion table
	 //[location] => Array ( [country] => Array ( [code] => us ) [name] => Greater Boston Area )
	
	
	//use for location
	echo "<br><br>";
	
	//to get "real IP", avoiding proxies, code is taken from: http://stackoverflow.com/questions/13646690/how-to-get-real-ip-from-visitor
	function getUserIP()
	{
		$client  = @$_SERVER['HTTP_CLIENT_IP'];
		$forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
		$remote  = $_SERVER['REMOTE_ADDR'];

		if(filter_var($client, FILTER_VALIDATE_IP))
		{
			$ip = $client;
		}
		elseif(filter_var($forward, FILTER_VALIDATE_IP))
		{
			$ip = $forward;
		}
		else
		{
			$ip = $remote;
		}

		return $ip;
	}


	$user_ip = getUserIP();
	
	include(base_path().'\vendor\autoload.php');
	use GeoIp2\Database\Reader;
	use MaxMind\Db\Reader\InvalidDatabaseException;

	// This creates the Reader object, which should be reused across
	// lookups.
	$reader = new Reader(base_path().'/public/geoLiteDB/GeoLite2-City.mmdb');
	

	// Replace "city" with the appropriate method for your database, e.g.,
	// "country".
	//$record = $reader->city('67.134.204.13'); //for localhost - testing purposes
	try
	{
		$record = $reader->city($user_ip);
	}
	catch (Exception $e)
	{
		$record = $reader->city('67.134.204.13');
	}

	print($record->country->isoCode . "\n"); // 'US'
	print($record->mostSpecificSubdivision->isoCode . "\n"); // 'MA'
	print($record->city->name . "\n"); // 'Cambridge'
	print($record->postal->code . "\n"); // '02138'

	//array_key_exists
	//[educations] => stdClass Object ( [_total] => 3 [values]
	

	?> </p>		  
	
	{{ Form::open(array('url' => '/indeed', 'class' => 'navbar-form navbar-left')) }}
				
		{{ Form::text('jobTitle', '', array('class' => 'form-control', 'placeholder' => 'Job Title')) }}<br><br>
	
		{{ Form::text('country', '', array('class' => 'form-control', 'placeholder' => 'Country')) }}<br><br>
		
		{{ Form::text('state', '', array('class' => 'form-control', 'placeholder' => 'State')) }}<br><br>
		
		{{ Form::submit('Submit', array('class' => 'btn btn-dafault')) }}
	
	{{ Form::close() }}

	
@stop