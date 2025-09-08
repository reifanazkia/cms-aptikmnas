@extends('layouts.app', ['title' => 'Detail Podcast'])

@section('content')
    <div class="max-w-7xl mx-auto space-y-8">

        <!-- Header -->
        <div
            class="bg-gradient-to-r from-emerald-500 to-green-600 rounded-2xl shadow p-6 flex items-center justify-between text-white">
            <div>
                <h1 class="text-2xl font-bold">{{ $podcast->title }}</h1>
                <p class="text-sm opacity-80 mt-1">Dibuat: {{ $podcast->created_at->format('d F Y H:i') }}</p>
            </div>
            <a href="{{ route('podcasts.index') }}"
                class="px-5 py-2 rounded-lg bg-white/20 font-semibold hover:bg-white/30 transition">
                <!-- SVG Panah Kembali -->
                <svg xmlns="http://www.w3.org/2000/svg" class="inline w-5 h-5 mr-1" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali
            </a>
        </div>

        <!-- Konten Utama -->
        <div class="grid md:grid-cols-3 gap-8">
            <!-- Bagian Kiri -->
            <div class="md:col-span-2 space-y-6">
                <!-- Embed YouTube -->
                <div class="bg-white rounded-2xl shadow overflow-hidden hover:shadow-lg transition">
                    <iframe class="w-full h-96 rounded-2xl" src="https://www.youtube.com/embed/{{ $podcast->yt_id }}"
                        frameborder="0" allowfullscreen>
                    </iframe>
                </div>
            </div>

            <!-- Bagian Kanan -->
            <div class="space-y-6">
                <!-- Aksi -->
                <div class="bg-gradient-to-br from-emerald-500 to-green-600 text-white rounded-2xl shadow p-6">
                    <h2 class="text-lg font-semibold mb-4">Aksi</h2>
                    <a href="{{ route('podcasts.edit', $podcast->id) }}"
                        class="w-full inline-block text-center px-4 py-2 bg-white text-emerald-700 font-semibold rounded-lg hover:bg-gray-100 transition">
                        <!-- SVG Edit -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="inline w-5 h-5 mr-1" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 4h2m-1 1v14m-7 3h14a2 2 0 002-2V7l-5-5H6a2 2 0 00-2 2v14a2 2 0 002 2z" />
                        </svg>
                        Edit Podcast
                    </a>
                </div>

                <!-- Informasi -->
                <div class="bg-white hover:shadow-emerald-200 rounded-2xl shadow p-6 hover:shadow-lg transition">
                    <h2 class="text-lg font-semibold text-gray-700 mb-4 flex items-center gap-2">
                        <!-- SVG Info -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-emerald-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12c0 4.97-4.03 9-9 9s-9-4.03-9-9 4.03-9 9-9 9 4.03 9 9z" />
                        </svg>
                        Informasi
                    </h2>
                    <ul class="space-y-3 text-sm text-gray-700">
                        <li class="flex justify-between"><span>Kategori:</span> <span
                                class="font-medium text-emerald-600">{{ $podcast->category->name ?? '-' }}</span></li>
                        <li class="flex justify-between"><span>Pembicara:</span> <span
                                class="font-medium">{{ is_array($podcast->pembicara) ? implode(', ', $podcast->pembicara) : $podcast->pembicara }}</span>
                        </li>
                        <li class="flex justify-between"><span>Tanggal Publikasi:</span> <span
                                class="font-medium">{{ $podcast->pub_date ? \Carbon\Carbon::parse($podcast->pub_date)->format('d F Y') : '-' }}</span>
                        </li>
                        <li class="flex justify-between"><span>Uploader:</span> <span
                                class="font-medium">{{ $podcast->user->name ?? 'Admin' }}</span></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Deskripsi -->
        <div class="bg-white hover:shadow-emerald-200 rounded-2xl shadow p-6 hover:shadow-lg transition">
            <h2 class="text-lg font-semibold text-emerald-700 mb-3 flex items-center gap-2">
                <!-- SVG Dokumen -->
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-emerald-600" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 21H5a2 2 0 01-2-2V7a2 2 0 012-2h4l2-3h2l2 3h4a2 2 0 012 2v12a2 2 0 01-2 2z" />
                </svg>
                Deskripsi Podcast
            </h2>
            <div class="prose max-w-none">
                {!! $podcast->description !!}
            </div>
        </div>
    </div>
@endsection
