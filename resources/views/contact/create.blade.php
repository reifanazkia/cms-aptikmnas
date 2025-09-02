@extends('layouts.app', ['title' => 'Tambah Kontak'])

@section('content')
    <div class="max-w-3xl mx-auto">
        <!-- Card -->
        <div class="bg-white rounded-2xl shadow-md p-8 space-y-6">
            <!-- Header -->
            <div class="flex items-center justify-between border-b pb-4">
                <h1 class="text-2xl font-bold text-emerald-700 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Kontak Baru
                </h1>
                <a href="{{ route('contact.index') }}"
                    class="px-4 py-2 text-sm font-medium bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl hover:bg-emerald-100 transition">
                    ← Kembali
                </a>
            </div>

            <!-- Alert Error -->
            @if ($errors->any())
                <div class="p-4 mb-4 text-sm text-red-700 bg-red-50 border border-red-200 rounded-lg">
                    <p class="font-semibold mb-2">Terdapat kesalahan:</p>
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form -->
            <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Email DPP -->
                    <div>
                        <label for="email_dpp" class="block text-sm font-medium text-gray-700 mb-1">Email DPP *</label>
                        <input type="email" name="email_dpp" id="email_dpp" value="{{ old('email_dpp') }}"
                            class="w-full rounded-lg px-3 py-2 text-sm border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 @error('email_dpp') border-red-500 @enderror"
                            required>
                        @error('email_dpp')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email DPD -->
                    <div>
                        <label for="email_dpd" class="block text-sm font-medium text-gray-700 mb-1">Email DPD *</label>
                        <input type="email" name="email_dpd" id="email_dpd" value="{{ old('email_dpd') }}"
                            class="w-full rounded-lg px-3 py-2 text-sm border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 @error('email_dpd') border-red-500 @enderror"
                            required>
                        @error('email_dpd')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Alamat -->
                    <div class="md:col-span-2">
                        <label for="alamat" class="block text-sm font-medium text-gray-700 mb-1">Alamat *</label>
                        <textarea name="alamat" id="alamat" rows="3"
                            class="w-full rounded-lg px-3 py-2 text-sm border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 @error('alamat') border-red-500 @enderror"
                            required>{{ old('alamat') }}</textarea>
                        @error('alamat')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Nomor Telepon -->
                    <div class="md:col-span-2">
                        <label for="notlp" class="block text-sm font-medium text-gray-700 mb-1">No Telepon *</label>
                        <input type="number" name="notlp" id="notlp" value="{{ old('notlp') }}"
                            class="w-full rounded-lg px-3 py-2 text-sm border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 @error('notlp') border-red-500 @enderror"
                            required>
                        @error('notlp')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <h2 class="text-md font-semibold text-gray-700 col-span-2">Sosial Media</h2>

                    <!-- Instagram -->
                    <div>
                        <label for="url_ig" class="block text-sm font-medium text-gray-700 mb-1">Instagram URL</label>
                        <input type="url" name="url_ig" id="url_ig" value="{{ old('url_ig') }}"
                            placeholder="https://instagram.com/username"
                            class="w-full rounded-lg px-3 py-2 text-sm border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 @error('url_ig') border-red-500 @enderror">
                        @error('url_ig')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Twitter -->
                    <div>
                        <label for="url_twit" class="block text-sm font-medium text-gray-700 mb-1">Twitter URL</label>
                        <input type="url" name="url_twit" id="url_twit" value="{{ old('url_twit') }}"
                            placeholder="https://twitter.com/username"
                            class="w-full rounded-lg px-3 py-2 text-sm border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 @error('url_twit') border-red-500 @enderror">
                        @error('url_twit')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- YouTube -->
                    <div>
                        <label for="url_yt" class="block text-sm font-medium text-gray-700 mb-1">YouTube URL</label>
                        <input type="url" name="url_yt" id="url_yt" value="{{ old('url_yt') }}"
                            placeholder="https://youtube.com/channel/"
                            class="w-full rounded-lg px-3 py-2 text-sm border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 @error('url_yt') border-red-500 @enderror">
                        @error('url_yt')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Facebook -->
                    <div>
                        <label for="url_fb" class="block text-sm font-medium text-gray-700 mb-1">Facebook URL</label>
                        <input type="url" name="url_fb" id="url_fb" value="{{ old('url_fb') }}"
                            placeholder="https://facebook.com/username"
                            class="w-full rounded-lg px-3 py-2 text-sm border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 @error('url_fb') border-red-500 @enderror">
                        @error('url_fb')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- LinkedIn -->
                    <div>
                        <label for="url_in" class="block text-sm font-medium text-gray-700 mb-1">LinkedIn URL</label>
                        <input type="url" name="url_in" id="url_in" value="{{ old('url_in') }}"
                            placeholder="https://linkedin.com/in/username"
                            class="w-full rounded-lg px-3 py-2 text-sm border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 @error('url_in') border-red-500 @enderror">
                        @error('url_in')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- TikTok -->
                    <div>
                        <label for="url_tiktok" class="block text-sm font-medium text-gray-700 mb-1">TikTok URL</label>
                        <input type="url" name="url_tiktok" id="url_tiktok" value="{{ old('url_tiktok') }}"
                            placeholder="https://tiktok.com/@username"
                            class="w-full rounded-lg px-3 py-2 text-sm border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 @error('url_tiktok') border-red-500 @enderror">
                        @error('url_tiktok')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Start Time -->
                    <div>
                        <label for="start_time" class="block text-sm font-medium text-gray-700 mb-1">Start Time *</label>
                        <input type="time" name="start_time" id="start_time" value="{{ old('start_time') }}"
                            class="w-full rounded-lg px-3 py-2 text-sm border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 @error('start_time') border-red-500 @enderror"
                            required>
                        @error('start_time')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- End Time -->
                    <div>
                        <label for="end_time" class="block text-sm font-medium text-gray-700 mb-1">End Time</label>
                        <input type="time" name="end_time" id="end_time" value="{{ old('end_time') }}"
                            class="w-full rounded-lg px-3 py-2 text-sm border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 @error('end_time') border-red-500 @enderror">
                        @error('end_time')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Footer Buttons -->
                <div class="flex items-center justify-between border-t pt-4">
                    <a href="{{ route('contact.index') }}"
                        class="px-4 py-2 text-sm font-medium bg-gray-100 border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-200 transition">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-4 py-2 text-sm font-medium text-white bg-emerald-600 rounded-xl hover:bg-emerald-700 transition">
                        Simpan Kontak
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
