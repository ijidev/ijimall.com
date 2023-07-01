<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Currency;
use App\Models\Commission;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    //
    public function index()
    {
        $commission = Commission::find(1);
        $currencies = Currency::get();
        // dd($commission);
        return view('admin.pages.settings', compact('commission' , 'currencies'));
    }

    public function update(Request $request)
    {
        $commission = Commission::find(1);

        // $commission->name = $request->name;
        $commission->type = $request->type;
        $commission->value = $request->value;
        $commission->update();
        return back();
    }
}
