<?php
	
	class Album extends Eloquent {
	
	# The guarded properties specifies which attributes should *not* be mass-assignable
	#protected $guarded = array('id', 'created_at', 'updated_at');

    /**
    * Book belongs to Author
    * Define an inverse one-to-many relationship.
    */
	#public function author() {
    #    return $this->belongsTo('Author');
    #}

    /**
    * Books belong to many Tags
    */
    #public function tags() {
    #    return $this->belongsToMany('Tag');
    #}

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
			$albums = Album::all();
			return $albums;	
    }

		
		
		
	
	}