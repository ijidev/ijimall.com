<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    //
    public function allproduct(Product $product){
        $products = $product->where('status', '!=' ,'trash')->get();
        // dd($products);
        return view('admin.pages.products', compact('products'));
    }

    public function addproduct(Category $category){
        $categories = $category->get();
        return view('admin.pages.add-product', compact('categories'));
    }

    public function create(Request $request)
    {
        $product = new Product();
        $request -> validate([
            'name' => 'required|string',
            'category' => ' required ',
            'price' => 'required',
        ]);
        $product->name    =    $request->name;
        $product->price    =    $request->price;
        $product->description    =    $request->description;
        // dd($request->all());
        $product->save();
        // dd($product->id);

        // $product= $product->find($product->id);

        foreach($request->category as $categoryId)
        {
            // $categoryId = explode('-', $category)[1];
            // $subcategoryId = explode('-', $category)[2];
            
                $product->category()->attach($categoryId, [ 'product_id' =>$product->id]);
            
        }

        return('product created');

    }

    public function action(Request $request)
    {
        // dd($request->all());
        $activeId = $request->selected ;

        // foreach ($activeId as $productId) {
            // dd($products);
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

        //}
        
    }

    public function searchProduct(Request $request)
    {
        $query = $request->input('query');
        $search = Product::where('name', 'LIKE', "%$query%");
        $products = $search->where('status', '!=', 'trash')->get();
        return view('admin.pages.products', compact('products'));
    }

    public function trashedProduct(Product $product)
    {
       $products = $product->where('status', 'trash')->get();
        // dd($product);
        return view('admin.pages.trash', compact('products'));
    }

    public function draftProduct(Product $product)
    {
       $products = $product->where('status', 'draft')->get();
        // dd($product);
        return view('admin.pages.products', compact('products'));
    }

    public function pendingProduct(Product $product)
    {
       $products = $product->where('status', 'pending')->get();
        // dd($product);
        return view('admin.pages.products', compact('products'));
    }

    public function trash($productId)
    {
       $product = Product::find($productId); 
       $product->status = 'trash';
       $product->update();
       return back();
    }

    public function restore($productId)
    {
        $product = Product::find($productId) ;
        $product->status = 'draft';
        $product->update();
        return back();
    }


    public function delete(Product $product, $productId)
    {
        $product = $product->find($productId);
        
        $product->delete();

        return back();
    }

}
