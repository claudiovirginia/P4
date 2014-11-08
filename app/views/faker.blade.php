@extends('_master')

@section('title')
	Welcome To User
@stop

@section('head')
@stop

@section('body')
		<h4>User Generator</h4>
		<h4>Total Number of users selected: {{ $numberOfUsers = $query['numberOfUsers'] }}<h4>
		<br>
			This is the info the for the users generated: 	 
		<br><br>
		<div class="boxed">
			@for($i = 0; $i < $numberOfUsers; $i++)
				{{ $query['users'][$i] }}
			@endfor
		</div>				
@stop