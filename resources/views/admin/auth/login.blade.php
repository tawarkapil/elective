@extends('admin.layouts.login_app')
@section('title')
<title>Login Page - {{ ViewsHelper::getConfigKeyData('website_title') }}</title>
@stop
@section('content')
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
        <div><b>Sign In to Admin</b></div>
        <small>
            <span>Sign in to start your session</span>
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
        <div class="form-group mb-3">
            <label for="email">Password <span class="required text-danger">*</span></label>
          <input type="password" class="form-control" placeholder="Password" name="password" id="password">
        </div>
        <div class="row">
          <div class="col-12 mb-3">
            <div class="icheck-primary float-left">
              <input type="checkbox"  id="remember_me" name="remember_me" value="Yes">
              <label for="remember_me">
                Remember Me
              </label>
            </div>
            <a class="float-right mt-1" href="{{ url('admin/forgot-password') }}">Forgot Password</a>
          </div>
          <!-- /.col -->
          <div class="col-lg-12">
            <button type="submit" class="btn btn-primary btn-block">Login</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
     
    </div>
  </div>
</div>
@stop
@section('scripts')
<script type="text/javascript" src="{{ url('public/panel/custom/auth/login.js') }}{{ Config::get('params.app_version') }}"></script>
@stop
@section('styles')
@stop


    