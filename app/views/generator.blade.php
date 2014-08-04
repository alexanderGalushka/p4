@extends('_master')


@section('title')
	Lorem Ipsum Generator
@stop

@section('content')
    
	<a href='/'> ← Home</a>   
	<br><br>
	<h2> Lorem Ipsum Generator </h2>
	
	<p>How may paragraphs to display?</p>
	
    {{ Form::open(array('url' => '/lorem-ipsum', 'method' => 'POST')) }}
		{{ Form::text('input', 0, array('size' => '20','maxlength' => '2', 'class' => 'text-input')) }}
		{{ Form::label('input', '(Max: 99)') }}	
		<br><br>
		{{ Form::submit('Generate!') }}
	{{ Form::close() }}
	
	<br><br>
    <p> <?php if (is_array($paragraphs)) {echo implode('<p>', $paragraphs);} ?> </p>	

@stop