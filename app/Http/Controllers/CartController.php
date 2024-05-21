<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\Cart;
use App\Models\Ticket;
use Helper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    protected $ticket=null;
    public function __construct(Ticket $ticket){
        $this->ticket=$ticket;
    }

    public function index(Request $request)
    {
        if(Auth::guard('customer')->check())
        {
            if(empty(Cart::where('customer_id',auth()->guard('customer')->user()->id)->where('order_id',null)->first())){
                request()->session()->flash('success','Cart is Empty !');
                // return redirect()->back();
            }
        }else {
            if(empty(Cart::where('session_id',Session::get('cart'))->where('order_id',null)->first())){
                request()->session()->flash('success','Cart is Empty !');
                // return redirect()->back();
            }
        }


        return view('dashboard.user.carts');
    }


    public function singleAddToCart(Request $request){

        $request->validate([
            'id'      =>  'required',
            'qty'      =>  'required',
        ]);

        $ticket = Ticket::where('id', $request->id)->with('event')->first();

        if(Auth::guard('customer')->check())
        {
            $already_cart = Cart::where('customer_id', auth()->guard('customer')->user()->id)->where('order_id',null)->where('ticket_id', $ticket->id)->first();
        } else {
            Session::has('cart') ? Session::get('cart') : $request->session()->put('cart', session()->getId());
            $scart_id = Session::get('cart');
            $already_cart = Cart::where('session_id', $scart_id)->where('order_id',null)->where('ticket_id', $ticket->id)->first();
        }

        if($already_cart) {
            $already_cart->quantity = $already_cart->quantity + $request->qty;
            // $already_cart->price = ($product->price * $request->qty) + $already_cart->price ;
            $already_cart->amount = ($ticket->price * $request->qty)+ $already_cart->amount;
            // if ($already_cart->product->stock < $already_cart->quantity || $already_cart->product->stock <= 0) return back()->with('error','Stock not sufficient!.');
            $already_cart->save();

        }else{

            $cart = new Cart;
            if(Auth::guard('customer')->check()) {
                $cart->customer_id =  auth()->guard('customer')->user()->id;
            } else {
                $cart->session_id   = $scart_id;
            }

            $cart->ticket_id = $ticket->id;
            // $cart->price = ($ticket->price-($ticket->price*$ticket->discount)/100);
            $cart->price = $ticket->price;
            $cart->vendor_id = $ticket->event->vendor_id;
            $cart->quantity = $request->qty;
            $cart->amount=($ticket->price * $request->qty);
            // if ($cart->product->stock < $cart->quantity || $cart->product->stock <= 0) return back()->with('error','Stock not sufficient!.');
            // return $cart;
            $cart->save();
        }
        request()->session()->flash('success','Product successfully added to cart.');
        return back();
    }

    public function cartDelete(Request $request){
        $cart = Cart::find($request->id);
        if ($cart) {
            $cart->delete();
            request()->session()->flash('success','Cart successfully removed');
            return redirect()->back();
        }
        request()->session()->flash('error','Error please try again');
        return redirect()->back();
    }

    public function cartUpdate(Request $request){
        if($request->qty){
            $error = array();
            $success = '';
            foreach ($request->qty as $k=>$quant) {
                $id = $request->qty_id[$k];
                $cart = Cart::find($id);
                if($quant > 0 && $cart) {

                    $cart->quantity = $quant;
                    $after_price=$cart->ticket->price;
                    // $after_price=($cart->product->price-($cart->product->price*$cart->product->discount)/100);
                    $cart->amount = $after_price * $quant;
                    // return $cart->price;
                    $cart->save();
                    $success = 'Cart successfully updated!';
                }else{
                    $error[] = 'Cart Invalid!';
                }
            }
            return redirect()->back()->with($error)->with('success', $success);
        }else{
            return redirect()->back()->with('Cart Invalid!');
        }
    }

    public function checkout(Request $request){
        return view('frontend.pages.checkout');
    }
}
