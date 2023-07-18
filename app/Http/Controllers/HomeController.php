<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use App\Models\Product;
use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = Product::where('status', 'published')->paginate() ;
        $currencies = Currency::all();
        if (Auth::guest()) {
            $currency = Currency::where('rate', 1)->get()[0];
            return view('home', compact('products', 'currencies', 'currency'));
        }else{
            $cart = Cart::where('user_id', Auth::user()->id)->get();
            $currency = Auth::user()->currency;
            return view('home', compact('products', 'currencies', 'currency','cart'));
        }
        // $base = Currency::where('rate', 1)->get()[0];
        // dd($base);
        // dd($products);
    }

    public function currency($name)
    {
        $user = User::find(Auth::user()->id);
        $currency = Currency::where('name', $name)->get()[0];
        // dd($currency);
        $user->currency_id = $currency->id;
        $user->update();
        return back();
        // dd($currency);
    }
}
