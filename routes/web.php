<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HRController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\OwnerController;
use App\Http\Middleware\CheckUserRole;
use Illuminate\Support\Facades\Route;

// login
Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/', [AuthController::class, 'login'])->name('auth.login');

// register
Route::get('/register', [AuthController::class, 'register'])->name('auth.register');
Route::post('/register-user', [AuthController::class, 'create'])->name('auth.create');

// logout
Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');


Route::prefix('/employee')->middleware('role:employee')->group(function () {
    // dashboard
    Route::get('/dashboard', [EmployeeController::class, 'index'])->name('employee.dashboard');
    // apply for job
    Route::post('/apply-job/{job_id}', [EmployeeController::class, 'apply'])->name('employee.apply');

    // display the form
    Route::get('/add-resume', [EmployeeController::class, 'addResumeForm'])->name('employee.addResume');
    Route::post('/add-resume', [EmployeeController::class, 'storeResume'])->name('employee.resumeStore');

    // view resume
    Route::get('/view-resume', [EmployeeController::class, 'viewResume'])->name('employee.viewResume');
});

// view resume
Route::get('/applications/{application}/resume', [EmployeeController::class, 'viewApplicationResume'])
    ->name('applications.resume');

Route::prefix('/hr')->middleware('role:HR')->group(function () {
    // dashboard
    Route::get('/dashboard', [HRController::class, 'index'])->name('hr.dashboard');
    // add job
    Route::get('/job-form', [HRController::class, 'show'])->name('hr.showForm');
    Route::post('/add', [HRController::class, 'create'])->name('hr.createJob');

    //job list
    Route::get('/job-list', [HRController::class, 'jobList'])->name('hr.jobList');

    // hr accept/reject route
    Route::post('/applications/{application}/decision', [HRController::class, 'decide'])->name('hr.applications.decide');

    // job edit
    Route::get('/job/{job}/edit', [HRController::class, 'edit'])->name('hr.job.edit');
    Route::put('/job/{job}', [HRController::class, 'update'])->name('hr.job.update');

    // job delete
    Route::delete('/job/{job}', [HRController::class, 'destroy'])->name('hr.job.delete');
});

Route::prefix('/manager')->middleware('role:Manager')->group(function () {
    // dashboard
    Route::get('/dashboard', [ManagerController::class, 'show'])->name('manager.dashboard');
    // manager accept/reject route
    Route::post('/applications/{application}/decision', [ManagerController::class, 'decide'])->name('manager.applications.decide');
});


Route::prefix('/owner')->middleware('role:Owner')->group(function () {
    // dashboard
    Route::get('/dashboard', [OwnerController::class, 'index'])->name('owner.dashboard');
    // register company
    Route::get('/register-form', [OwnerController::class, 'showForm'])->name('owner.showform');
    Route::post('/register-company', [OwnerController::class, 'registerCompany'])->name('owner.registerCompany');

    // owner accept/reject route
    Route::post('/applications/{application}/decision', [OwnerController::class, 'decide'])->name('owner.applications.decide');
});
