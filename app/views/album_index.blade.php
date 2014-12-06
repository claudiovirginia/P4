@extends('_master')

@section('title')
	Albums
@stop

@section('content')

	<h1>Albums</h1>
	<h3>View as HTML</h3>
	
	@if($query)
		<h2>You searched for {{{ $query }}}</h2>
	@endif

	@if(sizeof($albums) == 0)
		No results
	@else
		@foreach($albums as $album)
		<section class='boxed'>

			<h3>Name:  {{ $album['albumName'] }}</h3>
			<h3>Numb:  {{ $album['albumNo'] }}</h3>
			
			<p>	<a href='/album/edit/{{$album['id']}}'>Edit</a></p>
			
		</section>	
			
		@endforeach
	@endif
@stop