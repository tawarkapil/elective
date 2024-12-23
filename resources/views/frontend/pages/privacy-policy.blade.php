@extends('frontend.layouts.app')
@section('title')
<title>Privacy Policy - {{ ViewsHelper::getConfigKeyData('website_title') }}</title>
@stop
@section('content')
<!-- Start main-content -->
  <div class="main-content">
    <!-- Section: inner-header -->
    <section class="inner-header divider layer-overlay overlay-dark" data-bg-img="{{ url('public/frontend/assets/images/about-banner.jpg') }}">
      <div class="container pt-30 pb-30">
        <!-- Section Content -->
        <div class="section-content text-center">
          <div class="row"> 
            <div class="col-md-6 col-md-offset-3 text-center">
              <h2 class="text-theme-colored font-36">Privacy Policy</h2>
              <ol class="breadcrumb text-center mt-10 white">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li class="active">Privacy Policy</li>
              </ol>
            </div>
          </div>
        </div>
      </div>      
    </section>

    <!-- Section: About -->
    <section> 
      <div class="container">
        <div class="row">
          
          <div class="col-sm-12 col-md-12">
            <h3 class="text-theme-colored text-uppercase mt-0">Privacy Policy</h3>
            <p>Lorem ipsum dolor sit amet, consectet adipisicing elit. Quas, veniam nobis minima. Delectus, dolorem rerum, eos nemo dolore amet quis, eum debiti modi voluptatibus ducimus molestiae laborum itaque quam maxime dolor amit laboriosam aperiam exercitationem.Cos nemo dolore amet quis, eum debiti modi voluptatibus ducimus molestiae laborum itaque quam maxime dolor amit laboriosam aperiam exercitationem. Amit dolor sit.</p>
            <div class="row mt-30 mb-30">
             <div class="col-xs-12">
              <ul class="mt-10">
                <li class="mb-10"><i class="fa fa-check-circle text-theme-colored"></i>&emsp;Lorem ipsum dolor sit amet, consectet adipisicing elit.</li>
                <li class="mb-10"><i class="fa fa-check-circle text-theme-colored"></i>&emsp;Quas, veniam nobis minima. Delectus, dolorem rerum, eos nemo dolore amet quis.</li>
                <li class="mb-10"><i class="fa fa-check-circle text-theme-colored"></i>&emsp;Eum debiti modi voluptatibus ducimus molestiae laborum itaque quam maxime dolor amit laboriosam aperiam exercitationem.</li>
				<li class="mb-10"><i class="fa fa-check-circle text-theme-colored"></i>&emsp;Lorem ipsum dolor sit amet, consectet adipisicing elit.</li>
                <li class="mb-10"><i class="fa fa-check-circle text-theme-colored"></i>&emsp;Quas, veniam nobis minima. Delectus, dolorem rerum, eos nemo dolore amet quis.</li>
                <li class="mb-10"><i class="fa fa-check-circle text-theme-colored"></i>&emsp;Eum debiti modi voluptatibus ducimus molestiae laborum itaque quam maxime dolor amit laboriosam aperiam exercitationem.</li>
				<li class="mb-10"><i class="fa fa-check-circle text-theme-colored"></i>&emsp;Lorem ipsum dolor sit amet, consectet adipisicing elit.</li>
                <li class="mb-10"><i class="fa fa-check-circle text-theme-colored"></i>&emsp;Quas, veniam nobis minima. Delectus, dolorem rerum, eos nemo dolore amet quis.</li>
                <li class="mb-10"><i class="fa fa-check-circle text-theme-colored"></i>&emsp;Eum debiti modi voluptatibus ducimus molestiae laborum itaque quam maxime dolor amit laboriosam aperiam exercitationem.</li>
				
              </ul>
             </div>
             
            </div>
            <p>Lorem ipsum dolor sit amet, consectet adipisicing elit. Quas, veniam nobis minima. Delectus, dolorem rerum, eos nemo dolore amet quis, eum debiti modi voluptatibus ducimus molestiae laborum itaque quam maxime dolor amit laboriosam aperiam exercitationem.</p>
          </div>
        </div>
      </div>
    </section>
    
    @include('frontend.pages._quick_contact_frm')
   
   </div>
  <!-- end main-content -->
@stop
@section('scripts')
@stop
@section('styles')
@stop