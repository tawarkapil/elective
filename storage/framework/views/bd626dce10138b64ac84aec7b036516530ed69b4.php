<?php $__env->startSection('content'); ?>
 <!-- Start main-content -->
  <div class="main-content dashboard">
  
    <section class="inner-header divider layer-overlay overlay-dark"  data-bg-img="<?php echo e(url('public/frontend/assets/images/contact-us.jpg')); ?>">
      <div class="container pt-30 pb-30">
        <!-- Section Content -->
        <div class="section-content">
          <div class="row"> 
            <div class="col-sm-8 xs-text-center">
              <h2 class="text-white mt-10">Profile</h2>
            </div>
            <div class="col-sm-4">
              <ol class="breadcrumb white mt-10 text-right xs-text-center"> 
                <li><a href="<?php echo e(url('dashboard')); ?>">Dashboard</a></li>
                <li class="active">Profile</li>
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
          <div class="col-md-12">
            <div class="white_box">
            <h4>Change Password</h4>
               <form  name="submitFrm" id="submitFrm">
                    <div class="row">
                        <div class="col-lg-4 form-group">
                            <label for="old_password">Old Password <span class="required text-danger">*</span></label>
                            <input type="password" class="form-control" name="old_password" id="old_password" > 
                        </div>
                        <div class="col-lg-4 form-group">
                            <label for="new_password">New Password <span class="required text-danger">*</span></label>
                            <input type="password" class="form-control" name="new_password" id="new_password" > 
                        </div>
                        <div class="col-lg-4 form-group">
                            <label for="confirm_password">Confirm Password <span class="required text-danger">*</span></label>
                            <input type="password" class="form-control" name="confirm_password" id="confirm_password" > 
                        </div>
                        <div class="col-lg-12 form-group">
                            <div class="text-center">
                                <button type="submit" class="btn btn-dark btn-theme-colored btn-sm mt-20 pt-10 pb-10" data-loading-text="Please wait...">Change Password</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
          </div>

        </div>
      </div>
    </section>
  </div>
  <!-- end main-content -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<?php
    $change_password_page = true;
 ?>
<script type="text/javascript" src="<?php echo e(url('public/frontend/custom/auth/change-password.min.js')); ?><?php echo e(Config::get('params.app_version')); ?>"></script>
<?php $__env->stopSection(); ?>


 

  
<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/digital5/public_html/elective/resources/views/frontend/profile/changepassfrm.blade.php ENDPATH**/ ?>