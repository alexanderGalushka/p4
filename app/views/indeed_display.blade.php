@extends('_master')

@section('title')
	Profile Configuration
@stop

@section('content')
    
	<nav class="navbar navbar-inverse" role="navigation">
	<a class="navbar-text navbar-left" href='/'>← Home</a> 
	</nav>

	{{"<br>"}}
			  
	<?php	
	$result= Session::get('allJobs');
	
	/*$searchString = "";
	for ($i=0; $i<count($result); $i++)
	{
	    //get rid of underscores
		$str = $result[$i];
		
		if(strpos($str,'_'))
		{
			strtr ($str, array ('_' => ' '));
		}
		$searchString.= $str;
		$searchString.=" ";
		*/
		
		print_r($result);
	?>
	


@stop