<?php

class AlbumController extends \BaseController {

	public function __construct() {

		# Make sure BaseController construct gets called
		parent::__construct();
		$this->beforeFilter('auth', array('except' => 'getIndex'));
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
	* Process the searchform
	* @return View
	*/
	public function getSearch() {
		return View::make('album_search');
	}

	/**
	* Process the Cancel Button
	* @return View
	*/
	public function postCancel() {
		return Redirect::to('/album');
	}
		
	/**
	* Show the "Add a album form"
	* @return View
	*/
	public function getCreate() {
	
		$groups = Array();
		$collection = Group::all();
		foreach($collection as $group) {
			$groups[$group->groupNo] = $group->groupName;
		}
    	return View::make('album_add')->with('groups',$groups);
	}
	
	/**
	* Process the "Add a album form"
	* @return Redirect
	*/
	public function postCreate() {
    
	    #rules for validation
		$rules = array('group_id' => 'required', 'albumName' => 'required', 'albumNo' => 'required');
	    $validator = Validator::make(Input::all(), $rules);
	    if($validator->fails()) {
			return Redirect::to('/album/create')
				->with('flash_message', 'Creation of an Album failed (some fields are mandatory);')
				->withInput()
				->withErrors($validator);
		}
	
		# Instantiate the album model
		$album = new Album();
		$album->group_id  = Input::get('group_id');
		$album->albumName = Input::get('albumName');
		$album->albumNo   = Input::get('albumNo');
		$album->genre     = Input::get('genre');
		$album->save();
		
		return Redirect::action('AlbumController@getIndex')->with('flash_message','Your album has been added.');
	}


	/**
	* Display all albums
	* @return View
	*/
	public function getIndex() {
		# Format and Query are passed as Query Strings
		$format = Input::get('format', 'html');
		$query  = Input::get('query');
		$albums = Album::search($query); #calling Album.php
		#print_r($query);
		
		if($format == 'html') {
			return View::make('album_index')
				->with('albums', $albums)
				->with('query', $query);
		}
	}



	/**
	* Show the "Edit an album form"
	* @return View
	*/
	public function getEdit($id) {

		try {
		    $album = Album::findOrFail($id);
			
			$groups = Array();
			$collection = Group::all();
			foreach($collection as $group) {
				$groups[$group->groupNo] = $group->groupName;
			}
			
		}
		catch(exception $e) {
		    return Redirect::to('/album')
				->with('flash_message', 'Album not found. Try another album to be edited');
		}

    	return View::make('album_edit')
				->with('album', $album)
				->with('groups', $groups);
 	}


	/**
	* Process the "Edit a album form"
	* @return Redirect
	*/
	public function postEdit() {

		try {
	        $album = Album::findOrFail(Input::get('id'));
	    }
	    catch(exception $e) {
	        return Redirect::to('/album')
				->with('flash_message', 'Album not found');
	    }
		$album->group_id  = Input::get('group_id');
	    $album->albumName = Input::get('albumName');
		$album->albumNo   = Input::get('albumNo');
		$album->genre     = Input::get('genre');
		$album->save();

	   	return Redirect::action('AlbumController@getIndex')
			->with('flash_message', 'Your changes have been saved.');

	}


	/**
	* Process album deletion
	*
	* @return Redirect
	*/
	public function postDelete() {

		try {
	        $album = Album::findOrFail(Input::get('id'));
	    }
	    catch(exception $e) {
	        return Redirect::to('/album/')->with('flash_message', 'Could not delete album - not found.');
	    }

	    Album::destroy(Input::get('id'));

	    return Redirect::to('/album/')->with('flash_message', 'Album deleted.');

	}


	
	/**
	* Process a album search
	* Called w/ Ajax
	**/
	public function postSearch() {
		$test = "I am here";
		echo $test;
			
		if(Request::ajax()) {
		echo $test;
		
			$query  = Input::get('query');
			echo $query;

			# We're demoing two possible return formats: JSON or HTML
			$format = Input::get('format');

			# Do the actual query
	        $albums  = Album::search($query);

	        
	        # Otherwise, loop through the results building the HTML View we'll return
	        if($format == 'html') {
			echo $test;
			
		        $results = '';
				foreach($albums as $album) {
					# Created a "stub" of a view called book_search_result.php; all it is is a stub of code to display a book
					# For each book, we'll add a new stub to the results
					$results .= View::make('album_search_result')->with('album', $album)->render();
				}

				# Return the HTML/View to JavaScript...
				return $results;
			}
		}
	}
	


}