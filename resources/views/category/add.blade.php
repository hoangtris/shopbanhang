@extends('layouts.admin')

@section('title')
<title>Add Category</title>
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  @include('partials.content-header', ['name'=>'Category', 'key'=>'Add'])
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">
      	<div class="col-md-5">
			<form action="{{ route('categories.store') }}" method="post">
			@csrf
			  <div class="form-group">
			  	@if ($errors->any())
				    <div class="alert-danger">
				        <ul>
				            @foreach ($errors->all() as $error)
				                <li>{{ $error }}</li>
				            @endforeach
				        </ul>
				    </div>
				@endif
			  </div>
			  <div class="form-group">
			    <label>Category Name</label>
			    <input type="text" class="form-control" placeholder="Enter name" name="name">
			  </div>

			  <div class="form-group">
			    <label>Slug</label>
			    <input type="text" class="form-control" placeholder="Enter slug" name="slug">
			  </div>

			  <div class="form-group">
			    <label>Parent Category</label>
			    <select class="form-control" name="parent_id">
			    	<option value="0">Select parent</option>
					{!! $htmlOption !!}
				</select>
			  </div>

			  <button type="submit" class="btn btn-primary">Add Category</button>
			  <a href="{{ route('categories.index') }}" class="btn ml-1">Cancel</a>
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

