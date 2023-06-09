<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Product;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;
use Darryldecode\Cart\CartCondition;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cart_items = \Cart::session(Auth::user())->getContent() ; 
        return view('cart.index', compact('cart_items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function coupon(Request $request)
    {
        $input = $request->coupon;
        $coupon = Coupon::where('code', $input)->first();
        if(!$coupon)
        {
            return back()->with('error', 'Invalid Coupon');
        }else {

            if ($coupon->discountType == 'fixed') {
                $dType = '';
            }elseif($coupon->discountType == 'percent'){
                $dType = '%' ;
            }

            $condition = new CartCondition([
                'name' => $coupon->name,
                'type' => 'discount',
                'target' => 'total',
                'value' => '-'. $coupon->value .$dType,
            ]);
            \Cart::session(Auth::user())->condition($condition);
        }
        
        return back()->with('success', $coupon->value .$dType . ' discount coupon applied');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function add(Product $product)
    {
        \Cart::session(Auth::user())->add(array(
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => 1,
            'attributes' => array(),
            'associatedModel' => $product
        ));
        // dd($product);

        return redirect (route('cart.index'));
    }

    /**
     * Display the specified resource.
     */
    public function checkout()
    {
        $total_price = \Cart::session(Auth::user())->getTotal() ;
        return view('cart.checkout', compact('total_price'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update_add(Request $request, string $itemId)
    {
        \Cart::session(Auth::user())->update($itemId, ['quantity' => 1 ]);
             // so if the current product has a quantity of 4, another 1 will be added so this will result to 5
        
        
        // $qty = $request->quantity;
        // \Cart::session(Auth::user())->update($itemId, [
        //     'quantity' => [
        //         'relative' => false,
        //         'value' => $qty,
        //     ],
        //   ]);
        return back();
    }

    public function update_remove(Request $request, string $itemId)
    {
        // so if the current product has a quantity of 4, another 1 will be removed so this will result to 3
        \Cart::session(Auth::user())->update($itemId, ['quantity' => -1 ]);
          

        // $qty = $request->quantity;
        // \Cart::session(Auth::user())->update($itemId, [
        //     'quantity' => [
        //         'relative' => false,
        //         'value' => $qty,
        //     ],
        //   ]);
        return back();
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $productId)
    {   
        \Cart::session(Auth::user())->remove($productId);
        return back();
    }
}
