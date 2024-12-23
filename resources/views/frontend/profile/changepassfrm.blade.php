@extends('frontend.layouts.dashboard_app')
@section('content')

<div class="content-wrapper">
  
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Change Password</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Change Password</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">

      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">
                <!-- <i class="far fa-chart-bar"></i> -->
                Change Password
              </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <form  name="submitFrm" id="submitFrm">
                    <div class="row">
                        <div class="col-lg-4 form-group">
                            <label for="old_password">Old Password <span class="required text-danger">*</span></label>
                            <input type="password" class="form-control" name="old_password" id="old_password" > 
                        </div>
                        <div class="col-lg-4 form-group">
                            <label for="new_password">New Password <span class="required text-danger">*</span></label>
                            <input type="password" class="form-control" name="new_password" id="new_password" > 
                        </div>
                        <div class="col-lg-4 form-group">
                            <label for="confirm_password">Confirm Password <span class="required text-danger">*</span></label>
                            <input type="password" class="form-control" name="confirm_password" id="confirm_password" > 
                        </div>
                        <div class="col-lg-12 form-group">
                            <div class="text-center">
                                <button type="submit" class="btn btn-dark btn-theme-colored btn-sm mt-20 pt-10 pb-10" data-loading-text="Please wait...">Change Password</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
@endsection
@section('scripts')
<?php
    $change_password_page = true;
 ?>
<script type="text/javascript" src="{{ url('public/frontend/custom/auth/change-password.min.js') }}{{ Config::get('params.app_version') }}"></script>
@stop


 

  