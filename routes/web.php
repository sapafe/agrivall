<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PostController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\ProductController;

Route::get('/', function () {
    $products = \App\Models\Product::where('available', true)->take(4)->get();
    return view('home', compact('products'));
});

Route::get('/seed', function () {
    \Illuminate\Support\Facades\Artisan::call('db:seed', ['--class' => 'DatabaseSeeder']);
    return "¡Productos creados exitosamente! Ahora puedes volver a la portada y verlos.";
});

Route::get('/blog', [PostController::class , 'index'])->name('posts.index');
Route::get('/blog/{post}', [PostController::class , 'show'])->name('posts.show');

use App\Http\Controllers\ShopController;

Route::get('/shop', [ShopController::class , 'index'])->name('shop.index');
Route::get('/cart', [ShopController::class , 'cart'])->name('shop.cart');
Route::post('/cart/add', [ShopController::class , 'addToCart'])->name('shop.cart.add');
Route::put('/cart/update', [ShopController::class , 'updateCart'])->name('shop.cart.update');
Route::delete('/cart/remove', [ShopController::class , 'removeFromCart'])->name('shop.cart.remove');
Route::get('/checkout', [ShopController::class , 'checkout'])->name('shop.checkout');
Route::post('/checkout', [ShopController::class , 'processCheckout'])->name('shop.processCheckout');

Route::middleware('auth')->group(function () {
    Route::post('/la-casella/reservar', [ReservationController::class , 'store'])->name('casella.store');

    Route::prefix('admin')->name('admin.')->group(function () {
            Route::resource('products', ProductController::class);
            Route::get('orders', [OrderController::class , 'index'])->name('orders.index');
            Route::get('orders/{order}', [OrderController::class , 'show'])->name('orders.show');
            Route::put('orders/{order}/status', [OrderController::class , 'updateStatus'])->name('orders.updateStatus');
        }
        );
    });
Route::get('/login', [AuthController::class , 'show'])->name('login');
Route::post('/login', [AuthController::class , 'login'])->name('login.attempt');
Route::post('/logout', [AuthController::class , 'logout'])->name('logout');

Route::get('/la-casella', [ReservationController::class , 'create'])->name('casella.create');