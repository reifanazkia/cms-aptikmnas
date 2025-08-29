@extends('layouts.app', ['title' => 'Tambah Pengurus - Step 1'])

@section('content')
    <div class="max-w-5xl mx-auto">
        <div class="bg-white rounded-2xl shadow-lg p-6 space-y-6">
            <!-- Header -->
            <div class="flex items-center justify-between border-b pb-4">
                <h1 class="text-2xl font-bold text-emerald-700">Tambah Pengurus - Step 1 dari 3</h1>
                <a href="{{ route('pengurus.index') }}"
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-gray-100 text-gray-700 hover:bg-gray-200 transition">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>

            <!-- Progress -->
            <div class="w-full bg-gray-100 rounded-full h-2 mt-2">
                <div class="bg-emerald-500 h-2 rounded-full" style="width: 33%"></div>
            </div>

            <!-- Error -->
            @if ($errors->any())
                <div class="p-4 rounded-lg bg-red-50 text-red-700">
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
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="col-span-2">
                        <label for="title" class="block text-sm font-medium text-gray-700">Title <span
                                class="text-red-500">*</span></label>
                        <input type="text" id="title" name="title"
                            class="mt-1 block w-full rounded-lg border py-2 px-4 border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 @error('title') border-red-500 @enderror"
                            value="{{ old('title') }}" required>
                        @error('title')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Address -->
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <label for="address" class="block text-sm font-medium text-gray-700">Alamat <span
                                class="text-red-500">*</span></label>
                        <textarea id="address" name="address" rows="3"
                            class="mt-1 block w-full rounded-lg border py-2 px-4 border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 @error('address') border-red-500 @enderror"
                            required>{{ old('address') }}</textarea>
                        @error('address')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="descroption" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                        <textarea name="descroption" id="descroption" rows="4"
                            class="w-full rounded-lg px-3 py-2 text-sm border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                        @error('descroption')
                            <p cla ss="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Kontak -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700">Telepon <span
                                class="text-red-500">*</span></label>
                        <input type="text" id="phone" name="phone"
                            class="mt-1 block w-full rounded-lg border py-2 px-4 border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 @error('phone') border-red-500 @enderror"
                            value="{{ old('phone') }}" required>
                        @error('phone')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email <span
                                class="text-red-500">*</span></label>
                        <input type="email" id="email" name="email"
                            class="mt-1 block w-full rounded-lg border py-2 px-4 border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 @error('email') border-red-500 @enderror"
                            value="{{ old('email') }}" required>
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Dropdown -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div x-data="{ open: false }" class="relative w-full">
                        <label for="category_daftar_id" class="block text-sm font-medium text-gray-700">Daftar Pengurus
                            DPD</label>

                        <!-- Select dengan arrow custom -->
                        <select id="category_daftar_id" name="category_daftar_id" @focus="open = true" @blur="open = false"
                            class="mt-1 block w-full rounded-lg border py-2 px-4 border-gray-300 appearance-none focus:ring-emerald-500 focus:border-emerald-500">
                            <option value="">Pilih Pengurus</option>
                            @foreach ($categoryDaftar as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_daftar_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>

                        <!-- SVG Arrow -->
                        <div class="pointer-events-none absolute inset-y-0 right-3 top-6 flex items-center">
                            <svg :class="{ 'rotate-180': open }"
                                class="w-4 h-4 text-gray-500 transition-transform duration-200" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>

                    <div class="relative w-full">
                        <label for="category_pengurus_id" class="block text-sm font-medium text-gray-700">Pengurus</label>

                        <select id="category_pengurus_id" name="category_pengurus_id"
                            class="mt-1 block w-full rounded-lg border py-2 px-4 border-gray-300 appearance-none focus:ring-emerald-500 focus:border-emerald-500">
                            <option value="">Pilih Kategori Pengurus</option>
                            @foreach ($categoryPengurus as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_pengurus_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>

                        <!-- Custom SVG Arrow -->
                        <div class="pointer-events-none absolute inset-y-0 right-3 top-6 flex items-center">
                            <svg class="w-4 h-4 text-gray-500 transition-transform duration-200" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>

                </div>

                <!-- Image -->
                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700">Image</label>
                    <input type="file" id="image" name="image" accept="image/*"
                        class="mt-1 block w-full rounded-lg border py-2 px-4 border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 @error('image') border-red-500 @enderror">
                    <p class="text-xs text-gray-500 mt-1">Format: JPEG, PNG, JPG, GIF. Maksimal 2MB</p>
                    @error('image')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Social -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="fb" class="block text-sm font-medium text-gray-700">Facebook</label>
                        <input type="url" id="fb" name="fb"
                            class="mt-1 block w-full rounded-lg border py-2 px-4 border-gray-300 focus:ring-emerald-500 focus:border-emerald-500"
                            value="{{ old('fb') }}" placeholder="https://facebook.com/username">
                    </div>
                    <div>
                        <label for="ig" class="block text-sm font-medium text-gray-700">Instagram</label>
                        <input type="url" id="ig" name="ig"
                            class="mt-1 block w-full rounded-lg border py-2 px-4 border-gray-300 focus:ring-emerald-500 focus:border-emerald-500"
                            value="{{ old('ig') }}" placeholder="https://instagram.com/username">
                    </div>
                    <div>
                        <label for="tiktok" class="block text-sm font-medium text-gray-700">TikTok</label>
                        <input type="url" id="tiktok" name="tiktok"
                            class="mt-1 block w-full rounded-lg border py-2 px-4 border-gray-300 focus:ring-emerald-500 focus:border-emerald-500"
                            value="{{ old('tiktok') }}" placeholder="https://tiktok.com/@username">
                    </div>
                    <div>
                        <label for="yt" class="block text-sm font-medium text-gray-700">YouTube</label>
                        <input type="url" id="yt" name="yt"
                            class="mt-1 block w-full rounded-lg border py-2 px-4 border-gray-300 focus:ring-emerald-500 focus:border-emerald-500"
                            value="{{ old('yt') }}" placeholder="https://youtube.com/channel/...">
                    </div>
                </div>

                <!-- Button -->
                <div class="flex justify-end">
                    <button type="submit"
                        class="inline-flex items-center gap-2 px-6 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition">
                        Lanjut ke Step 2 <i class="fas fa-arrow-right"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script>
        ClassicEditor
            .create(document.querySelector('#descroption'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
