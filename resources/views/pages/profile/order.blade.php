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


<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="{{asset('fontend')}}/img/breadcrumb.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Shopping Cart</h2>
                    <div class="breadcrumb__option">
                        <a href="{{url('/')}}">Home</a>
                        <span>Shopping Cart</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->
<div class="container mt-3">
    <div class="row">
        <div class="col-sm-4">
            <div class="card">
                <ul class="list-group list-group-flush">
                    <a href="{{route('home')}}" class="list-group-item btn-primary btn-block"><span>Home</span></a>
                    {{-- <li href="" Home</li> --}}
                    <a href="{{route('orders')}}" class="list-group-item btn-primary btn-block"><span>My Order</span></a>
                    <a class="list-group-item btn-block btn-danger" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                     </a>
                     <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </ul>
            </div>
        </div>
        <div class="col-sm-8">
          <div class="card">
            <div class="card-body">
                <table class="table table-dark table-hover">
                    <thead>
                        <tr>
                          <th scope="col">invoice_no</th>
                          <th scope="col">payment_type</th>
                          <th scope="col">total</th>
                          <th scope="col">coupon_discount</th>
                          <th scope="col">subtotal</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                          @foreach ($orders as $order)
                            <tr>
                                <th scope="row">{{$order->invoice_no}}</th>
                                <td>{{$order->payment_type}}</td>
                                <td>{{$order->total}}</td>
                                <td>
                                    @if ($order->coupon_discount == NULL)
                                        <span class="badge badge-success">NO</span>
                                    @else
                                        <span class="badge badge-warning">Yes-{{$order->coupon_discount}}%</span>
                                    @endif
                                </td>
                                <td>{{$order->subtotal}}</td>
                                <td><a href="{{url('order/item/show/'.$order->id)}}"><i class="fa fa-eye"></i></a></td>
                            </tr>
                          @endforeach

                    </tbody>
                </table>
            </div>
          </div>
        </div>
      </div>
</div>
@endsection
