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
                <form>
                    <div class="mb-3">
                      <label for="exampleInputEmail1" class="form-label">User Name</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" value="{{Auth::user()->name}}" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" value="{{Auth::user()->email}}" aria-describedby="emailHelp">
                      </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
          </div>
        </div>
      </div>
</div>
@endsection
