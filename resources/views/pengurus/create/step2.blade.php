@extends('layouts.app', ['title' => 'Tambah Pengurus - Step 2'])

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-2xl shadow-lg floating-card p-6 space-y-6">
            <!-- Header & Progress -->
            <div
                class="flex flex-col md:flex-row items-start md:items-center justify-between border-b border-emerald-100 pb-4 mb-4">
                <h1 class="text-2xl font-bold text-emerald-700 mb-2 md:mb-0">Tambah Pengurus - Step 2 dari 3</h1>
                <div class="flex gap-2">
                    <a href="{{ route('pengurus.edit', $pengurus->id) }}"
                        class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300 flex items-center gap-1">
                        <i class="fas fa-arrow-left"></i> Kembali ke Step 1
                    </a>
                    <a href="{{ route('pengurus.index') }}"
                        class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 flex items-center gap-1">
                        <i class="fas fa-times"></i> Batal
                    </a>
                </div>
            </div>

            <!-- Progress Bar -->
            <div class="h-2 w-full bg-gray-200 rounded-full mb-4">
                <div class="h-2 bg-emerald-500 rounded-full" style="width: 66%"></div>
            </div>

            <!-- Alerts -->
            @if (session('success'))
                <div class="bg-green-100 text-green-800 px-4 py-3 rounded-md mb-3">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="bg-red-100 text-red-800 px-4 py-3 rounded-md mb-3">
                    {{ session('error') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-md mb-3">
                    <ul class="list-disc pl-5 mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Ringkasan Step 1 -->
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-md mb-4">
                <h6 class="font-semibold mb-1"><i class="fas fa-info-circle"></i> Ringkasan Step 1:</h6>
                <p><strong>Nama:</strong> {{ $pengurus->title }}</p>
                <p><strong>Email:</strong> {{ $pengurus->email }}</p>
            </div>

            <!-- Form -->
            <form action="{{ route('pengurus.create.step2.store', $pengurus->id) }}" method="POST"
                enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div class="grid md:grid-cols-2 gap-6">
                    <!-- Informasi Tambahan 1 -->
                    <div class="bg-white border border-emerald-200 rounded-xl shadow-sm p-4 space-y-3">
                        <div class="bg-emerald-500 text-white px-3 py-2 rounded-md">
                            <h5 class="font-semibold">Informasi Tambahan 1</h5>
                        </div>
                        <div>
                            <label for="title2" class="block text-sm font-medium text-gray-700">Judul 2 <span
                                    class="text-red-500">*</span></label>
                            <input type="text" id="title2" name="title2" value="{{ old('title2') }}"
                                class="mt-1 block w-full border rounded-lg px-3 py-2 focus:ring-emerald-500 focus:border-emerald-500 @error('title2') border-red-500 @enderror"
                                required>
                            @error('title2')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="description2" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                            <textarea name="description2" id="description2" rows="4"
                                class="w-full rounded-lg px-3 py-2 text-sm border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                            @error('description2')
                                <p cla ss="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="image2" class="block text-sm font-medium text-gray-700">Gambar 2</label>
                            <input type="file" id="image2" name="image2"
                                class="mt-1 block w-full border rounded-lg px-3 py-2 @error('image2') border-red-500 @enderror"
                                accept="image/*">
                            <p class="text-xs text-gray-500 mt-1">Format: JPEG, PNG, JPG, GIF. Maksimal 2MB</p>
                            @error('image2')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Informasi Tambahan 2 -->
                    <div class="bg-white border border-yellow-200 rounded-xl shadow-sm p-4 space-y-3">
                        <div class="bg-yellow-400 text-gray-800 px-3 py-2 rounded-md">
                            <h5 class="font-semibold">Informasi Tambahan 2</h5>
                        </div>
                        <div>
                            <label for="title3" class="block text-sm font-medium text-gray-700">Judul 3 <span
                                    class="text-red-500">*</span></label>
                            <input type="text" id="title3" name="title3" value="{{ old('title3') }}"
                                class="mt-1 block w-full border rounded-lg px-3 py-2 focus:ring-emerald-500 focus:border-emerald-500 @error('title3') border-red-500 @enderror"
                                required>
                            @error('title3')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="description3" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                            <textarea name="description3" id="description3" rows="4"
                                class="w-full rounded-lg px-3 py-2 text-sm border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                            @error('description3')
                                <p cla ss="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="image3" class="block text-sm font-medium text-gray-700">Gambar 3</label>
                            <input type="file" id="image3" name="image3"
                                class="mt-1 block w-full border rounded-lg px-3 py-2 @error('image3') border-red-500 @enderror"
                                accept="image/*">
                            <p class="text-xs text-gray-500 mt-1">Format: JPEG, PNG, JPG, GIF. Maksimal 2MB</p>
                            @error('image3')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="flex justify-between mt-4">
                    <a href="{{ route('pengurus.edit', $pengurus->id) }}"
                        class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300 flex items-center gap-1">
                        <i class="fas fa-arrow-left"></i> Kembali ke Step 1
                    </a>
                    <button type="submit"
                        class="px-4 py-2 bg-emerald-500 hover:bg-emerald-600 text-white rounded-lg flex items-center gap-1">
                        Lanjut ke Step 3 <i class="fas fa-arrow-right"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        ClassicEditor
            .create(document.querySelector('#description2'))
            .catch(error => {
                console.error(error);
            });

        ClassicEditor
            .create(document.querySelector('#description3'))
            .catch(error => {
                console.error(error);
            });
    </script>

@endsection
