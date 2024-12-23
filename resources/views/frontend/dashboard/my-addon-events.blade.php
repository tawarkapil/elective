@extends('frontend.layouts.dashboard_app')
@section('title')
<title>My Add-Ons/Events - {{ ViewsHelper::getConfigKeyData('website_title') }}</title>
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
              <h2 class="text-white mt-10">My Add-Ons/Events</h2>
            </div>
            <div class="col-sm-4">
              <ol class="breadcrumb white mt-10 text-right xs-text-center"> 
                <li><a href="{{ url('dashboard') }}">Dashboard</a></li>
                <li class="active">My Add-Ons/Events</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </section> 
   
@include('frontend.layouts.sidebar')   

    <!-- Section: Registration Form -->
    <section class="divider">
      <div class="container">
        <div class="row">
          @include('frontend.layouts.stepprogressbar')
          <div class="col-md-12">
            <div class="border-1px p-30 mb-0 bg-white pt-10">
              <div class="section-container">
                  <h4 class="pagesub_title">My Add-Ons/Events</h4>
                  <p>Welcome to the Add-Ons / Events section of your dashboard, where you can explore a variety of opportunities to enhance your elective experience. This segment offers a range of professional enrichment options such as experiences in different hospital settings, rural healthcare exposure, public health initiatives, research opportunities, outreach programs, and educational seminars.</p>
                  <p>
                     <ul class="list-icon theme-colored listnone pl-0">
                      <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b>Diverse Opportunities:</b> From hospital rotations to public health projects, these add-ons are designed to broaden your clinical and academic horizons and complement your core elective.</span></li>
                      <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b>Charges and Availability:</b> We offer select add-ons as a gesture to enrich your elective experience and professional growth. Whether these add-ons or events incur an additional charge depends on various factors, including the nature of the activity and our arrangements with providers. Due to limited availability, we recommend securing your spot early to take full advantage of these valuable opportunities, enhancing your educational journey with us.</span></li>
                    </ul>
                  </p>
                  <p class="text-center mt-20">
                    <a target="_blank" class="btn btn-dark btn-theme-colored btn-xl" href="{{ url('events') }}">Explore Add-ons/Events</a>
                  </p>
              </div>
            </div>
        </div>

        <div class="col-md-12 form-group mt-10">
          <a href="{{ url('guide-tours') }}" class="btn btn-border btn-theme-colored pull-right">Next: Explore Tours/Activities <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
    </section>
  </div>
  <!-- end main-content -->
@stop
@section('styles')
@stop
@section('scripts')
@stop