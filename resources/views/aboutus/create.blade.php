@extends('layouts.app', ['title' => 'Tambah Tentang Kami'])

@section('content')
    <div class="p-4 sm:p-6 bg-white rounded-lg shadow space-y-6 max-w-2xl mx-auto">

        <!-- Judul Halaman -->
        <div class="text-center">
            <h1 class="text-2xl font-bold text-emerald-700">Tambah Tentang Kami</h1>
            <p class="text-sm text-gray-600 mt-1">Lengkapi data berikut untuk menambah informasi.</p>
        </div>

        <!-- Error Message -->
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded-lg">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 text-red-700 p-3 rounded-lg">
                {{ session('error') }}
            </div>
        @endif

        <!-- Form -->
        <form action="{{ route('aboutus.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <!-- Judul -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Judul</label>
                <input type="text" name="title" value="{{ old('title') }}"
                    class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-emerald-500 focus:border-emerald-500">
                @error('title')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Kategori -->
            <div class="relative">
                <label class="block text-sm font-medium text-gray-700">Kategori</label>
                <select name="category_aboutus_id"
                    class="appearance-none w-full mt-1 px-4 py-2 pr-10 border border-gray-300 rounded-lg focus:ring-emerald-500 focus:border-emerald-500">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_aboutus_id') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>

                <!-- SVG arrow -->
                <svg class="pointer-events-none absolute right-3 top-11 -translate-y-1/2 h-5 w-5 text-gray-500"
                    viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd"
                        d="M5.23 7.21a.75.75 0 0 1 1.06.02L10 10.17l3.71-2.94a.75.75 0 1 1 .94 1.17l-4.24 3.36a.75.75 0 0 1-.94 0L5.21 8.4a.75.75 0 0 1 .02-1.19z"
                        clip-rule="evenodd" />
                </svg>
                @error('category_aboutus_id')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Deskripsi -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                <textarea name="description" id="description" rows="4"
                    class="w-full rounded-lg px-3 py-2 text-sm border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Upload Gambar Drag & Drop -->
            <div x-data="imageUpload()" class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">Gambar</label>

                <!-- Area Drag & Drop -->
                <div x-on:click="triggerInput" x-on:dragover.prevent="isDrag = true" x-on:dragleave.prevent="isDrag = false"
                    x-on:drop.prevent="handleDrop($event)" :class="{ 'border-emerald-500 bg-emerald-50': isDrag }"
                    class="relative flex flex-col items-center justify-center border-2 border-dashed border-gray-300 rounded-lg h-40 cursor-pointer transition-colors">

                    <!-- Preview Gambar -->
                    <template x-if="previewUrl">
                        <img :src="previewUrl" alt="Preview" class="h-full object-contain">
                    </template>

                    <!-- Placeholder Upload -->
                    <template x-if="!previewUrl">
                        <div class="flex flex-col items-center justify-center text-gray-400">
                            <!-- SVG Awan -->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                class="h-12 w-12 text-emerald-600">
                                <path d="M17.5 19a4.5 4.5 0 0 0 .5-9 6 6 0 0 0-11.5-1.5A4.5 4.5 0 0 0 6.5 19h11z" />
                                <path d="M12 11v6" />
                                <path d="M9 14l3-3 3 3" />
                            </svg>
                            <span>Drag & Drop atau klik untuk upload</span>
                        </div>
                    </template>
                </div>

                <input type="file" name="image" accept="image/*" x-ref="fileInput"
                    x-on:change="handleFiles($event.target.files)" class="hidden">

                @error('image')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Checkbox Tampilkan -->
            <div class="flex items-center">
                <input type="checkbox" name="display_on_home" value="1" {{ old('display_on_home') ? 'checked' : '' }}
                    class="h-4 w-4 text-emerald-600 border-gray-300 rounded">
                <label class="ml-2 block text-sm text-gray-700">Tampilkan di Halaman Depan</label>
            </div>

            <!-- Tombol -->
            <div class="flex justify-between space-x-2">
                <a href="{{ route('aboutus.index') }}"
                    class="flex-1 px-4 py-2 rounded-lg bg-gray-200 text-gray-700 text-center hover:bg-gray-300">Batal</a>
                <button type="submit"
                    class="flex-1 px-4 py-2 rounded-lg bg-emerald-600 text-white text-center hover:bg-emerald-700">Simpan</button>
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

    <script>
        function imageUpload() {
            return {
                previewUrl: null,
                isDrag: false,
                triggerInput() {
                    this.$refs.fileInput.click();
                },
                handleFiles(files) {
                    if (!files.length) return;
                    const file = files[0];
                    if (file.size > 2 * 1024 * 1024) { // maksimal 2MB
                        alert('Ukuran file maksimal 2MB');
                        return;
                    }
                    this.previewUrl = URL.createObjectURL(file);
                },
                handleDrop(event) {
                    this.isDrag = false;
                    const files = event.dataTransfer.files;
                    this.handleFiles(files);
                }
            }
        }
    </script>
@endsection
