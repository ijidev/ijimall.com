<?php

namespace App\Http\Controllers;

use App\Models\Withdrawal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WithdrawalController extends Controller
{
    #Admin withdrawal Starts
    public function withdrawRequest()
    {
        $currency = Auth::user()->currency;
        $withdraws = withdrawal::where('status','pending')->orderBy('id', 'desc')->get();
        $withdrawals = withdrawal::where('status','!=','pending')->orderBy('id', 'desc')->get();
        // dd($withdrawals);
        return view('admin.pages.shop.withdrawal', compact('withdraws','withdrawals','currency'));
    }

    public function view($id)
    {
        $currency = Auth::user()->currency;

        $withdraw = withdrawal::findOrFail($id);
        return view('admin.pages.shop.view-request',compact('withdraw','currency'));
    }

    public function approve($id)
    {
        $withdraw = withdrawal::findOrFail($id);
        $withdraw->status = 'approved';
        $withdraw->update();
        return back()->with('success','Pay Out sent Sucessfully');
    }

    public function decline($id)
    {
        $withdraw = withdrawal::findOrFail($id);
        $wallet = $withdraw->shop->vendor->wallet;
        $withdraw->status = 'declined';
        // dd($wallet);
        $withdraw->update();
        $wallet->active_bal += $withdraw->amount;
        $wallet->update();
        return back()->with('error','Pay Out Declined and successfully refunded to vendor wallet');
    }

    public function delete($id)
    {
        $withdraw = withdrawal::findOrFail($id);
        $withdraw->delete();
        return back()->with('error','Withdrawal deleted sucessfully');
    }

    #Admin withdrawal ends
    #
    #
    #
    #vendor withdrawal Starts
    public function withdrawal()
    {
        $withdraws = Withdrawal::where('shop_id', Auth::user()->shop->id)->orderBy('id','desc')->get();
        $wallet = Auth::user()->wallet;
        $currency = Auth::user()->currency;
        // dd($wallet);
        return view('shop.includes.withdrawal', compact('withdraws', 'wallet','currency'));
    }

    public function reqWithdraw(Request $request)
    {   
        $withdraw = new withdrawal();
        $wallet = Auth::user()->wallet;
        $currency = Auth::user()->currency;
        $amount = $request->amount / $currency->rate;
        // dd($amount);
        if ($amount <= $wallet->active_bal)
        {
            $wallet->active_bal -= $amount;
            $wallet->update();

            $withdraw->amount = $amount;
            $withdraw->shop_id = Auth::user()->shop->id;
            $withdraw->status = 'pending';
            $withdraw->save();
            return back()->with('success','Withdrawal request submitted successfully');

        }else{
            return back()->with('error','You can not withdraw more than you have in your active wallet balance');
        }
    }

    #vendor withdrawal ends
}
