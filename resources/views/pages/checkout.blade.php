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
                    <h2>Checkout</h2>
                    <div class="breadcrumb__option">
                        <a href="{{url('/')}}">Home</a>
                        <span>Checkout page</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Checkout Section Begin -->
<section class="checkout spad">
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{session('success')}}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class=Checkout>
            <div class="checkout__form">
                <h4>Shipping Address</h4>
                <form action="{{url('place/order')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Fist Name<span>*</span></p>
                                        <input type="text" value={{Auth::user()->name}} name="shipping_first_name" class="@error('shipping_first_name') is-invalid @enderror">
                                        @error('shipping_first_name')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Last Name<span>*</span></p>
                                        <input type="text" name="shipping_last_name" class="@error('shipping_last_name') is-invalid @enderror">
                                        @error('shipping_last_name')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Phone<span>*</span></p>
                                        <input type="text" name="shipping_phone" class="@error('shipping_phone') is-invalid @enderror">
                                        @error('shipping_phone')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input type="text" value={{Auth::user()->email}}  name="shipping_email" class="@error('shipping_email') is-invalid @enderror">
                                        @error('shipping_email')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Country<span>*</span></p>
                                <input type="text" name="shipping_state">
                                @error('shipping_state')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                            </div>
                            <div class="checkout__input">
                                <p>Address<span>*</span></p>
                                <input type="text" placeholder="Street Address" name="shipping_address" class="checkout__input__add">
                                @error('shipping_address')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror

                            </div>
                            {{-- <div class="checkout__input">
                                <p>Town/City<span>*</span></p>
                                <input type="text">
                            </div> --}}
                            {{-- <div class="checkout__input">
                                <p>Country/State<span>*</span></p>
                                <input type="text">
                            </div> --}}
                            <div class="checkout__input">
                                <p>Postcode / ZIP<span>*</span></p>
                                <input type="text" name="post_code">
                                @error('post_code')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            {{-- <div class="checkout__input">
                                <p>Order notes<span>*</span></p>
                                <input type="text"
                                    placeholder="Notes about your order, e.g. special notes for delivery.">
                            </div> --}}
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4>Your Order</h4>
                                <div class="checkout__order__products">Products <span>Total</span></div>
                                <ul>
                                    @php
                                         $cart=App\Cart::where('user_ip',request()->ip())->get();
                                         $sub_total=App\Cart::all()->where('user_ip',request()->ip())->sum(function($res){
                                            return $res->product_qty * $res->price;
                                        });
                                    @endphp
                                    @foreach ($cart as $carts)
                                        {{-- <input type="hidden" name="product_id" value={{product->id}}> --}}
                                        <li>{{$carts->product->product_name}}<span>{{$carts->product->price*$carts->product_qty}}</span></li>
                                    @endforeach

                                </ul>
                                @if (Session::has('coupon'))
                                <div class="checkout__order__total">Total <span>{{$sub_total-$sub_total*session()->get('coupon')['discount_rate']/100}}</span></div>
                                <input type="hidden" name="coupon_discount" value="{{session()->get('coupon')['discount_rate']}}">
                                <input type="hidden" name="subtotal" value="${{$sub_total}}">
                                <input type="hidden" name="total" value="${{$sub_total-$sub_total*session()->get('coupon')['discount_rate']/100}}">
                                @else

                                <div class="checkout__order__subtotal">Subtotal <span>${{$sub_total}}tk</span></div>
                                <input type="hidden" name="subtotal" value="${{$sub_total}}">
                                <input type="hidden" name="total" value="${{$sub_total}}">
                                @endif

                                <h4>Select Payment Method</h4>
                                <div class="checkout__input__checkbox">
                                    <label for="payment">
                                        cash_on_delivery
                                        <input type="checkbox" id="payment" value="cash_on_delivery" name="payment_type">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="checkout__input__checkbox">
                                    <label for="paypal">
                                        Paypal
                                        <input type="checkbox" id="paypal" value="Paypal" name="payment_type">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <button type="submit" id="sslczPayBtn"
                                token="if you have any token validation"
                                postdata="your javascript arrays or objects which requires in backend"
                                order="If you already have the transaction generated for current order"
                                endpoint="{{ url('/pay-via-ajax') }}" class="site-btn">PLACE ORDER</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</section>
<!-- Checkout Section End -->

@endsection
