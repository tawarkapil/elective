<!DOCTYPE html>
<html dir="ltr" lang="en">
   <head>
      <!-- Meta Tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width,initial-scale=1.0"/>
      <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
      <meta name="description" content="CharityFund - Charity & Crowdfunding HTML Template" />
      <meta name="keywords" content="building,business,construction,cleaning,transport,workshop" />
      <meta name="author" content="ThemeMascot" />
      <link rel="icon" type="image/x-icon" href="{{ url('public/frontend/assets/logo/favicon.ico') }}">
      <!-- Page Title -->
      @yield("title")
      <link href="{{ url('public/frontend/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
      <link href="{{ url('public/frontend/assets/css/jquery-ui.min.css') }}" rel="stylesheet" type="text/css">
      <link href="{{ url('public/frontend/assets/css/animate.css') }}" rel="stylesheet" type="text/css">
      <link href="{{ url('public/frontend/assets/css/css-plugin-collections.css') }}" rel="stylesheet"/>
      <link id="menuzord-menu-skins" href="{{ url('public/frontend/assets/css/menuzord-skins/menuzord-boxed.css') }}" rel="stylesheet"/>
      <link href="{{ url('public/frontend/assets/css/style-main.css') }}" rel="stylesheet" type="text/css">
      <link href="{{ url('public/frontend/assets/css/preloader.css') }}" rel="stylesheet" type="text/css">
      <link href="{{ url('public/frontend/assets/css/custom-bootstrap-margin-padding.css') }}" rel="stylesheet" type="text/css">
      <link href="{{ url('public/frontend/assets/css/responsive.css') }}" rel="stylesheet" type="text/css">
      <link href="{{ url('public/frontend/assets/css/colors/theme-skin-yellow.css') }}" rel="stylesheet" type="text/css">
      <link rel="stylesheet" href="{{ url('public/common/toastr/build/toastr.min.css') }}">
	  
	  <!------fonts---->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,300;0,400;0,500;0,600;1,600&family=Raleway:ital,wght@0,400;0,500;0,600;1,600&family=Source+Sans+3:wght@400;500;600&display=swap" rel="stylesheet">
	
	
      
      <link rel="stylesheet" type="text/css" href="{{ url('public/frontend/assets/custom/dev-custom.min.css') }}">
      <style type="text/css">
         .ajax-loading-loader{
         z-index: 99999;
         background: #ffffff78 !important;
         }

         .menuzord-menu > li > a {
             padding: 13px 16px 5px;
         }
         .widget{
            margin-bottom: unset;
         }

         .white_box {
             background-color: #fff;
             padding: 30px;
             padding-top: 10px;
         }

         article.post .entry-header .post-thumb img{
            height: 232px;
            object-fit: cover;
         } 
         

         .dashboard ul.list li a{
            color: #FFF ;
         }

         .dashboard.main-content{
            background: #80808029;
         }

         .form-label {
             font-weight: bold;
             font-size: 13px;
         }

         .upper-top-menu li{
            margin: 0 10px;
         }

         body {
           top: 0px !important;
           padding-top: 33px !important;
          }

          body > .skiptranslate > iframe.skiptranslate {
           display: none !important;
           visibility: hidden !important;
          }
          .goog-te-gadget-icon{
            display: none;
          }

          .toast{
            opacity: 1 !important;
          }

         .sticky {
              position:fixed;
              top:110px;
              z-index:999;
         }

		 
      </style>
      @yield("styles")
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
         var CSRF_TOKEN = "{{ csrf_token() }}";
         var enckey = "<?php echo $randomString; ?>";
      </script>
   </head>
   <body>
        <div id="wrapper">
            @include('frontend.layouts.header')
            @yield("content")
            @include('frontend.layouts.footer')
        </div>
      <script src="{{ url('public/frontend/assets/js/jquery-2.2.0.min.js') }}"></script>
      <script src="{{ url('public/frontend/assets/js/jquery-ui.min.js') }}"></script>
      <script src="{{ url('public/frontend/assets/js/bootstrap.min.js') }}"></script>
      <script src="{{ url('public/frontend/assets/js/jquery-plugin-collection.js') }}"></script>
      <script src="{{ url('public/common/toastr/build/toastr.min.js') }}{{ Config::get('params.app_version') }}"></script>
      <script src="{{ url('public/frontend/assets/js/custom.js') }}"></script>
      <script type="text/javascript" src="{{ url('public/frontend/custom/system.js') }}{{Config::get('params.app_version') }}"></script>
      <script type="text/javascript" src="{{ url('public/frontend/custom/CryptoJS.js') }}{{Config::get('params.app_version') }}"></script>
      <script type="text/javascript" src="{{ url('public/frontend/custom/Encryption.js') }}{{Config::get('params.app_version') }}"></script>
@yield("scripts")
</body>
</html>