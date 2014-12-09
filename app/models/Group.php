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

			# If there is a query, search the library with that query
			if($query) {
				echo $txt;
		
            # Eager load tags and author
            	
            #->whereHas('author', function($q) use($query) {
            #    $q->where('name', 'LIKE', "%$query%");
            #})
            #->orWhereHas('tags', function($q) use($query) {
            #    $$q->where('name', 'LIKE', "%$query%");
            #})
            #->orWhere('title', 'LIKE', "%$query%")
            #->orWhere('published', 'LIKE', "%$query%")
            #->get();

            # Note on what `use` means above:
            # Closures may inherit variables from the parent scope.
            # Any such variables must be passed to the `use` language construct.

        }
        # Otherwise, just fetch all books
        else
			$groups = Group::all();
			return $groups;	
    }
	
	}