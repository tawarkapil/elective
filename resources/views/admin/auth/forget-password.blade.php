@extends('admin.layouts.login_app')
@section('title')
<title>Forgot Password - {{ ViewsHelper::getConfigKeyData('website_title') }}</title>
@stop
@section('content')
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
        <div><b>Forgot Password?</b></div>
        <small>
            <span>Please enter registered email address to get a reset password link</span>
        </small>
    </div>
    <div class="card-body login-card-body">
      <div class="row">
          <div class="col-lg-12">
              <div class="glb-message-bx"></div>
          </div>
      </div>

      <form id="submitFrm" name="submitFrm">
        
        <div class="form-group  mb-3">
            <label for="email">Email <span class="required text-danger">*</span></label>
            <input type="email" class="form-control" placeholder="Email" name="email" id="email">  
        </div>
        <div class="row">
          
          <!-- /.col -->
          <div class="col-lg-12">
            <button type="submit" class="btn btn-primary btn-block">SUBMIT</button>
          </div>
          <!-- /.col -->
          <div class="col-lg-12 text-center mt-3">
            <a class=" " href="{{ url('admin/login') }}">I remembered my password</a>
          </div>
        </div>
      </form>
     
    </div>
  </div>
</div>
@stop

@section('scripts')
<script type="text/javascript" src="{{ url('public/panel/custom/auth/forget-password.min.js') }}{{ Config::get('params.app_version') }}"></script>
@stop
@section('styles')
<style type="text/css">
    .d-block{
        display: block;
        width: 100%;
    }
</style>
@stop

