@extends('layouts.master')

@section('content')

	@foreach($projects as $project)
	    <a href="project/{{ $project->id }}"><h3>{{ $project->title }}</h3></a>
	    <p>Contact: {{ $project->contact }}	|	Fee: {{ $project->fee }}	|	Duration: {{ $project->duration }}</p>
	    <p>{{ str_limit(strip_tags($project->description), 60) }}</p>
	    <hr>
	@endforeach

	{{ $projects->links() }}
	
@stop