@extends('layouts.app', ['title' => 'Edit Tentang Kami'])

@section('content')
<div class="max-w-5xl mx-auto">
    <!-- Card -->
    <div class="bg-white rounded-2xl shadow-md p-8 space-y-6">

        <!-- Header -->
        <div class="flex items-center justify-between border-b pb-4">
            <h1 class="text-2xl font-bold text-emerald-700">Edit Tentang Kami</h1>
            <a href="{{ route('aboutus.index') }}"
               class="px-4 py-2 rounded-xl bg-emerald-600 text-white hover:bg-emerald-700 transition">
                Kembali
            </a>
        </div>

        <!-- Form -->
        <form action="{{ route('aboutus.update', $aboutus->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Judul -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Judul</label>
                <input type="text" name="title" value="{{ old('title', $aboutus->title) }}"
                       class="mt-1 w-full border rounded-xl px-4 py-2 focus:ring-emerald-500 focus:border-emerald-500" required>
                @error('title')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Kategori -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Kategori</label>
                <select name="category_tentangkami_id"
                        class="mt-1 w-full border rounded-xl px-4 py-2 focus:ring-emerald-500 focus:border-emerald-500" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ old('category_tentangkami_id', $aboutus->category_tentangkami_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->nama }}
                        </option>
                    @endforeach
                </select>
                @error('category_tentangkami_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Deskripsi -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Deskripsi</label>
                <textarea name="description" rows="5"
                          class="mt-1 w-full border rounded-xl px-4 py-2 focus:ring-emerald-500 focus:border-emerald-500" required>{{ old('description', $aboutus->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Upload Gambar -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Gambar</label>

                @if($aboutus->image)
                    <div class="mb-3">
                        <img src="{{ asset($aboutus->image) }}" alt="Preview" class="h-32 rounded-lg border">
                    </div>
                @endif

                <input type="file" name="image"
                       class="mt-1 w-full border rounded-xl px-4 py-2 focus:ring-emerald-500 focus:border-emerald-500">
                <p class="text-sm text-gray-500 mt-1">Kosongkan jika tidak ingin mengganti gambar.</p>
                @error('image')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tampilkan di Home -->
            <div class="flex items-center">
                <input type="checkbox" name="display_on_home" id="display_on_home"
                       class="h-5 w-5 text-emerald-600 border-gray-300 rounded"
                       {{ old('display_on_home', $aboutus->display_on_home) ? 'checked' : '' }}>
                <label for="display_on_home" class="ml-2 text-gray-700">Tampilkan di Halaman Depan</label>
            </div>

            <!-- Tombol -->
            <div class="flex justify-end space-x-3 pt-4 border-t">
                <a href="{{ route('aboutus.index') }}"
                   class="px-4 py-2 rounded-xl bg-gray-200 text-gray-700 hover:bg-gray-300 transition">
                    Batal
                </a>
                <button type="submit"
                        class="px-4 py-2 rounded-xl bg-emerald-600 text-white hover:bg-emerald-700 transition">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
