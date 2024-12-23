<?php echo $__env->make('emails.frontend.template.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
<p>Hello, </p>
<p>
    <?php echo e($contactdata->name); ?> wants to contact on your site.
</p>
<p>
    <h3><?php echo e($contactdata->email); ?> is contact user email address</h3>
</p>
<div>
    Thank You,
</div>
<?php echo $__env->make('emails.frontend.template.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/digital5/public_html/elective/resources/views/emails/frontend/contact_to_admin_mail.blade.php ENDPATH**/ ?>