@extends('_master')

@section('title')
	Edit
@stop

@section('head')
@stop

@section('content')

	<h2>Edit the following member -> {{{ $member['memberName'] }}}</h2>
	
	
	
	{{---- EDIT -----}}
	{{ Form::open(array('url' => '/member/edit')) }}

		{{ Form::hidden('id',$member['id']); }}
		
		
		<div class='form-group'>
				    	
			{{ Form::label('memberName','Member Name') }}
			{{ Form::text('memberName', $member['memberName']); }}
			
			{{ Form::label('memberNo','Member No') }}
			{{ Form::text('memberNo', $member['memberNo']); }}
			
			{{ Form::label('nationality', 'Nationality') }}
			{{ Form::text('nationality', $member['nationality']); }}
			
			{{ Form::label('group_id','Group (It Belongs)') }}
			{{ Form::select('group_id', $groups, $member->group_id); }}
									
		</div>
			{{ Form::submit('Save'); }}
	{{ Form::close() }}

	
	{{---- DELETE -----}}
	{{ Form::open(array('url' => '/member/delete')) }}
		{{ Form::hidden('id',$member['id']); }}
		<button onClick='parentNode.submit();return false;'>Delete</button>
	{{ Form::close() }}
	

@stop

