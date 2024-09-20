<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Image;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function create()
    {
        return view('layouts.products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_product' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'price' => 'required|numeric',
            'description' => 'required',
            'brand' => 'required',
        ]);

        // Lưu hình ảnh
        $imagePath = $request->file('image')->store('images', 'public');
        $image = Image::create(['image_data' => $imagePath]);

        // Tạo sản phẩm
        Product::create([
            'name_product' => $request->name_product,
            'description' => $request->description,
            'price' => $request->price,
            'brand' => $request->brand,
            'id_image' => $image->id_image,
        ]);

        return redirect()->route('products.index');
    }

    public function index()
    {
        $products = Product::with('image')->get();
        return view('layouts.products.index', compact('products'));
    }
}


