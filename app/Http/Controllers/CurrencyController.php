<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    //
    public function store(Request $request)
    {
        $currency = new Currency();
        $currency->name = $request->name;
        $currency->symbol = $request->symbol;
        $currency->rate = $request->rate;

        $currency->save();

        return back();
    }

    public function edit($id)
    {
        $curr = Currency::find($id);
        return view('admin.pages.edit-currency', compact('curr'));
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $currency = Currency::findOrFail($id);
        $currency->name = $request->name;
        $currency->symbol = $request->symbol;
        $currency->rate = $request->rate;
        
        if ($request->base == 'on') {
            $curr = Currency::all();
            foreach ($curr as $c) 
            {
                $c->rate = $c->rate / $currency->rate ;
                $c->update();
            }
        }
        $currency->update();
        return redirect()->route('admin.setting');
    }

    public function delete($id)
    {
        $currency = Currency::find($id);
        $currency->delete();
        return back();
    }
}
