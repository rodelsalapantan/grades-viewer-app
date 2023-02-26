<?php

use App\Http\Controllers\Admin\AccountManagementController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DepartmentManagement;
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
Auth::routes([ 'register' => false,]);

// admin routes
Route::prefix('admin')->group(function(){
    Route::get('/', [AdminController::class, 'index'])->name('admin.home');                                                 // index

    // Account Management 
    Route::get('/create-teacher', [AccountManagementController::class, 'createTeacher'])->name('admin.create-teacher');     // create teacher
    Route::get('/create-student', [AccountManagementController::class, 'createStudent'])->name('admin.create-student');     // create student
    Route::get('/view-accounts', [AccountManagementController::class, 'index'])->name('admin.view-accounts');               // view accounts

    // Department Management
    Route::get('/manage-department', [DepartmentManagement::class, 'index'])->name('admin.manage-department');              // manage dept.
    Route::post('/store-department', [DepartmentManagement::class, 'store'])->name('admin.store-department');               // store dept.
    Route::get('/edit/{id}', [DepartmentManagement::class, 'edit'])->name('admin.edit-department');
    Route::put('/edit/{id}', [DepartmentManagement::class, 'update'])->name('admin.update-department');
    Route::delete('/edit/{id}', [DepartmentManagement::class, 'destroy'])->name('admin.delete-department');
})->middleware(['role:admin', 'auth']);