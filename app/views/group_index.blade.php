@extends('_master')

@section('title')
	Groups
@stop

@section('content')

	<h2>Groups</h2>
		
	@if($query)
		<h2>You searched for {{{ $query }}}</h2>
	@endif

	@if(sizeof($groups) == 0)
		No results
	@else
		@foreach($groups as $group)
		<section class='boxed'>
			<h3>Name:  {{ $group['groupName'] }}</h3>
			<h3>Numb:  {{ $group['groupNo'] }}</h3>
			<h3>Genre: {{ $group['genre'] }}</h3>
			<p>	<a href='/group/edit/{{$group['id']}}'>Edit</a></p>
			
		</section>	
			
		@endforeach
	@endif
@stop