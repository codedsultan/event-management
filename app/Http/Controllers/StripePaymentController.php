<?php

namespace App\Http\Controllers;

use App\Models\CustomerTicket;
use App\Models\Order;
use App\Models\Vendor;
use Helper;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Str;
class StripePaymentController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe(): View
    {
        return view('stripe');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function stripeCheckout(Request $request)
    {

        $stripe = new \Stripe\StripeClient(Helper::getVendorAPiKey($request->vendor_id));

        $redirectUrl = route('vendor.stripe.success',['vendor' => $request->vendor_id]).'?session_id={CHECKOUT_SESSION_ID}';
        $response =  $stripe->checkout->sessions->create([
                'success_url' => $redirectUrl,
                'customer_email' => $request->customer_email,
                'payment_method_types' => ['link', 'card'],
                'line_items' => [
                    [
                        'price_data'  => [
                            'product_data' => [
                                'name' => $request->order,
                            ],
                            'unit_amount'  => 100 * $request->price,
                            'currency'     => 'USD',
                        ],
                        'quantity'    => 1
                    ],
                ],

                'custom_text' => [
                    'after_submit' => [
                        'message' => 'You will recieve confirmation email,sometimes it goes spam'
                    ]
                ],
                'mode' => 'payment',
                'allow_promotion_codes' => true,
                'metadata' => [
                    'order_no' => $request->order,
                    'order_id' => $request->order_id,
                    'vendor_id' => $request->vendor_id,
                    'customer_email' => $request->customer_email
                ],
            ]);

        return redirect($response['url']);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function stripeCheckoutSuccess($vendor,Request $request)
    {
        $stripe = new \Stripe\StripeClient(Helper::getVendorAPiKey(intval($vendor)));

        $session = $stripe->checkout->sessions->retrieve($request->session_id);
        // dd($session->metadata);
        if($session->payment_status === 'paid'){
            $order = Order::where('id',$session->metadata->order_id)->with('cart.ticket')->first();
            if($order->payment_status === 'unpaid'){
                foreach($order->cart as $cart){
                    $product=$cart->ticket;
                    $product->quantity_available -= $cart->quantity;
                    $product->save();

                    for($i = 0; $i <= $cart->quantity; $i++){
                       $ticket =  new CustomerTicket();
                       $ticket->customer_id = $cart->customer_id;
                       $ticket->ticket_id = $cart->ticket_id;
                       $ticket->number = strtoupper(Str::random(10));
                       $ticket->save();
                    }
                }

                $order->payment_status = 'paid';
                $order->save();
            }

        }

        info($session);

        return redirect()->route('home')
                         ->with('success', 'Payment successful.');
    }
}
