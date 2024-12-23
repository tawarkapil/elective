<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- <title>Dashboard - {{ ViewsHelper::getConfigKeyData('website_title') }}</title> -->
  @yield('title')
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ url('public/frontend/dashboard/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{ url('public/frontend/dashboard/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ url('public/frontend/dashboard/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ url('public/frontend/dashboard/plugins/jqvmap/jqvmap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ url('public/frontend/dashboard/dist/css/adminlte.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ url('public/frontend/dashboard/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ url('public/frontend/dashboard/plugins/daterangepicker/daterangepicker.css') }}">
  <link rel="stylesheet" href="{{ url('public/common/select/select2.min.css') }}" />
  
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,300;0,400;0,500;0,600;1,600&family=Raleway:ital,wght@0,400;0,500;0,600;1,600&family=Source+Sans+3:wght@400;500;600&display=swap" rel="stylesheet">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ url('public/frontend/dashboard/plugins/summernote/summernote-bs4.min.css') }}">
  <link rel="stylesheet" href="{{ url('public/common/toastr/build/toastr.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ url('public/frontend/assets/custom/dev-custom.min.css') }}">

  @yield('styles')

  <style type="text/css">
    ul{
      list-style: none;
    }

    .img-size-20{
      height: 20px;
    }

    .filter-main-box{    
      padding: 20px;
      background: #dddddd70;
      margin-bottom: 20px;
      border-radius: 5px;
    }

    .btn-tool {
        background-color: transparent;
        color: #adb5bd;
        font-size: 18px;
        margin: 0px;
        padding: 2px 10px;
    }

    /*body{
      font-size: 16px;
      font-family: ubermove-regular;
    }*/

  </style>

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
     var HTTP_PATH = "{{ url('/').'/' }}";
     var CSRF_TOKEN = "{{ csrf_token() }}";
     var enckey = "<?php echo $randomString; ?>";
  </script>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  

  @include('frontend.layouts.dashboard_header')

  @include('frontend.layouts.dashboard_sidebar')

  @yield('content')
  <!-- /.content-wrapper -->
  @include('frontend.layouts.dashboard_footer')
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ url('public/frontend/dashboard/plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ url('public/frontend/dashboard/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ url('public/frontend/dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ url('public/frontend/dashboard/plugins/chart.js/Chart.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ url('public/frontend/dashboard/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<script src="{{ url('public/frontend/dashboard/plugins/moment/moment.min.js') }}"></script>
<script src="{{ url('public/frontend/dashboard/plugins/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ url('public/frontend/dashboard/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<script src="{{ url('public/frontend/dashboard/plugins/summernote/summernote-bs4.min.js') }}"></script>
<script src="{{ url('public/frontend/dashboard/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<script src="{{ url('public/frontend/dashboard/dist/js/adminlte.js') }}"></script>
<!-- <script src="{{ url('public/frontend/dashboard/dist/js/demo.js') }}"></script> -->


<script src="{{ url('public/common/select/select2.min.js'); }}"></script>

<script src="{{ url('public/common/toastr/build/toastr.min.js') }}{{ Config::get('params.app_version') }}"></script>
<script type="text/javascript" src="{{ url('public/frontend/custom/system.js') }}{{Config::get('params.app_version') }}"></script>
<!-- <script type="text/javascript" src="{{ url('public/frontend/custom/system.js') }}{{Config::get('params.app_version') }}"></script> -->
<script type="text/javascript" src="{{ url('public/frontend/custom/CryptoJS.js') }}{{Config::get('params.app_version') }}"></script>
<script type="text/javascript" src="{{ url('public/frontend/custom/Encryption.js') }}{{Config::get('params.app_version') }}"></script>
@yield('scripts')
</body>
</html>
