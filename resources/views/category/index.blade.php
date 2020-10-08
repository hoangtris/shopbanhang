@extends('layouts.admin')

@section('title')
  <title>Trang chủ</title>
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('partials.content-header', ['name'=>'Category', 'key'=>'List'])
    <!-- /.content-header -->
    @if (Session::has('flash_message'))
      <div class="alert alert-success">{{ Session::get('flash_message') }}</div>
    @endif
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <a href="{{ route('categories.create') }}" class="btn btn-outline-success m-2">Add</a>
          </div>
          <div class="col-md-12">
            <table class="table">
                <thead class="thead-dark">
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Parent ID</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>

                @foreach($data as $categories)
                  <tr>
                    <td>{{$categories->id}}</td>
                    <td>{{$categories->name}}</td>
                    <td>{{$categories->slug}}</td>
                    <td>{{$categories->parent_id}}</td>
                    <td><a href="{{ route('categories.edit', ['id'=>$categories->id]) }}" class="btn btn-outline-success">Edit</a>
                      <a href="{{ route('categories.destroy', ['id'=>$categories->id]) }}" class="btn btn-outline-danger">Delete</a>
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