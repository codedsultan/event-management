<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function show(Invoice $invoice)
    {
        $invoice = ($invoice->load('items'));
        return view('invoice.show', compact('invoice'));
    }
}
