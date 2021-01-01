<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  App\Category;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{

    public function __construct()
{
    $this->middleware(['permission:read_categories'])->only('index');
    $this->middleware(['permission:create_categories'])->only('create');
    $this->middleware(['permission:delete_categories'])->only('destroy');
    $this->middleware(['permission:update_categories'])->only('edit');

}

    public function index()
    {
        $categories=Category::WhenSearch(request()->search)->paginate(5);
        return view('dashboard.categories.index' , compact('categories'));
    }


    public function create()
    {
        return view('dashboard.categories.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name'=>['required' , 'unique:categories,name'] ,
        ]);

        Category::create($request->all());
        session()->flash('Added','Data Added Successfully');
        return redirect()->route('dashboard.categories.index');
    }

    public function show(Category $category)
    {
        //
    }


    public function edit(Category $category)
    {
        return view('dashboard.categories.edit',compact('category'));
    }


    public function update(Request $request, Category $category)
    {
        $request->validate([
           'name'=>['required' , Rule::unique('categories')->ignore($category->id)]
        ]);

        $category->update($request->all());
        session()->flash('Added','Data Updated Successfully');
        return redirect()->route('dashboard.categories.index');

    }


    public function destroy(Category $category)
    {
        $category->delete();
        session()->flash('Added','Data Removed Successfully');
        return redirect()->back();

    }
}
