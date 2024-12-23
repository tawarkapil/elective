@extends('frontend.layouts.login_app')
@section('title')
<title>Login Page - {{ ViewsHelper::getConfigKeyData('website_title') }}</title>
@stop
@section('content')
<div class="main-content">
    <!-- Section: home -->
    <section id="home" class="divider bg-lighter">
      <div class="display-table">
        <div class="display-table-cell">
          <div class="container">
            <div class="row">
              <div class="col-md-6 col-md-push-3">
                <div class="white_box m-50">
                <!-- <div class="text-center mb-60 logo_title"><a href="#" class="">Electives <span class="text-theme-colored">Global</span></a> -->
                <!-- </div> -->
                <h3 class="text-theme-colored mt-0 pt-5 text-center"> Login</h3>
                <hr> 
                <form  id="submitFrm" name="submitFrm" class="clearfix">
                  <div class="row">
                      <div class="col-lg-12">
                          <div class="glb-message-bx"></div>
                      </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-md-12">
                      <label for="email">Email <span class="required text-danger">*</span></label>
                      <input id="email" name="email" class="form-control" type="text">
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-md-12">
                      <label for="password">Password <span class="required text-danger">*</span></label>
                      <input type="password" id="password" name="password" class="form-control" type="text">
                    </div>
                  </div>
                  <div class="checkbox pull-left mt-15">
                    <label for="remember_me">
                      <input id="remember_me" name="remember_me" type="checkbox"> Remember me </label>

                  </div>
                  <div class="form-group pull-right mt-10">
                       <a class="text-theme-colored font-weight-600 font-12" href="{{ url('forgot-password') }}">Forgot Your Password?</a>
                  </div>
                  
                  <div class="clear text-center pt-10">
                    <button type="submit" class="btn btn-dark btn-block">Login</button> 
                  </div>

                  <div class="form-group text-center mt-20">
                       <a class="text-theme-colored font-weight-600 font-12" href="{{ url('register') }}"> Create an account ?</a>
                  </div>
                </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@stop
@section('scripts')
<script type="text/javascript" src="{{ url('public/frontend/custom/auth/login.js') }}{{ Config::get('params.app_version') }}"></script>
@stop
@section('styles')
@stop


    