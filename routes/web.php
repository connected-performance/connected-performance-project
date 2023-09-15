<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StaterkitController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\Panel\AnalyticsController;
use App\Http\Controllers\Panel\ContractController;
use App\Http\Controllers\Panel\DashboardContraoller;
use App\Http\Controllers\Panel\EmailTemplateController;
use App\Http\Controllers\Panel\EmployeeController;
use App\Http\Controllers\Panel\ExpenseController;
use App\Http\Controllers\Panel\FormController;
use App\Http\Controllers\Panel\InvoiceController;
use App\Http\Controllers\Panel\NotificationController;
use App\Http\Controllers\Panel\PerformanceController;
use App\Http\Controllers\Panel\PermissionController;
use App\Http\Controllers\Panel\PluginController;
use App\Http\Controllers\Panel\ReportsController;
use App\Http\Controllers\Panel\RoleController;
use App\Http\Controllers\Panel\SaleController;
use App\Http\Controllers\Panel\ServiceController;
use App\Http\Controllers\Panel\SettingController;
use App\Http\Controllers\Panel\SmartWaiverController;
use App\Http\Controllers\Panel\StatementController;
use App\Http\Controllers\Panel\UserController;
use App\Http\Controllers\Panel\TestController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\Panel\FileController;
use App\Models\Role;
use Illuminate\Support\Facades\Artisan;



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

Route::get('/',[AuthController::class,'index'])->name('index');
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('logout', [LoginController::class, 'logout'])->name('logout');
// Route::get('/', [StaterkitController::class, 'home'])->name('home');
Route::prefix('')->middleware('isAuthUser')->group(function () {
    Route::get('home', [StaterkitController::class, 'home'])->name('home');
    Route::post('alert', [DashboardContraoller::class, 'alert_data'])->name('alert.data');

    Route::prefix('/panel')->group(function () {
    Route::get('',[DashboardContraoller::class,'index'])->name('panel.index');
    Route::get('/analytics/{year?}/{month?}',[AnalyticsController::class,'dashboard'])->name('panel.analytics.index');
    Route::post('/analytics/get-leads-data',[AnalyticsController::class, 'getLeadsReports'])->name('panel.analytics.leads-data');
    Route::post('/analytics/getEmployeesCloseRate',[AnalyticsController::class, 'getEmployeesCloseRate'])->name('panel.analytics.get-employee-close-rate');
    Route::post('/analytics/employee-monthly-recurring-revenue',[AnalyticsController::class,'getMonthlyRecurringRevenuForEmployees'])
    ->name('panel.analytics.employee-monthly-recurring-revenue');
        Route::get('/test',[TestController::class,'test'])->name('panel.test');
        Route::post('/note/customer/save',[UserController::class,'noteSave'])->name('panel.user.note.save');
        Route::post('/note/customer/delete',[UserController::class,'noteDelete'])->name('panel.user.note.delete');
        Route::post('unpaid/invoice', [DashboardContraoller::class, 'unpaid_invoice'])->name('panel.unpaid.invoice');
        Route::post('paid/invoice', [DashboardContraoller::class, 'paid_invoice'])->name('panel.paid.invoice');
        Route::post('/month/earning/ajax', [DashboardContraoller::class, 'month_earning'])->name('month.earning.ajax');
        Route::post('/year/earning/ajax', [DashboardContraoller::class, 'year_earning'])->name('year.earning.ajax');
        Route::post('/revenue/ajax', [DashboardContraoller::class, 'revenue_ajax'])->name('dashboard.revenue.ajax');

          Route::prefix('/form/builder')->group(function () {
          Route::get('', [FormController::class, 'form_builder'])->name('form.builder');
          Route::post('/ajax',[FormController::class,'form_builder_ajax'])->name('form.builder.ajax');
          Route::post('/save', [FormController::class, 'form_builder_save'])->name('form.builder.save');
          Route::post('/edit', [FormController::class, 'form_builder_edit'])->name('form.builder.edit');
          Route::post('/delete', [FormController::class, 'form_builder_delete'])->name('form.builder.delete');
          Route::get('/field/{id}', [FormController::class, 'show_form_field'])->name('show.form.field');
           //Route::post('/field/ajax', [FormController::class, 'form_field_ajax'])->name('form.builder.ajax');
          Route::post('/field/ajax', [FormController::class, 'form_field_ajax'])->name('form.fields.ajax');
          Route::post('/field/save', [FormController::class, 'save_form_field'])->name('form.field.save');
          Route::post('/field/edit', [FormController::class, 'edit_form_field'])->name('form.field.edit');
          Route::post('/field/delete',[FormController::class,'delete_form_field'])->name('form.field.delete');
        });
        Route::prefix('/file')->group(function () {
            Route::get('', [FileController::class, 'index'])->name('file.room');
            Route::post('create', [FileController::class, 'create'])->name('file.create');
            Route::any('delete/{id}', [FileController::class, 'destroy'])->name('file.destroy');
        });
        Route::get('/lead', [LeadController::class, 'Leads'])->name('lead.view');
        Route::post('/lead/ajax', [LeadController::class, 'lead_ajax'])->name('lead.ajax');
        Route::post('/lead/create', [LeadController::class, 'Lead_cretae'])->name('lead.create');

        Route::post('lead/data/', [LeadController::class, 'lead_data'])->name('lead.data');
        Route::post('lead/delete/', [LeadController::class, 'lead_delete'])->name('lead.delete');
        Route::post('/lead/schedule',[LeadController::class, 'lead_schedual_metting'])->name('lead.schedual.metting');
        Route::post('mail/{id}',[LeadController::class, 'SendMail']);
        Route::post('/lead/note', [LeadController::class, 'lead_note'])->name('lead.notes');
        Route::post('/lead/loss', [LeadController::class, 'lead_loss'])->name('lead.loss');
        Route::post('/lead/step', [LeadController::class, 'lead_step'])->name('lead.step');



        Route::prefix('contract')->group(function () {
            Route::get('', [ContractController::class, "contract_index"])->name('contract.index');

        });
        Route::prefix('services')->group(function () {
            Route::get('', [ServiceController::class, "service_index"])->name('service.index');
            Route::post('ajax', [ServiceController::class, "service_ajax"])->name('service.ajax');
            Route::post('create', [ServiceController::class, "service_create"])->name('service.create');
            Route::post('edit', [ServiceController::class, "service_edit"])->name('service.edit');
            Route::post('delete', [ServiceController::class, "service_delete"])->name('service.delete');
        });
        Route::prefix('invoice')->group(function () {
            Route::get('', [SaleController::class, "invoice_index"])->name('invoice');
            Route::post('/ajax', [SaleController::class, "invoice_ajax"])->name('invoice.ajax');
            Route::post('/create', [SaleController::class, "invoice_create"])->name('invoice.create');
            Route::get('/detail/{id}', [SaleController::class, 'invoice_detail'])->name('invoice.detail');
            Route::post('/send', [SaleController::class,'invoice_send'])->name('invoice.send');
            Route::post('/delete', [SaleController::class, 'invoice_delete'])->name('invoice.delete');
            Route::post('/edit',[SaleController::class,"invoice_edit"])->name('invoice.edit');
            Route::post('/update', [SaleController::class, "invoice_update"])->name('invoice.update');

            // Route::get('/credit-notes', [SaleController::class, "credit_note_index"])->name('sale.credit-note');
            // Route::get('/expense',[SaleController::class,"expense_index"])->name('sale.expense');
        });


        Route::prefix('/')->group(function () {
            Route::get('admin', [UserController::class, "user_admin"])->name('user.admin');
            Route::get('employee', [UserController::class, "user_admin"])->name('employe.admin');
            Route::get('customer', [UserController::class, "user_admin"])->name('customer.admin');
            Route::post('add', [UserController::class, 'create_update_user'])->name('add.user');
            Route::post('delete', [UserController::class, 'delete'])->name('user.delete');
            Route::post('admin/data',[UserController::class, 'admin_data'])->name('admin.data');
            Route::post('/state', [UserController::class, 'get_state'])->name('user.state');
            Route::post('/city', [UserController::class, 'get_city'])->name('user.city');
            // Route::get('employe', [UserController::class, "user_trainer"])->name('user.employe');
            // Route::get('customer', [UserController::class, "ShowUser"])->name('user.customer');
            Route::post('admin/ajax',[UserController::class, 'user_ajax'])->name('admin.ajax');
            Route::post('/admin/edit', [UserController::class, 'user_edit'])->name('user.edit.data');
            Route::get('/detailt/{id}', [UserController::class, 'user_detail'])->name('user.detail');
            Route::get('/token/request/{id}', [UserController::class, 'token_request'])->name('user.token.request');
            Route::post('/detail/invoice/ajax', [UserController::class, 'user_detail_invoice_ajax'])->name('user.detail.invoice.ajax');
            Route::post('referral/ajax', [UserController::class, 'referral_ajax'])->name('referral.ajax');
            Route::get('send/mail', [UserController::class, 'create_mail'])->name('send.mail');
            Route::post('send/email', [UserController::class, 'send_mail'])->name('send.email');
            // Route::post('send/mail', [UserController::class, 'send_mail']);
            Route::post('singel/reciver', [UserController::class, 'single_reciver'])->name('user.reciver');

            Route::get('increase/duration', [UserController::class, 'increase_duration'])->name('customer.increase.duration');
            Route::post('increase/duration/save', [UserController::class, 'increase_duration_save'])->name('customer.increase.duration.save');
            Route::post('invoice/refund', [UserController::class, 'invoiceRefund'])->name('customer.invoice.refund');
            Route::post('invoice/cancel', [UserController::class, 'invoiceCancel'])->name('customer.invoice.cancel');
            Route::post('/notes/ajax', [UserController::class, 'user_detail_note_ajax'])->name('user.notes.ajax');
            Route::post('/notes/detail', [UserController::class, 'user_detail_note_detail'])->name('panel.user.notes.detail');
            Route::post('/invoice/user/create', [UserController::class, 'invoiceUserCreate'])->name('invoice.user.create');
            Route::post('/user/waiver', [UserController::class, 'userWaiver'])->name('user.waiver');


            Route::post('singel/reciver/send', [UserController::class, 'single_sender'])->name('send.single.user');
            Route::post('customer/to/lead', [UserController::class, 'customer_to_lead'])->name('customer.to.lead');
            Route::post('customer/to/lead', [UserController::class, 'customer_to_lead'])->name('customer.to.lead');
        });
        Route::prefix('performance')->group(function () {
            Route::get('/employee',[PerformanceController::class,'index'])->name('employe.performance');
            Route::post('/employee/ajax', [PerformanceController::class, 'emp_performane_ajax'])->name('employe.performance.ajax');
            Route::get('/lead/{id}', [PerformanceController::class, 'performance_lead'])->name('performance.lead');
            Route::post('/lead/ajax', [PerformanceController::class, 'performance_lead_ajax'])->name('performance.lead.ajax');
            Route::get('/customer/{id}', [PerformanceController::class, 'performance_customer'])->name('performance.customer');
            Route::post('/customer/ajax', [PerformanceController::class, 'performance_customer_ajax'])->name('performance.customer.ajax');
        
        });
        Route::prefix('my')->group(function () {
            Route::get('/customer', [EmployeeController::class, 'employee_customer'])->name('my.customer');
            Route::post('/customer/ajax', [EmployeeController::class, 'employee_customer_ajax'])->name('my.customer.ajax');
            Route::get('/referrals', [EmployeeController::class, 'employee_referrals'])->name('my.referral');
            Route::post('/referrals/ajax', [EmployeeController::class, 'employee_referrals_ajax'])->name('my.referral.ajax');
            Route::post('/referrals/create', [EmployeeController::class, 'employee_referrals_create' ])->name('my.create.referral');
            Route::post('/referrals/edit', [EmployeeController::class, 'employee_referrals_edit'])->name('my.referral.edit');
            Route::post('/referrals/delete', [EmployeeController::class, 'employee_referrals_delete'])->name('my.referral.delete');
            Route::get('/deal',[EmployeeController::class,'employee_deal'])->name('my.employee.deal');
            Route::post('/deal/ajax', [EmployeeController::class, 'employee_deal_ajax'])->name('my.employee.ajax');
            Route::get('/payment', [EmployeeController::class, 'employee_payment'])->name('my.payment');
        });
        Route::prefix('payment')->group(function (){
            Route::get('/employee',[SaleController::class, 'payment'])->name('payments.employee');
            Route::post('/employee/ajax', [SaleController::class, 'payment_ajax'])->name('payments.employee.ajax');
            Route::post('/create', [SaleController::class, 'payment_create'])->name('payments.create');
            Route::post('/edit', [SaleController::class, 'payment_edit'])->name('payments.edit');
            Route::post('/delete', [SaleController::class, 'payment_delete'])->name('payments.delete');
            Route::post('/send', [SaleController::class, 'payment_send'])->name('payments.send');

        });
        Route::prefix('')->group(function(){
            Route::get('permissions/{id}',[PermissionController::class,'permission_index'])->name('permision.index');
            Route::get('user/role',[RoleController::class,'role_index'])->name('user.role.index');
            Route::post('role/ajax', [RoleController::class, 'role_ajax'])->name('role.iajax');
            Route::post('role/create', [RoleController::class, 'create_role'])->name('role.create');
            Route::get('role/create/{id?}', [RoleController::class, 'new_role_create'])->name('create.role');
            Route::get('role/edit/{id}', [RoleController::class, 'role_edit'])->name('edit.role');
            Route::put('role/update/{id}', [RoleController::class, 'update'])->name('update.role');
            Route::post('role/destroy', [RoleController::class, 'destroy_role'])->name('role.destroy');
        });
           Route::prefix('setting')->group(function(){
            Route::get('/system',[SettingController::class,'system_index'])->name('system');
            Route::get('/time-zone',[SettingController::class, 'time_zone_index'])->name('time.zone');
            Route::get('/site', [SettingController::class, 'site_index'])->name('site');
            Route::get('/mail/notification', [SettingController::class, 'mail_notification_index'])->name('mail.notification');
            Route::get('/payment', [SettingController::class, 'payment_index'])->name('payement');
            Route::get('/currency',[SettingController::class, 'currency_index'])->name('currency');
            Route::get('/language',[SettingController::class, 'language_index'])->name('language');
            Route::get('page/content', [SettingController::class, 'page_content_index'])->name('page.content');

            //account
            Route::get('account', [SettingController::class, "user_profile"])->name('user.profile');
            Route::post('account/edit', [SettingController::class, "edit_profile"])->name('edit.user.profile');
            Route::post('account/upfate', [SettingController::class, "update_profile"])->name('update.user.profile');
            Route::get('account/secuirty', [SettingController::class, "account_secuirty"])->name('account.secuirty');
            Route::get('account/billing-plans', [SettingController::class, "account_billing_plans"])->name('account.billing.plan');
            Route::get('account/notificaton', [SettingController::class, "account_notification"])->name('account.notification');
            Route::get('account/connection', [SettingController::class, "account_connection"])->name('account.connection');

            //country
            Route::get('/country',[SettingController::class, 'country_setting'])->name('country');
            Route::post('/country/create', [SettingController::class, 'country_create'])->name('country.create');
            Route::post('/country/ajax', [SettingController::class, 'country_setting_ajax'])->name('country.ajax');
            Route::post('/country/delete', [SettingController::class, 'country_setting_delete'])->name('country.delete');

        });


        Route::prefix('reports')->group(function () {
            Route::get('/index', [ReportsController::class, 'index'])->name('reports.index');
            Route::post('/index/ajax', [ReportsController::class, 'index_ajax'])->name('reports.index.ajax');
            Route::post('/customer/ajax', [ReportsController::class, 'customer_ajax'])->name('reports.customer.ajax');
            Route::post('/mounth-recuring/ajax', [ReportsController::class, 'mounth_recuring_ajax'])->name('reports.mounth-recuring.ajax');
            Route::post('/project-revenue/ajax', [ReportsController::class, 'project_revenue_ajax'])->name('reports.project-revenue.ajax');
            Route::post('/pipeline-deal/ajax', [ReportsController::class, 'pipeline_deal_ajax'])->name('reports.pipeline-deal.ajax');

        });
        Route::prefix('notification')->group(function () {
            Route::get('/show', [NotificationController::class, 'index'])->name('notification.index');
            Route::post('/ajax', [NotificationController::class, 'ajax'])->name('notification.ajax');
            Route::post('/status', [NotificationController::class, 'status'])->name('notification.status');
            Route::post('/delete', [NotificationController::class, 'delete'])->name('notification.delete');


        });


        Route::prefix('plugin')->group(function () {
            Route::get('',[PluginController::class,'index'])->name('plugin.index');
            Route::post('/add', [PluginController::class, 'add_plugin'])->name('add.plugin');
            Route::post('/model', [PluginController::class, 'model'])->name('model');

        });

        Route::prefix('expense')->group(function () {
            Route::get('', [ExpenseController::class, 'index'])->name('plugin.expense'); 
        });
        Route::get('extra/amount', [ExpenseController::class, 'extra_charge'])->name('extra.amount');
        Route::post('extra/charges/ajaxt', [ExpenseController::class, 'extra_charge_ajax'])->name('extra.amount.ajax');
        Route::post('extra/charges/create', [ExpenseController::class, 'extra_charge_create'])->name('extra.charge.create');


        Route::prefix('statement')->group(function () {
            Route::get('', [StatementController::class, 'income_statment'])->name('statement.index');
            Route::get('/pdf', [StatementController::class, 'create_pdf'])->name('statement.export');
            Route::post('/ajax', [StatementController::class, 'statement_ajax'])->name('statement.ajax');
            Route::post('/ravenue/ajax', [StatementController::class, 'ravenue_ajax'])->name('statement.ravenue.ajax');
        });


        Route::prefix('goal')->group(function () {
            Route::get('', [ReportsController::class, 'get_goal'])->name('index.goal');
            Route::post('/update', [ReportsController::class, 'update_goal'])->name('update.goal');
        });


        Route::prefix('/smart-waiver')->group(function () {
            Route::get('/template', [SmartWaiverController::class, 'index'])->name('smart-waiver');
         
        });

    });
    // Route::get('/form/{code}',[FormController::class,'show_form'])->name('show.form');
    // Route Components
    Route::get('layouts/collapsed-menu', [StaterkitController::class, 'collapsed_menu'])->name('collapsed-menu');
    Route::get('layouts/full', [StaterkitController::class, 'layout_full'])->name('layout-full');
    Route::get('layouts/without-menu', [StaterkitController::class, 'without_menu'])->name('without-menu');
    Route::get('layouts/empty', [StaterkitController::class, 'layout_empty'])->name('layout-empty');
    Route::get('layouts/blank', [StaterkitController::class, 'layout_blank'])->name('layout-blank');
    // locale Route
    Route::get('lang/{locale}', [LanguageController::class, 'swap']);
    // Route::get('template/email', [TemplateController::class, 'emailtemplate'])->name('email-content');

    Route::prefix('templates')->group( function(){
        // Route::get('email/{template?}',[TemplateController::class,'emailtemplate'])->name('email');
         //Route::post('save-email-template/{name}',[TemplateController::class,'saveTemplate'])->name('save-template');
        Route::get('sms/{template?}', [TemplateController::class,'smsTemplates'])->name('sms');
        Route::post('save-sms-template/{name}', [TemplateController::class,'saveSmsTemplate'])->name('save-sms-template');
        Route::get('whatsapp', [TemplateController::class,'whatsappTemplate'])->name('whatsapp');
        Route::post('save-whatsapp-template', [TemplateController::class,'saveWhatsappTemplate'])->name('save-whatsapp-template');


        Route::get('/email/{slug?}', [EmailTemplateController::class, 'index'])->name('email');
        Route::post('/email/{slug?}', [EmailTemplateController::class, 'update'])->name('email_templates.update');
        Route::post('/email/store', [EmailTemplateController::class, 'store'])->name('email_templates.store');
    });

});

Route::get('/form/{code}', [FormController::class, 'show_form'])->name('show.form');

Route::view('page','content.form.message');
Route::view('test', 'test-page');
Route::view('comming-soon', 'page-coming-soon')->name('soon');

Route::post('leadGeneration/{id}', [LeadController::class, 'LeadGenerate'])->name('leadGeneration');
Route::get('invoice/{id}', [SaleController::class,'invoice_get'])->name('invoice.get');
Route::get('invoice/mail/user/{id}', [SaleController::class,'invoice_user_get'])->name('invoice.mail.user.get');
Route::get('terms', [SaleController::class,'terms'])->name('invoice.terms');
Route::get('charges/{id}', [ExpenseController::class, 'charges_get'])->name('charges.get');
Route::get('/token/request/update/{id}', [SaleController::class,'token_request'])->name('token.request.get');
Route::get('/update-information/{id}', [SaleController::class,'update_information'])->name('token.update_information');
Route::get('/customer-update-information/{id}', [SaleController::class,'customer_update_information'])->name('token.customer_update_information');


Route::post('/transaction', [SaleController::class, 'invoice_transaction'])->name('invoice.transaction');
Route::post('/token/request/update/save', [SaleController::class,'token_request_save'])->name('token.request.save');
Route::post('/transaction/user', [SaleController::class, 'invoice_transaction_user'])->name('invoice.transaction.user');

Route::get('command', function () {
    Artisan::call("storage:link");
    return "SSS";
});
// Route::view('test-mail','mail.wellcom');
Route::view('template-test-mail', 'content.sale.invoice-mailtemplate');
Route::get('welcome-mail',[InvoiceController::class, 'invoice_index'])->name('welcome.test');
Route::view('page/load', 'invoice-page');
Route::view('test-mail', 'test-page');
Route::view('test/card', 'test-card');
Route::view('test/extra', 'extra-charges');
