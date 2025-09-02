@extends('layouts.app', ['title' => 'Edit Pengurus - Step 3'])

@section('content')
    <div class="flex justify-center items-center md:items-center min-h-screen py-10 bg-gray-50">
        <div class="bg-white border items-center rounded-2xl shadow-lg floating-card p-6 space-y-6 w-full max-w-6xl">
            <!-- Header & Progress -->
            <div class="flex flex-col md:flex-row md:items-center md:justify-between border-b border-emerald-100 pb-4 mb-4">
                <h1 class="text-2xl font-bold text-emerald-700 mb-3 md:mb-0">
                    Edit Pengurus - Step 3 dari 3
                </h1>
                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('pengurus.edit.step2', $pengurus->id) }}"
                        class="inline-flex items-center px-3 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                        <i class="fas fa-arrow-left mr-2"></i> Kembali ke Step 2
                    </a>
                    <a href="{{ route('pengurus.show', $pengurus->id) }}"
                        class="inline-flex items-center px-3 py-2 bg-emerald-100 text-emerald-700 rounded-lg hover:bg-emerald-200 transition">
                        <i class="fas fa-eye mr-2"></i> Lihat Detail
                    </a>
                    <a href="{{ route('pengurus.index') }}"
                        class="inline-flex items-center px-3 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition">
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
                <div class="p-4 mb-4 text-green-700 bg-green-100 rounded-lg" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="p-4 mb-4 text-red-700 bg-red-100 rounded-lg">
                    <ul class="list-disc pl-5 mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Summary Step 1 & 2 -->
            <div class="p-4 bg-emerald-50 border-l-4 border-emerald-500 rounded-lg mb-6">
                <h6 class="font-semibold mb-2"><i class="fas fa-info-circle mr-2"></i>Ringkasan Data:</h6>
                <div class="grid md:grid-cols-2 gap-4">
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

                <div class="mx-auto gap-6">
                    <!-- Informasi Tambahan 3 -->
                    <div class="bg-white rounded-xl shadow-md p-4">
                        <div class="bg-yellow-400 text-gray-800 px-4 py-2 rounded-t-lg">
                            <h5 class="font-semibold">Informasi Tambahan 3</h5>
                        </div>
                        <div class="p-4 space-y-4">
                            <div>
                                <label for="title4" class="block mb-1 font-medium">Judul 4 <span
                                        class="text-red-500">*</span></label>
                                <input type="text" id="title4" name="title4"
                                    value="{{ old('title4', $pengurus->title4) }}"
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-emerald-500 focus:border-emerald-500 @error('title4') border-red-500 @enderror"
                                    required>
                                @error('title4')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="description4" class="block mb-1 font-medium">Deskripsi 4 <span
                                        class="text-red-500">*</span></label>
                                <textarea id="description4" name="description4" rows="4" required
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-emerald-500 focus:border-emerald-500 @error('description4') border-red-500 @enderror">{{ old('description4', $pengurus->description4) }}</textarea>
                                @error('description4')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="image4" class="block mb-1 font-medium">Gambar 4</label>
                                @if ($pengurus->image4)
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/' . $pengurus->image4) }}" alt="Current Image 4"
                                            class="w-24 h-24 object-cover rounded-lg">
                                        <small class="text-gray-500 block">Gambar 4 saat ini</small>
                                    </div>
                                @endif
                                <input type="file" id="image4" name="image4" accept="image/*"
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 @error('image4') border-red-500 @enderror">
                                <small class="text-gray-500 block text-xs mt-1">Format: JPEG, PNG, JPG, GIF. Maksimal 2MB.
                                    Kosongkan jika tidak ingin mengganti.</small>
                                @error('image4')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-between mt-6">
                    <a href="{{ route('pengurus.edit.step2', $pengurus->id) }}"
                        class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                        <i class="fas fa-arrow-left mr-2"></i> Kembali ke Step 2
                    </a>
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-emerald-500 text-white rounded-lg hover:bg-emerald-600 transition">
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
