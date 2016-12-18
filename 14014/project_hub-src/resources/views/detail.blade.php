@extends('layouts.master')

@section('content')

	<h1>{{ $project->title }}</h1>
	<p class="lead">{{ $project->fee }}</p>
	<p><b>Posted:</b> {{ $project->created_at }}</p>
	<p><b>Duration:</b> {{ $project->duration }}</p>
	<p>
		<b>Job Description</b>
		<br>
		<p>
			{!! $project->description !!}		
		</p>
	</p>
	<p>
	<b>How to apply:</b> Contact {{ $project->contact }}</p>
	</p>
	
@stop
