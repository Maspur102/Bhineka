@extends('layouts.main')

@section('title', $product->name)

@section('content')
    <a href="{{ route('category.show', $product->category->slug) }}">&larr; Kembali ke {{ $product->category->name }}</a>
    <div style="display: flex; gap: 30px; margin-top: 20px; background-color: white; padding: 20px; border-radius: 8px;">
        <div style="flex-basis: 30%;">
            <img src="{{ $product->image_url ? asset('storage/' . $product->image_url) : asset('placeholder.jpg') }}" alt="{{ $product->name }}" style="max-width: 100%; border: 1px solid #eee; padding: 10px;">
        </div>
        <div style="flex-basis: 70%;">
            <h1>{{ $product->name }}</h1>
            <p>Kategori: <strong><a href="{{ route('category.show', $product->category->slug) }}">{{ $product->category->name }}</a></strong></p>

            <h2 style="color: #dc3545; font-size: 30px;">Rp {{ number_format($product->price, 0, ',', '.') }}</h2>
            <p style="color: green; font-weight: bold;">Stok Tersedia: {{ $product->stock }} unit</p>

            <button style="background-color: #ffc107; color: #333; padding: 10px 20px; border: none; border-radius: 4px; font-weight: bold; cursor: pointer;">
                Tambah ke Keranjang (Fitur Belum Aktif)
            </button>

            <h4 style="margin-top: 20px;">Deskripsi Produk</h4>
            <p style="white-space: pre-wrap;">{{ $product->description }}</p>
        </div>
    </div>
@endsection