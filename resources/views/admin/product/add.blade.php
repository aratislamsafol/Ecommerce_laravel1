@extends('admin.admin_master')
@section('product') active @endsection
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


                    <div class="form-layout">
                      <div class="row mg-b-25">
                        <div class="col-lg-4">
                          <div class="form-group">
                            <label class="form-control-label">Firstname: <span class="tx-danger">*</span></label>
                            <input class="form-control" type="text" name="firstname" value="John Paul" placeholder="Enter firstname">
                          </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                          <div class="form-group">
                            <label class="form-control-label">Lastname: <span class="tx-danger">*</span></label>
                            <input class="form-control" type="text" name="lastname" value="McDoe" placeholder="Enter lastname">
                          </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                          <div class="form-group">
                            <label class="form-control-label">Email address: <span class="tx-danger">*</span></label>
                            <input class="form-control" type="text" name="email" value="johnpaul@yourdomain.com" placeholder="Enter email address">
                          </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-8">
                          <div class="form-group mg-b-10-force">
                            <label class="form-control-label">Mail Address: <span class="tx-danger">*</span></label>
                            <input class="form-control" type="text" name="address" value="Market St. San Francisco" placeholder="Enter address">
                          </div>
                        </div><!-- col-8 -->
                        <div class="col-lg-4">
                          <div class="form-group mg-b-10-force">
                            <label class="form-control-label">Country: <span class="tx-danger">*</span></label>
                            <select class="form-control select2" data-placeholder="Choose country">
                              <option label="Choose country"></option>
                              <option value="USA">United States of America</option>
                              <option value="UK">United Kingdom</option>
                              <option value="China">China</option>
                              <option value="Japan">Japan</option>
                            </select>
                          </div>
                        </div><!-- col-4 -->
                      </div><!-- row -->

                      <div class="form-layout-footer">
                        <button class="btn btn-info mg-r-5">Submit Form</button>
                        <button class="btn btn-secondary">Cancel</button>
                      </div><!-- form-layout-footer -->
                    </div><!-- form-layout -->
                </div><!-- card -->

            </div>
        </div>
    </div>
</div>
@endsection
