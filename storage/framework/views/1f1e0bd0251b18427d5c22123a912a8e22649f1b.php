<?php $__env->startSection('title'); ?>
<title>Reset Password - <?php echo e(ViewsHelper::getConfigKeyData('website_title')); ?></title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
        <div><b>Reset Password</b></div>
    </div>
    <div class="card-body login-card-body">
        <?php if(!$valid): ?>
        <div class="row">
          <div class="col-lg-12">
                <div >This token is expired please click on below link and forgot again the password</div>
            </div>
        </div>
        <?php else: ?>
      <div class="row">
          <div class="col-lg-12">
              <div class="glb-message-bx"></div>
          </div>
      </div>

      <form id="submitFrm" name="submitFrm">
        
        <div class="form-group  mb-3">
            <label for="new_password">New Password <span class="required text-danger">*</span></label>
            <input type="password" class="form-control" placeholder="New Password" name="new_password" id="new_password">  
        </div>
        <input type="hidden" name="reset_key" value="<?php echo e($token); ?>">
        <div class="form-group mb-3">
            <label for="confirm_password">Confirm  Password <span class="required text-danger">*</span></label>
          <input type="password" class="form-control" placeholder="Confirm Password" name="confirm_password" id="confirm_password">
        </div>
        <div class="row">
          <div class="col-lg-12">
            <button type="submit" class="btn btn-primary btn-block">Reset password</button>
          </div>
          <div class="col-lg-12 text-center mt-3">
            <a class=" " href="<?php echo e(url('admin/login')); ?>">I remembered my password</a>
          </div>
          <!-- /.col -->
        </div>
        <?php endif; ?>
      </form>
     
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script type="text/javascript" src="<?php echo e(url('public/panel/custom/auth/reset-password.min.js')); ?><?php echo e(Config::get('params.app_version')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('styles'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.login_app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp82\htdocs\elective\resources\views/admin/auth/resetpassword.blade.php ENDPATH**/ ?>