
<?php $__env->startSection('title'); ?>
<title>Blogs - <?php echo e(ViewsHelper::getConfigKeyData('website_title')); ?></title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
  <!-- Start main-content -->
  <div class="main-content">
    <!-- Section: inner-header -->
    <section class="inner-header divider layer-overlay overlay-dark" data-bg-img="<?php echo e(url('public/frontend/assets/images/blog-banner.jpg')); ?>">
      <div class="container pt-30 pb-30">
        <!-- Section Content -->
        <div class="section-content text-center">
          <div class="row"> 
            <div class="col-md-6 col-md-offset-3 text-center">
              <h2 class="text-theme-colored font-36">Blogs Timeline</h2>
              <ol class="breadcrumb text-center mt-10 white">
                <li><a href="<?php echo e(url('/')); ?>">Home</a></li>
                <li class="active">Blogs Timeline</li>
              </ol>
            </div>
          </div>
        </div>
      </div>      
    </section>

      <?php if(count($data) > 0): ?>
      <section id="cd-timeline" class="cd-container timeline-post-load-container">
        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="cd-timeline-block">
          <div class="<?php echo e(($row->upload_file == 'Video') ? 'cd-timeline-img cd-movie bounce-in' : 'cd-timeline-img cd-picture'); ?>">
            <?php if($row->upload_file == 'Video'): ?>
            <img src="<?php echo e(url('public/frontend/assets/js/vertical-timeline/img/cd-icon-movie.svg')); ?>" alt="Picture">
            <?php else: ?>
            <img src="<?php echo e(url('public/frontend/assets/js/vertical-timeline/img/cd-icon-picture.svg')); ?>" alt="Video">
            <?php endif; ?>
          </div> <!-- cd-timeline-img -->

          <div class="cd-timeline-content">
            <article class="post clearfix">
              <div class="entry-header">
                <div class="post-thumb">

                  <?php if($row->upload_file == 'Video'): ?>
                  <!--  -->
                  <?php echo $row->youtube_url; ?>

                  <?php elseif($row->upload_file == 'Image'): ?>
                    <?php if(count($row->attachments) == 1): ?>
                    <img alt="" src="<?php echo e(url($row->attachments[0]->attachment)); ?>" class="img-fullwidth img-responsive">
                    <?php else: ?>
                    <div class="widget-image-carousel">
                      <?php $__currentLoopData = $row->attachments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attach): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <div class="item">
                        <img src="<?php echo e(url($attach->attachment)); ?>" alt="">
                      </div>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <?php endif; ?>
                  <?php endif; ?>
                </div>
                <h5 class="entry-title"><a href="<?php echo e($row->getDetailsPageUrl()); ?>"><?php echo e($row->title); ?></a></h5>
                <ul class="list-inline font-12 mb-20 mt-10">
                  <li><a class="text-theme-colored" href="<?php echo e(($row->getcustomer) ?  $row->getcustomer->getDetailsPageUrl() : '#'); ?>"><?php echo e($row->author_name); ?></a></li> | 
                  <li><span class="text-theme-colored"><?php echo e(ViewsHelper::displayDate($row->created_at)); ?></span></li>
                </ul>
              </div>
              <div class="entry-content">
                <p class="mb-30"><?php echo e($row->short_desc(300)); ?> <a href="<?php echo e($row->getDetailsPageUrl()); ?>">[...]</a></p>
                <ul class="list-inline like-comment pull-left font-12">
                  <li><i class="pe-7s-comment"></i><?php echo e($row->comments->count()); ?></li>
                </ul>
                <a class="pull-right text-gray font-13" href="<?php echo e($row->getDetailsPageUrl()); ?>"><i class="fa fa-angle-double-right text-theme-colored"></i> Read more</a>
              </div>
            </article>
          </div> 
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </section>

      <?php if($data->nextPageUrl()): ?>
        <div class="row load-more-container">
           <div class="col-md-12 text-center">
              <a href="<?php echo e($data->nextPageUrl()); ?>" data-currentpage="<?php echo e($data->currentPage()); ?>" data-lastpage="<?php echo e($data->lastPage()); ?>" class="btn btn-default btn-theme-colored load-more-btn"><i class="fa fa-loading"></i> Load more </a>
                <br>
                <br>
                <br>
           </div>
        </div>
      <?php endif; ?>
      <?php else: ?>
      <div class="row">
        <div class="col-md-12 text-center">
          <h2 class="mt-0">Oops! Not data Found</h2>
          <p>The page you were looking for could not be found.</p>
          <a class="btn btn-border btn-gray btn-transparent btn-circled" href="<?php echo e(url('/')); ?>">Return Home</a>
        </div>
      </div>
      <?php endif; ?>
  </div>
  <!-- end main-content -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
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
<?php $__env->stopSection(); ?>
<?php $__env->startSection('styles'); ?>
<?php $__env->stopSection(); ?>

     
      
<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp82\htdocs\elective\resources\views/frontend/pages/blogtimeline.blade.php ENDPATH**/ ?>