<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; // Pastikan Controller Base di-import
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource. (R - Read Index: GET /admin/products)
     */
    public function index(): View
    {
        $products = Product::with('category')->latest()->get();
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource. (C - Create Form: GET /admin/products/create)
     */
    public function create(): View
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage. (C - Create Logic: POST /admin/products)
     */
    public function store(Request $request): RedirectResponse
    {
        // 1. Validasi Data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Max 2MB
        ]);

        // 2. Upload Gambar (Jika ada)
        $imagePath = null;
        if ($request->hasFile('image')) {
            // Simpan file ke storage/app/public/products
            $imagePath = $request->file('image')->store('products', 'public');
        }

        // 3. Buat Slug dan pastikan unik
        $slug = Str::slug($validatedData['name']);
        $originalSlug = $slug;
        $count = 1;
        while (Product::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }

        // 4. Simpan ke Database
        Product::create([
            'name' => $validatedData['name'],
            'category_id' => $validatedData['category_id'],
            'slug' => $slug,
            'description' => $validatedData['description'],
            'price' => $validatedData['price'],
            'stock' => $validatedData['stock'],
            'image_url' => $imagePath,
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Produk **' . $validatedData['name'] . '** berhasil ditambahkan!');
    }

    /**
     * Display the specified resource. (R - Read Detail: GET /admin/products/{product})
     */
    public function show(Product $product): View
    {
        // Model binding otomatis mengambil produk berdasarkan ID/slug.
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource. (U - Update Form: GET /admin/products/{product}/edit)
     */
    public function edit(Product $product): View
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage. (U - Update Logic: PUT/PATCH /admin/products/{product})
     */
    public function update(Request $request, Product $product): RedirectResponse
    {
        // 1. Validasi Data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);

        // 2. Buat Slug Baru (Hanya jika nama produk berubah)
        $slug = $product->slug;
        if ($validatedData['name'] !== $product->name) {
            $slug = Str::slug($validatedData['name']);
            // Pastikan slug unik (kecuali untuk produk itu sendiri)
            $originalSlug = $slug;
            $count = 1;
            while (Product::where('slug', $slug)->where('id', '!=', $product->id)->exists()) {
                $slug = $originalSlug . '-' . $count++;
            }
        }

        // 3. Upload Gambar Baru dan Hapus Gambar Lama
        $imagePath = $product->image_url; // Default ke path lama
        
        if ($request->hasFile('image')) {
            // Hapus gambar lama (jika ada)
            if ($product->image_url && Storage::disk('public')->exists($product->image_url)) {
                Storage::disk('public')->delete($product->image_url);
            }
            // Simpan file baru
            $imagePath = $request->file('image')->store('products', 'public');
        }

        // 4. Update Database
        $product->update([
            'name' => $validatedData['name'],
            'category_id' => $validatedData['category_id'],
            'slug' => $slug,
            'description' => $validatedData['description'],
            'price' => $validatedData['price'],
            'stock' => $validatedData['stock'],
            'image_url' => $imagePath,
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Produk **' . $product->name . '** berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage. (D - Delete: DELETE /admin/products/{product})
     */
    public function destroy(Product $product): RedirectResponse
    {
        $productName = $product->name;
        
        // Hapus file gambar dari storage
        if ($product->image_url && Storage::disk('public')->exists($product->image_url)) {
            Storage::disk('public')->delete($product->image_url);
        }

        // Hapus data produk dari database (juga menghapus di model binding)
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Produk **' . $productName . '** berhasil dihapus!');
    }
}