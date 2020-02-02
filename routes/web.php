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
    route::resource('agreement','AgreementController');
    route::resource('install','InstallController');
    route::resource('finance','FinanceController');
    route::resource('delivery','DeliveryController');
    route::resource('priority','HDpriorityController');
    route::resource('type','HDtypeController');
    route::resource('ticket','TicketStatusController');
    route::resource('level','HNTLevelController');
    route::resource('finance','FinanceController');
    route::resource('support_status','SupportStatusController');
    route::resource('support','SupportController');
    route::resource('conversation_view','ConversationViewController');
    route::resource('bank_account','BankAccountsController');
    route::resource('bank_account_type','BankAccountTypeController');
    route::resource('finance_bank','FinanceBankController');
    route::resource('procrastinations_type','FundProcrastinationTypeController');
    route::resource('procrastinations','FundProcrastinationController');
    route::resource('criticism','FundCriticismController');
    route::resource('current_assets','FundCurrentAssetsController');
    route::resource('fund_non_current','FundNonCurrentController');
    route::resource('funds_intangible_assets','FundIntangibleAssetsController');
    route::resource('fund_tangible_fixed_assets','FundTangibleFixedAssetsController');
    route::resource('fund','FinanceFundController');
    route::resource('fund_accounts_document_payable','FundAccountsAndDocumentsPayableController');
    Route::post('order-state/{id}','RepositoryController@order_state')->name('repository.order_state');
    Route::get('send_request/{id}','ProjectController@send_request')->name('projects.send_request');
    Route::get('show_data/{id}','SupportController@show_data')->name('support.show_data');
    Route::get('show','SupportController@show')->name('support.show');
    Route::get('show_response/{id}','ProjectController@show_response')->name('projects.show_response');
    Route::post('receive_verify/{id}','HelpDeskController@receive_verify')->name('help_desk.receive_verify');
    Route::get('receive_show/{id}','HelpDeskController@receive_show')->name('help_desk.receive_show');
    Route::get('show_all_response','ProjectController@show_all_response')->name('projects.show_all_response');
    Route::post('support_request','ProjectController@support_request')->name('projects.support_request');
    route::get('locale/{lan}', 'LanguageController@locale');
    Route::get('map', function (){
        $projects = \App\Project::all();
        return view('maps.fullscreenmap',['projects' => $projects]);
    })->name('map');



});