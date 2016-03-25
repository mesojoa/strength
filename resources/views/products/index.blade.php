@extends('layout')

@section('content')
	<h1>Product Categories</h1>
	
	@foreach ($categories AS $category)
		<div>
			<a href="products/{{ $category->id }}"> {{$category->name}} </a>
		</div>
	@endforeach
@stop

