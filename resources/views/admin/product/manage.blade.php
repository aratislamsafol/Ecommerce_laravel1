@extends('admin.admin_master')
@section('product') active show-sub @endsection
@section('manage.product') active @endsection

@section('backend_content')
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{url('admin/home')}}">Dashboard</a>
        <a class="breadcrumb-item active" href="{{route('manage.product')}}">Manage Products</a>
    </nav>
    <div class="sl-pagebody">
        <div class="sl-page-title">
            <div class="row">
                <div class="col-md-12">
                    <div class="card pd-20 pd-sm-40">
                        <h6 class="card-body-title">All Products DataTable</h6>

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
                                    <th class="wd-20p">Product Name</th>
                                    <th class="wd-15p">P Category</th>
                                    <th class="wd-15p">P Brand</th>
                                    <th class="wd-15p">Quantity</th>
                                    {{-- <th class="wd-10p">Creator</th> --}}
                                    <th class="wd-25p">Image</th>
                                    <th class="wd-15p">Price</th>
                                    <th class="wd-15p">Status</th>
                                    <th class="wd-25p">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($show_pro as $s_pro)
                                    <tr>
                                        <td>{{$show_pro->firstItem()+$loop->index}}</td>
                                        <td>{{$s_pro->product_name}}</td>
                                        <td>{{$s_pro->category->category_name}}</td>
                                        <td>{{$s_pro->Brand->brand_name}}</td>

                                        <td>{{$s_pro->product_quantity}}</td>

                                        {{-- <td>{{$category->user_id}}</td> --}}
                                        <td><img src="{{asset($s_pro->image_one)}}" style="height:35px; width:55px" alt=""></td>
                                        <td>{{$s_pro->price}}</td>
                                        <td>
                                            @if ($s_pro->status==1)
                                            <span class="badge badge-success">Active</span>
                                            @else
                                            <span class="badge badge-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            {{-- {{url('admin/product/edit/'.$s_pro->id)}} --}}
                                            <a href="{{url('admin/product/edit/'.$s_pro->id)}}" class="btn btn-success btn-sm"><i class="fa fa-pencil"></i></a>
                                            <a href="{{url('admin/product/delete/'.$s_pro->id)}}" class="btn btn-danger btn-sm" onclick="return confirm('Are You Sure to Delete')"><i class="fa fa-trash"></i></a>
                                            @if ($s_pro->status==1)
                                            <a href="{{url('admin/brand/item/inactive/'.$s_pro->id)}}" class="btn btn-warning btn-sm"><i class="fa fa-thumbs-down"></i></a>
                                            @else
                                            <a href="{{url('admin/brand/item/active/'.$s_pro->id)}}" class="btn btn-success btn-sm"><i class="fa fa-thumbs-up"></i></a>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                            {{$show_pro->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
