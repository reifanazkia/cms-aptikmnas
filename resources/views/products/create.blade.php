@extends('layouts.app', ['title' => 'Tambah Produk'])

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
                    Tambah Produk Baru
                </h1>
                <a href="{{ route('products.index') }}"
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
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Judul -->
                    <div class="md:col-span-2">
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Judul *</label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}"
                            class="w-full rounded-lg px-3 py-2 text-sm border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 @error('title') border-red-500 @enderror"
                            required>
                        @error('title')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Deskripsi -->
                    <div class="md:col-span-2">
                       <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                        <textarea name="description" id="description" rows="4"
                            class="w-full rounded-lg px-3 py-2 text-sm border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                        @error('description')
                            <p cla ss="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Harga -->
                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Harga *</label>
                        <input type="number" name="price" id="price" value="{{ old('price') }}"
                            class="w-full rounded-lg px-3 py-2 text-sm border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 @error('price') border-red-500 @enderror"
                            required>
                        @error('price')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Diskon -->
                    <div>
                        <label for="discount" class="block text-sm font-medium text-gray-700 mb-1">Diskon (%)</label>
                        <input type="number" name="discount" id="discount" min="0" max="100"
                            value="{{ old('discount') }}"
                            class="w-full rounded-lg px-3 py-2 text-sm border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 @error('discount') border-red-500 @enderror">
                        @error('discount')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Disusun Oleh -->
                    <div>
                        <label for="disusun" class="block text-sm font-medium text-gray-700 mb-1">Disusun Oleh *</label>
                        <input type="text" name="disusun" id="disusun" value="{{ old('disusun') }}"
                            class="w-full rounded-lg px-3 py-2 text-sm border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 @error('disusun') border-red-500 @enderror"
                            required>
                        @error('disusun')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Jumlah Modul -->
                    <div>
                        <label for="jumlah_modul" class="block text-sm font-medium text-gray-700 mb-1">Jumlah Modul</label>
                        <input type="number" name="jumlah_modul" id="jumlah_modul" min="1"
                            value="{{ old('jumlah_modul') }}"
                            class="w-full rounded-lg px-3 py-2 text-sm border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 @error('jumlah_modul') border-red-500 @enderror">
                        @error('jumlah_modul')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Bahasa -->
                    <div>
                        <label for="bahasa" class="block text-sm font-medium text-gray-700 mb-1">Bahasa</label>
                        <input type="text" name="bahasa" id="bahasa" value="{{ old('bahasa') }}"
                            class="w-full rounded-lg px-3 py-2 text-sm border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 @error('bahasa') border-red-500 @enderror">
                        @error('bahasa')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- No Telepon -->
                    <div>
                        <label for="notlp" class="block text-sm font-medium text-gray-700 mb-1">No. Telepon</label>
                        <input type="text" name="notlp" id="notlp" value="{{ old('notlp') }}"
                            class="w-full rounded-lg px-3 py-2 text-sm border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 @error('notlp') border-red-500 @enderror">
                        @error('notlp')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Kategori -->
                    <div class="relative md:col-span-2">
                        <label for="category_store_id" class="block text-sm font-medium text-gray-700 mb-1">Kategori
                            *</label>
                        <select name="category_store_id" id="category_store_id"
                            class="w-full appearance-none rounded-lg px-3 py-2 pr-10 text-sm border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 @error('category_store_id') border-red-500 @enderror"
                            required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_store_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <div
                            class="pointer-events-none absolute inset-y-0 right-3 top-10.5 transform -translate-y-1/2 flex items-center">
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                        @error('category_store_id')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Gambar -->
                    <div class="md:col-span-2">
                        <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Gambar *</label>
                        <input type="file" name="image" id="image" accept="image/jpeg,image/png"
                            class="w-full rounded-lg px-3 py-2 text-sm border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 @error('image') border-red-500 @enderror">
                        <p class="text-gray-500 text-sm mt-1">Format: JPG/PNG, Maks: 2MB</p>
                        @error('image')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror

                        <!-- Preview -->
                        <div id="imagePreview" class="hidden mt-3 rounded-lg border border-gray-200 bg-gray-50 p-3">
                            <img id="previewImg" class="rounded-lg max-h-40 mx-auto" alt="Preview">
                            <button type="button" id="removeImage"
                                class="mt-2 w-full py-1.5 text-sm text-red-600 border border-red-300 rounded-lg hover:bg-red-50">
                                Hapus Gambar
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Footer Buttons -->
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
                            Simpan Produk
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Script Preview Gambar -->
    <script>
        const imageInput = document.getElementById('image');
        const preview = document.getElementById('imagePreview');
        const previewImg = document.getElementById('previewImg');
        const removeBtn = document.getElementById('removeImage');

        imageInput.addEventListener('change', (e) => {
            const file = e.target.files[0];
            if (file) {
                if (!['image/jpeg', 'image/png'].includes(file.type)) {
                    alert('Format harus JPG/PNG');
                    imageInput.value = '';
                    return;
                }
                if (file.size > 2097152) {
                    alert('Ukuran maksimal 2MB');
                    imageInput.value = '';
                    return;
                }
                const reader = new FileReader();
                reader.onload = e => {
                    previewImg.src = e.target.result;
                    preview.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            }
        });

        removeBtn.addEventListener('click', () => {
            imageInput.value = '';
            preview.classList.add('hidden');
        });

        // CKEditor
        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
