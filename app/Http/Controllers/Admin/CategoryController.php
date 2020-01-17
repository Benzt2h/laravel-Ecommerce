<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        /*  $categories = Category::all();
        return view('admin.CategoryForm', compact("categories")); */
        return view('admin.CategoryForm')->with('categories', Category::paginate(5));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories',
        ]);
        //insert Date to Table
        $category = new Category;
        $category->name = $request->name;
        $category->save();
        return redirect('/admin/createCategory');
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.EditCategoryForm', ['category' => $category]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:categories',
        ]);
        $category = Category::find($id);
        $category->name = $request->name;
        $category->save();
        return redirect('/admin/createCategory');
    }

    public function delete($id)
    {
        Category::destroy($id);
        return redirect('/admin/createCategory');
    }

}
