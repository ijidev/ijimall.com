<?php

namespace App\Http\Controllers\Shop;

use App\Models\SubOrder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class VendorOrderController extends Controller
{
    public function index()
    {
        $currency = Auth::user()->currency;
        $orders = SubOrder::where('vendor_id', Auth::user()->id)->orderBy('id','desc')->paginate(20);
        // dd($orders);
        return view('shop.order.orders', compact('orders','currency'));
    }

    public function uncomplete()
    {
        $currency = Auth::user()->currency;
        $orders = SubOrder::where('vendor_id', Auth::user()->id)->where('status','!=', 'completed')
                            ->orderBy('id','desc')
                            ->paginate(20);
        // dd($orders);
        return view('shop.order.orders', compact('orders','currency'));
    }

    public function details(SubOrder $suborder, $orderId)
    {
        $currency = Auth::user()->currency;
        $order = $suborder->find($orderId);
        return view('shop.order.order-view', compact('order','currency'));
    }

    public function update(Request $request, $orderId)
    {
        $order = SubOrder::findOrFail($orderId);
        $request -> validate([
            'status' => '',
        ]);
        $order->status = $request->status ;
        $order->update();

        //   $subcount = $sub->count(); #get count of total suborders
        
        //   dd($parent);
      return back();
    }

    public function multiupdate(Request $request)
    { 
        // dd($request->all());
        $activeId = $request->selected;
        $orders = SubOrder::find($activeId);
        if ($orders == null) {
            # if notting is selected return error massage...
            return back()->with('error', 'select an item');
        } else {
            # code...
            foreach ($orders as $order) 
            {
                $order->status = $request->status;
                $order->update();
            }
            return redirect()->back();
        }

        
    }

    public function delete($orderId)
    {
        $order = SubOrder::find($orderId)->detete();
        $order;
        return back();
        
    }
}
