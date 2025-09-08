@extends('layouts.app', ['title' => 'Edit Pengurus - Step 1'])

@section('content')
    <div class="max-w-4xl mx-auto px-4 sm:px-0">
        <div class="bg-white rounded-2xl shadow-lg floating-card p-4 sm:p-6 space-y-6">

            <!-- Header & Progress -->
            <div
                class="flex flex-col sm:flex-row sm:items-center sm:justify-between border-b border-emerald-100 pb-4 mb-4 gap-3">
                <h1 class="text-xl sm:text-2xl font-bold text-emerald-700">Edit Pengurus - Step 1 dari 3</h1>
                <div class="flex flex-col sm:flex-row gap-2 w-full sm:w-auto">
                    <a href="{{ route('pengurus.show', $pengurus->id) }}"
                        class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 flex items-center justify-center gap-1 w-full sm:w-auto">
                        <i class="fas fa-eye"></i> Lihat Detail
                    </a>
                    <a href="{{ route('pengurus.index') }}"
                        class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300 flex items-center justify-center gap-1 w-full sm:w-auto">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>

            <!-- Progress Bar -->
            <div class="h-2 w-full bg-gray-200 rounded-full mb-4 overflow-hidden">
                <div class="h-2 bg-emerald-500 rounded-full" style="width: 33%"></div>
            </div>

            <!-- Alerts -->
            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-md shadow-sm mb-3 text-sm">
                    <ul class="list-disc pl-5 mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form -->
            <form action="{{ route('pengurus.edit.step1.update', $pengurus->id) }}" method="POST"
                enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Nama -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Nama <span
                            class="text-red-500">*</span></label>
                    <input type="text" id="title" name="title" value="{{ old('title', $pengurus->title) }}"
                        class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-emerald-400 focus:border-emerald-500 @error('title') border-red-500 @enderror"
                        required>
                    @error('title')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Alamat & Deskripsi -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="address" class="block text-sm font-medium text-gray-700">Alamat <span
                                class="text-red-500">*</span></label>
                        <textarea id="address" name="address" rows="3"
                            class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-emerald-400 focus:border-emerald-500 @error('address') border-red-500 @enderror"
                            required>{{ old('address', $pengurus->address) }}</textarea>
                        @error('address')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="descroption" class="block text-sm font-medium text-gray-700">
                            Deskripsi <span class="text-red-500">*</span>
                        </label>
                        <textarea id="descroption" name="descroption"
                            class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-emerald-400 focus:border-emerald-500 @error('descroption') border-red-500 @enderror"
                            required>{{ old('descroption', $pengurus->descroption) }}</textarea>
                        @error('descroption')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Telepon & Email -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700">Telepon <span
                                class="text-red-500">*</span></label>
                        <input type="text" id="phone" name="phone" value="{{ old('phone', $pengurus->phone) }}"
                            class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-emerald-400 focus:border-emerald-500 @error('phone') border-red-500 @enderror"
                            required>
                        @error('phone')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email <span
                                class="text-red-500">*</span></label>
                        <input type="email" id="email" name="email" value="{{ old('email', $pengurus->email) }}"
                            class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-emerald-400 focus:border-emerald-500 @error('email') border-red-500 @enderror"
                            required>
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Kategori -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="category_daftar_id" class="block text-sm font-medium text-gray-700">Kategori
                            Daftar</label>
                        <select id="category_daftar_id" name="category_daftar_id"
                            class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-emerald-400 focus:border-emerald-500 @error('category_daftar_id') border-red-500 @enderror">
                            <option value="">Pilih Kategori Daftar</option>
                            @foreach ($categoryDaftar as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_daftar_id', $pengurus->category_daftar_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_daftar_id')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="category_pengurus_id" class="block text-sm font-medium text-gray-700">Kategori
                            Pengurus</label>
                        <select id="category_pengurus_id" name="category_pengurus_id"
                            class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-emerald-400 focus:border-emerald-500 @error('category_pengurus_id') border-red-500 @enderror">
                            <option value="">Pilih Kategori Pengurus</option>
                            @foreach ($categoryPengurus as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_pengurus_id', $pengurus->category_pengurus_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_pengurus_id')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Foto Profil -->
                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700">Foto Profil</label>
                    @if ($pengurus->image)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $pengurus->image) }}" alt="Current Image"
                                class="border border-gray-300 rounded-lg w-24 sm:w-32">
                            <small class="text-gray-500 block">Gambar saat ini</small>
                        </div>
                    @endif
                    <input type="file" id="image" name="image"
                        class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-emerald-400 focus:border-emerald-500 @error('image') border-red-500 @enderror"
                        accept="image/*">
                    <p class="text-xs text-gray-500 mt-1">Format: JPEG, PNG, JPG, GIF. Maksimal 2MB.</p>
                    @error('image')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Sosial Media -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="fb" class="block text-sm font-medium text-gray-700">Facebook</label>
                        <input type="url" id="fb" name="fb" value="{{ old('fb', $pengurus->fb) }}"
                            class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-emerald-400 focus:border-emerald-500 @error('fb') border-red-500 @enderror"
                            placeholder="https://facebook.com/username">
                        @error('fb')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="ig" class="block text-sm font-medium text-gray-700">Instagram</label>
                        <input type="url" id="ig" name="ig" value="{{ old('ig', $pengurus->ig) }}"
                            class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-emerald-400 focus:border-emerald-500 @error('ig') border-red-500 @enderror"
                            placeholder="https://instagram.com/username">
                        @error('ig')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="tiktok" class="block text-sm font-medium text-gray-700">TikTok</label>
                        <input type="url" id="tiktok" name="tiktok"
                            value="{{ old('tiktok', $pengurus->tiktok) }}"
                            class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-emerald-400 focus:border-emerald-500 @error('tiktok') border-red-500 @enderror"
                            placeholder="https://tiktok.com/@username">
                        @error('tiktok')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="yt" class="block text-sm font-medium text-gray-700">YouTube</label>
                        <input type="url" id="yt" name="yt" value="{{ old('yt', $pengurus->yt) }}"
                            class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-emerald-400 focus:border-emerald-500 @error('yt') border-red-500 @enderror"
                            placeholder="https://youtube.com/channel/...">
                        @error('yt')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Submit -->
                <div class="flex flex-col sm:flex-row justify-end gap-2 mt-4">
                    <button type="submit"
                        class="w-full sm:w-auto px-4 py-2 bg-emerald-500 hover:bg-emerald-600 text-white rounded-lg flex items-center justify-center gap-1">
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
