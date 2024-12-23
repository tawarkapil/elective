@extends('frontend.layouts.dashboard_app')
@section('title')
<title>My Blogs - {{ ViewsHelper::getConfigKeyData('website_title') }}</title>
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
              <h2 class="text-white mt-10">My Blogs</h2>
            </div>
            <div class="col-sm-4">
              <ol class="breadcrumb white mt-10 text-right xs-text-center"> 
                <li><a href="{{ url('dashboard') }}">Dashboard</a></li>
                <li class="active">My Blogs</li>
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
        @include('frontend.layouts.stepprogressbar')
        <div class="row"> 
          <div class="col-md-12">
            <div class="border-1px p-30 mb-0 bg-white pt-10">
              <div class="section-container">
                  <h4 class="pagesub_title">My Blogs</h4>
                  <p>Welcome to your Blogs platform for inspiration, connection, and reflection!</p>
                  <p>This is your space to share the extraordinary moments, challenges, and triumphs of your elective experience. Your blogs will capture the essence of your journey - from cultural immersion to professional growth - shaping not only your own narrative but also inspiring future generations of healthcare professionals worldwide.</p>
                  <p>
                    <label>Whether it&#39;s a quick few sentences, a video, or a more extensive reflection, dive in to blogging for:</label>
                    <ul class="list-icon theme-colored listnone pl-0">
                      <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b>Community and Sharing:</b> Connect with a global community, sharing experiences and best practices.</span></li>
                      <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b>Reflection and Learning:</b> Blogs serve as a reflective tool for both you and others, enhancing learning.<span></li>
                      <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b>Networking:</b> Forge new connections within the global healthcare community.</span></li>
                      <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b>Contributing to Future Journeys:</b> Your blog can be a valuable resource for peers planning their electives.</span></li>
                      <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b>Participation in Elective Global Spotlight:</b> By writing a blog, you&#39;re automatically entered into our &quot;Elective Global Spotlight&quot; raffle/prizes and could be the next lucky winner of special prizes or discounts. A little tip: videos get more points!</span></li>
                    </ul>
                  </p>
                 <p class="text-center mt-20">
                    <a target="_blank" class="btn btn-dark btn-theme-colored btn-xl" href="{{ url('my-blogs') }}">Jump in to your Blogs</a>
                  </p>
              </div>
            </div>
        </div>
        <div class="col-md-12 form-group mt-10">
          <a href="{{ url('fund-my-elective') }}" class="btn btn-border btn-theme-colored pull-right">Next: Fund my elective <i class="fa fa-arrow-circle-right"></i></a>
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