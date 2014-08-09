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

	$retrievedData = Session::get('retrievedData');
	$profile = $retrievedData['profile'];
	$skills = $retrievedData['skills'];


	?> </p>	
	
	<p style="font-size:24px">You can update your profile below by editing the entry of corresponded text box<br><br>
	Take your time to pick the fields you would like to use for the Indeed job quest,<br>
	just simply check the correspondent checkbox<br><br>
	Before clicking on the PROCEED button choose the options to "Update Profile" or "Start Indeed Search"<br>
	or you can choose both options for your convenience.<br> 
	</>
	{{"<br><br>"}}
	<legend>Full Profile Information</legend>
	{{ Form::open(array('url' => '/profile/retrieve', 'class' => 'navbar-form navbar-left')) }} 
		{{ Form::checkbox('zipcode_check', $profile['zipcode']) }} {{ Form::text('zipcode', $profile['zipcode'], array('class' => 'form-control')) }} Current Location ZIP code<br><br>		
		{{ Form::checkbox('degree_check', $profile['degree']) }} {{ Form::text('degree', $profile['degree'], array('class' => 'form-control')) }} Degree<br><br>			
		{{ Form::checkbox('fieldOfStudy_check', $profile['fieldOfStudy']) }} {{ Form::text('fieldOfStudy', $profile['fieldOfStudy'], array('class' => 'form-control')) }} Field of Study<br><br>
		{{ Form::checkbox('currentJobTitle_check', $profile['currentJobTitle']) }} {{ Form::text('currentJobTitle', $profile['currentJobTitle'], array('class' => 'form-control')) }} Current Job Title<br><br>
		{{ Form::checkbox('previousJobTitle_check', $profile['previousJobTitle']) }} {{ Form::text('previousJobTitle', $profile['previousJobTitle'], array('class' => 'form-control')) }} Previous Job Title<br><br>
		{{ Form::checkbox('skill_1_check', $skills['skill_1']) }} {{ Form::text('skill_1', $skills['skill_1'], array('class' => 'form-control')) }} Skill # 1<br><br>
		{{ Form::checkbox('skill_2_check', $skills['skill_2']) }} {{ Form::text('skill_2', $skills['skill_2'], array('class' => 'form-control')) }} Skill # 2<br><br>
		{{ Form::checkbox('skill_3_check', $skills['skill_3']) }} {{ Form::text('skill_3', $skills['skill_3'], array('class' => 'form-control')) }} Skill # 3<br><br>
		{{ Form::checkbox('skill_4_check', $skills['skill_4']) }} {{ Form::text('skill_4', $skills['skill_4'], array('class' => 'form-control')) }} Skill # 4<br><br>
		{{ Form::checkbox('skill_5_check', $skills['skill_5']) }} {{ Form::text('skill_5', $skills['skill_5'], array('class' => 'form-control')) }} Skill # 5<br><br>
		{{ Form::checkbox('skill_6_check', $skills['skill_6']) }} {{ Form::text('skill_6', $skills['skill_6'], array('class' => 'form-control')) }} Skill # 6<br><br>
		{{ Form::checkbox('skill_7_check', $skills['skill_7']) }} {{ Form::text('skill_7', $skills['skill_7'], array('class' => 'form-control')) }} Skill # 7<br><br>
		{{ Form::checkbox('skill_8_check', $skills['skill_8']) }} {{ Form::text('skill_8', $skills['skill_8'], array('class' => 'form-control')) }} Skill # 8<br><br>
		{{ Form::checkbox('skill_9_check', $skills['skill_9']) }} {{ Form::text('skill_9', $skills['skill_9'], array('class' => 'form-control')) }} Skill # 9<br><br>
		{{ Form::checkbox('skill_10_check', $skills['skill_10']) }} {{ Form::text('skill_10', $skills['skill_10'], array('class' => 'form-control')) }} Skill # 10<br><br>

		{{"<br>"}}
		{{ Form::label('Update Profile') }} {{ Form::checkbox('updateProfile', 'yes') }}{{ Form::label('Start Indeed Search') }} {{ Form::checkbox('indeedSearch', 'yes') }}
		{{"<br><br>"}}
		{{ Form::submit('PROCEED', array('class' => 'btn btn-dafault')) }}	
	{{ Form::close() }}
	
@stop