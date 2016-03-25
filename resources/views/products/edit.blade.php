@extends('layout')

@section('content')
	<h1>Edit the Product</h1>

	<form method="POST" action="/products/{{$product->id}}">
		{{ method_field('PATCH') }}
		<div class="form-group">
			<textarea name="title" class="form-control">{{$product->title}}</textarea>
		</div>
		<div class="form-group">
			<button type="submit" class="btn btn-primary">Update Products</button>
		</div>
	</form>
@stop