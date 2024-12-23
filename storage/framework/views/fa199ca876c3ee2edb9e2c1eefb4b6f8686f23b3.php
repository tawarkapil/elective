<?php $__env->startSection('title'); ?>
<title>Login Page - <?php echo e(ViewsHelper::getConfigKeyData('website_title')); ?></title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
        <div><b>Sign In to Admin</b></div>
        <small>
            <span>Sign in to start your session</span>
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
        <div class="form-group mb-3">
            <label for="email">Password <span class="required text-danger">*</span></label>
          <input type="password" class="form-control" placeholder="Password" name="password" id="password">
        </div>
        <div class="row">
          <div class="col-12 mb-3">
            <div class="icheck-primary float-left">
              <input type="checkbox"  id="remember_me" name="remember_me" value="Yes">
              <label for="remember_me">
                Remember Me
              </label>
            </div>
            <a class="float-right mt-1" href="<?php echo e(url('admin/forgot-password')); ?>">Forgot Password</a>
          </div>
          <!-- /.col -->
          <div class="col-lg-12">
            <button type="submit" class="btn btn-primary btn-block">Login</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
     
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script type="text/javascript" src="<?php echo e(url('public/panel/custom/auth/login.js')); ?><?php echo e(Config::get('params.app_version')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('styles'); ?>
<?php $__env->stopSection(); ?>


    
<?php echo $__env->make('admin.layouts.login_app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home1/digital5/public_html/elective/resources/views/admin/auth/login.blade.php ENDPATH**/ ?>