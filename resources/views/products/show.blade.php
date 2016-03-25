@extends('layout')

@section('content')
	<div class="container">
		@if( count ($categories) )			
			@foreach ($categories AS $category)
				<div class="row">
					<hr>
					<h2 class="text-primary">{{$category->name}}</h2>
					@foreach( $category->products AS $product )
						<div class="col-md-4">
							<div class="thumnail">
								<img src="{{route('getimage', $product->filename)}}" class="img-responsive" >
								<p class="text-info text-center">{{$product->title}} {{$category->name}} - {{$product->description}}</p>	
								<p class="text-danger text-center">${{$product->price}}</p>		
							</div>
							<form method="POST" action="/products/purchase/{{$product->id}}">	
								{{ csrf_field() }}				
								<div class="form-group text-center">
									<button type="submit" class="btn btn-primary">Buy</button>
								</div>
							</form>										
						</div>						
					@endforeach	
				</div>
			@endforeach
		@endif

		@if (count($errors))
			<ul>
			@foreach ($errors->all() AS $error)
				<li>{{$error}}
			@endforeach
			</ul>
		@endif 
	
@stop

