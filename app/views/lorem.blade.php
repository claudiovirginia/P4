@extends('_master')

@section('title')
	Welcome To Lorem
@stop

@section('head')
@stop


@section('body')
	 <h4>Lorem Ipsum page</h4>
	 <h4>You have selected the following number of paragraphs: {{{ $number }}}</h4>
	 <br>
	 <h4>Here is the data:</h4>
	 <br><br>
	 <div class="boxed">
		{{ print_r( $query) }}
	 </div>					
@stop
