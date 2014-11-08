<!doctype html>
<html lang="en">
<head>
	<title>Welcome</title>
	<meta charset="UTF-8">
	<link rel='stylesheet' href='{{ asset('site.css') }}'>
</head>
<body>
	
	 <br>
		Total Number of users selected {{ $numberOfUsers = $query['numberOfUsers'] }}
	 <br>
		This is the info the for the users generated: 	 
	 <br><br>
		 @for($i = 0; $i < $numberOfUsers; $i++)
           {{ $query['users'][$i] }}
         @endfor
					
 </body>
</html>

