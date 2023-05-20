<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BackupController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IncomeRequestController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Route;
use Pusher\Pusher;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/






Route::group(['middleware' => 'adminauth'], function () {

    Route::post('/admin/pusher/auth', function () {
        $user =  Auth::guard('admin')->user();


        $socket_id = request()->input('socket_id');
        $channel_name = request()->input('channel_name');


            $guards = ['web', 'admin'];

            // Authenticate multiple guards using the auth.multiple middleware
      //      $this->middleware('auth.multiple:' . implode(',', $guards));


        $options = [];
        $auth = Pusher\presence_auth($channel_name, $socket_id, $user->id, $options);
        return response($auth);
    },['guards' => ['web', 'admin']]);



    Route::get('admin/logout', [AdminAuthController::class, 'logout'])->name('adminLogout');

    Route::get('admin/admin_dashboard', [DashboardController::class, 'adminDashboard'])->name('admin_dashboard');
    Route::get('admin/profile', [AdminController::class, 'profile'])->name('admin_profile');
    Route::post('admin/update_admin_profile', [AdminController::class, 'updateProfile'])->name('update_admin_profile');
    Route::get('admin/search_dasboard_status_date', [DashboardController::class, 'adminDashboardDate'])->name('search_dasboard_status_date');


    Route::get('admin/charts_data', [DashboardController::class, 'chartsData'])->name('charts_data');


    Route::get('admin/view_user/{id}', [UserController::class, 'viewUser'])->name('view_user');
    Route::get('admin/new_user/', [UserController::class, 'newUser'])->name('new_user');
    Route::post('admin/add_user/', [UserController::class, 'add'])->name('add_user');
    Route::get('admin/all_users/', [UserController::class, 'users'])->name('all_users');
    Route::post('admin/update_user', [UserController::class, 'update'])->name('update_user');
    Route::get('admin/search_users_from_to/', [UserController::class, 'searchUsersFromTo'])->name('search_users_from_to');








    Route::get('admin/new_admin/', [UserController::class, 'newAdmin'])->name('new_admin');
    Route::post('admin/add_admin/', [UserController::class, 'addAdmin'])->name('add_admin');
    Route::get('admin/delete_admin/{id}', [UserController::class, 'deleteAdmin'])->name('delete_admin');


    /* rrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrr */
    /*                                users reports                                       */
    /* rrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrr */
    Route::get('admin/user_reports', [UserController::class, 'index'])->name('user_reports');
    Route::get('admin/user_posts_report/{user_id}', [UserController::class, 'getPostsOfUser'])->name('user_posts_report');
    Route::get('admin/user_posts_report_search_from_to', [UserController::class, 'searchPostsOfUserFromToDate'])->name('user_posts_report_search_from_to');
    Route::get('admin/search_posts_date_of_user', [UserController::class, 'filtterPostsDateRelatedToUser'])->name('search_posts_date_of_user');
    Route::get('admin/get_user_postes_in_select_date/{user_id}/{date_value}/{source_id}', [UserController::class, 'getUserPostesInSelectDate'])->name('get_user_postes_in_select_date');
    Route::get('admin/get_user_postes_from_to/{user_id}/{start_date}/{end_date}/{source_id}', [UserController::class, 'getUserPostesInFromTo'])->name('get_user_postes_from_to');




    /* ppppppppppppppppppppppppppppppppp    posts       pppppppppppppppppppppppppppppppp */

    Route::get('admin/income_requests/index', [IncomeRequestController::class, 'index'])->name('income_requests');
    Route::get('admin/income_requests/show/{id}', [IncomeRequestController::class, 'show'])->name('admin_view_request');
    Route::get('admin/edit_post/{id}', [IncomeRequestController::class, 'editPostAdmin'])->name('admin_edit_post');

    Route::post('admin/update_post/', [IncomeRequestController::class, 'UpdateAdmin'])->name('admin_update_post');
    Route::get('admin/delete_post/{id}', [IncomeRequestController::class, 'deletePostAdmin'])->name('admin_delete_post');

    Route::get('admin/search_posts', [IncomeRequestController::class, 'search'])->name('search_posts_admin');

    Route::get('admin/get_posts_keyword/{keyword}', [IncomeRequestController::class, 'getPostsByKeyword'])->name('get_posts_keyword');
    Route::get('admin/filtter_posts_by_source', [IncomeRequestController::class, 'filtterPostsBySource'])->name('admin_filtter_posts_by_source');
    Route::get('admin/filtter_posts_by_source_dashboard/{source}', [IncomeRequestController::class, 'filtterPostsBySourceDasboard'])->name('filtter_posts_by_source_dashboard');

    Route::get('admin/search_posts_date/{value}', [IncomeRequestController::class, 'filtterPostsDate'])->name('search_posts_date_admin');
    Route::get('admin/search_posts_date_range/', [IncomeRequestController::class, 'searchPostsDateRange'])->name('search_posts_date_range_admin');

    /* aaaaaaaaaaaaaaaaaaaaaaaaaaaaaa   related to  aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa */










    Route::get('admin/backups', [BackupController::class, 'index'])->name('backups');
    Route::get('admin/download_backup', [BackupController::class, 'download'])->name('download_backup');
    Route::get('admin/delete_backup', [BackupController::class, 'delete'])->name('delete_backup');
    Route::get('admin/make_backup', [BackupController::class, 'makeBackup'])->name('make_backup');


    Route::get('admin/terminate_the_system', [BackupController::class, 'terminate_the_system'])->name('terminate_the_system');
});



