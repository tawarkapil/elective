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

        <?php echo $__env->make('frontend.layouts.stepprogressbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        
        <div class="row">
          <div class="col-md-12">
            <div class="border-1px p-30 mb-0 bg-white pt-10">
              <div class="section-container section-box1">
                  <div class="row">
                      <div class="col-lg-12">
                          <h4 class="pagesub_title">Application</h4>
                          <p>Prior to beginning this section, please ensure that all mandatory fields in your profile are filled. This is a critical step for the successful processing of your application. Incomplete profiles may lead to unsuccessful submissions.</p>
                      </div>
                  </div>
                  <form name="submitFrm" id="submitFrm">
                      
                      <div class="row">
                          <div class="col-lg-6 form-group">
                              <label for="program">Which program would you like to enroll in? </label>
                              <?php echo Form::select('program', $programs, ($data) ? $data->program : null, ['id' => 'program', 'class' => 'form-control']); ?>

                          </div>

                          <div class="col-lg-6 form-group">
                              <label for="destination">Where would you like to go?  </label>
                              <?php echo Form::select('destination', $destinations, ($data) ? $data->destination : null, ['id' => 'destination', 'class' => 'form-control']); ?>

                          </div>

                          <div class="col-lg-12 form-group">
                              <label for="trip_start_date">When do you want to start your program?  </label>
                              <input type="text" name="trip_start_date" id="trip_start_date" class="form-control" value="<?php echo e(($data) ? date('d-m-Y', strtotime($data->trip_start_date)) : ''); ?>">
                          </div>

                          <div class="col-lg-4 form-group">
                              <label for="duration">How long would you like your program to be? </label>
                              <div class="input-group w-50" style="width:50%;">
                                <input type="text" name="duration" id="duration" class="form-control" placeholder="Eg. - 1, 2" value="<?php echo e(($data) ? $data->duration : ''); ?>">
                                <div class="input-group-addon">Weeks</div>
                              </div>
                              <small>(if >12 weeks please contact us)</small>
                          </div>


                          <div class="col-lg-12 form-group">
                              <label for="education">What is your education status?    </label>
                              <?php echo Form::select('education', ['' => 'Please Select', 1 => 'Student', 2 => 'Postgraduate', 3 => 'Professional'], ($data) ? $data->education : null, ['id' => 'education', 'class' => 'form-control']); ?>

                          </div>

                          <div class="col-lg-12 form-group">
                              <label for="educational_credits">Will your program count for Academic Credit Hours/ Continuing Education Units (CEUs) /Other educational credits? </label>

                              <div class="d-flex">
                                  <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="educational_credits" id="educational_credits_yes" value="Yes" checked>
                                    <label class="form-check-label" for="educational_credits_yes">
                                      Yes
                                    </label>
                                  </div>
                                  <div class="form-check form-check-inline ml-10 pl-10">
                                    <input class="form-check-input" type="radio" name="educational_credits" id="educational_credits_no" value="No">
                                    <label class="form-check-label" for="educational_credits_no">
                                      No
                                    </label>
                                  </div>
                              </div>
                          </div>

                          <div class="col-lg-12 form-group">
                              <label for="preferences_allergies">Specific Dietary Preferences/Allergies </label>
                              <input type="text" name="preferences_allergies" id="preferences_allergies" class="form-control" value="<?php echo e(($data) ? $data->preferences_allergies : ''); ?>">
                          </div>

                          <div class="col-lg-12 form-group">
                              <label for="other_preferences">Other Preferences </label>
                              <input type="text" name="other_preferences" id="other_preferences" class="form-control" value="<?php echo e(($data) ? $data->other_preferences : ''); ?>">
                              <small>His part of your application helps us know you better. You can jot down anything of interest to you in this section that will help us tailor your elective to suit you e.g. “I would like to improve my neurological examination skills” “learn how to suture” etc. This part of your application is forwarded to relevant Electives Global departments e.g. program advisors, hospital staff, catering department etc.</small>
                          </div>

                          <div class="col-sm-4 col-sm-offset-4 form-group">
                              <button class="btn btn-dark btn-block btn-xl" type="submit" name="submitBtn" id="submitBtn">Continue</button>
                          </div>        
                      </div>
                  </form>
              </div>
            </div>
        </div>
        <div class="col-md-12 form-group mt-10">
          <a href="<?php echo e(url('my-elective')); ?>" class="btn btn-border btn-theme-colored pull-right">Next : My Elective <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
    </section>
  </div>
  <!-- end main-content -->


  <div class="modal fade" id="confirmBoxMdl" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
          <form name="acceptTermsAndConditionFrm" id="acceptTermsAndConditionFrm">
              <div class="modal-header">
              <h4 class="modal-title pull-left">Confirmation</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              </div>
              <div class="modal-body" style="font-size: 16px;">
                  <div>
                      <p>Note that a <?php echo e(ViewsHelper::displayAmount(Config::get('params.registeration_deposit'))); ?> non-refundable deposit is required to confirm your elective. This non-refundable deposit is used to secure an initial payment at the placement hospital/center. </p>
                      <div>Your final payment will be calculated after relevant add-ons and discounts.</div> 
                      <p>
                          <input class="mr-5" type="checkbox" name="accept_terms_condition" id="terms-chckbox" value="Yes"> By checking this box, I agree to the <a href="#"><strong>Terms of Service</strong></a> and <a href="#"><strong>Privacy Policy</strong></a>.
                      </p> 
                      <label for="g-recaptcha-response"></label>
                    <div class="g-recaptcha mb-3" data-sitekey="<?php echo e(Config::get('params.gcaptcha.site_key')); ?>"></div>
                  </div>
              </div>
              <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-theme-colored">Pay Now</button>
              </div>
          </form>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(url('public/frontend/assets/plugins/daterangepicker/daterangepicker.css')); ?>" />
<style>
  .daterangepicker .drp-calendar{
    max-width: unset;
  }
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script src="<?php echo e(url('public/frontend/assets/plugins/daterangepicker/daterangepicker.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(url('public/frontend/custom/profile/application.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/digital5/public_html/elective/resources/views/frontend/profile/application.blade.php ENDPATH**/ ?>