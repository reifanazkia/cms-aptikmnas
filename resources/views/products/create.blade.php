@extends('layouts.app', ['title' => 'Tambah Produk'])

@section('content')
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <!-- Card -->
        <div class="bg-white rounded-2xl shadow-lg border border-emerald-100 p-6 sm:p-10 space-y-8">

            <!-- Header -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 border-b pb-4">
                <h1 class="text-2xl sm:text-3xl font-bold text-emerald-700 flex items-center">
                    <svg class="w-7 h-7 mr-2 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Produk Baru
                </h1>
                <a href="{{ route('products.index') }}"
                   class="inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl hover:bg-emerald-100 transition w-full sm:w-auto">
                    ← Kembali
                </a>
            </div>

            <!-- Alert Error -->
            @if ($errors->any())
                <div class="p-4 text-sm text-red-700 bg-red-50 border border-red-200 rounded-lg">
                    <p class="font-semibold mb-2">Terdapat kesalahan:</p>
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form -->
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf

                <!-- Informasi Utama -->
                <div class="space-y-6">
                    <h2 class="text-lg font-semibold text-gray-800 border-b pb-2 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M9 12h6m-6 4h6M5 8h14M5 16h14" />
                        </svg>
                        Informasi Produk
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Judul -->
                        <div class="md:col-span-2">
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Judul *</label>
                            <input type="text" name="title" id="title" value="{{ old('title') }}"
                                   class="w-full rounded-xl px-4 py-2.5 text-sm border border-gray-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition @error('title') border-red-500 @enderror"
                                   placeholder="Masukkan judul produk" required>
                            @error('title')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Deskripsi -->
                        <div class="md:col-span-2">
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                                Deskripsi
                            </label>
                            <textarea name="description" id="description" rows="5"
                                      class="w-full rounded-xl px-4 py-2.5 text-sm border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500"
                                      placeholder="Tulis deskripsi produk...">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Harga -->
                        <div>
                            <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Harga *</label>
                            <input type="number" name="price" id="price" value="{{ old('price') }}"
                                   class="w-full rounded-xl px-4 py-2.5 text-sm border border-gray-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition @error('price') border-red-500 @enderror"
                                   required>
                        </div>

                        <!-- Diskon -->
                        <div>
                            <label for="discount" class="block text-sm font-medium text-gray-700 mb-1">Diskon (%)</label>
                            <input type="number" name="discount" id="discount" min="0" max="100"
                                   value="{{ old('discount') }}"
                                   class="w-full rounded-xl px-4 py-2.5 text-sm border border-gray-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
                        </div>
                    </div>
                </div>

                <!-- Informasi Tambahan -->
                <div class="space-y-6">
                    <h2 class="text-lg font-semibold text-gray-800 border-b pb-2 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Informasi Tambahan
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Disusun Oleh -->
                        <div>
                            <label for="disusun" class="block text-sm font-medium text-gray-700 mb-1">Disusun Oleh *</label>
                            <input type="text" name="disusun" id="disusun" value="{{ old('disusun') }}"
                                   class="w-full rounded-xl px-4 py-2.5 text-sm border border-gray-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition"
                                   required>
                        </div>

                        <!-- Jumlah Modul -->
                        <div>
                            <label for="jumlah_modul" class="block text-sm font-medium text-gray-700 mb-1">Jumlah Modul</label>
                            <input type="number" name="jumlah_modul" id="jumlah_modul" min="1"
                                   value="{{ old('jumlah_modul') }}"
                                   class="w-full rounded-xl px-4 py-2.5 text-sm border border-gray-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
                        </div>

                        <!-- Bahasa -->
                        <div>
                            <label for="bahasa" class="block text-sm font-medium text-gray-700 mb-1">Bahasa</label>
                            <input type="text" name="bahasa" id="bahasa" value="{{ old('bahasa') }}"
                                   class="w-full rounded-xl px-4 py-2.5 text-sm border border-gray-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
                        </div>

                        <!-- No Telepon -->
                        <div>
                            <label for="notlp" class="block text-sm font-medium text-gray-700 mb-1">No. Telepon</label>
                            <input type="text" name="notlp" id="notlp" value="{{ old('notlp') }}"
                                   class="w-full rounded-xl px-4 py-2.5 text-sm border border-gray-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
                        </div>
                    </div>
                </div>

                <!-- Kategori & Gambar -->
                <div class="space-y-6">
                    <h2 class="text-lg font-semibold text-gray-800 border-b pb-2 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M3 7h18M3 12h18M3 17h18" />
                        </svg>
                        Kategori & Gambar
                    </h2>

                    <!-- Kategori -->
                    <div>
                        <label for="category_store_id" class="block text-sm font-medium text-gray-700 mb-1">Kategori *</label>
                        <select name="category_store_id" id="category_store_id"
                                class="w-full rounded-xl px-4 py-2.5 text-sm border border-gray-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition pr-10"
                                required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_store_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Upload Gambar -->
                    <div x-data="imageUploadCreate()" class="space-y-2">
                        <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Gambar *</label>

                        <!-- Area Upload -->
                        <div x-show="!previewUrl" x-on:click="triggerInput" x-on:dragover.prevent="isDrag = true"
                             x-on:dragleave.prevent="isDrag = false" x-on:drop.prevent="handleDrop($event)"
                             :class="{ 'border-emerald-400 bg-emerald-50': isDrag, 'border-gray-300': !isDrag }"
                             class="cursor-pointer rounded-xl border-2 border-dashed p-6 flex flex-col items-center justify-center text-center transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke-width="1.5" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                 class="h-12 w-12 text-emerald-600">
                                <path d="M17.5 19a4.5 4.5 0 0 0 .5-9 6 6 0 0 0-11.5-1.5A4.5 4.5 0 0 0 6.5 19h11z" />
                                <path d="M12 11v6" />
                                <path d="M9 14l3-3 3 3" />
                            </svg>
                            <p class="mt-2 text-sm text-gray-600">Klik atau seret gambar ke sini</p>
                            <p class="text-xs text-gray-400">JPG / PNG (maks 2MB)</p>
                            <input type="file" name="image" id="image" accept="image/jpeg,image/png"
                                   x-ref="fileInput" class="hidden" x-on:change="handleFiles($event.target.files)" required>
                        </div>

                        <!-- Preview -->
                        <div x-show="previewUrl" class="mt-3 rounded-lg border border-gray-200 bg-gray-50 p-3">
                            <img :src="previewUrl" class="rounded-lg max-h-40 mx-auto shadow-sm border" alt="Preview">
                            <div class="mt-3 flex gap-2">
                                <button type="button" x-on:click="triggerInput"
                                        class="flex-1 py-1.5 text-sm rounded-lg border hover:bg-gray-50">
                                    Ganti
                                </button>
                                <button type="button" x-on:click="removeFile"
                                        class="flex-1 py-1.5 text-sm rounded-lg border text-red-600 hover:bg-red-50">
                                    Hapus
                                </button>
                            </div>
                        </div>

                        @error('image')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Footer Buttons -->
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
                            Simpan Produk
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Script -->
    <script>
        // CKEditor
        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => console.error(error));

        // AlpineJS untuk upload gambar
        function imageUploadCreate() {
            return {
                previewUrl: null,
                isDrag: false,
                triggerInput() {
                    this.$refs.fileInput.click();
                },
                handleFiles(files) {
                    if (!files.length) return;
                    const file = files[0];
                    if (file.size > 2 * 1024 * 1024) {
                        alert("Ukuran file maksimal 2MB");
                        return;
                    }
                    this.previewUrl = URL.createObjectURL(file);
                },
                handleDrop(e) {
                    this.isDrag = false;
                    this.handleFiles(e.dataTransfer.files);
                },
                removeFile() {
                    this.$refs.fileInput.value = '';
                    this.previewUrl = null;
                }
            }
        }
    </script>
@endsection
