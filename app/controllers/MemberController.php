<?php

class MemberController extends \BaseController {

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
		return View::make('member_search');
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
    	return View::make('member_add')->with('groups',$groups);
	}
		
	
	/**
	* Process the "Add a album form"
	* @return Redirect
	*/
	public function postCreate() {
    
	    #rules for validation
		$rules = array('group_id' => 'required', 'memberName' => 'required', 'memberNo' => 'required');
	    $validator = Validator::make(Input::all(), $rules);
	    if($validator->fails()) {
			return Redirect::to('/member/create')
				->with('flash_message', 'Creation of an Member failed (some fields are mandatory);')
				->withInput()
				->withErrors($validator);
		}
		
	
		# Instantiate the album model
		$member = new Member();

		$member->group_id   = Input::get('group_id');
		$member->memberName = Input::get('memberName');
		$member->memberNo   = Input::get('memberNo');
		$member->nationality = Input::get('nationality');
		$member->save();
		
		return Redirect::action('MemberController@getIndex')->with('flash_message','Your member has been added.');
	}


	/**
	* Display all members
	* @return View
	*/
	public function getIndex() {
		# Format and Query are passed as Query Strings
		$format = Input::get('format', 'html');
		$query  = Input::get('query');
		$members = Member::search($query); #calling Member.php
		#print_r($query);
		
		if($format == 'html') {
			return View::make('member_index')
				->with('members', $members)
				->with('query', $query);
		}
	}



	/**
	* Show the "Edit an member form"
	* @return View
	*/
	public function getEdit($id) {

		try {
		    $member = Member::findOrFail($id);
			
			$groups = Array();
			$collection = Group::all();
			foreach($collection as $group) {
				$groups[$group->groupNo] = $group->groupName;
			}
			
		}
		catch(exception $e) {
		    return Redirect::to('/member')
				->with('flash_message', 'Member not found. Try another member to be edited');
		}

    	return View::make('member_edit')
				->with('member', $member)
				->with('groups', $groups);
 	}


	/**
	* Process the "Edit a album form"
	* @return Redirect
	*/
	public function postEdit() {

		try {
	        $member = Member::findOrFail(Input::get('id'));
	    }
	    catch(exception $e) {
	        return Redirect::to('/member')
				->with('flash_message', 'Member not found');
	    }
		$member->group_id   = Input::get('group_id');
	    $member->memberName = Input::get('memberName');
		$member->memberNo   = Input::get('memberNo');
		$member->nationality = Input::get('nationality');
		$member->save();

	   	return Redirect::action('MemberController@getIndex')
			->with('flash_message', 'Your changes have been saved.');

	}


	/**
	* Process album deletion
	*
	* @return Redirect
	*/
	public function postDelete() {

		try {
	        $member = Member::findOrFail(Input::get('id'));
	    }
	    catch(exception $e) {
	        return Redirect::to('/member/')->with('flash_message', 'Could not delete member - not found.');
	    }

	    Member::destroy(Input::get('id'));

	    return Redirect::to('/member/')->with('flash_message', 'Member deleted.');

	}


	
	/**
	* Process a album search
	* Called w/ Ajax
	**/
	public function postSearch() {
		#TBD
	}
	


}