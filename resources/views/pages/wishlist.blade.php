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
                    <h2>WishList</h2>
                    <div class="breadcrumb__option">
                        <a href="{{url('/')}}">Home</a>
                        <span>WishList</span>
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
                                <th>Cart</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($wishlist as $wl)
                            <tr>
                                <td class="shoping__cart__item">
                                    <img src="{{asset($wl->product->image_one)}}" style="height:80px; width:80px" alt="wish Image">
                                    <h5>{{$wl->product->product_name}}</h5>
                                </td>
                                <td class="shoping__cart__price">
                                    {{$wl->product->price}}
                                </td>
                                <td>
                                    <form action="{{ url('product/shopping/cart/add/'.$wl->product_id)}}" method="post">
                                        @csrf
                                        <input type="hidden" name="price" value="{{$wl->product->price}}">
                                        <input type="hidden" name="product_id" value="{{$wl->product->id}}">
                                        <button class="btn -sm btn btn-danger" type="submit"><i class="fa fa-shopping-cart">Add to Cart</i></button>
                                    </form>
                                </td>


                                {{-- <td class="shoping__cart__total">
                                    {{$cart->price * $cart->product_qty}}
                                </td> --}}
                                <td class="shoping__cart__item__close">

                                        <a href="{{url('wl/destroy/'.$wl->id)}}"><span class="icon_close"> </span></a>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection
