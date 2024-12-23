@extends('frontend.layouts.dashboard_app')

@section('title')

<title>Contact Us - {{ ViewsHelper::getConfigKeyData('website_title') }}</title>

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

              <h2 class="text-white mt-10">Contact Us</h2>

            </div>

            <div class="col-sm-4">

              <ol class="breadcrumb white mt-10 text-right xs-text-center"> 

                <li><a href="{{ url('dashboard') }}">Dashboard</a></li>

                <li class="active">Contact Us</li>

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
          

          <div class="col-md-12">

            <div class="white_box">

                <div class="row">

                      <div class="col-sm-12 col-md-12">

                        <h3 class="text-theme-colored text-uppercase mt-0">Contact Us</h3>

                        <p>Lorem ipsum dolor sit amet, consectet adipisicing elit. <a href="#" class="text-theme-colored-blue">Quas, veniam nobis minima.</a> Delectus, dolorem rerum, eos nemo dolore amet quis, eum debiti modi voluptatibus ducimus molestiae laborum itaque quam maxime dolor amit laboriosam aperiam exercitationem.Cos nemo dolore amet quis, eum debiti modi voluptatibus ducimus molestiae laborum itaque quam maxime dolor amit laboriosam aperiam exercitationem. Amit dolor sit.</p>

                        <div class="row mt-30 mb-30">

                         <div class="col-xs-12">

                          <ul class="mt-10">

                            <li class="mb-10"><i class="fa fa-check-circle text-theme-colored"></i> Lorem ipsum dolor sit amet, consectet adipisicing elit.</li>

                            <li class="mb-10"><i class="fa fa-check-circle text-theme-colored"></i> Quas, veniam nobis minima. Delectus, dolorem rerum, eos nemo dolore amet quis.</li>

                            <li class="mb-10"><i class="fa fa-check-circle text-theme-colored"></i> Eum debiti modi voluptatibus ducimus molestiae laborum itaque quam maxime dolor amit laboriosam aperiam exercitationem.</li>

                    <li class="mb-10"><i class="fa fa-check-circle text-theme-colored"></i> Lorem ipsum dolor sit amet, consectet adipisicing elit.</li>

                            <li class="mb-10"><i class="fa fa-check-circle text-theme-colored"></i> Quas, veniam nobis minima. Delectus, dolorem rerum, eos nemo dolore amet quis.</li>

                            <li class="mb-10"><i class="fa fa-check-circle text-theme-colored"></i> Eum debiti modi voluptatibus ducimus molestiae laborum itaque quam maxime dolor amit laboriosam aperiam exercitationem.</li>

                    <li class="mb-10"><i class="fa fa-check-circle text-theme-colored"></i> Lorem ipsum dolor sit amet, consectet adipisicing elit.</li>

                            <li class="mb-10"><i class="fa fa-check-circle text-theme-colored"></i> Quas, veniam nobis minima. Delectus, dolorem rerum, eos nemo dolore amet quis.</li>

                            <li class="mb-10"><i class="fa fa-check-circle text-theme-colored"></i> Eum debiti modi voluptatibus ducimus molestiae laborum itaque quam maxime dolor amit laboriosam aperiam exercitationem.</li>

                    

                          </ul>

                         </div>

                         

                        </div>

                        <p>Lorem ipsum dolor sit amet, consectet adipisicing elit. Quas, veniam nobis minima. Delectus, dolorem rerum, eos nemo dolore amet quis, eum debiti modi voluptatibus ducimus molestiae laborum itaque quam maxime dolor amit laboriosam aperiam exercitationem.</p>

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

@endsection

@section('scripts') 

@endsection