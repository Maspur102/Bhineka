@extends('layouts.main')

@section('title', 'Detail Produk Admin: ' . $product->name)

@section('content')
    <div style="max-width: 800px; margin: 0 auto; padding: 20px; background-color: white; border: 1px solid #ddd; border-radius: 8px;">
        <h2 style="border-bottom: 2px solid #007bff; padding-bottom: 10px;">Detail Produk: {{ $product->name }}</h2>
        
        <p>
            <a href="{{ route('admin.products.index') }}">&larr; Kembali ke Daftar Produk</a> | 
            <a href="{{ route('admin.products.edit', $product) }}" style="color: orange;">Edit Produk</a>
        </p>

        <div style="display: flex; gap: 30px; margin-top: 20px;">
            {{-- Kolom Kiri: Gambar --}}
            <div style="flex-basis: 35%;">
                <h3>Gambar</h3>
                @if ($product->image_url)
                    <img src="{{ asset('storage/' . $product->image_url) }}" alt="{{ $product->name }}" style="max-width: 100%; border: 1px solid #eee; padding: 10px;">
                @else
                    <p>Tidak ada gambar.</p>
                @endif
            </div>

            {{-- Kolom Kanan: Detail --}}
            <div style="flex-basis: 65%;">
                <table style="width: 100%; margin-top: 0; border: none;">
                    <tbody>
                        <tr><th>ID Produk</th><td>{{ $product->id }}</td></tr>
                        <tr><th>Nama</th><td>{{ $product->name }}</td></tr>
                        <tr><th>Slug (URL)</th><td>/produk/{{ $product->slug }}</td></tr>
                        <tr><th>Kategori</th><td>{{ $product->category->name }}</td></tr>
                        <tr><th>Harga</th><td>Rp {{ number_format($product->price, 0, ',', '.') }}</td></tr>
                        <tr><th>Stok</th><td>{{ $product->stock }}</td></tr>
                        <tr><th>Dibuat</th><td>{{ $product->created_at->format('d M Y H:i') }}</td></tr>
                    </tbody>
                </table>
            </div>
        </div>

        <h3 style="margin-top: 30px;">Deskripsi</h3>
        <div style="padding: 10px; border: 1px solid #eee; background-color: #f9f9f9; white-space: pre-wrap;">
            {{ $product->description }}
        </div>
        
    </div>
@endsection