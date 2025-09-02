@extends('layouts.app', ['title' => 'Edit Lamaran'])

@section('content')
    <div class="max-w-4xl mx-auto bg-white p-8 rounded-2xl shadow-lg space-y-8">
        <!-- Header -->
        <div class="border-b pb-4">
            <h1 class="text-3xl font-bold text-emerald-700">Edit Lamaran Kerja</h1>
            <p class="text-gray-500 text-sm mt-1">Perbarui informasi lamaran kerja sesuai kebutuhan.</p>
        </div>

        <!-- Form -->
        <form method="POST" action="{{ route('applications.update', $application->id) }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Posisi -->
            <div class="relative">
                <label class="block text-sm font-medium text-gray-700 mb-1">Posisi</label>
                <select name="career_id"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 appearance-none pr-10">
                    <option value="">-- Pilih Posisi --</option>
                    @foreach ($careers as $career)
                        <option value="{{ $career->id }}"
                            {{ old('career_id', $application->career_id) == $career->id ? 'selected' : '' }}>
                            {{ $career->position_title }}
                        </option>
                    @endforeach
                </select>

                <!-- Custom Arrow -->
                <div class="absolute inset-y-0 right-3 top-6 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>

                @error('career_id')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Grid Nama, Email, No Telepon -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nama -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                    <input type="text" name="nama" value="{{ old('nama', $application->nama) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                    @error('nama')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email', $application->email) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                    @error('email')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- No Telepon -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">No Telepon</label>
                    <input type="text" name="no_telepon" value="{{ old('no_telepon', $application->no_telepon) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                    @error('no_telepon')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Cover Letter -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Cover Letter</label>
                <textarea name="cover_letter" rows="5"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">{{ old('cover_letter', $application->cover_letter) }}</textarea>
            </div>

            <!-- File Upload -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Upload CV (PDF)</label>
                <input type="file" name="file"
                    class="block w-full px-4 py-2 text-sm text-gray-600 border border-gray-300 rounded-lg cursor-pointer focus:outline-none">

                @if ($application->file)
                    <p class="text-sm text-gray-600 mt-1">
                        File saat ini:
                        <a href="{{ route('applications.downloadFile', $application->id) }}" class="text-emerald-600 hover:underline">
                            Download CV Lama
                        </a>
                    </p>
                @endif

                @error('file')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-end gap-4 pt-4 border-t">
                <a href="{{ route('applications.index') }}"
                    class="px-5 py-2.5 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition">
                    Batal
                </a>
                <button type="submit"
                    class="px-5 py-2.5 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition">
                    Update
                </button>
            </div>
        </form>
    </div>
@endsection
