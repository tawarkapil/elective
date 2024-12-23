
<?php $__env->startSection('title'); ?>
<title>About Us - <?php echo e(ViewsHelper::getConfigKeyData('website_title')); ?></title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>  
<!-- Start main-content -->
  <div class="main-content">
    <!-- Section: inner-header -->
    <section class="inner-header divider layer-overlay overlay-dark" data-bg-img="<?php echo e(url('public/frontend/assets/images/about-banner.jpg')); ?>">
      <div class="container pt-30 pb-30">
        <!-- Section Content -->
        <div class="section-content text-center">
          <div class="row"> 
            <div class="col-md-6 col-md-offset-3 text-center">
              <h2 class="text-theme-colored font-36">About Us</h2>
              <ol class="breadcrumb text-center mt-10 white">
                <li><a href="<?php echo e(url('/')); ?>">Home</a></li>
                <li class="active">About Us</li>
              </ol>
            </div>
          </div>
        </div>
      </div>      
    </section>

    <!-- Section: About -->
    <section> 
      <div class="container">
        <div class="row">
          <div class="col-sm-12 col-md-7">
            <div class="image-carousel">
              <div class="item">
                <div class="thumb">
                  <img src="<?php echo e(url('public/frontend/assets/images/about-1.jpg')); ?>" alt="">
                </div>
              </div>
              <div class="item">
                <div class="thumb">
                  <img src="<?php echo e(url('public/frontend/assets/images/about-2.jpg')); ?>" alt="">
                </div>
              </div>
              <div class="item">
                <div class="thumb">
                  <img src="<?php echo e(url('public/frontend/assets/images/about-3.jpg')); ?>" alt="">
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-12 col-md-5">
            <h3 class="text-theme-colored text-uppercase mt-0">About Us</h3>
            <p>Lorem ipsum dolor sit amet, consectet adipisicing elit. Quas, veniam nobis minima. Delectus, dolorem rerum, eos nemo dolore amet quis, eum debiti modi voluptatibus ducimus molestiae laborum itaque quam maxime dolor amit laboriosam aperiam exercitationem.Cos nemo dolore amet quis, eum debiti modi voluptatibus ducimus molestiae laborum itaque quam maxime dolor amit laboriosam aperiam exercitationem. Amit dolor sit.</p>
            <div class="row mt-30 mb-30 ml-20">
             <div class="col-xs-6">
              <ul class="mt-10">
                <li class="mb-10"><i class="fa fa-check-circle text-theme-colored"></i>&emsp;Education</li>
                <li class="mb-10"><i class="fa fa-check-circle text-theme-colored"></i>&emsp;Community</li>
                <li class="mb-10"><i class="fa fa-check-circle text-theme-colored"></i>&emsp;Education</li>
              </ul>
             </div>
             <div class="col-xs-6">
              <ul class="mt-10">
                <li class="mb-10"><i class="fa fa-check-circle text-theme-colored"></i>&emsp;Education</li>
                <li class="mb-10"><i class="fa fa-check-circle text-theme-colored"></i>&emsp;Teamwork</li>
                <li class="mb-10"><i class="fa fa-check-circle text-theme-colored"></i>&emsp;Creativity</li>
              </ul>
             </div>
            </div>
            <p>Lorem ipsum dolor sit amet, consectet adipisicing elit. Quas, veniam nobis minima. Delectus, dolorem rerum, eos nemo dolore amet quis, eum debiti modi voluptatibus ducimus molestiae laborum itaque quam maxime dolor amit laboriosam aperiam exercitationem.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- divider: Became a Volunteers -->
    <section class="divider parallax layer-overlay overlay-deep" data-stellar-background-ratio="0.5" data-bg-img="http://placehold.it/1920x1280">
      <div class="container">
        <div class="section-content">
          <div class="row">
            <div class="col-md-12">
              <h3 class="line-bottom">Became a Volunteer</h3>
              <p class="mt-30 mb-30">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ex, et placeat ipsam, officiis fugiat doloremque ducimus tempore aliquid nihil soluta, quia similique veritatis! Quidem, repellendus exit placeat ipsam, officiis fugiat doloremque ducimus tempore aliquid nihil soluta, quia similique veritatis.</p>
              <a class="btn btn-dark btn-theme-colored btn-lg btn-flat pull-left pl-30 pr-30" href="#">Join Us</a>
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
<?php $__env->stopSection(); ?>
<?php $__env->startSection('styles'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/digital5/public_html/elective/resources/views/frontend/pages/about-us.blade.php ENDPATH**/ ?>