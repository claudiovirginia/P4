<?php
	
	class Album extends Eloquent {
	
		 public function book() {
			# Albums belong to many Groups
			return $this->belongsToMany('Group');
		}
	
	}