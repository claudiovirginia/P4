@extends('_master')

@section('title')
	Edit
@stop

@section('head')
@stop

@section('content')
	<h2>Edit the following album -> {{{ $album['albumName'] }}}</h2>
	{{---- EDIT -----}}
	{{ Form::open(array('url' => '/album/edit')) }}
		{{ Form::hidden('id',$album['id']); }}
		<div class='form-group'>
			{{ Form::label('albumName','Album Name') }}
			{{ Form::text('albumName', $album['albumName']); }}
			
			{{ Form::label('albumNo','Album No') }}
			{{ Form::text('albumNo', $album['albumNo']); }}
			
			{{ Form::label('genre', 'Album Genre') }}
			{{ Form::text('genre', $album['genre']); }}
			
			{{ Form::label('group_id','Group (It Belongs)') }}
			{{ Form::select('group_id', $groups, $album->group_id); }}
		</div>
			{{ Form::submit('Save'); }}
	{{ Form::close() }}
	
	{{---- DELETE -----}}
	{{ Form::open(array('url' => '/album/delete')) }}
		{{ Form::hidden('id',$album['id']); }}
		<button onClick='parentNode.submit();return false;'>Delete</button>
	{{ Form::close() }}
	
	{{---- CANCEL -----}}
	{{ Form::open(array('url' => '/album/cancel')) }}
		{{ Form::submit('Cancel'); }}
	{{ Form::close() }}
@stop