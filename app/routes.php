<?php

# /app/routes.php
Route::get('/debug', function() {

    echo '<pre>';

    echo '<h1>environment.php</h1>';
    $path   = base_path().'/environment.php';

    try {
        $contents = 'Contents: '.File::getRequire($path);
        $exists = 'Yes';
    }
    catch (Exception $e) {
        $exists = 'No. Defaulting to `production`';
        $contents = '';
    }

    echo "Checking for: ".$path.'<br>';
    echo 'Exists: '.$exists.'<br>';
    echo $contents;
    echo '<br>';

    echo '<h1>Environment</h1>';
    echo App::environment().'</h1>';

    echo '<h1>Debugging?</h1>';
    if(Config::get('app.debug')) echo "Yes"; else echo "No";

    echo '<h1>Database Config</h1>';
    print_r(Config::get('database.connections.mysql'));

    echo '<h1>Test Database Connection</h1>';
    try {
        $results = DB::select('SHOW DATABASES;');
        echo '<strong style="background-color:green; padding:5px;">Connection confirmed</strong>';
        echo "<br><br>Your Databases:<br><br>";
        print_r($results);
    } 
    catch (Exception $e) {
        echo '<strong style="background-color:crimson; padding:5px;">Caught exception: ', $e->getMessage(), "</strong>\n";
    }

    echo '</pre>';

});


#test database
Route::get('mysql-test', function() {

    # Print environment
    echo 'Environment: '.App::environment().'<br>';

    # Use the DB component to select all the databases
    $results = DB::select('SHOW DATABASES;');

    # If the "Pre" package is not installed, you should output using print_r instead
    echo Pre::render($results);

});



#get-environment
Route::get('/get-environment',function() {

    echo "Environment: ".App::environment();

});

#trigger-error
Route::get('/trigger-error',function() {

    # Class Foobar should not exist, so this should create an error
    $foo = new Foobar;

});



#homepage
Route::get('/', function() {
	return View::make('index');
});


#lorem ipsum page
Route::get('/lorem', function() {
	
	//getting the value from the dropdown laravel form
	$numberParagraphs = Input::get('number');
	
	//generate the paragraphs
	$generator = new Badcow\LoremIpsum\Generator();
	$paragraphs = $generator->getParagraphs($numberParagraphs);
	
	//passing this array to the view		
	return View::make('lorem')
		->with('query', implode('<p>', $paragraphs))
		->with('number', $numberParagraphs);
});


#user generator page
Route::get('/faker', function() {

	//getting the value from the dropdown laravel form
	$value = Input::get('number');
				
	//I am using a class to generate the records
	$GetUser = new GetUser($value);
	$users = $GetUser->getInfo();
			
	//I am storing the data in this array
	$data['numberOfUsers'] = $value;
	$data['users'] = $users;
		
	//passing this array to the view		
	return View::make('faker')
		->with('query', $data);
});


#password generator page
Route::get('/password', function() {

	//getting the value from the dropdown laravel form
	$value = Input::get('number');
		
	//I am using a class to generate a password
	$Password = new GetPassword($value);
	$data = $Password->getPassword();	
			
	$data['number'] = $value;
	$data['data'] = $data;
	
	//passing this array to the view		
	return View::make('password')
		->with('query', $data);
	
});
