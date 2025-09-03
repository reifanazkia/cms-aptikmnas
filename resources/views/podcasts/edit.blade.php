@extends('layouts.app', ['title' => 'Edit Podcast'])

@section('content')
    <div class="max-w-4xl mx-auto">
        <!-- Card Utama -->
        <div class="bg-white rounded-2xl shadow-lg shadow-emerald-200 p-8 space-y-8">

            <!-- Header -->
            <div class="flex items-center justify-between border-b pb-4">
                <h1 class="text-2xl font-bold text-emerald-700 flex items-center gap-2">
                    <!-- SVG Pensil -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-emerald-600" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15.232 5.232l3.536 3.536M9 11l6-6 3 3-6 6H9v-3zM5 19h14" />
                    </svg>
                    Edit Podcast
                </h1>
                <a href="{{ route('podcasts.index') }}"
                    class="px-4 py-2 rounded-lg bg-gray-100 text-gray-700 hover:bg-gray-200 transition">
                    Kembali
                </a>
            </div>

            <!-- Error Alert -->
            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 p-4 rounded-lg">
                    <ul class="list-disc pl-5 space-y-1 text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form -->
            <form action="{{ route('podcasts.update', $podcast->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Judul -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Judul</label>
                    <input type="text" name="title"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg  focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition"
                        value="{{ old('title', $podcast->title) }}" required>
                </div>

                <!-- Deskripsi -->
                <div class="md:col-span-2">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                    <textarea name="description" id="description" rows="4"
                        class="w-full rounded-lg px-3 py-2 text-sm border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 @error('description') border-red-500 @enderror">{{ old('description', $podcast->description) }}</textarea>
                    @error('description')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>


                <div class="grid grid-cols-2 gap-6">
                    <!-- YouTube ID -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">YouTube ID</label>
                        <input type="text" name="yt_id"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg  focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition"
                            value="{{ old('yt_id', $podcast->yt_id) }}" required>
                    </div>

                    <!-- Tanggal Publikasi -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Tanggal Publikasi</label>
                        <input type="date" name="pub_date"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg  focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition"
                            value="{{ old('pub_date', $podcast->pub_date->format('Y-m-d')) }}" required>
                    </div>

                    <!-- Pembicara -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Pembicara</label>
                        <input type="text" name="pembicara[]"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg  focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition"
                            value="{{ implode(',', $podcast->pembicara) }}">
                        <p class="text-xs text-gray-500 mt-1">Pisahkan dengan koma jika lebih dari satu.</p>
                    </div>

                    <!-- Kategori -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Kategori</label>
                        <div class="relative">
                            <select name="category_podcasts_id"
                                class="w-full appearance-none px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition"
                                required>
                                <option value="">Pilih Kategori</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ $podcast->category_podcasts_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>

                            <!-- SVG panah -->
                            <svg class="w-5 h-5 text-gray-500 absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>

                </div>

                <!-- Tombol Aksi -->
                <div class="flex justify-end gap-3 pt-4 border-t">
                    <a href="{{ route('podcasts.index') }}"
                        class="px-5 py-2.5 rounded-lg bg-gray-100 text-gray-700 hover:bg-gray-200 transition">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-5 py-2.5 flex items-center gap-2 rounded-lg bg-emerald-600 text-white font-semibold shadow-md shadow-emerald-200 hover:bg-emerald-700 transition">
                        <!-- SVG Save -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Perbarui
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
@endsection
