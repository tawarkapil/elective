@extends('frontend.layouts.login_app')
@section('title')
<title>Create Password - {{ ViewsHelper::getConfigKeyData('website_title') }}</title>
@stop
@section('content')
<!-- start main-content -->
  <div class="main-content">
    <!-- Section: home -->
    <section id="home" class="divider bg-lighter">
      <div class="display-table">
        <div class="display-table-cell">
          <div class="container">
            <div class="row">
              <div class="col-md-6 col-md-push-3">
                <div class="white_box m-50">
               <!--  <div class="text-center mb-60 logo_title"><a href="#" class="">Electives <span class="text-theme-colored">Global</span></a>
                </div> -->
                <h3 class="text-theme-colored mt-0 pt-5 text-center"> Create Password</h2>
                <hr> 
                 @if($valid)
                <form  id="submitFrm" name="submitFrm" class="clearfix">
                  <div class="row">
                      <div class="col-lg-12">
                          <div class="glb-message-bx"></div>
                      </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-md-12">
                        <label for="new_password">New Password  <span class="required text-danger">*</span></label>
                        <input type="password" name="new_password" id="new_password" class="form-control form-control-lg" placeholder="New Password">
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-md-12">
                      <label  for="confirm_password">Confirm Password  <span class="required text-danger">*</span></label>
                        <input type="password" name="confirm_password" id="confirm_password" class="form-control form-control-lg" placeholder="Confirm Password">
                    </div>
                  </div>
                
                    <input type="hidden" name="reset_key" value="{{ $token }}">
                  <div class="clear text-center pt-10">
                    <button type="submit" class="btn btn-dark btn-block">Create password</button> 
                  </div>
                </form>
                @else
                <div >This link to create your password is expired. Please <a href="{{ url('forgot-password') }}" style="color: #2962ff;"> click here</a> to request the link again.</div>
                @endif
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- end main-content -->
@stop

@section('scripts')
<script type="text/javascript" src="{{ url('public/frontend/custom/auth/createpass.js') }}{{ Config::get('params.app_version') }}"></script>
@stop
@section('styles')
<style type="text/css">
    .d-block{
        display: block;
        width: 100%;
    }
</style>
@stop