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
      $orders = $order->latest()->paginate(20);
      return view('admin.pages.order.index', compact('orders', 'currency'));

   }

   public function multiselect(Request $request)
   {
      $id = $request->selected ;
      $orders = Order::findOrFail($id);
      if ($request->action == 'delete') {
         // dd($order);
         foreach ($orders as $order) {

            #delete suborder
            $subs = $order->subOrder;
            foreach ($subs as $sub) {
              
               #delete suborder items
               $items = $sub->orderItems;
               foreach ($items as $item) {
                  $item->delete();
               }

               $sub->delete();
            }

            # delete order items...
            $items = $order->orderItems;
            foreach ($items as $item) {
               $item->delete();
            }
            $order->delete();
         }
         return back();
      }else{
         // dd($orders);
         foreach ($orders as $order) {
            $order->status = $request->action;
            $order->update();
         }
         return redirect()->route('admin.orders');
      }
   }

   public function details(Order $order, $orderId)
   {
      $currency = Auth::user()->currency;
      $order = $order->findOrFail($orderId);
      
      return view('admin.pages.order.view', compact('order', 'currency'));
   }

   public function find($orderId){
      $currency = Auth::user()->currency;
      $orders = Order::where('id', $orderId)->paginate();
      return view('admin.pages.order.index', compact('orders','currency'));
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
      $parent = $order->order;
      $sub = SubOrder::where('order_id', $parent->id)->get();

      $request -> validate([
         'status' => '',
      ]);
      // dd($request->all());
      $order->status = $request->status;
      $order->update();

      if ($order->status == 'completed') 
      {
         $commission = $order->trans_log->first()->vendor_commission;
         $wallet = $order->vendor->wallet; #find vendor wallet
         $wallet->hold_bal -= $commission ; #deduct order amount from hold balance
         $wallet->active_bal += $commission ; #credit order amount to vendor active bal
         // dd($wallet);
         $wallet->update();
      }
      elseif ($order->status == 'refunded')
      {
         $wallet = $order->user->wallet;
         $wallet->active_bal += $order->grand_total;
         $wallet->update();
         // return back()->with('success','order ');
      }

      if ($sub->where('status','completed')->count() == $sub->count()) 
      {
         //   dd('true');
         $parent->status = 'ready-to-ship' ;
         $parent->update();

      } 
      elseif($sub->where('status','refunded')->count() == $sub->count())
      {
         $parent->status = 'refunded';
         $parent->update();
      }
      elseif($sub->where('status','failed-inspection')->count() == $sub->count())
      {
         $parent->status = 'declined';
         $parent->update();
      }

      return back();
   }

   public function delete($orderId)
   {
      // $items = DB::select('select * from order_items where order_id =' .$orderId);
      $order = Order::findOrFail($orderId);
      $items= $order->orderItems;
      $subs= $order->subOrder;
      // $subitems= $subs->items;
      // dd($items);

      # delete subOrder...
      foreach ($subs as $sub) {
         # delete subOrderItems...
         foreach ($sub->orderItems as $item) 
         {
            $item->delete();
         }
         $sub->delete();
      }

      foreach ($items as $item){
         $item->delete();
      }
      // DB::delete('delete order_items where id ='.$item->id);
      
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
      $currency = Auth::user()->currency;
      return view('admin.pages.order.manage-sub', compact('order','currency'));
  }
}
