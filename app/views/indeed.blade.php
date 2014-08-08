@extends('_master')

@section('title')
	Profile Configuration
@stop

@section('content')
    
	<nav class="navbar navbar-inverse" role="navigation">
	<a class="navbar-text navbar-left" href='/'>← Home</a> 
	</nav

	{{"<br>"}}
	
		  
	<p><?php	
	$result= Session::get('inputProfileData');
	print_r($result);
	?> </p>	
	


@stop