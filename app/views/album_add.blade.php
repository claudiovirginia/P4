@extends('_master')

@section('title')
	Add a new group
@stop

@section('content')

	<h1>Add a new Album</h1>

	{{ Form::open(array('url' => '/album/create')) }}
	
		<br>
		{{ Form::label('albumName','Album Name') }}
		{{ Form::text('albumName'); }}
			
		<br>
		{{ Form::label('albumNo', 'Album No') }}
		{{ Form::text('albumNo'); }}
		
		<br>
		{{ Form::submit('Add'); }}

	{{ Form::close() }}

@stop