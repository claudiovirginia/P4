@extends('_master')

@section('title')
	Members
@stop

@section('content')

	<h2>Members</h2>
		
	@if($query)
		<h2>You searched for {{{ $query }}}</h2>
	@endif

	@if(sizeof($members) == 0)
		No results
	@else
		@foreach($members as $member)
		<section class='boxed'>
			<h3>Group Id: 		{{ $member['group_id'] }}</h3>
			<h3>Mem. Name: 		{{ $member['memberName'] }}</h3>
			<h3>Mem. #:    		{{ $member['memberNo'] }}</h3>
			<h3>Nationality:    {{ $member['nationality'] }}</h3>
						
			<p>	<a href='/member/edit/{{$member['id']}}'>Edit</a></p>
			
		</section>	
			
		@endforeach
	@endif
@stop