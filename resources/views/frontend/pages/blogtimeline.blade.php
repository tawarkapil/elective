@extends('frontend.layouts.app')
@section('title')
<title>Blogs - {{ ViewsHelper::getConfigKeyData('website_title') }}</title>
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
              <h2 class="text-theme-colored font-36">Blogs Timeline</h2>
              <ol class="breadcrumb text-center mt-10 white">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li class="active">Blogs Timeline</li>
              </ol>
            </div>
          </div>
        </div>
      </div>      
    </section>

      @if(count($data) > 0)
      <section id="cd-timeline" class="cd-container timeline-post-load-container">
        @foreach($data as $row)
        <div class="cd-timeline-block">
          <div class="{{ ($row->upload_file == 'Video') ? 'cd-timeline-img cd-movie bounce-in' : 'cd-timeline-img cd-picture'}}">
            @if($row->upload_file == 'Video')
            <img src="{{ url('public/frontend/assets/js/vertical-timeline/img/cd-icon-movie.svg') }}" alt="Picture">
            @else
            <img src="{{ url('public/frontend/assets/js/vertical-timeline/img/cd-icon-picture.svg') }}" alt="Video">
            @endif
          </div> <!-- cd-timeline-img -->

          <div class="cd-timeline-content">
            <article class="post clearfix">
              <div class="entry-header">
                <div class="post-thumb">

                  @if($row->upload_file == 'Video')
                  <!--  -->
                  {!! $row->youtube_url !!}
                  @elseif($row->upload_file == 'Image')
                    @if(count($row->attachments) == 1)
                    <img alt="" src="{{ url($row->attachments[0]->attachment) }}" class="img-fullwidth img-responsive">
                    @else
                    <div class="widget-image-carousel">
                      @foreach($row->attachments as $attach)
                      <div class="item">
                        <img src="{{ url($attach->attachment) }}" alt="">
                      </div>
                      @endforeach
                    </div>
                    @endif
                  @endif
                </div>
                <h5 class="entry-title"><a href="{{ $row->getDetailsPageUrl() }}">{{ $row->title }}</a></h5>
                <ul class="list-inline font-12 mb-20 mt-10">
                  <li><a class="text-theme-colored" href="{{ ($row->getcustomer) ?  $row->getcustomer->getDetailsPageUrl() : '#' }}">{{ $row->author_name }}</a></li> | 
                  <li><span class="text-theme-colored">{{ ViewsHelper::displayDate($row->created_at) }}</span></li>
                </ul>
              </div>
              <div class="entry-content">
                <p class="mb-30">{{ $row->short_desc(300) }} <a href="{{ $row->getDetailsPageUrl() }}">[...]</a></p>
                <ul class="list-inline like-comment pull-left font-12">
                  <li><i class="pe-7s-comment"></i>{{ $row->comments->count() }}</li>
                </ul>
                <a class="pull-right text-gray font-13" href="{{ $row->getDetailsPageUrl() }}"><i class="fa fa-angle-double-right text-theme-colored"></i> Read more</a>
              </div>
            </article>
          </div> 
        </div>
        @endforeach
      </section>

      @if($data->nextPageUrl())
        <div class="row load-more-container">
           <div class="col-md-12 text-center">
              <a href="{{ $data->nextPageUrl() }}" data-currentpage="{{ $data->currentPage() }}" data-lastpage="{{ $data->lastPage() }}" class="btn btn-default btn-theme-colored load-more-btn"><i class="fa fa-loading"></i> Load more </a>
                <br>
                <br>
                <br>
           </div>
        </div>
      @endif
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
  <!-- end main-content -->
@stop
@section('scripts')
<script type="text/javascript">
  $(function(){
    var page = false;
    $('body').on('click', '.load-more-btn', function(e){
      e.preventDefault();
     
      var lastpage = $(this).data('lastpage');
      if(page == false){
         var currentpage = $(this).data('currentpage');
        page = currentpage;
      }

      page = page + 1;

      $.ajax({
        type: "POST",
        url: HTTP_PATH + "ajax-load-blogs-timeline",
        data: 'page=' + page +'&_token=' + CSRF_TOKEN,
        dataType: 'json',
        success: function (data) {
          if (data.status == 1) {
            $('.timeline-post-load-container').append(data.html);
            // $('.load-more-btn').attr('data-currentpage', page);
            $(".widget-image-carousel").owlCarousel({
              items : 1,
            });
            if(page == lastpage){
                $('.load-more-btn').closest('.load-more-container').remove();
            }
          }
        }
      });

    });
  })
</script>
@stop
@section('styles')
@stop

     
      