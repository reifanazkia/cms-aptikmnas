@extends('layouts.app', ['title' => 'Edit Testimony'])

@section('content')
    <div class="max-w-3xl mx-auto p-6 bg-white shadow rounded-lg">
        <h1 class="text-2xl font-bold text-emerald-700 mb-6">Edit Testimony</h1>

        <form action="{{ route('testimonies.update', $testimony->id) }}" method="POST" enctype="multipart/form-data"
            class="space-y-4">
            @csrf @method('PUT')

            <!-- Checkbox tampil di home -->
            <div class="flex items-center">
                <input type="checkbox" name="display_homepage" value="1"
                    {{ $testimony->display_homepage ? 'checked' : '' }}
                    class="h-4 w-4 text-emerald-600 border-gray-300 rounded">
                <label class="ml-2 text-sm text-gray-700">Tampilkan di Homepage</label>
            </div>

            <!-- Kategori -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Kategori</label>
                <div class="relative">
                    <select name="category_dpd_id"
                        class="w-full border rounded-lg px-3 py-2 appearance-none pr-10 focus:outline-none focus:ring-2 focus:ring-emerald-400">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ $testimony->category_dpd_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>

                    <!-- Custom Arrow -->
                    <svg class="w-5 h-5 text-gray-500 absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>
            </div>


            <!-- Nama -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Nama</label>
                <input type="text" name="name" value="{{ $testimony->name }}"
                    class="w-full border rounded-lg px-3 py-2">
            </div>

            <!-- Judul -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Judul</label>
                <input type="text" name="title" value="{{ $testimony->title }}"
                    class="w-full border rounded-lg px-3 py-2">
            </div>

            <!-- Deskripsi -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Deskripsi</label>
                <textarea name="description" rows="4" class="w-full border rounded-lg px-3 py-2">{{ $testimony->description }}</textarea>
            </div>

            <!-- Upload Gambar -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Gambar</label>
                @if ($testimony->image)
                    <img src="{{ asset($testimony->image) }}" alt="preview" class="h-24 mb-2 rounded">
                @endif
                <input type="file" name="image" class="w-full border rounded-lg px-3 py-2">
            </div>

            <!-- Action -->
            <div class="flex justify-end">
                <a href="{{ route('testimonies.index') }}" class="px-4 py-2 bg-gray-300 rounded-lg mr-2">Batal</a>
                <button type="submit" class="px-4 py-2 bg-emerald-600 text-white rounded-lg">Update</button>
            </div>
        </form>
    </div>
@endsection
