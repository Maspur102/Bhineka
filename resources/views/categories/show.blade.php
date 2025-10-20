@extends('layouts.main')

@section('title', 'Kategori: ' . $category->name)

@section('content')
    <h2>Produk dalam Kategori: {{ $category->name }}</h2>
    
    <div class="product-grid">
        @forelse ($products as $product)
            <div class="product-card">
                {{-- Gunakan asset('storage/') untuk gambar yang diupload Admin --}}
                <img src="{{ $product->image_url ? asset('storage/' . $product->image_url) : asset('placeholder.jpg') }}" alt="{{ $product->name }}">
                <h4><a href="{{ route('product.show', $product->slug) }}">{{ $product->name }}</a></h4>
                <p style="color: #dc3545; font-weight: bold;">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                <small style="color: green;">Stok: {{ $product->stock }}</small>
            </div>
        @empty
            <p>Tidak ada produk dalam kategori ini.</p>
        @endforelse
    </div>
@endsection