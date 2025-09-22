@extends('layouts.app', ['title' => 'Tambah Agenda'])

@section('content')
    <div class="max-w-4xl mx-auto bg-white p-8 rounded-2xl shadow-lg space-y-8">
        <!-- Header -->
        <div class="border-b pb-4">
            <h1 class="text-3xl font-bold text-emerald-700">Tambah Agenda Baru</h1>
            <p class="text-gray-500 text-sm mt-1">Isi detail agenda dengan lengkap agar tampil lebih informatif.</p>
        </div>

        <form action="{{ route('agenda.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Judul & Tipe -->
            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Judul</label>
                    <input type="text" name="title" value="{{ old('title') }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                    @error('title')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Tipe Agenda</label>
                    <input type="text" name="type" value="{{ old('type') }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                </div>
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

            <!-- Waktu -->
            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Mulai</label>
                    <input type="datetime-local" name="start_datetime" value="{{ old('start_datetime') }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Selesai</label>
                    <input type="datetime-local" name="end_datetime" value="{{ old('end_datetime') }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                </div>
            </div>

            <!-- Lokasi & Penyelenggara -->
            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Lokasi</label>
                    <input type="text" name="location" value="{{ old('location') }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Penyelenggara</label>
                    <input type="text" name="event_organizer" value="{{ old('event_organizer') }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                </div>
            </div>

            <!-- Youtube -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">YouTube Link</label>
                <input type="url" name="youtube_link" value="{{ old('youtube_link') }}"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
            </div>

            <!-- Drag & Drop Image Upload -->
            <div x-data="imageUpload()" class="space-y-2">
                <label class="block text-sm font-semibold text-gray-700 mb-1">Gambar</label>

                <!-- Drop area -->
                <div @click="$refs.fileInput.click()" @dragover.prevent="isDrag = true" @dragleave.prevent="isDrag = false"
                    @drop.prevent="handleDrop($event)"
                    :class="{ 'ring-2 ring-emerald-400 bg-emerald-50': isDrag, 'bg-gray-50': !isDrag }"
                    class="relative border-2 border-dashed border-gray-300 rounded-lg p-6 flex flex-col items-center justify-center cursor-pointer transition">

                    <!-- Hidden input tetap ada dengan name="image" -->
                    <input type="file" x-ref="fileInput" name="image" accept="image/*" class="hidden"
                        @change="handleFiles($event.target.files)">

                    <!-- Jika belum ada preview -->
                    <template x-if="!previewUrl">
                        <div class="flex flex-col items-center gap-2 text-center">
                            <!-- SVG awan -->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                class="h-12 w-12 text-emerald-600">
                                <path d="M17.5 19a4.5 4.5 0 0 0 .5-9 6 6 0 0 0-11.5-1.5A4.5 4.5 0 0 0 6.5 19h11z" />
                                <path d="M12 11v6" />
                                <path d="M9 14l3-3 3 3" />
                            </svg>

                            <p class="text-sm font-medium text-gray-700">Tarik & lepas gambar di sini</p>
                            <p class="text-xs text-gray-500">atau klik untuk pilih file</p>
                        </div>
                    </template>

                    <!-- Jika ada preview -->
                    <template x-if="previewUrl">
                        <div class="flex flex-col items-center gap-2">
                            <img :src="previewUrl" alt="Preview" class="h-28 rounded-lg object-cover border">
                            <button type="button" @click="removeFile()"
                                class="mt-2 px-3 py-1 bg-red-100 text-red-600 rounded-lg text-xs hover:bg-red-200">
                                Hapus
                            </button>
                        </div>
                    </template>
                </div>

                @error('image')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tombol -->
            <div class="flex justify-end gap-4 pt-4 border-t">
                <a href="{{ route('agenda.index') }}"
                    class="px-5 py-2 rounded-lg bg-gray-100 text-gray-700 hover:bg-gray-200">Batal</a>
                <button type="submit"
                    class="px-5 py-2 rounded-lg bg-emerald-600 text-white font-semibold shadow hover:bg-emerald-700">
                    Simpan
                </button>
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
    </script>

    <script>
        function imageUpload() {
            return {
                isDrag: false,
                previewUrl: null,
                handleFiles(files) {
                    if (!files.length) return;
                    const file = files[0];
                    if (!file.type.startsWith('image/')) {
                        alert('File harus berupa gambar.');
                        return;
                    }
                    if (file.size > 2 * 1024 * 1024) {
                        alert('Ukuran maksimal 2MB.');
                        return;
                    }
                    this.previewUrl = URL.createObjectURL(file);
                },
                handleDrop(e) {
                    const files = e.dataTransfer.files;
                    this.$refs.fileInput.files = files; // penting! supaya file masuk ke input
                    this.handleFiles(files);
                    this.isDrag = false;
                },
                removeFile() {
                    this.$refs.fileInput.value = null;
                    this.previewUrl = null;
                }
            }
        }
    </script>
@endsection
