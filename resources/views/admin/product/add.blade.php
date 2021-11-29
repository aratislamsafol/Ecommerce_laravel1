@extends('admin.admin_master')
@section('product') active show-sub @endsection
@section('add_products') active @endsection

@section('backend_content')

<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <a class="breadcrumb-item" href="{{url('admin/home')}}">Dashborad</a>
      <a class="breadcrumb-item active" href="{{route('add.product')}}">Add Products</a>
    </nav>
    <div class="sl-pagebody">
        <div class="sl-page-title">
            <div class="row">
                <div class="card pd-20 pd-sm-40">
                    <h6 class="card-body-title">Add New Products</h6>
                    <form action="{{route('admin.product.store')}}" method="post" enctype="multipart/form-data">
                        @csrf

                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{session('success')}}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="form-layout">
                        <div class="row mg-b-25">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Product Name<span class="tx-danger">*</span></label>
                                    <input class="form-control @error('product_name') is-invalid

                                    @enderror" type="text" name="product_name" value="{{old('product_name')}}" placeholder="Enter product name">

                                    @error('product_name')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror

                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Product Code <span class="tx-danger">*</span></label>
                                    <input class="form-control @error('product_code') is-invalid

                                    @enderror" type="text" name="product_code" value="{{old('product_code')}}" placeholder="Enter product Code">

                                    @error('product_code')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Price <span class="tx-danger">*</span></label>
                                <input class="form-control @error('price') is-invalid

                                @enderror" type="number" name="price" value="{{old('price')}}" placeholder="Enter product Price">
                                @error('price')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label">Quantity<span class="tx-danger">*</span></label>
                                <input class="form-control @error('product_quantity') is-invalid

                                @enderror" type="number" name="product_quantity" value="{{old('product_quantity')}}" placeholder="Product Quantity">
                                @error('product_quantity')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            </div><!-- col-4 -->

                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Category: <span class="tx-danger">*</span></label>
                                    <select class="form-control select2 @error('category_id') is-invalid

                                    @enderror" name="category_id" data-placeholder="Choose Category">
                                    <option label="Choose Category"></option>
                                    @foreach ($categories as $category)
                                    <option value="{{$category->id}}">{{$category->category_name}}</option>
                                    @endforeach
                                    </select>
                                    @error('category_id')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror

                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                <label class="form-control-label">Brand: <span class="tx-danger">*</span></label>
                                <select class="form-control select2 @error('brand_id') is-invalid

                                @enderror" name="brand_id" data-placeholder="Choose Brand">
                                    <option label="Choose Brand"></option>
                                    @foreach ($Brands as $Brand)
                                    <option value="{{$Brand->id}}">{{$Brand->brand_name}}</option>
                                    @endforeach
                                </select>

                                @error('brand_id')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                                </div>
                            </div><!-- col-4 -->

                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                <label class="form-control-label">Main Image<span class="tx-danger">*</span></label>
                                <input class="form-control @error('image_one') is-invalid
                                @enderror" type="file" name="image_one" value="">

                                @error('image_one')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                <label class="form-control-label">Second Image<span class="tx-danger">*</span></label>
                                <input class="form-control @error('image_two') is-invalid
                                @enderror" type="file" name="image_two">
                                @error('image_two')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                <label class="form-control-label">Third Image<span class="tx-danger">*</span></label>
                                <input class="form-control @error('image_three') is-invalid
                                @enderror" type="file" name="image_three" value="">
                                @error('image_three')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                                </div>
                            </div><!-- col-4 -->

                            <div class="col-lg-12">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label">Short Description<span class="tx-danger">*</span></label>
                                <textarea name="short_description" class="@error('short_description') is-invalid
                                @enderror" id="summernote"></textarea>
                                @error('short_description')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            </div><!-- col-8 -->

                            <div class="col-lg-12">
                                <div class="form-group mg-b-10-force">
                                <label class="form-control-label">Long Description<span class="tx-danger">*</span></label>
                                    <textarea name="long_description" class="" id="summernote2"></textarea>
                                    {{-- @error('long_description')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror --}}
                                </div>
                            </div><!-- col-8 -->

                        </div><!-- row -->

                        <div class="form-layout-footer">
                            <button type="submit" class="btn btn-info mg-r-5">Add Product</button>
                        </div><!-- form-layout-footer -->
                        </div><!-- form-layout -->
                    </form>
                </div><!-- card -->

            </div>


        </div>
    </div>
</div>
@endsection
