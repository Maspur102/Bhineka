@extends('layouts.main')

@section('title', 'Tambah Produk Baru')

@section('content')
    <div style="max-width: 600px; margin: 0 auto; padding: 20px; background-color: white; border: 1px solid #ddd; border-radius: 8px;">
        <h2>Tambah Produk Baru</h2>
        <a href="{{ route('admin.products.index') }}">&larr; Kembali ke Daftar Produk</a>

        {{-- Menampilkan Error Validasi --}}
        @if ($errors->any())
            <div style="background-color: #f8d7da; color: #721c24; padding: 10px; border: 1px solid #f5c6cb; margin-bottom: 15px; border-radius: 4px;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form menggunakan enctype="multipart/form-data" untuk upload file --}}
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" style="margin-top: 20px;">
            @csrf

            {{-- Nama Produk --}}
            <div style="margin-bottom: 15px;">
                <label for="name" style="display: block; margin-bottom: 5px; font-weight: bold;">Nama Produk:</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required 
                       style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
            </div>

            {{-- Kategori --}}
            <div style="margin-bottom: 15px;">
                <label for="category_id" style="display: block; margin-bottom: 5px; font-weight: bold;">Kategori:</label>
                <select id="category_id" name="category_id" required
                        style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Harga --}}
            <div style="margin-bottom: 15px;">
                <label for="price" style="display: block; margin-bottom: 5px; font-weight: bold;">Harga (Rp):</label>
                <input type="number" id="price" name="price" value="{{ old('price') }}" required min="0" 
                       style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
            </div>

            {{-- Stok --}}
            <div style="margin-bottom: 15px;">
                <label for="stock" style="display: block; margin-bottom: 5px; font-weight: bold;">Stok:</label>
                <input type="number" id="stock" name="stock" value="{{ old('stock') }}" required min="0" 
                       style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
            </div>
            
            {{-- Gambar --}}
            <div style="margin-bottom: 15px;">
                <label for="image" style="display: block; margin-bottom: 5px; font-weight: bold;">Gambar Produk (Max 2MB):</label>
                <input type="file" id="image" name="image" 
                       style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
            </div>

            {{-- Deskripsi --}}
            <div style="margin-bottom: 20px;">
                <label for="description" style="display: block; margin-bottom: 5px; font-weight: bold;">Deskripsi:</label>
                <textarea id="description" name="description" rows="5" required
                          style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">{{ old('description') }}</textarea>
            </div>

            <button type="submit" 
                    style="background-color: #007bff; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; font-size: 16px;">
                Simpan Produk
            </button>
        </form>
    </div>
@endsection