@extends('layouts.app', ['title' => 'Edit Agenda'])

@section('content')
    <div class="max-w-4xl mx-auto bg-white p-8 rounded-2xl shadow-lg space-y-8">
        <!-- Header -->
        <div class="border-b pb-4">
            <h1 class="text-3xl font-bold text-emerald-700">Edit Agenda</h1>
            <p class="text-gray-500 text-sm mt-1">Perbarui detail agenda sesuai kebutuhan.</p>
        </div>

        <form action="{{ route('agenda.update', $agenda->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Judul & Tipe -->
            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Judul</label>
                    <input type="text" name="title" value="{{ old('title', $agenda->title) }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                    @error('title')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Tipe Agenda</label>
                    <input type="text" name="type" value="{{ old('type', $agenda->type) }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                </div>
            </div>

            <!-- Deskripsi -->
            <div class="md:col-span-2">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                <textarea name="description" id="description" rows="4"
                    class="w-full rounded-lg px-3 py-2 text-sm border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 @error('description') border-red-500 @enderror">{{ old('description', $agenda->description) }}</textarea>
                @error('description')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>


            <!-- Waktu -->
            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Mulai</label>
                    <input type="datetime-local" name="start_datetime"
                        value="{{ old('start_datetime', \Carbon\Carbon::parse($agenda->start_datetime)->format('Y-m-d\TH:i')) }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Selesai</label>
                    <input type="datetime-local" name="end_datetime"
                        value="{{ old('end_datetime', $agenda->end_datetime ? \Carbon\Carbon::parse($agenda->end_datetime)->format('Y-m-d\TH:i') : '') }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                </div>
            </div>

            <!-- Lokasi & Penyelenggara -->
            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Lokasi</label>
                    <input type="text" name="location" value="{{ old('location', $agenda->location) }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Penyelenggara</label>
                    <input type="text" name="event_organizer"
                        value="{{ old('event_organizer', $agenda->event_organizer) }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                </div>
            </div>

            <!-- Youtube -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">YouTube Link</label>
                <input type="url" name="youtube_link" value="{{ old('youtube_link', $agenda->youtube_link) }}"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
            </div>

            <!-- Gambar -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Gambar</label>
                @if ($agenda->image)
                    <div class="mb-3">
                        <img src="{{ asset('agenda/' . $agenda->image) }}" alt="Agenda Image"
                            class="h-32 rounded-lg border">
                    </div>
                @endif
                <input type="file" name="image" accept="image/*"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 cursor-pointer bg-gray-50 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, WEBP. Max 2MB.</p>
            </div>

            <!-- Tombol -->
            <div class="flex justify-end gap-4 pt-4 border-t">
                <a href="{{ route('agenda.index') }}"
                    class="px-5 py-2 rounded-lg bg-gray-100 text-gray-700 hover:bg-gray-200">Batal</a>
                <button type="submit"
                    class="px-5 py-2 rounded-lg bg-emerald-600 text-white font-semibold shadow hover:bg-emerald-700">
                    Update
                </button>
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
