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
        $orders = SubOrder::where('vendor_id', Auth::user()->id)->orderBy('id','desc')->get();
        // dd($orders);
        return view('shop.order.orders', compact('orders'));
    }

    public function details(SubOrder $suborder, $orderId)
    {
        $order = $suborder->find($orderId);
        return view('shop.order.order-view', compact('order'));
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
