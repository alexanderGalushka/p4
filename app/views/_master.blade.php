<!doctype html>
<html>
<head>

    <link href="//netdna.bootstrapcdn.com/bootswatch/3.1.1/flatly/bootstrap.min.css" rel="stylesheet"> 	
	
	<script src="bower_components/platform/platform.js"></script>
	<link href="bower_components/core-icons/core-icons.html" rel="import">
	<link href="bower_components/paper-icon-button/paper-icon-button.html" rel="import">
	<link href="bower_components/paper-item/paper-item.html" rel="import">
	<link href="bower_components/paper-shadow/paper-shadow.html" rel="import">
	<link href="bower_components/paper-menu-button/paper-menu-button.html" rel="import">
	<link href="bower_components/font-roboto/roboto.html" rel="import">
	<link href="bower_components/paper-button/paper-button.html" rel="import">
	<link href="bower_components/paper-dialog/paper-dialog-transition.html" rel="import">
	<link href="bower_components/paper-dialog/paper-dialog.html" rel="import">
	<link href="bower_components/paper-input/paper-input.html" rel="import">
  
    <link rel="stylesheet" href="/styles/jobtofit.css" type="text/css">
	
	<title>@yield('title','JobToFit')</title>
	
	@yield('head')
	
</head>

<body>
    @if(Session::get('flash_message'))
		<paper-dialog heading="Warning" transition="paper-dialog-transition-center"> 
			{{ Session::get('flash_message') }}
		</paper-dialog>
	@endif
	
	
    <script>
		function GoTo(pageNum)
		{
			var link = new Array();
			link[0]='/linkedin/login'; 
			link[1]='/jobtofit/login';
			link[2]='/jobtofit/signup';
			link[3]='/jobtofit/logout';
			window.location.assign(link[pageNum]);
		}
		
		function BringUpAboutDialog(appearance)
		{
		  var dialog = document.querySelector('paper-dialog[transition=' + appearance + ']');
		  dialog.toggle();
		}
	</script>
	

    <script type="text/javascript" src="http://gdc.indeed.com/ads/apiresults.js"></script>
                                
	
	@yield('content')
	
	@yield('body')
			
</body>
</html>