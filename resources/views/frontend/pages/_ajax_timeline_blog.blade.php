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