<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class OrdersController extends Controller
{
    //
   public function allorder(Order $order)
   {
      $orders = $order->get();
      return view('admin.pages.order.index', compact('orders'));

   }

   public function details(Order $order, $orderId)
   {
      $order = $order->findOrFail($orderId);
      
      return view('admin.pages.order.view', compact('order'));
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
      $order->update([
         'status' => $request->status
      ]);
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
}
