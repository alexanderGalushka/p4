@extends('_master')

@section('title')
	Welcome to the JobFit
@stop

@section('content')
    
	<paper-shadow></paper-shadow>
	<div class="card paper-shadow-top-z-1">
		<div class="inner paper-shadow-bottom-z-1"></div>
		<div layout horizontal class="toolbar paper-shadow-top-z-1">
			<div class="inner paper-shadow-bottom-z-1"></div>
			<paper-menu-button icon="menu" halign="left">
			     <paper-item label="">JobToFit Login</paper-item>
	
			</paper-menu-button>
			<div flex></div>
			<paper-menu-button icon="more-vert" halign="right">
			    <paper-item onclick="GoTo(0)" label="LinkedIn Login"></paper-item>
				<paper-item onclick="GoTo(1)" label="JobToFit Login"></paper-item>
				<paper-item onclick="GoTo(2)" label="JobToFit SignUp"></paper-item>	
				<paper-item label="Send Feedback"></paper-item>
				<paper-item onclick="BringUpAboutDialog('paper-dialog-transition-center')" label="About"></paper-item>
				<paper-item onclick="GoTo(3)" label="SignOut"></paper-item>
			</paper-menu-button>
		</div>
	</div>
	
	<center>
	<h1>To enjoy JobToFit application please login as a LinkedIn user<br>or create a new user with JobToFit</h1>
	</center>
	
	<paper-dialog heading="About JobFit" transition="paper-dialog-transition-center"> 
		<big><i><p>JobToFit tool will help to identify your career level and your skill set,
		<br>organize your career path, set career goals, search for relevant jobs.<br><br>
		JobFit uses LinkedIn profile or your direct input along with Indeed.com
		<br>and Monster.com Job search engines to accomplish the above stated tasks</p></i></big>
	</paper-dialog>

	 
@stop


