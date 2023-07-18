<?php

namespace App\Http\Controllers;

// use Cart;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\Currency;
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
        $items = Cart::where('user_id' , Auth::user()->id)->get() ; 
        $currency = Auth::user()->currency;
        $currencies = Currency::all();
        $cart = Cart::where('user_id', Auth::user()->id)->get();
        return view('cart.index', compact('items', 'currency', 'currencies','cart'));
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
        $useritem = Cart::where('user_id' , Auth::user()->id)->get();
        $item = $useritem->where('product_id', $product->id);
        // dd($item);
        if ($item->count() <= 0) {
            // dd('product not found');
            $cart = new Cart();
            $cart->user_id = Auth::user()->id ;
            $cart->product_id = $product->id ;
            $cart->quantity = 1 ;
            $cart->amount = $product->price ;
            $cart->save();
        } else {
            $item = $item[0];
            $item->quantity = $item->quantity + 1 ;
            $item->amount = $item->product->price * $item->quantity;
            // dd($item);
            $item->update();
        }
        


        // dd($cart->item);
        // \Cart::session(Auth::user())->add([
        //     'id' => $product->id,
        //     'name' => $product->name,
        //     'price' => $product->price,
        //     'quantity' => 1,
        //     'attributes' => array(),
        //     'associatedModel' => $product
        // ]);
        // dd($product);

        return redirect(route('cart.index'));
    }

    /**
     * checkout cart items.
     */
    public function checkout(Request $request)
    {
        $currency = Auth::user()->currency;
        $currencies = Currency::all();
        $cart = Cart::where('user_id', Auth::user()->id)->get();
        
        $total_price = $cart->sum('amount');
        // dd($total_price);
        return view('cart.checkout', compact('currency','currencies','cart','total_price',));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the resource quantity in storage.
     */
    public function updateCart(Request $request, string $itemId)
    {
        $item = Cart::find($itemId);
        $item->quantity = $request->quantity;
        $item->amount = $item->product->price * $request->quantity;

        $item->update();
        
        return back()->with('success', 'cart quantity updated');
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
        Cart::find($productId)->delete();
        return back()->With('success', 'item deleted successfully');
    }
}
