
<?php

use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Route;

use Modules\Admin\Http\Controllers\AdminController;
use Modules\Admin\Http\Controllers\EmployeeController;
use Modules\Admin\Http\Controllers\LeaveTypeController;
 use Modules\Admin\Http\Controllers\LeaveApplyController;
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
            Route::get('create', 'create')->name('admin.employee.create');
            Route::post('store', 'store')->name('admin.employee.store');
            Route::get('{employee}/edit', 'edit')->name('admin.employee.edit');
            Route::put('{employee}/update', 'updateEmployee')->name('admin.employee.update');
            Route::delete('{employee}/destroy', 'destroy')->name('admin.employee.destroy');
        });

    });

    Route::prefix('admin/leave-type')->group(function () {
        Route::controller(LeaveTypeController::class)->group(function () {
            Route::get('list', 'index')->name('admin.leaveType.index');
            Route::get('create', 'create')->name('admin.leaveType.create');
            Route::post('store', 'store')->name('admin.leaveType.store');
            Route::get('{leave_type}/edit', 'edit')->name('admin.leaveType.edit');
            Route::put('{leave_type}/update', 'update')->name('admin.leaveType.update');
            Route::delete('{leave_type}/delete', 'destroy')->name('admin.leaveType.destroy');
        });
    });



Route::prefix('admin/leave-apply')->group(function () {
    Route::controller(LeaveApplyController::class)->group(function () {
        Route::get('list', 'index')->name('admin.leaveApply.index');
        Route::get('create', 'create')->name('admin.leaveApply.create');
        Route::post('store', 'store')->name('admin.leaveApply.store');
        Route::get('{leave_apply}/edit', 'edit')->name('admin.leaveApply.edit');
        Route::put('{leave_apply}/update', 'update')->name('admin.leaveApply.update');
        Route::delete('{leave_apply}/delete', 'destroy')->name('admin.leaveApply.destroy');
        Route::post('{id}/change-status', 'changeStatus')->name('admin.leaveApply.changeStatus');
    });
});

});
