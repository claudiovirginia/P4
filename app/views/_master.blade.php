<!DOCTYPE html>
<html>
<head>

	<title>@yield('title','Music Library')</title>
	<meta charset="utf-8">
	
	<link href="//netdna.bootstrapcdn.com/bootswatch/3.1.1/flatly/bootstrap.min.css" rel="stylesheet">
	<link rel='stylesheet' href='/css/site.css' type='text/css'>
	
	@yield('head')

</head>
	
<body>
		 
	@if(Session::get('flash_message'))
		<div class='flash-message'>{{ Session::get('flash_message') }}</div>
	@endif

	<a href='/'><img class='logo' src='/images/rock_roll.jpg' alt=Music App logo'></a>
	<br><br><br>
	
	<nav>
		<ul>
			@if(Auth::check())
				<li><a href='/logout'>Log out {{ Auth::user()->email; }}</a></li>
				<li><a href='/'>Home</a></li>
				<li><a href='/album'>All Albums</a></li>
				<li><a href='/album/create'>Add Album</a></li>
				<li><a href='/group'>All Groups</a></li>
				<li><a href='/group/create'>Add Group</a></li>
			@else
				<li><a href='/signup'>Sign up</a> or <a href='/login'>Log in</a></li>
			@endif
		</ul>
	</nav>

	@yield('content')
	@yield('body')
	
</body>
</html>