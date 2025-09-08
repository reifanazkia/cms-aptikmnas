@extends('layouts.app', ['title' => 'Edit Pengurus - Step 2'])

@section('content')
    <div class="max-w-6xl mx-auto px-4 sm:px-6">
        <div class="bg-white rounded-2xl shadow-lg floating-card p-4 sm:p-6 space-y-6">

            <!-- Header & Progress -->
            <div
                class="flex flex-col md:flex-row md:items-center md:justify-between border-b border-emerald-100 pb-4 mb-4 gap-3">
                <h1 class="text-xl sm:text-2xl font-bold text-emerald-700">
                    Edit Pengurus - Step 2 dari 3
                </h1>
                <div class="flex flex-col sm:flex-row flex-wrap gap-2 w-full md:w-auto">
                    <a href="{{ route('pengurus.edit', $pengurus->id) }}"
                        class="inline-flex items-center justify-center px-3 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition w-full sm:w-auto">
                        <i class="fas fa-arrow-left mr-2"></i> Step 1
                    </a>
                    <a href="{{ route('pengurus.show', $pengurus->id) }}"
                        class="inline-flex items-center justify-center px-3 py-2 bg-emerald-100 text-emerald-700 rounded-lg hover:bg-emerald-200 transition w-full sm:w-auto">
                        <i class="fas fa-eye mr-2"></i> Lihat Detail
                    </a>
                    <a href="{{ route('pengurus.index') }}"
                        class="inline-flex items-center justify-center px-3 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition w-full sm:w-auto">
                        <i class="fas fa-times mr-2"></i> Batal
                    </a>
                </div>
            </div>

            <!-- Progress Bar -->
            <div class="w-full mt-3">
                <div class="h-2 bg-gray-200 rounded-full overflow-hidden">
                    <div class="h-2 bg-emerald-500" style="width:66%"></div>
                </div>
            </div>

            <!-- Alerts -->
            @if (session('success'))
                <div class="p-3 sm:p-4 mb-4 text-green-700 bg-green-100 rounded-lg text-sm">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="p-3 sm:p-4 mb-4 text-red-700 bg-red-100 rounded-lg text-sm">
                    <ul class="list-disc pl-5 mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Summary Step 1 -->
            <div class="p-4 bg-emerald-50 border-l-4 border-emerald-500 rounded-lg text-sm sm:text-base">
                <h6 class="font-semibold mb-2"><i class="fas fa-info-circle mr-2"></i>Data Pengurus:</h6>
                <p><strong>Nama:</strong> {{ $pengurus->title }}</p>
                <p><strong>Email:</strong> {{ $pengurus->email }}</p>
            </div>

            <form action="{{ route('pengurus.edit.step2.update', $pengurus->id) }}" method="POST"
                enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Grid jadi 1 kolom di mobile -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <!-- Informasi Tambahan 1 -->
                    <div class="bg-white rounded-xl shadow-md">
                        <div class="bg-emerald-500 text-white px-4 py-2 rounded-t-lg">
                            <h5 class="font-semibold">Informasi Tambahan 1</h5>
                        </div>
                        <div class="p-4 space-y-4">
                            <div>
                                <label for="title2" class="block mb-1 font-medium text-sm">Judul 2 <span
                                        class="text-red-500">*</span></label>
                                <input type="text" id="title2" name="title2"
                                    value="{{ old('title2', $pengurus->title2) }}"
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-emerald-500 focus:border-emerald-500 @error('title2') border-red-500 @enderror"
                                    required>
                                @error('title2')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="description2" class="block text-sm font-medium text-gray-700">
                                    Deskripsi <span class="text-red-500">*</span>
                                </label>
                                <textarea id="description2" name="description2"
                                    class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-emerald-400 focus:border-emerald-500 @error('description2') border-red-500 @enderror"
                                    required>{{ old('description2', $pengurus->description2) }}</textarea>
                                @error('description2')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>


                            <div>
                                <label for="image2" class="block mb-1 font-medium text-sm">Gambar 2</label>
                                @if ($pengurus->image2)
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/' . $pengurus->image2) }}" alt="Current Image 2"
                                            class="w-20 h-20 object-cover rounded-lg">
                                        <small class="text-gray-500 block">Gambar 2 saat ini</small>
                                    </div>
                                @endif
                                <input type="file" id="image2" name="image2" accept="image/*"
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm @error('image2') border-red-500 @enderror">
                                <small class="text-gray-500 block text-xs mt-1">Maksimal 2MB. Kosongkan jika tidak ingin
                                    mengganti.</small>
                                @error('image2')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Informasi Tambahan 2 -->
                    <div class="bg-white rounded-xl shadow-md">
                        <div class="bg-yellow-400 text-gray-800 px-4 py-2 rounded-t-lg">
                            <h5 class="font-semibold">Informasi Tambahan 2</h5>
                        </div>
                        <div class="p-4 space-y-4">
                            <div>
                                <label for="title3" class="block mb-1 font-medium text-sm">Judul 3 <span
                                        class="text-red-500">*</span></label>
                                <input type="text" id="title3" name="title3"
                                    value="{{ old('title3', $pengurus->title3) }}"
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-emerald-500 focus:border-emerald-500 @error('title3') border-red-500 @enderror"
                                    required>
                                @error('title3')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="description3" class="block text-sm font-medium text-gray-700">
                                    Deskripsi <span class="text-red-500">*</span>
                                </label>
                                <textarea id="description3" name="description3"
                                    class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-emerald-400 focus:border-emerald-500 @error('description3') border-red-500 @enderror"
                                    required>{{ old('description3', $pengurus->description3) }}</textarea>
                                @error('description3')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>


                            <div>
                                <label for="image3" class="block mb-1 font-medium text-sm">Gambar 3</label>
                                @if ($pengurus->image3)
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/' . $pengurus->image3) }}" alt="Current Image 3"
                                            class="w-20 h-20 object-cover rounded-lg">
                                        <small class="text-gray-500 block">Gambar 3 saat ini</small>
                                    </div>
                                @endif
                                <input type="file" id="image3" name="image3" accept="image/*"
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm @error('image3') border-red-500 @enderror">
                                <small class="text-gray-500 block text-xs mt-1">Maksimal 2MB. Kosongkan jika tidak ingin
                                    mengganti.</small>
                                @error('image3')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tombol Navigasi -->
                <div class="flex flex-col sm:flex-row justify-between gap-3 mt-6">
                    <a href="{{ route('pengurus.edit', $pengurus->id) }}"
                        class="inline-flex items-center justify-center px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition w-full sm:w-auto">
                        <i class="fas fa-arrow-left mr-2"></i> Step 1
                    </a>
                    <button type="submit"
                        class="inline-flex items-center justify-center px-4 py-2 bg-emerald-500 text-white rounded-lg hover:bg-emerald-600 transition w-full sm:w-auto">
                        Lanjut ke Step 3 <i class="fas fa-arrow-right ml-2"></i>
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
