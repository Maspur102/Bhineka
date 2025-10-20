@extends('layouts.main')

@section('title', $title)

@section('content')

    {{-- 1. Hero Banner (Meniru "Elevate Your Workspace") --}}
    @if (!request('q'))
        {{-- KITA GANTI DENGAN KELAS BARU UNTUK KONSISTENSI --}}
        <div class="hero-banner" style="background-color: #34495e; color: white; padding: 80px; border-radius: 8px; margin-bottom: 30px;">
            <div style="max-width: 500px;">
                <h1 style="font-size: 40px; margin-top: 0; color: white;">Elevate Your Workspace</h1>
                <p style="font-size: 18px; margin-bottom: 20px;">
                    Temukan gadget dan aksesoris terbaik untuk meningkatkan produktivitas dan gaya Anda.
                </p>
                <a href="{{ route('category.show', 'laptop-komputer') }}" class="buy-button" 
                   style="display: inline-block; background-color: var(--primary-accent); padding: 10px 20px; font-size: 16px;">
                    Belanja Sekarang
                </a>
            </div>
        </div>
    @endif
    
    {{-- ... sisa konten (Produk, Promo, Brand) ... --}}

@endsection