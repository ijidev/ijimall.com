<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function Dashboard(){
        return view('admin.dashboard');
    }

    public function massage(){
        return view('admin.pages.massage');
    }
    
    public function Categories(){
        return view('admin.pages.Categories');
    }
    


    
    
}
