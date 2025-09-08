@extends('layouts.app', ['title' => 'Tambah Slider'])

@section('content')
    <div class="max-w-4xl mx-auto p-4 sm:p-6 bg-white shadow rounded-lg">
        <!-- Header -->
        <div class="mb-6 border-b border-emerald-100 pb-3">
            <h1 class="text-xl sm:text-2xl font-bold text-emerald-700">Tambah Slider</h1>
            <p class="text-sm text-gray-500">Isi form di bawah untuk menambahkan slider baru</p>
        </div>

        <form action="{{ route('slider.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf

            <!-- Judul -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Judul</label>
                <input type="text" name="title" value="{{ old('title') }}"
                    class="w-full rounded-lg border py-2.5 px-4 border-gray-300 focus:ring-emerald-500 focus:border-emerald-500">
            </div>

            <!-- Subjudul -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Subjudul</label>
                <textarea name="subtitle" rows="3"
                    class="w-full rounded-lg border py-2.5 px-4 border-gray-300 focus:ring-emerald-500 focus:border-emerald-500">{{ old('subtitle') }}</textarea>
            </div>

            <!-- Upload Gambar -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Gambar</label>
                <input type="file" name="image" accept="image/*"
                    class="w-full rounded-lg border py-2.5 px-4 border-gray-300 focus:ring-emerald-500 focus:border-emerald-500">
                <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG. Max 2MB</p>
            </div>

            <!-- Youtube ID & URL (2 kolom di desktop) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Youtube ID</label>
                    <input type="text" name="youtube_id" value="{{ old('youtube_id') }}"
                        class="w-full rounded-lg border py-2.5 px-4 border-gray-300 focus:ring-emerald-500 focus:border-emerald-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">URL Link</label>
                    <input type="url" name="url_link" value="{{ old('url_link') }}"
                        class="w-full rounded-lg border py-2.5 px-4 border-gray-300 focus:ring-emerald-500 focus:border-emerald-500">
                </div>
            </div>

            <!-- Button Text -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Teks Tombol</label>
                <input type="text" name="button_text" value="{{ old('button_text') }}"
                    class="w-full rounded-lg border py-2.5 px-4 border-gray-300 focus:ring-emerald-500 focus:border-emerald-500">
            </div>

            <!-- Checkbox -->
            <div class="flex items-center">
                <input type="checkbox" name="display_on_home" value="1" {{ old('display_on_home') ? 'checked' : '' }}
                    class="h-4 w-4 text-emerald-600 border-gray-300 rounded focus:ring-emerald-500">
                <label class="ml-2 text-sm text-gray-700">Tampilkan di Home</label>
            </div>

            <!-- Tombol Aksi -->
            <div class="flex flex-col sm:flex-row sm:justify-end gap-3 pt-4 border-t border-gray-100">
                <a href="{{ route('slider.index') }}"
                    class="w-full sm:w-auto px-4 py-2 rounded-lg bg-gray-200 text-gray-700 text-center hover:bg-gray-300 transition">
                    Batal
                </a>
                <button type="submit"
                    class="w-full sm:w-auto px-4 py-2 rounded-lg bg-emerald-600 text-white font-semibold hover:bg-emerald-700 transition">
                    Simpan
                </button>
            </div>
        </form>
    </div>
@endsection
