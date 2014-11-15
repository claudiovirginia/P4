<?php
	
	class Member extends Eloquent {
	
		public function group() {
        # members belong to a group
        # Define a one-to-many relationship.
        return $this->hasMany('Group');
    }
	}