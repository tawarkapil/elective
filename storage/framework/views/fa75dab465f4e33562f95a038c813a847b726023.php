
<?php $__env->startSection('title'); ?>
<title>Volunteers - <?php echo e(ViewsHelper::getConfigKeyData('website_title')); ?></title>
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
              <h3 class="text-theme-colored font-36">Trip Details</h3>
              <ol class="breadcrumb text-center mt-10 white">
                <li><a href="<?php echo e(url('/')); ?>">Home</a></li>
                <li><a href="<?php echo e(url('trips')); ?>">Trips</a></li>
                <li class="active">Trip Details</li>
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
                <img style="height: 270px;object-fit: cover;" src="<?php echo e(ViewsHelper::getTripCoverImage($data)); ?>" alt="">
              </div>
            </div>
            <div class="col-md-8">
              <div class="">
                <h4 class="line-bottom text-uppercase mt-0 pull-start">Trip</h4>
                <a href="#" class="btn btn-success pull-right">Join This Group</a>
              </div>
              <h5 class="name mt-30 mb-0"><?php echo e($data->title); ?></h5>
              <h6 class="mt-5">Organiser : <?php echo e(($data->getcustomer) ? $data->getcustomer->full_name() : 'N/A'); ?></h6>
              <p><?php echo $data->description; ?></p>
                <div class="mt-30 mb-0">
                    <h5 class="pull-left mt-10 mr-20 text-theme-colored">Share:</h5>
                    <span id="jssocialshare"></span>
                  </div>
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
                        <h5 class="mt-0 mb-0">Destination:</h5>
                        <p><?php echo e($data->title); ?></p>
                      </div>
                    </div>
                  </li>
                    <div class="bg-light media border-bottom p-15 mb-20">
                      <div class="media-left">
                        <i class="fa fa-map-marker text-theme-colored font-24 mt-5"></i>
                      </div>
                      <div class="media-body">
                        <h5 class="mt-0 mb-0">Duration:</h5>
                        <p>2 Week</p>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="bg-light media border-bottom p-15">
                      <div class="media-left">
                        <i class="fa fa-phone text-theme-colored font-24 mt-5"></i>
                      </div>
                      <div class="media-body">
                        <h5 class="mt-0 mb-0">Members:</h5>
                        <p>
                          <span>Member 1:</span> Rahul Nagar<br>
                          <span>Member 2:</span> Ravi Nagar
                        </p>
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
                      <input type="text" placeholder="Enter Name" id="contact_name" name="contact_name" value="<?php echo e((Auth::guard('customer')->check()) ? Auth::guard('customer')->user()->full_name() : ''); ?>" readonly="" class="form-control">
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

    <?php if(count($similar_trips) > 0): ?>
     <section>
      <div class="container pt-10">
        <div class="section-title text-center">
          <div class="row">
            <div class="col-md-8 col-md-offset-2">
              <h3 class="text-uppercase mt-0">Other Trending Groups</h3>
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
              <?php $__currentLoopData = $similar_trips; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div class="item">
                <article class="post clearfix maxwidth600 mb-sm-30">
                  <div class="entry-header">
                    <div class="post-thumb thumb"> 
                        <img src="<?php echo e(ViewsHelper::getTripCoverImage($row)); ?>" alt="" class="img-responsive img-fullwidth"> 
                    </div>
                  </div>
                  <div class="entry-content border-1px p-20">
                    <h5 class="entry-title mt-0 pt-0"><a title="<?php echo e($row->title); ?>" href="<?php echo e($row->getDetailsPageUrl()); ?>"><?php echo e($row->short_title(40)); ?></a></h5>
                    <p class="text-left mb-20 mt-15 font-13 text-justify"><?php echo e($row->short_desc(150)); ?></p>
                    <a class="btn btn-flat btn-dark btn-theme-colored btn-sm pull-left mt-0" href="<?php echo e($row->getDetailsPageUrl()); ?>">Read more</a>
                    <ul class="list-inline entry-date pull-right font-12 mt-5">
                      <li><a class="text-theme-colored" href="<?php echo e(($row->getcustomer) ?  $row->getcustomer->getDetailsPageUrl() : '#'); ?>"><?php echo e($row->author_name); ?></a></li> | <li><span class="text-theme-colored"><?php echo e(ViewsHelper::displayDate($row->created_at)); ?></span></li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                </article>
              </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>
          </div>
        </div>
      </div>
    </section>
    <?php endif; ?>
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
<script type="text/javascript" src="<?php echo e(url('public/frontend/custom/pages/volunteer-details.js')); ?>"></script>
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
<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/digital5/public_html/elective/resources/views/frontend/pages/trips-details.blade.php ENDPATH**/ ?>