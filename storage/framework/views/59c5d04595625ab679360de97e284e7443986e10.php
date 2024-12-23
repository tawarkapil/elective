
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
              <h3 class="text-theme-colored font-36">Volunteers</h3>
              <ol class="breadcrumb text-center mt-10 white">
                <li><a href="<?php echo e(url('/')); ?>">Home</a></li>
                <li class="active">Volunteers</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Section: Volunteer -->
    <section class="divider parallax layer-overlay overlay-deep" >
      <div class="container pb-30">
        <div class="section-content">
          <?php if(count($customers) > 0): ?>
          <div class="row multi-row-clearfix">
            <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-sm-6 col-md-3 mb-sm-60 text-left sm-text-center">
              <div class="volunteer border bg-white-fa maxwidth400 mb-30 p-30" style="min-height: 455px;">
                <div class="thumb"><img alt="" style="width: 100%;height: 195px;object-fit: cover;" src="<?php echo e(ViewsHelper::displayUserProfileImage($customer)); ?>" class="img-fullwidth"></div>
                <div class="info">
                  <h4 class="name"><a href="<?php echo e($customer->getDetailsPageUrl()); ?>"><?php echo e($customer->full_name()); ?></a></h4>
                  <h6 class="occupation"><?php echo e($customer->occupation); ?></h6>
                  <p><?php echo $customer->short_about_me(); ?></p>
                  <hr>
                  <ul class="styled-icons icon-sm icon-dark icon-theme-colored mt-10 mb-0">
                      <li><a target="_blank" href="<?php echo e(($customer->facebook_url) ? url($customer->facebook_url) : '#'); ?>"><i class="fa fa-facebook"></i></a></li>
                      <li><a target="_blank" href="<?php echo e(($customer->twitter_url) ? url($customer->twitter_url) : '#'); ?>"><i class="fa fa-twitter"></i></a></li>
                     <li><a target="_blank" href="<?php echo e(($customer->instagram_url) ? url($customer->instagram_url) : '#'); ?>"><i class="fa fa-instagram"></i></a></li>
                     <li><a target="_blank" href="<?php echo e(($customer->google_url) ? url($customer->google_url) : '#'); ?>"><i class="fa fa-google-plus"></i></a></li>
                  </ul>
                </div>
              </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>
          <div class="row">
            <div class="col-sm-12">
              <?php echo $customers->render(); ?>

            </div>
          </div>

          <?php else: ?>
          <div class="display-table text-center">
            <div class="display-table-cell">
              <div class="container pt-0 pb-0">
                <div class="row">
                  <div class="col-md-8 col-md-offset-2">
                    <h2 class="mt-0">Oops! Not data Found</h2>
                    <p>The page you were looking for could not be found.</p>
                    <a class="btn btn-border btn-gray btn-transparent btn-circled" href="<?php echo e(url('/')); ?>">Return Home</a>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <?php endif; ?>
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

     
      
<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/digital5/public_html/elective/resources/views/frontend/pages/volunteer.blade.php ENDPATH**/ ?>