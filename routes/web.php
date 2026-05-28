<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HRController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\OwnerController;
use Illuminate\Support\Facades\Route;


Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');

Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::get('/register', [AuthController::class, 'register'])->name('auth.register');
Route::post('/register-user', [AuthController::class, 'create'])->name('auth.create');


Route::prefix('/employee')->group(function () {
    // dashboard
    Route::get('/dashboard', [EmployeeController::class, 'index'])->name('employee.dashboard');
    // apply for job
    Route::post('/apply-job/{job_id}', [EmployeeController::class, 'apply'])->name('employee.apply');
    // add resume
    // Display the form
    Route::get('/add-resume', [EmployeeController::class, 'addResumeForm'])->name('employee.addResume');
    Route::post('/add-resume', [EmployeeController::class, 'storeResume'])->name('employee.resumeStore');
});

Route::prefix('/hr')->group(function () {
    // dashboard
    Route::get('/dashboard', [HRController::class, 'index'])->name('hr.dashboard');
    // add job
    Route::get('/job-form', [HRController::class, 'show'])->name('hr.showForm');
    Route::post('/add', [HRController::class, 'create'])->name('hr.createJob');
    Route::post('/applications/{application}/decision', [HRController::class, 'decide'])->name('hr.applications.decide');
});

Route::prefix('/manager')->group(function () {
    Route::get('/dashboard', [ManagerController::class, 'show'])->name('manager.dashboard');
    Route::post('/applications/{application}/decision', [ManagerController::class, 'decide'])->name('manager.applications.decide');
});


Route::prefix('/owner')->group(function () {
    // dashboard
    Route::get('/dashboard', [OwnerController::class, 'index'])->name('owner.dashboard');
    // register company
    Route::get('/register-form', [OwnerController::class, 'showForm'])->name('owner.showform');
    Route::post('/register-company', [OwnerController::class, 'registerCompany'])->name('owner.registerCompany');
    Route::post('/applications/{application}/decision', [OwnerController::class, 'decide'])->name('owner.applications.decide');
});
