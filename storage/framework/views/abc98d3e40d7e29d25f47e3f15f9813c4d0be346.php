<?php $__env->startSection('title'); ?>

<title>Invoice & Payments - <?php echo e(ViewsHelper::getConfigKeyData('website_title')); ?></title>

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

              <h2 class="text-white mt-10">Invoice & Payments</h2>

            </div>

            <div class="col-sm-4">

              <ol class="breadcrumb white mt-10 text-right xs-text-center"> 

                <li><a href="<?php echo e(url('dashboard')); ?>">Dashboard</a></li>

                <li class="active">Invoice & Payments</li>

              </ol>

            </div>

          </div>

        </div>

      </div>

    </section> 
	 <?php echo $__env->make('frontend.layouts.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <section class="divider">
      <div class="container">
        <div class="row">

         

          <div class="col-md-12">

            <div class="border-1px p-30 mb-0 bg-white pt-10">
              <div class="section-container">
                  <h4>Invoice and Payments</h4>
                  <p>In the Invoice and Payments section of your dashboard, managing your financials for your elective becomes straightforward and transparent.</p>
                  <p>
                    <ul>
                      <li><b> Easy Access to Invoices:</b> All your invoices related to the elective program are neatly organized
                      here. You can view and track each payment, ensuring everything is clear and accounted for.</li>
                      <li><b> Payment Schedules and Reminders:</b> Stay on top of your payment deadlines with scheduled
                      reminders.</li>
                      <li><b> Secure Payment Portal:</b> Make payments confidently through our secure portal. Your financial
                      security is our priority.</li>
                      <li><b> Financial Record Keeping:</b> All your payments are recorded and accessible for your reference at
                      any time, providing a comprehensive view of your elective expenses.</li>
                    </ul>
                  </p>
                 <p>
                    This section is designed to give you peace of mind and control over your financial commitments with Electives Global.
                  </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('styles'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?> 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/digital5/public_html/elective/resources/views/frontend/static-pages/invoicePayments.blade.php ENDPATH**/ ?>