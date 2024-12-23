<!DOCTYPE html>
<html dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo e(url('public/panel/assets/images/favicon.png')); ?><?php echo e(Config::get('params.app_version')); ?>">
    <title><?php echo e(ViewsHelper::getConfigKeyData('website_title')); ?> - Admin Panel</title>
    

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="<?php echo e(url('public/panel/assets/plugins/fontawesome-free/css/all.min.css')); ?>">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="<?php echo e(url('public/panel/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(url('public/panel/assets/dist/css/adminlte.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(url('public/panel/assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(url('public/panel/assets/plugins/daterangepicker/daterangepicker.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(url('public/common/toastr/build/toastr.min.css')); ?>">
    <?php echo $__env->yieldContent("styles"); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(url('public/panel/assets/custom/dev-custom.min.css')); ?><?php echo e(Config::get('params.app_version')); ?>">
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
    <style type="text/css">
        .ajax-loading-loader{
            z-index: 99999;
            background: #ffffff78 !important;
        }
        .imgDisplayBx img{
            height: 80px;
            object-fit: cover;
        }

        table td img{
            object-fit: cover;
        }

        .text-nowrap.text-center.table-action a {
            margin: 5px;
        }
    </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <?php echo $__env->make('admin.layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('admin.layouts.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->yieldContent("content"); ?>
        <?php echo $__env->make('admin.layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>



    <script src="<?php echo e(url('public/panel/assets/plugins/jquery/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(url('public/panel/assets/plugins/jquery-ui/jquery-ui.min.js')); ?>"></script>
    <script>
      $.widget.bridge('uibutton', $.ui.button)
    </script>
    <script src="<?php echo e(url('public/panel/assets/plugins/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
    <script src="<?php echo e(url('public/panel/assets/plugins/sparklines/sparkline.js')); ?>"></script>
    <script src="<?php echo e(url('public/panel/assets/plugins/moment/moment.min.js')); ?>"></script>
    <script src="<?php echo e(url('public/panel/assets/plugins/daterangepicker/daterangepicker.js')); ?>"></script>
    <script src="<?php echo e(url('public/panel/assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')); ?>"></script>
    <script src="<?php echo e(url('public/panel/assets/dist/js/adminlte.js')); ?>"></script>
    <script src="<?php echo e(url('public/panel/assets/dist/js/demo.js')); ?>"></script>
    <script src="<?php echo e(url('public/common/toastr/build/toastr.min.js')); ?><?php echo e(Config::get('params.app_version')); ?>"></script>
    <script src="<?php echo e(url('public/panel/custom/system.js')); ?><?php echo e(Config::get('params.app_version')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(url('public/panel/custom/CryptoJS.js')); ?><?php echo e(Config::get('params.app_version')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(url('public/panel/custom/Encryption.js')); ?><?php echo e(Config::get('params.app_version')); ?>"></script>
    <?php echo $__env->yieldContent("scripts"); ?>
</body>
</html><?php /**PATH D:\xampp82\htdocs\elective\resources\views/admin/layouts/app.blade.php ENDPATH**/ ?>