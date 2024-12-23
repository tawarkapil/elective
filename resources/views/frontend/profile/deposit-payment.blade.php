@extends('frontend.layouts.dashboard_app')
@section('title')
<title>Application - {{ ViewsHelper::getConfigKeyData('website_title') }}</title>
@stop
@section('content')
 <!-- Start main-content -->
  <div class="main-content dashboard">
  
    <section class="inner-header divider layer-overlay overlay-dark"  data-bg-img="{{ url('public/frontend/assets/images/contact-us.jpg') }}">
      <div class="container pt-30 pb-30">
        <!-- Section Content -->
        <div class="section-content">
          <div class="row"> 
            <div class="col-sm-8 xs-text-center">
              <h2 class="text-white mt-10">Application</h2>
            </div>
            <div class="col-sm-4">
              <ol class="breadcrumb white mt-10 text-right xs-text-center"> 
                <li><a href="{{ url('dashboard') }}">Dashboard</a></li>
                <li class="active">Application</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </section> 
    

    <!-- Section: Registration Form -->
    @include('frontend.layouts.sidebar')
    <section class="divider">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 col-lg-offset-3">
            <div class="border-1px p-30 mb-0 bg-white pt-10">
              <div class="section-container section-box1">
                  <div class="row">
                <div class="col-lg-12"> 
                   
                    <h4 class="pagesub_title">Amount to be Paid: {{ ViewsHelper::displayAmount($data->payable_amount) }}</h4>
                    <h5 class="mb-3">Credit Card/debit card</h5>
                   <form name="stripeSubmitFrm" id="stripeSubmitFrm" data-cc-on-file="false" data-stripe-publishable-key="{{ Config::get('stripe.api_key') }}">
                        <div class="row g-3">
                            <div class="col-xl-12 col-lg-12">
                                <div class="form-group">
                                    <label for="full_name">Card Holder Name <span class="required text-danger">*</span></label>
                                    <input type="text" class="form-control card-inp full-name" autocomplete="off" placeholder="Full Name"  id="full_name" />
                                    <span for="full_name" class="custom-error-show"></span>
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12">
                                <div class="form-group  card-number required" style="border: unset;">
                                    <label for="card-number">Credit / Debit Card <span class="required text-danger">*</span></label>
                                    <input type="text" maxlength="19" autocomplete='off' class='form-control cc-number-input card-inp card_image' placeholder="0000 0000 0000 0000" id="card-number" />
                                    <span for="card-number" class="custom-error-show"></span>
                                </div>
                            </div>

                            <div class="col-xl-6 col-lg-6">
                                <div class="form-group cvc required">
                                    <label for="cc-expiry-input">Expiration Date <span class="required text-danger">*</span></label>
                                    <input class='form-control card-inp cc-expiry-input' placeholder="MM/YY" maxlength="5" type='text' id="cc-expiry-input" autocomplete="off" />
                                    <span for="card-cvc" class="custom-error-show"></span>
                                </div>
                            </div>

                            <div class="col-xl-6 col-lg-6">
                                <div class="form-group cvc required">
                                    <label for="card-cvc">Security Code (CVV) <span class="required text-danger">*</span></label>
                                    <input class='form-control card-inp cc-cvc-input allow_only_number' maxlength="3" type='password' placeholder="CVV" id="card-cvc" autocomplete="off" />
                                    <span for="card-cvc" class="custom-error-show"></span>
                                </div>
                            </div>

                            <div class="col-lg-12 mt-20 text-center">
                                <button type="submit" class="btn btn-theme-colored btn-circled btn-lg  lock_btn_cls completePaymentBtn float-end">Complete Payment</button>
                            </div>
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
  <!-- end main-content -->


@stop
@section('styles')
<style type="text/css">
    #stripeSubmitFrm input{
        font-size: 18px;
        font-weight: 600;
    }
    
</style>
@stop
@section('scripts')
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript" src="{{ url('public/frontend/custom/profile/deposit-payment.js') }}"></script>
@stop