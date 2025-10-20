{{-- components/category-navbar.blade.php (Ini digunakan untuk navigasi utama di semua halaman publik) --}}

@php
    // Ambil data kategori di sini karena ini adalah bagian dari layout
    // Cek apakah class Category tersedia dan ambil datanya
    $categories = app(\App\Models\Category::class)->all();
@endphp

<div class="category-list">
    <div class="category-content">
        @foreach ($categories as $category)
            <a href="{{ route('category.show', $category->slug) }}" class="category-item">
                {{ $category->name }}
            </a>
        @endforeach
    </div>
</div>