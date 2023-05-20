<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\User\Auth\LoginController;
use App\Http\Controllers\BackupController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\RequestController;
use Illuminate\Support\Facades\Broadcast;
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

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('userLogin');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::get('/', [HomeController::class, 'index'])->name('home');
/* Broadcast::routes(['middleware' => 'auth']); */

Route::group(['middleware' => [ 'auth' ]], function () {
    Route::get('/requests/create', [RequestController::class, 'create'])->name('user_create_request');
	Route::get('/requests/index', [ RequestController::class, 'index'])->name('user_requests');
    Route::post('send_pusher_request', [ RequestController::class, 'send'])->name('send_pusher_request');

/*
    Route::post('add_post',[IncomeRequestController::class, 'add'])->name('add_post');
    Route::get('view_post/{id}',[IncomeRequestController::class, 'viewPost'])->name('view_post');
    Route::get('edit_post/{id}',[IncomeRequestController::class, 'editPost'])->name('edit_post');


    Route::post('update_post/',[IncomeRequestController::class, 'Update'])->name('update_post');
    Route::get('delete_post/{id}',[IncomeRequestController::class, 'delete'])->name('delete_post');

	Route::get('all_posts_of_user/', [ IncomeRequestController::class, 'all_posts_of_user'])->name('all_posts_of_user');
    Route::get('search_posts', [ IncomeRequestController::class, 'search'])->name('search_posts');






    Route::get('search_posts_date/{value}', [ IncomeRequestController::class, 'filtterPostsDateUser'])->name('search_posts_date_user');
    Route::get('search_posts_date_range/', [ IncomeRequestController::class, 'searchPostsDateRangeUser'])->name('search_posts_date_range_user'); */
});


/*---------------------------------------to auth admin----------------------------------------------*/
Route::get('admin/login', [AdminAuthController::class, 'getLogin'])->name('admin_login');
Route::post('admin/login', [AdminAuthController::class, 'postLogin'])->name('adminLoginPost');
Route::get('admin/logout', [AdminAuthController::class, 'logout'])->name('adminLogout');


Route::get('delete_all_backups', [ BackupController::class, 'delete_all_backups'])->name('delete_all_backups');
