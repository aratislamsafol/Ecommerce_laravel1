@extends('admin.admin_master')
@section('backend_content')

<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <a class="breadcrumb-item" href="{{url('admin/home')}}">Dashboard</a>
      <a class="breadcrumb-item active" href="{{route('admin.category')}}">Categories</a>
    </nav>
    <div class="sl-pagebody">
        <div class="sl-page-title">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                       Update Category
                        </div>
                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>{{session('success')}}</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                            <form action="{{url('admin/category/edit/item/'.$category_id->id)}}" method="POST">
                                @csrf
                                <div class="mb-3">
                                <label for="Category" class="form-label">Category Name</label>
                                <input type="text" name="category_name" value="{{$category_id->category_name}}" class="form-control @error('category_name') is-invalid @enderror" id="Category" placeholder="Please Input Category Name" aria-describedby="CategoryHelp">
                                @error('category_name')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
