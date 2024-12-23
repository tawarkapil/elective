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
              <div class="col-md-10 col-md-push-1 text-center">
                <div class="white_box">
                @if($valid)
                   <h3 class="mt-0 pt-5 mb-20"> Email Verified!</h3> 
                    <p class="mb-20">Greetings and welcome to <strong>Elective Global</strong>! We are delighted to see you as a part of our community. Feel free to discover, interact, and collaborate with us to create something wonderful.</p>
                    <br>
                    <p class="text-center"><a class="btn btn-default" href="{{ url('dashboard') }}">Go to dashboard</a></p>
                  @else
                    <div >This token is invalid please click on below link and forget again the password</div>
                    <p class="text-center"><a  class="btn btn-default resend_verificaiton_mail" href="">Resend Again</a></p>
                  @endif
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
<script type="text/javascript" src="{{ url('public/frontend/custom/auth/account-activation.js') }}"></script>
@stop
@section('styles')
@stop


    