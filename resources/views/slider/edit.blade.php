@extends('layouts.app', ['title' => 'Edit Slider'])

@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white shadow rounded-lg">
    <h1 class="text-2xl font-bold text-emerald-700 mb-6">Edit Slider</h1>

    <form action="{{ route('slider.update', $slider->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf @method('PUT')

        <!-- Judul -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Judul</label>
            <input type="text" name="title" value="{{ old('title', $slider->title) }}"
                   class="w-full rounded-lg border py-2 px-2 border-gray-300 focus:ring-emerald-500 focus:border-emerald-500">
        </div>

        <!-- Subjudul -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Subjudul</label>
            <textarea name="subtitle" rows="3"
                      class="w-full rounded-lg border py-2 px-2 border-gray-300 focus:ring-emerald-500 focus:border-emerald-500">{{ old('subtitle', $slider->subtitle) }}</textarea>
        </div>

        <!-- Upload Gambar -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Gambar</label>
            @if($slider->image)
                <img src="{{ asset('storage/'.$slider->image) }}" alt="slider" class="h-24 mb-2 rounded">
            @endif
            <input type="file" name="image"
                   class="w-full rounded-lg border py-2 px-2 border-gray-300 focus:ring-emerald-500 focus:border-emerald-500">
        </div>

        <!-- Youtube ID -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Youtube ID</label>
            <input type="text" name="youtube_id" value="{{ old('youtube_id', $slider->youtube_id) }}"
                   class="w-full rounded-lg border py-2 px-2 border-gray-300 focus:ring-emerald-500 focus:border-emerald-500">
        </div>

        <!-- Button Text -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Teks Tombol</label>
            <input type="text" name="button_text" value="{{ old('button_text', $slider->button_text) }}"
                   class="w-full rounded-lg border py-2 px-2 border-gray-300 focus:ring-emerald-500 focus:border-emerald-500">
        </div>

        <!-- URL -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">URL Link</label>
            <input type="url" name="url_link" value="{{ old('url_link', $slider->url_link) }}"
                   class="w-full rounded-lg border py-2 px-2 border-gray-300 focus:ring-emerald-500 focus:border-emerald-500">
        </div>

        <!-- Checkbox -->
        <div class="flex items-center">
            <input type="checkbox" name="display_on_home" value="1" {{ old('display_on_home', $slider->display_on_home) ? 'checked' : '' }}
                   class="h-4 w-4 text-emerald-600 border py-2 px-2 border-gray-300 rounded">
            <label class="ml-2 text-sm text-gray-700 mb-1">Tampilkan di Home</label>
        </div>

        <!-- Submit -->
        <div class="flex justify-end">
            <a href="{{ route('slider.index') }}" class="px-2 py-2 rounded-lg bg-gray-300 text-gray-700 mr-2">Batal</a>
            <button type="submit"
                    class="px-4 py-2 rounded-lg bg-emerald-600 text-white font-semibold hover:bg-emerald-700">
                Update
            </button>
        </div>
    </form>
</div>
@endsection
