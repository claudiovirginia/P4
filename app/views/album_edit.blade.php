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
		</div>
		{{ Form::submit('Save'); }}
	{{ Form::close() }}

	
	{{---- DELETE -----}}
	{{ Form::open(array('url' => '/album/delete')) }}
		{{ Form::hidden('id',$album['id']); }}
		<button onClick='parentNode.submit();return false;'>Delete</button>
	{{ Form::close() }}
	

@stop