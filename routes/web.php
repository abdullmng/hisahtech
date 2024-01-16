<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect(route('user.register'));
});

Route::group(['prefix'=> 'user'], function () {

    Route::group(['prefix' => 'auth'], function () {
        Route::get('/register', [UserController::class,'register'])->name('user.register');
        Route::post('/register', [UserController::class,'store'])->name('user.store');

        Route::get('/login', [UserController::class,'login'])->name('user.login');
        Route::post('/login', [UserController::class,'authenticate'])->name('user.authenticate');

        Route::get('/forgot', [UserController::class,'forgot'])->name('user.forgot');
        Route::post('/forgot', [UserController::class,'requestPasswordReset'])->name('password.email');
        Route::get('/password/reset', [UserController::class,'passwordReset'])->name('password.reset');
        Route::post('/password/reset', [UserController::class,'reset'])->name('password.reset');
    });


    Route::group(['middleware' => 'auth'], function () {
        Route::get('dashboard', [UserController::class,'dashboard'])->name('user.dashboard');


        Route::get('/devices', [UserController::class,'devices'])->name('user.devices');
        Route::post('/devices', [UserController::class,'storeDevice'])->name('user.store_device');

        Route::get('/requests', [UserController::class,'requests'])->name('user.requests');
        Route::post('/requests', [UserController::class,'storeRequest'])->name('user.storeRequest');
        Route::get('/requests/{request_id}', [UserController::class,'showRequest'])->name('user.show_request');


        Route::get('/invoices', [UserController::class,'invoices'])->name('user.invoices');
        Route::get('/invoices/{invoice_id}', [UserController::class,'showInvoice'])->name('user.showInvoice');
    });
});

Route::group(['prefix' => 'admin'], function () {

    Route::group(['prefix' => 'auth'], function () {
        Route::get('login', [AdminController::class, 'login'])->name('admin.login');
        Route::post('login', [AdminController::class,'authenticate'])->name('admin.authenticate');
    });

    Route::group(['middleware' => 'auth.admin'], function () {
        Route::get('/dashboard', [AdminController::class,'dashboard'])->name('admin.dashboard');
        Route::group(['prefix' => 'users'], function () {
            Route::get('/', [AdminController::class, 'users'])->name('admin.users');
            Route::get('/get/{user_id}', [AdminController::class,'getUser'])->name('admin.get_user');
            Route::post('/get/{user_id}', [AdminController::class,'updateUser'])->name('admin.update_user');
            Route::get('/add', [AdminController::class,'userForm'])->name('admin.user_form');
            Route::post('/add', [AdminController::class, 'createUser'])->name('admin.create_user');
            Route::get('/delete/{user_id}', [AdminController::class,'deleteUser'])->name('admin.delete_user');
        });

        Route::group(['prefix' => 'admins'], function () {
            Route::get('/', [AdminController::class,'admins'])->name('admin.admins');
            Route::get('/add', [AdminController::class,'addAdmin'])->name('admin.add_admin');
            Route::post('/add', [AdminController::class,'createAdmin'])->name('admin.create_admin');
            Route::get('/get/{admin_id}', [AdminController::class, 'getAdmin'])->name('admin.get_admin');
            Route::post('/get/{admin_id}', [AdminController::class, 'updateAdmin'])->name('admin.update_admin');
            Route::get('/delete/{admin_id}', [AdminController::class, 'deleteAdmin'])->name('admin.delete_admin');
        });

        Route::group(['prefix'=> 'service'], function () {
            Route::get('requests', [AdminController::class,'requests'])->name('admin.requests');
            Route::get('requests/{id}', [AdminController::class,'getRequest'])->name('admin.get_request');
            Route::post('/request/status/update', [AdminController::class,'updateRequestStatus'])->name('admin.update_request_status');
            Route::post('/invoice/generate', [AdminController::class, 'generateServiceInvoice'])->name('admin.generate_service_invoice');
        });

        Route::group(['prefix' => 'devices'], function () {
            Route::get('/', [AdminController::class,'devices'])->name('admin.devices');
            Route::get('/add', [AdminController::class, 'addDevice'])->name('admin.add_device');
            Route::post('/add', [AdminController::class,'createDevice'])->name('admin.create_device');
            Route::get('/get/{id}', [AdminController::class,'getDevice'])->name('admin.get_device');
            Route::post('/get/{id}', [AdminController::class,'updateDevice'])->name('admin.update_device');
            Route::get('/delete/{id}', [AdminController::class,'deleteDevice'])->name('admin.delete_device');
        });

        Route::group(['prefix' => 'settings'], function () {
            Route::get('/', [AdminController::class,'settings'])->name('admin.settings');
            Route::post('/', [AdminController::class,'SaveSettings'])->name('admin.save_settings');
        });

        Route::get('logout', [AdminController::class,'logout'])->name('admin.logout');
    });



});
