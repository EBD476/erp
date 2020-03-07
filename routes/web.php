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

Route::group(['middleware' => ['auth']], function () {

//    Resource route
    Route::resource('users', 'UserController');
    Route::resource('roles', 'RoleController');
    Route::resource('permissions', 'PermissionController');
    Route::resource('projects', 'ProjectController');
    Route::resource('order', 'OrderController');
    Route::resource('products', 'ProductController');
    route::resource('product', 'ProductController');
    route::resource('order_product', 'OrderProductController');
    route::resource('repository', 'RepositoryController');
    route::resource('repository_requirement', 'Repository_RequirementController');
    route::resource('request', 'RequestController');
    route::resource('verifier', 'VerifierController');
    route::resource('permission', 'PermissionController');
    route::resource('verify_pre', 'VerifyController');
    route::resource('help_desk', 'HelpDeskController');
    route::resource('client', 'ClientController');
    route::resource('part', 'PartController');
    route::resource('product_part', 'ProductPartController');
    route::resource('repository_create', 'RepositoryCreateController');
    route::resource('provider', 'ProviderController');
    route::resource('repository-part', 'RepositoryPartController');
    route::resource('agreement', 'AgreementController');
    route::resource('install', 'InstallController');
    route::resource('finance', 'FinanceController');
    route::resource('delivery', 'DeliveryController');
    route::resource('priority', 'HDpriorityController');
    route::resource('type', 'HDtypeController');
    route::resource('ticket', 'TicketStatusController');
    route::resource('level', 'HNTLevelController');
    route::resource('finance', 'FinanceController');
    route::resource('support_status', 'SupportStatusController');
    route::resource('support', 'SupportController');
    route::resource('conversation_view', 'ConversationViewController');
    route::resource('bank_account', 'BankAccountsController');
    route::resource('bank_account_type', 'BankAccountTypeController');
    route::resource('finance_bank', 'FinanceBankController');
    route::resource('procrastinations_type', 'FundProcrastinationTypeController');
    route::resource('procrastinations', 'FundProcrastinationController');
    route::resource('criticism', 'FundCriticismController');
    route::resource('current_assets', 'FundCurrentAssetsController');
    route::resource('fund_non_current', 'FundNonCurrentController');
    route::resource('funds_intangible_assets', 'FundIntangibleAssetsController');
    route::resource('fund_tangible_fixed_assets', 'FundTangibleFixedAssetsController');
    route::resource('fund', 'FinanceFundController');
    route::resource('fund_accounts_document_payable', 'FundAccountsAndDocumentsPayableController');
    route::resource('product-color', 'ProductColorController');
    route::resource('product-property', 'ProductPropertyController');
    route::resource('product-property-items', 'ProductPropertyItemsController');

//  Getting data
    Route::get('send_request/{id}', 'ProjectController@send_request')->name('projects.send_request');
    Route::get('show_data/{id}', 'SupportController@show_data')->name('support.show_data');
    Route::get('show', 'SupportController@show')->name('support.show');
    Route::get('show_response/{id}', 'ProjectController@show_response')->name('projects.show_response');
    Route::get('receive_show/{id}', 'HelpDeskController@receive_show')->name('help_desk.receive_show');
    Route::get('show_all_response', 'ProjectController@show_all_response')->name('projects.show_all_response');
    route::get('locale/{lan}', 'LanguageController@locale');
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('home', 'HomeController@index')->name('home');
    route::post('createpdf', 'OrderProductController@createpdf')->name('order_product.createpdf');
    route::get('preview', 'OrderController@preview')->name('order.preview');


//put data
    route::put('edit_pre/{id}', 'OrderController@edit_pre')->name('order.edit_pre');

//  Posting data
    Route::post('order-state/{id}', 'RepositoryController@order_state')->name('repository.order_state');
    Route::post('receive_verify/{id}', 'HelpDeskController@receive_verify')->name('help_desk.receive_verify');
    Route::post('support_request', 'ProjectController@support_request')->name('projects.support_request');
    route::post('checkbox', 'ProductController@checkbox')->name('product.checkbox');


//  Mapping route
    Route::get('map', function () {
        $projects = \App\Project::all();
        return view('maps.fullscreenmap', ['projects' => $projects]);
    })->name('map');


//  fill data table
    Route::get('/json-data-order', 'OrderController@fill')->name('order.json-data-order');
    Route::get('/json-data-users', 'UsersController@destroy')->name('users.json-data-users');
    Route::get('/json-data-roles', 'RolesController@destroy')->name('roles.json-data-roles');
    Route::get('/json-data-permissions', 'PermissionsController@destroy')->name('permission.json-data-permissions');
    Route::get('/json-data-projects', 'ProjectController@destroy')->name('projects.json-data-projects');
    Route::get('/json-data-product', 'ProductController@destroy')->name('product.json-data-product');
    Route::get('/json-data-repository', 'RepositoryController@destroy')->name('repository.json-data-repository');
    Route::get('/json-data-repository_requirement', 'RepositoryRequirementController@destroy')->name('repository_requirement.json-data-repository_requirement');
    Route::get('/json-data-verifier', 'VerifierController@destroy')->name('verifier.json-data-verifier');
    Route::get('/json-data-permission', 'PermissionController@destroy')->name('permission.json-data-permission');
    Route::get('/json-data-verify_pre', 'VerifyPreController@destroy')->name('verify_pre.json-data-verify_pre');
    Route::get('/json-data-help_desk', 'HelpDeskController@destroy')->name('help_desk.json-data-help_desk');
    Route::get('/json-data-client', 'ClientController@destroy')->name('client.json-data-client');
    Route::get('/json-data-part', 'PartController@destroy')->name('part.json-data-part');
    Route::get('/json-data-product_part', 'ProductPartController@destroy')->name('product_part.json-data-product_part');
    Route::get('/json-data-repository_create', 'RepositoryCreateController@destroy')->name('repository_create.json-data-repository_create');
    Route::get('/json-data-provider', 'ProviderController@destroy')->name('provider.json-data-provider');
    Route::get('/json-data-repository-part', 'RepositoryPartController@destroy')->name('repository-part.json-data-repository-part');
    Route::get('/json-data-agreement', 'AgreementController@destroy')->name('agreement.json-data-agreement');
    Route::get('/json-data-finance', 'FinanceDestroyController@destroy')->name('finance.json-data-finance');
    Route::get('/json-data-support_status', 'SupportStatusController@destroy')->name('support_status.json-data-support_status');
    Route::get('/json-data-support', 'SupportController@destroy')->name('support.json-data-support');
    Route::get('/json-data-bank_account', 'BankAccountController@destroy')->name('bank_account.json-data-bank_account');
    Route::get('/json-data-bank_account_type', 'BankAccountTypeController@destroy')->name('bank_account_type.json-data-bank_account_type');
    Route::get('/json-data-finance_bank', 'FinanceBankController@destroy')->name('finance_bank.json-data-finance_bank');
    Route::get('/json-data-procrastinations', 'ProcrastinationsController@destroy')->name('procrastinations.json-data-procrastinations');
    Route::get('/json-data-procrastinations_type', 'ProcrastinationsTypeController@destroy')->name('procrastinations_type.json-data-procrastinations_type');
    Route::get('/json-data-criticism', 'CriticismController@destroy')->name('criticism.json-data-criticism');
    Route::get('/json-data-current_assets', 'CurrentAssetsController@destroy')->name('current_assets.json-data-current_assets');
    Route::get('/json-data-fund_non_current', 'FundNonCurrentController@destroy')->name('fund_non_current.json-data-fund_non_current');
    Route::get('/json-data-funds_intangible_assets', 'FundsIntangibleAssetsController@destroy')->name('funds_intangible_assets.json-data-funds_intangible_assets');
    Route::get('/json-data-fund_tangible_fixed_assets', 'FundTangibleFixedAssetsController@destroy')->name('fund_tangible_fixed_assets.json-data-fund_tangible_fixed_assets');
    Route::get('/json-data-funds_intangible_assets', 'FundsIntangibleAssetsController@destroy')->name('funds_intangible_assets.json-data-funds_intangible_assets');
    Route::get('/json-data-fund', 'FundController@destroy')->name('fund.json-data-fund');
    Route::get('/json-data-fund_accounts_document_payable', 'FundAccountsDocumentPayableController@destroy')->name('fund_accounts_document_payable.json-data-fund_accounts_document_payable');
    Route::get('/json-data-product-color', 'ProductColorController@destroy')->name('product-color.json-data-product-color');
    Route::get('/json-data-product-property', 'ProductPropertyController@destroy')->name('product-property.json-data-product-property');
    Route::get('/json-data-product-property-items', 'ProductPropertyItemsController@destroy')->name('product-property-items.json-data-product-property-items');

//  deleted route
    Route::delete('/order-destroy/{id}', 'OrderController@destroy')->name('order.order-destroy');
    Route::delete('/users-destroy/{id}', 'UsersController@destroy')->name('users.users-destroy');
    Route::delete('/roles-destroy/{id}', 'RolesController@destroy')->name('roles.roles-destroy');
    Route::delete('/permissions-destroy/{id}', 'PermissionsController@destroy')->name('permission.permissions-destroy');
    Route::delete('/projects-destroy/{id}', 'ProjectController@destroy')->name('projects.projects-destroy');
    Route::delete('/product-destroy/{id}', 'ProductController@destroy')->name('product.product-destroy');
    Route::delete('/repository-destroy/{id}', 'RepositoryController@destroy')->name('repository.repository-destroy');
    Route::delete('/repository_requirement-destroy/{id}', 'RepositoryRequirementController@destroy')->name('repository_requirement.repository_requirement-destroy');
    Route::delete('/verifier-destroy/{id}', 'VerifierController@destroy')->name('verifier.verifier-destroy');
    Route::delete('/permission-destroy/{id}', 'PermissionController@destroy')->name('permission.permission-destroy');
    Route::delete('/verify_pre-destroy/{id}', 'VerifyPreController@destroy')->name('verify_pre.verify_pre-destroy');
    Route::delete('/help_desk-destroy/{id}', 'HelpDeskController@destroy')->name('help_desk.help_desk-destroy');
    Route::delete('/client-destroy/{id}', 'ClientController@destroy')->name('client.client-destroy');
    Route::delete('/part-destroy/{id}', 'PartController@destroy')->name('part.part-destroy');
    Route::delete('/product_part-destroy/{id}', 'ProductPartController@destroy')->name('product_part.product_part-destroy');
    Route::delete('/repository_create-destroy/{id}', 'RepositoryCreateController@destroy')->name('repository_create.repository_create-destroy');
    Route::delete('/provider-destroy/{id}', 'ProviderController@destroy')->name('provider.provider-destroy');
    Route::delete('/repository-part-destroy/{id}', 'RepositoryPartController@destroy')->name('repository-part.repository-part-destroy');
    Route::delete('/agreement-destroy/{id}', 'AgreementController@destroy')->name('agreement.agreement-destroy');
    Route::delete('/finance-destroy/{id}', 'FinanceDestroyController@destroy')->name('finance.finance-destroy');
    Route::delete('/support_status-destroy/{id}', 'SupportStatusController@destroy')->name('support_status.support_status-destroy');
    Route::delete('/support-destroy/{id}', 'SupportController@destroy')->name('support.support-destroy');
    Route::delete('/bank_account-destroy/{id}', 'BankAccountController@destroy')->name('bank_account.bank_account-destroy');
    Route::delete('/bank_account_type-destroy/{id}', 'BankAccountTypeController@destroy')->name('bank_account_type.bank_account_type-destroy');
    Route::delete('/finance_bank-destroy/{id}', 'FinanceBankController@destroy')->name('finance_bank.finance_bank-destroy');
    Route::delete('/procrastinations-destroy/{id}', 'ProcrastinationsController@destroy')->name('procrastinations.procrastinations-destroy');
    Route::delete('/procrastinations_type-destroy/{id}', 'ProcrastinationsTypeController@destroy')->name('procrastinations_type.procrastinations_type-destroy');
    Route::delete('/criticism-destroy/{id}', 'CriticismController@destroy')->name('criticism.criticism-destroy');
    Route::delete('/current_assets-destroy/{id}', 'CurrentAssetsController@destroy')->name('current_assets.current_assets-destroy');
    Route::delete('/fund_non_current-destroy/{id}', 'FundNonCurrentController@destroy')->name('fund_non_current.fund_non_current-destroy');
    Route::delete('/funds_intangible_assets-destroy/{id}', 'FundsIntangibleAssetsController@destroy')->name('funds_intangible_assets.funds_intangible_assets-destroy');
    Route::delete('/fund_tangible_fixed_assets-destroy/{id}', 'FundTangibleFixedAssetsController@destroy')->name('fund_tangible_fixed_assets.fund_tangible_fixed_assets-destroy');
    Route::delete('/funds_intangible_assets-destroy/{id}', 'FundsIntangibleAssetsController@destroy')->name('funds_intangible_assets.funds_intangible_assets-destroy');
    Route::delete('/fund-destroy/{id}', 'FundController@destroy')->name('fund.fund-destroy');
    Route::delete('/fund_accounts_document_payable-destroy/{id}', 'FundAccountsDocumentPayableController@destroy')->name('fund_accounts_document_payable.fund_accounts_document_payable-destroy');
    Route::delete('/product-color-destroy/{id}', 'ProductColorController@destroy')->name('product-color.product-color-destroy');
    Route::delete('/product-property-destroy/{id}', 'ProductPropertyController@destroy')->name('product-property.product-property-destroy');
    Route::delete('/product-property-items-destroy/{id}', 'ProductPropertyItemsController@destroy')->name('product-property-items.product-property-items-destroy');

});