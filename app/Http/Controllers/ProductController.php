<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Menampilkan detail produk (GET /produk/{slug})
    public function show(string $slug)
    {
        // FirstOrFail akan melempar 404 jika produk tidak ditemukan
        $product = Product::where('slug', $slug)->with('category')->firstOrFail();

        return view('products.show', compact('product'));
    }
}