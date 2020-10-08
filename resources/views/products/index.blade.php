@extends('layouts.admin')

@section('title')
  <title>Trang chủ</title>
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('partials.content-header', ['name'=>'Product', 'key'=>'List'])
    <!-- /.content-header -->
    @if (Session::has('flash_message'))
      <div class="alert alert-success">{{ Session::get('flash_message') }}</div>
    @endif
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <a href="{{ route('products.create') }}" class="btn btn-outline-success m-2">Add</a>
          </div>
          <div class="col-md-12">
            <table class="table">
                <thead class="thead-light">
                  <tr>
                    <th>ID</th>
                    <th>ID Category</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Create at</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>

                @foreach($data as $products)
                  <tr>
                    <td>{{$products->id}}</td>
                    <td>{{$products->category_id}}</td>
                    <td>{{$products->name}}<br>
                      <img src="{{$products->url_image}}" alt="" width="100px">
                    </td>
                    <td>{{number_format($products->price)}}</td>
                    <td>{{$products->created_at}}</td>
                    <td><a href="{{ route('products.edit', ['id'=>$products->id]) }}" class="btn btn-outline-success">Edit</a>
                      <a href="{{ route('products.destroy', ['id'=>$products->id]) }}" class="btn btn-outline-danger">Delete</a>
                    </td>
                  </tr>
                @endforeach
                
                </tbody>
            </table>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection