<?php $__env->startSection('title'); ?>
<title> Application Documents - <?php echo e(ViewsHelper::getConfigKeyData('website_title')); ?></title>
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
              <h2 class="text-white mt-10">Fund My Elective</h2>
            </div>
            <div class="col-sm-4">
              <ol class="breadcrumb white mt-10 text-right xs-text-center"> 
                <li><a href="<?php echo e(url('dashboard')); ?>">Dashboard</a></li>
                <li class="active">Fund My Elective</li>
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
                  <h4 class="pagesub_title">Mandatory Docs </h4>
                    <p>As you prepare for your exciting elective journey, it's essential to complete the Predeparture Mandatory Checklist. This checklist ensures that all necessary documents are submitted for processing your elective.</p>
                  <p>
                   
                      <ul class="list-icon theme-colored listnone pl-0">
                         <li class="check_list"><span><i class="fa fa-check-circle"></i></span> <span><b>Passport Scan: </b> Upload a clear copy of your passport. The pages must contain your photo and personal details. The pages must contain your photo and personal details. </span></li>

                        <li class="check_list"><span><i class="fa fa-check-circle"></i></span> <span><b>Visa Scan:</b> Upload a copy of your approved visa. If you plan to obtain a visa upon arrival, kindly check the corresponding box. However, prior to selecting this option, confirm that visa-on-arrival is available for your nationality. Refer to our visa section for detailed guidelines and requirements.</span></li>

                        <li class="check_list"><span><i class="fa fa-check-circle"></i></span> <span><b>Academic Verification:</b> Submit proof of your academic status or a reference letter from your university/college. All academic institutions will furnish this upon request. However, if you need to facilitate this you can alternatively use our “Proof of Academic Status & Endorsement Form” in the important resources section.</span></li>

                        <li class="check_list"><span><i class="fa fa-check-circle"></i></span> <span><b>Resume/Curriculum Vitae:</b> Upload your updated resume or CV. </span></li>

                        <li class="check_list"><span><i class="fa fa-check-circle"></i></span> <span><b>Flight Information:</b> Ensure your flight details are correctly entered in the Flights section or that we have received your itinerary. </span></li>

                        <li class="check_list"><span><i class="fa fa-check-circle"></i></span> <span><b>Insurance forms:</b> Verify that all insurance requirements are documented. </span></li>
                        <li class="check_list"><span><i class="fa fa-check-circle"></i></span> <span><b>Pre-departure Progress Panel:</b> To help you track your preparation, the pre-departure progress bar will display how close you are to completing these mandatory steps. Each completed task brings you one step closer to being fully prepared your elective experience. Keep up with the checklist, and soon you'll be all set for the journey ahead. Remember, we are always a quick chat, email or call away!</span></li>
                    </ul>
                  </p>

                  <?php $sectionId = 1; ?>

                  <?php echo $__env->make('frontend.common._documents_section', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                  <div class="pt-50">
                    <a href="<?php echo e(url('my-elective')); ?>" class="btn btn-border btn-theme-colored pull-right">Next: My Elective <i class="fa fa-arrow-circle-right"></i></a>
                    <br>
                </div>
              </div>
            </div>
          </div>

          
        </div>

      </div>

    </section>

  </div>

  <!-- end main-content -->

<?php $__env->stopSection(); ?>
<?php $__env->startSection('styles'); ?>
<style type="text/css">
  .progress {
    height: 10px;
    margin-bottom: 0px;
  }
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?> 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/digital5/public_html/elective/resources/views/frontend/profile/application-documents.blade.php ENDPATH**/ ?>