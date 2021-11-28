@extends('admin.admin_master')
@section('brand') active @endsection
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
                    <div class="card pd-20 pd-sm-40">
                        <h6 class="card-body-title">All Brand DataTable</h6>

                        <div class="table-wrapper">
                            @if (session('delete'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>{{session('delete')}}</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                            @if (session('status-Active'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>{{session('status-Active')}}</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                            @if (session('status-Inactive'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{session('status-Inactive')}}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                            <table id="datatable1" class="table display responsive nowrap">
                                <thead>
                                <tr>
                                    <th class="wd-15p">SL No</th>
                                    <th class="wd-20p">Brand Name</th>
                                    <th class="wd-15p">Status</th>
                                    {{-- <th class="wd-10p">Creator</th> --}}
                                    <th class="wd-25p">Image</th>
                                    <th class="wd-25p">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($brands as $brand)
                                    <tr>
                                        <td>{{$brands->firstItem()+$loop->index}}</td>
                                        <td>{{$brand->brand_name}}</td>
                                        <td>
                                            @if ($brand->status==1)
                                            <span class="badge badge-success">Active</span>
                                            @else
                                            <span class="badge badge-danger">Inactive</span>
                                            @endif
                                        </td>
                                        {{-- <td>{{$category->user_id}}</td> --}}
                                        <td><img src="{{asset($brand->brand_img)}}" style="height:35px; width:55px" alt=""></td>
                                        <td>
                                            <a href="{{url('admin/brand/item/'.$brand->id)}}" class="btn btn-success btn-sm"><i class="fa fa-pencil"></i></a>
                                            <a href="{{url('admin/brand/item/delete/'.$brand->id)}}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                            @if ($brand->status==1)
                                            <a href="{{url('admin/brand/item/inactive/'.$brand->id)}}" class="btn btn-warning btn-sm"><i class="fa fa-thumbs-down"></i></a>
                                            @else
                                            <a href="{{url('admin/brand/item/active/'.$brand->id)}}" class="btn btn-success btn-sm"><i class="fa fa-thumbs-up"></i></a>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                            {{$brands->links()}}
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                        Add Brand
                        </div>
                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>{{session('success')}}</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                            <form action="{{route('add.brand')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="Brand_name" class="form-label">Brand Name</label>
                                    <input type="text" name="brand_name" class="form-control @error('brand_name') is-invalid @enderror" id="Category" placeholder="Please Input Category Name" aria-describedby="CategoryHelp">
                                    @error('brand_name')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <input type="file" name="brand_img" class="form-control
                                    @error('brand_img') is-invalid
                                    @enderror" id="brand1">

                                    @error('brand_img')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary btn-sm">ADD</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card pd-20 pd-sm-40">
                        <h6 class="card-body-title">All Brand DataTable</h6>

                        <div class="table-wrapper">
                            @if (session('delete'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>{{session('delete')}}</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                            @if (session('status-Active'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>{{session('status-Active')}}</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                            @if (session('status-Inactive'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{session('status-Inactive')}}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                            <table id="datatable1" class="table display responsive nowrap">
                                <thead>
                                <tr>
                                    <th class="wd-15p">SL No</th>
                                    <th class="wd-20p">Brand Name</th>
                                    {{-- <th class="wd-20p">Del Time</th> --}}

                                    {{-- <th class="wd-10p">Creator</th> --}}
                                    <th class="wd-25p">Image</th>
                                    <th class="wd-25p">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($TrashCat as $brand)
                                    <tr>
                                        <td>{{$brands->firstItem()+$loop->index}}</td>
                                        <td>{{$brand->brand_name}}</td>

                                        {{-- <td>@if ($brand->deleted_at == null)
                                        echo 'Nothing to show';
                                        @else
                                        {{$brand->deleted_at->diffForHumans()}}
                                        @endif
                                           </td> --}}
                                        <td><img src="{{asset($brand->brand_img)}}" style="height:35px; width:55px" alt=""></td>
                                        <td>
                                            <a href="{{url('admin/brand/item/restore/'.$brand->id)}}" class="btn btn-success btn-sm">Restore</a>
                                            <a href="{{url('admin/brand/item/p_delete/'.$brand->id)}}" class="btn btn-danger btn-sm">PDel</a>
                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                            {{$brands->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
