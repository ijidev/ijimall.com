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
        $products = $product->get()->all();
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

        foreach ($request->selected as $id) 
        {
            if ($request->action == 'delete') {
                # delete all selected...
                foreach($request->selected as $activeId){
                   $product = Product::find($activeId);
                   $product->delete();
                };
                return back();
            }
        }
        
    }


    public function delete(Product $product, $productId)
    {
        $product = $product->find($productId);
        
        $product->delete();

        return back();
    }

}
