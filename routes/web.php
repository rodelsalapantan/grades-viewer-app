<?php

use App\Http\Controllers\Admin\AcademicYearController;
use App\Http\Controllers\Admin\AccountManagementController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DepartmentManagementController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
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

// entry point / landing page
Route::get('/', [HomeController::class, 'index'])->name('home');                                                            // landing page

// register all auth routes, except register
Auth::routes(['register' => false]);

// admin routes
Route::group( [
    'prefix' => 'admin',
    'middleware' => ['role:admin', 'auth']
], function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.home');                                                 // admin index

    // Department Management
    Route::get('/manage-department', [DepartmentManagementController::class, 'index'])->name('admin.manage-department');    // manage dept.
    Route::post('/store-department', [DepartmentManagementController::class, 'store'])->name('admin.store-department');     // store dept.
    Route::get('/edit-dept/{id}', [DepartmentManagementController::class, 'edit'])->name('admin.edit-department');          // edit        
    Route::put('/edit-dept/{id}', [DepartmentManagementController::class, 'update'])->name('admin.update-department');      // update
    Route::delete('/edit-dept/{id}', [DepartmentManagementController::class, 'destroy'])->name('admin.delete-department');  // delete

    // Academic Year Manage
    Route::get('/manage-acad-year', [AcademicYearController::class, 'index'])->name('admin.manage-acad-year');              // manage
    Route::post('/store-acad-year', [AcademicYearController::class, 'store'])->name('admin.store-acad-year');               // store
    Route::get('/edit-acad-year/{id}', [AcademicYearController::class, 'edit'])->name('admin.edit-acad-year');              // edit        
    Route::put('/edit-acad-year/{id}', [AcademicYearController::class, 'update'])->name('admin.update-acad-year');          // update
    Route::delete('/edit-acad-year/{id}', [AcademicYearController::class, 'destroy'])->name('admin.delete-acad-year');      // delete

    // Account Management 
    Route::get('/create-teacher', [AccountManagementController::class, 'createTeacher'])->name('admin.create-teacher');     // create teacher
    Route::post('/store-teacher', [AccountManagementController::class, 'storeTeacher'])->name('admin.store-teacher');       // store teacher - single

    Route::get('/create-student', [AccountManagementController::class, 'createStudent'])->name('admin.create-student');     // create student
    Route::get('/view-accounts', [AccountManagementController::class, 'index'])->name('admin.view-accounts');               // view accounts

});

Route::group( [
    'prefix' => 'teacher',
    'middleware' => ['role:teacher', 'auth', 'verified']
], function () {
    Route::get('/', function(){
        return view('pages.teacher.index');
    })->name('teacher.home');
            
});
