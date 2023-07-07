<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Mail\OrderPaid;
use App\Models\SubOrder;
use App\Models\Commission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
// use App\Http\Requests\StoreOrderRequest;
// use App\Http\Requests\UpdateOrderRequest;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->checkbox);
        $request -> validate([
            'shipping_fname'    => 'required',
            'shipping_lname'    => 'required',
            'shipping_address'  => 'required',
            'shipping_phone'    => 'required',
            'shipping_country'  => 'required',
            'shipping_state'    => 'required',
            'shipping_zipcode'  => 'required',
            'shipping_city'     => 'required',
            'order_id'          => 'unique:orders',
        ]);

        $order = new Order();
        $cart = Cart::where('user_id',Auth::user()->id)->get();

        $order->order_number = uniqid('ICO-');

        $order->shipping_fname     = $request->shipping_fname;
        $order->shipping_lname     = $request->shipping_lname;
        $order->shipping_address   = $request->shipping_address;
        $order->shipping_phone     = $request->shipping_phone;
        $order->shipping_country   = $request->shipping_country;
        $order->shipping_state     = $request->shipping_state;
        $order->shipping_city      = $request->shipping_city;
        $order->shipping_zipcode   = $request->shipping_zipcode;

        if (!$request->checkbox == 'on') {
            $order->billing_fname   = $request->shipping_fname;
            $order->billing_lname   = $request->shipping_lname;
            $order->billing_address = $request->shipping_address;
            $order->billing_phone   = $request->shipping_phone;
            $order->billing_country = $request->shipping_country;
            $order->billing_state   = $request->shipping_state;
            $order->billing_city    = $request->shipping_city;
            $order->billing_zipcode = $request->shipping_zipcode;
        }else {
            $order->billing_fname   = $request->billing_fname;
            $order->billing_lname   = $request->billing_lname;
            $order->billing_address = $request->billing_address;
            $order->billing_phone   = $request->billing_phone;
            $order->billing_country = $request->billing_country;
            $order->billing_state   = $request->billing_state;
            $order->billing_city    = $request->billing_city;
            $order->billing_zipcode = $request->billing_zipcode;
        }
        
        $order->grand_total = $cart->sum('amount');
        $order->item_count = $cart->count();
        $order->user_id = Auth::user()->id;
        // $order->timestamps = now();
        // dd($request->payment);

        // $order->save();

        
        // check payment methold and redirect
        if ($request->payment == 'bank') {
            //run payment oppration
             #code... 

            // set payment methold to payment option
            $order->payment_methold = $request->payment ;
        }else {
            //run payment oppration
             #code... 
             
            // set payment methold to payment option
            $order->payment_methold = $request->payment ;
        }
        //set its paid true
        $order->is_paid = true ;
        $order->status = "processing" ;
        // dd($order->user->email);
        $order->save();

        //genarate order trans_log
        $order->trans_log()->create([
            'trans_ref' => uniqid(),
            'amount'    => $order->grand_total,
            'status'    => 'success',
            'type'      => 'purchase',
            'user_id'   => Auth::user()->id,
            'order_id'  => $order->id
        ]);

        //save items to order_items
        $cartItems = $cart;
        foreach($cartItems as $item){
            // dd($item);
            $order->items()->attach($item->product_id, [
                'price' => $item->amount,
                'quantity' => $item->quantity
            ]);
        }  

        $order->generateSubOrder();

        $suborders = $order->subOrder;

        $commission = Commission::find(1);
        foreach ($suborders as $suborder) 
        {
            if ($commission->type == '%') {
                //find admin percent
                $a_c = ($suborder->grand_total % 100) * $commission->value ;
                //subtract percent from order amount
                $amount = $suborder->grand_total - $a_c;
            } else {
                $a_c = $commission->value;
                $amount = $suborder->grand_total - $a_c;
            }
            // dd($order->id);
            $suborder->trans_log()->create([
            'trans_ref'             => uniqid(),
            'total'                 => $suborder->grand_total,
            'vendor_commission'     => $amount,
            'admin_commission'      => $a_c,
            'status'                => 'success',
            'type'                  => 'purchase',
            'vendor_id'             => $suborder->vendor_id,
            'user_id'               => Auth::user()->id,
            'suborder_id'           => $suborder->id
            ]);
        }

        //credit vendor
        // dd( $order->id);
        $suborders = SubOrder::where('order_id', $order->id)->get();
        foreach ($suborders as $suborder) 
        {
            $wallet = $suborder->vendor->wallet;
            // dd($suborder->trans_log[0]->vendor_commission);
            $wallet->hold_bal = $wallet->hold_bal + $suborder->trans_log[0]->vendor_commission;
            $wallet->update();
        }

        // return redirect(route('order.payment'));

        //clear cart item
        foreach ($cart as $cart) {
            # cleat cart items...
            $cart->delete();
        }
        
        //send mail
        // Mail::to($order->user->email)->send(new OrderPaid($order));
        //redirect to thank you page
        $p = $request->payment ;
        return redirect()->route('home')->with('success' , 'thank you for your order: your order is been processed- payment methold is '.$p );
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
