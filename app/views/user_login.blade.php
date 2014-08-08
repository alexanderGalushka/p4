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
	
	{{ Form::open(array('url' => '/login', 'class' => 'navbar-form navbar-left')) }}
				
		
		{{ Form::text('email', '', array('class' => 'form-control', 'placeholder' => 'Email')) }}<br><br>
	
		{{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'Password')) }}<br><br>
		
		{{ Form::submit('Submit', array('class' => 'btn btn-dafault')) }}
	
	{{ Form::close() }}

	{{$loginLinkedinStatus}}
	
@stop