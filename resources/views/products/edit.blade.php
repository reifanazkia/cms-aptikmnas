@extends('layouts.app', ['title' => 'Edit Produk'])

@section('content')
<div class="max-w-3xl mx-auto">
    <!-- Card -->
    <div class="bg-white rounded-2xl shadow-md p-8 space-y-6">
        <!-- Header -->
        <div class="flex items-center justify-between border-b pb-4">
            <h1 class="text-2xl font-bold text-emerald-700 flex items-center">
                <svg class="w-6 h-6 mr-2 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Edit Produk
            </h1>
            <a href="{{ route('products.index') }}"
               class="px-4 py-2 text-sm font-medium bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl hover:bg-emerald-100 transition">
                ← Kembali
            </a>
        </div>

        <!-- Alert Error -->
        @if($errors->any())
            <div class="p-4 mb-4 text-sm text-red-700 bg-red-50 border border-red-200 rounded-lg">
                <p class="font-semibold mb-2">Terdapat kesalahan:</p>
                <ul class="list-disc pl-5 space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form -->
        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Judul -->
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">
                    Judul <span class="text-red-500">*</span>
                </label>
                <input type="text" name="title" id="title"
                       value="{{ old('title', $product->title) }}"
                       class="w-full rounded-lg px-3 py-2 text-sm border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 @error('title') border-red-500 @enderror"
                       required>
                @error('title')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Deskripsi -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                    Deskripsi
                </label>
                <textarea name="description" id="description" rows="4"
                          class="w-full rounded-lg px-3 py-2 text-sm border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 @error('description') border-red-500 @enderror">{{ old('description', $product->description) }}</textarea>
                @error('description')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Harga & Diskon -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700 mb-1">
                        Harga <span class="text-red-500">*</span>
                    </label>
                    <input type="number" name="price" id="price"
                           value="{{ old('price', $product->price) }}"
                           class="w-full rounded-lg px-3 py-2 text-sm border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 @error('price') border-red-500 @enderror"
                           min="0" step="0.01" required>
                    @error('price')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="discount" class="block text-sm font-medium text-gray-700 mb-1">
                        Diskon (%)
                    </label>
                    <input type="number" name="discount" id="discount"
                           value="{{ old('discount', $product->discount) }}"
                           class="w-full rounded-lg px-3 py-2 text-sm border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 @error('discount') border-red-500 @enderror"
                           min="0" max="100">
                    @error('discount')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Disusun -->
            <div>
                <label for="disusun" class="block text-sm font-medium text-gray-700 mb-1">
                    Disusun Oleh <span class="text-red-500">*</span>
                </label>
                <input type="text" name="disusun" id="disusun"
                       value="{{ old('disusun', $product->disusun) }}"
                       class="w-full rounded-lg px-3 py-2 text-sm border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 @error('disusun') border-red-500 @enderror"
                       required>
                @error('disusun')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Modul, Bahasa, Telepon -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label for="jumlah_modul" class="block text-sm font-medium text-gray-700 mb-1">
                        Jumlah Modul
                    </label>
                    <input type="number" name="jumlah_modul" id="jumlah_modul"
                           value="{{ old('jumlah_modul', $product->jumlah_modul) }}"
                           class="w-full rounded-lg px-3 py-2 text-sm border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 @error('jumlah_modul') border-red-500 @enderror"
                           min="1">
                    @error('jumlah_modul')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="bahasa" class="block text-sm font-medium text-gray-700 mb-1">
                        Bahasa
                    </label>
                    <input type="text" name="bahasa" id="bahasa"
                           value="{{ old('bahasa', $product->bahasa) }}"
                           class="w-full rounded-lg px-3 py-2 text-sm border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 @error('bahasa') border-red-500 @enderror">
                    @error('bahasa')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="notlp" class="block text-sm font-medium text-gray-700 mb-1">
                        No. Telepon <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="notlp" id="notlp"
                           value="{{ old('notlp', $product->notlp) }}"
                           class="w-full rounded-lg px-3 py-2 text-sm border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 @error('notlp') border-red-500 @enderror"
                           required>
                    @error('notlp')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Kategori -->
            <div>
                <label for="category_store_id" class="block text-sm font-medium text-gray-700 mb-1">
                    Kategori <span class="text-red-500">*</span>
                </label>
                <select name="category_store_id" id="category_store_id"
                        class="w-full rounded-lg px-3 py-2 text-sm border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 @error('category_store_id') border-red-500 @enderror"
                        required>
                    <option value="">Pilih Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ old('category_store_id', $product->category_store_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_store_id')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Upload Gambar -->
            <div>
                <label for="image" class="block text-sm font-medium text-gray-700 mb-1">
                    Gambar
                </label>
                @if($product->image)
                    <div class="mb-3 rounded-lg border border-gray-200 bg-gray-50 p-3">
                        <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->title }}"
                             class="rounded-lg max-h-40 mx-auto">
                    </div>
                @endif
                <input type="file" name="image" id="image"
                       accept="image/jpeg,image/jpg,image/png,image/webp"
                       class="w-full rounded-lg px-3 py-2 text-sm cursor-pointer border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 @error('image') border-red-500 @enderror">
                <p class="text-xs text-gray-500 mt-1">
                    Kosongkan jika tidak ingin mengganti gambar. Max 2MB.
                </p>
                @error('image')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Footer -->
            <div class="flex items-center justify-between border-t pt-4">
                <a href="{{ route('products.index') }}"
                   class="px-4 py-2 text-sm font-medium bg-gray-100 border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-200 transition">
                    Batal
                </a>
                <div class="flex gap-2">
                    <button type="reset"
                            class="px-4 py-2 text-sm font-medium bg-white border border-gray-300 rounded-xl hover:bg-gray-50">
                        Reset
                    </button>
                    <button type="submit"
                            class="px-4 py-2 text-sm font-medium text-white bg-emerald-600 rounded-xl hover:bg-emerald-700 transition">
                        Simpan Perubahan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
