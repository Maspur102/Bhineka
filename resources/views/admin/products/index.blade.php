@extends('layouts.main')

@section('title', 'Manajemen Produk')

@section('content')
    <h2>Manajemen Produk</h2>
    <p><a href="{{ route('admin.products.create') }}" style="background-color: green; color: white; padding: 8px 15px; border-radius: 4px; display: inline-block;">+ Tambah Produk Baru</a></p>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Produk</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Gambar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->category->name }}</td>
                <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                <td>{{ $product->stock }}</td>
                <td>
                    @if ($product->image_url)
                        <img src="{{ asset('storage/' . $product->image_url) }}" alt="Gambar" style="width: 50px; height: 50px; object-fit: cover;">
                    @else
                        -
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.products.show', $product) }}" style="color: blue;">Lihat</a> |
                    <a href="{{ route('admin.products.edit', $product) }}" style="color: orange;">Edit</a> |
                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Yakin hapus produk {{ $product->name }}?')" style="background: none; border: none; color: red; cursor: pointer;">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
                <tr>
                    <td colspan="7">Belum ada produk. Silakan tambah produk baru.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection