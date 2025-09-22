@extends('layouts.app', ['title' => 'Tambah Gallery'])

@section('content')
    <div class="max-w-3xl mx-auto">
        <!-- Card -->
        <div class="bg-white rounded-2xl shadow-md p-4 sm:p-8 space-y-6">
            <!-- Header -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 border-b pb-4">
                <h1 class="text-lg sm:text-2xl font-bold text-emerald-700 flex items-center">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 mr-2 text-emerald-600" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Gallery Baru
                </h1>
                <a href="{{ route('gallery.index') }}"
                    class="inline-block px-3 py-2 sm:px-4 sm:py-2 text-sm font-medium bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl hover:bg-emerald-100 transition text-center">
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
            <form action="{{ route('gallery.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Title -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Judul *</label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}"
                        class="w-full rounded-lg px-3 py-2 text-sm border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 @error('title') border-red-500 @enderror"
                        required>
                    @error('title')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Deskripsi -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                    <textarea name="description" id="description" rows="4"
                        class="w-full rounded-lg px-3 py-2 text-sm border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Image Upload -->
                <div x-data="imageUploadCreate()" class="space-y-2">
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Gambar</label>

                    <!-- Area Upload (kalau belum ada foto) -->
                    <div x-show="!previewUrl" x-on:click="triggerInput" x-on:dragover.prevent="isDrag = true"
                        x-on:dragleave.prevent="isDrag = false" x-on:drop.prevent="handleDrop($event)"
                        :class="{
                            'border-emerald-400 bg-emerald-50': isDrag,
                            'border-gray-300': !isDrag
                        }"
                        class="cursor-pointer rounded-lg border-2 p-6 flex flex-col items-center justify-center text-center transition-colors">
                        <!-- Icon Awan -->
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            class="h-12 w-12 text-emerald-600">
                            <path d="M17.5 19a4.5 4.5 0 0 0 .5-9 6 6 0 0 0-11.5-1.5A4.5 4.5 0 0 0 6.5 19h11z" />
                            <path d="M12 11v6" />
                            <path d="M9 14l3-3 3 3" />
                        </svg>

                        <p class="mt-2 text-sm text-gray-600">Klik atau seret gambar ke sini</p>
                        <p class="text-xs text-gray-400">PNG, JPG, GIF (maks 2MB)</p>

                        <input type="file" name="image" id="image" accept="image/*" x-ref="fileInput"
                            class="hidden" x-on:change="handleFiles($event.target.files)" required />
                    </div>

                    <!-- Preview (kalau sudah ada foto) -->
                    <div x-show="previewUrl" class="relative w-40">
                        <img :src="previewUrl" alt="Preview"
                            class="w-40 h-40 object-cover rounded-lg border shadow-sm">

                        <div class="mt-2 flex gap-2">
                            <button type="button" x-on:click="triggerInput"
                                class="px-3 py-1 text-sm rounded-lg border hover:bg-gray-50">
                                Ganti
                            </button>
                            <button type="button" x-on:click="removeFile"
                                class="px-3 py-1 text-sm rounded-lg border text-red-600 hover:bg-red-50">
                                Hapus
                            </button>
                        </div>
                    </div>

                    @error('image')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Pub Date & Waktu Baca -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label for="pub_date" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Publikasi</label>
                        <input type="date" name="pub_date" id="pub_date" value="{{ old('pub_date') }}"
                            class="w-full rounded-lg px-3 py-2 text-sm border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 @error('pub_date') border-red-500 @enderror">
                        @error('pub_date')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="waktu_baca" class="block text-sm font-medium text-gray-700 mb-1">Waktu Baca *</label>
                        <input type="text" name="waktu_baca" id="waktu_baca" value="{{ old('waktu_baca') }}"
                            class="w-full rounded-lg px-3 py-2 text-sm border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 @error('waktu_baca') border-red-500 @enderror"
                            required>
                        @error('waktu_baca')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Category -->
                <div>
                    <label for="category_gallery_id" class="block text-sm font-medium text-gray-700 mb-1">Kategori *</label>
                    <div class="relative">
                        <select name="category_gallery_id" id="category_gallery_id"
                            class="appearance-none w-full rounded-lg px-3 py-2 text-sm border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 pr-10 @error('category_gallery_id') border-red-500 @enderror"
                            required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_gallery_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>

                        <!-- SVG Icon -->
                        <svg class="w-4 h-4 text-gray-500 absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none"
                            fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                    @error('category_gallery_id')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Footer Buttons -->
                <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-3 border-t pt-4">
                    <a href="{{ route('gallery.index') }}"
                        class="w-full sm:w-auto px-4 py-2 text-sm font-medium bg-gray-100 border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-200 transition text-center">
                        Batal
                    </a>
                    <button type="submit"
                        class="w-full sm:w-auto px-4 py-2 text-sm font-medium text-white bg-emerald-600 rounded-xl hover:bg-emerald-700 transition">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // CKEditor
        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });
    </script>

    <script>
        function imageUploadCreate() {
            return {
                previewUrl: null,
                isDrag: false,
                file: null,

                triggerInput() {
                    this.$refs.fileInput.click();
                },

                handleFiles(files) {
                    if (!files || files.length === 0) return;

                    const file = files[0];

                    // Validasi size (max 2MB)
                    if (file.size > 2 * 1024 * 1024) {
                        alert("Ukuran file maksimal 2MB");
                        return;
                    }

                    this.file = file;

                    const reader = new FileReader();
                    reader.onload = (e) => {
                        this.previewUrl = e.target.result;
                    };
                    reader.readAsDataURL(file);
                },

                handleDrop(event) {
                    const files = event.dataTransfer.files;
                    this.handleFiles(files);
                    this.isDrag = false;
                },

                removeFile() {
                    this.file = null;
                    this.previewUrl = null;
                    this.$refs.fileInput.value = "";
                }
            };
        }
    </script>

@endsection
