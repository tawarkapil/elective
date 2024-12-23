<?php $__env->startSection('title'); ?>
<title> Application Documents - <?php echo e(ViewsHelper::getConfigKeyData('website_title')); ?></title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
  
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Application Documents</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo e(url('dashboard')); ?>">Home</a></li>
            <li class="breadcrumb-item active">Application Documents</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">

      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title float-left">
               Mandatory Docs 
              </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="border-1px p-30 mb-0 bg-white pt-10">
                    <div class="section-container"> 
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
                    </div>
                  </div>
                </div>
              </div>
                    
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- /.content -->
</div>
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
<?php echo $__env->make('frontend.layouts.dashboard_app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp82\htdocs\elective\resources\views/frontend/profile/application-documents.blade.php ENDPATH**/ ?>