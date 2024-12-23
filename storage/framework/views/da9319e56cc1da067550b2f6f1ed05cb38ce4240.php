<?php echo $__env->make('emails.frontend.template.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
   <p><b>Hi <?php echo e($userObj->first_name); ?></b>,</p>
   
    <p style="font-size:14px; margin-bottom:15px; line-height: 22px;">
        You recently requested to reset your password for your <?php echo e(ViewsHelper::getConfigKeyData('website_title')); ?> Membership account. Click the button below to reset it. 
    </p>
    
    
  
    <p  style="font-size:14px; margin-bottom:15px; line-height: 22px;">
        <a style="color:#b00403; font-weight:bold;" target="_blank" href="<?php echo e(url('resetpassword/' . $userObj->reset_key)); ?>">
            Reset your password
        </a>
    </p>

    <p style="font-size:14px; margin-bottom:15px; line-height: 22px;">
    	If you did not request a password reset, please ignore this email. This password reset is only valid for the next 30 minutes. 
    </p>
 

 <p style="font-size:14px; margin-bottom:15px; line-height: 22px;">
If you have any further questions please email <?php echo e(ViewsHelper::getConfigKeyData('support_email')); ?>


    </p>
<?php echo $__env->make('emails.frontend._signature', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
<?php echo $__env->make('emails.frontend.template.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> <?php /**PATH /home/digital5/public_html/elective/resources/views/emails/frontend/reset_password.blade.php ENDPATH**/ ?>