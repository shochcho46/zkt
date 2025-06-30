<?php

use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Route;
use Modules\Admin\Http\Controllers\AdminController;
use Modules\Admin\Http\Controllers\EmployeeController;

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



    Route::middleware(['auth:admin'])->group(function () {
        Route::prefix('admin/setting')->group(function () {
        Route::controller(SettingController::class)->group(function () {
            Route::get('create', 'create')->name('admin.settingCreate');
            Route::post('store', 'store')->name('admin.settingStore');
            Route::get('{setting}/edit', 'edit')->name('admin.settingEdit');
            Route::put('{setting}/update', 'update')->name('admin.settingUpdate');
        });
 
    });

    Route::prefix('admin/connection')->group(function () {
        Route::controller(SettingController::class)->group(function () {
            Route::get('check', 'connection')->name('admin.connection');
           
        });
 
    });

    Route::prefix('admin/employee')->group(function () {
        Route::controller(EmployeeController::class)->group(function () {
            Route::get('sync', 'syncUser')->name('admin.syncuser');
            Route::get('sync/attendence', 'syncAttendence')->name('admin.attendence');
            Route::get('list', 'indexEmployee')->name('admin.indexEmployee');
            Route::get('list/attendence', 'indexAttendence')->name('admin.indexAttendence');
            Route::get('{employee}/attendence/list', 'singelEmployeeAttendence')->name('admin.singelEmployeeAttendence');
            Route::get('export/attendence', 'exportAttendence')->name('admin.exportAttendence');
           
        });
 
    });
 
 });
