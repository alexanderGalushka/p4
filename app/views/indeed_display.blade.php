@extends('_master')

@section('title')
	Profile Configuration
@stop

@section('content')
    
	<nav class="navbar navbar-inverse" role="navigation">
	<a class="navbar-text navbar-left" href='/'>← Home</a> 
	</nav>
	

    <center>
	<span id=indeed_at> <a href="http://www.indeed.com/" target="_blank">jobs</a> by <a
	href="http://www.indeed.com/" target="_blank" title="Job Search"><img src="http://www.indeed.com/p/jobsearch.gif" style="border: 0;
	vertical-align: middle;" alt="Indeed job search"></a></span>     
	</center>
   
   {{"<br><br>"}}
			  
	<?php	
	$result= Session::get('allJobs');
	$jobs = $result['results'];
	?>
	
	{{ Form::open(array('class' => 'navbar-form navbar-left')) }}		
		@for ($i = 0; $i < count($jobs); $i++)
			<legend>{{$jobs[$i]['jobtitle']}}</legend>
			{{ Form::label($jobs[$i]['date']) }}<br><br>
			{{ Form::text('company', $jobs[$i]['company'], array('class' => 'form-control')) }} Company Name<br><br>
			{{ Form::text('location', $jobs[$i]['formattedLocation'], array('class' => 'form-control')) }} Location<br><br>
			{{ Form::textarea('snippet',$jobs[$i]['snippet'], ['size' => '85x5']) }} Snippet<br><br>
			{{ Form::text('jobkey', $jobs[$i]['jobkey'], array('class' => 'form-control')) }} Indeed JobKey<br><br>
			{{"<br><br>"}}
		@endfor
	{{ Form::close() }}
	
@stop