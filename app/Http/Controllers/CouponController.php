<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CouponController extends Controller
{
    //
    public function index()
    {
        $coupons = Coupon::where('shop_id', Auth::user()->shop->id)->paginate(20);
        $currency = Auth::user()->currency;
        $all = $coupons->count();
        $exp = $coupons->where('expired', true)->count();
        return view('shop.coupon.index',compact('coupons', 'currency', 'all' , 'exp'));
    }

    public function expired()
    {
        $expired = Coupon::where('expired', true);
        $coupons = $expired->where('shop_id', Auth::user()->shop->id)->paginate(20);
        $currency = Auth::user()->currency;
        $all = Coupon::where('shop_id', Auth::user()->shop->id)->count();
        $exp = $expired->count();
        return view('shop.coupon.index',compact('coupons', 'currency', 'all', 'exp'));
    }

    public function edit($id)
    {
        $coupon = Coupon::findOrFail($id);
        // dd($coupon);
        $currency = Auth::user()->currency;
        $products = Product::where('vendor_id', Auth::user()->shop->id);
        return view('shop.coupon.edit',compact('coupon','products','currency'));

    }
    
    public function update(Request $request, $id)
    {
        $request -> validate([
            'code' => 'required' ,
            'type' => 'required' ,
            'value' => 'integer|required' ,
            'usable' => 'integer' ,
            'description' => 'string' ,
        ]);

        $coupon = Coupon::findOrFail($id);
        
        $coupon->code = $request->code;
        $coupon->discountType = $request->type;
        $coupon->value = $request->value;
        $coupon->usable = $request->usable;
        $coupon->expired = $request->expired;
        $coupon->description = $request->description;

        $coupon->update();
        return back();
    }

    public function action(Request $request)
    {
        $coupons = Coupon::findOrFail($request->action);

        if($request->selected == 'expired')
        {
            foreach($coupons as $coupon)
            {
                $coupon->expired = true;
                $coupon->update();
            }
        }
        elseif($request->selected == 'delete')
        {
            foreach($coupons as $coupon)
            {
                $coupon->delete();
            }
        }

        return back();
    }

    public function store(Request $request)
    {
        $request -> validate([
            'code' => 'required' ,
            'type' => 'required' ,
            'value' => 'integer|required' ,
            'usable' => 'integer' ,
            'description' => 'string' ,
        ]);

        $coupon = new Coupon();
        $coupon->shop_id = Auth::user()->shop->id;
        $coupon->code = $request->code;
        $coupon->discountType = $request->type;
        $coupon->value = $request->value;
        $coupon->usable = $request->usable;
        $coupon->description = $request->description;

        $coupon->save();
        return redirect()->action([
            CouponController::class ,
            'index'
        ]);
    }

    public function delete($id)
    {
        $coupon = Coupon::findorFail($id);
        $coupon->delete();

        return back();
    }
}
