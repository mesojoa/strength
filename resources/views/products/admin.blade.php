@extends('layout')

@section('content')
	<div class="container">
		<h1>Products</h1>
		<table class="table table-striped">
			<thead>
				<tr>
					<th>OS (Model / Color)</th>
					<th>Price</th>
					<th>Image</th>
					<th colspan="2" class="text-center">Action</th>
				</tr>
			</thead>
			<tbody>
			@if( count ($categories) )
				@foreach ($categories AS $category)
					@foreach($category->products AS $product)
						<tr>
							<td>{{$product->title}} {{$category->name}} - {{$product->description}} </td>
							<td>{{$product->price}}</td>
							<td class="text-right">
								<div class="col-md-2">
									<div class="thumnail">
										<img src="{{route('getimage', $product->filename)}}" class="img-responsive">
									</div>
									
								</div>								
							</td>
							<td class="text-right">
								<button type="button" class="btn btn-primary edit_button" data-toggle="modal" data-target="#productModalEdit" data-cid="{{$category->id}}" data-pid="{{$product->id}}" data-title="{{$product->title}}" data-name="{{$category->name}}" data-description="{{$product->description}}" data-price="{{$product->price}}">Edit</button>
							</td>
							<form method="POST" action="/admin/products/delete/{{$product->id}}" class="form-horizontal" onsubmit="return confirm('Are you sure you want to delete?')">
								{{ csrf_field() }}
								<td class="text-left"><button type="submit" class="btn btn-default">Delete</button></td>
							</form>							
						</tr>
					@endforeach										
				@endforeach
			@else
				<tr><td>No values</td></tr>
			@endif
			</tbody>
		</table>
		<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#productModalAdd">Add Product</button>
		@if (count($errors))
			<ul>
			@foreach ($errors->all() AS $error)
				<li>{{$error}}
			@endforeach
			</ul>
		@endif 

		<!-- Modal for Add-->
		<div class="modal fade" id="productModalAdd" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content load_modal">
					<div class="modal-header">
						<h4>Add Product</h4>	
					</div>
					<form method="POST" action="/admin/products/add" enctype="multipart/form-data" role="form" class="form-horizontal">	
						{{ csrf_field() }}
						<div class="modal-body">						
							<div class="form-group">
								<label class="col-xs-3 control-label">Category</label>	
								<div class="col-xs-5">
									<input type="text" name="name" class="form-control"></input>									
								</div>														
							</div>					
							<div class="form-group">
								<label class="col-xs-3 control-label">Title(OS)</label>	
								<div class="col-xs-5">
									<input type="text" name="title" class="form-control"></input>									
								</div>														
							</div>
							<div class="form-group">
								<label class="col-xs-3 control-label">Description(Color)</label>	
								<div class="col-xs-5">
									<input type="text" name="description" class="form-control"></input>									
								</div>														
							</div>
							<div class="form-group">
								<label class="col-xs-3 control-label">Price</label>	
								<div class="col-xs-5">
									<input type="text" name="price" class="form-control"></input>									
								</div>														
							</div>	
							<div class="form-group">
								<label class="col-xs-3 control-label">Select Image</label>	
								<input type="file" name="filefield" class="file"></input>
							</div>					
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>	
							<button type="submit" class="btn btn-primary">Save</button>							
						</div>
					</form>
				</div>				
			</div>			
		</div>

		<!-- Modal for Edit-->
		<div class="modal fade" id="productModalEdit" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content load_modal">
					<div class="modal-header">
						<h4>Edit Product</h4>	
					</div>
					<form method="POST" action="/admin/products/edit/" class="form-horizontal">	
						{{ csrf_field() }}
						<div class="modal-body">						
							<div class="form-group">
								
								<label class="col-xs-3 control-label">Category</label>	
								<div class="col-xs-5">
									<input type="text" name="name" class="form-control data_name"></input>			
									<input class="form-control data_categoryId" type="hidden" name="category_id"></input>						
								</div>														
							</div>					
							<div class="form-group">
								<input class="form-control data_productId" type="hidden" name="product_id"></input>
								<label class="col-xs-3 control-label">Title(OS)</label>	
								<div class="col-xs-5">
									<input type="text" name="title" class="form-control data_title"></input>									
								</div>														
							</div>
							<div class="form-group">
								<label class="col-xs-3 control-label">Description(Color)</label>	
								<div class="col-xs-5">
									<input type="text" name="description" class="form-control data_description"></input>									
								</div>														
							</div>
							<div class="form-group">
								<label class="col-xs-3 control-label">Price</label>	
								<div class="col-xs-5">
									<input type="text" name="price" class="form-control data_price"></input>									
								</div>														
							</div>						
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>	
							<button type="submit" class="btn btn-primary">Save</button>							
						</div>
					</form>
				</div>				
			</div>			
		</div>
	</div>	
@stop

@section('script')
<script>
	$(document).on( "click", '.edit_button',function(e) {
		var name = $(this).data('name');
		var cid = $(this).data('cid');

		var pid = $(this).data('pid');
		var title = $(this).data('title');
		var description = $(this).data('description');
		var price = $(this).data('price');

		$(".data_name").val(name);
		$(".data_categoryId").val(cid);

		$(".data_productId").val(pid);
		$(".data_title").val(title);
		$(".data_description").val(description);
		$(".data_price").val(price);
    });
</script>
@endsection