@extends('_master')

@section('title')
	Albums
@stop

@section('content')

	<h1>Albums</h1>
	<div>
		View Records as HTML
	</div>
	
	@if($query)
		<h2>You searched for {{{ $query }}}</h2>
	@endif

	@if(sizeof($albums) == 0)
		No results
	@else
		@foreach($albums as $album)
			<h3>{{ $album['albumName'] }} {{ $album['albumNo'] }}</h3>
		@endforeach
	@endif
@stop







