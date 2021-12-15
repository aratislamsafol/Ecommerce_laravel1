@extends('admin.admin_master')
@section('orders') active @endsection
@section('backend_content')

<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <a class="breadcrumb-item" href="{{url('admin/home')}}">Dashboard</a>
      <a class="breadcrumb-item active" href="{{route('admin.orders')}}">Orders</a>
    </nav>
    <div class="sl-pagebody">
        <div class="sl-page-title">
            <div class="row">
                <div class="col-md-8">
                    <div class="card pd-20 pd-sm-40">
                        <h6 class="card-body-title">All Order DataTable</h6>

                        <div class="table-wrapper">
                            @if (session('delete'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>{{session('delete')}}</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                            {{-- @if (session('status-Active'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>{{session('status-Active')}}</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                            @if (session('status-Inactive'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{session('status-Inactive')}}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div> --}}
                        {{-- @endif --}}
                            <table id="datatable1" class="table display responsive nowrap">
                                <thead>
                                    <tr>
                                        <th class="wd-15p">SL No</th>
                                        <th class="wd-20p">Invoice No</th>
                                        <th class="wd-15p">Payment Type</th>
                                        <th class="wd-15p">Coupon</th>
                                        {{-- <th class="wd-10p">Creator</th> --}}
                                        <th class="wd-25p">Created At</th>
                                        <th class="wd-25p">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                    <tr>
                                        <td>{{$order->id}}</td>
                                        <td>#{{$order->invoice_no}}</td>
                                        <td>{{$order->payment_type}}</td>

                                        <td>
                                            @if ($order->coupon_discount==Null)
                                            <span class="badge badge-danger">No</span>
                                            @else
                                            <span class="badge badge-success">Yes</span>
                                            @endif
                                        </td>
                                        {{-- <td>{{$category->user_id}}</td> --}}
                                        <td>{{$order->created_at->diffForHumans()}}</td>
                                        <td>
                                            <a href="{{url('admin/order/view/'.$order->id)}}" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a>
                                            {{-- <a href="{{url('admin/order/item/delete/'.$order->id)}}" class="btn btn-danger btn-sm">Delete</a> --}}
                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                            {{-- {{$orders->links()}} --}}
                        </div>
                    </div>
                </div>
                {{-- <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                        Add Category
                        </div>
                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>{{session('success')}}</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                            <form action="{{route('store.category')}}" method="POST">
                                @csrf
                                <div class="mb-3">
                                <label for="Category" class="form-label">Category Name</label>
                                <input type="text" name="category_name" class="form-control @error('category_name') is-invalid @enderror" id="Category" placeholder="Please Input Category Name" aria-describedby="CategoryHelp">
                                @error('category_name')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm">ADD</button>
                            </form>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
</div>
@endsection
