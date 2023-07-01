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
        $product = Product::where('vendor_id', $vendorId);
        $products = $product->where('status', 'published')->get();
        // $products = DB::select('select * from products where vendor_id ='. $vendorId);
        // dd($products);
        // $products = Product::find($productV);
        return view('shop.product.index', compact('products'));
    }
 
    public function create()
    {
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
 
    
    public function allP()
    {
        $user = Auth::user();
        $vendorId = $user->shop->id;
        $vendorProduct = Product::where('vendor_id', $vendorId);
        $products = $vendorProduct->where('status', '!=' ,'trash',)->get();
        return view('shop.product.index', compact('products'));
        // dd($products);
    }

    public function pending()
    {
        $user = Auth::user();
        $vendorId = $user->shop->id;
        $vendorProduct = Product::where('vendor_id', $vendorId);
        $products = $vendorProduct->where('status', 'pending',)->get();
        return view('shop.product.index', compact('products'));
        // dd($products);
    }
 
    public function draft()
    {
        $user = Auth::user();
        $vendorId = $user->shop->id;
        $vendorProduct = Product::where('vendor_id', $vendorId);
        $products = $vendorProduct->where('status', 'draft',)->get();
        return view('shop.product.index', compact('products'));
        // dd($products);
    }

    public function trashed()
    {
        $user = Auth::user();
        $vendorId = $user->shop->id;
        $vendorProduct = Product::where('vendor_id', $vendorId);
        $products = $vendorProduct->where('status', 'trash',)->get();
        return view('shop.product.trash' , compact('products'));
        // dd($products);
    }

    public function restore($productId)
    {
        $product = Product::find($productId);
        $product->status = 'draft';
        $product->update();
        return back();
    }

    public function trash($productId)
    {
        $product = Product::find($productId);
        $product->status = 'trash';
        $product->update();
        return back();
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

    public function multiaction(Request $request)
    {
        // dd($request->all());
        $activeId = $request->selected ;

            if ($request->action == 'delete') 
            {
                $products = Product::find($activeId);
                # delete all selected...
                foreach($products as $product)
                {
                   $product->delete();
                }
                return back(); 
                
            }
            //restore product from trash 
            elseif ($request->action == 'restore') 
            {
                $products = Product::find($activeId);
                foreach($products as $product)
                {
                   $product->status = 'draft';
                   $product->update();
                }
                return back(); 
                
            }
            //move product to trash
            elseif ($request->action == 'trash') 
            {
                $products = Product::find($activeId);
                foreach ($products as $product) {
                    # move products to trash...
                    $product->status = 'trash';
                    $product->update();
                }
                
                return back();
            }
            
            elseif ($request->action == 'draft') 
            {
                $products = Product::find($activeId);
                foreach ($products as $product) {
                    # move products to trash...
                    $product->status = 'draft';
                    $product->update();
                }
                
                return back();
            }

            elseif ($request->action == 'pending') 
            {
                $products = Product::find($activeId);
                foreach ($products as $product) {
                    # move products to trash...
                    $product->status = 'pending';
                    $product->update();
                }
                
                return back();
            }

        
        
    }
 
    
}
