<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        return view('admin.ProductDashboard')->with('products', Product::paginate(3));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'category' => 'required',
            'price' => 'required|numeric',
            'image' => 'required|file|image|mimes:jpeg,png,jpg|max:5000',
        ]);

        $strimageReFormat = base64_encode('_' . time());
        $ext = $request->file('image')->getClientOriginalExtension();
        $imageName = $strimageReFormat . "." . $ext;

        $imageEncoded = File::get($request->image);
        Storage::disk('local')->put('public/product_image/' . $imageName, $imageEncoded);

        $product = new Product;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->category_id = $request->category;
        $product->price = $request->price;
        $product->image = $imageName;
        $product->save();
        return redirect('admin/dashboard');
    }

    public function create()
    {
        return view('admin.ProductForm')->with('categories', Category::all());
    }

    public function edit($id)
    {
        $product = Product::find($id);
        return view('admin.editProductForm')->with('product', $product)->with('categories', Category::all());
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'category' => 'required',
            'price' => 'required|numeric',
        ]);
        $product = Product::find($id);
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        if ($request->category) {
            $product->category_id = $request->category;
        }
        $product->save();
        return redirect('admin/dashboard');

    }

    public function editImage($id)
    {
        return view('admin.editProductImage')->with('product', Product::find($id));
    }

    public function updateImage(Request $request, $id)
    {
        $request->validate([
            'image' => 'required|file|image|mimes:jpeg,png,jpg|max:5000',
        ]);

        if ($request->hasFile("image")) {
            $product = Product::find($id);
            $exists = Storage::disk('local')->exists("public/product_image/" . $product->image);
            if ($exists) {
                Storage::delete("public/product_image/" . $product->image);
            }
            $request->image->storeAs("public/product_image/", $product->image);
            return redirect('admin/dashboard');
        }
    }

    public function delete($id)
    {
        $product = Product::find($id);
        $exists = Storage::disk('local')->exists("public/product_image/" . $product->image);
        if ($exists) {
            Storage::delete("public/product_image/" . $product->image);
        }

        Product::destroy($id);
        return redirect('admin/dashboard');
    }
}
