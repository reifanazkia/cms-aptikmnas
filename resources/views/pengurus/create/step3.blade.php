@extends('layouts.app', ['title' => 'Tambah Pengurus - Step 3'])

@section('content')
    <div class="max-w-5xl mx-auto px-4 sm:px-0">
        <div class="bg-white rounded-2xl shadow-lg p-6 sm:p-8 space-y-6">
            <!-- Header -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 border-b pb-4">
                <h1 class="text-xl sm:text-2xl font-bold text-emerald-700">Tambah Pengurus - Step 3 dari 3 (Final)</h1>
                <a href="{{ route('pengurus.index') }}"
                    class="inline-flex items-center gap-2 px-3 py-2 sm:px-4 sm:py-2 rounded-lg bg-gray-100 text-gray-700 hover:bg-gray-200 transition text-sm sm:text-base">
                    <i class="fas fa-times"></i> Batal
                </a>
            </div>

            <!-- Progress -->
            <div class="w-full bg-gray-100 rounded-full h-2">
                <div class="bg-emerald-500 h-2 rounded-full" style="width: 100%"></div>
            </div>

            <!-- Alerts -->
            @if (session('success'))
                <div class="p-4 rounded-lg bg-green-50 text-green-700 text-sm">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="p-4 rounded-lg bg-red-50 text-red-700 text-sm">
                    {{ session('error') }}
                </div>
            @endif
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
            <form action="{{ route('pengurus.create.step3.store', $pengurus->id) }}" method="POST"
                enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Grid Utama -->
                <div class="grid grid-cols-1  gap-6">
                    <!-- Title 4 -->
                    <div>
                        <label for="title4" class="block text-sm font-medium text-gray-700">Judul 4 <span
                                class="text-red-500">*</span></label>
                        <input type="text" id="title4" name="title4"
                            value="{{ old('title4', $pengurus->title4 ?? '') }}"
                            class="mt-1 block w-full rounded-lg border py-2 px-3 border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 text-sm @error('title4') border-red-500 @enderror">
                        @error('title4')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Image 4 -->
                    <!-- Drag & Drop Upload Gambar 4 -->
                    <div x-data="imageDropzone4('{{ !empty($pengurus->image4) ? asset('storage/' . $pengurus->image4) : '' }}')" class="space-y-2">
                        <label for="image4" class="block text-sm font-medium text-gray-700">Gambar 4</label>

                        <!-- Dropzone hanya tampil jika tidak ada preview -->
                        <div x-show="!previewUrl" x-ref="dropzone" @click="$refs.file.click()"
                            @dragover.prevent="isDrag = true" @dragleave.prevent="isDrag = false"
                            @drop.prevent="handleDrop($event)"
                            :class="{
                                'border-emerald-400 bg-emerald-50': isDrag,
                                'border-gray-300 bg-white': !isDrag
                            }"
                            class="flex flex-col items-center justify-center gap-2 border-2 rounded-lg p-6 cursor-pointer transition-colors text-center"
                            style="min-height: 150px;">
                            <!-- SVG Awan Upload -->
                            <svg class="w-12 h-12 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M7 16a4 4 0 01-.88-7.9A5.002 5.002 0 0117.9 9h.1a4.992 4.992 0 012.9 9.1M15 13l-3-3m0 0l-3 3m3-3v12" />
                            </svg>

                            <p class="text-sm font-medium text-gray-700">Tarik & lepas gambar di sini</p>
                            <p class="text-xs text-gray-500">atau klik untuk pilih (JPEG, PNG, JPG, GIF, maks. 2MB)</p>
                            <p x-text="fileName" class="text-xs mt-1 text-emerald-600" x-show="fileName"></p>

                            <!-- Hidden file input -->
                            <input x-ref="file" type="file" id="image4" name="image4" accept="image/*"
                                class="hidden" @change="handleFile($event.target.files[0])">
                        </div>

                        <!-- Preview -->
                        <div x-show="previewUrl" class="flex flex-col items-center">
                            <img :src="previewUrl" alt="Preview" class="h-40 rounded-lg border object-contain">
                            <button type="button" @click="removeFile()"
                                class="mt-3 px-3 py-1 text-xs bg-red-100 text-red-600 rounded hover:bg-red-200">
                                Hapus
                            </button>
                        </div>

                        <p class="text-xs text-gray-500">Format: JPEG, PNG, JPG, GIF. Maksimal 2MB</p>

                        @error('image4')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Deskripsi -->
                <div>
                    <label for="description4" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                    <textarea id="description4" name="description4" rows="3"
                        class="mt-1 block w-full rounded-lg border py-2 px-3 border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 text-sm @error('description4') border-red-500 @enderror">{{ old('description4', $pengurus->description4 ?? '') }}</textarea>
                    @error('description4')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Warning -->
                <div class="p-4 rounded-lg bg-yellow-50 text-yellow-700 text-sm">
                    <p class="font-semibold mb-1"><i class="fas fa-exclamation-triangle"></i> Perhatian:</p>
                    <p>Setelah mengklik "Selesai", data pengurus akan tersimpan secara lengkap dan Anda akan diarahkan
                        kembali ke halaman daftar pengurus.</p>
                </div>

                <!-- Action -->
                <div class="flex justify-between">
                    <a href="{{ route('pengurus.create.step2', $pengurus->id) }}"
                        class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-gray-100 text-gray-700 hover:bg-gray-200 text-sm sm:text-base">
                        <i class="fas fa-arrow-left"></i> Kembali ke Step 2
                    </a>
                    <button type="submit"
                        class="inline-flex items-center gap-2 px-5 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 text-sm sm:text-base">
                        <i class="fas fa-check"></i> Selesai
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        ClassicEditor.create(document.querySelector('#description4')).catch(error => console.error(error));
    </script>

    <script>
        function imageDropzone4(existingUrl = null) {
            return {
                isDrag: false,
                previewUrl: existingUrl || null,
                fileName: '',
                handleDrop(e) {
                    const file = e.dataTransfer.files[0];
                    this.handleFile(file);
                    this.isDrag = false;
                },
                handleFile(file) {
                    if (!file) return;
                    if (!file.type.startsWith('image/')) {
                        alert('File harus berupa gambar.');
                        return;
                    }
                    if (file.size > 2 * 1024 * 1024) {
                        alert('Ukuran maksimal 2MB.');
                        return;
                    }
                    this.fileName = file.name;
                    const reader = new FileReader();
                    reader.onload = e => this.previewUrl = e.target.result;
                    reader.readAsDataURL(file);

                    const dt = new DataTransfer();
                    dt.items.add(file);
                    this.$refs.file.files = dt.files;
                },
                removeFile() {
                    this.previewUrl = null;
                    this.fileName = '';
                    this.$refs.file.value = null;
                }
            }
        }
    </script>
@endsection
