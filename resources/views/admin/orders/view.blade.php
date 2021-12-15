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
                <div class="col-md-12">
                    <div class="card pd-20 pd-sm-40">
                        <h6 class="card-body-title">Shipping Info</h6>
                        <div class="form-layout">
                            <div class="row mg-b-25">
                                <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">First Name: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" value="{{ $shipping->shipping_first_name}}" readonly>
                                </div>
                                </div><!-- col-4 -->
                                <div class="col-lg-4">
                                    <div class="form-group">
                                    <label class="form-control-label">Last Name: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="lastname"  value="{{ $shipping->shipping_last_name}}" readonly>
                                    </div>
                                </div><!-- col-4 -->

                                <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Email: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" value="{{ $shipping->shipping_email}}" name="email" readonly>
                                </div>
                                </div><!-- col-4 -->
                                <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Phone <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" value="{{ $shipping->shipping_phone}}" name="email" readonly>
                                </div>
                                </div><!-- col-4 -->
                                <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Address: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" value="{{ $shipping->shipping_address}}" name="email" readonly>
                                </div>
                                </div><!-- col-4 -->
                                <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">State: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" value="{{ $shipping->shipping_state}}" name="email" readonly>
                                </div>
                                </div><!-- col-4 -->
                                <div class="col-lg-4">
                                    <div class="form-group">
                                    <label class="form-control-label">Post Code: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" value="{{ $shipping->post_code}}" name="email" readonly>
                                    </div>
                                </div><!-- col-4 -->

                            </div><!-- row -->
                        </div><!-- card -->
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card pd-20 pd-sm-40">
                        <h6 class="card-body-title">Orders</h6>
                        <div class="form-layout">
                            <div class="row mg-b-25">
                                <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Invoice No: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" value="{{ $order->invoice_no}}" readonly>
                                </div>
                                </div><!-- col-4 -->
                                <div class="col-lg-4">
                                    <div class="form-group">
                                    <label class="form-control-label">Payment Type: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="lastname"  value="{{ $order->payment_type}}" readonly>
                                    </div>
                                </div><!-- col-4 -->

                                <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Total: <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" value="{{ $order->total}}" name="email" readonly>
                                </div>
                                </div><!-- col-4 -->
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Sub Total <span class="tx-danger">*</span></label>
                                        <input class="form-control" type="text" value="{{ $order->subtotal}}" name="email" readonly>
                                    </div>
                                </div><!-- col-4 -->
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Coupon Discount: <span class="tx-danger">*</span></label>
                                        @if ($order->coupon_discount == NULL)
                                        <input class="form-control" type="text" value="NO"  name="email" readonly>
                                        @else
                                        <input class="form-control" type="text" value="{{ $order->coupon_discount}}"  name="email" readonly>
                                        @endif

                                    </div>
                                </div><!-- col-4 -->

                            </div><!-- row -->
                        </div><!-- card -->
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card pd-20 pd-sm-40">
                        <h6 class="card-body-title">Order Item</h6>
                        <div class="form-layout">
                            <div class="row mg-b-25">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <table id="datatable1" class="table display responsive nowrap">
                                            <thead>
                                            <tr>
                                                <th class="wd-20p">Product Name</th>
                                                <th class="wd-15p">Product Quantity</th>
                                                {{-- <th class="wd-10p">Creator</th> --}}
                                                <th class="wd-25p">Image</th>

                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($order_item as $order_pro)
                                                <tr>
                                                    <td> {{$order_pro->product->product_name}}</td>
                                                    <td>{{$order_pro->product_qty}}</td>
                                                    <td><img src="{{asset($order_pro->product->image_one)}}" style="height:35px; width:55px" alt=""></td>

                                                </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div><!-- col-4 -->
                            </div><!-- row -->
                        </div><!-- card -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
