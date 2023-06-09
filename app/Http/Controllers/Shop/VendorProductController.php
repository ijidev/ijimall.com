<?php

namespace App\Http\Controllers\Shop;

use App\Models\Shop;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class VendorProductController extends Controller
{
    public function index()
    {   
        $user = Auth::user();
        $vendorId = $user->shop->id;
        $products = DB::select('select * from products where vendor_id ='. $vendorId);
        // dd($products);
        // $products = Product::find($productV);
        return view('shop.product.index', compact('products'));
    }
 
    public function create(){
        return view('shop.product.create');
    }

    public function store(Request $request, Shop $shop )
    {
        $product = new Product();
        $user = Auth::user(); 
        // dd($shop);

        $request -> validate([
            'name' => 'required',
            'price' => ['required', 'integer'],
            'description' => '',
            'cover_img' => '',
        ]);

        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->vendor_id = $user->shop->id;
        // $product->name = $request->name;
        // dd($request->all());
        $product->save();

        if($request->keepme == 'on'){
            return redirect()->back();
        }else{
            return redirect(route('vendor.product'));
        }

    }
 
    
    public function view()
    {

    }

    public function edit($productId)
    {
        $product = Product::find($productId);
        return view('shop.product.update', compact('product'));

    }
 
    
    public function update(Request $request ,$productId)
    {
        $product = Product::find($productId);

        $request -> validate([
            'name' => 'required',
            'price' => ['required', 'integer'],
            'description' => '',
            'cover_img' => '',
        ]);

        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        // $product->vendor_id = Auth::user()->id;
        // $product->name = $request->name;

        $product->update();
        return redirect(route('shop.product'));
    }
 
    
    public function delete($productId)
    {
        $product = Product::find($productId);
        $product->delete($productId);
        return back();
    }
 
    
}
