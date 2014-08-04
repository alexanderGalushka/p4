@extends('_master')


@section('title')
	User Generator
@stop

@section('content')
    
	<a href='/'> ← Home</a>   
	<br><br>
	<h2> User Generator </h2>
	
	<p>How may users to display?</p>
	
    {{ Form::open(array('url' => '/user-generator', 'method' => 'POST')) }}
		{{ Form::label('input', 'How many users?') }}	
		{{ Form::text('input', 0, array('size' => '20','maxlength' => '2', 'class' => 'text-input')) }}
		(Max: 99)
		<br>
		{{ Form::checkbox('address', '1', false) }}
		{{ Form::label('address', 'Address') }}
		<br>
		{{ Form::checkbox('profile', '1', false) }}
		{{ Form::label('profile', 'Profile') }}
		<br><br>
		{{ Form::submit('Generate!') }}
	{{ Form::close() }}
	
	<br><br>
    <p><?php
	if (is_array($outputArray)) 
	{
		for($i = 0; $i < count($outputArray); $i++)
		{
			echo $outputArray[$i];
			echo "<br>";
		}
	}	
	?> </p>	

@stop