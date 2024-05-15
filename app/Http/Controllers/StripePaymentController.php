<?php

namespace App\Http\Controllers;

use App\Models\CustomerTicket;
use App\Models\Order;
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

        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

        $redirectUrl = route('stripe.checkout.success').'?session_id={CHECKOUT_SESSION_ID}';
        $response =  $stripe->checkout->sessions->create([
                'success_url' => $redirectUrl,
                'customer_email' => 'demo@gmail.com',
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
                'mode' => 'payment',
                'allow_promotion_codes' => true,
                'metadata' => [
                    'order_no' => $request->order,
                    'order_id' => $request->order_id
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
