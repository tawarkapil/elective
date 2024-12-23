@extends('frontend.layouts.app')
@section('title')
<title>Programs - {{ ViewsHelper::getConfigKeyData('website_title') }}</title>
@stop
@section('content')

  <!-- Start main-content -->
  <div class="main-content">
    <!-- Section: inner-header -->
    <section class="inner-header divider layer-overlay overlay-dark" data-bg-img="{{ url('public/frontend/assets/images/blog-banner.jpg') }}">
      <div class="container pt-30 pb-30">
        <!-- Section Content -->
        <div class="section-content text-center">
          <div class="row"> 
            <div class="col-md-6 col-md-offset-3 text-center">
              <h2 class="font-36 page_title">Programs</h2>
              <ol class="breadcrumb text-center mt-10 white">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li class="active">Programs</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </section>
    
    <section>
      <div class="container mt-30 mb-30 pt-30 pb-30">
       <div class="filter pt-30 pb-10 mb-30">
          <form action="{{ url('programs') }}">
               <div class="row d-flex align-items-center justify-Content-center flex-wrap">  			        <div class="col-sm-2 col-xs-12">                    			             <div class="form-group text-right mobile_text_center"> 
                            <label><strong>Filter for Destination</strong></label> 
                         </div> 
                    </div>
                 <div class="col-sm-3 col-xs-12">				    <div class="form-group mobile_mb_15 mr-20"> 
                       {!! Form::select('srch_destination', ['' => 'All Destinations'] + $destinations, $srch_destination, ['id' => 'srch_destination', 'class' => 'form-control']) !!} 
                    </div> 
                 </div>
                <div class="col-sm-1 col-xs-1"> 
                    <button type="submit" style="margin-top: -15px;" class="btn btn-colored btn-theme-colored btn-flat pull-right login_btn"><i class="fa fa-filter" aria-hidden="true"></i> Apply</button> 
                </div>
              </div>
            </form>
         </div>
        <div class="row ">
          <div class="col-md-12">
            <div class="blog-posts">
                @if(count($programs) > 0)
                  <div class="row ">
                   <div class="col-md-12">
                      @foreach($programs as $row)

                      <div class="col-sm-6 col-md-4 col-lg-4">
                          <article class="post clearfix maxwidth600 mb-30">
                            <div class="entry-header">
                              <div class="post-thumb thumb"> <img src="{{ url('public/uploads/programs/'.$row->image) }}" alt="" class="img-responsive img-fullwidth"> </div>
                              </div>
                            <div class="entry-content border-1px p-20">
                              <h5 class="entry-title mt-0 pt-0"><a href="{{ $row->getDetailsPageUrl() }}">{{ $row->title }}</a></h5>
                              <p class="text-left mb-20 mt-15 font-13 blog_min_height">{{ $row->short_desc(200) }}</p>
                              <a class="btn btn-dark btn-theme-colored btn-flat pull-left mt-0" href="{{ $row->getDetailsPageUrl() }}">Read more</a>
                              <div class="clearfix"></div>
                            </div>
                          </article>
                        </div>
                      @endforeach
                   </div>
                    <div class="col-md-12">
                     {!! $programs->appends(request()->input())->links() !!}
                   </div>
                </div>
                @else
                  <div class="row">
                    <div class="col-md-12 text-center">
                      <h2 class="mt-0">Oops! Not data Found</h2>
                      <p>The page you were looking for could not be found.</p>
                      <a class="btn btn-border btn-gray btn-transparent btn-circled" href="{{ url('/') }}">Return Home</a>
                    </div>
                  </div>
                @endif
            </div>
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