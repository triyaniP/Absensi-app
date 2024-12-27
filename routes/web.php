<?php

use App\Http\Controllers\attendanceController;
use App\Http\Controllers\coursesCotroller;
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
    return view('admin.dashboard');
});

Route::prefix('v1')->group(function (){
    Route::prefix('attendance')->controller(attendanceController::class)->group(function () {
        Route::get('/', 'index')->name('getAllDataCourse');
        Route::get('/create', 'createForm')->name('createFormAttendance');
        Route::get('/create', 'createData')->name('createDataAttendance');
        Route::get('/get/{id}', 'getDataById')->name('getDataByIdAttendance');
        Route::post('/update/{id}', 'updateData')->name('updateDataAttendance');
        Route::delete('/delete/{id}', 'deleteData')->name('deleteDataAttendance');
    });
    Route::prefix('courses')->controller(coursesCotroller::class)->group(function (){
        Route::get('/', 'index')->name('getAllDataCourse');
        Route::get('/create', 'createForm')->name('createFormCourse');
        Route::post('/create', 'createData')->name('createDataCourse');
        Route::get('/get/{id}', 'getDataById')->name('getDataByIdCourse');
        Route::post('/update/{id}', 'updateData')->name('updateDataCourse');
        Route::delete('/delete/{id}', 'deleteData')->name('deleteDataCourse');
    });


});
