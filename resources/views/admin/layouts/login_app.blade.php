<!DOCTYPE html>
<html class="loading" lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    @yield("title")
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ url('public/panel/assets/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ url('public/panel/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('public/panel/assets/dist/css/adminlte.min.css') }}">
    @yield("styles")
    <link rel="stylesheet" type="text/css" href="{{ url('public/panel/assets/custom/dev-custom.min.css') }}{{ Config::get('params.app_version') }}">
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
        var HTTP_PATH = "{{ url('/').'/' }}";
        var ADMIN_HTTP_PATH = "{{ url('admin').'/' }}";
        var CSRF_TOKEN = "{{ csrf_token() }}";
        var enckey = "<?php echo $randomString; ?>";
    </script>
</head>

<body class="hold-transition login-page">
    
    @yield("content")
        
    <script src="{{ url('public/panel/assets/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ url('public/panel/assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('public/panel/assets/dist/js/adminlte.min.js') }}"></script>

    <script type="text/javascript" src="{{ url('public/panel/custom/system.js') }}{{ Config::get('params.app_version') }}"></script>
    <script type="text/javascript" src="{{ url('public/panel/custom/CryptoJS.js') }}{{ Config::get('params.app_version') }}"></script>
    <script type="text/javascript" src="{{ url('public/panel/custom/Encryption.js') }}{{ Config::get('params.app_version') }}"></script>
    @yield("scripts")

</body>
<!-- END: Body-->

</html>