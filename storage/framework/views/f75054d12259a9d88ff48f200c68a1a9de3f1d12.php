<?php $__env->startSection('title'); ?>
<title>Forgot Password - <?php echo e(ViewsHelper::getConfigKeyData('website_title')); ?></title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
 <!-- start main-content -->
  <div class="main-content">
    <!-- Section: home -->
    <section id="home" class="divider bg-lighter">
      <div class="display-table">
        <div class="display-table-cell">
          <div class="container">
            <div class="row">
              <div class="col-md-6 col-md-push-3">
                <div class="white_box m-50">
                <!-- <div class="text-center mb-60 logo_title">
                  <a href="#" class="">Elective <span class="text-theme-colored">Global</span></a>
                </div> -->
                <h3 class="text-theme-colored mt-0 pt-5 text-center"> Forgot Password?</h3>
                <span>Please enter registered email address to get a reset password link</span>
                <hr> 
                <form  id="submitFrm" name="submitFrm" class="clearfix">
                    <div class="row">
                      <div class="col-lg-12">
                          <div class="glb-message-bx"></div>
                      </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-md-12">
                      <label for="email">Email  <span class="required text-danger">*</span></label>
                      <input id="email" name="email" class="form-control" type="text">
                    </div>
                  </div>
                  <div class="clear text-center pt-10">
                    <button type="submit" class="btn btn-dark btn-block">SUBMIT</button> 
                  </div>
                  <div class="form-group text-center mt-20">
                       <a class="text-theme-colored font-weight-600 font-12" href="<?php echo e(url('login')); ?>"><i class="fa fa-angle-left"></i> Back to login</a>
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
  <!-- end main-content -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script type="text/javascript" src="<?php echo e(url('public/frontend/custom/auth/forget-password.min.js')); ?><?php echo e(Config::get('params.app_version')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('styles'); ?>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('frontend.layouts.login_app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp82\htdocs\elective\resources\views/frontend/auth/forget-password.blade.php ENDPATH**/ ?>