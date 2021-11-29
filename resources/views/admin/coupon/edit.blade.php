@extends('admin.admin_master')
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
                    <div class="card">
                        <div class="card-header">
                       Update Coupons
                        </div>
                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>{{session('success')}}</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                            <form action="{{url('admin/coupon/edit/item/'.$coupon_id->id)}}" method="POST">
                                @csrf
                                <div class="mb-3">
                                <label for="Coupons" class="form-label">Coupon Name</label>
                                <input type="text" name="coupon_name" value="{{$coupon_id->coupon_name}}" class="form-control @error('coupon_name') is-invalid @enderror" id="Coupons" placeholder="Please Input Coupon Name" aria-describedby="CouponsHelp">
                                @error('coupon_name')
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
