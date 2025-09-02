@extends('layouts.app', ['title' => 'Tambah Testimony'])

@section('content')
    <div class="max-w-3xl mx-auto p-6 bg-white shadow rounded-lg">
        <h1 class="text-2xl font-bold text-emerald-700 mb-6">Tambah Testimony</h1>

        <form action="{{ route('testimonies.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <!-- Checkbox tampil di home -->
            <div class="flex items-center">
                <input type="checkbox" name="display_homepage" value="1"
                    {{ old('display_homepage') ? 'checked' : '' }}
                    class="h-4 w-4 text-emerald-600 border border-gray-300 rounded">
                <label class="ml-2 text-sm text-gray-700">Tampilkan di Homepage</label>
            </div>

            <!-- Kategori -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Kategori</label>

                <div class="relative">
                    <select name="category_dpd_id"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 pr-10 bg-white
                       focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500
                       appearance-none">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_dpd_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>

                    <!-- Arrow SVG -->
                    <svg class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 h-5 w-5 text-gray-500"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M6 9l6 6 6-6" />
                    </svg>
                </div>
                @error('category_dpd_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Nama & Judul -->
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nama</label>
                    <input type="text" name="name" value="{{ old('name') }}"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-emerald-500 focus:border-emerald-500">
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Judul</label>
                    <input type="text" name="title" value="{{ old('title') }}"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-emerald-500 focus:border-emerald-500">
                    @error('title')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Deskripsi -->
            <div>
                <label class="block mb-1 font-medium">Deskripsi</label>
                <textarea name="description" id="description" rows="4"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-emerald-500 focus:border-emerald-500">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Upload Gambar -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Gambar</label>
                <input type="file" name="image"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-emerald-500 focus:border-emerald-500">
                @error('image')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Action -->
            <div class="flex justify-end">
                <a href="{{ route('testimonies.index') }}" class="px-4 py-2 bg-gray-300 rounded-lg mr-2">Batal</a>
                <button type="submit" class="px-4 py-2 bg-emerald-600 text-white rounded-lg">Simpan</button>
            </div>
        </form>
    </div>

    <script>
        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
