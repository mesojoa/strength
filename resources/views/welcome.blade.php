@extends('layout')

@section('content')
	<h1>The Welcome page goes here</h1>
	@if (empty($people))
    		There are no people.
    	@else
    		Something else.
    	@endif
        @foreach($people AS $person)
        	<li>{{ $person }}</li>
        @endforeach

@stop