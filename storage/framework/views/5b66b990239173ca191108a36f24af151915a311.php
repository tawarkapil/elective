<?php $__env->startSection('title'); ?>
<title>My Tours/ Activities - <?php echo e(ViewsHelper::getConfigKeyData('website_title')); ?></title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
 <!-- Start main-content -->
  <div class="main-content dashboard">
  
    <section class="inner-header divider layer-overlay overlay-dark"  data-bg-img="<?php echo e(url('public/frontend/assets/images/contact-us.jpg')); ?>">
      <div class="container pt-30 pb-30">
        <!-- Section Content -->
        <div class="section-content">
          <div class="row"> 
            <div class="col-sm-8 xs-text-center">
              <h2 class="text-white mt-10">My Tours/ Activities</h2>
            </div>
            <div class="col-sm-4">
              <ol class="breadcrumb white mt-10 text-right xs-text-center"> 
                <li><a href="<?php echo e(url('dashboard')); ?>">Dashboard</a></li>
                <li class="active">My Tours/ Activities</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </section> 
   <?php echo $__env->make('frontend.layouts.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 

    <!-- Section: Registration Form -->
    <section class="divider">
      <div class="container">
        <div class="row">
          <?php echo $__env->make('frontend.layouts.stepprogressbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
          <div class="col-md-12">
            <div class="border-1px p-30 mb-0 bg-white pt-10">
              <div class="section-container">
                 <h4 class="pagesub_title">My Tours/ Activities</h4>
                  <p>Welcome to the Tours and Activities section, your gateway to exhilarating experiences beyond your elective work. Whether it's climbing Mt. Kilimanjaro, taking a scenic 45-minute flight around Mt. Everest, or immersing yourself in local culture, this section offers a diverse range of activities to enrich your time abroad. Here, you'll find the perfect balance of professional growth and adventurous exploration.</p>
                  <p>
                     <ul class="list-icon theme-colored listnone pl-0">
                      <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b>Diverse Offerings:</b> Our carefully selected tours and activities range from adventure excursions and city tours to community engagement and networking meetups, ensuring a well-rounded experience.</span></li>
                      <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b>Exclusive Deals:</b> We take pride in negotiating excellent deals for these tours and activities, thanks to our strong relationships with providers. These special arrangements often result in offerings not readily available to the general public.</span></li>
                      <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b>Cost:</b> While we are pleased to offer some of these experiences at no extra charge, others will incur a cost. This allows us to cater to a variety of interests and budgets.</span></li>
                      <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b>Limited Availability:</b> To ensure you don’t miss out, we recommend booking early due to their popularity and limited availability.</span></li>
                    </ul>
                  </p>
                  <p class="text-center mt-20">
                    <a target="_blank" class="btn btn-dark btn-theme-colored btn-xl" href="<?php echo e(url('tours')); ?>">Explore Tours/Activities</a>
                  </p>
              </div>
            </div>
        </div>

        <div class="col-md-12 form-group mt-10">
          <a href="<?php echo e(url('guide-group')); ?>" class="btn btn-border btn-theme-colored pull-right">Next: My Group <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
    </section>
  </div>
  <!-- end main-content -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('styles'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/digital5/public_html/elective/resources/views/frontend/dashboard/my-tours.blade.php ENDPATH**/ ?>