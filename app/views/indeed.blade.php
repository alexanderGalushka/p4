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
	$skills = $result['skillSet'];	
	?> </p>	
	
    <p style="font-size:24px">Please pick up to 6 relevant skills to the job you would like to search for from the form below:</>

	<fieldset>
	<legend>Skill Set provided via LinkedIn</legend>
		{{ Form::open(array('url' => '/indeed', 'class' => 'navbar-form navbar-left')) }}		
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
		{{ Form::submit('Choose', array('class' => 'btn btn-dafault')) }}
		{{ Form::close() }}	
	</fieldset>

	
	{{"<br><br>"}}
	
	<fieldset>
	<legend>Another form</legend>
	{{ Form::open(array('url' => '/indeed', 'class' => 'navbar-form navbar-left')) }}
				
		{{ Form::text('jobTitle', 'Mama', array('class' => 'form-control', 'placeholder' => 'Job Title')) }}<br><br>
	
		{{ Form::text('country', '', array('class' => 'form-control', 'placeholder' => 'Country')) }}<br><br>
		
		{{ Form::text('state', '', array('class' => 'form-control', 'placeholder' => 'State')) }}<br><br>
		
		{{ Form::submit('Submit', array('class' => 'btn btn-dafault')) }}
	
	{{ Form::close() }}
	</fieldset>

	
@stop