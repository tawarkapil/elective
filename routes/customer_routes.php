<?php

Route::group(['namespace' => 'Site'], function() use ($router) {
   $router->get('/','HomeController@index');
   $router->get("/contact-us", "PageController@contact");
    $router->post("/contact-frm", "PageController@contactfrm");
    $router->get("/blogs", "HomeController@blog");
    $router->get("/blogs-timeline/{customer_id}", "HomeController@blogtimeline");
    $router->post("/ajax-load-blogs-timeline", "HomeController@ajaxLoadBlogsTimeline");
    $router->get("/blogs/info/{title}/{id}", "HomeController@blogsInfo");
    $router->get("/volunteer", "HomeController@volunteer");
    $router->get("/volunteer/info/{name}/{customer_id}", "HomeController@volunteerInfo");
    $router->get("about-us", "PageController@aboutUs");
    $router->get("terms-conditions", "PageController@termsConditions");
    $router->get("privacy-policy", "PageController@privacyPolicy");
    
    $router->get("/destinations", "HomeController@destinations");
    $router->get("/destinations/info/{title}/{id}", "HomeController@destinationsInfo");

    $router->get("/programs", "HomeController@programs");
    $router->get("/programs/info/{title}/{id}", "HomeController@programsInfo");
    
    $router->get("/trips", "HomeController@trips");
    $router->get("/trips/info/{title}/{id}", "HomeController@tripInfo");

    $router->get("/tours", "HomeController@tours");
    $router->get("/tours/info/{title}/{id}", "HomeController@tourInfo");

    $router->get("/events", "HomeController@events");
    $router->get("/events/info/{title}/{id}", "HomeController@eventsInfo");

    $router->get("/prices", "HomeController@pricing");
});


Route::group(['namespace' => 'Site'], function() use ($router) {  
    $router->get('login','AuthController@login');
    $router->post('doLogin','AuthController@doLogin');
    $router->get('register','AuthController@register');
    $router->post('doRegister','AuthController@doRegister');
    $router->get('logout', 'AuthController@logout');
    $router->get('forgot-password','AuthController@forgetPassword');
    $router->post('submitForgetPassword','AuthController@submitforgetPassword');
    $router->get('resetpassword/{token}','AuthController@resetPassword');
    $router->get('createpassword/{token}','AuthController@resetPassword');
    $router->post('submitResetPassword','AuthController@submitresetPassword');
    $router->post('resend_verificaiton_mail', 'AuthController@resendVerificaitonMail');
    $router->get('confirm-account/{token}', 'AuthController@confirmEmail');
});

Route::group(['namespace' => 'Site', 'middleware' => ['customerAuth']], function() use ($router) {    
   $router->get("dashboard", "DashboardController@index");
   $router->get("guide", "DashboardController@guide");
   $router->get("my-elective", "DashboardController@myelective");
   $router->get("guide-add-ons-events", "DashboardController@myAddOnEvents");
   $router->get("guide-tours", "DashboardController@myTours");
   $router->get("guide-group", "DashboardController@guidegroup");
   $router->get("guide-blogs", "DashboardController@guideblogs");
   $router->post('ajaxloadstate','DashboardController@ajaxloadstate'); 
   $router->get('change-password','ProfileController@changePassword');
   $router->post('change-password','ProfileController@submitchangePassword');
   $router->post('commentSubmitFrm','BlogController@commentSubmitFrm');
   $router->post('quickContactFrm','HomeController@quickContactFrm');
   $router->get("guide-documents", "DashboardController@guidedocuments");

   $router->get("profile", "ProfileController@profile");
   $router->post("personalInfoFrm", "ProfileController@personalInfoFrm");
   $router->post("submitProfilePicForm", "ProfileController@submitProfilePicForm");
   $router->post("socialFrm", "ProfileController@socialFrm");
   $router->post("contactDetailsFrm", "ProfileController@contactDetailsFrm");
   $router->post("studiesDetailsFrm", "ProfileController@studiesDetailsFrm");
   $router->post("gallaryFrm", "ProfileController@gallaryFrm");

   $router->get('/application', 'ApplicationController@application');
   $router->get('/application/step/{stepName}', 'ApplicationController@application');
   $router->post('/application/submitFrm', 'ApplicationController@submitFrm');
   $router->post('/application/personalInfoFrm', 'ApplicationController@personalInfoFrm');
   $router->post('/application/loadDestination', 'ApplicationController@loadDestination');
   $router->post('/application/loadPaymentSummary', 'ApplicationController@loadPaymentSummary');
   $router->post('/application/acceptTermAndCondition', 'ApplicationController@acceptTermAndCondition');
   $router->get('/application/deposit-payment', 'ApplicationController@depositPayment');
   $router->post('/application/stripepayment', 'ApplicationController@stripepayment');
   $router->get('/payment-success/{payment_token}', 'ApplicationController@paymentSuccess');

   $router->get('/application-documents', 'ApplicationController@applicationDocuments');

   $router->post('studentDocumentsUpload', 'ApplicationController@studentDocumentsUpload');

   $router->post("profile/uploadChunkFile", "ProfileController@uploadChunkFile");
   $router->post("profile/deleteUploadFiles", "ProfileController@deleteUploadFiles");
   $router->post('profile/removeAttachmentFile','ProfileController@removeAttachmentFile');


   $router->group(["prefix" => "my-blogs"], function () use ($router) {
      $router->get("/", "BlogController@index");
      $router->post("ajax_list", "BlogController@ajax_list");
      $router->get("addnew/{id?}", "BlogController@addnew");
      $router->post("addnewajax", "BlogController@addnewajax");
      $router->post("uploadChunkFile", "BlogController@uploadChunkFile");
      $router->post("deleteUploadFiles", "BlogController@deleteUploadFiles");
      $router->post('removeAttachmentFile','BlogController@removeAttachmentFile');
      $router->get('view/{id}', 'CustomerController@details');
      $router->post('update_status','BlogController@update_status');
      $router->post("delete", "BlogController@deleteSelected");
   });

   $router->group(["prefix" => "my-testimonials"], function () use ($router) {
      $router->get("/", "TestimonialController@index");
      $router->post("ajax_list", "TestimonialController@ajax_list");
      $router->post("addnewajax", "TestimonialController@addnewajax");
      $router->post("get_content", "TestimonialController@get_content");
      $router->post('update_status','TestimonialController@update_status');
      $router->post("delete", "TestimonialController@deleteSelected");
   });

   Route::group(['prefix' => 'my-trips'], function() use ($router) {    
         $router->get('/', 'TripController@index');
         $router->post('ajaxLoad/', 'TripController@ajaxLoad');
         $router->get("addnew/{id?}", "TripController@addnew");
         $router->post("addnewajax", "TripController@addnewajax");
         $router->post("loadPrograms", "TripController@loadPrograms");
         $router->post("loadEvents", "TripController@loadEvents");
         $router->post("loadPaymentSummary", "TripController@loadPaymentSummary");
         $router->post('update_status','TripController@update_status');
   });

   Route::group(['prefix' => 'notifications'], function() use ($router) {    
       $router->get('/', 'NotificationController@notificationList');
       $router->get('/ajaxLoad', 'NotificationController@ajaxLoad');
       $router->post('read_notification','NotificationController@read_notification');
   });

   $router->get('fund-my-elective', 'StaticController@fundMyElective');
   $router->get('pre-depature/{page}', 'StaticController@preDepature');
   $router->get('in-country/{page}', 'StaticController@inCountry');
   $router->get('after-my-elective/{page}', 'StaticController@afterMyElective');
   $router->get('invoice-payments', 'StaticController@invoicePayments');
   $router->get('community', 'StaticController@community');
   $router->get('emergency-info', 'StaticController@emergencyInfo');
});