@extends('layouts.app', ['title' => 'Tambah Partner'])

@section('content')
    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-2xl shadow-lg floating-card p-6 space-y-6">
            <div class="flex items-center justify-between mb-4">
                <h1 class="text-2xl font-bold text-emerald-700">Tambah Partner</h1>
                <a href="{{ route('partners.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                    Kembali
                </a>
            </div>

            @if ($errors->any())
                <div class="p-4 mb-4 text-red-700 bg-red-100 rounded-lg">
                    <ul class="list-disc pl-5 mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('partners.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf

                <div>
                    <label class="block mb-1 font-medium">Nama Partner <span class="text-red-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name') }}"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-emerald-500 focus:border-emerald-500 @error('name') border-red-500 @enderror"
                        required>
                </div>

                <div>
                    <label class="block mb-1 font-medium">Alamat Website</label>
                    <input type="url" name="web_address" value="{{ old('web_address') }}"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-emerald-500 focus:border-emerald-500 @error('web_address') border-red-500 @enderror">
                </div>

                <div>
                    <label class="block mb-1 font-medium">Deskripsi</label>
                    <textarea name="description" id="description" rows="4"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-emerald-500 focus:border-emerald-500">{{ old('description') }}</textarea>
                </div>

                <div>
                    <label class="block mb-1 font-medium">Detail</label>
                    <textarea name="details" rows="4"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-emerald-500 focus:border-emerald-500">{{ old('details') }}</textarea>
                </div>

                <div x-data="imageDropzone({ existingUrl: '{{ $existingUrl ?? '' }}' })" class="space-y-2">
                    <label class="block mb-1 font-medium">Gambar</label>

                    <!-- Dropzone area -->
                    <div x-show="!previewUrl" x-on:click="$refs.file.click()" x-on:dragover.prevent="isDrag = true"
                        x-on:dragleave.prevent="isDrag = false" x-on:drop.prevent="handleDrop($event)"
                        :class="{
                            'border-emerald-400 bg-emerald-50': isDrag,
                            'border-gray-300 bg-white': !isDrag
                        }"
                        class="relative flex flex-col items-center justify-center w-full min-h-[140px] rounded-lg border-2 p-4 cursor-pointer transition"
                        aria-describedby="file-hint">
                        <!-- Cloud SVG -->
                        <div class="flex flex-col items-center gap-2">
                            <svg class="w-12 h-12 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M7 16a4 4 0 01-.88-7.9A5.002 5.002 0 0117.9 9h.1a4.992 4.992 0 012.9 9.1M15 13l-3-3m0 0l-3 3m3-3v12" />
                            </svg>
                            <div class="text-sm font-medium">Tarik & lepas file di sini atau klik untuk memilih</div>
                            <div id="file-hint" class="text-xs text-gray-500">Format: JPEG, PNG, JPG, GIF. Maks 2MB.</div>
                        </div>

                        <!-- Invisible native file input -->
                        <input x-ref="file" type="file" name="image" accept="image/*" class="hidden"
                            x-on:change="handleFile($event.target.files[0])" />
                    </div>

                    <!-- Preview -->
                    <div x-show="previewUrl" class="flex items-center gap-4">
                        <div class="w-24 h-24 flex-shrink-0 rounded-md overflow-hidden border">
                            <img :src="previewUrl" alt="preview" class="object-cover w-full h-full">
                        </div>

                        <div class="flex-1">
                            <div class="text-sm font-medium" x-text="fileName"></div>
                            <div class="text-xs text-gray-500 mt-1" x-text="fileInfo"></div>

                            <div class="mt-3 flex gap-2">
                                <button type="button" x-on:click="removeFile()"
                                    class="inline-flex items-center px-3 py-1.5 text-sm rounded-lg border hover:bg-gray-50">
                                    Hapus
                                </button>

                                <button type="button" x-on:click="$refs.file.click()"
                                    class="inline-flex items-center px-3 py-1.5 text-sm rounded-lg border hover:bg-gray-50">
                                    Ganti
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end gap-3 mt-4">
                    <button type="submit"
                        class="px-4 py-2 bg-emerald-500 text-white rounded-lg hover:bg-emerald-600 transition">
                        Simpan
                    </button>
                    <a href="{{ route('partners.index') }}"
                        class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });
    </script>

    <script>
        function imageDropzone({
            existingUrl = ''
        } = {}) {
            return {
                isDrag: false,
                fileName: '',
                fileInfo: '',
                previewUrl: existingUrl || '',
                fileObject: null,

                handleDrop(e) {
                    const dt = e.dataTransfer;
                    if (!dt || !dt.files || !dt.files[0]) return;
                    this.handleFile(dt.files[0]);
                    this.isDrag = false;
                },

                handleFile(file) {
                    if (!file) return;
                    // Basic validation: type & size (2MB)
                    const validTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
                    if (!validTypes.includes(file.type)) {
                        alert('Format tidak didukung. Gunakan JPEG/PNG/JPG/GIF.');
                        return;
                    }
                    if (file.size > 2 * 1024 * 1024) {
                        alert('Ukuran file melebihi 2MB.');
                        return;
                    }

                    // revoke previous objectURL if any
                    if (this.previewUrl && this.previewUrl.startsWith('blob:')) {
                        URL.revokeObjectURL(this.previewUrl);
                    }

                    this.fileObject = file;
                    this.fileName = file.name;
                    this.fileInfo = Math.round(file.size / 1024) + ' KB · ' + file.type.split('/')[1].toUpperCase();
                    this.previewUrl = URL.createObjectURL(file);

                    // If you need to programmatically set the file input's FileList (for JS-only forms),
                    // that's complicated; when form is submitted normally the browser will include the chosen file.
                },

                removeFile() {
                    if (this.previewUrl && this.previewUrl.startsWith('blob:')) {
                        URL.revokeObjectURL(this.previewUrl);
                    }
                    this.previewUrl = '';
                    this.fileObject = null;
                    this.fileName = '';
                    this.fileInfo = '';
                    // reset native input so change event will fire if same file reselected
                    if (this.$refs.file) this.$refs.file.value = '';
                }
            }
        }
    </script>
@endsection
