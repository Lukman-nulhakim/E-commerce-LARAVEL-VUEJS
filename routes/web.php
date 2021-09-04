<?php

namespace App\Http\Controllers\Admin;
    use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

// group route with prefix "Admin"
Route::prefix('admin')->group(function(){
    // group route with middleware "auth"
    Route::group(['middleware' => 'auth'], function(){
        // Route Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard.index');
    });
});

// Route category
Route::resource('/category', CategoryController::class, ['as' => 'admin']);

// Route product
Route::resource('/product', ProductController::class, ['as' => 'admin']);
