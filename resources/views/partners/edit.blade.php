@extends('layouts.app', ['title' => 'Edit Partner'])

@section('content')
    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-2xl shadow-lg floating-card p-6 space-y-6">
            <!-- Header -->
            <div class="flex items-center justify-between mb-4">
                <h1 class="text-2xl font-bold text-emerald-700">Edit Partner</h1>
                <a href="{{ route('partners.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                    Kembali
                </a>
            </div>

            <!-- Error Messages -->
            @if ($errors->any())
                <div class="p-4 mb-4 text-red-700 bg-red-100 rounded-lg">
                    <ul class="list-disc pl-5 mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form -->
            <form action="{{ route('partners.update', $partner->id) }}" method="POST" enctype="multipart/form-data"
                class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="block mb-1 font-medium">Nama Partner <span class="text-red-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name', $partner->name) }}"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-emerald-500 focus:border-emerald-500 @error('name') border-red-500 @enderror"
                        required>
                </div>

                <div>
                    <label class="block mb-1 font-medium">Alamat Website</label>
                    <input type="url" name="web_address" value="{{ old('web_address', $partner->web_address) }}"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-emerald-500 focus:border-emerald-500 @error('web_address') border-red-500 @enderror">
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                    <textarea name="description" id="description" rows="4"
                        class="w-full rounded-lg px-3 py-2 text-sm border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 @error('description') border-red-500 @enderror">{{ old('description', $partner->description) }}</textarea>
                    @error('description')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block mb-1 font-medium">Detail</label>
                    <textarea name="details" rows="4"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-emerald-500 focus:border-emerald-500">{{ old('details', $partner->details) }}</textarea>
                </div>

                <div>
                    <label class="block mb-1 font-medium">Gambar</label>
                    @if ($partner->image)
                        <img src="{{ asset('storage/' . $partner->image) }}" alt="Partner Image"
                            class="w-28 h-auto mb-2 rounded-lg shadow">
                    @endif
                    <input type="file" name="image"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 @error('image') border-red-500 @enderror">
                    <small class="text-gray-500 block text-xs mt-1">Format: JPEG, PNG, JPG, GIF. Maksimal 2MB.</small>
                </div>

                <div class="flex justify-end gap-3 mt-4">
                    <button type="submit"
                        class="px-4 py-2 bg-emerald-500 text-white rounded-lg hover:bg-emerald-600 transition">
                        Update
                    </button>
                    <a href="{{ route('partners.index') }}"
                        class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
