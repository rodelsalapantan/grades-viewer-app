<?php

use App\Http\Controllers\Admin\AcademicYearController;
use App\Http\Controllers\Admin\AccountManagementController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\DepartmentManagementController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\YearLevelController;
use App\Http\Controllers\Auth\NewUserResetPasswordController;
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
    Route::put('/edit-dept', [DepartmentManagementController::class, 'update'])->name('admin.update-department');      // update
    Route::delete('/edit-dept/{id}', [DepartmentManagementController::class, 'destroy'])->name('admin.delete-department');  // delete

    // Academic Year Manage
    Route::get('/manage-acad-year', [AcademicYearController::class, 'index'])->name('admin.manage-acad-year');              // manage
    Route::post('/store-acad-year', [AcademicYearController::class, 'store'])->name('admin.store-acad-year');               // store
    Route::get('/edit-acad-year/{id}', [AcademicYearController::class, 'edit'])->name('admin.edit-acad-year');              // edit        
    Route::put('/edit-acad-year', [AcademicYearController::class, 'update'])->name('admin.update-acad-year');          // update
    Route::delete('/edit-acad-year/{id}', [AcademicYearController::class, 'destroy'])->name('admin.delete-acad-year');      // delete

    // Account Management 
    Route::get('/view-accounts', [AccountManagementController::class, 'index'])->name('admin.view-accounts');               // view accounts
    // -- teacher
    Route::get('/create-teacher', [AccountManagementController::class, 'createTeacher'])->name('admin.create-teacher');     // create teacher
    Route::post('/store-teacher', [AccountManagementController::class, 'storeTeacher'])->name('admin.store-teacher');       // store teacher
    // -- student
    Route::get('/create-student', [AccountManagementController::class, 'createStudent'])->name('admin.create-student');     // create student
    Route::post('/store-student', [AccountManagementController::class, 'storeStudent'])->name('admin.store-student');       // store student

    // Section Management
    Route::get('/manage-section', [SectionController::class, 'index'])->name('admin.manage-section');                       // manage
    Route::post('/store-section', [SectionController::class, 'store'])->name('admin.store-section');                        // store
    Route::get('/edit-section/{id}', [SectionController::class, 'edit'])->name('admin.edit-section');                       // edit
    Route::put('/edit-section', [SectionController::class, 'update'])->name('admin.update-section');                        // update
    Route::delete('/edit-section/{id}', [SectionController::class, 'destroy'])->name('admin.delete-section');               // delete

    // Course Management
    Route::get('/manage-course', [CourseController::class, 'index'])->name('admin.manage-course');                          // manage
    Route::post('/store-course', [CourseController::class, 'store'])->name('admin.store-course');                           // store
    Route::get('/edit-course/{id}', [CourseController::class, 'edit'])->name('admin.edit-course');                          // edit
    Route::put('/edit-course', [CourseController::class, 'update'])->name('admin.update-course');                           // update
    Route::delete('/edit-course/{id}', [CourseController::class, 'destroy'])->name('admin.delete-course');                  // delete

    // Year Level Management
    Route::get('/manage-year-level', [YearLevelController::class, 'index'])->name('admin.manage-year-level');                       // manage
    Route::post('/store-year-level', [YearLevelController::class, 'store'])->name('admin.store-year-level');                        // store
    Route::get('/edit-year-level/{id}', [YearLevelController::class, 'edit'])->name('admin.edit-year-level');                       // edit
    Route::put('/edit-year-level', [YearLevelController::class, 'update'])->name('admin.update-year-level');                        // update
    Route::delete('/edit-year-level/{id}', [YearLevelController::class, 'destroy'])->name('admin.delete-year-level');                // delete

});

// teacher routes
Route::group( [
    'prefix' => 'teacher',
    'middleware' => ['role:teacher', 'auth', 'verified']
], function () {
    Route::get('/', function(){
        return view('pages.teacher.index');
    })->name('teacher.home');
            
});


// new user reset password
Route::get('/new-user/reset-password/{token}/{email}', [NewUserResetPasswordController::class, 'create'])
    ->middleware('guest')
    ->name('new-user-reset-password');

Route::put('/new-user/reset-password/', [NewUserResetPasswordController::class, 'updatePassword'])
    ->middleware('guest')
    ->name('update-new-user-password');;

Route::get('/mail', function(){
    return view('mail.new-student');
});