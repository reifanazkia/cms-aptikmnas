@extends('layouts.app', ['title' => 'Tambah Pengurus - Step 1'])

@section('content')
    <div class="max-w-5xl mx-auto px-4 sm:px-0">
        <div class="bg-white rounded-2xl shadow-lg p-6 sm:p-8 space-y-6">
            <!-- Header -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 border-b pb-4">
                <h1 class="text-xl sm:text-2xl font-bold text-emerald-700">Tambah Pengurus - Step 1 dari 3</h1>
                <a href="{{ route('pengurus.index') }}"
                    class="inline-flex items-center gap-2 px-3 py-2 sm:px-4 sm:py-2 rounded-lg bg-gray-100 text-gray-700 hover:bg-gray-200 transition text-sm sm:text-base">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>

            <!-- Progress -->
            <div class="w-full bg-gray-100 rounded-full h-2">
                <div class="bg-emerald-500 h-2 rounded-full" style="width: 33%"></div>
            </div>

            <!-- Error -->
            @if ($errors->any())
                <div class="p-4 rounded-lg bg-red-50 text-red-700 text-sm">
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form -->
            <form action="{{ route('pengurus.create.step1.store') }}" method="POST" enctype="multipart/form-data"
                class="space-y-6">
                @csrf

                <!-- Grid Utama -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Title -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700">Title <span
                                class="text-red-500">*</span></label>
                        <input type="text" id="title" name="title" value="{{ old('title') }}"
                            class="mt-1 block w-full rounded-lg border py-2 px-3 border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 text-sm">
                    </div>

                    <!-- Address -->
                    <div>
                        <label for="address" class="block text-sm font-medium text-gray-700">Alamat <span
                                class="text-red-500">*</span></label>
                        <textarea id="address" name="address" rows="2"
                            class="mt-1 block w-full rounded-lg border py-2 px-3 border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 text-sm">{{ old('address') }}</textarea>
                    </div>
                </div>

                <!-- Description (full width) -->
                <div>
                    <label for="descroption" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                    <textarea id="descroption" name="descroption" rows="3"
                        class="mt-1 block w-full rounded-lg border py-2 px-3 border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 text-sm">{{ old('descroption') }}</textarea>
                </div>

                <!-- Kontak -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700">Telepon</label>
                        <input type="text" id="phone" name="phone" value="{{ old('phone') }}"
                            class="mt-1 block w-full rounded-lg border py-2 px-3 border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 text-sm">
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                            class="mt-1 block w-full rounded-lg border py-2 px-3 border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 text-sm">
                    </div>
                </div>

                <!-- Kategori -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="category_daftar_id" class="block text-sm font-medium text-gray-700">
                            Daftar Pengurus DPD
                        </label>
                        <div class="relative mt-1">
                            <select id="category_daftar_id" name="category_daftar_id"
                                class="block w-full rounded-lg border py-2 px-3 border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 text-sm appearance-none">
                                <option value="">Pilih Pengurus</option>
                                @foreach ($categoryDaftar as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_daftar_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>

                            <!-- SVG panah dropdown -->
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                <svg class="h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </div>
                    </div>


                    <div>
                        <label for="category_pengurus_id" class="block text-sm font-medium text-gray-700">
                            Pengurus
                        </label>
                        <div class="relative mt-1">
                            <select id="category_pengurus_id" name="category_pengurus_id"
                                class="block w-full rounded-lg border py-2 px-3 border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 text-sm appearance-none">
                                <option value="">Pilih Kategori Pengurus</option>
                                @foreach ($categoryPengurus as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_pengurus_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>

                            <!-- SVG dropdown icon -->
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                <svg class="h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Foto & Media -->
                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700">Foto</label>
                    <input type="file" id="image" name="image"
                        class="mt-1 block w-full rounded-lg border py-2 px-3 border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 text-sm">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <input type="url" name="fb" placeholder="Facebook URL"
                        class="rounded-lg border py-2 px-3 border-gray-300 text-sm focus:ring-emerald-500 focus:border-emerald-500">
                    <input type="url" name="ig" placeholder="Instagram URL"
                        class="rounded-lg border py-2 px-3 border-gray-300 text-sm focus:ring-emerald-500 focus:border-emerald-500">
                    <input type="url" name="tiktok" placeholder="TikTok URL"
                        class="rounded-lg border py-2 px-3 border-gray-300 text-sm focus:ring-emerald-500 focus:border-emerald-500">
                    <input type="url" name="yt" placeholder="YouTube URL"
                        class="rounded-lg border py-2 px-3 border-gray-300 text-sm focus:ring-emerald-500 focus:border-emerald-500">
                </div>

                <!-- Submit -->
                <div class="flex justify-end">
                    <button type="submit"
                        class="inline-flex items-center gap-2 px-5 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 text-sm sm:text-base">
                        Lanjut ke Step 2 <i class="fas fa-arrow-right"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        ClassicEditor.create(document.querySelector('#descroption')).catch(error => console.error(error));
    </script>
@endsection
