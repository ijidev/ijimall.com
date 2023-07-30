<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\User;
// use App\Http\Requests\StoreShopRequest;
use App\Models\VendorInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateShopRequest;

class ShopController extends Controller
{

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
    {   
        $info = new VendorInfo();
        $info->shop_id = Auth::user()->shop->id;
        $info->save();
        // dd($shop);
        // $shops =$shop->findOrFail($shop->id);
        
            return view('shop.wizard.welcome');
          
    }

    public function accountInfo()
    {
        return view('shop.wizard.accountInfo');
    }
    
    public function paymentInfo(Request $request)
    {
        $info = VendorInfo::where('shop_id', Auth::user()->shop->id)->first();
        $info->manager_fname = $request->firstName ;
        $info->manager_lname = $request->lastName;
        $info->contact_phone = $request->phone;
        $info->additional_phone = $request->add_phone;
        $info->email = $request->email;
        // dd($info);
        $info->update();
        return view('shop.wizard.payment');
    }

    public function skipInfo()
    {
        return redirect()->route('wizard.payment');
    }

    public function finish(Request $request)
    {
        $info = VendorInfo::where('shop_id', Auth::user()->shop->id)->first();
        $info->account_name = $request->Name;
        $info->bank = $request->bankName;
        $info->account_number = $request->accountNumber;
        // dd($info);
        $info->update();
        return view('shop.wizard.finish');
    }

    public function storeInfo()
    {
        $store = Shop::where('vendor_id', Auth::user()->id)->first();
        // dd($store);
        $info = VendorInfo::where('shop_id', $store->id)->get();
        return view('shop.includes.storeinfo', compact('store','info'));
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
