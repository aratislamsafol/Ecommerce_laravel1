@extends('layouts.fontend_master')
@section('fontend_content')
<!-- Hero Section Begin -->

@if (session('Fail'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>{{session('Fail')}}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<section class="hero hero-normal">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="hero__categories">
                    <div class="hero__categories__all">
                        <i class="fa fa-bars"></i>
                        <span>All Category</span>
                    </div>
                    <ul>
                        @php
                        $categories=App\Category::where('status',1)->latest()->get();
                        @endphp
                        @foreach ($categories as $cat)
                        <li><a href="#">{{$cat->category_name}}</a></li>
                    @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="hero__search">
                    <div class="hero__search__form">
                        <form action="#">
                            <div class="hero__search__categories">
                                All Categories
                                <span class="arrow_carrot-down"></span>
                            </div>
                            <input type="text" placeholder="What do yo u need?">
                            <button type="submit" class="site-btn">SEARCH</button>
                        </form>
                    </div>
                    <div class="hero__search__phone">
                        <div class="hero__search__phone__icon">
                            <i class="fa fa-phone"></i>
                        </div>
                        <div class="hero__search__phone__text">
                            <h5>+65 11.188.888</h5>
                            <span>support 24/7 time</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Hero Section End -->

<div class="container mt-3">
    <div class="row">
        <div class="col-md-8">
            <div class="card mb-3" >
                      <div class="card-header">
                          <h3>Order Details</h3>
                      </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                  <th scope="col">Product Image</th>
                                  <th scope="col">Product Name</th>
                                  <th scope="col">Product Price</th>
                                  <th scope="col">Quantity</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($order_item as $order_pro)
                            <tr>
                                <th scope="row"><img src="{{asset($order_pro->product->image_one)}}" style="height:35px; width:55px" alt=""></th>
                                <td>{{$order_pro->product->product_name}}</td>
                                <td>
                                    ${{$order_pro->product->price}}
                                </td>
                                <td>{{$order_pro->product_qty}}</td>
                            </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- <img src="{{asset($order_pro->product->image_one)}}" style="height:35px; width:55px" alt="">
                        <tr>
                            <td> </td>
                            <td></td>

                        </tr> --}}
                    </div>
              </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-3" >
                <div class="card-header">
                    <h3>Shipping & Billing</h3>
                </div>
              <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Name :{{Auth::user()->name}}</li>
                    <li class="list-group-item"><i class="fa fa-map-marker" style="color:rgb(96, 193, 238)"></i> Shipping Address:{{$shipping->shipping_address}},{{$shipping->shipping_state}},{{$shipping->post_code}}</li>

                    <li class="list-group-item">Phone :{{$shipping->shipping_phone}}</li>
                    <li class="list-group-item">Email :{{$shipping->shipping_email}}</li>
                </ul>

                <h5 class="pt-4">Order Summary</h5>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Shipping ID :{{$order->invoice_no}}</li>
                    <li class="list-group-item">Subtotal :{{$order->subtotal}}</li>
                    <li class="list-group-item">Total :{{$order->total}}</li>
                </ul>
              </div>
        </div>

        </div>


    </div>
</div>
@endsection
