<?php

use App\Http\Controllers\Admin\AdminController;
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
Route::get('/', [HomeController::class, 'index'])->name('home');

// register all auth routes, except register
Auth::routes([ 'register' => false,]);

// admin routes
Route::prefix('admin')->group(function(){
    Route::get('/', [AdminController::class, 'index'])->name('admin.home');
})->middleware(['role:admin', 'auth']);

