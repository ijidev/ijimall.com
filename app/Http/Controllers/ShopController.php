<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\User;
// use App\Http\Requests\StoreShopRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateShopRequest;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::user()->hasRole('vendor'))
        {
            return view('shop.shop');
        } 
        else
        {
            return view('shop.register');
            // return redirect(route('shops.index'));
        }
    }

    

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $request -> validate([
            'name'          => ['required', 'unique:shops'],
            'description'   => 'string',
        ]);
        $user = User::find(Auth::user()->id);
        $shop = new Shop();

        $shop->name = $request->name;
        $shop->decription = $request->description;
        $shop->vendor_id = Auth::user()->id;

        $shop->save();
        // $user->removeRole('vendor');
        $user->addRole('vendor');
        return redirect()->route('vendor.setup');
        
        // return $this->setup();
        // return redirect(route('vendor.index'));
    }

    public function wizard(Shop $shop)
    {   $shopId = $shop->where('vendor_id', Auth::user()->id)->get('id');
        $shops =$shop->findOrFail($shopId);
        foreach ($shops as $shop) {
            // dd($shop->id);
            return view('shop.__setupwizard', compact('shop'));
        }
        
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return redirect(route('/'))->with('success', 'store pending admin aproval');
    }

    /**
     * Display the specified resource.
     */
    public function show(Shop $shop)
    {
      
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Shop $shop)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $vendorId)
    {        
        dd($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shop $shop)
    {
        //
    }
}
