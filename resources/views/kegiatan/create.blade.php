@extends('layouts.app', ['title' => 'Tambah Kegiatan'])

@section('content')
    <div class="max-w-3xl mx-auto">
        <!-- Card -->
        <div class="bg-white rounded-2xl shadow-md p-8 space-y-6">
            <!-- Header -->
            <div class="flex items-center justify-between border-b pb-4">
                <h1 class="text-2xl font-bold text-emerald-700 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Kegiatan Baru
                </h1>
                <a href="{{ route('kegiatan.index') }}"
                    class="px-4 py-2 text-sm font-medium bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl hover:bg-emerald-100 transition">
                    ← Kembali
                </a>
            </div>

            <!-- Alert Error -->
            @if ($errors->any())
                <div class="p-4 mb-4 text-sm text-red-700 bg-red-50 border border-red-200 rounded-lg">
                    <p class="font-semibold mb-2">Terdapat kesalahan:</p>
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form -->
            <form action="{{ route('kegiatan.store') }}" method="POST" enctype="multipart/form-data" id="kegiatanForm"
                class="space-y-6">
                @csrf

                <!-- Kategori & Judul -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="relative">
                        <label for="category_kegiatan_id" class="block text-sm font-medium text-gray-700 mb-1">
                            Kategori Kegiatan <span class="text-red-500">*</span>
                        </label>
                        <select name="category_kegiatan_id" id="category_kegiatan_id"
                            class="w-full appearance-none rounded-lg px-3 py-2 pr-10 text-sm border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 @error('category_kegiatan_id') border-red-500 @enderror"
                            required>
                            <option value="">Pilih Kategori</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_kegiatan_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>

                        <!-- SVG Icon -->
                        <div class="pointer-events-none absolute inset-y-0 right-3 top-6 flex items-center">
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>

                        @error('category_kegiatan_id')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">
                            Judul Kegiatan <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}" maxlength="255"
                            class="w-full rounded-lg px-3 py-2 text-sm border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 @error('title') border-red-500 @enderror"
                            placeholder="Masukkan judul kegiatan" required>
                        @error('title')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Deskripsi -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                        Deskripsi
                    </label>
                    <textarea name="description" id="description" rows="5"
                        class="w-full rounded-lg px-3 py-2 text-sm border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Upload Gambar -->
                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-1">
                        Gambar Kegiatan <span class="text-red-500">*</span>
                    </label>
                    <input type="file" name="image" id="image" accept="image/jpeg,image/png"
                        class="w-full rounded-lg px-3 py-2 text-sm cursor-pointer border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 @error('image') border-red-500 @enderror"
                        required>
                    
                    @error('image')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror

                    <!-- Preview -->
                    <div id="imagePreview" class="hidden mt-3 rounded-lg border border-gray-200 bg-gray-50 p-3">
                        <img id="previewImg" class="rounded-lg max-h-40 mx-auto" alt="Preview">
                        <button type="button" id="removeImage"
                            class="mt-2 w-full py-1.5 text-sm text-red-600 border border-red-300 rounded-lg hover:bg-red-50">
                            Hapus Gambar
                        </button>
                    </div>
                </div>

                <!-- Footer -->
                <div class="flex items-center justify-between border-t pt-4">
                    <a href="{{ route('kegiatan.index') }}"
                        class="px-4 py-2 text-sm font-medium bg-gray-100 border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-200 transition">
                        Batal
                    </a>
                    <div class="flex gap-2">
                        <button type="reset"
                            class="px-4 py-2 text-sm font-medium bg-white border border-gray-300 rounded-xl hover:bg-gray-50">
                            Reset
                        </button>
                        <button type="submit" id="submitBtn"
                            class="px-4 py-2 text-sm font-medium text-white bg-emerald-600 rounded-xl hover:bg-emerald-700 transition">
                            Simpan Kegiatan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Script -->
    <script>
        // Counter Judul
        const titleInput = document.getElementById('title');
        const counter = document.getElementById('titleCounter');
        titleInput.addEventListener('input', function() {
            const maxLength = 255;
            const currentLength = this.value.length;
            counter.textContent = `${currentLength}/${maxLength} karakter`;
            counter.classList.toggle('text-red-500', maxLength - currentLength < 20);
            counter.classList.toggle('text-gray-500', maxLength - currentLength >= 20);
        });

        // Preview Gambar
        const imageInput = document.getElementById('image');
        const preview = document.getElementById('imagePreview');
        const previewImg = document.getElementById('previewImg');
        const removeBtn = document.getElementById('removeImage');

        imageInput.addEventListener('change', (e) => {
            const file = e.target.files[0];
            if (file) {
                if (!['image/jpeg', 'image/png'].includes(file.type)) {
                    alert('Format harus JPG/PNG');
                    imageInput.value = '';
                    return;
                }
                if (file.size > 2097152) {
                    alert('Ukuran maksimal 2MB');
                    imageInput.value = '';
                    return;
                }
                const reader = new FileReader();
                reader.onload = (e) => {
                    previewImg.src = e.target.result;
                    preview.classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            }
        });

        removeBtn.addEventListener('click', () => {
            imageInput.value = '';
            preview.classList.add('hidden');
        });

        // CKEditor
        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
