@extends('layouts.main')

@section('title', 'Admin Dashboard')

@section('content')
    <h1>Selamat Datang, Admin!</h1>
    <p>Gunakan menu di bawah untuk mengelola data toko.</p>

    <div style="margin-top: 30px;">
        <a href="{{ route('admin.products.index') }}" style="display: inline-block; padding: 15px 25px; background-color: #007bff; color: white; border-radius: 6px; font-weight: bold;">
            Kelola Produk
        </a>
        <a href="#" style="display: inline-block; padding: 15px 25px; background-color: #6c757d; color: white; border-radius: 6px; margin-left: 15px;">
            Kelola Kategori (Belum Aktif)
        </a>
    </div>
@endsection