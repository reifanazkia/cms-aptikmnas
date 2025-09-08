@extends('layouts.app', ['title' => 'Edit Pengurus - Step 3'])

@section('content')
    <div class="flex justify-center items-start min-h-screen py-6 sm:py-10 bg-gray-50">
        <div class="bg-white border rounded-2xl shadow-lg p-4 sm:p-6 space-y-6 w-full max-w-6xl">
            <!-- Header & Progress -->
            <div
                class="flex flex-col sm:flex-row sm:items-center sm:justify-between border-b border-emerald-100 pb-4 mb-4 space-y-3 sm:space-y-0">
                <h1 class="text-xl sm:text-2xl font-bold text-emerald-700">
                    Edit Pengurus - Step 3 dari 3
                </h1>
                <div class="flex flex-col sm:flex-row gap-2">
                    <a href="{{ route('pengurus.edit.step2', $pengurus->id) }}"
                        class="inline-flex items-center justify-center px-3 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition text-sm sm:text-base">
                        <i class="fas fa-arrow-left mr-2"></i> Step 2
                    </a>
                    <a href="{{ route('pengurus.show', $pengurus->id) }}"
                        class="inline-flex items-center justify-center px-3 py-2 bg-emerald-100 text-emerald-700 rounded-lg hover:bg-emerald-200 transition text-sm sm:text-base">
                        <i class="fas fa-eye mr-2"></i> Lihat
                    </a>
                    <a href="{{ route('pengurus.index') }}"
                        class="inline-flex items-center justify-center px-3 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition text-sm sm:text-base">
                        <i class="fas fa-times mr-2"></i> Batal
                    </a>
                </div>
            </div>

            <!-- Progress Bar -->
            <div class="w-full mt-3">
                <div class="h-2 bg-gray-200 rounded-full overflow-hidden">
                    <div class="h-2 bg-emerald-500" style="width:100%"></div>
                </div>
            </div>

            <!-- Alerts -->
            @if (session('success'))
                <div class="p-3 sm:p-4 mb-4 text-green-700 bg-green-100 rounded-lg text-sm sm:text-base" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="p-3 sm:p-4 mb-4 text-red-700 bg-red-100 rounded-lg text-sm sm:text-base">
                    <ul class="list-disc pl-5 mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Summary Step 1 & 2 -->
            <div class="p-4 bg-emerald-50 border-l-4 border-emerald-500 rounded-lg mb-6 text-sm sm:text-base">
                <h6 class="font-semibold mb-2 flex items-center"><i class="fas fa-info-circle mr-2"></i>Ringkasan Data:</h6>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p><strong>Title:</strong> {{ $pengurus->title }}</p>
                        <p><strong>Email:</strong> {{ $pengurus->email }}</p>
                        <p><strong>Phone:</strong> {{ $pengurus->phone }}</p>
                    </div>
                    <div>
                        <p><strong>Title 2:</strong> {{ $pengurus->title2 ?? '-' }}</p>
                        <p><strong>Title 3:</strong> {{ $pengurus->title3 ?? '-' }}</p>
                        <p><strong>Category Daftar:</strong> {{ $pengurus->categoryDaftar->name ?? '-' }}</p>
                        <p><strong>Address:</strong> {{ Str::limit($pengurus->address, 100) }}</p>
                    </div>
                </div>
            </div>

            <form action="{{ route('pengurus.edit.step3.update', $pengurus->id) }}" method="POST"
                enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Informasi Tambahan 3 -->
                <div class="bg-white rounded-xl shadow-md">
                    <div class="bg-yellow-400 text-gray-800 px-4 py-2 rounded-t-lg">
                        <h5 class="font-semibold text-sm sm:text-base">Informasi Tambahan 3</h5>
                    </div>
                    <div class="p-4 space-y-4">
                        <div>
                            <label for="title4" class="block mb-1 font-medium text-sm sm:text-base">Judul 4 <span
                                    class="text-red-500">*</span></label>
                            <input type="text" id="title4" name="title4"
                                value="{{ old('title4', $pengurus->title4) }}"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-emerald-500 focus:border-emerald-500 text-sm sm:text-base @error('title4') border-red-500 @enderror"
                                required>
                            @error('title4')
                                <p class="text-red-500 text-xs sm:text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="description4" class="block mb-1 font-medium text-sm sm:text-base">Deskripsi 4
                                <span class="text-red-500">*</span></label>
                            <textarea id="description4" name="description4" rows="4" required
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-emerald-500 focus:border-emerald-500 text-sm sm:text-base @error('description4') border-red-500 @enderror">{{ old('description4', $pengurus->description4) }}</textarea>
                            @error('description4')
                                <p class="text-red-500 text-xs sm:text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="image4" class="block mb-1 font-medium text-sm sm:text-base">Gambar 4</label>
                            @if ($pengurus->image4)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $pengurus->image4) }}" alt="Current Image 4"
                                        class="w-24 h-24 object-cover rounded-lg">
                                    <small class="text-gray-500 block text-xs">Gambar 4 saat ini</small>
                                </div>
                            @endif
                            <input type="file" id="image4" name="image4" accept="image/*"
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm sm:text-base @error('image4') border-red-500 @enderror">
                            <small class="text-gray-500 block text-xs mt-1">Format: JPEG, PNG, JPG, GIF. Maksimal 2MB.
                                Kosongkan jika tidak ingin mengganti.</small>
                            @error('image4')
                                <p class="text-red-500 text-xs sm:text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Tombol Navigasi -->
                <div class="flex flex-col sm:flex-row justify-between gap-3 mt-6">
                    <a href="{{ route('pengurus.edit.step2', $pengurus->id) }}"
                        class="inline-flex items-center justify-center px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition text-sm sm:text-base">
                        <i class="fas fa-arrow-left mr-2"></i> Step 2
                    </a>
                    <button type="submit"
                        class="inline-flex items-center justify-center px-4 py-2 bg-emerald-500 text-white rounded-lg hover:bg-emerald-600 transition text-sm sm:text-base">
                        Update Complete <i class="fas fa-check ml-2"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        ClassicEditor
            .create(document.querySelector('#description4'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
