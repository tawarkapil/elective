<?php echo $__env->make('emails.admin.template.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
   <p style="font-size:14px; margin-bottom:15px; line-height: 22px;"><b>Hi <?php echo e($userObj->first_name); ?></b>,</p>
   
    <p style="font-size:14px; margin-bottom:15px; line-height: 22px;">
        You recently requested to reset your password for your <?php echo e(ViewsHelper::getConfigKeyData('website_title')); ?> account. Click the button below to reset it. 
    </p>
    
    
  
    <div  style="font-size:14px; margin-bottom:15px; line-height: 22px;">
        <a style="color:#b00403; font-weight:bold;" target="_blank" href="<?php echo e(url('admin/resetpassword/' . $userObj->reset_key)); ?>">
            Reset your password
        </a>
    </div>

    <p style="font-size:14px; margin-bottom:15px; line-height: 22px;">
    	If you did not request a password reset, please ignore this email. 
    </p>
 

 <p style="font-size:14px; margin-bottom:15px; line-height: 22px;">
If you have any further questions please email <?php echo e(ViewsHelper::getConfigKeyData('support_email')); ?>


    </p>
<?php echo $__env->make('emails.admin._signature', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
<?php echo $__env->make('emails.admin.template.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> <?php /**PATH D:\xampp82\htdocs\elective\resources\views/emails/admin/reset_password.blade.php ENDPATH**/ ?>