<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HRController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\OwnerController;
use Illuminate\Support\Facades\Route;


Route::get('/', [AuthController::class, 'showLogin'])->name('auth.showlogin');
Route::post('/login-user', [AuthController::class, 'login'])->name('auth.login');


Route::get('/register', [AuthController::class, 'register'])->name('auth.register');
Route::post('/register-user', [AuthController::class, 'create'])->name('auth.create');


Route::prefix('/employee')->group(function () {
    Route::get('/dashboard', [EmployeeController::class, 'show'])->name('employee.dashboard');
});

Route::prefix('/hr')->group(function () {
    Route::get('/dashboard', [HRController::class, 'show'])->name('hr.dashboard');
});

Route::prefix('/manager')->group(function () {
    Route::get('/dashboard', [ManagerController::class, 'show'])->name('manager.dashboard');
});


Route::prefix('/owner')->group(function () {
    Route::get('/dashboard', [OwnerController::class, 'show'])->name('owner.dashboard');
});









