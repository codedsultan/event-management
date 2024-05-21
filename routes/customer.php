<?php

use App\Http\Controllers\Customer\AuthController;
use App\Http\Controllers\Customer\CustomerTicketController;
use App\Http\Controllers\Customer\ForgotPasswordController;
use App\Http\Controllers\Customer\OrderController;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::prefix('user')->name('user.')->group(function(){

  Route::middleware(['guest:customer'])->group(function(){
        Route::view('/login','dashboard.user.login')->name('login');
        Route::view('/register','dashboard.user.register')->name('register');
        Route::post('/create',[AuthController::class,'create'])->name('create');
        Route::post('/check',[AuthController::class,'check'])->name('check');

        Route::get('/verify',[AuthController::class,'verify'])->name('verify');

        Route::get('/password/forgot',[ForgotPasswordController::class,'showForgotForm'])->name('forgot.password.form');
        Route::post('/password/forgot',[ForgotPasswordController::class,'sendResetLink'])->name('forgot.password.link');
        Route::get('/password/reset/{token}',[ForgotPasswordController::class,'showResetForm'])->name('reset.password.form');
        Route::post('/password/reset',[ForgotPasswordController::class,'resetPassword'])->name('reset.password');

        Route::get('verify-login/{token}', [AuthController::class, 'verifyLogin'])->name('verify-login');
        Route::view('magic-login', 'dashboard.user.magiclogin')->name('magic.login');
        Route::post('login', [AuthController::class, 'magicLogin'])->name('magic.login');
  });

  Route::middleware(['auth:customer','verified_user'])->group(function(){
        Route::view('/','dashboard.user.home')->name('home');

        // Route::get('/home',function(Request $request){
        //     dd($request->user()->name );
        //     return dd($request);
        // })->name('home');
        Route::post('/logout',[AuthController::class,'logout'])->name('logout');
        Route::get('/tickets',[CustomerTicketController::class,'index'])->name('tickets');
        Route::get('/ticket/{customerTicket}',[CustomerTicketController::class,'show'])->name('ticket.show');
        Route::get('/ticket/{customerTicket}/edit',[CustomerTicketController::class,'edit'])->name('ticket.edit');
        Route::post('/ticket/{customerTicket}/update',[CustomerTicketController::class,'update'])->name('ticket.update');


        Route::get('/orders',[OrderController::class,'index'])->name('orders');
        Route::get('/orders/{order}',[OrderController::class,'show'])->name('order.show');
  });




});

Route::get('user/email/verify', function () {
    return view('auth.verify');
})->middleware('auth:web')->name('verification.notice');


Route::get('user/email/verify/{id}/{hash}',[AuthController::class,'verifyEmail'])
    ->middleware(['auth:web', 'signed'])->name('verification.verify');


Route::post('user/email/verification-notification',[AuthController::class,'verification'])
        ->middleware(['auth:web', 'throttle:6,1'])->name('verification.send');

Route::post('user/email/verification',[AuthController::class,'verification'])
        ->middleware(['auth:web', 'throttle:6,1'])->name('verification.resend');
