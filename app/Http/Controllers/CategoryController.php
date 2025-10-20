<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Menampilkan daftar produk per kategori (GET /kategori/{slug})
    public function show(string $slug)
    {
        // FirstOrFail akan melempar 404 jika kategori tidak ditemukan
        $category = Category::where('slug', $slug)->with('products')->firstOrFail();

        return view('categories.show', [
            'category' => $category,
            'products' => $category->products,
        ]);
    }
}