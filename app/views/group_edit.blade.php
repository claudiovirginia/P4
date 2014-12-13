@extends('_master')

@section('title')
	Edit
@stop

@section('head')
@stop

@section('content')

	<h2>Edit the following group -> {{{ $group['groupName'] }}}</h2>

	{{---- EDIT -----}}
	{{ Form::open(array('url' => '/group/edit')) }}

		{{ Form::hidden('id',$group['id']); }}

		<div class='form-group'>
			    	
			{{ Form::label('groupName','Group Name *') }}
			{{ Form::text('groupName', $group['groupName']); }}
			
			{{ Form::label('groupNo','Group No *') }}
			{{ Form::text('groupNo', $group['groupNo']); }}
			
			{{ Form::label('genre', 'Genre') }}
			{{ Form::text('genre', $group['genre']); }}
			
		</div>
			{{ Form::submit('Save'); }}
	{{ Form::close() }}

	
	{{---- DELETE -----}}
	{{ Form::open(array('url' => '/group/delete')) }}
		{{ Form::hidden('id',$group['id']); }}
		<button onClick='parentNode.submit();return false;'>Delete</button>
	{{ Form::close() }}
	
	{{---- CANCEL -----}}
	{{ Form::open(array('url' => '/group/cancel')) }}
		{{ Form::submit('Cancel'); }}
	{{ Form::close() }}

@stop