@extends('_master')

@section('title')
	Add Member
@stop

@section('content')

	<h1>Add New Member</h1>

	{{ Form::open(array('url' => '/member/create')) }}
	
		{{ Form::label('group_id','Group (It Belongs)') }}
		{{ Form::select('group_id', $groups); }}
	
		{{ Form::label('memberName','Member Name *') }}
		{{ Form::text('memberName'); }}
				
		{{ Form::label('memberNo', 'Member No *') }}
		{{ Form::text('memberNo'); }}
		
		{{ Form::label('nationality', 'Nationality') }}
		{{ Form::text('nationality'); }}
					
		<br>
		{{ Form::submit('Add'); }}

	{{ Form::close() }}

@stop

