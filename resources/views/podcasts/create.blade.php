@extends('layouts.app', ['title' => 'Tambah Podcast'])

@section('content')
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Card Container -->
        <div class="bg-white rounded-2xl shadow-lg p-6 sm:p-8 space-y-6">
            <!-- Header -->
            <div class="flex items-center gap-3 mb-4 sm:mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 sm:w-8 sm:h-8 text-emerald-600" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 19V6h13v13H9zM2 6h5v13H2V6z" />
                </svg>
                <h1 class="text-xl sm:text-2xl font-bold text-emerald-700">Tambah Podcast</h1>
            </div>

            <!-- Error Messages -->
            @if ($errors->any())
                <div
                    class="bg-red-100 border border-red-200 text-red-700 px-4 py-3 rounded-lg shadow-sm text-sm sm:text-base">
                    <ul class="list-disc pl-4 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form -->
            <form action="{{ route('podcasts.store') }}" method="POST" class="space-y-5">
                @csrf

                <!-- Judul -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Judul</label>
                    <input type="text" name="title" value="{{ old('title') }}" placeholder="Masukkan judul podcast"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 sm:px-4 sm:py-2.5 text-sm sm:text-base focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                </div>

                <!-- Deskripsi -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                    <textarea name="description" id="description" rows="4"
                        class="w-full rounded-lg px-3 py-2 text-sm border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-red-600 text-xs sm:text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Grid Form -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">YouTube ID</label>
                        <input type="text" name="yt_id" value="{{ old('yt_id') }}" placeholder="Contoh: dQw4w9WgXcQ"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 sm:px-4 sm:py-2.5 text-sm sm:text-base focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Publikasi</label>
                        <input type="date" name="pub_date" value="{{ old('pub_date') }}"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 sm:px-4 sm:py-2.5 text-sm sm:text-base focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                    </div>

                    <!-- Pembicara with Dynamic Fields -->
                    <div class="sm:col-span-2">
                        <div class="flex items-center justify-between mb-2">
                            <label class="block text-sm font-medium text-gray-700">Pembicara</label>
                            <button type="button" id="addPembicara"
                                class="flex items-center gap-1 px-3 py-1.5 text-xs font-medium text-emerald-700 bg-emerald-50 rounded-lg hover:bg-emerald-100 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4" />
                                </svg>
                                Tambah
                            </button>
                        </div>

                        <div id="pembicaraContainer" class="space-y-2">
                            <!-- Initial pembicara field -->
                            <div class="pembicara-item flex gap-2">
                                <input type="text" name="pembicara[]" value="{{ old('pembicara.0') }}"
                                    placeholder="Nama pembicara"
                                    class="flex-1 border border-gray-300 rounded-lg px-3 py-2 sm:px-4 sm:py-2.5 text-sm sm:text-base focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                                <button type="button"
                                    class="remove-pembicara px-3 py-2 text-red-600 bg-red-50 rounded-lg hover:bg-red-100 transition opacity-0 pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <p class="text-xs text-gray-400 mt-2">Klik tombol "Tambah" untuk menambahkan pembicara lainnya</p>
                    </div>

                    <div class="relative sm:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                        <select name="category_podcasts_id"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 pr-10 sm:px-4 sm:py-2.5 text-sm sm:text-base focus:ring-2 focus:ring-emerald-500 focus:outline-none appearance-none">
                            <option value="">Pilih Kategori</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_podcasts_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <!-- Custom Arrow -->
                        <div class="pointer-events-none absolute inset-y-0 top-5 right-0 flex items-center pr-3">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col-reverse sm:flex-row sm:justify-end gap-3 pt-4">
                    <a href="{{ route('podcasts.index') }}"
                        class="w-full sm:w-auto px-4 py-2 sm:px-5 sm:py-2.5 rounded-lg bg-gray-200 text-gray-700 text-center hover:bg-gray-300 transition">Batal</a>
                    <button type="submit"
                        class="w-full sm:w-auto px-4 py-2 sm:px-5 sm:py-2.5 rounded-lg bg-emerald-600 text-white hover:bg-emerald-700 transition">Simpan</button>
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

        // Dynamic Pembicara Fields
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.getElementById('pembicaraContainer');
            const addBtn = document.getElementById('addPembicara');

            // Function to toggle remove buttons visibility
            function toggleRemoveButtons() {
                const items = container.querySelectorAll('.pembicara-item');
                items.forEach((item, index) => {
                    const removeBtn = item.querySelector('.remove-pembicara');
                    if (items.length > 1) {
                        removeBtn.classList.remove('opacity-0', 'pointer-events-none');
                    } else {
                        removeBtn.classList.add('opacity-0', 'pointer-events-none');
                    }
                });
            }

            // Add pembicara field
            addBtn.addEventListener('click', function() {
                const newField = document.createElement('div');
                newField.className = 'pembicara-item flex gap-2';
                newField.innerHTML = `
                    <input type="text" name="pembicara[]" placeholder="Nama pembicara"
                        class="flex-1 border border-gray-300 rounded-lg px-3 py-2 sm:px-4 sm:py-2.5 text-sm sm:text-base focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                    <button type="button"
                        class="remove-pembicara px-3 py-2 text-red-600 bg-red-50 rounded-lg hover:bg-red-100 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </button>
                `;
                container.appendChild(newField);
                toggleRemoveButtons();
            });

            // Remove pembicara field using event delegation
            container.addEventListener('click', function(e) {
                if (e.target.closest('.remove-pembicara')) {
                    const item = e.target.closest('.pembicara-item');
                    if (container.querySelectorAll('.pembicara-item').length > 1) {
                        item.remove();
                        toggleRemoveButtons();
                    }
                }
            });

            // Initialize
            toggleRemoveButtons();
        });
    </script>
@endsection
