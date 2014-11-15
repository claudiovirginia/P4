<?php
	
	class Group extends Eloquent {
	
		public function member() {
			# Group belongs to Member
			# Define an inverse one-to-many relationship.
			return $this->belongsTo('Member');
		}
				
		public function album() {
			# Group belong to many albums     
			return $this->belongsToMany('Album');
		}
	
	
	}