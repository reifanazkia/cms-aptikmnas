@extends('layouts.app', ['title' => 'Edit Gallery'])

@section('content')
    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-2xl shadow-md p-8 space-y-6">
            <!-- Header -->
            <div class="flex items-center justify-between border-b pb-4">
                <h1 class="text-2xl font-bold text-emerald-700 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Edit Gallery Item
                </h1>
                <a href="{{ route('gallery.show', $gallery) }}"
                    class="px-4 py-2 text-sm font-medium bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl hover:bg-emerald-100 transition">
                    ← Kembali
                </a>
            </div>

            <!-- Alert Error -->
            @if ($errors->any())
                <div class="p-4 mb-4 text-sm text-red-700 bg-red-50 border border-red-200 rounded-lg">
                    <p class="font-semibold mb-2">Terdapat kesalahan:</p>
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form -->
            <form method="POST" action="{{ route('gallery.update', $gallery) }}" enctype="multipart/form-data"
                class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Title -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Judul <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="title" id="title" value="{{ old('title', $gallery->title) }}"
                            class="w-full rounded-lg px-3 py-2 text-sm border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 @error('title') border-red-500 @enderror"
                            required>
                        @error('title')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Category -->
                    <div class="relative">
                        <label for="category_gallery_id" class="block text-sm font-medium text-gray-700 mb-1">
                            Kategori <span class="text-red-500">*</span>
                        </label>

                        <select name="category_gallery_id" id="category_gallery_id"
                            class="appearance-none w-full rounded-lg px-3 py-2 pr-10 text-sm border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 @error('category_gallery_id') border-red-500 @enderror"
                            required>
                            <option value="">Pilih Kategori</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_gallery_id', $gallery->category_gallery_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>

                        <!-- Ikon Chevron (SVG) -->
                        <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center mt-6">
                            <svg class="w-4 h-4 text-gray-500" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                aria-hidden="true">
                                <path d="M19 9l-7 7-7-7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>

                        @error('category_gallery_id')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Publication Date -->
                    <div>
                        <label for="pub_date" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Publikasi</label>
                        <input type="date" name="pub_date" id="pub_date"
                            value="{{ old('pub_date', $gallery->pub_date ? $gallery->pub_date->format('Y-m-d') : '') }}"
                            class="w-full rounded-lg px-3 py-2 text-sm border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 @error('pub_date') border-red-500 @enderror">
                        @error('pub_date')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Waktu Baca -->
                    <div>
                        <label for="waktu_baca" class="block text-sm font-medium text-gray-700 mb-1">Waktu Baca <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="waktu_baca" id="waktu_baca"
                            value="{{ old('waktu_baca', $gallery->waktu_baca) }}" placeholder="contoh: 5 menit"
                            class="w-full rounded-lg px-3 py-2 text-sm border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 @error('waktu_baca') border-red-500 @enderror"
                            required>
                        @error('waktu_baca')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="md:col-span-2">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                        <textarea name="description" id="description" rows="4"
                            class="w-full rounded-lg px-3 py-2 text-sm border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 @error('description') border-red-500 @enderror">{{ old('description', $gallery->description) }}</textarea>
                        @error('description')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Current Image -->
                    @if ($gallery->image)
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Gambar Saat Ini</label>
                            <div class="mb-3 rounded-lg border border-gray-200 bg-gray-50 p-3">
                                <img src="{{ Storage::url($gallery->image) }}" alt="{{ $gallery->title }}"
                                    class="rounded-lg max-h-40 mx-auto">
                            </div>
                        </div>
                    @endif

                    <!-- Image Upload -->
                    <div class="md:col-span-2">
                        <label for="image" class="block text-sm font-medium text-gray-700 mb-1">
                            {{ $gallery->image ? 'Ubah Gambar' : 'Unggah Gambar' }}
                        </label>
                        <input type="file" name="image" id="image" accept="image/*"
                            class="w-full rounded-lg px-3 py-2 text-sm cursor-pointer border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 @error('image') border-red-500 @enderror">
                        <p class="text-sm text-gray-500 mt-1">Format: JPG, PNG, WEBP. Max 2MB.
                            {{ $gallery->image ? 'Kosongkan jika tidak ingin mengubah' : '' }}</p>
                        @error('image')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>


                <!-- Footer -->
                <div class="flex items-center justify-between border-t pt-4">
                    <a href="{{ route('gallery.show', $gallery) }}"
                        class="px-4 py-2 text-sm font-medium bg-gray-100 border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-200 transition">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-4 py-2 text-sm font-medium text-white bg-emerald-600 rounded-xl hover:bg-emerald-700 transition">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => console.error(error));
    </script>
@endsection
