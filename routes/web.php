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
// Route order
Route::resource('/order', OrderController::class, ['except' => ['create', 'store', 'edit', 'update', 'destroy'], 'as' => 'admin']);
// Route customer
Route::get('/customer', [CustomerController::class, 'index'])->name('admin.customer.index');
// Route slider
Route::resource('/slider', SliderController::class, ['except' => ['create', 'show', 'edit', 'update'], 'as' => 'admin']);
// Route profile
Route::get('/profile', [ProfileController::class, 'index'])->name('admin.profile.index');
