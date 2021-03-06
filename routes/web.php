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
    Route::resource('product', 'ProductController');
    Route::resource('order_product', 'OrderProductController');
    Route::resource('repository', 'RepositoryProductController');
    Route::resource('product_requirement', 'ProductRequirementController');
    Route::resource('request', 'RequestController');
    Route::resource('verifier', 'VerifierController');
    Route::resource('permission', 'PermissionController');
    Route::resource('verify_pre', 'VerifyController');
    Route::resource('help_desk', 'HelpDeskController');
    Route::resource('client', 'ClientController');
    Route::resource('part', 'PartController');
    Route::resource('product-part', 'ProductPartController');
    Route::resource('repository_create', 'RepositoryCreateController');
    Route::resource('provider', 'ProviderController');
    Route::resource('repository-part', 'RepositoryPartController');
    Route::resource('agreement', 'AgreementController');
    Route::resource('install', 'InstallController');
    Route::resource('finance', 'FinanceController');
    Route::resource('delivery', 'DeliveryController');
    Route::resource('priority', 'HDpriorityController');
    Route::resource('type', 'HDtypeController');
    Route::resource('ticket', 'TicketStatusController');
    Route::resource('level', 'HNTLevelController');
    Route::resource('finance', 'FinanceController');
    Route::resource('support_status', 'SupportStatusController');
    Route::resource('support', 'SupportController');
    Route::resource('conversation_view', 'ConversationViewController');
    Route::resource('bank_account', 'BankAccountsController');
    Route::resource('bank_account_type', 'BankAccountTypeController');
    Route::resource('finance_bank', 'FinanceBankController');
    Route::resource('procrastinations_type', 'FundProcrastinationTypeController');
    Route::resource('procrastinations', 'FundProcrastinationController');
    Route::resource('criticism', 'FundCriticismController');
    Route::resource('current_assets', 'FundCurrentAssetsController');
    Route::resource('fund_non_current', 'FundNonCurrentController');
    Route::resource('funds_intangible_assets', 'FundIntangibleAssetsController');
    Route::resource('fund_tangible_fixed_assets', 'FundTangibleFixedAssetsController');
    Route::resource('fund', 'FinanceFundController');
    Route::resource('fund_accounts_document_payable', 'FundAccountsAndDocumentsPayableController');
    Route::resource('product-color', 'ProductColorController');
    Route::resource('product-property', 'ProductPropertyController');
    Route::resource('product-property-items', 'ProductPropertyItemsController');
    Route::resource('product-tax', 'TaxController');
    Route::resource('middle-part', 'MiddlePartController');
    Route::resource('product-middle-part', 'ProductMiddlePartController');
    Route::resource('middle-section-part', 'MiddleSectionPartController');
    Route::resource('repository-middle-part', 'RepositoryMiddlePartController');
    Route::resource('middle-part-requirement', 'MiddlePartRequirementController');
    Route::resource('part-requirement', 'PartRequirementController');
    Route::resource('hd-receiver-user', 'HDReceiverUserController');
    Route::resource('product-zone', 'ProductZoneController');
    Route::resource('product-status', 'ProductStatusController');
    Route::resource('product-task', 'TaskController');
    Route::resource('qc', 'QCController');
    Route::resource('position', 'PositionUserController');
    Route::resource('hd-type-role', 'HDTypeRoleController');
    Route::resource('send-receiver-massage-role', 'LimitedMassageController');
    Route::resource('organizational-department', 'OrganizationalDepartmentsController');
    Route::resource('inventory-product', 'InventoryProductController');


//  Getting data
    Route::get('send_request/{id}', 'ProjectController@send_request')->name('projects.send_request');
    Route::get('show_data/{id}', 'SupportController@show_data')->name('support.show_data');
    Route::get('show', 'SupportController@show')->name('support.show');
    Route::get('show_response/{id}', 'ProjectController@show_response')->name('projects.show_response');
    Route::get('show_all_response', 'ProjectController@show_all_response')->name('projects.show_all_response');
    Route::get('locale/{lan}', 'LanguageController@locale');
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('home', 'HomeController@index')->name('home');
    Route::get('preview', 'OrderController@preview')->name('order.preview');
    Route::get('product-report-user/{id}', 'TaskController@preview')->name('product-task.preview');
    Route::get('invoices_list_product', 'OrderController@invoices_list_product')->name('order.invoices_list_product');
    Route::get('computing-middle-part-detail', 'MiddleSectionPartController@computing_middle_part_detail')->name('middle_section_part.computing-middle-part-detail');
    Route::get('computing-product-part-detail', 'ProductPartController@computing_product_part_detail')->name('product_part.computing-product-part-detail');
    Route::get('computing-product-middle-part-detail', 'ProductMiddlePartController@computing_product_middle_part_detail')->name('product_middle_part.computing-product-middle-part-detail');
    Route::get('product-price-index', 'ProductController@product_price_index')->name('product.product-price-index');
    Route::get('report-list', 'TaskController@product_task_report_list')->name('product-task.report-list');
    Route::get('inbox', 'ConversationViewController@inbox')->name('conversation_view.inbox');


//put data
    Route::put('edit_pre/{id}', 'OrderController@edit_pre')->name('order.edit_pre');
    Route::put('checkbox/{id}', 'ProductController@checkbox')->name('product.checkbox');
    Route::put('product-price/{id}', 'ProductController@product_price')->name('product.product-price');
    Route::put('receive_show/{id}', 'HelpDeskController@receive_show')->name('help_desk.receive_show');
    Route::put('order-state/{id}', 'RepositoryProductController@order_state')->name('repository.order_state');
    Route::put('checkbox-product-status/{id}', 'TaskController@checkbox')->name('product-task.checkbox-product-status');
    Route::put('update-status/{id}', 'ConversationViewController@update_status')->name('conversation_view.update-status');





//  Posting data
    Route::post('order-state/{id}', 'RepositoryProductController@order_state')->name('repository.order_state');
    Route::post('add-product', 'OrderProductController@add')->name('product.add');
    Route::post('receive_verify/{id}', 'HelpDeskController@receive_verify')->name('help_desk.receive_verify');
    Route::post('support_request', 'ProjectController@support_request')->name('projects.support_request');
    Route::post('store-report', 'TaskController@store_report')->name('product-task.store_report');
    Route::post('createpdf', 'OrderProductController@createpdf')->name('order_product.createpdf');
    Route::post('activation-create-serial-number-status/{id}', 'ProductController@activation_create_serial_number_status')->name('product.activation-create-serial-number-status');
    Route::post('conversation_view_store', 'ConversationViewController@conversation_view_store')->name('conversation_view.conversation_view_store');
    Route::post('new-password', 'UserController@new')->name('users.new-password');


//    uploaded image route
    Route::post('/product-image-save', 'ProductController@upload')->name('product.upload');
    Route::post('/part-image-save', 'PartController@upload')->name('part.upload');
    Route::post('/middle-part-image-save', 'MiddlePartController@upload')->name('middle-part.upload');
    Route::post('/user-image-save', 'UserController@upload')->name('users.upload');
    Route::post('/request-file-save', 'ProjectController@upload')->name('project.upload');
    Route::post('/response-file-save', 'SupportController@upload')->name('support.upload');
    Route::post('/help_desk-file-save', 'HelpDeskController@upload')->name('help_desk.upload');
    Route::post('/request-message-file-save', 'ConversationViewController@request_message_file_save')->name('conversation_view.request-message-file-save');
    Route::post('/response-message-file-save', 'ConversationViewController@response_message_file_save')->name('conversation_view.response-message-file-save');


//  Mapping route
    Route::get('map', function () {
        $projects = \App\Project::all();
        return view('maps.fullscreenmap', ['projects' => $projects]);
    })->name('map');


//  fill data table
    Route::get('/json-data-order', 'OrderController@fill')->name('order.json-data-order');
    Route::get('/json-data-order-all', 'OrderController@fill_all')->name('order.json-data-order-all');
    Route::get('/json-data-users', 'UsersController@fill')->name('users.json-data-users');
    Route::get('/json-data-roles', 'RolesController@fill')->name('roles.json-data-roles');
    Route::get('/json-data-permissions', 'PermissionsController@fill')->name('permission.json-data-permissions');
    Route::get('/json-data-projects', 'ProjectController@fill')->name('projects.json-data-projects');
    Route::get('/json-data-product', 'ProductController@fill')->name('product.json-data-product');
    Route::get('/json-data-product-price', 'ProductController@fill_product_price')->name('product.json-data-product-price');
    Route::get('/json-data-repository', 'RepositoryProductController@fill')->name('repository.json-data-repository');
    Route::get('/json-data-repository_requirement', 'RepositoryRequirementController@fill')->name('repository_requirement.json-data-repository_requirement');
    Route::get('/json-data-verifier', 'VerifierController@fill')->name('verifier.json-data-verifier');
    Route::get('/json-data-permission', 'PermissionController@fill')->name('permission.json-data-permission');
    Route::get('/json-data-verify_pre', 'VerifyPreController@fill')->name('verify_pre.json-data-verify_pre');
    Route::get('/json-data-help-desk', 'HelpDeskController@fill_sender')->name('help_desk.json-data-help-desk');
    Route::get('/json-data-help-desk-r', 'HelpDeskController@fill_receiver')->name('help_desk.json-data-help-desk-r');
    Route::get('/json-data-client', 'ClientController@fill')->name('client.json-data-client');
    Route::get('/json-data-part', 'PartController@fill')->name('part.json-data-part');
    Route::get('/json-data-product-part', 'ProductPartController@fill')->name('product-part.json-data-product-part');
    Route::get('/json-data-repository_create', 'RepositoryCreateController@fill')->name('repository_create.json-data-repository_create');
    Route::get('/json-data-provider', 'ProviderController@fill')->name('provider.json-data-provider');
    Route::get('/json-data-repository-part', 'RepositoryPartController@fill')->name('repository-part.json-data-repository-part');
    Route::get('/json-data-agreement', 'AgreementController@fill')->name('agreement.json-data-agreement');
    Route::get('/json-data-finance', 'FinanceDestroyController@fill')->name('finance.json-data-finance');
    Route::get('/json-data-support_status', 'SupportStatusController@fill')->name('support_status.json-data-support_status');
    Route::get('/json-data-support', 'SupportController@fill')->name('support.json-data-support');
    Route::get('/json-data-support-all', 'SupportController@fill_all')->name('support.json-data-support-all');
    Route::get('/json-data-support-recent-list', 'SupportController@recent_list')->name('support.json-data-support-recent-list');
    Route::get('/json-data-bank_account', 'BankAccountController@fill')->name('bank_account.json-data-bank_account');
    Route::get('/json-data-bank_account_type', 'BankAccountTypeController@fill')->name('bank_account_type.json-data-bank_account_type');
    Route::get('/json-data-finance_bank', 'FinanceBankController@fill')->name('finance_bank.json-data-finance_bank');
    Route::get('/json-data-procrastinations', 'ProcrastinationsController@fill')->name('procrastinations.json-data-procrastinations');
    Route::get('/json-data-procrastinations_type', 'ProcrastinationsTypeController@fill')->name('procrastinations_type.json-data-procrastinations_type');
    Route::get('/json-data-criticism', 'CriticismController@fill')->name('criticism.json-data-criticism');
    Route::get('/json-data-current_assets', 'CurrentAssetsController@fill')->name('current_assets.json-data-current_assets');
    Route::get('/json-data-fund_non_current', 'FundNonCurrentController@fill')->name('fund_non_current.json-data-fund_non_current');
    Route::get('/json-data-funds_intangible_assets', 'FundsIntangibleAssetsController@fill')->name('funds_intangible_assets.json-data-funds_intangible_assets');
    Route::get('/json-data-fund_tangible_fixed_assets', 'FundTangibleFixedAssetsController@fill')->name('fund_tangible_fixed_assets.json-data-fund_tangible_fixed_assets');
    Route::get('/json-data-funds_intangible_assets', 'FundsIntangibleAssetsController@fill')->name('funds_intangible_assets.json-data-funds_intangible_assets');
    Route::get('/json-data-fund', 'FundController@fill')->name('fund.json-data-fund');
    Route::get('/json-data-fund_accounts_document_payable', 'FundAccountsDocumentPayableController@fill')->name('fund_accounts_document_payable.json-data-fund_accounts_document_payable');
    Route::get('/json-data-product-color', 'ProductColorController@fill')->name('product-color.json-data-product-color');
    Route::get('/json-data-product-property', 'ProductPropertyController@fill')->name('product-property.json-data-product-property');
    Route::get('/json-data-product-property-items', 'ProductPropertyItemsController@fill')->name('product-property-items.json-data-product-property-items');
    Route::get('/json-data-middle-part-requirement', 'MiddlePartRequirementController@fill')->name('middle-part-requirement.json-data-middle-part-requirement');
    Route::get('/json-data-part-requirement', 'PartRequirementController@fill')->name('part-requirement.json-data-part-requirement');
    Route::get('/json-data-product-requirement', 'ProductRequirementController@fill')->name('product-requirement.json-data-product-requirement');
    Route::get('/json-data-product-middle-part', 'ProductMiddlePartController@fill')->name('product-middle-part.json-data-product-middle-part');
    Route::get('/json-data-middle-part', 'MiddlePartController@fill')->name('middle-part.json-data-middle-part');
    Route::get('/json-data-middle-section-part', 'MiddleSectionPartController@fill')->name('middle-section-part.json-data-middle-section-part');
    Route::get('/json-data-repository-part', 'RepositoryPartController@fill')->name('repository-part.json-data-repository-part');
    Route::get('/json-data-repository-middle-part', 'RepositoryMiddlePartController@fill')->name('repository-middle-part.json-data-repository-middle-part');
    Route::get('/json-data-repository-product', 'RepositoryProductController@fill')->name('repository-product.json-data-repository-product');
    Route::get('/json-data-priority', 'HDpriorityController@fill')->name('priority.json-data-priority');
    Route::get('/json-data-type', 'HDtypeController@fill')->name('type.json-data-type');
    Route::get('/json-data-level', 'HNTLevelController@fill')->name('level.json-data-level');
    Route::get('/json-data-ticket', 'TicketStatusController@fill')->name('ticket.json-data-ticket');
    Route::get('/json-data-hd-receiver-user', 'HDReceiverUserController@fill')->name('hd-receiver-user.json-data-hd-receiver-user');
    Route::get('/json-data-product-zone', 'ProductZoneController@fill')->name('product-zone.json-data-product-zone');
    Route::get('/json-data-repository-part-p', 'RepositoryPartController@fill_p')->name('repository-part.json-data-repository-part-p');
    Route::get('/json-data-repository-middle-part-p', 'RepositoryMiddlePartController@fill_p')->name('repository-middle-part.json-data-repository-middle-part-p');
    Route::get('/json-data-repository-product-p', 'RepositoryProductController@fill_p')->name('repository-product.json-data-repository-product-p');
    Route::get('/json-data-product-status', 'ProductStatusController@fill')->name('product-status.json-data-product-status');
    Route::get('/invoices-list-product', 'OrderController@invoices_list_product_fill')->name('order.invoices-list-product');
    Route::get('/json-data-middle-section-part-compute', 'MiddleSectionPartController@computing_middle_part')->name('middle_section_part.json-data-middle-section-part-compute');
    Route::get('/invoices-list-product-inventory', 'OrderController@invoices_list_product_inventory')->name('order.invoices-list-product-inventory');
    Route::get('json-data-product-task', 'TaskController@fill')->name('product-task.json-data-product-task');;
    Route::get('json-data-product-new-task', 'TaskController@fill_new')->name('product-task.json-data-product-new-task');;
    Route::get('json-data-product-report-list', 'TaskController@fill_report_list')->name('product-task.json-data-product-report-list');;
    Route::get('json-data-product-part-compute', 'ProductPartController@computing_product_part')->name('product_part.computing-product-part');
    Route::get('json-data-product-middle-part-compute', 'ProductMiddlePartController@computing_product_middle_part')->name('product_middle_part.json-data-product-middle-part-compute');
    Route::get('json-data-install', 'InstallController@fill')->name('install.json-data-install');
    Route::get('json-data-install-all', 'InstallController@fill_all')->name('install.json-data-install-all');
    Route::get('json-data-delivery', 'DeliveryController@fill')->name('delivery.json-data-delivery');
    Route::get('json-data-delivery-all', 'DeliveryController@fill_all')->name('delivery.json-data-delivery-all');
    Route::get('json-data-qc', 'QCController@fill')->name('qc.json-data-qc');
    Route::get('json-data-qc-all', 'QCController@fill_all')->name('qc.json-data-delivery-all');
    Route::get('json-data-fill-repository-qc', 'QCController@fill_repository_qc')->name('qc.json-data-fill-repository-qc');
    Route::get('json-data-fill-response', 'ProjectController@fill_response')->name('projects.json-data-fill-response');
    Route::get('activation-create-serial-number-index', 'ProductController@activation_create_serial_number_index')->name('product.activation-create-serial-number-index');
    Route::get('json-data-message-receive', 'ConversationViewController@fill_receive')->name('conversationview.json-data-message-receive');
    Route::get('json-data-message-send', 'ConversationViewController@fill_send')->name('conversationview.json-data-message-send');
    Route::get('fill-unread-message', 'ConversationViewController@fill_unread_message')->name('conversationview.fill-unread-message');
    Route::get('json-data-position', 'PositionUserController@fill')->name('position.json-data-position');
    Route::get('json-data-hd-receiver-role', 'HDTypeRoleController@fill')->name('hd-type-role.json-data-hd-receiver-role');
    Route::get('json-data-send-receiver-massage-role', 'LimitedMassageController@fill')->name('send-receiver-massage-role.json-data-send-receiver-massage-role');
    Route::get('json-data-organizational-department', 'OrganizationalDepartmentsController@fill')->name('organizational-department.json-data-organizational-department');
    Route::get('invoices-list-finance', 'FinanceController@fill')->name('finance.invoices-list-finance');
    Route::get('invoices-list-finance-all', 'FinanceController@fill_all')->name('finance.invoices-list-finance-all');
    Route::get('inventory-product-fill', 'InventoryProductController@fill')->name('inventory-product.inventory-product-fill');
    Route::get('inventory-product-fill-all', 'InventoryProductController@fill_all')->name('inventory-product.inventory-product-fill-all');
    Route::get('/json-data-repository-part-fill-all', 'RepositoryPartController@fill_all')->name('repository-part.json-data-repository-part-fill-all');
    Route::get('/json-data-repository-middle-part-fill-all', 'RepositoryMiddlePartController@fill_all')->name('repository-middle-part.json-data-repository-middle-part-fill-all');
    Route::get('/json-data-repository-product-fill-all', 'RepositoryProductController@fill_all')->name('repository-product.json-data-repository-product-fill-all');




//fill select to data
    Route::get('/json-data-fill-client-data', 'OrderController@fill_data_client')->name('order.json-data-fill-client-data');
    Route::get('/json-data-fill-data-city', 'OrderController@fill_data_city')->name('order.json-data-fill-data-city');
    Route::get('/json-data-fill-data-state', 'OrderController@fill_data_state')->name('order.json-data-fill-data-state');
    Route::get('/json-data-fill-data-product', 'OrderController@fill_data_product')->name('order.json-data-fill-data-product');
    Route::get('/json-data-fill-data-product-color', 'ProductController@fill_data_product_color')->name('product.json-data-fill-data-product-color');
    Route::get('/json-data-fill-data-product-item', 'ProductController@fill_data_product_item')->name('product.json-data-fill-data-product-item');
    Route::get('/json-data-fill-data-product-property', 'ProductController@fill_data_product_property')->name('product-middle-part.json-data-fill-data-product-property');
    Route::get('/json-data-fill-data-middle-part', 'MiddlePartController@fill_data_middle_part')->name('middle-part.json-data-fill-data-middle-part');
    Route::get('/json-data-fill-data-middle-part','MiddlePartController@fill_data_middle_part')->name('middle-part.json-data-fill-data-middle-part');
    Route::get('/json-data-fill-data-part', 'PartController@fill_data_part')->name('part.json-data-fill-data-part');
    Route::get('/json-data-fill-data-provider', 'ProviderController@fill_data_provider')->name('provider.json-data-fill-data-provider');
    Route::get('/json-data-fill-hd-receiver-user', 'HDReceiverUserController@fill_data_receiver')->name('hd-receiver-user.json-data-fill-hd-receiver-user');
    Route::get('/json-data-fill-type-ticket', 'HDReceiverUserController@fill_type_ticket')->name('hd-receiver-user.json-data-fill-type-ticket');
    Route::get('/json-data-fill-data-zone', 'ProductZoneController@fill_data_zone')->name('product-zone.json-data-fill-data-zone');
    Route::get('/json-data-fill-position-user', 'PositionUserController@fill_data_position')->name('position.json-data-fill-position-user');
    Route::get('/json-data-fill-hd-receiver-role', 'HDTypeRoleController@select_receiver_role')->name('hd-type-role.select-receiver-role');
    Route::get('/json-data-fill-department', 'OrganizationalDepartmentsController@json_data_fill_department')->name('organizational-department.json-data-fill-department');
    Route::get('/fill-data-limited-user', 'LimitedMassageController@fill_data_limited_user')->name('send-receiver-massage-role.fill-data-limited-user');
    Route::get('/fill-repository-name','RepositoryCreateController@fill_repository_name')->name('repository_create.fill_repository_name');


//  deleted route
    Route::delete('/order-destroy/{id}', 'OrderController@destroy')->name('order.order-destroy');
    Route::delete('/users-destroy/{id}', 'UsersController@destroy')->name('users.users-destroy');
    Route::delete('/roles-destroy/{id}', 'RolesController@destroy')->name('roles.roles-destroy');
    Route::delete('/permissions-destroy/{id}', 'PermissionsController@destroy')->name('permission.permissions-destroy');
    Route::delete('/projects-destroy/{id}', 'ProjectController@destroy')->name('projects.projects-destroy');
    Route::delete('/product-destroy/{id}', 'ProductController@destroy')->name('product.product-destroy');
    Route::delete('/repository-destroy/{id}', 'RepositoryProductController@destroy')->name('repository.repository-destroy');
    Route::delete('/repository_requirement-destroy/{id}', 'RepositoryRequirementController@destroy')->name('repository_requirement.repository_requirement-destroy');
    Route::delete('/verifier-destroy/{id}', 'VerifierController@destroy')->name('verifier.verifier-destroy');
    Route::delete('/permission-destroy/{id}', 'PermissionController@destroy')->name('permission.permission-destroy');
    Route::delete('/verify_pre-destroy/{id}', 'VerifyPreController@destroy')->name('verify_pre.verify_pre-destroy');
    Route::delete('/help_desk-destroy/{id}', 'HelpDeskController@destroy')->name('help_desk.help_desk-destroy');
    Route::delete('/client-destroy/{id}', 'ClientController@destroy')->name('client.client-destroy');
    Route::delete('/part-destroy/{id}', 'PartController@destroy')->name('part.part-destroy');
    Route::delete('/product-part-destroy/{id}', 'ProductPartController@destroy')->name('product-part.product-part-destroy');
    Route::delete('/repository-create-destroy/{id}', 'RepositoryCreateController@destroy')->name('repository_create.repository_create-destroy');
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
    Route::delete('/middle-part-requirement-destroy/{id}', 'MiddlePartRequirementController@destroy')->name('middle-part-requirement.middle-part-requirement-destroy');
    Route::delete('/part-requirement-destroy/{id}', 'PartRequirementController@destroy')->name('part-requirement.part-requirement-destroy');
    Route::delete('/product-requirement-destroy/{id}', 'ProductRequirementController@destroy')->name('product-requirement.product-requirement-destroy');
    Route::delete('/product-middle-part-destroy/{id}', 'ProductMiddlePartController@destroy')->name('product-middle-part.product-middle-part-destroy');
    Route::delete('/product-middle-part-destroy/{id}', 'ProductMiddlePartController@destroy')->name('product-middle-part.product-middle-part-destroy');
    Route::delete('/middle-part-destroy/{id}', 'MiddlePartController@destroy')->name('middle-part.middle-part-destroy');
    Route::delete('/middle-section-part-destroy/{id}', 'MiddleSectionPartController@destroy')->name('middle-section-part.middle-section-part-destroy');
    Route::delete('/repository-product-destroy/{id}', 'RepositoryProductController@destroy')->name('repository-product.repository-product-destroy');
    Route::delete('/repository-middle-part-destroy/{id}', 'RepositoryMiddlePartController@destroy')->name('repository-middle-part.repository-middle-part-destroy');
    Route::delete('/priority-destroy/{id}', 'HDpriorityController@destroy')->name('priority.priority-destroy');
    Route::delete('/type-destroy/{id}', 'HDtypeController@destroy')->name('type.type-destroy');
    Route::delete('/level-destroy/{id}', 'HNTLevelController@destroy')->name('level.level-destroy');
    Route::delete('/ticket-destroy/{id}', 'TicketStatusController@destroy')->name('ticket.ticket-destroy');
    Route::delete('/hd-receiver-user-destroy/{id}', 'HDReceiverUserController@destroy')->name('hd-receiver-user.hd-receiver-user-destroy');
    Route::delete('/product-zone-destroy/{id}', 'ProductZoneController@destroy')->name('product-zone.product-zone-destroy');
    Route::delete('/product-status-destroy/{id}', 'ProductStatusController@destroy')->name('product-status.product-status-destroy');
    Route::delete('/product-task-destroy/{id}', 'TaskController@destroy')->name('product-task.product-task-destroy');;
    Route::delete('/position-destroy/{id}', 'PositionUserController@destroy')->name('position.position-destroy');;
    Route::delete('/hd-receiver-role-destroy/{id}', 'HDTypeRoleController@destroy')->name('hd-type-role.hd-receiver-role-destroy');;
    Route::delete('/send-receiver-massage-role-destroy/{id}', 'LimitedMassageController@destroy')->name('send-receiver-massage-role.send-receiver-massage-role-destroy');;
    Route::delete('/organizational-department-destroy/{id}', 'OrganizationalDepartmentsController@destroy')->name('organizational-department.organizational-department-destroy');;



//    un link image
    Route::delete('/product-destroy-image/{id}', 'ProductController@destroy_image')->name('product.product-destroy-image');
    Route::delete('/middle-part-destroy-image/{id}', 'MiddlePartController@destroy_image')->name('middle-part.middle-part-destroy-image');
    Route::delete('/part-destroy-image/{id}', 'PartController@destroy_image')->name('part.part-destroy-image');
    Route::delete('/user-destroy-image/{id}', 'UserController@destroy_image')->name('user.user-destroy-image');


});