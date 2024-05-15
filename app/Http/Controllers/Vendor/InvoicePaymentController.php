<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoicePaymentController extends Controller
{
    public function pay(Invoice $invoice)
    {
        // dd( $invoice);

        return redirect()->route('vendor.stripe.checkout', ['price' => $invoice->total_amount, 'invoice' => $invoice->number ,'invoice_id' => $invoice->id]);
        $invoice->status = 'paid';
        $invoice->save();

        $invoice->load('booking');
        $event = new Event();
        $event->title = $invoice->booking->name;
        $event->description = $invoice->booking->description;
        $event->vendor_id = $invoice->booking->vendor_id;
        $event->start_date = $invoice->booking->start_date;
        $event->end_date = $invoice->booking->end_date;
        $event->start_time = $invoice->booking->starts_at;
        $event->end_time = $invoice->booking->ends_at;
        $event->location_id = $invoice->booking->location_id;
        $event->save();
        $invoice->booking->status = 'paid';
        $invoice->booking->save();

        return redirect()->route('vendor.bookings')->with('success','Event has been Created successfully');

    }

     /**
     * Write code on Method
     *
     * @return response()
     */
    public function stripeCheckout(Request $request)
    {
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

        $redirectUrl = route('vendor.stripe.checkout.success').'?session_id={CHECKOUT_SESSION_ID}';
        $response =  $stripe->checkout->sessions->create([
                'success_url' => $redirectUrl,
                'customer_email' => 'demo@gmail.com',
                'payment_method_types' => ['link', 'card'],
                'line_items' => [
                    [
                        'price_data'  => [
                            'product_data' => [
                                'name' => $request->invoice,
                            ],
                            'unit_amount'  => 100 * $request->price,
                            'currency'     => 'USD',
                        ],
                        'quantity'    => 1
                    ],
                ],
                'mode' => 'payment',
                'allow_promotion_codes' => true,
                // 'custom_fields' => [
                //     'invoice_no' => $request->invoice
                // ],
                'metadata' => [
                    'invoice_no' => $request->invoice,
                    'invoice_id' => $request->invoice_id
                ],
            ]);

        return redirect($response['url']);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function stripeCheckoutSuccess(Request $request)
    {
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

        $session = $stripe->checkout->sessions->retrieve($request->session_id);

        if($session->payment_status === 'paid'){
            $invoice = Invoice::where('id',$session->metadata->invoice_id)->first();
            $invoice->status = 'paid';
            $invoice->save();

            $invoice->load('booking');
            $event = new Event();
            $event->title = $invoice->booking->name;
            $event->description = $invoice->booking->description;
            $event->vendor_id = $invoice->booking->vendor_id;
            $event->start_date = $invoice->booking->start_date;
            $event->end_date = $invoice->booking->end_date;
            $event->start_time = $invoice->booking->starts_at;
            $event->end_time = $invoice->booking->ends_at;
            $event->location_id = $invoice->booking->location_id;
            $event->save();
            $invoice->booking->status = 'completed';
            $invoice->booking->save();

            return redirect()->route('vendor.bookings')->with('success','Payment successful,Event has been Created successfully');
        }
        // dd($session);
        // dd($session->status === 'complete');
        // dd($session->metadata->invoice_id);
        // info($session);

        return redirect()->route('home')
                         ->with('success', 'Payment Unsuccessful.');
    }
}
