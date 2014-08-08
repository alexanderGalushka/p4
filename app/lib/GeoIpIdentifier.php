<?php

// to get "real IP", avoiding proxies,
// some of the code is taken from: http://stackoverflow.com/questions/13646690/how-to-get-real-ip-from-visitor



use GeoIp2\Database\Reader;

	
class GeoIpIdentifier
{
  
	private $reader;
	
	public function __construct()
	{   
		// This creates the Reader object, which should be reused across lookups.
		$this->reader = new Reader(base_path().'/public/geoLiteDB/GeoLite2-City.mmdb');
    }

	public function GetUserLocation()
	{
		try
		{
			$result = $this->reader->city($this->getUserIP());
		}
		catch (Exception $e)
		{
			$result = $this->reader->city('67.134.204.13'); //defaults to Cambridge, MA
		}
		return $result;
	}
	
	static function getUserIP()
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

}	