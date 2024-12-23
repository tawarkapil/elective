<?php echo $__env->make('emails.frontend.template.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
   <p style="font-size:14px; margin-bottom:15px; line-height: 22px;"><b>Hi <?php echo e($customer->full_name()); ?></b>,</p>
    <p style="font-size:14px; margin-bottom:15px; line-height: 22px;">
      Thank you for registering with <?php echo e(ViewsHelper::getConfigKeyData('website_title')); ?>. As a part of our policy, a member has to verify their email address. Please verify your email by clicking the below button:
    </p>
    <div style="font-size:14px; margin-bottom:15px; line-height: 22px;">
        <a style="color:#b00403; font-weight:bold;" target="_blank" href="<?php echo e(url('confirm-account/' . $customer->signup_activation_key)); ?>">
            Verify Email
        </a>
    </div>


<p style="font-size:14px; margin-bottom:15px; line-height: 22px;">
    If you have any further questions please email 
    <?php echo e(ViewsHelper::getConfigKeyData('support_email')); ?>

</p>
<?php echo $__env->make('emails.frontend._signature', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
<?php echo $__env->make('emails.frontend.template.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> <?php /**PATH D:\xampp82\htdocs\elective\resources\views/emails/frontend/welcome_email.blade.php ENDPATH**/ ?>