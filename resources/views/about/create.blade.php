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

            <!-- Upload + Preview -->
            <div class="space-y-1">
                <label for="image" class="block text-sm font-semibold text-gray-700">Gambar 1</label>

                <!-- Dropzone -->
                <div id="dropzone"
                    class="relative w-full border-2 border-dashed border-gray-300 rounded-lg px-4 py-8 flex flex-col items-center justify-center cursor-pointer
                hover:border-emerald-400 focus-within:ring-2 focus-within:ring-emerald-300 transition"
                    tabindex="0" role="button" aria-label="Drag and drop gambar di sini atau klik untuk memilih file"
                    onclick="document.getElementById('image').click()"
                    onkeydown="if(event.key==='Enter' || event.key===' ') { event.preventDefault(); document.getElementById('image').click(); }">

                    <!-- SVG awan -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 text-gray-400 mb-3" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M3 15.5A4.5 4.5 0 017.5 11H9a5 5 0 0110 0h.5A3.5 3.5 0 0124 14.5 3.5 3.5 0 0120.5 18H6a3 3 0 01-3-2.5z" />
                    </svg>

                    <div class="text-sm text-gray-600 text-center">
                        Seret & jatuhkan gambar di sini, atau <span class="text-emerald-600 font-medium">klik untuk
                            memilih</span>
                    </div>
                    <div class="text-xs text-gray-400 mt-1">PNG, JPG, JPEG — maksimal 2MB</div>

                    <!-- Hidden native input -->
                    <input id="image" name="image" type="file" accept="image/*" class="sr-only">
                </div>

                <!-- Preview (gantikan dropzone setelah pilih gambar) -->
                <div id="previewContainer" class="hidden">
                    <div class="relative inline-block">
                        <img id="previewImage" src="#" alt="Preview gambar"
                            class="max-h-60 rounded-lg shadow border object-contain" />
                        <button type="button" id="removeImageBtn"
                            class="absolute -top-3 -right-3 bg-white border rounded-full p-1 shadow hover:bg-gray-100"
                            aria-label="Hapus gambar">
                            <!-- X icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-600" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 8.586L15.293 3.293a1 1 0 111.414 1.414L11.414 10l5.293 5.293a1 1 0 01-1.414 1.414L10 11.414l-5.293 5.293a1 1 0 01-1.414-1.414L8.586 10 3.293 4.707A1 1 0 014.707 3.293L10 8.586z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </div>

                @error('image')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Gambar 2 -->
            <div class="space-y-1">
                <label for="image2" class="block text-sm font-semibold text-gray-700">Gambar 2</label>

                <!-- Dropzone -->
                <div id="dropzone2"
                    class="relative w-full border-2 border-dashed border-gray-300 rounded-lg px-4 py-8 flex flex-col items-center justify-center cursor-pointer
                hover:border-emerald-400 focus-within:ring-2 focus-within:ring-emerald-300 transition"
                    tabindex="0" role="button" aria-label="Drag and drop gambar di sini atau klik untuk memilih file"
                    onclick="document.getElementById('image2').click()"
                    onkeydown="if(event.key==='Enter' || event.key===' ') { event.preventDefault(); document.getElementById('image2').click(); }">

                    <!-- SVG awan -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 text-gray-400 mb-3" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M3 15.5A4.5 4.5 0 017.5 11H9a5 5 0 0110 0h.5A3.5 3.5 0 0124 14.5 3.5 3.5 0 0120.5 18H6a3 3 0 01-3-2.5z" />
                    </svg>

                    <div class="text-sm text-gray-600 text-center">
                        Seret & jatuhkan gambar di sini, atau <span class="text-emerald-600 font-medium">klik untuk
                            memilih</span>
                    </div>
                    <div class="text-xs text-gray-400 mt-1">PNG, JPG, JPEG — maksimal 2MB</div>

                    <!-- Hidden input -->
                    <input id="image2" name="image2" type="file" accept="image/*" class="sr-only">
                </div>

                <!-- Preview -->
                <div id="previewContainer2" class="hidden">
                    <div class="relative inline-block">
                        <img id="previewImage2" src="#" alt="Preview gambar"
                            class="max-h-60 rounded-lg shadow border object-contain" />
                        <button type="button" id="removeImageBtn2"
                            class="absolute -top-3 -right-3 bg-white border rounded-full p-1 shadow hover:bg-gray-100"
                            aria-label="Hapus gambar">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-600" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 8.586L15.293 3.293a1 1 0 111.414 1.414L11.414 10l5.293 5.293a1 1 0 01-1.414 1.414L10 11.414l-5.293 5.293a1 1 0 01-1.414-1.414L8.586 10 3.293 4.707A1 1 0 014.707 3.293L10 8.586z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </div>

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

        (function() {
            const dropzone = document.getElementById('dropzone');
            const fileInput = document.getElementById('image');
            const previewContainer = document.getElementById('previewContainer');
            const previewImage = document.getElementById('previewImage');
            const removeBtn = document.getElementById('removeImageBtn');

            // Drag events
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(ev => {
                dropzone.addEventListener(ev, e => e.preventDefault());
            });

            dropzone.addEventListener('dragover', () => {
                dropzone.classList.add('border-emerald-400', 'bg-emerald-50');
            });
            dropzone.addEventListener('dragleave', () => {
                dropzone.classList.remove('border-emerald-400', 'bg-emerald-50');
            });

            dropzone.addEventListener('drop', (e) => {
                dropzone.classList.remove('border-emerald-400', 'bg-emerald-50');
                const files = e.dataTransfer.files;
                if (files && files.length) handleFile(files[0]);
            });

            fileInput.addEventListener('change', (e) => {
                const f = e.target.files && e.target.files[0];
                if (f) handleFile(f);
            });

            removeBtn.addEventListener('click', () => {
                fileInput.value = "";
                previewImage.src = "#";
                previewContainer.classList.add('hidden');
                dropzone.classList.remove('hidden'); // tampilkan kembali dropzone
            });

            function handleFile(file) {
                const maxSize = 2 * 1024 * 1024; // 2MB
                if (!file.type.startsWith('image/')) {
                    alert('File harus berupa gambar.');
                    return;
                }
                if (file.size > maxSize) {
                    alert('Ukuran file terlalu besar (maks 2MB).');
                    return;
                }

                const reader = new FileReader();
                reader.onload = (ev) => {
                    previewImage.src = ev.target.result;
                    dropzone.classList.add('hidden'); // sembunyikan dropzone
                    previewContainer.classList.remove('hidden'); // tampilkan preview
                };
                reader.readAsDataURL(file);
            }
        })();

        (function() {
            const dropzone = document.getElementById('dropzone2');
            const fileInput = document.getElementById('image2');
            const previewContainer = document.getElementById('previewContainer2');
            const previewImage = document.getElementById('previewImage2');
            const removeBtn = document.getElementById('removeImageBtn2');

            // Drag events
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(ev => {
                dropzone.addEventListener(ev, e => e.preventDefault());
            });

            dropzone.addEventListener('dragover', () => {
                dropzone.classList.add('border-emerald-400', 'bg-emerald-50');
            });
            dropzone.addEventListener('dragleave', () => {
                dropzone.classList.remove('border-emerald-400', 'bg-emerald-50');
            });

            dropzone.addEventListener('drop', (e) => {
                dropzone.classList.remove('border-emerald-400', 'bg-emerald-50');
                const files = e.dataTransfer.files;
                if (files && files.length) handleFile(files[0]);
            });

            fileInput.addEventListener('change', (e) => {
                const f = e.target.files && e.target.files[0];
                if (f) handleFile(f);
            });

            removeBtn.addEventListener('click', () => {
                fileInput.value = "";
                previewImage.src = "#";
                previewContainer.classList.add('hidden');
                dropzone.classList.remove('hidden');
            });

            function handleFile(file) {
                const maxSize = 2 * 1024 * 1024; // 2MB
                if (!file.type.startsWith('image/')) {
                    alert('File harus berupa gambar.');
                    return;
                }
                if (file.size > maxSize) {
                    alert('Ukuran file terlalu besar (maks 2MB).');
                    return;
                }

                const reader = new FileReader();
                reader.onload = (ev) => {
                    previewImage.src = ev.target.result;
                    dropzone.classList.add('hidden');
                    previewContainer.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            }
        })();
    </script>
@endsection
