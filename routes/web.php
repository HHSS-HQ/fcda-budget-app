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
use App\Http\Controllers\UnitController;
use App\Http\Controllers\BudgetController;
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

$controller_path = 'App\Http\Controllers';

// Main Page Route
Route::get('/dashboard', $controller_path . '\dashboard\Analytics@index')->name('dashboard-analytics');
// Route::get('/', $controller_path . '\authentications\LoginBasic@index')->name('auth-login-basic');
// Route::get('/', [LoginController::class, 'show'])->name('login.show');

// Route::get('/', function () {
//     return view('login');
// })->middleware('auth');

// Route::get('/login', 'LoginController@show');

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
// Route::post('/auth/register-basic', $controller_path . '\CustomAuthController@customRegistration')->name('register.custom');
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
Route::get('/add-project', $controller_path . '\pages\Projects@AddProject')->name('projects');
Route::post('/add-project', $controller_path . '\pages\Projects@ProjectForm')->name('project.store');

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

Route::get('/users', [RegisterController::class, 'allUsers'])->name('users.show'); 
Route::get('/add-user', [RegisterController::class, 'add_user'])->name('register.show'); 
// Route::get('/users', [RoleController::class, 'AllRoles2'])->name('role.store');
Route::any('/update-user/{id}', [RegisterController::class, 'updateUser'])->name('user.update');

Route::get('/add-department', [DepartmentController::class, 'show'])->name('department.show'); 
Route::post('/add-department', [DepartmentController::class, 'store'])->name('department.store');
Route::get('/departments', [DepartmentController::class, 'AllDepartments'])->name('departments.show');  
Route::any('/update-department/{id}', [DepartmentController::class, 'updateDepartment'])->name('department.update');

Route::get('/add-unit', [UnitController::class, 'show'])->name('unit.show'); 
Route::post('/add-unit', [UnitController::class, 'store'])->name('unit.store'); 
Route::get('/units', [UnitController::class, 'AllUnits'])->name('units.show'); 
Route::any('/update-unit/{id}', [UnitController::class, 'updateUnit'])->name('unit.update');


Route::get('/add-budget', [BudgetController::class, 'show'])->name('budget.show'); 
Route::post('/add-budget', [BudgetController::class, 'store'])->name('budget.store'); 
Route::get('/budgets', [BudgetController::class, 'AllBudgets'])->name('budgets.show'); 
Route::any('/update-budget/{id}', [BudgetController::class, 'updateBudget'])->name('budget.update');

// Route::get('/add-user', function () {
//     // $roles = \App\Models\Role::all();
//     $roles = DB::table('role')->pluck('id','role_name');
//     return view('content.pages.users.add-user')->with(['roles' => $roles]);
// });
// Route::post('/add-user', [RegisterController::class, 'store'])->name('r.store'); 
// Route::group(['namespace' => 'App\Http\Controllers'], function()
// {   
//     /**
//      * Home Routes
//      */
//     Route::get('/', 'HomeController@index')->name('home.index');

//     Route::group(['middleware' => ['guest']], function() {
//         /**
//          * Register Routes
//          */
//         Route::get('/register', 'RegisterController@show')->name('register.show');
//         Route::post('/register', 'RegisterController@register')->name('register.perform');

//         /**
//          * Login Routes
//          */
//         Route::get('/login', 'LoginController@show')->name('login.show');
//         Route::post('/login', 'LoginController@login')->name('login.perform');

//     });

//     Route::group(['middleware' => ['auth']], function() {
//         /**
//          * Logout Routes
//          */
//         Route::get('/logout', 'LogoutController@perform')->name('logout.perform');
//     });
// });