<?php

class AlbumController extends \BaseController {

	public function __construct() {

		# Make sure BaseController construct gets called
		parent::__construct();
		$this->beforeFilter('auth', array('except' => 'getIndex'));
	}


	/**
	* Process the searchform
	* @return View
	*/
	public function getSearch() {
		return View::make('album_search');
	}

		
	/**
	* Show the "Add a albumform"
	* @return View
	*/
	public function getCreate() {

		//$authors = Author::getIdNamePair();
    	//return View::make('book_add')->with('authors',$authors);
		return View::make('album_add');
	}
	
	/**
	* Process the "Add a album form"
	* @return Redirect
	*/
	public function postCreate() {

		# Instantiate the album model
		$album = new Album();

		$album->albumName = Input::get('albumName');
		$album->albumNo = Input::get('albumNo');
		$album->save();

		#return Redirect::to('/');
		# Magic: Eloquent
		#$album->save();
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
	* Show the "Edit a album form"
	* @return View
	*/
	public function getEdit($id) {

		try {
		    $album = Album::findOrFail($id);
		}
		catch(exception $e) {
		    return Redirect::to('/album')
				->with('flash_message', 'Album not found');
		}

    	return View::make('album_edit')
				->with('album', $album);
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

	    $album->albumName = Input::get('albumName');
		$album->albumNo = Input::get('albumNo');
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