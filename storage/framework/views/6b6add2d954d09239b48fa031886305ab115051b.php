
<?php $__env->startSection('title'); ?>
<title><?php echo e($data->title); ?> - <?php echo e(ViewsHelper::getConfigKeyData('website_title')); ?></title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>  
<!-- Start main-content -->
  <div class="main-content">
    <!-- Section: inner-header -->
    <section class="inner-header divider layer-overlay overlay-dark" data-bg-img="<?php echo e(url('public/frontend/assets/images/volunteer-bg.jpg')); ?>">
      <div class="container pt-30 pb-30">
        <!-- Section Content -->
        <div class="section-content text-center">
          <div class="row"> 
            <div class="col-md-6 col-md-offset-3 text-center">
              <h2 class="text-theme-colored font-36"><?php echo e($data->title); ?></h2>
              <ol class="breadcrumb text-center mt-10 white">
                <li><a href="<?php echo e(url('/')); ?>">Home</a></li>
                <li><a href="<?php echo e(url('blogs')); ?>">Pages</a></li>
                <li class="active"><?php echo e($data->title); ?></li>
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
                    <?php if($data->upload_file == 'Video'): ?>
                        <?php echo $data->youtube_url; ?>

                      <?php elseif($data->upload_file == 'Image'): ?>
                        <?php if(count($data->attachments) == 1): ?>
                        <img alt="" src="<?php echo e(url($data->attachments[0]->attachment)); ?>" class="img-fullwidth img-responsive">
                        <?php else: ?>
                        <div class="widget-image-carousel">
                          <?php $__currentLoopData = $data->attachments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attach): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <div class="item">
                            <img src="<?php echo e(url($attach->attachment)); ?>" alt="">
                          </div>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <?php endif; ?>
                      <?php endif; ?> 
                  </div>
                </div>
                <div class="entry-title pt-0">
                  <h3><a href="#"><?php echo e($data->title); ?></a></h3>
                </div>
                <div class="entry-meta">
                  <ul class="list-inline">
                    <li>Posted: <span class="text-theme-colored"><?php echo e(ViewsHelper::displayDate($data->created_at)); ?></span></li>
                    <li>By: <span class="text-theme-colored"><?php echo e($data->author_name); ?></span></li>
                  </ul>
                </div>
                <div class="entry-content mt-10">
                  <?php echo $data->description; ?>

                  <div class="mt-30 mb-0">
                    <h5 class="pull-left mt-10 mr-20 text-theme-colored">Share:</h5>
                    <span id="jssocialshare"></span>
                  </div>
                </div>
              </article>
              <?php if($data->tags): ?>
              <div class="tagline p-0 pt-20 mt-5">
                <div class="row">
                  <div class="col-md-8">
                    <div class="tags">
                      <p class="mb-0"><i class="fa fa-tags text-theme-colored"></i> <span>Tags:</span><?php echo e($data->tags); ?></p>
                    </div>
                  </div>
                </div>
              </div>
              <?php endif; ?>
              <?php if($data->getcustomer): ?>
              <div class="author-details media-post">
                <a href="#" class="post-thumb mb-0"><img  style="width:100px;" class="img-thumbnail" alt="" src="<?php echo e(ViewsHelper::displayUserProfileImage($data->getcustomer)); ?>"></a>
                <div class="post-right">
                  <h5 class="post-title mt-0 mb-0"><a href="<?php echo e($data->getcustomer->getDetailsPageUrl()); ?>" class="font-18"><?php echo e($data->getcustomer->full_name()); ?></a></h5>
                  <p><?php echo $data->getcustomer->short_about_me(300); ?></p>
                  <ul class="styled-icons square-sm m-0">
                    <li><a target="_blank" href="<?php echo e(($data->getcustomer->facebook_url) ? url($data->getcustomer->facebook_url) : '#'); ?>"><i class="fa fa-facebook"></i></a></li>
                      <li><a target="_blank" href="<?php echo e(($data->getcustomer->twitter_url) ? url($data->getcustomer->twitter_url) : '#'); ?>"><i class="fa fa-twitter"></i></a></li>
                     <li><a target="_blank" href="<?php echo e(($data->getcustomer->instagram_url) ? url($data->getcustomer->instagram_url) : '#'); ?>"><i class="fa fa-instagram"></i></a></li>
                     <li><a target="_blank" href="<?php echo e(($data->getcustomer->google_url) ? url($data->getcustomer->google_url) : '#'); ?>"><i class="fa fa-google-plus"></i></a></li>
                  </ul>
                </div>
                <div class="clearfix"></div>
              </div>
              <?php endif; ?>
              <div id="comment-refresh-container">
                <div id="comment-refresh-box"> 
                  <?php if(count($comments) > 0): ?>
                  <div class="comments-area">
                    <h5 class="comments-title">Comments (<?php echo e(count($comments)); ?>)</h5>
                    <ul class="comment-list" style="max-height: 400px;overflow-y: scroll;">
                      <?php $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <li>
                        <div class="media comment-author"> 
                          <a class="media-left" href="<?php echo e(($val->getcustomer) ? $val->getcustomer->full_name() : 'N/A'); ?>">
                          <img class="img-thumbnail" src="<?php echo e(($val->getcustomer) ? $val->getcustomer->full_name() : 'N/A'); ?>" alt=""></a>
                          <div class="media-body">
                            <h5 class="media-heading comment-heading"><?php echo e(($val->getcustomer) ? $val->getcustomer->full_name() : 'N/A'); ?> says:</h5>
                            <div class="comment-date"><?php echo e(ViewsHelper::displayDate($val->created_at)); ?></div>
                            <p><?php echo e($val->comment); ?></p>
                            </div>
                        </div>
                      </li>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                  </div>
                  <?php endif; ?>
                  <?php if(Auth::guard('customer')->check()): ?>
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
                  <?php endif; ?>
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
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><a href="<?php echo e(url('blogs')); ?>?category=<?php echo e($row->id); ?>"><?php echo e($row->title); ?><span> (<?php echo e($row->getPostCount()); ?>)</span></a></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </ul>
                </div>
              </div>
              <?php if(count($similar_blogs) > 0): ?>
              <div class="widget">
                <h5 class="widget-title line-bottom">Latest News</h5>
                <div class="latest-posts">
                  <?php $__currentLoopData = $similar_blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <article class="post media-post clearfix pb-0 mb-10">
                    <a class="post-thumb" href="#"><img src="https://placehold.it/75x75" alt=""></a>
                    <div class="post-right">
                      <h5 class="post-title mt-0"><a href="<?php echo e($row->getDetailsPageUrl()); ?>"><?php echo e($row->short_title(25)); ?></a></h5>
                      <p><?php echo e($row->short_desc(50)); ?></p>
                    </div>
                  </article>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
              </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </section>

    <?php echo $__env->make('frontend.pages._quick_contact_frm', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
  </div>
  <!-- end main-content -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials.min.js"></script>
<script>
    $("#jssocialshare").jsSocials({
        showLabel: false,
        showCount: false,
        shareIn: "popup",
        url: "<?php echo e($data->getDetailsPageUrl()); ?>",
        text: "<?php echo e($data->title); ?>",
        shares: ["twitter", "facebook", "googleplus", "linkedin"]
    });
</script>
<script type="text/javascript">
  var blog_id = "<?php echo e(base64_encode($data->id)); ?>";
  var id = 0;
</script>
<script type="text/javascript" src="<?php echo e(url('public/frontend/custom/pages/blog-details.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('styles'); ?>
<link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials.css" />
<link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials-theme-flat.css" />
<style type="text/css">
  .jssocials-share-link { 
    border-radius: 50%; 
  }
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp82\htdocs\elective\resources\views/frontend/pages/blog-details.blade.php ENDPATH**/ ?>