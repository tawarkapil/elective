<?php $__env->startSection('title'); ?>
<title>My Elective - <?php echo e(ViewsHelper::getConfigKeyData('website_title')); ?></title>
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
              <h2 class="text-white mt-10">My Elective</h2>
            </div>
            <div class="col-sm-4">
              <ol class="breadcrumb white mt-10 text-right xs-text-center"> 
                <li><a href="<?php echo e(url('dashboard')); ?>">Dashboard</a></li>
                <li class="active">My Elective</li>
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
            <div class="white_box p-0">
              <ul id="myTab" class="nav nav-tabs" role="tablist">
                 <li class="active"><a href="#myelective-tab" data-toggle="tab">My Elective</a></li>
                 <li><a href="#program_advisor-tab" data-toggle="tab">Program Advisor</a></li>
                 <li><a href="#program_coordinator-tab" data-toggle="tab">Program Coordinator</a></li>
              </ul>
              <div id="myTabContent" class="tab-content p-0">
                <div role="tabpanel" class="tab-pane active" id="myelective-tab">
                    <div class="border-1px p-30 mb-0 bg-white pt-10">
                      <h4 class="pagesub_title">My Elective</h4>
                        <p>Welcome to &quot;My Elective&quot; – where personalized details of your elective journey come together! This dedicated space is crafted to provide you with essential dates and tailored information for your upcoming adventure and will evolve as you move through your dashboard. </p>
                        <p>Please note that the timelines provided are approximate and serve as a rough guide to help you navigate through the various stages. Due to our extensive network, programs with Electives Global can be processed much quicker depending on the destination and hospital regulations of the placement. We're here to support you every step of the way! </p>
                        <p>Okay, lets jump in: </p>

                        <p>
                          <b>Upcoming Elective Details:</b>
                          <ul class="list-icon theme-colored listnone pl-0">
                            <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span>Elective Duration: [Start Date] to [End Date]</span></li>
                            <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span>Destination:</span></li>
                            <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span>Hospital/Center:</span></li>
                            <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span>Program:</span></li>
                            <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span>Add-ons:</span></li>
                            <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span>Tours:</span></li>
                            <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span>Group Trip:</span></li>
                          </ul>
                        </p>

                        <div class="pt-50">
                            <a href="#program_advisor-tab" data-toggle="tab" class="btn btn-gray btn-transparent btn-theme-colored btn-sm pull-right trigger-btn">Next : Program Advisor <i class="fa fa-arrow-circle-right"></i></a>
                            <br>
                         </div>
                    </div>
                </div>

                <div role="tabpanel" class="tab-pane" id="program_advisor-tab">
                  <div class="border-1px p-30 mb-0 bg-white pt-10">
                    <h4 class="pagesub_title">Program Advisor</h4>
                    <p>At Electives Global, we assign a dedicated Program Advisor to each student upon enrollment. Your program advisor is a professional with years of experience in your field of healthcare. This advisor is not just a point of contact but a pillar of ongoing support throughout your elective journey. They will conduct three crucial calls:</p>
                    <ul class="list-icon theme-colored listnone pl-0">
                        <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b>Pre-elective Discussion:</b> sets the stage for your journey.</span></li>
                        <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b>Mid-elective Check-in:</b> helps navigate any in-country challenges and ensures you’re on track.</span></li>
                       <li class="check_list mb-5"><span><i class="fa fa-check-circle"></i></span> <span><b>Mid-elective Check-in:</b>focuses on elective requirement fulfilment, reflections and future aspirations and how the Electives Global community can help further your career.</span></li>
                    </ul>
                    <p>Once you select your elective, the details of your Program Advisor will be uploaded in this section, linking you to personalized, professional guidance every step of the way.</p>

                    <div class="pt-50">
                      <a href="#program_coordinator-tab" data-toggle="tab" class="btn btn-gray btn-transparent btn-theme-colored btn-sm pull-right trigger-btn">Next : Program Coordinator <i class="fa fa-arrow-circle-right"></i></a>
                      <br>
                   </div>
                  </div>
                </div>

                <div role="tabpanel" class="tab-pane" id="program_coordinator-tab">
                  <div class="border-1px p-30 mb-0 bg-white pt-10">
                    <h4 class="pagesub_title">Program Coordinator</h4>
                    <p> The Program Coordinator, stationed in your elective destination, is an integral figure overseeing all facets of your program. They manage orientation, hospital coordination, and all logistics including food, accommodation, and transport. Their local expertise ensures smooth management of every aspect of your stay.</p>
                    <p>The PC is not only your primary contact in-country overseeing all program aspects but also maintains constant, full communication with our head office. Their role is crucial in ensuring that both the local and broader organizational goals are aligned, providing a cohesive and well-supported experience from start to finish.</p>
                    <p>Upon selecting your elective, we will provide you with the specific details of your in-country Program Coordinator in this section.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <div class="col-md-12 form-group mt-10">
          <a href="<?php echo e(url('guide-add-ons-events')); ?>" class="btn btn-border btn-theme-colored pull-right">Next : Add-ons/Events <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
    </section>
  </div>
  <!-- end main-content -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('styles'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script type="text/javascript">
   $(function(){
     $('body').on('click', '.trigger-btn', function(e){
       e.preventDefault();
       var triggerTab = $(this).attr('href');
       $(window).animate({scrollTop:0}, 'slow');
       $('#myTab').find('li').removeClass('active');
       $('#myTab').find('a[href="'+triggerTab+'"]').parent().addClass('active');
       $('#myTabContent').find('.tab-pane').removeClass('in').removeClass('active');
       $(triggerTab).addClass('in').addClass('active');
   
     });
   });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/digital5/public_html/elective/resources/views/frontend/dashboard/myelective.blade.php ENDPATH**/ ?>