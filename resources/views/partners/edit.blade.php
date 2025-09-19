@extends('layouts.app', ['title' => 'Edit Partner'])

@section('content')
    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-2xl shadow-lg p-6 space-y-6">

            <!-- Header -->
            <div class="flex items-center justify-between border-b pb-4">
                <h1 class="text-2xl font-bold text-emerald-700">Edit Partner</h1>
                <a href="{{ route('partners.index') }}"
                    class="inline-flex items-center px-4 py-2 rounded-lg bg-gray-200 text-gray-700 hover:bg-gray-300 transition">
                    Kembali
                </a>
            </div>

            <!-- Error Messages -->
            @if ($errors->any())
                <div class="p-4 text-red-700 bg-red-100 rounded-lg">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form -->
            <form action="{{ route('partners.update', $partner->id) }}" method="POST" enctype="multipart/form-data"
                class="space-y-5">
                @csrf
                @method('PUT')

                <!-- Nama Partner -->
                <div>
                    <label class="block mb-1 font-medium">Nama Partner <span class="text-red-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name', $partner->name) }}"
                        class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:ring-emerald-500 focus:border-emerald-500 @error('name') border-red-500 @enderror"
                        required>
                </div>

                <!-- Alamat Website -->
                <div>
                    <label class="block mb-1 font-medium">Alamat Website</label>
                    <input type="url" name="web_address" value="{{ old('web_address', $partner->web_address) }}"
                        class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:ring-emerald-500 focus:border-emerald-500 @error('web_address') border-red-500 @enderror">
                </div>

                <!-- Deskripsi -->
                <div>
                    <label for="description" class="block mb-1 font-medium">Deskripsi</label>
                    <textarea name="description" id="description" rows="4"
                        class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:ring-emerald-500 focus:border-emerald-500 @error('description') border-red-500 @enderror">{{ old('description', $partner->description) }}</textarea>
                    @error('description')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Detail -->
                <div>
                    <label class="block mb-1 font-medium">Detail</label>
                    <textarea name="details" rows="4"
                        class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:ring-emerald-500 focus:border-emerald-500">{{ old('details', $partner->details) }}</textarea>
                </div>

                <!-- Upload Gambar dengan Preview + Tombol Ganti & Hapus -->
                <div x-data="imagePreview('{{ $partner->image ? asset('storage/' . $partner->image) : '' }}')" class="space-y-2">
                    <label class="block mb-1 font-medium">Gambar</label>

                    <!-- Preview -->
                    <!-- Preview -->
                    <template x-if="previewUrl">
                        <div class="relative inline-block">
                            <img :src="previewUrl" alt="Preview Image" class="w-64 h-auto rounded-lg shadow mb-2">
                            <!-- Ukuran diperbesar -->

                            <!-- Tombol Ganti -->
                            <button type="button" @click="$refs.file.click()"
                                class="absolute top-1 left-1 bg-emerald-500 text-white rounded px-2 py-1 text-xs hover:bg-emerald-600">
                                Ganti
                            </button>

                            <!-- Tombol Hapus -->
                            <button type="button" @click="removeImage"
                                class="absolute top-1 right-1 bg-red-500 text-white rounded px-2 py-1 text-xs hover:bg-red-600">
                                Hapus
                            </button>
                        </div>
                    </template>


                    <!-- Dropzone / Input -->
                    <label x-show="!previewUrl"
                        class="flex flex-col items-center justify-center w-full min-h-[140px] rounded-lg border-2 border-dashed border-gray-300 bg-gray-50 cursor-pointer hover:bg-gray-100 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-gray-400 mb-2" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3 15a4 4 0 014-4h1.26A5 5 0 1117 16H7a4 4 0 01-4-1z" />
                        </svg>
                        <span class="text-sm text-gray-600">Klik atau seret file ke sini</span>
                        <span class="text-xs text-gray-500">Format: JPEG, PNG, JPG, GIF. Maksimal 2MB.</span>
                        <input x-ref="file" type="file" name="image" accept="image/*" class="hidden"
                            @change="preview($event)">
                    </label>

                    @error('image')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Actions -->
                <div class="flex justify-end gap-3 pt-4 border-t">
                    <button type="submit"
                        class="px-4 py-2 rounded-lg bg-emerald-500 text-white hover:bg-emerald-600 transition">
                        Update
                    </button>
                    <a href="{{ route('partners.index') }}"
                        class="px-4 py-2 rounded-lg bg-gray-200 text-gray-700 hover:bg-gray-300 transition">
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

        function imagePreview(existingUrl = '') {
            return {
                previewUrl: existingUrl || null,
                preview(event) {
                    const file = event.target.files[0];
                    if (!file) return;
                    const reader = new FileReader();
                    reader.onload = e => this.previewUrl = e.target.result;
                    reader.readAsDataURL(file);
                },
                removeImage() {
                    this.previewUrl = null;
                    this.$refs.file.value = '';
                }
            }
        }
    </script>
@endsection
