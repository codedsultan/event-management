<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\StripePaymentController;
use Illuminate\Support\Facades\Route;

Route::get('/', [EventController::class, 'index'])->name('home');
Route::get('/events/{id}', [EventController::class, 'show'])->name('event.show');
Route::get('/iframe/events', [EventController::class, 'iframe'])->name('iframe');

//Cart section
    // Route::get('/add-to-cart/{id}', [CartController::class, 'addToCart'])->name('add-to-cart')->middleware('auth:customer');
    // Route::post('/add-to-cart', [CartController::class, 'singleAddToCart'])->name('single-add-to-cart')->middleware('auth:customer');
    // Route::get('cart-delete/{id}', [CartController::class, 'cartDelete'])->name('cart.delete')->middleware('auth:customer');
    // Route::post('cart-update', [CartController::class, 'cartUpdate'])->name('cart.update')->middleware('auth:customer');
    Route::get('/add-to-cart/{id}', [CartController::class, 'addToCart'])->name('add-to-cart')->middleware('guest');
    Route::post('/add-to-cart', [CartController::class, 'singleAddToCart'])->name('single-add-to-cart')->middleware('guest');
    // Route::delete('cart-delete/{id}', [CartController::class, 'cartDelete'])->name('cart.delete')->middleware('guest');
    Route::get('cart-delete/{id}', [CartController::class, 'cartDelete'])->name('cart.delete')->middleware('guest');
    Route::post('cart-update', [CartController::class, 'cartUpdate'])->name('cart.update')->middleware('guest');
    Route::get('/cart',[CartController::class, 'index'])->name('cart')->middleware('guest');
    Route::post('cart/order', [OrderController::class, 'store'])->name('cart.order')->middleware('guest');
Route::get('/login', function () {
    return view('welcome');
})->name('login');


Route::get('/test', function () {
    // Encrypt data
    $originalData = 'Hello, world!';
    $encryptedData = encrypt($originalData);
    // Decrypt data
    $decryptedData = decrypt($encryptedData);
    // Output results
    // dd([
    //     'original_data' => $originalData,
    //     'encrypted_data' => $encryptedData,
    //     'decrypted_data' => $decryptedData,
    // ]);
    return view('welcome');
})->name('test');

Route::get('/checkout',[CheckoutController::class, 'checkout'])->name('checkout');
// Route::get('/checkout/{vendor}',[CheckoutController::class, 'checkout'])->name('checkout');
Route::controller(StripePaymentController::class)->group(function(){
    Route::get('stripe/checkout', 'stripeCheckout')->name('stripe.checkout');
    // Route::get('stripe/checkout/success', 'stripeCheckoutSuccess')->name('stripe.checkout.success');
    Route::get('stripe/checkout/{vendor}/success', 'stripeCheckoutSuccess')->name('vendor.stripe.success');
});
