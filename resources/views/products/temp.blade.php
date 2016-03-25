@extends('layout')

@section('content')
	<div class="row">
		<div class="col-md-6 col-md-offset-3">

			<h1>Products</h1>

			<!-- @if( count ($categories) )
				@foreach ($categories AS $category)
					<li>$category->name</li>
				@endforeach
			@else
				<li>No values</li>
			@endif
 -->
			

			<!-- <ul class="list-group">
				@foreach ($category->products AS $product)
					<li class="list-group-item">
						{{ $product->title}} - {{$product->description}} - {{$product->price}}
						<a href="#" class="pull-right">{{$product->category_id}}</a>
					</li>

				@endforeach		

			</ul>

			<hr>

			<h3>Add new Products</h3>
			<form method="POST" action="/products/{{$category->id}}/product">
				{{ csrf_field() }}
				<div class="form-group">
					<textarea name="title" class="form-control">{{old('title')}}</textarea>
				</div>

				<div class="form-group">
					<button type="submit" class="btn btn-primary">Add Products</button>
				</div>
			</form>

			@if (count($errors))
				<ul>
					@foreach ($errors->all() AS $error)
						<li>{{$error}}
					@endforeach
				</ul>
			@endif -->
		</div>
	</div>
@stop