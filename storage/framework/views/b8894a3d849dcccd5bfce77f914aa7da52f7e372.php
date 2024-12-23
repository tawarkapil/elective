<?php $__env->startSection('title'); ?>
<title>Application - <?php echo e(ViewsHelper::getConfigKeyData('website_title')); ?></title>
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
              <h2 class="text-white mt-10">Application</h2>
            </div>
            <div class="col-sm-4">
              <ol class="breadcrumb white mt-10 text-right xs-text-center"> 
                <li><a href="<?php echo e(url('dashboard')); ?>">Dashboard</a></li>
                <li class="active">Application</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </section> 
    

    <!-- Section: Registration Form -->
    <?php echo $__env->make('frontend.layouts.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <section class="divider">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 col-lg-offset-3">
            <div class="border-1px p-30 mb-0 bg-white">
              <div class="section-container section-box1">
                  <div class="row">
                <div class="col-lg-12"> 
                   
                    <div class="alert alert-success mb-0" role="alert">
                      <div class="mb-2">
                        <i class="bx bx-check-circle right-success"></i>
                      </div>
                       <p class="fs-5  text-dark mb-3">Thank you for completing the payment. A receipt generated will be sent to your email confirming the payment. Please upload company documents to initiate the services.</p>

                      <a href="<?php echo e(url('application-documents')); ?>" class="btn btn-success mb-20 mt-20">Upload Documents</a>
                    </div>
                   </div>
            </div>
                  
              </div>
            </div>
        </div>
      </div>
    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('styles'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/digital5/public_html/elective/resources/views/frontend/profile/payment-success.blade.php ENDPATH**/ ?>