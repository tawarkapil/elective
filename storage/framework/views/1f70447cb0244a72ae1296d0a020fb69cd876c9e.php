<?php $__env->startSection('title'); ?>
<title>Forgot Password - <?php echo e(ViewsHelper::getConfigKeyData('website_title')); ?></title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
        <div><b>Forgot Password?</b></div>
        <small>
            <span>Please enter registered email address to get a reset password link</span>
        </small>
    </div>
    <div class="card-body login-card-body">
      <div class="row">
          <div class="col-lg-12">
              <div class="glb-message-bx"></div>
          </div>
      </div>

      <form id="submitFrm" name="submitFrm">
        
        <div class="form-group  mb-3">
            <label for="email">Email <span class="required text-danger">*</span></label>
            <input type="email" class="form-control" placeholder="Email" name="email" id="email">  
        </div>
        <div class="row">
          
          <!-- /.col -->
          <div class="col-lg-12">
            <button type="submit" class="btn btn-primary btn-block">SUBMIT</button>
          </div>
          <!-- /.col -->
          <div class="col-lg-12 text-center mt-3">
            <a class=" " href="<?php echo e(url('admin/login')); ?>">I remembered my password</a>
          </div>
        </div>
      </form>
     
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script type="text/javascript" src="<?php echo e(url('public/panel/custom/auth/forget-password.min.js')); ?><?php echo e(Config::get('params.app_version')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('styles'); ?>
<style type="text/css">
    .d-block{
        display: block;
        width: 100%;
    }
</style>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layouts.login_app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp82\htdocs\elective\resources\views/admin/auth/forget-password.blade.php ENDPATH**/ ?>