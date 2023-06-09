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
        $orders = SubOrder::where('vendor_id', Auth::user()->id)->get();
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
      // dd($request->status);
      $order->update();
      return back();
    }

    public function multiupdate(Request $request)
    {
        // dd($request->all());
        foreach ($request->selected as $orderId) 
        {
            $order = SubOrder::find($orderId);
            $order->status = $request->status;
            $order->update();
        }
        return back();
    }

    public function delete($orderId)
    {
        $order = SubOrder::find($orderId)->detete();
        $order;
        return back();
        
    }
}
