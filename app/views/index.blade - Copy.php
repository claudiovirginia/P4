@extends('_master')

@section('title')
	P4 Application
@stop

@section('body')
		<h1>P4 Application - Music Store</h1>
		<div>
		<fieldset>	
			<p>Lorem Ipsum Generator</p>
			<p>In publishing and graphic design, lorem ipsum is a placeholder text commonly used to demonstrate the graphic elements of a document or visual presentation.</p>
			<p>Let's generate some text</p>
			<p>How many paragraphs do you want to generate?<p>
				{{ Form::open(array('url' => '/lorem', 'method' => 'GET')) }}
					{{ Form::label('query', 'Pick a number from the list ? '); }}
					{{ Form::selectRange('number', 1, 10); }}
					{{ Form::submit('Generate Paragraphs'); }}
				{{ Form::close() }}
		</fieldset>		
		</div>
				
		<div>
		<fieldset>	
			<p>Random User Generator</p>
			<p>We are creating random user data for your applications. Like Lorem Ipsum, but for people.</p>
			<p>How many people do you want to generate?<p>
				{{ Form::open(array('url' => '/faker', 'method' => 'GET')) }}
						{{ Form::label('value', 'Pick a number from the list ? '); }}
						{{ Form::selectRange('number', 1, 10); }}
						{{ Form::submit('Generate People'); }}
				{{ Form::close() }}
		</fieldset>
		</div>
					
		<div>
		<fieldset>	
			<p>Add New Group</p>
			{{ Form::open(array('url' => '/add' )) }}
				{{ Form::label('groupName','Group Name') }}
				{{ Form::text('groupName'); }}
				<br>
				{{ Form::label('musicType', 'Music Type') }}
				{{ Form::text('musicType'); }}
				<br>
				{{ Form::label('groupNo', 'Group No') }}
				{{ Form::text('groupNo'); }}
				<br>
				{{ Form::submit('Add A New Group'); }}
			{{ Form::close() }}

		</fieldset>
		</div>
@stop