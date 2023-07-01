<?php

namespace App\Http\Controllers\Admin;

use App\Models\Shop;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VendorController extends Controller
{
    public function index(Shop $shop)
    {
        $shops =  $shop->get();
        return view('admin.pages.shop.shops', compact('shops'));
    }

    public function view($shopId)
    {
        $shop =  Shop::findOrFail($shopId);
        return view('admin.pages.shop.shop', compact('shop'));
    }

    public function update(Request $request, $shopId)
    {   $shop = Shop::findOrFail($shopId);
        $request -> validate([
            'is_active' => '',
        ]);
        // dd($shop);
        $shop->is_active = $request->status;
        $shop->update();
        return back();
    }
    

    public function delete($shopId, Product $product)
    {
        $shop = Shop::find($shopId);
        $user = User::findOrFail($shop->vendor->id);
        $products = $product->where('vendor_id', $shopId)->get('id');
        // dd($product->count());

        if ($products->count() <= 0) 
        {   
            $shop->delete();
            $user->removeRole('vendor');
            return back();
        }
        else 
        {
            $vendors = Shop::get();
            // dd($vendors);
            return view('admin.pages.shop.__shopdelete', compact('vendors', 'shopId', 'products'));
        }

        dd($product);
        
    }

    public function del(Request $request, $shopId )
    {
        $products = Product::where('vendor_id', $shopId)->get();
        $shop = Shop::find($shopId);
        $vendorId = $request->vendor;
        $newVendor = Shop::find($vendorId);
        // dd($products);

        if ($request->action == 'asign') 
        {
            foreach ($products as $product) 
            {
                $product->vendor_id = $vendorId;
                $product->update();
            }
            $shop->delete();
            return redirect()->route('admin.shopIndex')->with('success', 'Shop deletd, '. $product->count() .' Products Asigned to '. $newVendor->name);

        }elseif ($request->action == 'delete') 
        {
            $shop = Shop::find($shopId)->get();
            $product = Product::where('vendor_id', $shopId)->get();
            $suborder = SubOrder::where('vendor_id', $shopId)->get();
            $subitems = SubOrderItem::where('sub_order_id', $suborder->id)->get();
            // dd($request->all());

            // foreach($products as $product)
            // {
            //     $product->status = 'draft';
            //     $product->vendor_id = null;
            //     $product->update();
            // }
            $subitems->delete();
            $suborder->delete();
            $product->delete();
            $shop->delete();

            return redirect()->route('admin.shopIndex')->with('success','shop deleted successfully and ' . $products->count() .' related products moved to Draft');

        }
        
        // dd($request->all());

    }
}
