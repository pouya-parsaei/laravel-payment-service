<?php

use App\Http\Controllers\BasketController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('',[ProductController::class,'index'])->name('products.index');
Route::get('basket/add/{product}',[BasketController::class,'add'])->name('basket.add');
Route::get('basket',[BasketController::class,'index'])->name('basket.index');
Route::put('basket/update/{product}',[BasketController::class,'update'])->name('basket.update');

Route::get('basket/checkout',[BasketController::class,'checkoutForm'])->name('basket.checkout.form')->middleware('auth');
Route::post('basket/checkout',[BasketController::class,'checkout'])->middleware('auth')->name('basket.checkout');

Route::post('payment/{gateway}/callback',[PaymentController::class,'verify'])->name('payment.verify');

Route::get('basket/clear',function(){
   resolve(\App\Support\Storage\Contracts\StorageInterface::class)->clear();
});

Route::prefix('coupon')->middleware('auth')->group(function(){
    Route::post('',[CouponController::class,'check'])->name('coupons.check');
    Route::delete('',[CouponController::class,'destroy'])->name('coupons.destroy');
});

Route::get('/category',function(){
   dd(\App\Models\Product::find(2)->category->validCoupons());
});
