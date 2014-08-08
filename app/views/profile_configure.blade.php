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
	$geoIpIdentity = new GeoIpIdentifier();
	$record = $geoIpIdentity->GetUserLocation();
	$zipcode = $record->postal->code;
	$result= Session::get('data');
	//print_r($result);
	$skills = $result['skillSet'];	
	?> </p>	
	
    <p style="font-size:24px">Please select up to 10 relevant skills relevant <br> to the job you would like to search for:</>

	<legend>Skill Set provided via LinkedIn</legend>
	{{ Form::open(array('url' => '/profile/configure', 'method' => 'POST', 'class' => 'navbar-form navbar-left')) }}		
		@for ($i = 0; $i < count($skills); $i++)
			@if ($i%5 == 0)
				@if ($i != 0)
					{{"<br><br>"}}
				@endif
			@endif	
			{{ Form::checkbox($skills[$i], 'yes') }}
			{{ Form::label($skills[$i]) }}
		@endfor
	{{"<br><br>"}}
	
    <p style="font-size:24px">Please confirm/modify the information below and <br> click  SAVE  button to store your JOByouFIT profile</>	
	
	<legend>Personal Info</legend>
	{{ Form::open(array('url' => '/indeed', 'class' => 'navbar-form navbar-left')) }}
		{{ Form::text('firstName', $result['firstName'], array('class' => 'form-control')) }} First Name<br><br>	
		{{ Form::text('lastName', $result['lastName'], array('class' => 'form-control')) }} Last Name<br><br>
		{{ Form::text('zipcode', $zipcode, array('class' => 'form-control')) }} Current Location ZIP code<br><br>		
		{{ Form::text('email', $result['email'], array('class' => 'form-control')) }} Email<br><br>
		{{ Form::text('degree', $result['degree'], array('class' => 'form-control')) }} Degree<br><br>			
		{{ Form::text('fieldOfStudy', $result['fieldOfStudy'], array('class' => 'form-control')) }} Field of Study<br><br>
		{{ Form::text('currentJobTitle', $result['currentJobTitle'], array('class' => 'form-control')) }} Current Job Title<br><br>
		{{ Form::text('previousJobTitle', $result['previousJobTitle'], array('class' => 'form-control')) }} Previous Job Title<br><br>
		{{"<br>"}}
		{{ Form::submit('SAVE', array('class' => 'btn btn-dafault')) }}	
	{{ Form::close() }}

	
@stop