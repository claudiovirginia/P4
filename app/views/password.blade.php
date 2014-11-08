@extends('_master')

@section('title')
	Welcome To Password Generator
@stop

@section('head')
@stop

@section('body')
		<h4>Password Generator</h4>
		<h4>Total Number of words selected: {{ $number = $query['number'] }}<h4>
		<br>
			This is the info the for the password generated: 	 
		<br><br>
		<div class="boxed">
			@for($i = 0; $i < $number; $i++)
				{{ $query['data'][$i] }}
			@endfor
		</div>				
@stop
