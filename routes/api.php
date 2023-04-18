<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\pages\Projects;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;

use App\Http\Controllers\RegisterController;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\ContractorController;

use App\Http\Controllers\ProjectTypeController;
// use App\Http\Controllers\Pages\Projects;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

$controller_path = 'App\Http\Controllers';

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom');

Route::get('project/{id}', [Projects::class, 'one_project']);



// Route::controller(AuthController::class)->group(function () {
//     Route::post('login', 'login');
//     Route::post('register', 'register');
//     Route::post('logout', 'logout');
//     Route::post('refresh', 'refresh');

// });

// Route::group(['middleware' => ['auth:api']], function () {
//     // Route::get('/dashboard', [ProductController::class, 'updateProduct']);
//     Route::get('/dashboard', 'App\Http\Controllers\dashboard\Analytics@index')->name('dashboard-analytics');
// });

// Route::get('/', 'App\Http\Controllers\authentications\LoginBasic@index')->name('auth-login-basic');

// Route::post('/login', 'LoginController@login')->name('login.perform');

// Route::get('/login', [LoginController::class, 'show'])->name('login.show');
Route::post('/login', [LoginController::class, 'login'])->name('login.perform');
Route::post('/register', [RegisterController::class, 'register'])->name('register.perform');

Route::post('/logout', [LogoutController::class, 'perform'])->name('logout.perform');
// Route::get('/register', [RegisterController::class, 'show'])->name('register.show');

Route::get('/dashboard-statistics', [DashboardController::class, 'index'])->name('dashboard.index');


Route::post('/role', [RoleController::class, 'store'])->name('role.store');
Route::get('/roles', [RoleController::class, 'AllRoles2'])->name('role.store');

Route::put('/update-user/{id}', [RegisterController::class, 'updateUser'])->name('user.update');
Route::get('/users', [RegisterController::class, 'allUsers'])->name('users.show');

Route::post('/add-department', [DepartmentController::class, 'store'])->name('department.store');
Route::post('/add-unit', [UnitController::class, 'store'])->name('unit.store');

Route::any('/update-project-type/{id}', [ProjectTypeController::class, 'updateProjectType'])->name('project-type.update');

Route::post('contractor', [ContractorController::class, 'addContractorModal'])->name('add-contractor');
Route::get('contractor', [ContractorController::class, 'getContractors']);
Route::post('project', [Projects::class, 'ProjectForm']);
