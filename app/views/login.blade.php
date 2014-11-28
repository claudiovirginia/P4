@extends('_master')

@section('title')
	Log in
@stop

@section('content')

<h1>Log in</h1>

{{ Form::open(array('url' => '/login')) }}
	<br>
    {{ Form::label('email') }}
    {{ Form::text('email') }}
	<br>
    {{ Form::label('password') }}
    {{ Form::password('password') }}

    {{ Form::submit('Submit') }}

{{ Form::close() }}

@stop