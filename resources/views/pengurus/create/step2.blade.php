@extends('layouts.app', ['title' => 'Tambah Pengurus - Step 2'])

@section('content')
    <div class="max-w-4xl mx-auto px-4 sm:px-0">
        <div class="bg-white rounded-2xl shadow-lg floating-card p-4 sm:p-6 space-y-6">
            <!-- Header & Progress -->
            <div class="flex flex-col md:flex-row md:items-center md:justify-between border-b border-emerald-100 pb-4">
                <h1 class="text-lg sm:text-2xl font-bold text-emerald-700">Tambah Pengurus - Step 2 dari 3</h1>
                <div class="flex flex-wrap gap-2 mt-3 md:mt-0">
                    <a href="{{ route('pengurus.edit', $pengurus->id) }}"
                        class="px-3 py-2 sm:px-4 sm:py-2 bg-gray-200 rounded-lg hover:bg-gray-300 flex items-center gap-1 text-sm sm:text-base">
                        <i class="fas fa-arrow-left"></i> Kembali ke Step 1
                    </a>
                    <a href="{{ route('pengurus.index') }}"
                        class="px-3 py-2 sm:px-4 sm:py-2 border border-gray-300 rounded-lg hover:bg-gray-50 flex items-center gap-1 text-sm sm:text-base">
                        <i class="fas fa-times"></i> Batal
                    </a>
                </div>
            </div>

            <!-- Progress Bar -->
            <div class="h-2 w-full bg-gray-200 rounded-full">
                <div class="h-2 bg-emerald-500 rounded-full" style="width: 66%"></div>
            </div>

            <!-- Alerts -->
            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-md text-sm sm:text-base">
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Ringkasan Step 1 -->
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-md">
                <h6 class="font-semibold mb-1 flex items-center gap-1 text-sm sm:text-base">
                    <i class="fas fa-info-circle"></i> Ringkasan Step 1:
                </h6>
                <p class="text-sm sm:text-base"><strong>Nama:</strong> {{ $pengurus->title }}</p>
                <p class="text-sm sm:text-base"><strong>Email:</strong> {{ $pengurus->email }}</p>
            </div>

            <!-- Form -->
            <form action="{{ route('pengurus.create.step2.store', $pengurus->id) }}" method="POST" enctype="multipart/form-data"
                class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Informasi Tambahan 1 -->
                    <div class="bg-white border border-emerald-200 rounded-xl shadow p-4 space-y-4">
                        <div class="bg-emerald-500 text-white px-3 py-2 rounded-md">
                            <h5 class="font-semibold text-sm sm:text-base">Informasi Tambahan 1</h5>
                        </div>
                        <div>
                            <label for="title2" class="block text-sm font-medium text-gray-700">Judul 2 <span
                                    class="text-red-500">*</span></label>
                            <input type="text" id="title2" name="title2" value="{{ old('title2') }}"
                                class="mt-1 block w-full border rounded-lg px-3 py-2 text-sm sm:text-base focus:ring-emerald-500 focus:border-emerald-500 @error('title2') border-red-500 @enderror"
                                required>
                        </div>
                        <div>
                            <label for="description2" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                            <textarea id="description2" name="description2" rows="3"
                                class="mt-1 w-full rounded-lg border px-3 py-2 text-sm sm:text-base focus:ring-emerald-500 focus:border-emerald-500">{{ old('description2') }}</textarea>
                        </div>
                        <div>
                            <label for="image2" class="block text-sm font-medium text-gray-700">Gambar 2</label>
                            <input type="file" id="image2" name="image2" accept="image/*"
                                class="mt-1 block w-full text-sm sm:text-base border rounded-lg px-3 py-2">
                            <p class="text-xs text-gray-500 mt-1">Format: JPEG, PNG, JPG, GIF. Maksimal 2MB</p>
                        </div>
                    </div>

                    <!-- Informasi Tambahan 2 -->
                    <div class="bg-white border border-yellow-200 rounded-xl shadow p-4 space-y-4">
                        <div class="bg-emerald-500 text-white px-3 py-2 rounded-md">
                            <h5 class="font-semibold text-sm sm:text-base">Informasi Tambahan 2</h5>
                        </div>
                        <div>
                            <label for="title3" class="block text-sm font-medium text-gray-700">Judul 3 <span
                                    class="text-red-500">*</span></label>
                            <input type="text" id="title3" name="title3" value="{{ old('title3') }}"
                                class="mt-1 block w-full border rounded-lg px-3 py-2 text-sm sm:text-base focus:ring-emerald-500 focus:border-emerald-500 @error('title3') border-red-500 @enderror"
                                required>
                        </div>
                        <div>
                            <label for="description3" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                            <textarea id="description3" name="description3" rows="3"
                                class="mt-1 w-full rounded-lg border px-3 py-2 text-sm sm:text-base focus:ring-emerald-500 focus:border-emerald-500">{{ old('description3') }}</textarea>
                        </div>
                        <div>
                            <label for="image3" class="block text-sm font-medium text-gray-700">Gambar 3</label>
                            <input type="file" id="image3" name="image3" accept="image/*"
                                class="mt-1 block w-full text-sm sm:text-base border rounded-lg px-3 py-2">
                            <p class="text-xs text-gray-500 mt-1">Format: JPEG, PNG, JPG, GIF. Maksimal 2MB</p>
                        </div>
                    </div>
                </div>

                <!-- Navigation Buttons -->
                <div class="flex flex-col sm:flex-row justify-between gap-3 mt-6">
                    <a href="{{ route('pengurus.edit', $pengurus->id) }}"
                        class="w-full sm:w-auto px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300 flex items-center justify-center gap-1 text-sm sm:text-base">
                        <i class="fas fa-arrow-left"></i> Kembali ke Step 1
                    </a>
                    <button type="submit"
                        class="w-full sm:w-auto px-4 py-2 bg-emerald-500 hover:bg-emerald-600 text-white rounded-lg flex items-center justify-center gap-1 text-sm sm:text-base">
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
@endsection
