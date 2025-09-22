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
                        <input type="text" id="title" name="title"
                            value="{{ old('title', $pengurus->title ?? '') }}"
                            class="mt-1 block w-full rounded-lg border py-2 px-3 border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 text-sm">
                    </div>

                    <!-- Address -->
                    <div>
                        <label for="address" class="block text-sm font-medium text-gray-700">Alamat <span
                                class="text-red-500">*</span></label>
                        <textarea id="address" name="address" rows="2"
                            class="mt-1 block w-full rounded-lg border py-2 px-3 border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 text-sm">{{ old('address', $pengurus->address ?? '') }}</textarea>
                    </div>
                </div>

                <!-- Description (full width) -->
                <div>
                    <label for="descroption" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                    <textarea id="descroption" name="descroption" rows="3"
                        class="mt-1 block w-full rounded-lg border py-2 px-3 border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 text-sm">{{ old('descroption', $pengurus->descroption ?? '') }}</textarea>
                </div>

                <!-- Kontak -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700">Telepon</label>
                        <input type="text" id="phone" name="phone"
                            value="{{ old('phone', $pengurus->phone ?? '') }}"
                            class="mt-1 block w-full rounded-lg border py-2 px-3 border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 text-sm">
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" id="email" name="email"
                            value="{{ old('email', $pengurus->email ?? '') }}"
                            class="mt-1 block w-full rounded-lg border py-2 px-3 border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 text-sm">
                    </div>
                </div>

                <!-- Kategori -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="category_daftar_id" class="block text-sm font-medium text-gray-700">
                            Pengurus DPD
                        </label>
                        <div class="relative mt-1">
                            <select id="category_daftar_id" name="category_daftar_id"
                                class="block w-full rounded-lg border py-2 px-3 border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 text-sm appearance-none">
                                <option value="">Pilih Pengurus</option>
                                @foreach ($categoryDaftar as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_daftar_id', $pengurus->category_daftar_id ?? '') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
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
                                        {{ old('category_pengurus_id', $pengurus->category_pengurus_id ?? '') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
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

                <!-- Drag & Drop Image Upload (Alpine.js + Tailwind) -->
                <div x-data="imageDropzone(@json($pengurus->image ?? null))" class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">Image</label>

                    <!-- Dropzone (hanya muncul kalau tidak ada preview & tidak ada existing) -->
                    <div x-show="!previewUrl && !existingUrl" x-ref="dropzone" @click="$refs.file.click()"
                        @dragover.prevent="isDrag = true" @dragleave.prevent="isDrag = false"
                        @drop.prevent="handleDrop($event)"
                        :class="{
                            'border-emerald-400 bg-emerald-50': isDrag,
                            'border-gray-300 bg-white': !isDrag
                        }"
                        class="flex flex-col items-center justify-center gap-2 border-2 border-dashed rounded-lg p-6 cursor-pointer transition-colors text-center"
                        style="min-height: 150px;">
                        <!-- SVG icon -->
                        <svg class="w-12 h-12 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M7 16a4 4 0 01-.88-7.9A5.002 5.002 0 0117.9 9h.1a4.992 4.992 0 012.9 9.1M15 13l-3-3m0 0l-3 3m3-3v12" />
                        </svg>

                        <p class="text-sm font-medium text-gray-700">Tarik & lepas gambar di sini</p>
                        <p class="text-xs text-gray-500">atau klik untuk memilih (jpg, png, gif). Maks 2MB.</p>

                        <!-- Hidden file input -->
                        <input x-ref="file" type="file" name="image" accept="image/*" class="hidden"
                            @change="handleFile($event.target.files[0])">
                    </div>

                    <!-- Preview baru diunggah -->
                    <div x-show="previewUrl" class="flex flex-col items-center">
                        <img :src="previewUrl" alt="Preview" class="h-40 rounded-lg border object-contain">
                        <div class="flex items-center justify-between w-full mt-2">
                            <span class="text-xs text-gray-600 truncate" x-text="fileName || 'Preview'"></span>
                            <button type="button" @click="removeFile()"
                                class="px-2 py-1 text-xs bg-red-100 text-red-600 rounded hover:bg-red-200">
                                Hapus
                            </button>
                        </div>
                    </div>

                    <!-- Preview gambar lama (jika ada dan belum diganti) -->
                    <div x-show="!previewUrl && existingUrl" class="flex flex-col items-center">
                        <img :src="existingUrl" alt="Existing image" class="h-40 rounded-lg border object-contain">
                        <p class="text-xs text-gray-500 mt-1">Gambar saat ini</p>
                    </div>

                    <!-- Validation -->
                    @error('image')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>



                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <input type="url" name="fb" placeholder="Facebook URL"
                        value="{{ old('fb', $pengurus->fb ?? '') }}"
                        class="rounded-lg border py-2 px-3 border-gray-300 text-sm focus:ring-emerald-500 focus:border-emerald-500">
                    <input type="url" name="ig" placeholder="Instagram URL"
                        value="{{ old('ig', $pengurus->ig ?? '') }}"
                        class="rounded-lg border py-2 px-3 border-gray-300 text-sm focus:ring-emerald-500 focus:border-emerald-500">
                    <input type="url" name="tiktok" placeholder="TikTok URL"
                        value="{{ old('tiktok', $pengurus->tiktok ?? '') }}"
                        class="rounded-lg border py-2 px-3 border-gray-300 text-sm focus:ring-emerald-500 focus:border-emerald-500">
                    <input type="url" name="yt" placeholder="YouTube URL"
                        value="{{ old('yt', $pengurus->yt ?? '') }}"
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

    <script>
        function imageDropzone(existingPath = null) {
            return {
                isDrag: false,
                previewUrl: null,
                fileName: '',
                existingUrl: existingPath ? ('{{ asset('storage') }}' + '/' + existingPath).replace(/\/+/g, '/') : null,
                handleDrop(e) {
                    const dt = e.dataTransfer;
                    if (!dt || !dt.files || !dt.files.length) return;
                    const file = dt.files[0];
                    this.handleFile(file);
                    this.isDrag = false;
                },
                handleFile(file) {
                    if (!file) return;
                    // simple size/type checks (adjust as needed)
                    if (!file.type.startsWith('image/')) {
                        alert('File harus gambar.');
                        return;
                    }
                    if (file.size > 2 * 1024 * 1024) { // 2MB
                        alert('Ukuran file maksimal 2MB.');
                        return;
                    }
                    this.fileName = file.name;
                    const reader = new FileReader();
                    reader.onload = (ev) => {
                        this.previewUrl = ev.target.result;
                    };
                    reader.readAsDataURL(file);

                    // assign file to the hidden input (for browsers that preserve file input when replaced)
                    // We already have input[name="image"]; setting value via DataTransfer for form submit:
                    const dataTransfer = new DataTransfer();
                    dataTransfer.items.add(file);
                    this.$refs.file.files = dataTransfer.files;
                },
                removeFile() {
                    this.previewUrl = null;
                    this.fileName = '';
                    // clear file input
                    this.$refs.file.value = null;
                }
            }
        }
    </script>
@endsection
