@extends('layouts.app', ['title' => 'Tambah Testimony'])

@section('content')
    <div class="max-w-3xl mx-auto p-4 sm:p-6">
        <!-- Card Container -->
        <div class="bg-white shadow rounded-2xl p-4 sm:p-6 space-y-6">
            <!-- Header -->
            <div class="border-b pb-4">
                <h1 class="text-xl sm:text-2xl font-bold text-emerald-700">Tambah Testimony</h1>
                <p class="text-sm text-gray-500">Isi form di bawah untuk menambahkan testimony baru.</p>
            </div>

            <form action="{{ route('testimonies.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf

                <!-- Checkbox tampil di home -->
                <div class="flex items-center">
                    <input type="checkbox" name="display_homepage" value="1"
                        {{ old('display_homepage') ? 'checked' : '' }}
                        class="h-4 w-4 text-emerald-600 border-gray-300 rounded focus:ring-emerald-500">
                    <label class="ml-2 text-sm text-gray-700">Tampilkan di Homepage</label>
                </div>

                <!-- Kategori -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                    <div class="relative">
                        <select name="category_dpd_id"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 pr-10 bg-white
                            focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 appearance-none text-sm">
                            <option value="">-- Pilih Kategori --</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_dpd_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>

                        <!-- Arrow SVG -->
                        <svg class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 h-5 w-5 text-gray-400"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path d="M6 9l6 6 6-6" />
                        </svg>
                    </div>
                    @error('category_dpd_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Nama & Judul -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                        <input type="text" name="name" value="{{ old('name') }}"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm
                            focus:ring-emerald-500 focus:border-emerald-500">
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Judul</label>
                        <input type="text" name="title" value="{{ old('title') }}"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm
                            focus:ring-emerald-500 focus:border-emerald-500">
                        @error('title')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Deskripsi -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                    <textarea name="description" id="description" rows="4"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm
                        focus:ring-emerald-500 focus:border-emerald-500">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Upload Gambar -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Upload Gambar</label>
                    <input type="file" name="image"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm
                        focus:ring-emerald-500 focus:border-emerald-500">
                    @error('image')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Action -->
                <div class="flex flex-col sm:flex-row sm:justify-end gap-3 pt-4 border-t">
                    <a href="{{ route('testimonies.index') }}"
                        class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg text-center text-sm hover:bg-gray-300">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-4 py-2 bg-emerald-600 text-white rounded-lg text-sm hover:bg-emerald-700">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
