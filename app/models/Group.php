<?php
	
	class Group extends Eloquent {
					
		public function album() {
			# Group has many albums
		    # Define a one-to-many relationship.  
			return $this->hasMany('Album');
		}
	    
	
		public static function validataData() {
			#rules for validation
			$rules = array('groupName' => 'required', 'groupNo' => 'required');
			return $validator = Validator::make(Input::all(), $rules);
		}
	
	
		 /**
		* Search among books, authors and tags
		* @return Collection
		*/
		public static function search($query) {
			$groups = Group::all();
			return $groups;	
		}
	
	}