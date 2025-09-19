@extends('layouts.app', ['title' => 'Tambah Slider'])

@section('content')
    <div class="max-w-4xl mx-auto p-4 sm:p-6 bg-white shadow rounded-lg">
        <!-- Header -->
        <div class="mb-6 border-b border-emerald-100 pb-3">
            <h1 class="text-xl sm:text-2xl font-bold text-emerald-700">Tambah Slider</h1>
            <p class="text-sm text-gray-500">Isi form di bawah untuk menambahkan slider baru</p>
        </div>

        <form action="{{ route('slider.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf

            <!-- Judul -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Judul</label>
                <input type="text" name="title" value="{{ old('title') }}"
                    class="w-full rounded-lg border py-2.5 px-4 border-gray-300 focus:ring-emerald-500 focus:border-emerald-500">
            </div>

            <!-- Subjudul -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Subjudul</label>
                <textarea name="subtitle" rows="3"
                    class="w-full rounded-lg border py-2.5 px-4 border-gray-300 focus:ring-emerald-500 focus:border-emerald-500">{{ old('subtitle') }}</textarea>
            </div>

            <!-- Upload Gambar -->
            <div x-data="imageUploadCreate()" class="space-y-2">
                <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Gambar *</label>

                <!-- Area Upload -->
                <div x-show="!previewUrl" x-on:click="triggerInput" x-on:dragover.prevent="isDrag = true"
                    x-on:dragleave.prevent="isDrag = false" x-on:drop.prevent="handleDrop($event)"
                    :class="{ 'border-emerald-400 bg-emerald-50': isDrag, 'border-gray-300': !isDrag }"
                    class="cursor-pointer rounded-xl border-2 p-6 flex flex-col items-center justify-center text-center transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                        class="h-12 w-12 text-emerald-600">
                        <path d="M17.5 19a4.5 4.5 0 0 0 .5-9 6 6 0 0 0-11.5-1.5A4.5 4.5 0 0 0 6.5 19h11z" />
                        <path d="M12 11v6" />
                        <path d="M9 14l3-3 3 3" />
                    </svg>
                    <p class="mt-2 text-sm text-gray-600">Klik atau seret gambar ke sini</p>
                    <p class="text-xs text-gray-400">JPG / PNG (maks 2MB)</p>
                    <input type="file" name="image" id="image" accept="image/jpeg,image/png" x-ref="fileInput"
                        class="hidden" x-on:change="handleFiles($event.target.files)" required>
                </div>

                <!-- Preview -->
                <div x-show="previewUrl" class="mt-3 rounded-lg border border-gray-200 bg-gray-50 p-3">
                    <img :src="previewUrl" class="rounded-lg max-h-40 mx-auto shadow-sm border" alt="Preview">
                    <div class="mt-3 flex gap-2">
                        <button type="button" x-on:click="triggerInput"
                            class="flex-1 py-1.5 text-sm rounded-lg border hover:bg-gray-50">
                            Ganti
                        </button>
                        <button type="button" x-on:click="removeFile"
                            class="flex-1 py-1.5 text-sm rounded-lg border text-red-600 hover:bg-red-50">
                            Hapus
                        </button>
                    </div>
                </div>

                @error('image')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Youtube ID & URL (2 kolom di desktop) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Youtube ID</label>
                    <input type="text" name="youtube_id" value="{{ old('youtube_id') }}"
                        class="w-full rounded-lg border py-2.5 px-4 border-gray-300 focus:ring-emerald-500 focus:border-emerald-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">URL Link</label>
                    <input type="url" name="url_link" value="{{ old('url_link') }}"
                        class="w-full rounded-lg border py-2.5 px-4 border-gray-300 focus:ring-emerald-500 focus:border-emerald-500">
                </div>
            </div>

            <!-- Button Text -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Teks Tombol</label>
                <input type="text" name="button_text" value="{{ old('button_text') }}"
                    class="w-full rounded-lg border py-2.5 px-4 border-gray-300 focus:ring-emerald-500 focus:border-emerald-500">
            </div>

            <!-- Checkbox -->
            <div class="flex items-center">
                <input type="checkbox" name="display_on_home" value="1" {{ old('display_on_home') ? 'checked' : '' }}
                    class="h-4 w-4 text-emerald-600 border-gray-300 rounded focus:ring-emerald-500">
                <label class="ml-2 text-sm text-gray-700">Tampilkan di Home</label>
            </div>

            <!-- Tombol Aksi -->
            <div class="flex flex-col sm:flex-row sm:justify-end gap-3 pt-4 border-t border-gray-100">
                <a href="{{ route('slider.index') }}"
                    class="w-full sm:w-auto px-4 py-2 rounded-lg bg-gray-200 text-gray-700 text-center hover:bg-gray-300 transition">
                    Batal
                </a>
                <button type="submit"
                    class="w-full sm:w-auto px-4 py-2 rounded-lg bg-emerald-600 text-white font-semibold hover:bg-emerald-700 transition">
                    Simpan
                </button>
            </div>
        </form>
    </div>

    <script>
        function imageUploadCreate() {
            return {
                previewUrl: null,
                isDrag: false,
                triggerInput() {
                    this.$refs.fileInput.click();
                },
                handleFiles(files) {
                    if (!files.length) return;
                    const file = files[0];
                    if (file.size > 2 * 1024 * 1024) {
                        alert("Ukuran file maksimal 2MB");
                        return;
                    }
                    this.previewUrl = URL.createObjectURL(file);
                },
                handleDrop(e) {
                    this.isDrag = false;
                    this.handleFiles(e.dataTransfer.files);
                },
                removeFile() {
                    this.previewUrl = null;
                    this.$refs.fileInput.value = null;
                }
            }
        }
    </script>
@endsection
