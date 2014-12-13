<?php
	
	class Member extends Eloquent {
	
	/*
    * Member belongs to Groups
    * Define an inverse one-to-many relationship.
    */
	public function group() {
		return $this->belongsTo('Group');
	}
		
	
    /**
    * 
    * 
    */
    public static function search($query) {
		$members = Member::all();
		return $members;	
    }

	
	}