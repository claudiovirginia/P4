<?php

/**
* Album (Explicit Routing)
*/
Route::get ('/album', 			'AlbumController@getIndex');
Route::get ('/album/edit/{id}', 'AlbumController@getEdit');
Route::post('/album/edit', 		'AlbumController@postEdit');
Route::get ('/album/create', 	'AlbumController@getCreate');
Route::post('/album/create', 	'AlbumController@postCreate');
Route::post('/album/delete', 	'AlbumController@postDelete');

## Ajax examples
Route::get ('/album/search', 	'AlbumController@getSearch');
Route::post('/album/search',	'AlbumController@postSearch');








#login get
Route::get('/login',
    array(
        'before' => 'guest',
        function() {
            return View::make('login');
        }
    )
);

#login post
Route::post('/login', 
    array(
        'before' => 'csrf', 
        function() {

            $credentials = Input::only('email', 'password');

            if (Auth::attempt($credentials, $remember = true)) {
                return Redirect::intended('/')->with('flash_message', 'Welcome Back!');
            }
            else {
                return Redirect::to('/login')->with('flash_message', 'Log in failed; please try again.');
            }
            return Redirect::to('login');
        }
    )
);

#logout 
Route::get('/logout', function() {

    # Log out
    Auth::logout();

    # Send them to the homepage
    return Redirect::to('/');

});


#signup get
Route::get('/signup',
    array(
        'before' => 'guest',
        function() {
            return View::make('signup');
        }
    )
);

#signup post
Route::post('/signup', 
    array(
        'before' => 'csrf', 
        function() {

            $user = new User;
            $user->email    = Input::get('email');
            $user->password = Hash::make(Input::get('password'));

            # Try to add the user 
            try {
                $user->save();
            }
            # Fail
            catch (Exception $e) {
                return Redirect::to('/signup')->with('flash_message', 'Sign up failed; please try again.')->withInput();
            }

            # Log the user in
            Auth::login($user);

            return Redirect::to('/')->with('flash_message', 'Welcome to Foobooks!');

        }
    )
);


#add group
Route::post('/add', function() {

	# Instantiate a new Group model class
    $group = new Group();
	
	#set the data
    $group->groupNo = Input::get('groupNo');
	$group->groupName = Input::get('groupName');
	$group->musicType = Input::get('musicType');
	
	#save record to DB
	$group->save();
	
	#return 'A new group has been added! Check your database to see...';
	return Redirect::to('/');
});


#practice-creating
Route::get('/practice-creating', function() {

    # Instantiate a new Book model class
    $group = new Group();

    # Set 
    $group->groupNo = 101;
    $group->groupName = 'Pat Metheny';
    $group->musicType = 'Jazz';
   

    # This is where the Eloquent ORM magic happens
    $group->save();

    return 'A new group has been added! Check your database to see...';

});

#practice-reading
Route::get('/practice-reading', function() {

    # The all() method will fetch all the rows from a Model/table
    $group = Group::all();

    # Make sure we have results before trying to print them...
    if($group->isEmpty() != TRUE) {

        # Typically we'd pass $books to a View, but for quick and dirty demonstration, let's just output here...
        foreach($group as $group) {
            echo $group->groupNo;
			echo $group->musicType;
			echo $group->groupName.'<br>';
        }
    }
    else {
        return 'No books found';
    }

});

#practice updating
Route::get('/practice-updating', function() {

    # First get a book to update
    $group = Group::where('musicType', 'LIKE', '%Jazz%')->first();

    # If we found the book, update it
    if($group) {

        # Give it a different title
        $group->musicType = 'Jazz Rock';

        # Save the changes
        $group->save();

        return "Update complete; check the database to see if your update worked...";
    }
    else {
        return "group not found, can't update.";
    }

});

#practice-deleting
Route::get('/practice-deleting', function() {

    # First get a book to delete
    $group = Group::where('groupNo', 'LIKE', '100')->first();

    # If we found the book, delete it
    if($group) {

        # Goodbye!
        $group->delete();

        return "Deletion complete; check the database to see if it worked...";

    }
    else {
        return "Can't delete - group not found.";
    }

});



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
