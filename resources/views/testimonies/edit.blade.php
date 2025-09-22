@extends('layouts.app', ['title' => 'Edit Testimony'])

@section('content')
    <div class="max-w-3xl mx-auto p-4 sm:p-6">
        <!-- Card Container -->
        <div class="bg-white shadow rounded-2xl p-4 sm:p-6 space-y-6">
            <!-- Header -->
            <div class="border-b pb-4">
                <h1 class="text-xl sm:text-2xl font-bold text-emerald-700">Edit Testimony</h1>
                <p class="text-sm text-gray-500">Perbarui data testimony yang sudah ada.</p>
            </div>

            <form action="{{ route('testimonies.update', $testimony->id) }}" method="POST" enctype="multipart/form-data"
                class="space-y-5">
                @csrf
                @method('PUT')

                <!-- Checkbox tampil di home -->
                <div class="flex items-center">
                    <input type="checkbox" name="display_homepage" value="1"
                        {{ old('display_homepage', $testimony->display_homepage) ? 'checked' : '' }}
                        class="h-4 w-4 text-emerald-600 border-gray-300 rounded focus:ring-emerald-500">
                    <label class="ml-2 text-sm text-gray-700">Tampilkan di Homepage</label>
                </div>

                <!-- Kategori -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                    <div class="relative">
                        <select name="category_dpd_id"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 pr-10 bg-white
                            focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 appearance-none text-sm">
                            <option value="">-- Pilih Kategori --</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_dpd_id', $testimony->category_dpd_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>

                        <!-- Arrow SVG -->
                        <svg class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 h-5 w-5 text-gray-400"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="2">
                            <path d="M6 9l6 6 6-6" />
                        </svg>
                    </div>
                    @error('category_dpd_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Nama & Judul -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                        <input type="text" name="name" value="{{ old('name', $testimony->name) }}"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm
                            focus:ring-emerald-500 focus:border-emerald-500">
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Judul</label>
                        <input type="text" name="title" value="{{ old('title', $testimony->title) }}"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm
                            focus:ring-emerald-500 focus:border-emerald-500">
                        @error('title')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Deskripsi -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                    <textarea name="description" id="description" rows="4"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm
                        focus:ring-emerald-500 focus:border-emerald-500">{{ old('description', $testimony->description) }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div x-data="imageUploadCreate({
                    preview: {{ $testimony->image ? json_encode(asset($testimony->image)) : 'null' }}
                })" class="space-y-2">
                    <label class="block text-sm font-medium mb-1">Image</label>

                    <!-- Area Upload (jika belum ada gambar) -->
                    <div x-show="!previewUrl" x-on:click="triggerInput" x-on:dragover.prevent="isDrag = true"
                        x-on:dragleave.prevent="isDrag = false" x-on:drop.prevent="handleDrop($event)"
                        :class="{
                            'border-emerald-400 bg-emerald-50': isDrag,
                            'border-gray-300': !isDrag
                        }"
                        class="cursor-pointer rounded-lg border-2 border-dashed p-6 flex flex-col items-center justify-center text-center transition-colors">

                        <!-- Ikon Awan Upload -->
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                            class="h-12 w-12 text-emerald-600">
                            <path d="M17.5 19a4.5 4.5 0 0 0 .5-9 6 6 0 0 0-11.5-1.5A4.5 4.5 0 0 0 6.5 19h11z" />
                            <path d="M12 11v6" />
                            <path d="M9 14l3-3 3 3" />
                        </svg>

                        <p class="mt-2 text-sm text-gray-600">Klik atau seret gambar ke sini</p>
                        <p class="text-xs text-gray-400">PNG, JPG, GIF (maks 2MB)</p>

                        <input type="file" name="image" accept="image/*" x-ref="fileInput" class="hidden"
                            x-on:change="handleFiles($event.target.files)" />
                    </div>

                    <!-- Preview (jika sudah ada gambar) -->
                    <div x-show="previewUrl" class="relative w-40">
                        <img :src="previewUrl" alt="Preview"
                            class="w-40 h-40 object-cover rounded-lg border shadow-sm">

                        <div class="mt-2 flex gap-2">
                            <button type="button" x-on:click="triggerInput"
                                class="px-3 py-1 text-sm rounded-lg border hover:bg-gray-50">
                                Ganti
                            </button>
                            <button type="button" x-on:click="removeFile"
                                class="px-3 py-1 text-sm rounded-lg border text-red-600 hover:bg-red-50">
                                Hapus
                            </button>
                        </div>
                    </div>

                    @error('image')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>



                <!-- Action -->
                <div class="flex flex-col sm:flex-row sm:justify-end gap-3 pt-4 border-t">
                    <a href="{{ route('testimonies.index') }}"
                        class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg text-center text-sm hover:bg-gray-300">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-4 py-2 bg-emerald-600 text-white rounded-lg text-sm hover:bg-emerald-700">
                        Update
                    </button>
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
        function imageUploadCreate(config = {}) {
            return {
                previewUrl: config.preview || null,
                isDrag: false,
                triggerInput() {
                    this.$refs.fileInput.click();
                },
                handleFiles(files) {
                    if (!files.length) return;
                    const file = files[0];
                    const reader = new FileReader();
                    reader.onload = e => this.previewUrl = e.target.result;
                    reader.readAsDataURL(file);
                },
                handleDrop(e) {
                    this.isDrag = false;
                    this.handleFiles(e.dataTransfer.files);
                    this.$refs.fileInput.files = e.dataTransfer.files;
                },
                removeFile() {
                    this.previewUrl = null;
                    this.$refs.fileInput.value = '';
                }
            }
        }
    </script>
@endsection
