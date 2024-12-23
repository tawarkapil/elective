<!DOCTYPE html>
<html class="loading" lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php echo $__env->yieldContent("meta_tags"); ?>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo e(url('public/frontend/assets/images/favicon.png')); ?><?php echo e(Config::get('params.app_version')); ?>">
    <?php echo $__env->yieldContent("title"); ?>
    <!-- Stylesheet -->
    <link href="<?php echo e(url('public/frontend/assets/css/bootstrap.min.css')); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo e(url('public/frontend/assets/css/jquery-ui.min.css')); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo e(url('public/frontend/assets/css/animate.css')); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo e(url('public/frontend/assets/css/css-plugin-collections.css')); ?>" rel="stylesheet"/>
    <link id="menuzord-menu-skins" href="<?php echo e(url('public/frontend/assets/css/menuzord-skins/menuzord-boxed.css')); ?>" rel="stylesheet"/>
    <link href="<?php echo e(url('public/frontend/assets/css/style-main.css')); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo e(url('public/frontend/assets/css/preloader.css')); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo e(url('public/frontend/assets/css/custom-bootstrap-margin-padding.css')); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo e(url('public/frontend/assets/css/responsive.css')); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo e(url('public/frontend/assets/css/colors/theme-skin-yellow.css')); ?>" rel="stylesheet" type="text/css">
    
    <?php echo $__env->yieldContent("styles"); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(url('public/frontend/assets/custom/dev-custom.min.css')); ?>">

    <style type="text/css">
        .ajax-loading-loader{
            z-index: 99999;
            background: #ffffff78 !important;
        }
    </style>
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
        var CSRF_TOKEN = "<?php echo e(csrf_token()); ?>";
        var enckey = "<?php echo $randomString; ?>";
    </script>
</head>
<body>
    
    <?php echo $__env->yieldContent("content"); ?>
    <script src="<?php echo e(url('public/frontend/assets/js/jquery-2.2.0.min.js')); ?>"></script>
    <script src="<?php echo e(url('public/frontend/assets/js/jquery-ui.min.js')); ?>"></script>
    <script src="<?php echo e(url('public/frontend/assets/js/bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(url('public/frontend/assets/js/jquery-plugin-collection.js')); ?>"></script>
    <script src="<?php echo e(url('public/frontend/assets/js/custom.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(url('public/frontend/custom/system.js')); ?><?php echo e(Config::get('params.app_version')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(url('public/frontend/custom/CryptoJS.js')); ?><?php echo e(Config::get('params.app_version')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(url('public/frontend/custom/Encryption.js')); ?><?php echo e(Config::get('params.app_version')); ?>"></script>
    <?php echo $__env->yieldContent("scripts"); ?>

</body>
<!-- END: Body-->

</html><?php /**PATH /var/www/html/elective/resources/views/frontend/layouts/login_app.blade.php ENDPATH**/ ?>