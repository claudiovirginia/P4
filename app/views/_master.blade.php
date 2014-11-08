<!DOCTYPE html>
<html>

<head>
	<title>@yield('title','Welcome')</title>
	<meta charset="UTF-8">
	<link rel='stylesheet' href='{{ asset('site.css') }}'>
	@yield('head')
</head>
	
<body>
	 <a href='/'>&larr; Home</a>
	 <br><br><br>
	 @yield('body')
</body>

</html>