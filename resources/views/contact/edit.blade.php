@extends('layouts.app', ['title' => 'Edit Contact'])

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-2xl shadow-md p-8 space-y-6">
        <!-- Header -->
        <div class="flex items-center justify-between border-b pb-4">
            <h1 class="text-2xl font-bold text-emerald-700">Edit Contact</h1>
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
        <form action="{{ route('contact.update', $contact->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Email DPP -->
                <div>
                    <label for="email_dpp" class="block text-sm font-medium text-gray-700 mb-1">Email DPP <span class="text-red-500">*</span></label>
                    <input type="email" name="email_dpp" id="email_dpp"
                        value="{{ old('email_dpp', $contact->email_dpp) }}"
                        required
                        class="w-full rounded-lg px-3 py-2 text-sm border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500">
                </div>

                <!-- Email DPD -->
                <div>
                    <label for="email_dpd" class="block text-sm font-medium text-gray-700 mb-1">Email DPD <span class="text-red-500">*</span></label>
                    <input type="email" name="email_dpd" id="email_dpd"
                        value="{{ old('email_dpd', $contact->email_dpd) }}"
                        required
                        class="w-full rounded-lg px-3 py-2 text-sm border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500">
                </div>
            </div>

            <!-- Alamat -->
            <div>
                <label for="alamat" class="block text-sm font-medium text-gray-700 mb-1">Alamat <span class="text-red-500">*</span></label>
                <textarea name="alamat" id="alamat" rows="3" required
                    class="w-full rounded-lg px-3 py-2 text-sm border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500">{{ old('alamat', $contact->alamat) }}</textarea>
            </div>

            <!-- No Telepon -->
            <div>
                <label for="notlp" class="block text-sm font-medium text-gray-700 mb-1">No Telepon <span class="text-red-500">*</span></label>
                <input type="number" name="notlp" id="notlp"
                    value="{{ old('notlp', $contact->notlp) }}"
                    required
                    class="w-full rounded-lg px-3 py-2 text-sm border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500">
            </div>

            <!-- Social Media -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Instagram -->
                <div>
                    <label for="url_ig" class="block text-sm font-medium text-gray-700 mb-1">Instagram URL</label>
                    <input type="url" name="url_ig" id="url_ig"
                        value="{{ old('url_ig', $contact->url_ig) }}"
                        placeholder="https://instagram.com/username"
                        class="w-full rounded-lg px-3 py-2 text-sm border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500">
                </div>

                <!-- Twitter -->
                <div>
                    <label for="url_twit" class="block text-sm font-medium text-gray-700 mb-1">Twitter URL</label>
                    <input type="url" name="url_twit" id="url_twit"
                        value="{{ old('url_twit', $contact->url_twit) }}"
                        placeholder="https://twitter.com/username"
                        class="w-full rounded-lg px-3 py-2 text-sm border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- YouTube -->
                <div>
                    <label for="url_yt" class="block text-sm font-medium text-gray-700 mb-1">YouTube URL</label>
                    <input type="url" name="url_yt" id="url_yt"
                        value="{{ old('url_yt', $contact->url_yt) }}"
                        placeholder="https://youtube.com/channel/"
                        class="w-full rounded-lg px-3 py-2 text-sm border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500">
                </div>

                <!-- Facebook -->
                <div>
                    <label for="url_fb" class="block text-sm font-medium text-gray-700 mb-1">Facebook URL</label>
                    <input type="url" name="url_fb" id="url_fb"
                        value="{{ old('url_fb', $contact->url_fb) }}"
                        placeholder="https://facebook.com/username"
                        class="w-full rounded-lg px-3 py-2 text-sm border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500">
                </div>
            </div>

            <!-- LinkedIn -->
            <div>
                <label for="url_linkedin" class="block text-sm font-medium text-gray-700 mb-1">LinkedIn URL</label>
                <input type="url" name="url_linkedin" id="url_linkedin"
                    value="{{ old('url_linkedin', $contact->url_linkedin) }}"
                    placeholder="https://linkedin.com/in/username"
                    class="w-full rounded-lg px-3 py-2 text-sm border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500">
            </div>

             <!-- Start & End Time -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="start_time" class="block text-sm font-medium text-gray-700 mb-1">Start Time</label>
                    <input type="time" name="start_time" id="start_time"
                        value="{{ old('start_time', $contact->start_time) }}"
                        class="w-full rounded-lg px-3 py-2 text-sm border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500">
                </div>

                <div>
                    <label for="end_time" class="block text-sm font-medium text-gray-700 mb-1">End Time</label>
                    <input type="time" name="end_time" id="end_time"
                        value="{{ old('end_time', $contact->end_time) }}"
                        class="w-full rounded-lg px-3 py-2 text-sm border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500">
                </div>
            </div>

            <!-- Footer -->
            <div class="flex items-center justify-end border-t pt-4">
                <button type="submit"
                    class="px-4 py-2 text-sm font-medium text-white bg-emerald-600 rounded-xl hover:bg-emerald-700 transition">
                    Update Contact
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
