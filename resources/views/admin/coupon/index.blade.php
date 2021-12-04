
@extends('admin.admin_master')
@section('coupon') active @endsection
@section('backend_content')

<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <a class="breadcrumb-item" href="{{url('admin/home')}}">Dashboard</a>
      <a class="breadcrumb-item active" href="{{route('admin.coupon')}}">Coupons</a>
    </nav>
    <div class="sl-pagebody">
        <div class="sl-page-title">
            <div class="row">
                <div class="col-md-8">
                    <div class="card pd-20 pd-sm-40">
                        <h6 class="card-body-title">All Coupons DataTable</h6>

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
                                    <th class="wd-20p">Coupon Name</th>
                                    <th class="wd-15p">Discount</th>
                                    <th class="wd-15p">Status</th>
                                    <th class="wd-25p">Created At</th>
                                    <th class="wd-25p">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($coupon_show as $coupon)
                                    <tr>
                                        <td>{{$coupon_show->firstItem()+$loop->index}}</td>
                                        <td>{{$coupon->coupon_name}}</td>
                                        <td>{{$coupon->discount}}</td>
                                        <td>
                                            @if ($coupon->status==1)
                                            <span class="badge badge-success">Active</span>
                                            @else
                                            <span class="badge badge-danger">Inactive</span>
                                            @endif
                                        </td>
                                        {{-- <td>{{$category->user_id}}</td> --}}
                                        <td>{{$coupon->created_at->diffForHumans()}}</td>
                                        <td>
                                            <a href="{{url('admin/coupon/item/'.$coupon->id)}}" class="btn btn-success btn-sm"><i class="fa fa-pencil"></i></a>
                                            <a href="{{url('admin/coupon/item/delete/'.$coupon->id)}}" class="btn btn-danger btn-sm" onclick="return confirm('Are You Sure Want to Delete')"><i class="fa fa-trash"></i></a>
                                            @if ($coupon->status==1)
                                            <a href="{{url('admin/coupon/item/inactive/'.$coupon->id)}}" class="btn btn-danger btn-sm"><i class="fa fa-thumbs-down"></i></a>
                                            @else
                                            <a href="{{url('admin/coupon/item/active/'.$coupon->id)}}" class="btn btn-success btn-sm"><i class="fa fa-thumbs-up"></i></a>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                            {{$coupon_show->links()}}
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                        Add Coupon
                        </div>
                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>{{session('success')}}</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                            <form action="{{route('store.coupon')}}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="Coupon" class="form-label">Coupon Name</label>
                                    <input type="text" name="coupon_name" class="form-control @error('coupon_name') is-invalid @enderror" id="coupon" placeholder="Please Input Coupon Name" aria-describedby="CouponHelp">
                                    @error('coupon_name')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="Coupon" class="form-label">Coupon Discount</label>
                                    <input type="text" name="discount" class="form-control @error('discount') is-invalid @enderror" id="coupon" placeholder="Please Input Coupon Discount" aria-describedby="CouponHelp">
                                    @error('discount')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm">ADD</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
