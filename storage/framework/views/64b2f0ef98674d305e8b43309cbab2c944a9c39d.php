<!DOCTYPE html>
<html class="loading" lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <?php echo $__env->yieldContent("title"); ?>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="<?php echo e(url('public/panel/assets/plugins/fontawesome-free/css/all.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(url('public/panel/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(url('public/panel/assets/dist/css/adminlte.min.css')); ?>">
    <?php echo $__env->yieldContent("styles"); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(url('public/panel/assets/custom/dev-custom.min.css')); ?><?php echo e(Config::get('params.app_version')); ?>">
    <!-- END: Custom CSS-->
<?php
    $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < 32; $i++)
    {
      $randomString .= $characters[rand(0, $charactersLength - 1)];
    }

?>
 <script>
        var HTTP_PATH = "<?php echo e(url('/').'/'); ?>";
        var ADMIN_HTTP_PATH = "<?php echo e(url('admin').'/'); ?>";
        var CSRF_TOKEN = "<?php echo e(csrf_token()); ?>";
        var enckey = "<?php echo $randomString; ?>";
    </script>
</head>

<body class="hold-transition login-page">
    
    <?php echo $__env->yieldContent("content"); ?>
        
    <script src="<?php echo e(url('public/panel/assets/plugins/jquery/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(url('public/panel/assets/plugins/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
    <script src="<?php echo e(url('public/panel/assets/dist/js/adminlte.min.js')); ?>"></script>

    <script type="text/javascript" src="<?php echo e(url('public/panel/custom/system.js')); ?><?php echo e(Config::get('params.app_version')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(url('public/panel/custom/CryptoJS.js')); ?><?php echo e(Config::get('params.app_version')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(url('public/panel/custom/Encryption.js')); ?><?php echo e(Config::get('params.app_version')); ?>"></script>
    <?php echo $__env->yieldContent("scripts"); ?>

</body>
<!-- END: Body-->

</html><?php /**PATH D:\xampp82\htdocs\elective\resources\views/admin/layouts/login_app.blade.php ENDPATH**/ ?>