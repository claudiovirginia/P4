<?php

class GroupController extends \BaseController {

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
		return View::make('group_search');
	}

		
	/**
	* Show the "Add a album form"
	* @return View
	*/
	public function getCreate() {
	
		$albums = Array();
		$collection = Album::all();
		foreach($collection as $album) {
			$albums[$album->albumNo] = $album->albumName;
		}
		return View::make('group_add')->with('albums',$albums);
	}
	
		
	/**
	* Process the "Add a Group Form"
	* @return Redirect
	*/
	public function postCreate() {
				
		#call Group.php to validata data
		$validator = Group::validataData(); 
		if($validator->fails()) {
			return Redirect::to('/group/create')
				->with('flash_message', 'Creation of a Group failed (some fields are mandatory)')
				->withInput()->withErrors($validator);
		}

		
		# Instantiate the album model
		$group = new Group();
		$group->groupName = Input::get('groupName');
		$group->groupNo = Input::get('groupNo');
		$group->genre = Input::get('genre');
		$group->save();
		
		return Redirect::action('GroupController@getIndex')->with('flash_message','Your group has been added.');
	}


	/**
	* Display all groups
	* @return View
	*/
	public function getIndex() {
		# Format and Query are passed as Query Strings
		$format = Input::get('format', 'html');
		$query  = Input::get('query');
		$groups = Group::search($query); #calling group.php
		#print_r($query);
		
		if($format == 'html') {
			return View::make('group_index')
				->with('groups', $groups)
				->with('query', $query);
		}
	}



	/**
	* Show the "Edit an group form"
	* @return View
	*/
	public function getEdit($id) {

		#call Group.php to validata data
		#$validator = Group::validataData(); 
		#if($validator->fails()) {
		#	return Redirect::to('/group/edit')
		#	->with('flash_message', 'Saving of a Group failed (some fields are mandatory)')
		#	->withInput()->withErrors($validator);
		#}	
		
		try {
		    $group = Group::findOrFail($id);
		}
		catch(exception $e) {
		    return Redirect::to('/group')->with('flash_message', 'group not found. Try another group to be edited');
		}
		
		#$validator = Group::validataData();
		#if($validator->fails()) {
			#return Redirect::to('/group/edit')
			#->with('flash_message', 'Saving of a Group failed (some fields are mandatory)')
			#->withInput()->withErrors($validator);
		#} 
		return View::make('group_edit')->with('group', $group);
	}
	

	/**
	* Process the "Edit a group form"
	* @return Redirect
	*/
	public function postEdit() {

		try {
	        $group = Group::findOrFail(Input::get('id'));
	    }
	    catch(exception $e) {
	        return Redirect::to('/group')
				->with('flash_message', 'Group not found');
	    }
		$group->groupName = Input::get('groupName');
		$group->groupNo = Input::get('groupNo');
		$group->genre = Input::get('genre');
		$group->save();

	   	return Redirect::action('GroupController@getIndex')->with('flash_message', 'Your changes have been saved.');

	}


	/**
	* Process group deletion
	*
	* @return Redirect
	*/
	public function postDelete() {

		try {
	        $group = Group::findOrFail(Input::get('id'));
	    }
	    catch(exception $e) {
	        return Redirect::to('/group/')->with('flash_message', 'Could not delete group - not found.');
	    }

	    Group::destroy(Input::get('id'));
	    return Redirect::to('/group/')->with('flash_message', 'Group deleted.');

	}


	/**
	* Process a group search
	* Called w/ Ajax
	**/
	public function postSearch() {
		#TBD
		
	}

}