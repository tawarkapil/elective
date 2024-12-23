<?php $__env->startSection('title'); ?>
<title>My Group - <?php echo e(ViewsHelper::getConfigKeyData('website_title')); ?></title>
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
              <h2 class="text-white mt-10">My Group</h2>
            </div>
            <div class="col-sm-4">
              <ol class="breadcrumb white mt-10 text-right xs-text-center"> 
                <li><a href="<?php echo e(url('dashboard')); ?>">Dashboard</a></li>
                <li class="active">My Group</li>
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
        <?php echo $__env->make('frontend.layouts.stepprogressbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="row"> 
          <div class="col-md-12">
            <div class="border-1px p-30 mb-0 bg-white pt-10">
              <div class="section-container">
                  <h4 class="pagesub_title">My Group</h4>
                  <p>Welcome to &quot;My Group&quot; – your collaborative hub at Electives Global! Here, you&#39;ll connect with fellow students embarking on similar healthcare electives months before you set off on your elective.</p>
                  <p>
                    <label>Highlights of this unique feature of Electives Global:</label>
                    <ul class="list-icon theme-colored listnone pl-0">
                      <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b>Connect and Collaborate:</b> This space is perfect for exchanging ideas, planning group activities, and offering mutual support throughout your elective journey. Got a student going on a tour?<br>
                      <strong class="theme-colored">Join in!</strong></span></li>
                      <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b>Private Group:</b> Each group within &#39;My Group&#39; is provided with a private area in our larger WhatsApp community. This exclusive space allows for more personalized interaction and sharing among group members. Use this group chat while on elective for day-to-day collaboration too.</span></li>
                      <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b>Exclusive Group Discounts:</b> Wait! Did you know Group members get discounts too?! At Electives Global, we&#39;re committed to making your journey affordable. By traveling in a group, we&#39;re able to reduce certain costs, and we&#39;re delighted to share these savings with you through exclusive group discounts. To view the group discounts profile, please click here.</span></li>
                      <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b>Build Lasting Relationships and Networks:</b> In &#39;My Group&#39;, not only will you meet peers for your upcoming elective, but you&#39;ll also have the chance to form long-lasting relationships with like-minded students passionate about making a positive impact in healthcare around the world.</span></li>
                    </ul>
                  </p>
                  <p>
                    <b>Get Started:</b> Unsure how to proceed? Check out our Group Trips Guide. It&#39;s simple! Follow the steps, start your own group, or join one, and embark on this memorable journey with your new friends.
                  </p>
              </div>
            </div>
        </div>
        <div class="col-md-12 form-group mt-10">
          <a href="<?php echo e(url('guide-blogs')); ?>" class="btn btn-border btn-theme-colored pull-right">Next: My Blogs <i class="fa fa-arrow-circle-right"></i></a>
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
<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/digital5/public_html/elective/resources/views/frontend/dashboard/guide-group.blade.php ENDPATH**/ ?>