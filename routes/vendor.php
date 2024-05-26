<?php

use App\Http\Controllers\Vendor\ApiKeysController;
use App\Http\Controllers\Vendor\AuthController;
use App\Http\Controllers\Vendor\BookingController;
use App\Http\Controllers\Vendor\DashboardController;
use App\Http\Controllers\Vendor\EventController;
use App\Http\Controllers\Vendor\ForgotPasswordController;
use App\Http\Controllers\Vendor\InvoiceController;
use App\Http\Controllers\Vendor\InvoicePaymentController;
use App\Http\Controllers\Vendor\TicketController;
use Illuminate\Support\Facades\Route;


Route::prefix('vendor')->name('vendor.')->group(function(){

    Route::middleware(['guest:vendor'])->group(function(){
        Route::view('/login','dashboard.vendor.login')->name('login');
        Route::view('/register','dashboard.vendor.register')->name('register');
        Route::post('/create',[AuthController::class,'create'])->name('create');
        Route::post('/check',[AuthController::class,'check'])->name('check');

        Route::get('/verify',[AuthController::class,'verify'])->name('verify');

        Route::get('/password/forgot',[ForgotPasswordController::class,'showForgotForm'])->name('forgot.password.form');
        Route::post('/password/forgot',[ForgotPasswordController::class,'sendResetLink'])->name('forgot.password.link');
        Route::get('/password/reset/{token}',[ForgotPasswordController::class,'showResetForm'])->name('reset.password.form');
        Route::post('/password/reset',[ForgotPasswordController::class,'resetPassword'])->name('reset.password');
    });

    Route::middleware(['auth:vendor','verified_vendor'])->group(function(){
        // Route::view('/','dashboard.vendor.home')->name('home');
        Route::get('/',[DashboardController::class,'index'])->name('home');
        // Route::view('/home','dashboard.vendor.home')->name('home');
        Route::post('/logout',[AuthController::class,'logout'])->name('logout');


        Route::get('location/{location}/applications/create', [BookingController::class, 'create'])->name('create.bookings');
        Route::get('/applications', [BookingController::class, 'index'])->name('bookings');
        Route::get('/applications/{booking}', [BookingController::class, 'show'])->name('show.booking');
        // Route::get('/applications/create', [BookingController::class, 'create'])->name('create.bookings');
        Route::post('/applications', [BookingController::class, 'store'])->name('store.bookings');


        Route::get('/invoice/{invoice}', [InvoiceController::class, 'show'])->name('show.invoice');

        Route::post('/pay/invoice/{invoice}', [InvoicePaymentController::class, 'pay'])->name('pay.invoice');

        Route::post('/pay/invoice/{invoice}', [InvoicePaymentController::class, 'pay'])->name('pay.invoice');

        Route::get('/events', [EventController::class, 'index'])->name('events');
        Route::get('/events/create', [EventController::class, 'create'])->name('create.events');
        Route::post('/events', [EventController::class, 'store'])->name('store.events');
        Route::get('/events/{id}', [EventController::class, 'show'])->name('show.events');
        Route::get('/events/{id}/edit', [EventController::class, 'edit'])->name('edit.events');
        Route::put('/events/{id}', [EventController::class, 'update'])->name('update.events');
        Route::delete('/events/{id}', [EventController::class, 'destroy'])->name('destroy.events');


        Route::get('/events/{event}/tickets', [TicketController::class, 'index'])->name('tickets');
        Route::get('/events/{event}/tickets/create', [TicketController::class, 'create'])->name('create.tickets');
        Route::post('/events/{event}/tickets', [TicketController::class, 'store'])->name('store.tickets');

        Route::get('/api-key', [ApiKeysController::class, 'index'])->name('stripe.key.index');
        Route::get('/api-key/create', [ApiKeysController::class, 'create'])->name('stripe.key.create');
        Route::post('/api-key', [ApiKeysController::class, 'store'])->name('stripe.key.store');
        Route::delete('/api-key/delete/{key}', [ApiKeysController::class, 'delete'])->name('stripe.key.delete');
    });

    Route::controller(InvoicePaymentController::class)->group(function(){
        Route::get('stripe/checkout', 'stripeCheckout')->name('stripe.checkout');
        Route::get('stripe/checkout/success', 'stripeCheckoutSuccess')->name('stripe.checkout.success');
    });


});




// Route::get('vendor/email/verify', function () {
//     return view('auth.verify');
// })->middleware('auth:vendor')->name('verification.notice');


// Route::get('vendor/email/verify/{id}/{hash}',[AuthController::class,'verifyEmail'])
//     ->middleware(['auth:vendor', 'signed'])->name('verification.verify');


// Route::post('vendor/email/verification-notification',[AuthController::class,'verification'])
//         ->middleware(['auth:vendor', 'throttle:6,1'])->name('verification.send');

// Route::post('vendor/email/verification',[AuthController::class,'verification'])
//         ->middleware(['auth:vendor', 'throttle:6,1'])->name('verification.resend');
