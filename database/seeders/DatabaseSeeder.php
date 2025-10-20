<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat Akun Admin menggunakan firstOrCreate()
        // Bagian 1. Buat Akun Admin
User::firstOrCreate(
    ['email' => 'admin@example.com'], // Kriteria pencarian
    [
        'name' => 'Admin Bhinneka Clone',
        // PASTIKAN MENGGUNAKAN HASH::MAKE()
        'password' => Hash::make('password'), 
        'email_verified_at' => now(),
        'remember_token' => Str::random(10),
    ]
);
// ... kode lainnya
        // Catatan: Jika admin@example.com sudah ada, baris di atas akan dilewati.

        // 2. Buat Kategori
        $categories = [
            ['name' => 'Laptop & Komputer', 'slug' => 'laptop-komputer'],
            ['name' => 'Smartphone & Gadget', 'slug' => 'smartphone-gadget'],
            ['name' => 'Aksesoris & Periferal', 'slug' => 'aksesoris-periferal'],
        ];
        
        // Kita juga bisa menggunakan firstOrCreate untuk kategori
        foreach ($categories as $data) {
            Category::firstOrCreate(['slug' => $data['slug']], $data);
        }

        $catLaptop = Category::where('slug', 'laptop-komputer')->first();
        $catSmartphone = Category::where('slug', 'smartphone-gadget')->first();

        // 3. Buat Produk (gunakan firstOrCreate juga jika tidak ingin duplikasi)
        // Karena produk mungkin saja duplikat di dunia nyata, kita biarkan `create` (atau gunakan firstOrCreate jika produk tersebut memang unik)
        
        // Contoh menggunakan firstOrCreate untuk Produk yang spesifik
        Product::firstOrCreate(
            ['slug' => 'macbook-pro-m2'],
            [
                'category_id' => $catLaptop->id,
                'name' => 'Macbook Pro M2',
                'description' => 'Laptop premium dengan chip M2 super cepat. Cocok untuk profesional.',
                'price' => 25500000,
                'stock' => 15,
                'image_url' => null, 
            ]
        );
        
        Product::firstOrCreate(
            ['slug' => 'samsung-galaxy-s23-ultra'],
            [
                'category_id' => $catSmartphone->id,
                'name' => 'Samsung Galaxy S23 Ultra',
                'description' => 'Smartphone flagship dengan kamera 200MP dan S Pen.',
                'price' => 17999000,
                'stock' => 22,
                'image_url' => null,
            ]
        );
        
        // Factory tetap bisa digunakan untuk membuat data dummy tambahan
        // Product::factory(5)->create(); 
    }
}