@extends('layouts.app', ['title' => 'Edit Produk'])

@section('content')
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <!-- Card -->
        <!-- Card -->
        <div class="bg-white rounded-2xl shadow-lg border border-emerald-100 p-6 sm:p-10 space-y-8">

            <!-- Header -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 border-b pb-4">
                <h1 class="text-2xl sm:text-3xl font-bold text-emerald-700 flex items-center">
                    <svg class="w-7 h-7 mr-2 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5h2m-1 0v14m9-7H4" />
                    </svg>
                    Edit Produk
                </h1>
                <a href="{{ route('products.index') }}"
                    class="inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl hover:bg-emerald-100 transition w-full sm:w-auto">
                    ← Kembali
                </a>
            </div>

            <!-- Form -->
            <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data"
                class="space-y-8">
                @csrf
                @method('PUT')

                <!-- Grid Utama: bagi 2 kolom -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

                    <!-- Kolom Kiri -->
                    <div class="space-y-6">
                        <!-- Informasi Produk -->
                        <h2 class="text-lg font-semibold text-gray-800 border-b pb-2 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-emerald-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6M5 8h14M5 16h14" />
                            </svg>
                            Informasi Produk
                        </h2>

                        <div class="space-y-4">
                            <div>
                                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Judul *</label>
                                <input type="text" name="title" id="title"
                                    value="{{ old('title', $product->title) }}"
                                    class="w-full rounded-xl px-4 py-2.5 text-sm border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500">
                            </div>
                            <div>
                                <label for="description"
                                    class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                                <textarea name="description" id="description" rows="5"
                                    class="w-full rounded-xl px-4 py-2.5 text-sm border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500">{{ old('description', $product->description) }}</textarea>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Harga
                                        *</label>
                                    <input type="number" name="price" id="price"
                                        value="{{ old('price', $product->price) }}"
                                        class="w-full rounded-xl px-4 py-2.5 text-sm border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500">
                                </div>
                                <div>
                                    <label for="discount" class="block text-sm font-medium text-gray-700 mb-1">Diskon
                                        (%)</label>
                                    <input type="number" name="discount" id="discount"
                                        value="{{ old('discount', $product->discount) }}"
                                        class="w-full rounded-xl px-4 py-2.5 text-sm border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500">
                                </div>
                            </div>
                        </div>

                        <!-- Informasi Tambahan -->
                        <h2 class="text-lg font-semibold text-gray-800 border-b pb-2 flex items-center mt-6">
                            <svg class="w-5 h-5 mr-2 text-emerald-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Informasi Tambahan
                        </h2>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="disusun" class="block text-sm font-medium text-gray-700 mb-1">Disusun Oleh
                                    *</label>
                                <input type="text" name="disusun" id="disusun"
                                    value="{{ old('disusun', $product->disusun) }}"
                                    class="w-full rounded-xl px-4 py-2.5 text-sm border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500">
                            </div>
                            <div>
                                <label for="jumlah_modul" class="block text-sm font-medium text-gray-700 mb-1">Jumlah
                                    Modul</label>
                                <input type="number" name="jumlah_modul" id="jumlah_modul"
                                    value="{{ old('jumlah_modul', $product->jumlah_modul) }}"
                                    class="w-full rounded-xl px-4 py-2.5 text-sm border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500">
                            </div>
                            <div>
                                <label for="bahasa" class="block text-sm font-medium text-gray-700 mb-1">Bahasa</label>
                                <input type="text" name="bahasa" id="bahasa"
                                    value="{{ old('bahasa', $product->bahasa) }}"
                                    class="w-full rounded-xl px-4 py-2.5 text-sm border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500">
                            </div>
                            <div>
                                <label for="notlp" class="block text-sm font-medium text-gray-700 mb-1">No.
                                    Telepon</label>
                                <input type="text" name="notlp" id="notlp"
                                    value="{{ old('notlp', $product->notlp) }}"
                                    class="w-full rounded-xl px-4 py-2.5 text-sm border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500">
                            </div>
                        </div>
                    </div>

                    <!-- Kolom Kanan -->
                    <div class="space-y-6">
                        <!-- Kategori -->
                        <div>
                            <label for="category_store_id" class="block text-sm font-medium text-gray-700 mb-1">Kategori
                                *</label>
                            <select name="category_store_id" id="category_store_id"
                                class="w-full rounded-xl px-4 py-2.5 text-sm border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500">
                                <option value="">-- Pilih Kategori --</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_store_id', $product->category_store_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Gambar -->
                        <div>
                            <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Gambar</label>
                            <input type="file" name="image" id="image" accept="image/jpeg,image/png"
                                class="w-full rounded-xl px-4 py-2.5 text-sm border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500">
                            <p class="text-gray-500 text-sm mt-1">Format: JPG/PNG, Maks: 2MB</p>

                            <div id="imagePreview"
                                class="mt-3 rounded-lg border border-gray-200 bg-gray-50 p-3 {{ $product->image ? '' : 'hidden' }}">
                                <img id="previewImg" class="rounded-lg max-h-40 mx-auto"
                                    src="{{ $product->image ? asset('storage/' . $product->image) : '' }}" alt="Preview">
                                <button type="button" id="removeImage"
                                    class="mt-2 w-full py-1.5 text-sm text-red-600 border border-red-300 rounded-lg hover:bg-red-50">
                                    Hapus Gambar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <div class="flex flex-col sm:flex-row sm:justify-between gap-3 border-t pt-6">
                    <a href="{{ route('products.index') }}"
                        class="px-4 py-2.5 text-sm font-medium bg-gray-100 border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-200 transition text-center">
                        Batal
                    </a>
                    <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
                        <button type="reset"
                            class="px-4 py-2.5 text-sm font-medium bg-white border border-gray-300 rounded-xl hover:bg-gray-50 transition w-full sm:w-auto">
                            Reset
                        </button>
                        <button type="submit"
                            class="px-4 py-2.5 text-sm font-medium text-white bg-emerald-600 rounded-xl hover:bg-emerald-700 transition w-full sm:w-auto">
                            Update Produk
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
            previewImg.src = '';
        });

        // CKEditor
        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
