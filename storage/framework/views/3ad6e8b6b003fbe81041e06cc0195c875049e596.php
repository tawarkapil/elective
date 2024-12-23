<?php $__env->startSection('title'); ?>
<title>Reset Password - <?php echo e(ViewsHelper::getConfigKeyData('website_title')); ?></title>
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
                <div class="white_box mt-90">
                <!-- <div class="text-center mb-60 logo_title"><a href="#" class="">Electives <span class="text-theme-colored">Global</span></a> -->
                <!-- </div> -->
                <h3 class="text-theme-colored mt-0 pt-5 text-center"> Reset Password</h3>
                <hr> 
                 <?php if($valid): ?>
                <form  id="submitFrm" name="submitFrm" class="clearfix">
                  <div class="row">
                      <div class="col-lg-12">
                          <div class="glb-message-bx"></div>
                      </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-md-12">
                        <label for="new_password">New Password  <span class="required text-danger">*</span></label>
                        <input type="password" name="new_password" id="new_password" class="form-control form-control-lg" placeholder="New Password">
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-md-12">
                      <label  for="confirm_password">Confirm Password  <span class="required text-danger">*</span></label>
                        <input type="password" name="confirm_password" id="confirm_password" class="form-control form-control-lg" placeholder="Confirm Password">
                    </div>
                  </div>
                
                    <input type="hidden" name="reset_key" value="<?php echo e($token); ?>">
                  <div class="clear text-center pt-10">
                    <button type="submit" class="btn btn-dark btn-block">Reset password</button> 
                  </div>
                </form>
                <?php else: ?>
                <div >This link to create your password is expired. Please <a href="<?php echo e(url('forgot-password')); ?>" style="color: #2962ff;"> click here</a> to request the link again.</div>
                <?php endif; ?>
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
<script type="text/javascript" src="<?php echo e(url('public/frontend/custom/auth/reset-password.min.js')); ?><?php echo e(Config::get('params.app_version')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('styles'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/digital5/public_html/elective/resources/views/frontend/auth/resetpassword.blade.php ENDPATH**/ ?>