@extends('layouts.app', ['title' => 'Edit Pengurus - Step 2'])

@section('content')
    <div class="max-w-5xl mx-auto px-4 sm:px-0">
        <div class="bg-white rounded-2xl shadow-lg p-6 sm:p-8 space-y-6">
            <!-- Header -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 border-b pb-4">
                <h1 class="text-xl sm:text-2xl font-bold text-emerald-700">Edit Pengurus - Step 2 dari 3</h1>
                <a href="{{ route('pengurus.edit', $pengurus->id) }}"
                    class="inline-flex items-center gap-2 px-3 py-2 sm:px-4 sm:py-2 rounded-lg bg-gray-100 text-gray-700 hover:bg-gray-200 transition text-sm sm:text-base">
                    <i class="fas fa-arrow-left"></i> Kembali ke Step 1
                </a>
            </div>

            <!-- Progress -->
            <div class="w-full bg-gray-100 rounded-full h-2">
                <div class="bg-emerald-500 h-2 rounded-full" style="width: 66%"></div>
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
            <form action="{{ route('pengurus.edit.step2.update', $pengurus->id) }}" method="POST"
                enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Informasi Tambahan 1 -->
                    <div class="space-y-4">
                        <h5 class="font-semibold text-emerald-700 text-base">Informasi Tambahan 1</h5>
                        <div>
                            <label for="title2" class="block text-sm font-medium text-gray-700">Judul 2 <span
                                    class="text-red-500">*</span></label>
                            <input type="text" id="title2" name="title2"
                                value="{{ old('title2', $pengurus->title2) }}"
                                class="mt-1 block w-full rounded-lg border py-2 px-3 border-gray-300 text-sm focus:ring-emerald-500 focus:border-emerald-500 @error('title2') border-red-500 @enderror"
                                required>
                        </div>
                        <div>
                            <label for="description2" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                            <textarea id="description2" name="description2" rows="3"
                                class="mt-1 block w-full rounded-lg border py-2 px-3 border-gray-300 text-sm focus:ring-emerald-500 focus:border-emerald-500">{{ old('description2', $pengurus->description2) }}</textarea>
                        </div>
                        <!-- Drag & Drop Upload Gambar 2 -->
                        <div x-data="imageDropzone({ existingUrl: '{{ $pengurus->image2 ? asset('storage/' . $pengurus->image2) : '' }}' })" class="space-y-2">
                            <label for="image2" class="block text-sm font-medium text-gray-700">Gambar 2</label>

                            <!-- Area Drop -->
                            <div x-show="!previewUrl" x-ref="dropzone" @click="$refs.file.click()"
                                @dragover.prevent="isDrag = true" @dragleave.prevent="isDrag = false"
                                @drop.prevent="handleDrop($event)"
                                :class="{ 'ring-2 ring-emerald-400 bg-emerald-50': isDrag }"
                                class="flex flex-col items-center justify-center gap-3 rounded-lg border-2 border-gray-300 p-6 cursor-pointer transition">

                                <svg class="w-12 h-12 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M7 16a4 4 0 01-.88-7.9A5.002 5.002 0 0117.9 9h.1a4.992 4.992 0 012.9 9.1M15 13l-3-3m0 0l-3 3m3-3v12" />
                                </svg>
                                <p class="mt-2 text-sm text-gray-600">Tarik & letakkan gambar di sini atau klik untuk pilih
                                </p>
                                <p class="mt-1 text-xs text-gray-500">Format: JPEG, PNG, JPG, GIF. Maks 2MB</p>
                            </div>

                            <!-- Preview -->
                            <div x-show="previewUrl" class="flex items-center gap-3 mt-3">
                                <img :src="previewUrl" alt="Preview"
                                    class="h-20 w-20 object-cover rounded-lg border" />
                                <div class="flex flex-col min-w-0">
                                    <p class="text-sm text-gray-700 truncate max-w-[160px]" x-text="fileName"></p>
                                    <button type="button" @click="removeFile()"
                                        class="mt-1 px-3 py-1 bg-red-100 text-red-600 rounded-lg text-xs hover:bg-red-200 w-fit">
                                        Hapus
                                    </button>
                                </div>
                            </div>

                            <!-- Input File (hidden) -->
                            <input type="file" id="image2" name="image2" accept="image/*" x-ref="file"
                                @change="fileChanged" class="hidden">
                        </div>
                    </div>

                    <!-- Informasi Tambahan 2 -->
                    <div class="space-y-4">
                        <h5 class="font-semibold text-emerald-700 text-base">Informasi Tambahan 2</h5>
                        <div>
                            <label for="title3" class="block text-sm font-medium text-gray-700">Judul 3 <span
                                    class="text-red-500">*</span></label>
                            <input type="text" id="title3" name="title3"
                                value="{{ old('title3', $pengurus->title3) }}"
                                class="mt-1 block w-full rounded-lg border py-2 px-3 border-gray-300 text-sm focus:ring-emerald-500 focus:border-emerald-500 @error('title3') border-red-500 @enderror"
                                required>
                        </div>
                        <div>
                            <label for="description3" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                            <textarea id="description3" name="description3" rows="3"
                                class="mt-1 block w-full rounded-lg border py-2 px-3 border-gray-300 text-sm focus:ring-emerald-500 focus:border-emerald-500">{{ old('description3', $pengurus->description3) }}</textarea>
                        </div>
                        <!-- Drag & Drop Upload Gambar 3 -->
                        <div x-data="imageDropzone({ existingUrl: '{{ $pengurus->image3 ? asset('storage/' . $pengurus->image3) : '' }}' })" class="space-y-2">
                            <label for="image3" class="block text-sm font-medium text-gray-700">Gambar 3</label>

                            <!-- Area Drop -->
                            <div x-show="!previewUrl" x-ref="dropzone" @click="$refs.file.click()"
                                @dragover.prevent="isDrag = true" @dragleave.prevent="isDrag = false"
                                @drop.prevent="handleDrop($event)"
                                :class="{ 'ring-2 ring-emerald-400 bg-emerald-50': isDrag }"
                                class="flex flex-col items-center justify-center gap-3 rounded-lg border-2 border-gray-300 p-6 cursor-pointer transition">

                                <svg class="w-12 h-12 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M7 16a4 4 0 01-.88-7.9A5.002 5.002 0 0117.9 9h.1a4.992 4.992 0 012.9 9.1M15 13l-3-3m0 0l-3 3m3-3v12" />
                                </svg>
                                <p class="mt-2 text-sm text-gray-600">Tarik & letakkan gambar di sini atau klik untuk pilih
                                </p>
                                <p class="mt-1 text-xs text-gray-500">Format: JPEG, PNG, JPG, GIF. Maks 2MB</p>
                            </div>

                            <!-- Preview -->
                            <div x-show="previewUrl" class="flex items-center gap-3 mt-3">
                                <img :src="previewUrl" alt="Preview"
                                    class="h-20 w-20 object-cover rounded-lg border" />
                                <div class="flex flex-col min-w-0">
                                    <p class="text-sm text-gray-700 truncate max-w-[160px]" x-text="fileName"></p>
                                    <button type="button" @click="removeFile()"
                                        class="mt-1 px-3 py-1 bg-red-100 text-red-600 rounded-lg text-xs hover:bg-red-200 w-fit">
                                        Hapus
                                    </button>
                                </div>
                            </div>

                            <!-- Input File (hidden) -->
                            <input type="file" id="image3" name="image3" accept="image/*" x-ref="file"
                                @change="fileChanged" class="hidden">
                        </div>
                    </div>
                </div>

                <!-- Submit -->
                <div class="flex justify-between">
                    <a href="{{ route('pengurus.edit', $pengurus->id) }}"
                        class="inline-flex items-center gap-2 px-5 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 text-sm sm:text-base">
                        <i class="fas fa-arrow-left"></i> Kembali ke Step 1
                    </a>
                    <button type="submit"
                        class="inline-flex items-center gap-2 px-5 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 text-sm sm:text-base">
                        Lanjut ke Step 3 <i class="fas fa-arrow-right"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        ClassicEditor.create(document.querySelector('#description2')).catch(error => console.error(error));
        ClassicEditor.create(document.querySelector('#description3')).catch(error => console.error(error));
    </script>

    <script>
        function imageDropzone({
            existingUrl = null
        } = {}) {
            return {
                isDrag: false,
                previewUrl: existingUrl || null,
                fileName: existingUrl ? existingUrl.split('/').pop() : '',
                maxSize: 2 * 1024 * 1024, // 2MB

                fileChanged(e) {
                    const f = e.target.files[0];
                    if (!f) return this.removeFile();
                    if (!f.type.startsWith('image/')) {
                        alert('File harus gambar');
                        this.$refs.file.value = '';
                        return;
                    }
                    if (f.size > this.maxSize) {
                        alert('Ukuran file max 2MB');
                        this.$refs.file.value = '';
                        return;
                    }
                    this.setFile(f);
                },

                handleDrop(e) {
                    this.isDrag = false;
                    const f = e.dataTransfer.files[0];
                    if (!f) return;
                    if (!f.type.startsWith('image/')) {
                        alert('File harus gambar');
                        return;
                    }
                    if (f.size > this.maxSize) {
                        alert('Ukuran file max 2MB');
                        return;
                    }
                    const dt = new DataTransfer();
                    dt.items.add(f);
                    this.$refs.file.files = dt.files;
                    this.setFile(f);
                },

                setFile(f) {
                    this.fileName = f.name;
                    const reader = new FileReader();
                    reader.onload = (e) => this.previewUrl = e.target.result;
                    reader.readAsDataURL(f);
                },

                removeFile() {
                    this.previewUrl = null;
                    this.fileName = '';
                    this.$refs.file.value = '';
                }
            }
        }
    </script>
@endsection
