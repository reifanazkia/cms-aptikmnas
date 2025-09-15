@extends('layouts.app', ['title' => 'Tambah Pengurus - Step 2'])

@section('content')
    <div class="max-w-5xl mx-auto px-4 sm:px-0">
        <div class="bg-white rounded-2xl shadow-lg p-6 sm:p-8 space-y-6">
            <!-- Header -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 border-b pb-4">
                <h1 class="text-xl sm:text-2xl font-bold text-emerald-700">Tambah Pengurus - Step 2 dari 3</h1>
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
            <form action="{{ route('pengurus.create.step2.store', $pengurus->id) }}" method="POST"
                enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Informasi Tambahan 1 -->
                    <div class="space-y-4">
                        <h5 class="font-semibold text-emerald-700 text-base">Informasi Tambahan 1</h5>
                        <div>
                            <label for="title2" class="block text-sm font-medium text-gray-700">Judul 2 <span
                                    class="text-red-500">*</span></label>
                            <input type="text" id="title2" name="title2" value="{{ old('title2') }}"
                                class="mt-1 block w-full rounded-lg border py-2 px-3 border-gray-300 text-sm focus:ring-emerald-500 focus:border-emerald-500 @error('title2') border-red-500 @enderror"
                                required>
                        </div>
                        <div>
                            <label for="description2" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                            <textarea id="description2" name="description2" rows="3"
                                class="mt-1 block w-full rounded-lg border py-2 px-3 border-gray-300 text-sm focus:ring-emerald-500 focus:border-emerald-500">{{ old('description2') }}</textarea>
                        </div>
                        <div>
                            <label for="image2" class="block text-sm font-medium text-gray-700">Gambar 2</label>
                            <input type="file" id="image2" name="image2" accept="image/*"
                                class="mt-1 block w-full rounded-lg border py-2 px-3 border-gray-300 text-sm focus:ring-emerald-500 focus:border-emerald-500">
                            <p class="text-xs text-gray-500 mt-1">Format: JPEG, PNG, JPG, GIF. Maksimal 2MB</p>
                        </div>
                    </div>

                    <!-- Informasi Tambahan 2 -->
                    <div class="space-y-4">
                        <h5 class="font-semibold text-emerald-700 text-base">Informasi Tambahan 2</h5>
                        <div>
                            <label for="title3" class="block text-sm font-medium text-gray-700">Judul 3 <span
                                    class="text-red-500">*</span></label>
                            <input type="text" id="title3" name="title3" value="{{ old('title3') }}"
                                class="mt-1 block w-full rounded-lg border py-2 px-3 border-gray-300 text-sm focus:ring-emerald-500 focus:border-emerald-500 @error('title3') border-red-500 @enderror"
                                required>
                        </div>
                        <div>
                            <label for="description3" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                            <textarea id="description3" name="description3" rows="3"
                                class="mt-1 block w-full rounded-lg border py-2 px-3 border-gray-300 text-sm focus:ring-emerald-500 focus:border-emerald-500">{{ old('description3') }}</textarea>
                        </div>
                        <div>
                            <label for="image3" class="block text-sm font-medium text-gray-700">Gambar 3</label>
                            <input type="file" id="image3" name="image3" accept="image/*"
                                class="mt-1 block w-full rounded-lg border py-2 px-3 border-gray-300 text-sm focus:ring-emerald-500 focus:border-emerald-500">
                            <p class="text-xs text-gray-500 mt-1">Format: JPEG, PNG, JPG, GIF. Maksimal 2MB</p>
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
@endsection
