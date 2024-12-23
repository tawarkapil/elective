<?php

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function() use ($router) {  
    $router->get('/','AuthController@login');
    $router->get('login','AuthController@login')->name('login');
    $router->post('doLogin','AuthController@doLogin');
    $router->get('logout', 'AuthController@logout');
   $router->get('forgot-password','AuthController@forgetPassword');
    $router->post('submitForgetPassword','AuthController@submitforgetPassword');
    $router->get('resetpassword/{token}','AuthController@resetPassword');
    $router->post('submitResetPassword','AuthController@submitresetPassword');
   
    $router->get('change-password','ProfileController@changePassword')->middleware('auth');
    $router->post('change-password','ProfileController@submitchangePassword')->middleware('auth');
});


Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth', 'adminAuth']], function() use ($router) {    
    $router->get('dashboard','DashboardController@index'); 
    $router->post('ajaxloadstate','DashboardController@ajaxloadstate'); 
    $router->get('profile','ProfileController@updateProfile');
    $router->post('update-profile','ProfileController@submitupdateProfile');
    $router->post('uploadChunkFile','ProfileController@uploadChunkFile');

    $router->get('/permission', 'PermissionController@index')->middleware('HasPermission:manage_permission');
    $router->post('/permissionSet', 'PermissionController@permissionSet')->middleware('HasPermission:manage_permission');


    
    $router->group(["prefix" => "blogs"], function () use ($router) {
        $router->get("/", "BlogController@index");
        $router->post("ajax_list", "BlogController@ajax_list");
        $router->post("addnewajax", "BlogController@addnewajax");
        $router->post("get_content", "BlogController@get_content");
        $router->get('view/{id}', 'BlogController@details');
        $router->post('update_status','BlogController@update_status');
        $router->post("delete", "BlogController@deleteSelected");
    });


    $router->group(["prefix" => "our-members"], function () use ($router) {
        $router->get("/", "OurMemberController@index");
        $router->post("ajax_list", "OurMemberController@ajax_list");
        $router->post("addnewajax", "OurMemberController@addnewajax");
        $router->post("get_content", "OurMemberController@get_content");
        $router->get('view/{id}', 'OurMemberController@details');
        $router->post('update_status','OurMemberController@update_status');
        $router->post("delete", "OurMemberController@deleteSelected");
    });

    $router->group(["prefix" => "comments"], function () use ($router) {
        $router->get("/", "CommentController@index");
        $router->post("ajax_list", "CommentController@ajax_list");
        $router->post('update_status','CommentController@update_status');
    });

    $router->group(["prefix" => "testimonials"], function () use ($router) {
        $router->get("/", "TestimonialController@index");
        $router->post("ajax_list", "TestimonialController@ajax_list");
        $router->post("addnewajax", "TestimonialController@addnewajax");
        $router->post("get_content", "TestimonialController@get_content");
        $router->post('update_status','TestimonialController@update_status');
        $router->post("delete", "TestimonialController@deleteSelected");
    });


    $router->group(["prefix" => "highlights"], function () use ($router) {
        $router->post("get_content", "HighlightController@get_content");
        $router->post("addnewajax", "HighlightController@addnewajax");
        $router->post("delete", "HighlightController@deleteSelected");
    });


    $router->group(["prefix" => "programs"], function () use ($router) {
        $router->get("/", "ProgramController@index");
        $router->post("ajax_list", "ProgramController@ajax_list");
        $router->post("addnewajax", "ProgramController@addnewajax");
        $router->post("get_content", "ProgramController@get_content");
        $router->get('view/{id}', 'ProgramController@details');
        $router->post('update_status','ProgramController@update_status');
        $router->post("uploadChunkFile", "ProgramController@uploadChunkFile");
    });

    $router->group(["prefix" => "destinations"], function () use ($router) {
        $router->get("/", "DestinationController@index");
        $router->post("ajax_list", "DestinationController@ajax_list");
        $router->post("addnewajax", "DestinationController@addnewajax");
        $router->post("get_content", "DestinationController@get_content");
        $router->get('view/{id}', 'DestinationController@details');
        $router->post('update_status','DestinationController@update_status');
        $router->post("uploadChunkFile", "DestinationController@uploadChunkFile");
    });


    $router->group(["prefix" => "tours"], function () use ($router) {
        $router->get("/", "TourController@index");
        $router->post("ajax_list", "TourController@ajax_list");
        $router->post("addnewajax", "TourController@addnewajax");
        $router->post("get_content", "TourController@get_content");
        $router->post('update_status','TourController@update_status');
        $router->get('view/{id}', 'TourController@details');
        // $router->post("delete", "DestinationController@deleteSelected");
    });

    $router->group(["prefix" => "addons"], function () use ($router) {
        $router->get("/", "AddonController@index");
        $router->post("ajax_list", "AddonController@ajax_list");
        $router->post("addnewajax", "AddonController@addnewajax");
        $router->post("get_content", "AddonController@get_content");
        $router->post('update_status','AddonController@update_status');
        $router->get('view/{id}', 'AddonController@details');
        $router->post('uploadChunkFile','AddonController@uploadChunkFile');
    });

    $router->group(["prefix" => "enquiry"], function () use ($router) {
        $router->get("/", "EnquiryController@index");
        $router->post("ajax_list", "EnquiryController@ajax_list",);
        $router->post("addnewajax", "EnquiryController@addnewajax");
        $router->post("get_content", "EnquiryController@get_content");
        $router->get('view/{id}', 'EnquiryController@details');
        $router->post("update_active", "EnquiryController@update_active");
        $router->post("delete", "EnquiryController@deleteSelected");
    });

    Route::group(['prefix' => 'trips'], function() use ($router) {    
        $router->get('/', 'TripController@index');
        $router->post('ajaxLoad/', 'TripController@ajaxLoad');
        $router->get('view/{id}', 'TripController@details');
        $router->post('update_status','TripController@update_status');
    });

    Route::group(['prefix' => 'customers'], function() use ($router) {    
      $router->get('/', 'CustomerController@index');
      $router->post('ajaxLoad/', 'CustomerController@ajaxLoad');
      $router->get('addnew','CustomerController@addnew');
      $router->get('addnew/{id}','CustomerController@addnew');
      $router->post('submitFrm','CustomerController@submitFrm');
      $router->get('view/{id}', 'CustomerController@details');
      $router->post('update_status','CustomerController@update_status');
      $router->post('reset_pass_admin','CustomerController@reset_pass_admin');
   });


   $router->group(["prefix" => "plan"], function () use ($router) {
        $router->get("/", "PlanController@index");
        $router->post("ajax_list", "PlanController@ajax_list");
        $router->post("addnewajax", "PlanController@addnewajax");
        $router->post("get_content", "PlanController@get_content");
        $router->post("update_active", "PlanController@update_active");
        $router->post("delete", "PlanController@deleteSelected");
    });

   $router->group(["prefix" => "user-transaction"], function () use (
        $router
    ) {
        $router->get("/", "UsertransactionController@index");
        $router->post("ajax_list", "UsertransactionController@ajax_list");
        $router->get("detail/{id}", "UsertransactionController@detail");
    });

   $router->group(["prefix" => "pricing"], function () use ($router) {
        $router->get("/", "PricingController@index");
        $router->post("ajax_list", "PricingController@ajax_list");
        $router->get('view/{id}', 'PricingController@details');
        $router->post("addnewajax", "PricingController@addnewajax");
        $router->post("get_content", "PricingController@get_content");
        $router->post('update_status','PricingController@update_status');
    });

   $router->group(["prefix" => "system-documents"], function () use ($router) {
        $router->get("/", "SystemDocumentController@index");
        $router->get("/view/{id}", "SystemDocumentController@details");
        $router->post("ajax_list", "SystemDocumentController@ajax_list");
        $router->post("addnewajax", "SystemDocumentController@addnewajax");
        $router->post("get_content", "SystemDocumentController@get_content");
        $router->post('update_status','SystemDocumentController@update_status');
        $router->post("delete", "SystemDocumentController@deleteSelected");
    });

    $router->group(["prefix" => "student-documents"], function () use ($router) {
        $router->get("/", "StudentDocumentController@index");
        $router->post("ajax_list", "StudentDocumentController@ajax_list");
        $router->post("delete", "StudentDocumentController@deleteSelected");
    });

});