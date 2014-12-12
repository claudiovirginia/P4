@extends('_master')

@section('title')
	Add Album
@stop

@section('content')

	<h1>Add New Album</h1>

	{{ Form::open(array('url' => '/album/create')) }}
	
		{{ Form::label('group_id','Group (It Belongs)') }}
		{{ Form::select('group_id', $groups); }}
	
		{{ Form::label('albumName','Album Name *') }}
		{{ Form::text('albumName'); }}
				
		{{ Form::label('albumNo', 'Album No *') }}
		{{ Form::text('albumNo'); }}
		
		{{ Form::label('genre', 'Genre') }}
		{{ Form::text('genre'); }}
				
		{{ Form::submit('Add'); }}

	{{ Form::close() }}

	{{ Form::open(array('url' => '/album/cancel')) }}
		{{ Form::submit('Cancel'); }}
	{{ Form::close() }}
	
@stop

