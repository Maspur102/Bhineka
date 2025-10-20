<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    // Menampilkan halaman utama dan Pencarian (GET /?q=keyword)
    public function index(Request $request): View
    {
        $categories = Category::all();
        $query = $request->get('q');
        
        if ($query) {
            // Logika Pencarian
            $products = Product::where('name', 'like', '%' . $query . '%')
                               ->orWhere('description', 'like', '%' . $query . '%')
                               ->latest()
                               ->get();
            
            $title = 'Hasil Pencarian untuk: "' . $query . '"';

        } else {
            // Halaman Utama Normal
            $products = Product::latest()->limit(8)->get(); // Ambil 8 produk terbaru
            $title = 'Produk Terbaru';
        }

        return view('home', compact('categories', 'products', 'title', 'query'));
    }
}