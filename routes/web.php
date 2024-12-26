<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\CheckController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScheduleController;
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

Route::get('/', function () { return view('welcome'); })->name('welcome');

Route::get('attended/{user_id}', [AttendanceController::class, 'attended'])->name('attended');
Route::get('attended-before/{user_id}', [AttendanceController::class, 'attendedBefore'])->name('attendedBefore');

Auth::routes(['register' => false, 'reset' => false]);

Route::group(['middleware' => ['auth', 'Role'], 'roles' => ['admin']], function () {
    // Employees Resource
    Route::resource('/employees', EmployeeController::class);

    // Attendance
    Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance');
    Route::get('/latetime', [AttendanceController::class, 'indexLatetime'])->name('indexLatetime');

    // Leave
    Route::get('/leave', [LeaveController::class, 'index'])->name('leave');
    Route::get('/overtime', [LeaveController::class, 'indexOvertime'])->name('indexOvertime');

    // Admin Dashboard
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');

    // Schedule Resource
    Route::resource('/schedule', ScheduleController::class);

    // Check Controller
    Route::get('/check', [CheckController::class, 'index'])->name('check');
    Route::get('/sheet-report', [CheckController::class, 'sheetReport'])->name('sheet-report');
    Route::post('check-store', [CheckController::class, 'CheckStore'])->name('check_store');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/dashboard', [DashboardController::class, 'index']);

require __DIR__.'/auth.php';
