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

<!-- Shoping Cart Section Begin -->
<section class="shoping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__cart__table">
                    <table>
                        <thead>
                            <tr>
                                <th class="shoping__product">Products</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($carts as $cart)
                            <tr>
                                <td class="shoping__cart__item">
                                    <img src="{{$cart->product->image_one}}" style="height:80px; width:80px" alt="Cart Image">
                                    <h5>{{$cart->product->product_name}}</h5>
                                </td>
                                <td class="shoping__cart__price">
                                    {{$cart->product->price}}
                                </td>

                                <td class="shoping__cart__quantity">

                                    <div class="quantity">
                                        <form action="{{url('cart/item/update/'.$cart->id)}}" method="POST">
                                            @csrf
                                            <div class="pro-qty">
                                                <input type="text" value={{$cart->product_qty}} name="product_qty">
                                            </div>
                                            <button type="submit" class="btn btn-sm"><i class="fa fa-history"></i></button>
                                        </form>
                                    </div>

                                </td>
                                <td class="shoping__cart__total">
                                    {{$cart->price * $cart->product_qty}}
                                </td>
                                <td class="shoping__cart__item__close">

                                        <a href="{{url('cart/destroy/'.$cart->id)}}"><span class="icon_close"> </span></a>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__cart__btns">
                    <a href="{{url('/')}}" class="primary-btn cart-btn">CONTINUE SHOPPING</a>

                    {{-- <a href="#" class="primary-btn cart-btn cart-btn-right"><span class="icon_loading"></span>
                        Upadate Cart</a> --}}
                </div>
            </div>
            <div class="col-lg-6">
                @if (Session::has('coupon'))
                @else
                <div class="shoping__continue">
                    <div class="shoping__discount">
                        <h5>Discount Codes</h5>
                        <form action="{{url('cart/cuppon/apply')}}" method="GET">
                            <input type="text" name="coupon_name" placeholder="Enter your coupon code">
                            <button type="submit" class="site-btn">APPLY COUPON</button>
                        </form>
                    </div>
                </div>
                @endif
            </div>
            <div class="col-lg-6">
                <div class="shoping__checkout">
                    <h5>Cart Total</h5>
                    <ul>
                        @if (Session::has('coupon'))
                        <li>Subtotal <span>{{$sub_total}}tk</span></li>
                        <li>Coupon Name <span>{{session()->get('coupon')['coupon_name']}} <a href="{{url('coupon/destroy')}}"><i class="fa fa-times"></i></a></span></li>
                        <li>Discount <span>{{session()->get('coupon')['discount_rate']}}% (
                            {{$discount=$sub_total*session()->get('coupon')['discount_rate']/100}}
                        )</span></span></li>
                        <li>Total <span>${{$sub_total - $discount}} tk</span></li>
                        @else
                        <li>Subtotal <span>{{$sub_total}}tk</span></li>
                        @endif
                    </ul>
                    <a href="#" class="primary-btn">PROCEED TO CHECKOUT</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
