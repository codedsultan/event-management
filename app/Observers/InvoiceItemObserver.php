<?php

namespace App\Observers;

use App\Models\InvoiceItem;
use Helper;

class InvoiceItemObserver
{
    /**
     * Handle the InvoiceItem "created" event.
     */
    public function created(InvoiceItem $invoiceItem): void
    {
        $invoiceItem->load('invoice');


        $total =  Helper::totalInvoicePrice($invoiceItem->invoice->id);
        $invoiceItem->invoice()->update(['total_amount' => $total ]);
    }

    /**
     * Handle the InvoiceItem "updated" event.
     */
    public function updated(InvoiceItem $invoiceItem): void
    {
        $invoiceItem->load('invoice');
        $total =  Helper::totalInvoicePrice($invoiceItem->invoice->id);
        $invoiceItem->invoice()->update(['total_amount' => $total ]);
    }

    /**
     * Handle the InvoiceItem "deleted" event.
     */
    public function deleted(InvoiceItem $invoiceItem): void
    {
        $invoiceItem->load('invoice');
        $total =  Helper::totalInvoicePrice($invoiceItem->invoice->id);
        $invoiceItem->invoice()->update(['total_amount' => $total ]);
    }

    /**
     * Handle the InvoiceItem "restored" event.
     */
    public function restored(InvoiceItem $invoiceItem): void
    {
        //
    }

    /**
     * Handle the InvoiceItem "force deleted" event.
     */
    public function forceDeleted(InvoiceItem $invoiceItem): void
    {
        //
    }
}
