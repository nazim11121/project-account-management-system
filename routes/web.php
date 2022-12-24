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

Route::group(['middleware' => ['auth']], function () { 
	$controller_path = 'App\Http\Controllers';
    Route::get('/', $controller_path . '\backend\DashboardController@index')->name('dashboard');


$controller_path = 'App\Http\Controllers';
// authentication
// Route::get('/', $controller_path . '\authentications\LoginBasic@index')->name('auth-login-basic');
// Route::get('/auth/register-basic', $controller_path . '\authentications\RegisterBasic@index')->name('auth-register-basic');
// Route::get('/auth/forgot-password-basic', $controller_path . '\authentications\ForgotPasswordBasic@index')->name('auth-reset-password-basic');

/*backend controller start*/
// Route::get('/', $controller_path . '\backend\DashboardController@index')->name('dashboard');
//client
Route::get('/admin/client-list', $controller_path . '\backend\ClientController@index')->name('client-list');
Route::get('/admin/client-create', $controller_path . '\backend\ClientController@create')->name('client-create');
Route::post('/admin/client-store', $controller_path . '\backend\ClientController@store')->name('client-store');
Route::get('/admin/client-edit/{id}', $controller_path . '\backend\ClientController@edit')->name('client-edit');
Route::match(['put', 'patch'],'/admin/client-update/{id}', $controller_path . '\backend\ClientController@update')->name('client-update');
Route::delete('/admin/client-destroy/{id}', $controller_path . '\backend\ClientController@destroy')->name('client-destroy');
//employee
Route::get('/admin/employee-list', $controller_path . '\backend\EmployeeController@index')->name('employee-list');
Route::get('/admin/employee-create', $controller_path . '\backend\EmployeeController@create')->name('employee-create');
Route::post('/admin/employee-store', $controller_path . '\backend\EmployeeController@store')->name('employee-store');
Route::get('/admin/employee-edit/{id}', $controller_path . '\backend\EmployeeController@edit')->name('employee-edit');
Route::match(['put', 'patch'],'/admin/employee-update/{id}', $controller_path . '\backend\EmployeeController@update')->name('employee-update');
Route::delete('/admin/employee-destroy/{id}', $controller_path . '\backend\EmployeeController@destroy')->name('employee-destroy');
//vendor
Route::get('/admin/vendor-list', $controller_path . '\backend\VendorController@index')->name('vendor-list');
Route::get('/admin/vendor-create', $controller_path . '\backend\VendorController@create')->name('vendor-create');
Route::post('/admin/vendor-store', $controller_path . '\backend\VendorController@store')->name('vendor-store');
Route::get('/admin/vendor-edit/{id}', $controller_path . '\backend\VendorController@edit')->name('vendor-edit');
Route::match(['put', 'patch'],'/admin/vendor-update/{id}', $controller_path . '\backend\VendorController@update')->name('vendor-update');
Route::delete('/admin/vendor-destroy/{id}', $controller_path . '\backend\VendorController@destroy')->name('vendor-destroy');
//purchase_costing
Route::get('/admin/purchase-costing-list', $controller_path . '\backend\CostingController@index')->name('purchase-costing-list');
Route::get('/admin/purchase-costing-create', $controller_path . '\backend\CostingController@create')->name('purchase-costing-create');
Route::get('/admin/purchase-costing-create-pname', $controller_path . '\backend\CostingController@pname')->name('purchase-costing-create-pname');
Route::get('/admin/purchase-costing-create-pname2', $controller_path . '\backend\CostingController@pname2')->name('purchase-costing-create-pname2');
Route::post('/admin/purchase-costing-store', $controller_path . '\backend\CostingController@store')->name('purchase-costing-store');
Route::get('/admin/purchase-costing-edit/{id}', $controller_path . '\backend\CostingController@edit')->name('purchase-costing-edit');
Route::match(['put', 'patch'],'/admin/purchase-costing-update/{id}', $controller_path . '\backend\CostingController@update')->name('purchase-costing-update');
Route::delete('/admin/purchase-costing-destroy/{id}', $controller_path . '\backend\CostingController@destroy')->name('purchase-costing-destroy');
//category
Route::get('/admin/account-category-list', $controller_path . '\backend\CategoryController@index')->name('account-category-list');
Route::get('/admin/account-category-create', $controller_path . '\backend\CategoryController@create')->name('account-category-create');
Route::post('/admin/account-category-store', $controller_path . '\backend\CategoryController@store')->name('account-category-store');
Route::get('/admin/account-category-edit/{id}', $controller_path . '\backend\CategoryController@edit')->name('account-category-edit');
Route::match(['put', 'patch'],'/admin/account-category-update/{id}', $controller_path . '\backend\CategoryController@update')->name('account-category-update');
Route::delete('/admin/account-category-destroy/{id}', $controller_path . '\backend\CategoryController@destroy')->name('account-category-destroy');
//project/inventory
Route::get('/admin/project-list', $controller_path . '\backend\InventoryController@index')->name('project-list');
Route::get('/admin/project-create', $controller_path . '\backend\InventoryController@create')->name('project-create');
Route::post('/admin/project-store', $controller_path . '\backend\InventoryController@store')->name('project-store');
Route::get('/admin/project-edit/{id}', $controller_path . '\backend\InventoryController@edit')->name('project-edit');
Route::match(['put', 'patch'],'/admin/project-update/{id}', $controller_path . '\backend\InventoryController@update')->name('project-update');
Route::delete('/admin/project-destroy/{id}', $controller_path . '\backend\InventoryController@destroy')->name('project-destroy');
//product inventory
Route::get('/admin/product-list', $controller_path . '\backend\ProductController@index')->name('product-list');
Route::get('/admin/product-create', $controller_path . '\backend\ProductController@create')->name('product-create');
Route::post('/admin/product-store', $controller_path . '\backend\ProductController@store')->name('product-store');
Route::get('/admin/product-edit/{id}', $controller_path . '\backend\ProductController@edit')->name('product-edit');
Route::match(['put', 'patch'],'/admin/product-update/{id}', $controller_path . '\backend\ProductController@update')->name('product-update');
Route::delete('/admin/product-destroy/{id}', $controller_path . '\backend\ProductController@destroy')->name('product-destroy');
//sell
Route::get('/admin/account-sell-index', $controller_path . '\backend\SellController@index')->name('account-sell-index');
Route::get('/admin/account-sell-create', $controller_path . '\backend\SellController@create')->name('account-sell-create');
Route::post('/admin/account-sell-store', $controller_path . '\backend\SellController@store')->name('account-sell-store');
Route::get('/admin/account-sell-edit/{id}', $controller_path . '\backend\SellController@edit')->name('account-sell-edit');
Route::match(['put', 'patch'],'/admin/account-sell-update/{id}', $controller_path . '\backend\SellController@update')->name('account-sell-update');
Route::delete('/admin/account-sell-destroy/{id}', $controller_path . '\backend\SellController@destroy')->name('account-sell-destroy');
//bank-cash
Route::get('/admin/account-bank-cash-list', $controller_path . '\backend\BankCashController@index')->name('account-bank-cash-list');
Route::get('/admin/account-bank-cash-create', $controller_path . '\backend\BankCashController@create')->name('account-bank-cash-create');
Route::post('/admin/account-bank-cash-store', $controller_path . '\backend\BankCashController@store')->name('account-bank-cash-store');
Route::get('/admin/account-bank-cash-edit/{id}', $controller_path . '\backend\BankCashController@edit')->name('account-bank-cash-edit');
Route::match(['put', 'patch'],'/admin/account-back-cash-update/{id}', $controller_path . '\backend\BankCashController@update')->name('account-bank-cash-update');
Route::delete('/admin/account-bank-cash-destroy/{id}', $controller_path . '\backend\BankCashController@destroy')->name('account-bank-cash-destroy');
//expense
Route::get('/admin/account-expense-index', $controller_path . '\backend\ExpenseController@index')->name('account-expense-index');
Route::get('/admin/account-expense-create', $controller_path . '\backend\ExpenseController@create')->name('account-expense-create');
Route::post('/admin/account-expense-store', $controller_path . '\backend\ExpenseController@store')->name('account-expense-store');
Route::get('/admin/account-expense-edit/{id}', $controller_path . '\backend\ExpenseController@edit')->name('account-expense-edit');
Route::match(['put', 'patch'],'/admin/account-expense-update/{id}', $controller_path . '\backend\ExpenseController@update')->name('account-expense-update');
Route::delete('/admin/account-expense-destroy/{id}', $controller_path . '\backend\ExpenseController@destroy')->name('account-expense-destroy');
//ledgerType
Route::get('/admin/ledger-ledgerType-index', $controller_path . '\backend\ledger\LedgerTypeController@index')->name('ledger-ledgerType-index');
Route::get('/admin/ledger-ledgerType-create', $controller_path . '\backend\ledger\LedgerTypeController@create')->name('ledger-ledgerType-create');
Route::post('/admin/ledger-ledgerType-store', $controller_path . '\backend\ledger\LedgerTypeController@store')->name('ledger-ledgerType-store');
Route::get('/admin/ledger-ledgerType-edit/{id}', $controller_path . '\backend\ledger\LedgerTypeController@edit')->name('ledger-ledgerType-edit');
Route::match(['put', 'patch'],'/admin/ledger-ledgerType-update/{id}', $controller_path . '\backend\ledger\LedgerTypeController@update')->name('ledger-ledgerType-update');
Route::delete('/admin/ledger-ledgerType-destroy/{id}', $controller_path . '\backend\ledger\LedgerTypeController@destroy')->name('ledger-ledgerType-destroy');
//ledgerGroup
Route::get('/admin/ledger-ledgerGroup-index', $controller_path . '\backend\ledger\LedgerGroupController@index')->name('ledger-ledgerGroup-index');
Route::get('/admin/ledger-ledgerGroup-create', $controller_path . '\backend\ledger\LedgerGroupController@create')->name('ledger-ledgerGroup-create');
Route::post('/admin/ledger-ledgerGroup-store', $controller_path . '\backend\ledger\LedgerGroupController@store')->name('ledger-ledgerGroup-store');
Route::get('/admin/ledger-ledgerGroup-edit/{id}', $controller_path . '\backend\ledger\LedgerGroupController@edit')->name('ledger-ledgerGroup-edit');
Route::match(['put', 'patch'],'/admin/ledger-ledgerGroup-update/{id}', $controller_path . '\backend\ledger\LedgerGroupController@update')->name('ledger-ledgerGroup-update');
Route::delete('/admin/ledger-ledgerGroup-destroy/{id}', $controller_path . '\backend\ledger\LedgerGroupController@destroy')->name('ledger-ledgerGroup-destroy');
//ledgerName
Route::get('/admin/ledger-ledgerName-index', $controller_path . '\backend\ledger\LedgerNameController@index')->name('ledger-ledgerName-index');
Route::get('/admin/ledger-ledgerName-create', $controller_path . '\backend\ledger\LedgerNameController@create')->name('ledger-ledgerName-create');
Route::post('/admin/ledger-ledgerName-store', $controller_path . '\backend\ledger\LedgerNameController@store')->name('ledger-ledgerName-store');
Route::get('/admin/ledger-ledgerName-edit/{id}', $controller_path . '\backend\ledger\LedgerNameController@edit')->name('ledger-ledgerName-edit');
Route::match(['put', 'patch'],'/admin/ledger-ledgerName-update/{id}', $controller_path . '\backend\ledger\LedgerNameController@update')->name('ledger-ledgerName-update');
Route::delete('/admin/ledger-ledgerName-destroy/{id}', $controller_path . '\backend\ledger\LedgerNameController@destroy')->name('ledger-ledgerName-destroy');
//expenseHead
Route::get('/admin/account-expense-head-list', $controller_path . '\backend\ExpenseHeadController@index')->name('account-expense-head-list');
Route::get('/admin/account-expense-head-create', $controller_path . '\backend\ExpenseHeadController@create')->name('account-expense-head-create');
Route::post('/admin/account-expense-head-store', $controller_path . '\backend\ExpenseHeadController@store')->name('account-expense-head-store');
Route::get('/admin/account-expense-head-edit/{id}', $controller_path . '\backend\ExpenseHeadController@edit')->name('account-expense-head-edit');
Route::match(['put', 'patch'],'/admin/account-expense-head-update/{id}', $controller_path . '\backend\ExpenseHeadController@update')->name('account-expense-head-update');
Route::delete('/admin/account-expense-head-destroy/{id}', $controller_path . '\backend\ExpenseHeadController@destroy')->name('account-expense-head-destroy');
//incomeHead
Route::get('/admin/account-income-head-list', $controller_path . '\backend\IncomeHeadController@index')->name('account-income-head-list');
Route::get('/admin/account-income-head-create', $controller_path . '\backend\IncomeHeadController@create')->name('account-income-head-create');
Route::post('/admin/account-income-head-store', $controller_path . '\backend\IncomeHeadController@store')->name('account-income-head-store');
Route::get('/admin/account-income-head-edit/{id}', $controller_path . '\backend\IncomeHeadController@edit')->name('account-income-head-edit');
Route::match(['put', 'patch'],'/admin/account-income-head-update/{id}', $controller_path . '\backend\IncomeHeadController@update')->name('account-income-head-update');
Route::delete('/admin/account-income-head-destroy/{id}', $controller_path . '\backend\IncomeHeadController@destroy')->name('account-income-head-destroy');
//salary
Route::get('/admin/account/salary-list', $controller_path . '\backend\SalaryController@index')->name('account-salary-list');
Route::get('/admin/account/salary-create', $controller_path . '\backend\SalaryController@create')->name('account-salary-create');
Route::post('/admin/account/salary-store', $controller_path . '\backend\SalaryController@store')->name('account-salary-store');
// Route::get('/admin/account/salary-edit/{id}', $controller_path . '\backend\SalaryController@edit')->name('account-salary-edit');
// Route::match(['put', 'patch'],'/admin/account/salary-update/{id}', $controller_path . '\backend\SalaryController@update')->name('account-salary-update');
Route::delete('/admin/account/salary-destroy/{id}', $controller_path . '\backend\SalaryController@destroy')->name('account-salary-destroy');
Route::get('/admin/account/salary-create-ename', $controller_path . '\backend\SalaryController@ename')->name('account-salary-create-ename');
Route::get('/admin/account/salary-create-pjname', $controller_path . '\backend\SalaryController@pjname')->name('account-salary-create-pjname');
//stationary
Route::get('/admin/account/stationary-list', $controller_path . '\backend\StationaryController@index')->name('account-stationary-list');
Route::get('/admin/account/stationary-create', $controller_path . '\backend\StationaryController@create')->name('account-stationary-create');
Route::post('/admin/account/stationary-store', $controller_path . '\backend\StationaryController@store')->name('account-stationary-store');
Route::delete('/admin/account/stationary-destroy/{id}', $controller_path . '\backend\StationaryController@destroy')->name('account-stationary-destroy');
Route::get('/admin/account/stationary-create-ename', $controller_path . '\backend\StationaryController@ename')->name('account-stationary-create-ename');
Route::get('/admin/account/stationary-create-pjname', $controller_path . '\backend\StationaryController@pjname')->name('account-stationary-create-pjname');
//office_expenses
Route::get('/admin/account/office_expenses-list', $controller_path . '\backend\OfficeExpensesController@index')->name('account-office_expenses-list');
Route::get('/admin/account/office_expenses-create', $controller_path . '\backend\OfficeExpensesController@create')->name('account-office_expenses-create');
Route::post('/admin/account/office_expenses-store', $controller_path . '\backend\OfficeExpensesController@store')->name('account-office_expenses-store');
Route::delete('/admin/account/office_expenses-destroy/{id}', $controller_path . '\backend\OfficeExpensesController@destroy')->name('account-office_expenses-destroy');
Route::get('/admin/account/office_expenses-create-ename', $controller_path . '\backend\OfficeExpensesController@ename')->name('account-office_expenses-create-ename');
Route::get('/admin/account/office_expenses-create-pjname', $controller_path . '\backend\OfficeExpensesController@pjname')->name('account-office_expenses-create-pjname');
//entertainment
Route::get('/admin/account/entertainment-list', $controller_path . '\backend\EntertainmentController@index')->name('account-entertainment-list');
Route::get('/admin/account/entertainment-create', $controller_path . '\backend\EntertainmentController@create')->name('account-entertainment-create');
Route::post('/admin/account/entertainment-store', $controller_path . '\backend\EntertainmentController@store')->name('account-entertainment-store');
Route::delete('/admin/account/entertainment-destroy/{id}', $controller_path . '\backend\EntertainmentController@destroy')->name('account-entertainment-destroy');
Route::get('/admin/account/entertainment-create-ename', $controller_path . '\backend\EntertainmentController@ename')->name('account-entertainment-create-ename');
Route::get('/admin/account/entertainment-create-pjname', $controller_path . '\backend\EntertainmentController@pjname')->name('account-entertainment-create-pjname');
//conveyance
Route::get('/admin/account/conveyance-list', $controller_path . '\backend\ConveyanceController@index')->name('account-conveyance-list');
Route::get('/admin/account/conveyance-create', $controller_path . '\backend\ConveyanceController@create')->name('account-conveyance-create');
Route::post('/admin/account/conveyance-store', $controller_path . '\backend\ConveyanceController@store')->name('account-conveyance-store');
Route::delete('/admin/account/conveyance-destroy/{id}', $controller_path . '\backend\ConveyanceController@destroy')->name('account-conveyance-destroy');
Route::get('/admin/account/conveyance-create-ename', $controller_path . '\backend\ConveyanceController@ename')->name('account-conveyance-create-ename');
Route::get('/admin/account/conveyance-create-pjname', $controller_path . '\backend\ConveyanceController@pjname')->name('account-conveyance-create-pjname');
//profit/deposit(cr)
Route::get('/admin/account/deposit-list', $controller_path . '\backend\ProfitController@index')->name('account-profit-list');
Route::get('/admin/account/deposit-create', $controller_path . '\backend\ProfitController@create')->name('account-profit-create');
Route::post('/admin/account/deposit-store', $controller_path . '\backend\ProfitController@store')->name('account-profit-store');
Route::delete('/admin/account/deposit-destroy/{id}', $controller_path . '\backend\ProfitController@destroy')->name('account-profit-destroy');
Route::get('/admin/account/deposit-create-cname', $controller_path . '\backend\ProfitController@cname')->name('account-profit-create-cname');
//reporting
Route::get('/admin/reporting-search', $controller_path . '\backend\ReportController@search')->name('reporting-search');
Route::post('/admin/reporting/search-details', $controller_path . '\backend\ReportController@details')->name('reporting-searchValue');
//ledger
Route::get('/admin/account/ledger-search', $controller_path . '\backend\LedgerController@search')->name('account-ledger-search');
Route::post('/admin/ledger/ledger-details', $controller_path . '\backend\LedgerController@search')->name('account-ledger-details');
Route::get('/admin/account/ledger-search/project-name', $controller_path . '\backend\LedgerController@project_name')->name('account-ledger-project_name');
//cashbook
Route::get('/admin/account/cashbook', $controller_path . '\backend\CashBookController@search')->name('account-cashbook');
Route::post('/admin/cashbook/cashbook', $controller_path . '\backend\CashBookController@search')->name('account-cashbook-details');
// Route::get('/pages/account/costing', [CostingController::class, 'index'])->name('pages-account-costing');
// Route::resource('/pages/account/costing', [CostingController::class])->name('pages-account-costing');
/*backend controller end*/

// Main Page Route
// Route::get('/dashboard', $controller_path . '\dashboard\Analytics@index')->name('dashboard-analytics');
});
$controller_path = 'App\Http\Controllers';
// layout
Route::get('/layouts/without-menu', $controller_path . '\layouts\WithoutMenu@index')->name('layouts-without-menu');
Route::get('/layouts/without-navbar', $controller_path . '\layouts\WithoutNavbar@index')->name('layouts-without-navbar');
Route::get('/layouts/fluid', $controller_path . '\layouts\Fluid@index')->name('layouts-fluid');
Route::get('/layouts/container', $controller_path . '\layouts\Container@index')->name('layouts-container');
Route::get('/layouts/blank', $controller_path . '\layouts\Blank@index')->name('layouts-blank');

// pages
Route::get('/pages/account-settings-account', $controller_path . '\pages\AccountSettingsAccount@index')->name('pages-account-settings-account');
Route::get('/pages/account-settings-notifications', $controller_path . '\pages\AccountSettingsNotifications@index')->name('pages-account-settings-notifications');
// Route::get('/pages/account-settings-connections', $controller_path . '\pages\AccountSettingsConnections@index')->name('pages-account-settings-connections');
Route::get('/pages/misc-error', $controller_path . '\pages\MiscError@index')->name('pages-misc-error');
Route::get('/pages/misc-under-maintenance', $controller_path . '\pages\MiscUnderMaintenance@index')->name('pages-misc-under-maintenance');

// authentication
Route::get('/auth/login-basic', $controller_path . '\authentications\LoginBasic@index')->name('auth-login-basic');
Route::get('/auth/register-basic', $controller_path . '\authentications\RegisterBasic@index')->name('auth-register-basic');
Route::get('/auth/forgot-password-basic', $controller_path . '\authentications\ForgotPasswordBasic@index')->name('auth-reset-password-basic');

// cards
Route::get('/cards/basic', $controller_path . '\cards\CardBasic@index')->name('cards-basic');

// User Interface
Route::get('/ui/accordion', $controller_path . '\user_interface\Accordion@index')->name('ui-accordion');
Route::get('/ui/alerts', $controller_path . '\user_interface\Alerts@index')->name('ui-alerts');
Route::get('/ui/badges', $controller_path . '\user_interface\Badges@index')->name('ui-badges');
Route::get('/ui/buttons', $controller_path . '\user_interface\Buttons@index')->name('ui-buttons');
Route::get('/ui/carousel', $controller_path . '\user_interface\Carousel@index')->name('ui-carousel');
Route::get('/ui/collapse', $controller_path . '\user_interface\Collapse@index')->name('ui-collapse');
Route::get('/ui/dropdowns', $controller_path . '\user_interface\Dropdowns@index')->name('ui-dropdowns');
Route::get('/ui/footer', $controller_path . '\user_interface\Footer@index')->name('ui-footer');
Route::get('/ui/list-groups', $controller_path . '\user_interface\ListGroups@index')->name('ui-list-groups');
Route::get('/ui/modals', $controller_path . '\user_interface\Modals@index')->name('ui-modals');
Route::get('/ui/navbar', $controller_path . '\user_interface\Navbar@index')->name('ui-navbar');
Route::get('/ui/offcanvas', $controller_path . '\user_interface\Offcanvas@index')->name('ui-offcanvas');
Route::get('/ui/pagination-breadcrumbs', $controller_path . '\user_interface\PaginationBreadcrumbs@index')->name('ui-pagination-breadcrumbs');
Route::get('/ui/progress', $controller_path . '\user_interface\Progress@index')->name('ui-progress');
Route::get('/ui/spinners', $controller_path . '\user_interface\Spinners@index')->name('ui-spinners');
Route::get('/ui/tabs-pills', $controller_path . '\user_interface\TabsPills@index')->name('ui-tabs-pills');
Route::get('/ui/toasts', $controller_path . '\user_interface\Toasts@index')->name('ui-toasts');
Route::get('/ui/tooltips-popovers', $controller_path . '\user_interface\TooltipsPopovers@index')->name('ui-tooltips-popovers');
Route::get('/ui/typography', $controller_path . '\user_interface\Typography@index')->name('ui-typography');

// extended ui
Route::get('/extended/ui-perfect-scrollbar', $controller_path . '\extended_ui\PerfectScrollbar@index')->name('extended-ui-perfect-scrollbar');
Route::get('/extended/ui-text-divider', $controller_path . '\extended_ui\TextDivider@index')->name('extended-ui-text-divider');

// icons
Route::get('/icons/boxicons', $controller_path . '\icons\Boxicons@index')->name('icons-boxicons');

// form elements
Route::get('/forms/basic-inputs', $controller_path . '\form_elements\BasicInput@index')->name('forms-basic-inputs');
Route::get('/forms/input-groups', $controller_path . '\form_elements\InputGroups@index')->name('forms-input-groups');

// form layouts
Route::get('/form/layouts-vertical', $controller_path . '\form_layouts\VerticalForm@index')->name('form-layouts-vertical');
Route::get('/form/layouts-horizontal', $controller_path . '\form_layouts\HorizontalForm@index')->name('form-layouts-horizontal');

// tables
Route::get('/tables/basic', $controller_path . '\tables\Basic@index')->name('tables-basic');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
