<?php

class DebugController extends BaseController {

	/**
	*
	*/
	public function __construct() {

		# Make sure BaseController construct gets called
		parent::__construct();

	}

	/**
	* Special method that gets triggered if the user enters a URL for a method that does not exist
	*
	* @return String
	*/
	public function missingMethod($parameters = array()) {

		return 'Method "'.$parameters[0].'" not found';

	}
	

	/**
	* Trigger an error to test debug display settings
	* http://localhost/debug/trigger-error
	*
	* @return Exception
	*/
	public function getTriggerError() {

		# Class Foobar should not exist, so this should create an error
		$foo = new Foobar;

	}


	/**
	* Print all available routes
	* http://localhost/debug/routes
	*
	* @return String
	*/
	public function getRoutes() {

		$routeCollection = Route::getRoutes();

		foreach ($routeCollection as $value) {
	    	echo "<a href='/".$value->getPath()."' target='_blank'>".$value->getPath()."</a><br>";
		}

	}
	
}