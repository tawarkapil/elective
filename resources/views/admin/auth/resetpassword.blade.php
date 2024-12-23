@extends('admin.layouts.login_app')
@section('title')
<title>Reset Password - {{ ViewsHelper::getConfigKeyData('website_title') }}</title>
@stop
@section('content')

<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
        <div><b>Reset Password</b></div>
    </div>
    <div class="card-body login-card-body">
        @if(!$valid)
        <div class="row">
          <div class="col-lg-12">
                <div >This token is expired please click on below link and forgot again the password</div>
            </div>
        </div>
        @else
      <div class="row">
          <div class="col-lg-12">
              <div class="glb-message-bx"></div>
          </div>
      </div>

      <form id="submitFrm" name="submitFrm">
        
        <div class="form-group  mb-3">
            <label for="new_password">New Password <span class="required text-danger">*</span></label>
            <input type="password" class="form-control" placeholder="New Password" name="new_password" id="new_password">  
        </div>
        <input type="hidden" name="reset_key" value="{{ $token }}">
        <div class="form-group mb-3">
            <label for="confirm_password">Confirm  Password <span class="required text-danger">*</span></label>
          <input type="password" class="form-control" placeholder="Confirm Password" name="confirm_password" id="confirm_password">
        </div>
        <div class="row">
          <div class="col-lg-12">
            <button type="submit" class="btn btn-primary btn-block">Reset password</button>
          </div>
          <div class="col-lg-12 text-center mt-3">
            <a class=" " href="{{ url('admin/login') }}">I remembered my password</a>
          </div>
          <!-- /.col -->
        </div>
        @endif
      </form>
     
    </div>
  </div>
</div>
@stop

@section('scripts')
<script type="text/javascript" src="{{ url('public/panel/custom/auth/reset-password.min.js') }}{{ Config::get('params.app_version') }}"></script>
@stop
@section('styles')
@stop