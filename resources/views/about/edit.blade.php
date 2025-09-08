@extends('layouts.app', ['title' => 'Edit About'])

@section('content')
    <div class="max-w-3xl mx-auto bg-white p-6 rounded-xl shadow space-y-6">
        <h1 class="text-2xl font-bold text-emerald-700">Edit About</h1>

        <form method="POST" action="{{ route('about.update', $about->id) }}" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')

            <!-- Judul -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Judul</label>
                <input type="text" name="title" value="{{ old('title', $about->title) }}"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-emerald-500 focus:border-emerald-500">
                @error('title')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Deskripsi -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                <textarea name="description" id="description" rows="4"
                    class="w-full rounded-lg px-3 py-2 text-sm border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 @error('description') border-red-500 @enderror">{{ old('description', $about->description) }}</textarea>
                @error('description')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Gambar 1 -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Gambar 1</label>
                <input type="file" name="image" class="w-full border border-gray-300 rounded-lg px-3 py-2">
                @if ($about->image)
                    <img src="{{ asset('storage/' . $about->image) }}" class="w-32 mt-2 rounded">
                @endif
                @error('image')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Gambar 2 -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Gambar 2</label>
                <input type="file" name="image2" class="w-full border border-gray-300 rounded-lg px-3 py-2">
                @if ($about->image2)
                    <img src="{{ asset('storage/' . $about->image2) }}" class="w-32 mt-2 rounded">
                @endif
                @error('image2')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tombol -->
            <div class="flex justify-end space-x-2">
                <a href="{{ route('about.index') }}" class="px-4 py-2 rounded bg-gray-300 hover:bg-gray-400">Batal</a>
                <button type="submit"
                    class="px-4 py-2 rounded bg-emerald-600 text-white hover:bg-emerald-700">Update</button>
            </div>
        </form>
    </div>

    <script>
        // CKEditor
        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
