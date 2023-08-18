<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\User;
// use App\Http\Requests\StoreShopRequest;
use App\Models\Product;
use App\Models\SubOrder;
use App\Models\VendorInfo;
use App\Models\Withdrawal;
use App\Charts\VendorChart;
use Illuminate\Http\Request;
use App\Models\SubTransaction;
use App\Charts\VendorSalesChart;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateShopRequest;

class ShopController extends Controller
{

    public function index()
    {
        if(Auth::user()->hasRole('vendor'))
        {
            $user = Auth::user();
            $order = SubOrder::where('vendor_id', $user->shop->id)
                    ->where('status','completed')->get();
            $revenue = $order->sum('grand_total');
            $suborders = Suborder::where('vendor_id', $user->shop->id)
                    ->where('status','!=','completed')->latest()->paginate(10);
            
            
            // $trans = [] ;
            // $trans = SubTransaction::whereIn('suborder_id', $id)
            //         ->where('type','purchase')->get();
            // dd($trans);


            $currency = $user->currency;
            $products = Product::where('vendor_id', $user->shop->id)->get();
            $active = $products->where('status', 'published')->count();
            $pending = $products->where('status', 'pending')->count();
            $draft = $products->where('status', 'draft')->count();
            $trash = $products->where('status', 'trash')->count();
            
            $productchart = new VendorChart;
            $productchart->labels(['Active', 'pending', 'Draft', 'Trashed', ]);
            $productchart->dataset('Product', 'doughnut', [$active, $pending, $draft, $trash])
            ->options([
                'backgroundColor' => ['green','orange','gray','red'],
            ]);
                
            // montly withdrawal chart record
            $withdrawal = Withdrawal::where('status', 'approved')
                ->where('shop_id',$user->shop->id);
            $withdrawal = $withdrawal->selectRaw('MONTH(created_at) as month, COUNT(*) as count, SUM(amount) as total')
                        ->whereYear('created_at', date('Y'))
                        ->groupBy('month')
                        ->orderBy('month')
                        ->get();
            // dd($withdrawal);
                
            // montly sales record
            $sales = SubOrder::where('vendor_id', $user->shop->id)
                        ->where('status','completed');
            $sales = $sales->selectRaw('MONTH(created_at) as month, COUNT(*) as count, SUM(grand_total) as total')
                            ->whereYear('created_at', date('Y'))
                            ->groupBy('month')
                            ->orderBy('month')
                            ->get();

            // montly earning
            if ($order->count() >= 1) {
                
                foreach ($order as $order) {
                    $id[] = $order->id;
                }
            }else{
                $id = [];
            }
            // dd($id);

            $subtrans = SubTransaction::whereIn('suborder_id', $id);
            $earns = $subtrans->selectRaw('MONTH(created_at) as month, SUM(vendor_commission) as total')
                            ->whereYear('created_at', date('Y'))
                            ->groupBy('month')
                            ->orderBy('month')
                            ->get();
            
            $earning = $earns->sum('total');
            // dd($earns->sum('total'));
            
            
            $lables = [];
            $salesdata = [];
            $earndata = [];
            $withdraws = [];
            // $month = date('m');

            //defining months and mapping respective data 
            for ($i=1; $i <= 12; $i++) { 
                $month = date('F', mktime(0,0,0,$i,1));
                $saletotal = 0;
                $earntotal = 0;
                $withdrawtotal = 0;
                $count = 0;
                
                
                foreach ($withdrawal as $withdraw) {
                    if ($withdraw->month == $i) {
                        $withdrawtotal = $withdraw->total;
                        break;
                    }
                }

                foreach ($sales as $sale) {
                    if ($sale->month == $i) {
                        $saletotal = $sale->total;
                        $count = $sale->count;
                        break;
                    }
                }
                
                foreach ($earns as $earn) {
                    if ($earn->month == $i) {
                        $earntotal = $earn->total;
                        break;
                    }
                }
                array_push($lables, $month);
                array_push($salesdata, $saletotal);
                array_push($earndata, $earntotal);
                array_push($withdraws, $withdrawtotal);
            }
            # covert withdrawal amount to user currency...
            foreach ($withdraws as $dat) {
                $withdrawaldata[] = number_format($dat * $currency->rate ,2) ;
            }
            # covert sales amount to user currency...
            foreach ($salesdata as $dat) {
                $saledata[] = number_format($dat * $currency->rate ,2) ;
            }

            # covert earning amount to user currency...
            foreach ($earndata as $earndat) {
                $earnsdata[] = number_format($earndat * $currency->rate ,2) ;
            }
            // dd($data);

            //creating bar sales and earning chart
            $saleschart = new VendorSalesChart;
            $saleschart->labels($lables);
            $saleschart->dataset('sales', 'bar', ($saledata))
                        ->options([
                            'backgroundColor' => 'green',
                        ]);
            $saleschart->dataset('Earning', 'bar',($earnsdata))
                        ->options([
                            'backgroundColor' => 'orange',
                        ]);
            $saleschart->dataset('Withdrawal', 'bar',($withdrawaldata))
                        ->options([
                            'backgroundColor' => 'red',
                            
                        ]);
            

            return view('shop.shop', 
                compact(
                    'saleschart',
                    'productchart',
                    'earning',
                    'suborders',
                    'order',
                    'revenue',
                    'withdrawal',
                    'currency'
                )
            );
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
