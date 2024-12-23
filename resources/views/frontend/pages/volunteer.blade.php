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
              <h3 class="text-theme-colored font-36">Volunteers</h3>
              <ol class="breadcrumb text-center mt-10 white">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li class="active">Volunteers</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Section: Volunteer -->
    <section class="divider parallax layer-overlay overlay-deep" >
      <div class="container pb-30">
        <div class="section-content">
          @if(count($customers) > 0)
          <div class="row multi-row-clearfix">
            @foreach($customers as $customer)
            <div class="col-sm-6 col-md-3 mb-sm-60 text-left sm-text-center">
              <div class="volunteer border bg-white-fa maxwidth400 mb-30 p-30" style="min-height: 455px;">
                <div class="thumb"><img alt="" style="width: 100%;height: 195px;object-fit: cover;" src="{{ ViewsHelper::displayUserProfileImage($customer) }}" class="img-fullwidth"></div>
                <div class="info">
                  <h4 class="name"><a href="{{ $customer->getDetailsPageUrl() }}">{{ $customer->full_name() }}</a></h4>
                  <h6 class="occupation">{{ $customer->occupation }}</h6>
                  <p>{!! $customer->short_about_me() !!}</p>
                  <hr>
                  <ul class="styled-icons icon-sm icon-dark icon-theme-colored mt-10 mb-0">
                      <li><a target="_blank" href="{{ ($customer->facebook_url) ? url($customer->facebook_url) : '#' }}"><i class="fa fa-facebook"></i></a></li>
                      <li><a target="_blank" href="{{ ($customer->twitter_url) ? url($customer->twitter_url) : '#' }}"><i class="fa fa-twitter"></i></a></li>
                     <li><a target="_blank" href="{{ ($customer->instagram_url) ? url($customer->instagram_url) : '#' }}"><i class="fa fa-instagram"></i></a></li>
                     <li><a target="_blank" href="{{ ($customer->google_url) ? url($customer->google_url) : '#' }}"><i class="fa fa-google-plus"></i></a></li>
                  </ul>
                </div>
              </div>
            </div>
            @endforeach
          </div>
          <div class="row">
            <div class="col-sm-12">
              {!! $customers->render() !!}
            </div>
          </div>

          @else
          <div class="display-table text-center">
            <div class="display-table-cell">
              <div class="container pt-0 pb-0">
                <div class="row">
                  <div class="col-md-8 col-md-offset-2">
                    <h2 class="mt-0">Oops! Not data Found</h2>
                    <p>The page you were looking for could not be found.</p>
                    <a class="btn btn-border btn-gray btn-transparent btn-circled" href="{{ url('/') }}">Return Home</a>
                  </div>
                </div>
              </div>
            </div>
          </div>

          @endif
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

     
      