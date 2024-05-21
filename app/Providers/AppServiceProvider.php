<?php

namespace App\Providers;

use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Observers\InvoiceItemObserver;
use App\Observers\InvoiceObserver;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        InvoiceItem::observe(InvoiceItemObserver::class);
        Invoice::observe(InvoiceObserver::class);

        Event::listen(
            \Illuminate\Auth\Events\Attempting::class,
            \App\Listeners\PrepareCartTransfer::class,
        );

        Event::listen(
            \Illuminate\Auth\Events\Login::class,
            \App\Listeners\TransferGuestCartToUser::class
        );
    }

}
