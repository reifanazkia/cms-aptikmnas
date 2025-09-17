@extends('layouts.app', ['title' => 'Edit Pengurus - Step 3'])

@section('content')
    <div class="max-w-5xl mx-auto px-4 sm:px-0">
        <div class="bg-white rounded-2xl shadow-lg p-6 sm:p-8 space-y-6">
            <!-- Header -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 border-b pb-4">
                <h1 class="text-xl sm:text-2xl font-bold text-emerald-700">Edit Pengurus - Step 3 dari 3 (Final)</h1>
                <a href="{{ route('pengurus.index') }}"
                    class="inline-flex items-center gap-2 px-3 py-2 sm:px-4 sm:py-2 rounded-lg bg-gray-100 text-gray-700 hover:bg-gray-200 transition text-sm sm:text-base">
                    <i class="fas fa-times"></i> Batal
                </a>
            </div>

            <!-- Progress -->
            <div class="w-full bg-gray-100 rounded-full h-2">
                <div class="bg-emerald-500 h-2 rounded-full" style="width: 100%"></div>
            </div>

            <!-- Alerts -->
            @if (session('success'))
                <div class="p-4 rounded-lg bg-green-50 text-green-700 text-sm">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="p-4 rounded-lg bg-red-50 text-red-700 text-sm">
                    {{ session('error') }}
                </div>
            @endif
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
            <form action="{{ route('pengurus.edit.step3.update', $pengurus->id) }}" method="POST" enctype="multipart/form-data"
                class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Grid Utama -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Title 4 -->
                    <div>
                        <label for="title4" class="block text-sm font-medium text-gray-700">Judul 4 <span class="text-red-500">*</span></label>
                        <input type="text" id="title4" name="title4" value="{{ old('title4', $pengurus->title4 ?? '') }}"
                            class="mt-1 block w-full rounded-lg border py-2 px-3 border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 text-sm @error('title4') border-red-500 @enderror">
                        @error('title4')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Image 4 -->
                    <div>
                        <label for="image4" class="block text-sm font-medium text-gray-700">Gambar 4</label>
                        <input type="file" id="image4" name="image4"
                            class="mt-1 block w-full rounded-lg border py-2 px-3 border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 text-sm @error('image4') border-red-500 @enderror"
                            accept="image/*">
                        <p class="text-xs text-gray-500 mt-1">Format: JPEG, PNG, JPG, GIF. Maksimal 2MB</p>
                        @if (!empty($pengurus->image4))
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $pengurus->image4) }}" alt="Preview"
                                    class="h-24 rounded-lg border">
                            </div>
                        @endif
                        @error('image4')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Deskripsi -->
                <div>
                    <label for="description4" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                    <textarea id="description4" name="description4" rows="3"
                        class="mt-1 block w-full rounded-lg border py-2 px-3 border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 text-sm @error('description4') border-red-500 @enderror">{{ old('description4', $pengurus->description4 ?? '') }}</textarea>
                    @error('description4')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Action -->
                <div class="flex justify-between">
                    <a href="{{ route('pengurus.edit.step2', $pengurus->id) }}"
                        class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-gray-100 text-gray-700 hover:bg-gray-200 text-sm sm:text-base">
                        <i class="fas fa-arrow-left"></i> Kembali ke Step 2
                    </a>
                    <button type="submit"
                        class="inline-flex items-center gap-2 px-5 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 text-sm sm:text-base">
                        <i class="fas fa-save"></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        ClassicEditor.create(document.querySelector('#description4')).catch(error => console.error(error));
    </script>
@endsection
