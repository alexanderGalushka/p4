@extends('_master')

@section('title')
	Sign up
@stop

@section('content')
    
	<nav class="navbar navbar-inverse" role="navigation">
	<a class="navbar-text navbar-left" href='/'>← Home</a> 
	</nav

	<br><br>
	
	@foreach($errors->all() as $message) 
		<div class='error'>{{ $message }}</div>
	@endforeach
	
	{{ Form::open(array('url' => 'jobtofit/signup', 'class' => 'navbar-form navbar-left')) }}
				
		
		{{ Form::text('email', '', array('class' => 'form-control', 'placeholder' => 'Email')) }}<br><br>
	
		{{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'Password')) }}<br><br>
		
		{{ Form::text('secret_question1', '', array('class' => 'form-control','placeholder' => 'Secret Question #1') ) }}<br><br>

		{{ Form::text('secret_answer1', '', array('class' => 'form-control','placeholder' => 'Secret Answer #1')) }}<br><br>

		{{ Form::text('secret_question2', '', array('class' => 'form-control','placeholder' => 'Secret Question #2')) }}<br><br>
		
		{{ Form::text('secret_answer2', '', array('class' => 'form-control','placeholder' => 'Secret Answer #2')) }}<br><br>
		
		{{ Form::submit('Submit', array('class' => 'btn btn-dafault')) }}
	
	{{ Form::close() }}

	
@stop