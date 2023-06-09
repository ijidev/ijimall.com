<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// use App\Http\Requests\StoreCategoryRequest;
// use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Category $category)
    {
        $categories = $category->get();
        return view('admin.pages.categories', compact('categories'));
    }

    public function action(Request $request)
    {
        foreach ($request->selected as $id) 
        {
            if ($request->action == 'delete') {
                # delete all selected...
                foreach($request->selected as $activeId){
                   $cat = Category::find($activeId);
                   $cat->delete();
                };
            }
            // dd($request->all());
            return back();
        }
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
           
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $cat = new Category();
        
        $request -> validate([
            'category' => 'required|unique:categories,name',
        ]);
        // dd($request->all());

        if ($request->parent == null) {
            # code...
            $cat->name = $request->category;
            $cat->save();
        } else {
            # code...
            $cat->name = $request->category;
            $cat->parent_id = $request->parent;

            $cat->save();
        }

        return back();
        


    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {

        return view('');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category, $catid)
    {
        $category = $category->find($catid);
        $categories = Category::get(); 
        // $categories= $categories->subcat()->get();
        return view('admin.pages.edit-cat', compact('categories', 'category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $catid)
    {
        //
        $subcat = Category::find($catid);
        // dd($request->all());
        $request -> validate([
            'name'  => 'required|string|unique:categories,name,'.$catid.'id',
            'parent' => ''
        ]);

        $subcat->name = $request->name;
        $subcat->parent_id = $request->parent;
        $subcat->image = $request->image;
        // dd($subcat);
        $subcat->update();

        return redirect()->route('admin.categories');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $cat, $catid)
    {
        // $item = DB::select('select * from sub_categories where id ='. $catid);
        $item = $cat->find($catid);
        // dd($item);
        $item->delete();

        return back();
    }
}
