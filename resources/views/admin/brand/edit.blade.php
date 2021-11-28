@extends('admin.admin_master')
@section('backend_content')

<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <a class="breadcrumb-item" href="{{url('admin/home')}}">Dashboard</a>
      <a class="breadcrumb-item active" href="{{route('admin.brand')}}">Brands</a>
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
                            <form action="{{url('admin/brand/edit/item/'.$brand_id->id)}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="old_image" value="{{$brand_id->brand_img}}">
                                <div class="mb-3">
                                    <label for="Brand_name" class="form-label">Brand Name</label>
                                    <input type="text" name="brand_name" value="{{$brand_id->brand_name}}" class="form-control @error('brand_name') is-invalid @enderror" id="Brand" placeholder="Please Input brand Name" aria-describedby="CategoryHelp">
                                    @error('brand_name')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="category1" class="form-label">Brand Image</label>
                                    <input type="file" name="brand_img"
                                     class="form-control @error('brand_img') is-invalid

                                    @enderror" id="Brand1"
                                    value="{{$brand_id->brand_img}}"
                                    >
                                    @error('brand_img')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <img src="{{asset($brand_id->brand_img)}}" style="height: 300px; width:300px" alt="">
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
