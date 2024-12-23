@extends('frontend.layouts.app')

@section('title')

<title>Volunteers - {{ ViewsHelper::getConfigKeyData('website_title') }}</title>

@stop

@section('content')  

  <!-- Start main-content -->

  <div class="main-content">

    <!-- Section: inner-header -->

    <section class="inner-header divider layer-overlay overlay-dark" data-bg-img="{{ url('public/frontend/assets/images/volunteer-bg.jpg') }}">

      <div class="container pt-30 pb-30">

        <!-- Section Content -->

        <div class="section-content text-center">

          <div class="row"> 

            <div class="col-md-6 col-md-offset-3 text-center">

              <h3 class="text-theme-colored font-36">Volunteer Details</h3>

              <ol class="breadcrumb text-center mt-10 white">

                <li><a href="{{ url('/') }}">Home</a></li>

                <li><a href="{{ url('volunteer') }}">Volunteers</a></li>

                <li class="active">Volunteer Details</li>

              </ol>

            </div>

          </div>

        </div>

      </div>      

    </section>

      

    <!-- Section: Volunteer Details -->

    <section>

      <div class="container">

        <div class="section-content">

          <div class="row">

            <div class="col-md-4">

              <div class="thumb">

                <img style="height: 270px;object-fit: cover;" src="{{ ViewsHelper::displayUserProfileImage($customer) }}" alt="">

              </div>

            </div>

            <div class="col-md-8">
              <div>
                <h4 class="line-bottom text-uppercase mt-0 pull-left">Volunteer</h4>
                <a href="{{ url('blogs-timeline/'.base64_encode($customer->customer_id)) }}" class="btn btn-success pull-right">Blog Timeline</a>
              </div>
              <br>

              <h5 class="name mt-30 mb-0">{{ $customer->full_name() }}</h5>

              <h6 class="mt-5">{{ $customer->occupation }}</h6>

              <p>{!! $customer->about_me !!}</p>

              <ul class="styled-icons icon-dark icon-theme-colored icon-sm mt-15 mb-0">

               <li><a target="_blank" href="{{ ($customer->facebook_url) ? url($customer->facebook_url) : '#' }}"><i class="fa fa-facebook"></i></a></li>

               <li><a target="_blank" href="{{ ($customer->twitter_url) ? url($customer->twitter_url) : '#' }}"><i class="fa fa-twitter"></i></a></li>

               <li><a target="_blank" href="{{ ($customer->instagram_url) ? url($customer->instagram_url) : '#' }}"><i class="fa fa-instagram"></i></a></li>

               <li><a target="_blank" href="{{ ($customer->google_url) ? url($customer->google_url) : '#' }}"><i class="fa fa-google-plus"></i></a></li>

             </ul>

            </div>

          </div>

          <div class="row mt-30">

            <div class="col-md-4">

              <h4 class="line-bottom">About Me:</h4>

              <div class="volunteer-address">

                <ul>

                  <li>

                    <div class="bg-light media border-bottom p-15 mb-20">

                      <div class="media-left">

                        <i class="fa fa-map-marker text-theme-colored font-24 mt-5"></i>

                      </div>

                      <div class="media-body">

                        <h5 class="mt-0 mb-0">Address:</h5>

                        <p>{{ $customer->displayAddress() }}</p>

                      </div>

                    </div>

                  </li>

                  <li>

                    <div class="bg-light media border-bottom p-15">

                      <div class="media-left">

                        <i class="fa fa-phone text-theme-colored font-24 mt-5"></i>

                      </div>

                      <div class="media-body">

                        <h5 class="mt-0 mb-0">Contact:</h5>

                        <p><span>Phone:</span> {{ $customer->displayPhoneNumber() }}<br><span>Email:</span> {{ $customer->email }}</p>

                      </div>

                    </div>

                  </li>

                </ul>

              </div>

            </div>

            <div class="col-md-4">

              <h4 class="line-bottom">Find Location:</h4>



              <!-- Google Map HTML Codes -->

               <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5456.163483134849!2d144.95177475051227!3d-37.81589041361766!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad65d4dd5a05d97%3A0x3e64f855a564844d!2s121+King+St%2C+Melbourne+VIC+3000%2C+Australia!5e0!3m2!1sen!2sbd!4v1556130803137!5m2!1sen!2sbd" width="100%" height="290" frameborder="0" style="border:0" allowfullscreen=""></iframe>

              <div class="map-popupstring hidden" id="popupstring1">

                <div class="text-center">

                  <h3>CharityFund Office</h3>

                  <p>121 King Street, Melbourne Victoria 3000 Australia</p>

                </div>

              </div>

              <!-- Google Map Javascript Codes -->

              <script src="http://maps.google.com/maps/api/js"></script>

              <script src="js/google-map-init.js"></script>

            </div>

            <div class="col-md-4">

              <div class="clearfix">

                <h4 class="line-bottom">Quick Contact:</h4>

              </div>

              <form id="quickContactFrm" name="quickContactFrm" class="contact-form-transparent">

                <div class="row">

                  <div class="col-sm-12">

                    <div class="form-group">

                      <input type="text" placeholder="Enter Name" id="contact_name" name="contact_name" value="{{ Auth::guard('customer')->user()->full_name() }}" readonly="" class="form-control">

                    </div>

                  </div>

                  <div class="col-sm-12">

                    <div class="form-group">

                      <input type="text" placeholder="Enter Subject" id="subject" name="subject" class="form-control" value="">

                      <span class="multi-custom-error" for="subject"></span>

                    </div>

                  </div>

                </div>

                <div class="form-group">

                  <textarea rows="5" placeholder="Enter Message" id="message" name="message" class="form-control"></textarea>

                  <span class="multi-custom-error" for="message"></span>

                </div>

                <div class="form-group">

                  <button data-loading-text="Please wait..." class="btn btn-flat btn-dark btn-theme-colored mt-5" type="submit">Send your message</button>

                </div>

              </form>

            </div>

          </div>

        </div>

      </div>

    </section>



    @if(count($blogsdata) > 0)

     <section>

      <div class="container pt-10">

        <div class="section-title text-center">

          <div class="row">

            <div class="col-md-8 col-md-offset-2">

              <h3 class="text-uppercase mt-0">Volunteer Blogs</h3>

              <div class="title-icon">

                <i class="flaticon-charity-hand-holding-a-heart"></i>

              </div>

              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem autem<br> voluptatem obcaecati!</p>

            </div>

          </div>

        </div>

        <div class="row">

          <div class="col-md-12">

            <div class="news-carousel owl-nav-top mb-sm-80" data-dots="true">

              @foreach($blogsdata as $row)

              <div class="item">

                <article class="post clearfix maxwidth600 mb-sm-30">

                  <div class="entry-header">

                    <div class="post-thumb thumb"> 

                      @if($row->upload_file == 'Video')

                        {!! $row->youtube_url !!}

                        @elseif($row->upload_file == 'Image')

                        <img alt="" src="{{ url($row->attachments[0]->attachment) }}" class="img-fullwidth img-responsive">

                        @else

                        <img src="{{ url('public/common/no-image.png') }}" alt="" class="img-responsive img-fullwidth" style="height: 209px;"> 

                      @endif 

                    </div>

                  </div>

                  <div class="entry-content border-1px p-20">

                    <h5 class="entry-title mt-0 pt-0"><a title="{{ $row->title }}" href="{{ $row->getDetailsPageUrl() }}">{{ $row->short_title(40) }}</a></h5>

                    <p class="text-left mb-20 mt-15 font-13 text-justify">{{ $row->short_desc(100) }}</p>

                    <a class="btn btn-flat btn-dark btn-theme-colored btn-sm pull-left mt-0" href="{{ $row->getDetailsPageUrl() }}">Read more</a>

                    <ul class="list-inline entry-date pull-right font-12 mt-5">

                      <li><a class="text-theme-colored" href="{{ ($row->getcustomer) ?  $row->getcustomer->getDetailsPageUrl() : '#' }}">{{ $row->author_name }}</a></li> | <li><span class="text-theme-colored">{{ ViewsHelper::displayDate($row->created_at) }}</span></li>

                    </ul>

                    <div class="clearfix"></div>

                  </div>

                </article>

              </div>

              @endforeach



            </div>

          </div>

        </div>

      </div>

    </section>

    @endif

  </div>

  <!-- end main-content -->

@stop

@section('scripts')

<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials.min.js"></script>

<script>

    $("#jssocialshare").jsSocials({

        showLabel: false,

        showCount: false,

        shareIn: "popup",

        url: "{{ $customer->getDetailsPageUrl() }}",

        text: "{{ $customer->full_name() }}",

        shares: ["twitter", "facebook", "googleplus", "linkedin"]

    });

</script>

<script type="text/javascript">

  var customer_id = "{{ base64_encode($customer->customer_id) }}";

</script>

<script type="text/javascript" src="{{ url('public/frontend/custom/pages/volunteer-details.js') }}"></script>

@stop

@section('styles')

<link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials.css" />

<link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials-theme-flat.css" />

<style type="text/css">

  .jssocials-share-link { 

    border-radius: 50%; 

  }

  .entry-content{

    min-height: 190px;

  }

</style>

@stop