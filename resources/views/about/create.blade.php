@extends('layouts.app', ['title' => 'Tambah About'])

@section('content')
    <div class="max-w-3xl mx-auto bg-white rounded-2xl shadow-lg p-6 space-y-6">

        <!-- Header -->
        <h1 class="text-2xl font-bold text-emerald-700">Tambah About</h1>

        <!-- Form -->
        <form method="POST" action="{{ route('about.store') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Judul -->
            <div class="space-y-1">
                <label for="title" class="block text-sm font-semibold text-gray-700">Judul</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
                @error('title')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
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

            <!-- Gambar 1 -->
            <div class="space-y-1">
                <label for="image" class="block text-sm font-semibold text-gray-700">Gambar 1</label>
                <input type="file" name="image" id="image"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2">
                @error('image')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Gambar 2 -->
            <div class="space-y-1">
                <label for="image2" class="block text-sm font-semibold text-gray-700">Gambar 2</label>
                <input type="file" name="image2" id="image2"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2">
                @error('image2')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tombol Aksi -->
            <div class="flex justify-end space-x-3">
                <a href="{{ route('about.index') }}"
                    class="px-5 py-2 rounded-lg bg-gray-200 text-gray-700 hover:bg-gray-300 transition">Batal</a>
                <button type="submit"
                    class="px-5 py-2 rounded-lg bg-emerald-600 text-white hover:bg-emerald-700 transition">Simpan</button>
            </div>

        </form>
    </div>
    
    <script>
        // CKEditor
        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
