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
	
	$data = Session::get('data');
	
	$result = UserProfile::where('email', '=', $data['email'])->get();
	
	//$y  = $result['users_profile'];
	
	//echo $y;
	
	print_r($result);

	?> </p>	
	

	{{"<br><br>UNDER DEVELOPMENT...................."}}
	
@stop