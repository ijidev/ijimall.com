<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Wallet;
use App\Models\Currency;
use Laratrust\Models\Role;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function users(){
        $users = User::get();
        // dd($users);
        $tableName = 'Users';
        return view('admin.pages.user.users', compact('users','tableName'));
    }
    
    
    public function addUser(){
        $roles = Role::get();
        return view('admin.pages.user.create', compact('roles'));
    }

    public function storeUser(Currency $currency, Request $request)
    {
        $user = new User();
        // $wallet = new Wallet();
        $base = $currency->where('rate', 1 )->get()[0];
        // $base = $currency->find($c);
        // dd($request->all());
        $request -> validate([
            'name' => ['required','unique:users,name'],
            'password' => ['required','string', 'min:8',],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
        ]);

        $role = $request->role;
        $user->name = $request->name;
        $user->currency_id = $base->id;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        // dd($role);
        $user->save();
        $user->addRole($role);
        $user->wallet()->create([
            'currency_id' => $base->id,
            'active_bal' => 0.00,
            'hold_bal' => 0.00,
            'user_id' => $user->id,
        ]);

        // $curency = new currency();
        // $user->currencies()->attach($base->id,[]);

        return redirect()->route('admin.users');
    }
    

    public function editUser($id)
    {
        $user = User::find($id);

        return view('admin.pages.user.create', compact('user'));
    }

    public function manageUser($id)
    {
        $user = User::find($id);
        $transactions = $user->trans_log()->orderBy('order_id','desc')->get();
        // dd($user->trans_log);
        return view('admin.pages.user.manage', compact('user', 'transactions'));
    }

    public function fundUser(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $wallet = $user->wallet;
        // dd($request->all());
        if($request->fund == 'debit')
        {
            $wallet->active_bal = $wallet->active_bal - $request->amount;
        }
        elseif($request->fund == 'credit')
        {
            $wallet->active_bal = $wallet->active_bal + $request->amount;
        }
        elseif($request->fund == 'to-hold')
        {
            if ($request->amount > $wallet->active_bal) {
                return back()->with('error', 'please enter an amount not greater than or equel to '.$wallet->active_bal );
            }else {
                $wallet->active_bal = $wallet->active_bal - $request->amount;
                $wallet->hold_bal = $wallet->hold_bal + $request->amount;
            }
        }
        elseif($request->fund == 'to-active')
        {
            if ($request->amount > $wallet->hold_bal) {
                return back()->with('error', 'please enter an amount not greater than or equel to '.$wallet->hold_bal );
            }else {
            $wallet->hold_bal = $wallet->hold_bal - $request->amount;
            $wallet->active_bal = $wallet->active_bal + $request->amount;
            }
        }
        $wallet->update();
        return back();
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::find($id);

        $request -> validate([
            'name' => 'required |unique:users,name,'. $id . ',id',
            'email' => 'required|unique:users,email,'.$id.',id',
            'password' => 'required'
        ]);

        $role = $request->role;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        // dd($user);

        $user->update();
        $user->addRole($role);

        return redirect()->route('admin.users');
    }
    
    public function vendorUser(){
        $users = User::whereHasRole('vendor')->get();
        // dd($users);
        $tableName = 'Vendors';
        return view('admin.pages.users', compact('users','tableName'));
    }
    
    
    public function customerUser(){
        $users = User::whereHasRole('customer')->get();
        $tableName = 'Customers';
        return view('admin.pages.users', compact('users','tableName'));
    }

    public function userAction(Request $request, User $user)
    {
        // dd($request->all());
        $activeId = $request->selected ;
            // dd($users);
            if ($request->action == 'delete') 
            {   
                // $user = User::find($activeId);
                $users = User::find($activeId);
                # delete all selected...
                foreach($users as $user)
                {
                    foreach ($user->role as $role) 
                    {
                        // dd($role->name);
                        $user->removeRole($role->name);
                    }
                    
                   $user->delete();
                }
                return back()->with('success','user deleted'); 
                
            }
            
            //move user to trash
            // elseif ($request->action == 'manage') 
            // {
            //     $users = user::find($activeId);
            //     foreach ($users as $user) {
            //         # move users to trash...
            //         // $user->status = 'trash';
            //         $user->delete();
            //     }
                
            //     return back();
            // }
        
    }

    public function userSearch(Request $request)
    {
        $query = $request->input('query');
        $users = User::where('name', 'LIKE', "%$query%")->get();
        $tableName = 'Query Result';
        // $users = $search->where('status', '!=', 'trash');
        return view('admin.pages.users', compact('users', 'tableName'));
    }

    public function emailSearch(Request $request)
    {
        $query = $request->input('query');
        $users = User::where('email', 'LIKE', "%$query%")->get();
        $tableName = 'Query Result';
        // $users = $search->where('status', '!=', 'trash');
        return view('admin.pages.users', compact('users', 'tableName'));
    }

    public function deleteUser($id)
    {
        $user = User::find($id);
        foreach ($user->role as $role) {
            # delete user role from database...
            $user->removeRole($role->name);
        }
        $user->delete();
        return back()->with('success', 'user deleted');
    }

    
}
