@extends('frontend.layouts.app')
@section('title')
<title>{{ $data->title }} - {{ ViewsHelper::getConfigKeyData('website_title') }}</title>
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
              <h2 class="text-theme-colored font-36">{{ $data->title }}</h2>
              <ol class="breadcrumb text-center mt-10 white">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li><a href="{{ url('blogs') }}">Pages</a></li>
                <li class="active">{{ $data->title }}</li>
              </ol>
            </div>
          </div>
        </div>
      </div>      
    </section>

    <!-- Section: Blog -->
    <section>
      <div class="container mt-30 mb-30 pt-30 pb-30">
        <div class="row">
          <div class="col-md-9">
            <div class="blog-posts single-post">
              <article class="post clearfix mb-0">
                <div class="entry-header">
                  <div class="post-thumb thumb"> 
                    @if($data->upload_file == 'Video')
                        {!! $data->youtube_url !!}
                      @elseif($data->upload_file == 'Image')
                        @if(count($data->attachments) == 1)
                        <img alt="" src="{{ url($data->attachments[0]->attachment) }}" class="img-fullwidth img-responsive">
                        @else
                        <div class="widget-image-carousel">
                          @foreach($data->attachments as $attach)
                          <div class="item">
                            <img src="{{ url($attach->attachment) }}" alt="">
                          </div>
                          @endforeach
                        </div>
                        @endif
                      @endif 
                  </div>
                </div>
                <div class="entry-title pt-0">
                  <h3><a href="#">{{ $data->title }}</a></h3>
                </div>
                <div class="entry-meta">
                  <ul class="list-inline">
                    <li>Posted: <span class="text-theme-colored">{{ ViewsHelper::displayDate($data->created_at) }}</span></li>
                    <li>By: <span class="text-theme-colored">{{ $data->author_name }}</span></li>
                  </ul>
                </div>
                <div class="entry-content mt-10">
                  {!! $data->description !!}
                  <div class="mt-30 mb-0">
                    <h5 class="pull-left mt-10 mr-20 text-theme-colored">Share:</h5>
                    <span id="jssocialshare"></span>
                  </div>
                </div>
              </article>
              @if($data->tags)
              <div class="tagline p-0 pt-20 mt-5">
                <div class="row">
                  <div class="col-md-8">
                    <div class="tags">
                      <p class="mb-0"><i class="fa fa-tags text-theme-colored"></i> <span>Tags:</span>{{ $data->tags }}</p>
                    </div>
                  </div>
                </div>
              </div>
              @endif
              @if($data->getcustomer)
              <div class="author-details media-post">
                <a href="#" class="post-thumb mb-0"><img  style="width:100px;" class="img-thumbnail" alt="" src="{{ ViewsHelper::displayUserProfileImage($data->getcustomer) }}"></a>
                <div class="post-right">
                  <h5 class="post-title mt-0 mb-0"><a href="{{ $data->getcustomer->getDetailsPageUrl() }}" class="font-18">{{ $data->getcustomer->full_name() }}</a></h5>
                  <p>{!! $data->getcustomer->short_about_me(300) !!}</p>
                  <ul class="styled-icons square-sm m-0">
                    <li><a target="_blank" href="{{ ($data->getcustomer->facebook_url) ? url($data->getcustomer->facebook_url) : '#' }}"><i class="fa fa-facebook"></i></a></li>
                      <li><a target="_blank" href="{{ ($data->getcustomer->twitter_url) ? url($data->getcustomer->twitter_url) : '#' }}"><i class="fa fa-twitter"></i></a></li>
                     <li><a target="_blank" href="{{ ($data->getcustomer->instagram_url) ? url($data->getcustomer->instagram_url) : '#' }}"><i class="fa fa-instagram"></i></a></li>
                     <li><a target="_blank" href="{{ ($data->getcustomer->google_url) ? url($data->getcustomer->google_url) : '#' }}"><i class="fa fa-google-plus"></i></a></li>
                  </ul>
                </div>
                <div class="clearfix"></div>
              </div>
              @endif
              <div id="comment-refresh-container">
                <div id="comment-refresh-box"> 
                  @if(count($comments) > 0)
                  <div class="comments-area">
                    <h5 class="comments-title">Comments ({{ count($comments) }})</h5>
                    <ul class="comment-list" style="max-height: 400px;overflow-y: scroll;">
                      @foreach($comments as $val)
                      <li>
                        <div class="media comment-author"> 
                          <a class="media-left" href="{{ ($val->getcustomer) ? $val->getcustomer->full_name() : 'N/A'}}">
                          <img class="img-thumbnail" src="{{ ($val->getcustomer) ? $val->getcustomer->full_name() : 'N/A'}}" alt=""></a>
                          <div class="media-body">
                            <h5 class="media-heading comment-heading">{{ ($val->getcustomer) ? $val->getcustomer->full_name() : 'N/A'}} says:</h5>
                            <div class="comment-date">{{ ViewsHelper::displayDate($val->created_at) }}</div>
                            <p>{{ $val->comment }}</p>
                            </div>
                        </div>
                      </li>
                      @endforeach
                    </ul>
                  </div>
                  @endif
                  @if(Auth::guard('customer')->check())
                  <div class="comment-box">
                    <div class="row">
                      <div class="col-sm-12">
                        <h5>Leave a Comment</h5>
                        <div class="row">
                          <form role="form" id="commentSubmitFrm" name="commentSubmitFrm">
                            <div class="col-sm-12">
                              <div class="form-group">
                                <label for="comment">Comment <span class="required text-danger">*</span></label>
                                <textarea class="form-control" required name="comment" id="comment"  placeholder="Enter Message" rows="4"></textarea>
                              </div>
                              <div class="form-group">
                                <button type="submit" class="btn btn-dark btn-flat pull-right m-0" data-loading-text="Please wait...">Submit</button>
                              </div>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                  @endif
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-12 col-md-3">
            <div class="sidebar sidebar-right mt-sm-30">
              <div class="widget">
                <h5 class="widget-title line-bottom">Categories</h5>
                <div class="categories">
                  <ul class="list list-border angle-double-right">
                    @foreach($categories as $row)
                    <li><a href="{{ url('blogs') }}?category={{ $row->id }}">{{ $row->title }}<span> ({{ $row->getPostCount() }})</span></a></li>
                    @endforeach
                  </ul>
                </div>
              </div>
              @if(count($similar_blogs) > 0)
              <div class="widget">
                <h5 class="widget-title line-bottom">Latest News</h5>
                <div class="latest-posts">
                  @foreach($similar_blogs as $row)
                  <article class="post media-post clearfix pb-0 mb-10">
                    <a class="post-thumb" href="#"><img src="https://placehold.it/75x75" alt=""></a>
                    <div class="post-right">
                      <h5 class="post-title mt-0"><a href="{{ $row->getDetailsPageUrl() }}">{{ $row->short_title(25) }}</a></h5>
                      <p>{{ $row->short_desc(50) }}</p>
                    </div>
                  </article>
                  @endforeach
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
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials.min.js"></script>
<script>
    $("#jssocialshare").jsSocials({
        showLabel: false,
        showCount: false,
        shareIn: "popup",
        url: "{{ $data->getDetailsPageUrl() }}",
        text: "{{ $data->title }}",
        shares: ["twitter", "facebook", "googleplus", "linkedin"]
    });
</script>
<script type="text/javascript">
  var blog_id = "{{ base64_encode($data->id) }}";
  var id = 0;
</script>
<script type="text/javascript" src="{{ url('public/frontend/custom/pages/blog-details.js') }}"></script>
@stop
@section('styles')
<link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials.css" />
<link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials-theme-flat.css" />
<style type="text/css">
  .jssocials-share-link { 
    border-radius: 50%; 
  }
</style>
@stop