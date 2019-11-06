<?php

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

//Route::get('/', function () {
//    return view('home');
//});

Auth::routes();

Route::group(['middleware' => ['auth']], function() {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('home', 'HomeController@index')->name('home');
    Route::resource('users', 'UserController');
    Route::resource('roles', 'RoleController');
    Route::resource('permissions', 'PermissionController');
    Route::resource('projects', 'ProjectController');
    Route::resource('order', 'OrderController');
    Route::resource('products', 'ProductController');
    route::resource('product', 'ProductController');
    route::resource('order_product','OrderProductController');
    route::resource('repository', 'RepositoryController');
    route::resource('repository_requirement', 'Repository_RequirementController');
    route::resource('request', 'RequestController');
    route::post('preview','OrderController@preview')->name('order.preview');
    route::post('checkbox','ProductController@checkbox')->name('product.checkbox');
    route::resource('verifier', 'VerifierController');
    route::resource('permission', 'PermissionController');
    route::resource('verify_pre','VerifyController');
    route::resource('help_desk','HelpDeskController');
    route::resource('client','ClientController');
    route::resource('part','PartController');
    route::resource('product_part','ProductPartController');
    route::resource('repository_create','RepositoryCreateController');
    route::resource('provider','ProviderController');
    route::resource('repository-part','RepositoryPartController');
    Route::post('order-state/{id}','RepositoryController@order_state')->name('repository.order_state');
    route::get('locale/{lan}', 'LanguageController@locale');
    Route::get('map', function (){
        $projects = \App\Project::all();
        return view('maps.fullscreenmap',['projects' => $projects]);
    })->name('map');



});