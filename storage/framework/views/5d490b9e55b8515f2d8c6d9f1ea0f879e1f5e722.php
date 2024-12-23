<?php echo $__env->make('emails.frontend.template.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
<p style="font-size:14px; margin-bottom:15px; line-height: 22px;"><b>Dear <?php echo e($userObj->full_name()); ?></b>,</p>

<p style="font-size:14px; margin-bottom:15px; line-height: 22px;">
	Please click to below link form creating your password
    
</p>


<div style="font-size:14px; margin-bottom:15px; line-height: 22px;">
    <a style="color:#b00403; font-weight:bold;" target="_blank" href="<?php echo e(url('createpassword/' . $userObj->reset_key)); ?>">
        <?php echo e(url('createpassword/' . $userObj->reset_key)); ?>

    </a>
</div>
<?php echo $__env->make('emails.frontend._signature', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
<?php echo $__env->make('emails.frontend.template.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> <?php /**PATH /home/digital5/public_html/elective/resources/views/emails/frontend/user_create_password.blade.php ENDPATH**/ ?>