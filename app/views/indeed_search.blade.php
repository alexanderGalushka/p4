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
	$result= Session::get('indeedArray');
	$zipcode = $result['zipcode'];
	unset($result['zipcode']);
	$searchString = "";
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
	}
	?>
	
	{{ Form::open(array('url' => '/indeed/search', 'method' => 'POST', 'class' => 'navbar-form navbar-left')) }}		
		{{ Form::text('zipcode', $zipcode, array('class' => 'form-control')) }} 
		{{"<br>"}}
		{{ Form::textarea('notes',$searchString, ['size' => '85x5']) }}	
		{{"<br>"}}
		{{ Form::submit('FIND JOB', array('class' => 'btn btn-dafault')) }}	
	{{ Form::close() }}

@stop