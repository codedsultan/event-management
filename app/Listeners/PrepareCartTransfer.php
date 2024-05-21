<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PrepareCartTransfer
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {


    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        // dd(Auth::guest());
        if (Auth::guest()) {
            session()->flash('guest_cart', [
                'session' => Session::get('cart'),
                // 'data' => \Cart::getContent()
            ]);
        }
    }
}
