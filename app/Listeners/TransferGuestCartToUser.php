<?php

namespace App\Listeners;

use App\Models\Cart;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Session;

class TransferGuestCartToUser
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        // dd(session('guest_cart.data') != null );
        // if (session('guest_cart.data') != null ) {
            if( Session::has('cart') ){
                // $sessionId = session('guest_cart.session');
                $cart_items = Cart::where('session_id',Session::get('cart'));
            // dd($cart_items);
                $cart_items->update([
                    'customer_id' => auth()->guard('customer')->user()->id,
                    'session_id' => null
                ]);

                Session::forget('cart');
            }
            // $sessionId = session('guest_cart.session');
            // $cart_items = Cart::where('session_id',$sessionId)->get();
            // // dd($cart_items);
            // $cart_items->update([
            //     'customer_id' => auth()->user()->id,
            //     'session_id' => null
            // ]);
        // }

    }
}
