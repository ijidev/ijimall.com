<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\SubOrder;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
    //
   public function allorder(Order $order)
   {
      $currency = Auth::user()->currency;
      $orders = $order->orderBy('id','desc')->get();
      return view('admin.pages.order.index', compact('orders', 'currency'));

   }

   public function details(Order $order, $orderId)
   {
      $currency = Auth::user()->currency;
      $order = $order->findOrFail($orderId);
      
      return view('admin.pages.order.view', compact('order', 'currency'));
   }

   public function find($orderId){
      $orders = Order::where('id', $orderId)->get();
      return view('admin.pages.order.index', compact('orders'));
   }

   public function update(Request $request, $orderId)
   {
      $order = Order::findOrFail($orderId);
      $request -> validate([
         'status' => '',
      ]);
      // dd($request->status);
      $order->status = $request->status;
      $order->update();
      return back();
   }

   public function updateSub(Request $request, $orderId)
   {
      $order = SubOrder::findOrFail($orderId);
      $request -> validate([
         'status' => '',
      ]);
      // dd($request->all());
      $order->status = $request->status;
      $order->update();

      

      if ($order->status == 'completed') {
         $commission = $order->trans_log[0]->vendor_commission;
         $wallet = $order->vendor->wallet; #find vendor wallet
         $wallet->hold_bal -= $commission ; #deduct order amount from hold balance
         $wallet->active_bal += $commission ; #credit order amount to vendor active bal
         // dd($wallet);
         $wallet->update();
      }
      return back();
   }

   public function delete(Order $order, $orderId)
   {
      // $items = DB::select('select * from order_items where order_id =' .$orderId);
      $items= OrderItem::where('order_id', $orderId)->get();
      $order = $order->findOrFail($orderId);
      // dd($item);

      foreach ($items as $item){
         $item->delete();
         // DB::delete('delete order_items where id ='.$item->id);
      }
      
      $order->delete();
      return back();
   }

   public function subOrder(){
      $suborders = SubOrder::orderBy('order_id','desc')->get();
      return view('admin.pages.order.suborder',compact('suborders'));
      // dd($suborder);
  }

  public function manageSub($id)
  {
      $order = SubOrder::find($id);
      return view('admin.pages.order.manage-sub', compact('order'));
  }
}
