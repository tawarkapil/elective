<div class="row list-dashed">
    @foreach($data as $row)
   <div class="col-md-6"> 
      <article class="post clearfix maxwidth600 border-1px  mb-30">
         <div class="entry-header">
            <div class="post-thumb thumb">
               @if($row->upload_file == 'Video')
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
         </div>
         <div class="entry-content p-20">
		    <h5 class="entry-title"><a href="{{ $row->getDetailsPageUrl() }}">{{ $row->title }}</a></h5>
            <ul class="list-inline font-12 mb-20 mt-10">
               <li><a class="text-theme-colored-blue" href="{{ ($row->getcustomer) ?  $row->getcustomer->getDetailsPageUrl() : '#' }}">{{ $row->author_name }} |</a></li>
               <li><span class="text-theme-colored-blue">{{ ViewsHelper::displayDate($row->created_at) }}</span></li>
            </ul>
            <p class="mb-30 line-clamp">{{ $row->short_desc(500) }} <!--<a href="{{ $row->getDetailsPageUrl() }}">[...]</a>--></p>
			<div class="mb-30">
            <ul class="list-inline like-comment pull-left font-12 text-yellow" style="font-weight:bold;">
               <li><i class="pe-7s-comment"></i>{{ $row->comments->count() }}</li>
               <!-- <li><i class="pe-7s-like2"></i>125</li> -->
            </ul>
            <a class="pull-right btn btn-dark btn-theme-colored btn-flat" href="{{ $row->getDetailsPageUrl() }}"><i class="fa fa-angle-double-right text-theme-colored"></i> Read more</a>
			</div>
			<div class="clearfix"></div>
         </div>
      </article> 
   </div>
    @endforeach
</div>
<div class="row pagination_container">
   <div class="col-md-12">
      <nav>
         {!! $data->render() !!}
      </nav>
   </div>
</div>