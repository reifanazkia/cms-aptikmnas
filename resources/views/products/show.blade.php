@extends('layouts.app', ['title' => 'Detail Produk'])

@section('content')
<div class="space-y-6">
    <!-- Header Detail -->
    <div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-md p-6 flex items-center justify-between floating-card">
        <div class="flex items-center space-x-4">
            <div class="p-3 bg-emerald-100 rounded-full">
                <i class="fas fa-box text-2xl text-emerald-600"></i>
            </div>
            <div>
                <h1 class="text-2xl font-bold text-emerald-700">{{ $product->title }}</h1>
                <p class="text-emerald-600 text-sm">
                    Dibuat: {{ $product->created_at->format('d F Y H:i') }}
                </p>
            </div>
        </div>
        <a href="{{ route('products.index') }}"
           class="px-4 py-2 rounded-lg bg-emerald-100 hover:bg-emerald-200 text-emerald-800 transition-all flex items-center space-x-2">
            <i class="fas fa-arrow-left"></i>
            <span>Kembali</span>
        </a>
    </div>

    <div class="grid lg:grid-cols-3 gap-6">
        <!-- Konten Utama -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Gambar Produk -->
            <div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-md overflow-hidden floating-card">
                <div class="group">
                    @if($product->image)
                        <img src="{{ asset('storage/'.$product->image) }}"
                             alt="{{ $product->title }}"
                             class="w-full h-80 object-cover transition-transform duration-500 group-hover:scale-105">
                    @else
                        <div class="h-80 bg-emerald-50 flex items-center justify-center">
                            <i class="fas fa-image text-6xl text-emerald-300"></i>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Deskripsi -->
            <div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-md p-6 floating-card">
                <h2 class="text-xl font-semibold text-emerald-700 mb-2 flex items-center">
                    <i class="fas fa-info-circle mr-2"></i>
                    Deskripsi Produk
                </h2>
                <p class="text-gray-700 leading-relaxed">
                    {{ $product->description ?? 'Tidak ada deskripsi untuk produk ini.' }}
                </p>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Tombol Aksi -->
            <div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-md p-6 floating-card">
                <h3 class="text-lg font-semibold text-emerald-700 mb-3 flex items-center">
                    <i class="fas fa-cogs mr-2"></i> Aksi
                </h3>
                <div class="space-y-2">
                    <a href="{{ route('products.edit', $product->id) }}"
                       class="w-full px-4 py-2 bg-gradient-to-r from-emerald-400 to-teal-500 text-white rounded-lg hover:scale-105 flex items-center justify-center space-x-2 transition-all">
                        <i class="fas fa-edit"></i>
                        <span>Edit</span>
                    </a>
                </div>
            </div>

            <!-- Informasi Produk -->
            <div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-md p-6 floating-card">
                <h3 class="text-lg font-semibold text-emerald-700 mb-3 flex items-center">
                    <i class="fas fa-info-circle mr-2"></i> Informasi
                </h3>
                <div class="space-y-2">
                    <div class="flex justify-between">
                        <span>Harga</span>
                        @if($product->has_discount)
                            <span class="font-semibold line-through text-gray-500">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                        @else
                            <span class="font-semibold text-emerald-600">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                        @endif
                    </div>
                    @if($product->has_discount)
                        <div class="flex justify-between">
                            <span>Diskon</span>
                            <span class="font-semibold text-red-500">{{ $product->discount }}%</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Harga Akhir</span>
                            <span class="font-semibold text-emerald-600">Rp {{ number_format($product->final_price, 0, ',', '.') }}</span>
                        </div>
                    @endif
                    <div class="flex justify-between">
                        <span>Kategori</span>
                        <span class="font-semibold text-emerald-600">{{ $product->category->name ?? '-' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Disusun Oleh</span>
                        <span class="font-semibold">{{ $product->disusun }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Jumlah Modul</span>
                        <span class="font-semibold">{{ $product->jumlah_modul }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Bahasa</span>
                        <span class="font-semibold">{{ $product->bahasa }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>No. Telepon</span>
                        <span class="font-semibold">{{ $product->notlp ?? '-' }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
