@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Change Password</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item active">Change Password</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Change Password</h3>
          </div>

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
                        <div class="col-lg-12">
                            <div class="float-right">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>

          </div>
        </div>
      </div>
    </section>
</div>
@endsection
@section('scripts')
<?php
    $change_password_page = true;
 ?>
<script type="text/javascript" src="{{ url('public/panel/custom/auth/change-password.min.js') }}{{ Config::get('params.app_version') }}"></script>
@stop


 

  