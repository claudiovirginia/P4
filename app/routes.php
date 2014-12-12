<?php

/**
 Here I am definign the routes for the following tables:
	(1) Album
	(2) Group
	(3) Member
*/
Route::get ('/album', 			'AlbumController@getIndex');
Route::get ('/album/edit/{id}', 'AlbumController@getEdit');
Route::post('/album/edit', 		'AlbumController@postEdit');
Route::get ('/album/create', 	'AlbumController@getCreate');
Route::post('/album/create', 	'AlbumController@postCreate');
Route::post('/album/delete', 	'AlbumController@postDelete');
Route::post('/album/cancel', 	'AlbumController@postCancel');


Route::get ('/group', 			'GroupController@getIndex');
Route::get ('/group/edit/{id}', 'GroupController@getEdit');
Route::post('/group/edit', 		'GroupController@postEdit');
Route::get ('/group/create', 	'GroupController@getCreate');
Route::post('/group/create', 	'GroupController@postCreate');
Route::post('/group/delete', 	'GroupController@postDelete');
Route::post('/group/cancel', 	'GroupController@postCancel');


Route::get ('/member', 			 'MemberController@getIndex');
Route::get ('/member/edit/{id}', 'MemberController@getEdit');
Route::post('/member/edit', 	 'MemberController@postEdit');
Route::get ('/member/create', 	 'MemberController@getCreate');
Route::post('/member/create', 	 'MemberController@postCreate');
Route::post('/member/delete', 	 'MemberController@postDelete');
Route::post('/member/cancel', 	 'MemberController@postCancel');


/**
* User
* (Explicit Routing)
*/
Route::get('/signup',  'UserController@getSignup');
Route::get('/login',   'UserController@getLogin');
Route::post('/signup', 'UserController@postSignup');
Route::post('/login',  'UserController@postLogin');
Route::get('/logout',  'UserController@getLogout');


## Ajax examples
Route::get ('/album/search', 	'AlbumController@getSearch');
Route::post('/album/search',	'AlbumController@postSearch');

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
