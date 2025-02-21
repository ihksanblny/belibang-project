<?php

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductOrderController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FrontController;
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

Route::get('/', [FrontController::class, 'index'])->name('front.index');
Route::get('/details/{product:slug}' ,[FrontController::class, 'details'])->name('front.details');
Route::get('/category/{category}', [FrontController::class, 'category'])->name('front.category');
Route::get('/search', [FrontController::class, 'search'])->name('front.search');

Route::get('/dashboard', [DashboardController::class, 'showDashboard'])->name('dashboard')->middleware(['auth', 'verified']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::get('/checkout/{product:slug}', [CheckoutController::class, 'checkout'])->name('front.checkout');
    Route::post('/checkout/store/{product:slug}', [CheckoutController::class, 'store'])->name('front.checkout.store');

    Route::prefix('admin')->name('admin.')->group(function(){
        Route::resource('products',ProductController::class);
        Route::resource('product_orders',ProductOrderController::class);

        Route::get('/dashboard', [DashboardController::class, 'showDashboard'])->name('dashboard');
        Route::get('/products', [ProductController::class, 'index'])->name('products.index');
        Route::get('/productOrder', [ProductOrderController::class, 'index'])->name('product_orders.index');
        Route::get('/transactions',[ProductOrderController::class,'transactions'])->name('product_orders.transactions');
        Route::get('/transactions/details/{productOrder}',[ProductOrderController::class,'transactions_details'])->name('product_orders.transactions.details');
        Route::get('/download/file/{productOrder}',[ProductOrderController::class,'download_file'])->name('product_orders.download')->middleware('throttle:1,1');
    });
    
});

require __DIR__.'/auth.php';
