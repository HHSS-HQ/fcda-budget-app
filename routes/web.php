<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\pages\Projects;
use App\Http\Controllers\LoginController;

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\HeadController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\SubheadController;
use App\Http\Controllers\ProjectTypeController;
use App\Http\Controllers\ECFController;
use App\Http\Controllers\DropdownController;
use App\Http\Controllers\ContractorController;
use App\Http\Controllers\FundprojectController;
use App\Http\Controllers\ProjectReportController;
use App\Http\Controllers\AccountingYearController;
use App\Http\Controllers\PayeeController;
use App\Http\Controllers\authentications\ForgotPasswordController;
use App\Http\Controllers\authentications\ResetPasswordController;
use App\Http\Controllers\ExcelImportController;

use App\Notifications\CustomResetPasswordNotification;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\DataTablesController;
use App\Http\Controllers\SubheadAllocationController;


// use App\Http\Controllers\ContractorController;
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


Route::get('/password/reset', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('password.request');
Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/password/reset/{token}', [ForgotPasswordController::class,'showResetPasswordForm'])->name('password.reset');
Route::post('/password/reset', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('action.password.reset');


// Route::post('/forgot-password', function (Request $request) {
//   $request->validate(['email' => 'required|email']);

//   $status = Password::sendResetLink(
//       $request->only('email')
//   );

//   return $status === Password::RESET_LINK_SENT
//               ? back()->with(['status' => __($status)])
//               : back()->withErrors(['email' => __($status)]);
// })->middleware('guest')->name('password.email');

$controller_path = 'App\Http\Controllers';


// Route::post('/forgot-password', function (Request $request) {
//   $request->validate(['email' => 'required|email']);

//   $status = Password::sendResetLink(
//       $request->only('email'),
//       new CustomResetPasswordNotification() // Use the custom notification
//   );

//   return $status === Password::RESET_LINK_SENT
//       ? back()->with(['status' => __($status)])
//       : back()->withErrors(['email' => __($status)]);
// })->middleware('guest')->name('password.email');

// Main Page Route
Route::get('/dashboard', $controller_path . '\dashboard\Analytics@index')->name('dashboard-analytics');
// Route::get('/', $controller_path . '\authentications\LoginBasic@index')->name('auth-login-basic');
// Route::get('/', [LoginController::class, 'show'])->name('login.show');

// Route::get('/', function () {
//     return view('login');
// })->middleware('auth');

// Route::get('/login', 'LoginController@show');
// Route::get('/login', [HomeController::class, 'index'])->name('login.show');

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::post('/', [LoginController::class, 'login'])->name('login.perform');


// layout
Route::get('/layouts/without-menu', $controller_path . '\layouts\WithoutMenu@index')->name('layouts-without-menu');
Route::get('/layouts/without-navbar', $controller_path . '\layouts\WithoutNavbar@index')->name('layouts-without-navbar');
Route::get('/layouts/fluid', $controller_path . '\layouts\Fluid@index')->name('layouts-fluid');
Route::get('/layouts/container', $controller_path . '\layouts\Container@index')->name('layouts-container');
Route::get('/layouts/blank', $controller_path . '\layouts\Blank@index')->name('layouts-blank');

// pages
Route::get('/pages/account-settings-account', $controller_path . '\pages\AccountSettingsAccount@index')->name('pages-account-settings-account');
Route::get('/pages/account-settings-notifications', $controller_path . '\pages\AccountSettingsNotifications@index')->name('pages-account-settings-notifications');
Route::get('/pages/account-settings-connections', $controller_path . '\pages\AccountSettingsConnections@index')->name('pages-account-settings-connections');
Route::get('/pages/misc-error', $controller_path . '\pages\MiscError@index')->name('pages-misc-error');
Route::get('/pages/misc-under-maintenance', $controller_path . '\pages\MiscUnderMaintenance@index')->name('pages-misc-under-maintenance');

// authentication
Route::post('/auth/register-basic', $controller_path . '\CustomAuthController@customRegistration')->name('register.custom');
Route::get('/auth/forgot-password-basic', $controller_path . '\authentications\ForgotPasswordBasic@index')->name('auth-reset-password-basic');
// Route::post('/auth/register-basic', [CustomAuthController::class, 'customRegistration'])->name('register.custom');

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
Route::get('/projects', $controller_path . '\pages\Projects@AllProjects')->name('projects2');
Route::get('/releases', $controller_path . '\pages\Projects@AllReleases')->name('releases');
Route::get('/add-project', $controller_path . '\pages\Projects@AddProject')->name('projects');
Route::post('/add-project', $controller_path . '\pages\Projects@ProjectForm')->name('project.store');
Route::get('fund-project', [Projects::class, 'fundProjectForm']);
Route::post('fund-project', [FundprojectController::class, 'fundProject'])->name('fund-project.store');
Route::get('project-report', [Projects::class, 'reportProjectForm']);
Route::post('project-report', [ProjectReportController::class, 'reportProject'])->name('project.report');
// Route::post('/create-project', [Projects::class, 'ProjectForm'])->name('project.store');

// Route::get('dashboard', [CustomAuthController::class, 'dashboard']);
// Route::get('login', [CustomAuthController::class, 'index'])->name('login');
// Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom');
// Route::get('registration', [CustomAuthController::class, 'registration'])->name('register-user');
// Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom');
// Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');

// Route::get('/view_project/{id}', 'Projects@display');
Route::get('/view_project2/{project_id}', $controller_path . '\pages\Projects@display')->name('display');
Route::get('/view_project/{project_id}', $controller_path . '\pages\Projects@one_project')->name('one_project');
Route::get('/edit-project/{project_id}', $controller_path . '\pages\Projects@EditProject')->name('edit-project');
Route::any('/update-project/{id}', [Projects::class, 'updateProject'])->name('project.update');
// Route::get('/view_project/{project_id}', ['as' => 'registration', 'uses' => 'Projects@one_project']);

Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom');

Route::get('/login', [LoginController::class, 'show'])->name('login.show');
Route::post('/login', [LoginController::class, 'login'])->name('login.perform');
Route::post('/register', [RegisterController::class, 'register'])->name('register.perform');
Route::get('/register', [RegisterController::class, 'show'])->name('register.show');
Route::get('/logout', [LogoutController::class, 'perform'])->name('logout.perform');

Route::get('/add-role', [RoleController::class, 'show'])->name('role.show');
Route::post('/add-role', [RoleController::class, 'store'])->name('role.store');
Route::get('/roles', [RoleController::class, 'AllRoles'])->name('roles.show');

// Route::get('/users', [RegisterController::class, 'allUsers'])->name('users.show');
Route::get('/add-user', [RegisterController::class, 'add_user'])->name('user-register.show');
// Route::get('/users', [RoleController::class, 'AllRoles2'])->name('role.store');
Route::any('/update-user/{id}', [RegisterController::class, 'updateUser'])->name('user.update');

// Route::get('/budget-utilization', [DepartmentController::class, 'budget_utilization']);
Route::get('/budget-utilization', [DepartmentController::class, 'budget_utilization2']);
Route::get('/add-department', [DepartmentController::class, 'show'])->name('department.show');
Route::post('/add-department', [DepartmentController::class, 'store'])->name('department.store');
Route::get('/departments', [DepartmentController::class, 'AllDepartments'])->name('departments.show');
Route::get('/departments-budget', [DepartmentController::class, 'AllDepartmentsBudget'])->name('departments-budget.show');
Route::any('/update-department/{id}', [DepartmentController::class, 'updateDepartment'])->name('department.update');
Route::post('/add-department-budget', [DepartmentController::class, 'budget_store'])->name('department_budget.store');
Route::any('/update-department-budget/{id}', [DepartmentController::class, 'budget_update'])->name('department_budget.update');



Route::get('/add-head', [HeadController::class, 'show'])->name('head.show');
Route::post('/add-head', [HeadController::class, 'store'])->name('head.store');
Route::get('/heads', [HeadController::class, 'AllHeads'])->name('heads.show');
Route::any('/update-head/{id}', [HeadController::class, 'updateHeads'])->name('head.update');


Route::get('/add-budget', [BudgetController::class, 'show'])->name('budget.show');
Route::post('/add-budget', [BudgetController::class, 'store'])->name('budget.store');
Route::get('/budgets', [BudgetController::class, 'AllBudgets'])->name('budgets.show');
Route::any('/update-budget/{id}', [BudgetController::class, 'updateBudget'])->name('budget.update');
Route::post('update-budget-status', [BudgetController::class, 'setActiveBudget']);

Route::get('/upload-bulk-subheads', [SubheadController::class, 'upload_bulk_subheads'])->name('subhead.upload_bulk_subheads');
Route::get('/upload-subheads', [SubheadController::class, 'upload_ubheads'])->name('import.upload_subheads');
Route::post('/import-excel', [ExcelImportController::class, 'import'])->name('import.excel');

Route::get('/add-subhead', [SubheadController::class, 'show'])->name('subhead.show');
Route::post('/add-subhead', [SubheadController::class, 'store'])->name('subhead.store');
Route::get('/subheads', [SubheadController::class, 'AllSubheads'])->name('subheads.show');
Route::any('/update-subhead/{id}', [SubheadController::class, 'updateSubhead'])->name('subhead.update');
Route::get('/all-subhead-allocations', [SubheadAllocationController::class, 'AllSubheadAllocations']);
Route::get('/subhead-allocation', [SubheadAllocationController::class, 'SubheadAllocations']);

Route::get('/add-project-type', [ProjectTypeController::class, 'show'])->name('project-type.show');
Route::post('/add-project-type', [ProjectTypeController::class, 'store'])->name('project-type.store');
Route::get('/project-types', [ProjectTypeController::class, 'AllProjectTypes'])->name('project-type.show');
Route::any('/update-project-type/{id}', [ProjectTypeController::class, 'updateProjectType'])->name('project-type.update');


Route::get('/add-ecf', [ECFController::class, 'index'])->name('ecf.show');
Route::post('fetch-subhead', [ECFController::class, 'fetchSubhead']);
Route::post('fetch-approved-provision', [ECFController::class, 'fetchApprovedProvision']);
Route::post('fetch-revised-provision', [ECFController::class, 'fetchRevisedProvision']);
Route::post('fetch-department-budget', [ECFController::class, 'fetchDepartmentBudget']);
Route::post('fetch-department-budget-id', [ECFController::class, 'fetchDepartmentBudgetID']);



Route::post('/add-ecf', [ECFController::class, 'store'])->name('ecf.store');
Route::get('/ecfs', [ECFController::class, 'AllECF'])->name('ecfs.show');
// Route::any('/update-project-type/{id}', [ProjectTypeController::class, 'updateProjectType'])->name('project-type.update');


// Route::get('/add-user', function () {

  // Route::get('dropdown', [DropdownController::class, 'index']);
Route::post('api/fetch-states', [DropdownController::class, 'fetchState']);
Route::post('api/fetch-cities', [DropdownController::class, 'fetchCity']);

Route::get('print-ecf', [ECFController::class, 'printECF']);
Route::get('print-project-report', [Projects::class, 'printProjectReport']);

Route::post('change-ecf-status', [ECFController::class, 'changeECFStatus']);
Route::post('add-contractor-modal', [ContractorController::class, 'addContractorModal'])->name('contractor.store');
Route::get('contractors', [ContractorController::class, 'getContractors']);

Route::get('accounting-year', [AccountingYearController::class, 'displayYear']);
Route::get('add-accounting-year', [AccountingYearController::class, 'addAccountingYearForm']);
Route::post('add-accounting-year', [AccountingYearController::class, 'storeAccountingYear'])->name('accounting-year.store');

Route::get('/add-payee', [PayeeController::class, 'showPayeeForm']);
Route::post('/add-payee', [PayeeController::class, 'addPayee'])->name('payee.store');
Route::get('/payees', [PayeeController::class, 'showPayees']);
Route::put('/payees', [PayeeController::class, 'showPayees'])->name('payee.update');

Route::get('/add-contractor', [ContractorController::class, 'addContractor']);
Route::get('/contractors', [ContractorController::class, 'showContractors']);
Route::get('/add-contractor', [ContractorController::class, 'showContractorForm']);
Route::post('/add-contractor', [ContractorController::class, 'addContractor'])->name('contractor.store');

Route::get('/percentage-budget-utilization', [ECFController::class, 'percentageUtilization']);
Route::get('/summary-budget-utilization', [ECFController::class, 'budgetGraph']);


// Route::get('/departments/export/excel', 'DepartmentController@exportExcel')->name('departments.export.excel');
// Route::get('/departments/export/pdf', 'DepartmentController@exportPDF')->name('departments.export.pdf');

Route::get('/departments/export/excel', [DepartmentController::class, 'exportExcel'])->name('departments.export.excel');
Route::get('/departments/export/pdf', [DepartmentController::class, 'exportPDF'])->name('departments.export.pdf');



Route::get('subheads', [DataTablesController::class, 'index']);
Route::get('subheads/list', [DataTablesController::class, 'getSubheads'])->name('subheads.list');
Route::get('all-subhead-allocation/list', [DataTablesController::class, 'getAllSubheadAllocations'])->name('all-subhead-allocation.list');
Route::get('subhead-allocation/list', [DataTablesController::class, 'getSubheadAllocations'])->name('subhead-allocation.list');


Route::get('users', [DataTablesController::class, 'index_users']);
Route::get('users/list', [DataTablesController::class, 'getUsers'])->name('users.list');


Route::post('/copy-subheads', 'App\Http\Controllers\SubheadAllocationController@copySubhead');