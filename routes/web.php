<?php

use App\Http\Controllers\attendanceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\coursesCotroller;
use App\Http\Controllers\studentsController;
use App\Models\studentsModel;
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

Route::get('/absensi', function () {
    return view('absensi.form');
});

Route::get('login', [AuthController::class, 'index'])->name('index');
Route::post('login', [AuthController::class, 'login'])->name('login');

Route::middleware(['auth'])->group(function() {
    Route::get('/', function () {
        return view('admin.dashboard');
    });

    Route::prefix('v1')->group(function (){
        Route::prefix('attendance')->controller(attendanceController::class)->group(function () {
            Route::get('/', 'index')->name('getAllDataAttendance');
            Route::get('/create', 'createForm')->name('createFormAttendance');
            Route::post('/create', 'createData')->name('createDataAttendance');
            Route::get('/get/{id}', 'getDataById')->name('getDataByIdAttendance');
            Route::post('/update/{id}', 'updateData')->name('updateDataAttendance');
            Route::delete('/delete/{id}', 'deleteData')->name('deleteDataAttendance');
            Route::post('/attendance/{id}', 'attendance')->name('Attendance');
            Route::get('/attendance', 'showAttendance')->name('attendanceform');
            Route::post('/absensi/{id}', 'absensi')->name('absensi');

        });
        Route::prefix('courses')->controller(coursesCotroller::class)->group(function (){
            Route::get('/', 'index')->name('getAllDataCourse');
            Route::get('/create', 'createForm')->name('createFormCourse');
            Route::post('/create', 'createData')->name('createDataCourse');
            Route::get('/get/{id}', 'getDataById')->name('getDataByIdCourse');
            Route::post('/update/{id}', 'updateData')->name('updateDataCourse');
            Route::delete('/delete/{id}', 'deleteData')->name('deleteDataCourse');
        });
        Route::prefix('students')->controller(studentsController::class)->group(function (){
            Route::get('/', 'index')->name('getAllDataStudents');
            Route::get('/create', 'createForm')->name('createFormStudents');
            Route::post('/create', 'createData')->name('createDataStudents');
            Route::get('/get/{id}', 'getDataById')->name('getDataByIdStudents');
            Route::post('/update/{id}', 'updateData')->name('updateDataStudents');
            Route::delete('/delete/{id}', 'deleteData')->name('deleteDataStudents');
        });
    });
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

});

