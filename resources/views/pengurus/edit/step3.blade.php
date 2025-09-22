@extends('layouts.app', ['title' => 'Edit Pengurus - Step 3'])

@section('content')
    <div class="max-w-5xl mx-auto px-4 sm:px-0">
        <div class="bg-white rounded-2xl shadow-lg p-6 sm:p-8 space-y-6">
            <!-- Header -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 border-b pb-4">
                <h1 class="text-xl sm:text-2xl font-bold text-emerald-700">Edit Pengurus - Step 3 dari 3 (Final)</h1>
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
            <form action="{{ route('pengurus.edit.step3.update', $pengurus->id) }}" method="POST"
                enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

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
                    <div x-data="imageDropzone({
                        existingUrl: '{{ $pengurus->image4 ? asset('storage/' . $pengurus->image4) : '' }}'
                    })" class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">Gambar 4</label>

                        <!-- Dropzone -->
                        <div x-ref="dropzone" @click="$refs.file.click()" @dragover.prevent="isDrag = true"
                            @dragleave.prevent="isDrag = false" @drop.prevent="handleDrop($event)"
                            :class="{ 'border-emerald-400 bg-emerald-50': isDrag }"
                            class="relative flex items-center justify-center w-full min-h-[120px] rounded-lg border border-gray-300 cursor-pointer p-4 transition-colors"
                            x-show="!previewUrl">
                            <div class="flex flex-col items-center gap-2 text-center">
                                <!-- Cloud SVG -->
                                <svg class="w-12 h-12 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M7 16a4 4 0 01-.88-7.9A5.002 5.002 0 0117.9 9h.1a4.992 4.992 0 012.9 9.1M15 13l-3-3m0 0l-3 3m3-3v12" />
                                </svg>

                                <p class="text-sm font-medium text-gray-700">Klik atau seret gambar ke sini</p>
                                <p class="text-xs text-gray-500">Format: JPEG, PNG, JPG, GIF. Maksimal 2MB</p>
                            </div>

                            <!-- Hidden native file input -->
                            <input x-ref="file" type="file" name="image4" accept="image/*" class="hidden"
                                @change="filesChanged" />
                        </div>

                        <!-- Preview -->
                        <div x-show="previewUrl" class="flex flex-col items-center">
                            <img :src="previewUrl" alt="Preview" class="h-24 rounded-lg border object-cover">
                            <button type="button" @click="removeFile()"
                                class="mt-2 text-xs px-2 py-1 rounded inline-flex items-center gap-1 border text-gray-600 hover:bg-gray-50">
                                Hapus
                            </button>
                        </div>
                        
                        <!-- Server-side existing image fallback (in case Alpine gagal load) -->
                        @if (!empty($pengurus->image4))
                            <div class="mt-2 sm:mt-0" id="server-preview">
                                <img src="{{ asset('storage/' . $pengurus->image4) }}" alt="Preview"
                                    class="h-24 rounded-lg border">
                            </div>
                        @endif

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

                <!-- Action -->
                <div class="flex justify-between">
                    <a href="{{ route('pengurus.edit.step2', $pengurus->id) }}"
                        class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-gray-100 text-gray-700 hover:bg-gray-200 text-sm sm:text-base">
                        <i class="fas fa-arrow-left"></i> Kembali ke Step 2
                    </a>
                    <button type="submit"
                        class="inline-flex items-center gap-2 px-5 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 text-sm sm:text-base">
                        <i class="fas fa-save"></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        ClassicEditor.create(document.querySelector('#description4')).catch(error => console.error(error));
    </script>

    <script>
        function imageDropzone({
            existingUrl = ''
        } = {}) {
            return {
                isDrag: false,
                previewUrl: existingUrl || null,
                file: null,
                maxSize: 2 * 1024 * 1024, // 2MB

                filesChanged(event) {
                    const f = event.target.files ? event.target.files[0] : null;
                    this.setFile(f);
                },

                handleDrop(event) {
                    this.isDrag = false;
                    const dt = event.dataTransfer;
                    if (!dt || !dt.files || dt.files.length === 0) return;
                    const f = dt.files[0];
                    this.setFile(f);
                },

                setFile(f) {
                    if (!f) return;
                    if (!f.type.startsWith('image/')) {
                        alert('Format tidak didukung — pilih file gambar (JPEG, PNG, GIF, dll).');
                        return;
                    }
                    if (f.size > this.maxSize) {
                        alert('Ukuran file terlalu besar. Maks 2MB.');
                        return;
                    }

                    this.file = f;

                    // create preview
                    const reader = new FileReader();
                    reader.onload = e => {
                        this.previewUrl = e.target.result;
                    };
                    reader.readAsDataURL(f);

                    // update the hidden input's files so form submit menyertakan file
                    this.$nextTick(() => {
                        const input = this.$refs.file;
                        // create DataTransfer to set files programmatically (works in modern browsers)
                        try {
                            const dt = new DataTransfer();
                            dt.items.add(f);
                            input.files = dt.files;
                        } catch (err) {
                            // fallback: let user rely on native input (they already used it)
                        }
                    });

                    // hide server preview element if exists
                    const serverPreview = document.getElementById('server-preview');
                    if (serverPreview) serverPreview.style.display = 'none';
                },

                removeFile() {
                    this.previewUrl = null;
                    this.file = null;
                    // clear native input
                    try {
                        this.$refs.file.value = null;
                    } catch (e) {}
                    // show server preview again if available
                    const serverPreview = document.getElementById('server-preview');
                    if (serverPreview) serverPreview.style.display = '';
                }
            };
        }
    </script>

@endsection
