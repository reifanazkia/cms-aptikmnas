@extends('layouts.app', ['title' => 'Tambah Pengurus - Step 3'])

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-2xl shadow-lg floating-card p-6 space-y-6">

            <!-- Header & Progress -->
            <div
                class="flex flex-col md:flex-row items-start md:items-center justify-between border-b border-emerald-100 pb-4 mb-4">
                <h1 class="text-2xl font-bold text-emerald-700 mb-2 md:mb-0">Tambah Pengurus - Step 3 dari 3 (Final)</h1>
                <div class="flex gap-2">
                    <a href="{{ route('pengurus.edit.step2', $pengurus->id) }}"
                        class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300 flex items-center gap-1">
                        <i class="fas fa-arrow-left"></i> Kembali ke Step 2
                    </a>
                    <a href="{{ route('pengurus.index') }}"
                        class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 flex items-center gap-1">
                        <i class="fas fa-times"></i> Batal
                    </a>
                </div>
            </div>

            <!-- Progress Bar -->
            <div class="h-2 w-full bg-gray-200 rounded-full mb-4 overflow-hidden">
                <div class="h-2 bg-emerald-500 rounded-full" style="width: 100%"></div>
            </div>

            <!-- Alerts -->
            @if (session('success'))
                <div class="bg-green-50 text-green-700 px-4 py-3 rounded-md shadow-sm mb-3">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="bg-red-50 text-red-700 px-4 py-3 rounded-md shadow-sm mb-3">
                    {{ session('error') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-md shadow-sm mb-3">
                    <ul class="list-disc pl-5 mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Ringkasan Previous Steps -->
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-md mb-4">
                <h6 class="font-semibold mb-2"><i class="fas fa-info-circle"></i> Ringkasan Data:</h6>
                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <p><strong>Nama:</strong> {{ $pengurus->title }}</p>
                        <p><strong>Email:</strong> {{ $pengurus->email }}</p>
                    </div>
                    <div>
                        @if ($pengurus->title2)
                            <p><strong>Judul 2:</strong> {{ $pengurus->title2 }}</p>
                        @endif
                        @if ($pengurus->title3)
                            <p><strong>Judul 3:</strong> {{ $pengurus->title3 }}</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Form -->
            <form action="{{ route('pengurus.create.step3.store', $pengurus->id) }}" method="POST"
                enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div class="bg-white border border-emerald-200 rounded-xl shadow-sm p-4 space-y-3">
                    <div class="bg-emerald-500 text-white px-3 py-2 rounded-md">
                        <h5 class="font-semibold">Informasi Tambahan Terakhir</h5>
                    </div>

                    <div>
                        <label for="title4" class="block text-sm font-medium text-gray-700">Judul 4 <span
                                class="text-red-500">*</span></label>
                        <input type="text" id="title4" name="title4" value="{{ old('title4') }}"
                            class="mt-1 block w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-emerald-500 @error('title4') border-red-500 @enderror"
                            required>
                        @error('title4')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="description4" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                        <textarea name="description4" id="description4" rows="4"
                            class="w-full rounded-lg px-3 py-2 text-sm border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                        @error('description3')
                            <p cla ss="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="image4" class="block text-sm font-medium text-gray-700">Gambar 4</label>
                        <input type="file" id="image4" name="image4"
                            class="mt-1 block w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-400 @error('image4') border-red-500 @enderror"
                            accept="image/*">
                        <p class="text-xs text-gray-500 mt-1">Format: JPEG, PNG, JPG, GIF. Maksimal 2MB</p>
                        @error('image4')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="bg-yellow-50 border border-yellow-200 text-yellow-700 px-4 py-3 rounded-md">
                    <h6 class="font-semibold mb-1"><i class="fas fa-exclamation-triangle"></i> Perhatian:</h6>
                    <p class="mb-0">Setelah mengklik "Selesai", data pengurus akan tersimpan secara lengkap dan Anda akan
                        diarahkan kembali ke halaman daftar pengurus.</p>
                </div>

                <div class="flex justify-between mt-4">
                    <a href="{{ route('pengurus.edit.step2', $pengurus->id) }}"
                        class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300 flex items-center gap-1">
                        <i class="fas fa-arrow-left"></i> Kembali ke Step 2
                    </a>
                    <button type="submit"
                        class="px-4 py-2 bg-emerald-500 hover:bg-emerald-600 text-white rounded-lg flex items-center gap-1">
                        <i class="fas fa-check"></i> Selesai
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
