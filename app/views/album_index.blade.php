@extends('_master')

@section('title')
	Albums
@stop

@section('content')

	<h2>Albums</h2>
		
	@if($query)
		<h2>You searched for {{{ $query }}}</h2>
	@endif

	@if(sizeof($albums) == 0)
		No results
	@else
		@foreach($albums as $album)
		<section class='boxed'>
			<h3>Group Id:   {{ $album['group_id'] }}</h3>
			<h3>Album Name: {{ $album['albumName'] }}</h3>
			<h3>Album #:    {{ $album['albumNo'] }}</h3>
			<h3>Genre:      {{ $album['genre'] }}</h3>
						
			<p><a href='/album/edit/{{$album['id']}}'>Edit</a></p>
		</section>	
			
		@endforeach
	@endif
@stop