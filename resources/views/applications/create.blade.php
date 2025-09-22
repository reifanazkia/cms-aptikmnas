@extends('layouts.app', ['title' => 'Tambah Lamaran'])

@section('content')
    <div class="max-w-4xl mx-auto bg-white p-8 rounded-2xl shadow-lg space-y-8">
        <!-- Header -->
        <div class="border-b pb-4">
            <h1 class="text-3xl font-bold text-emerald-700">Tambah Lamaran Kerja</h1>
            <p class="text-gray-500 text-sm mt-1">Silakan lengkapi formulir berikut untuk melamar posisi yang tersedia.</p>
        </div>

        <!-- Form -->
        <form method="POST" action="{{ route('applications.store') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Posisi -->
            <div class="relative">
                <label class="block text-sm font-medium text-gray-700 mb-1">Posisi</label>
                <select name="career_id"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 appearance-none pr-10">
                    <option value="">-- Pilih Posisi --</option>
                    @foreach ($careers as $career)
                        <option value="{{ $career->id }}" {{ old('career_id') == $career->id ? 'selected' : '' }}>
                            {{ $career->position_title }}
                        </option>
                    @endforeach
                </select>

                <!-- Custom Arrow -->
                <div class="absolute inset-y-0 right-3 top-5 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>

                @error('career_id')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>


            <!-- Grid Nama, Email, No Telepon -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nama -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                    <input type="text" name="nama" value="{{ old('nama') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                    @error('nama')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                    @error('email')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- No Telepon -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">No Telepon</label>
                    <input type="text" name="no_telepon" value="{{ old('no_telepon') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                    @error('no_telepon')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Cover Letter -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Cover Letter</label>
                <textarea name="cover_letter" rows="5"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">{{ old('cover_letter') }}</textarea>
            </div>

            <!-- File Upload -->
            <div x-data="{ isDrag: false, fileName: '' }" class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">Upload CV (PDF)</label>

                <!-- Drop Area -->
                <div @click="$refs.fileInput.click()" @dragover.prevent="isDrag = true" @dragleave.prevent="isDrag = false"
                    @drop.prevent="
            isDrag = false;
            const file = $event.dataTransfer.files[0];
            if(file && file.type === 'application/pdf') {
                fileName = file.name;
                $refs.fileInput.files = $event.dataTransfer.files;
            }
        "
                    :class="isDrag ? 'border-emerald-500 bg-emerald-50' : 'border-gray-300 bg-gray-50'"
                    class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed rounded-lg cursor-pointer transition">
                    <!-- SVG Awan -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-gray-400 mb-2" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 16a4 4 0 01.88-7.9 5.002 5.002 0 019.18-2.1A4.5 4.5 0 0119 16h-1m-6-4v8m0 0l-3-3m3 3l3-3" />
                    </svg>

                    <p class="text-sm text-gray-600"
                        x-text="fileName ? fileName : 'Drag & drop CV di sini atau klik untuk pilih (PDF)'"></p>
                </div>

                <!-- Hidden Input -->
                <input type="file" name="file" accept="application/pdf" x-ref="fileInput" class="hidden"
                    @change="fileName = $refs.fileInput.files.length > 0 ? $refs.fileInput.files[0].name : ''">

                <!-- Preview + Hapus -->
                <template x-if="fileName">
                    <div class="flex items-center justify-between mt-2 p-2 bg-gray-100 rounded-lg">
                        <span class="text-sm text-gray-700 truncate w-3/4" x-text="fileName"></span>
                        <button type="button" @click="$refs.fileInput.value = ''; fileName = ''"
                            class="ml-2 text-red-500 hover:text-red-700 text-sm font-medium">
                            Hapus
                        </button>
                    </div>
                </template>

                @error('file')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>


            <!-- Action Buttons -->
            <div class="flex justify-end gap-4 pt-4 border-t">
                <a href="{{ route('applications.index') }}"
                    class="px-5 py-2.5 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition">
                    Batal
                </a>
                <button type="submit"
                    class="px-5 py-2.5 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition">
                    Simpan
                </button>
            </div>
        </form>
    </div>
@endsection
