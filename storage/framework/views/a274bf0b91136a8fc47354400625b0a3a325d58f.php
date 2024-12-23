<?php $__env->startSection('title'); ?>
<title>Login Page - <?php echo e(ViewsHelper::getConfigKeyData('website_title')); ?></title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="main-content">
    <!-- Section: home -->
    <section id="home" class="divider bg-lighter">
      <div class="display-table">
        <div class="display-table-cell">
          <div class="container">
            <div class="row">
              <div class="col-md-10 col-md-push-1 text-center">
                <div class="white_box">
                <?php if($valid): ?>
                   <h3 class="mt-0 pt-5 mb-20"> Email Verified!</h3> 
                    <p class="mb-20">Greetings and welcome to <strong>Elective Global</strong>! We are delighted to see you as a part of our community. Feel free to discover, interact, and collaborate with us to create something wonderful.</p>
                    <br>
                    <p class="text-center"><a class="btn btn-default" href="<?php echo e(url('dashboard')); ?>">Go to dashboard</a></p>
                  <?php else: ?>
                    <div >This token is invalid please click on below link and forget again the password</div>
                    <p class="text-center"><a  class="btn btn-default resend_verificaiton_mail" href="">Resend Again</a></p>
                  <?php endif; ?>
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
<script type="text/javascript" src="<?php echo e(url('public/frontend/custom/auth/account-activation.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('styles'); ?>
<?php $__env->stopSection(); ?>


    
<?php echo $__env->make('frontend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/digital5/public_html/elective/resources/views/frontend/auth/account_activation.blade.php ENDPATH**/ ?>