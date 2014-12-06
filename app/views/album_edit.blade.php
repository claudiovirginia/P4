@extends('_master')

@section('title')
	Edit
@stop

@section('head')
@stop

@section('content')

	<h1>Edit</h1>
	<h2>{{{ $album['albumName'] }}}</h2>

	{{---- EDIT -----}}
	{{ Form::open(array('url' => '/album/edit')) }}

		{{ Form::hidden('id',$album['id']); }}

		<div class='form-group'>
			{{ Form::label('albumName','albumName') }}
			{{ Form::text('albumName',$album['albumName']); }}
			
			{{ Form::label('albumNo','albumNo') }}
			{{ Form::text('albumNo',$album['albumNo']); }}
		</div>
		{{ Form::submit('Save'); }}
	{{ Form::close() }}

	
	{{---- DELETE -----}}
	{{ Form::open(array('url' => '/album/delete')) }}
		{{ Form::hidden('id',$album['id']); }}
		<button onClick='parentNode.submit();return false;'>Delete</button>
	{{ Form::close() }}
	

@stop