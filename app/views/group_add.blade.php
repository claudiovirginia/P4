@extends('_master')

@section('title')
	Add Group
@stop

@section('content')

	<h1>Add New Group</h1>

	{{ Form::open(array('url' => '/group/create')) }}
	
		{{ Form::label('groupName','Group Name *') }}
		{{ Form::text('groupName'); }}
				
		{{ Form::label('groupNo', 'Group No *') }}
		{{ Form::text('groupNo'); }}
		
		{{ Form::label('genre', 'Genre') }}
		{{ Form::text('genre'); }}
					
		<br>
		{{ Form::submit('Add'); }}

	{{ Form::close() }}
	
	{{---- CANCEL -----}}
	{{ Form::open(array('url' => '/group/cancel')) }}
		{{ Form::submit('Cancel'); }}
	{{ Form::close() }}

@stop