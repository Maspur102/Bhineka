<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bhinneka Clone - @yield('title', 'Home')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    {{-- Simulasi Icon --}}
    <style>
        /* Menggunakan ikon yang sesuai dengan screenshot */
        .icon-user-nav::before { content: '👤'; } 
        .icon-cart-nav::before { content: '🛒'; } 
        /* Pastikan ikon headset ada jika Bantuan digunakan */
        .icon-headset::before { content: '🎧'; }
    </style>
</head>
<body>
    
    <header class="header">
        
        {{-- BAGIAN ATAS (Logo, Search, Actions) --}}
        <div class="header-top"> 
            
            {{-- KIRI: Logo dan Menu Burger --}}
            <div style="display: flex; align-items: center;">
                <span class="menu-icon">☰</span>
                <a href="{{ route('home') }}" class="nav-logo">ECOMMERCE CLONE</a>
            </div>

            {{-- TENGAH: Form Pencarian --}}
            <form action="{{ route('home') }}" method="GET" class="search-form" style="flex-grow: 1; max-width: 550px; margin: 0 30px;">
                <input type="text" name="q" placeholder="Search products..." 
                       value="{{ request('q') }}">
                <button type="submit">🔍</button> 
            </form>
            
            {{-- KANAN: Ikon Aksi --}}
            <div class="header-actions">
                <a href="#" class="icon-link" title="Bantuan">
                    <span class="icon-headset"></span>
                </a>
                
                @auth
                    <a href="{{ route('admin.dashboard') }}" class="icon-link" title="Admin">
                        <span class="icon-user-nav"></span>
                    </a>
                    <form method="POST" action="{{ route('logout') }}" style="display: none;" id="logout-form">@csrf</form>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="icon-link" title="Logout">
                        <span class="icon-cart-nav"></span>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="icon-link" title="Login">
                        <span class="icon-user-nav"></span>
                    </a>
                    <a href="#" class="icon-link" title="Keranjang">
                        <span class="icon-cart-nav"></span>
                    </a>
                @endauth
            </div>
        </div> 

        {{-- BAGIAN BAWAH: Sub Navigasi Kategori --}}
        @if (!request()->is('admin*'))
            @php
                // Mengambil data kategori
                $categories = app(\App\Models\Category::class)->all();
            @endphp
            <div class="sub-nav">
                <div class="sub-nav-content">
                    {{-- Item Statis --}}
                    <a href="{{ route('home') }}">Home</a>
                    <a href="#">Deals</a>
                    <a href="#">New Arrivals</a>
                    
                    {{-- Item Kategori Dinamis --}}
                    @foreach ($categories as $category)
                        <a href="{{ route('category.show', $category->slug) }}">{{ $category->name }}</a>
                    @endforeach
                    
                </div>
            </div>
        @endif
    </header>

    <main class="container">
        @if (session('success'))
            <div class="alert-success">
                {!! session('success') !!}
            </div>
        @endif
        
        @yield('content')
    </main>

    <footer class="footer">
        <p>&copy; {{ date('Y') }} ECOMMERCE CLONE. Tugas Sekolah.</p>
    </footer>

</body>
</html>