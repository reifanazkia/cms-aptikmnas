@extends('layouts.app', ['title' => 'Edit Agenda'])

@section('content')
    <div class="max-w-4xl mx-auto bg-white p-8 rounded-2xl shadow-lg space-y-8">
        <!-- Header -->
        <div class="border-b pb-4">
            <h1 class="text-3xl font-bold text-emerald-700">Edit Agenda</h1>
            <p class="text-gray-500 text-sm mt-1">Perbarui detail agenda sesuai kebutuhan.</p>
        </div>

        <form action="{{ route('agenda.update', $agenda->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Judul & Tipe -->
            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Judul</label>
                    <input type="text" name="title" value="{{ old('title', $agenda->title) }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                    @error('title')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Tipe Agenda</label>
                    <input type="text" name="type" value="{{ old('type', $agenda->type) }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                </div>
            </div>

            <!-- Deskripsi -->
            <div class="md:col-span-2">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                <textarea name="description" id="description" rows="4"
                    class="w-full rounded-lg px-3 py-2 text-sm border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 @error('description') border-red-500 @enderror">{{ old('description', $agenda->description) }}</textarea>
                @error('description')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Waktu -->
            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Mulai</label>
                    <input type="datetime-local" name="start_datetime"
                        value="{{ old('start_datetime', \Carbon\Carbon::parse($agenda->start_datetime)->format('Y-m-d\TH:i')) }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Selesai</label>
                    <input type="datetime-local" name="end_datetime"
                        value="{{ old('end_datetime', $agenda->end_datetime ? \Carbon\Carbon::parse($agenda->end_datetime)->format('Y-m-d\TH:i') : '') }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                </div>
            </div>

            <!-- Lokasi & Penyelenggara -->
            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Lokasi</label>
                    <input type="text" name="location" value="{{ old('location', $agenda->location) }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Penyelenggara</label>
                    <input type="text" name="event_organizer"
                        value="{{ old('event_organizer', $agenda->event_organizer) }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                </div>
            </div>

            <!-- Youtube -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">YouTube Link</label>
                <input type="url" name="youtube_link" value="{{ old('youtube_link', $agenda->youtube_link) }}"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
            </div>

            <!-- Gambar -->
            <!-- Drag & Drop Image Upload -->
            <div x-data="imageUpload()" x-init="initPreview('{{ $agenda->image ? asset('storage/' . $agenda->image) : '' }}')" class="space-y-2">
                <label class="block text-sm font-semibold text-gray-700 mb-1">Gambar</label>

                <!-- Drop area -->
                <div @click="$refs.fileInput.click()" @dragover.prevent="isDrag = true" @dragleave.prevent="isDrag = false"
                    @drop.prevent="handleDrop($event)"
                    :class="{
                        'border-emerald-400 bg-emerald-50': isDrag,
                        'border-gray-200 bg-white': !isDrag
                    }"
                    class="relative flex flex-col items-center justify-center border-2 border-dashed rounded-lg p-6 cursor-pointer transition-all duration-150"
                    style="min-height:140px;">
                    <!-- SVG cloud + text when no preview -->
                    <template x-if="!previewUrl">
                        <div class="flex flex-col items-center gap-3 text-center">
                            <!-- Cloud SVG -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 15a4 4 0 014-4h1.2A5 5 0 1117 16H7a4 4 0 01-4-1z" />
                            </svg>

                            <div>
                                <p class="text-sm font-medium text-gray-700">Tarik & lepas gambar di sini, atau klik untuk
                                    memilih</p>
                                <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, WEBP. Max 2MB.</p>
                            </div>
                        </div>
                    </template>

                    <!-- Preview -->
                    <template x-if="previewUrl">
                        <div class="w-full flex items-start gap-4">
                            <img :src="previewUrl" alt="Preview" class="h-32 rounded-lg border object-cover">
                            <div class="flex-1">
                                <p class="text-sm text-gray-700" x-text="fileName ? fileName : 'Gambar terpilih'"></p>
                                <p class="text-xs text-gray-500 mt-1" x-text="fileSizeText"></p>

                                <div class="mt-3 flex items-center gap-2">
                                    <button type="button" @click="removeFile()"
                                        class="px-3 py-1.5 bg-red-100 text-red-600 rounded-lg text-xs">Hapus</button>
                                    <span class="text-xs text-gray-500">atau klik area untuk ganti</span>
                                </div>
                            </div>
                        </div>
                    </template>

                    <!-- Hidden file input -->
                    <input x-ref="fileInput" type="file" name="image" accept="image/*" class="hidden"
                        @change="handleChange($event)">

                    <!-- Validation message -->
                    <p x-show="error" x-text="error" class="text-xs text-red-600 mt-2"></p>
                </div>
            </div>

            <!-- Tombol -->
            <div class="flex justify-end gap-4 pt-4 border-t">
                <a href="{{ route('agenda.index') }}"
                    class="px-5 py-2 rounded-lg bg-gray-100 text-gray-700 hover:bg-gray-200">Batal</a>
                <button type="submit"
                    class="px-5 py-2 rounded-lg bg-emerald-600 text-white font-semibold shadow hover:bg-emerald-700">
                    Update
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
                previewUrl: '',
                file: null,
                fileName: '',
                fileSizeText: '',
                error: '',

                initPreview(url) {
                    if (url) {
                        this.previewUrl = url;
                        // try to extract filename from URL
                        this.fileName = url.split('/').pop();
                        this.fileSizeText = '';
                    }
                },

                handleDrop(e) {
                    this.isDrag = false;
                    const dt = e.dataTransfer;
                    if (!dt || !dt.files || dt.files.length === 0) return;
                    this.processFile(dt.files[0]);
                },

                handleChange(e) {
                    const f = e.target.files[0];
                    if (!f) return;
                    this.processFile(f);
                },

                processFile(f) {
                    this.error = '';
                    const allowed = ['image/jpeg', 'image/png', 'image/webp'];
                    if (!allowed.includes(f.type)) {
                        this.error = 'Tipe file tidak didukung. Gunakan JPG, PNG, atau WEBP.';
                        this.clearInput();
                        return;
                    }
                    const maxBytes = 2 * 1024 * 1024; // 2MB
                    if (f.size > maxBytes) {
                        this.error = 'Ukuran maksimal 2MB.';
                        this.clearInput();
                        return;
                    }

                    this.file = f;
                    this.fileName = f.name;
                    this.fileSizeText = this.humanFileSize(f.size);
                    const reader = new FileReader();
                    reader.onload = (ev) => {
                        this.previewUrl = ev.target.result;
                    };
                    reader.readAsDataURL(f);

                    // set the file to the actual input (already done by browser). No extra step needed.
                },

                removeFile() {
                    this.previewUrl = '';
                    this.file = null;
                    this.fileName = '';
                    this.fileSizeText = '';
                    this.error = '';
                    // clear native input
                    this.$refs.fileInput.value = '';
                },

                clearInput() {
                    this.file = null;
                    this.fileName = '';
                    this.fileSizeText = '';
                    this.previewUrl = '';
                    this.$refs.fileInput.value = '';
                },

                humanFileSize(bytes) {
                    const thresh = 1024;
                    if (Math.abs(bytes) < thresh) {
                        return bytes + ' B';
                    }
                    const units = ['KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
                    let u = -1;
                    do {
                        bytes /= thresh;
                        ++u;
                    } while (Math.abs(bytes) >= thresh && u < units.length - 1);
                    return bytes.toFixed(1) + ' ' + units[u];
                }
            }
        }
    </script>
@endsection
