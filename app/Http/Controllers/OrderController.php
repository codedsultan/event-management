<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\Order;
use App\Models\User;
// use PDF;
use Helper;
use Illuminate\Support\Str;
// use App\Notifications\StatusNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders=Order::orderBy('id','DESC')->paginate(10);
        // return view('admin.order.index')->with('orders',$orders);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $vendor = intval($request->vendor);

        if(Auth::guard('customer')->check())
        {
            if(empty(Cart::where('customer_id',auth()->guard('customer')->user()->id)->where('order_id',null)->where('vendor_id',$vendor)->first())){
                request()->session()->flash('error','Cart is Empty !');
                return back();
            }
            $user = auth()->guard('customer')->user();

        }else{
            $data = $request->validate([
                'email' => ['required','string','email']
            ]);
            if(empty(Cart::where('session_id',Session::get('cart'))->where('order_id',null)->where('vendor_id',$vendor)->first())){
                request()->session()->flash('error','Cart is Empty !');
                return back();
            }
            $user = Customer::firstOrCreate(['email' =>  $data['email']]);
            Cart::where('session_id', Session::get('cart'))->where('order_id', null)->where('vendor_id',$vendor)->update(['customer_id' => $user->id]);
        }



        $vendor = intval($request->vendor);
        $order=new Order();
        $order_data=$request->all();
        $order_data['order_number']='ORD-'.strtoupper(Str::random(10));
        $order_data['customer_id']=$user->id;
        $order_data['sub_total']=Helper::totalVendorCartPrice('',$vendor);
        $order_data['total_amount']=Helper::totalVendorCartPrice('',$vendor);
        $order_data['quantity']=Helper::cartCount();
        $order_data['vendor_id']= $vendor;

        $order_data['status']="new";
        $order->fill($order_data);
        $status=$order->save();
        if($order)
        // $users=User::first();
        // $details=[
        //     'title'=>'New order created',
        //     'actionURL'=>'#',
        //     // route('order.show',$order->id),
        //     'fas'=>'fa-file-alt'
        // ];
        // Notification::send($users, new StatusNotification($details));

        Cart::where('customer_id', $user->id)->where('order_id', null)->where('vendor_id',$vendor)->update(['order_id' => $order->id]);

        request()->session()->flash('success','Your ticket successfully placed in order');

        return redirect()->route('stripe.checkout', ['customer_email' => $user->email,'price' => $order->total_amount, 'order' => $order->order_number, 'order_id' => $order->id, 'vendor_id' => $order->vendor_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order=Order::find($id);
        return view('admin.order.show')->with('order',$order);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order=Order::find($id);
        return view('admin.order.edit')->with('order',$order);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $order=Order::find($id);
        $this->validate($request,[
            'status'=>'required|in:new,cancel'
        ]);
        $data=$request->all();
        // return $request->status;

        $status=$order->fill($data)->save();
        if($status){
            request()->session()->flash('success','Successfully updated order');
        }
        else{
            request()->session()->flash('error','Error while updating order');
        }
        return redirect()->route('order.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order=Order::find($id);
        if($order){
            $status=$order->delete();
            if($status){
                request()->session()->flash('success','Order Successfully deleted');
            }
            else{
                request()->session()->flash('error','Order can not deleted');
            }
            return redirect()->route('order.index');
        }
        else{
            request()->session()->flash('error','Order can not found');
            return redirect()->back();
        }
    }

    // PDF generate
    // public function pdf(Request $request){
    //     $order=Order::getAllOrder($request->id);
    //     // return $order;
    //     $file_name=$order->order_number.'-'.$order->first_name.'.pdf';
    //     // return $file_name;
    //     $pdf=PDF::loadview('backend.order.pdf',compact('order'));
    //     return $pdf->download($file_name);
    // }
    // Income chart
    // public function incomeChart(Request $request){
    //     $year=\Carbon\Carbon::now()->year;
    //     // dd($year);
    //     $items=Order::with(['cart_info'])->whereYear('created_at',$year)->where('status','delivered')->get()
    //         ->groupBy(function($d){
    //             return \Carbon\Carbon::parse($d->created_at)->format('m');
    //         });
    //         // dd($items);
    //     $result=[];
    //     foreach($items as $month=>$item_collections){
    //         foreach($item_collections as $item){
    //             $amount=$item->cart_info->sum('amount');
    //             // dd($amount);
    //             $m=intval($month);
    //             // return $m;
    //             isset($result[$m]) ? $result[$m] += $amount :$result[$m]=$amount;
    //         }
    //     }
    //     $data=[];
    //     for($i=1; $i <=12; $i++){
    //         $monthName=date('F', mktime(0,0,0,$i,1));
    //         $data[$monthName] = (!empty($result[$i]))? number_format((float)($result[$i]), 2, '.', '') : 0.0;
    //     }
    //     return $data;
    // }
}
