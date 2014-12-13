<?php
	
	class Album extends Eloquent {
	
	/*
    * Album belongs to Groups
    * Define an inverse one-to-many relationship.
    */
	public function group() {
		return $this->belongsTo('Group');
	}
		
	#validate data for required fields	
	public static function validataData() {
		#rules for validation
		$rules = array('albumName' => 'required', 'albumNo' => 'required');
		return $validator = Validator::make(Input::all(), $rules);
	}		
		
	
    /**
    * Search for all albums
    * @return Collection
    */
    public static function search($query) {

		$albums = Album::all();
		return $albums;	
    }

}