<?php $__env->startSection('title'); ?>
<title>Register Page - <?php echo e(ViewsHelper::getConfigKeyData('website_title')); ?></title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="main-content">
    <!-- Section: home -->
    <section id="home" class="divider bg-lighter">
      <div class="display-table">
        <div class="display-table-cell">
          <div class="container">
            <div class="row">
              <div class="col-md-6 col-md-push-3">
                <div class="white_box mt-90">
                <!-- <div class="text-center mb-60 logo_title"><a href="#" class="">Electives <span class="text-theme-colored">Global</span></a> -->
                <!-- </div> -->
                <h3 class="text-theme-colored mt-0 pt-5 text-center"> Register</h3>
                <hr> 
                <form  id="submitFrm" name="submitFrm" class="clearfix">
                  <div class="row">
                      <div class="col-lg-12">
                          <div class="glb-message-bx"></div>
                      </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-md-6">
                      <label for="first_name">First Name <span class="required text-danger">*</span></label>
                      <input id="first_name" name="first_name" class="form-control" type="text">
                    </div>
                  
                    <div class="form-group col-md-6">
                      <label for="last_name">Last Name <span class="required text-danger">*</span></label>
                      <input id="last_name" name="last_name" class="form-control" type="text">
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-md-12">
                      <label for="email">Email <span class="required text-danger">*</span></label>
                      <input id="email" name="email" class="form-control" type="text">
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-md-12">
                      <label for="password">Password <span class="required text-danger">*</span></label>
                      <input type="password" id="password" name="password" class="form-control" type="text">
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-md-12">
                      <label for="confirm_password">Confirm Password <span class="required text-danger">*</span></label>
                      <input type="password" id="confirm_password" name="confirm_password" class="form-control" type="text">
                    </div>
                  </div>
                  <div class="clear text-center pt-10">
                    <button type="submit" class="btn btn-dark btn-block">Register</button> 
                  </div>
                </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script type="text/javascript" src="<?php echo e(url('public/frontend/custom/auth/register.js')); ?><?php echo e(Config::get('params.app_version')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('styles'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/digital5/public_html/elective/resources/views/frontend/auth/register.blade.php ENDPATH**/ ?>