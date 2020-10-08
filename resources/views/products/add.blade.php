@extends('layouts.admin')

@section('title')
<title>Add Product</title>
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  @include('partials.content-header', ['name'=>'Product', 'key'=>'Add'])
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">
      	<div class="col-md-5">
			<form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
			@csrf
			  <div class="form-group">
			    <label>Product Name</label>
			    <input type="text" class="form-control" placeholder="Enter name" name="name">
			  </div>

			  <div class="form-group">
			    <label>Category</label>
			    <select class="form-control" name="parent_id">
			    	@foreach($listCategory as $list)
			    		<option value="{{$list->id}}">{{$list->name}}</option>
			    	@endforeach
				</select>
			  </div>

			  <div class="form-group">
			    <label>Price</label>
			    <input type="text" class="form-control" placeholder="Enter price" name="price">
			  </div>

			  <div class="form-group">
			    <label>Description</label>
			    <input type="text" class="form-control" placeholder="Enter price" name="description">
			  </div>

			  <div class="form-group">
			    <label>Picture</label>
			    <input type="file" class="form-control" placeholder="Enter price" name="url_image">
			  </div>



			  <button type="submit" class="btn btn-primary">Add Product</button>
			  <a href="{{ route('products.index') }}" class="btn ml-1">Cancel</a>
			</form>
		</div>
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection

