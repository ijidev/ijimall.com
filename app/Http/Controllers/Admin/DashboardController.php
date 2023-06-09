<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
    
    public function addCategory(){
        return view('admin.pages.categories');
    }
    
    
}
