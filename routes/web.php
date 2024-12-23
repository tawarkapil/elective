<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

require base_path('routes/admin_routes.php');
require base_path('routes/customer_routes.php');

Route::get('/redirect_notice', function () {
    return view('redirect_notice');
});


Route::group(['namespace' => 'Site'], function() use ($router) {  
    $router->get('/import-customers','ImportController@index');
    $router->post('doImport','ImportController@doImport');
    $router->get('import-success','ImportController@thankYou');
});


Route::get('/clear-cache', function () {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:clear');
    // $exitCode = Artisan::call('views:clear');
    //$exitCode = Artisan::call('sessions:clear');
    echo "successfully !";die;
});


$router->group(
    ['prefix' => 'api/'],
    function ($app) {
        $app->post('comments/{id}/report', 'CommentsController@report');
        $app->get('comments/{id}/report', 'CommentsController@reportForm');



        $app->get('comments/{id}/flag', 'CommentsController@flaged');
        $app->get('comments/{id}/unflag', 'CommentsController@Unflaged');

        $app->post('comments_vote', 'CommentsController@vote');
        // $app->delete('comments/{id}/', 'CommentsController@destroy');
        $app->get('comments/{id}/replies', 'CommentsController@replies');
        $app->put('comments/{id}/', 'CommentsController@update');
        $app->get('comments/{id}/', 'CommentsController@show');
        $app->post('comments', 'CommentsController@store');
        $app->get('comments', 'CommentsController@index');
    });

$router->post('users/{id}', 'UsersController@info');
$router->get('users/{username}', 'UsersController@show');
$router->get('/app', 'CommentsController@index');
