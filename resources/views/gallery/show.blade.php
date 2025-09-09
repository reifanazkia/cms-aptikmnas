@extends('layouts.app', ['title' => 'Detail Gallery'])

@section('content')
    <div class="space-y-6">
        <!-- Header -->
        <div class="bg-white rounded-xl shadow p-6 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-emerald-700">{{ $gallery->title }}</h1>
                <p class="text-gray-500 text-sm">
                    Dibuat: {{ $gallery->created_at->format('d F Y H:i') }}
                </p>
            </div>
            <a href="{{ route('gallery.index') }}" class="px-4 py-2 bg-gray-100 text-gray-600 rounded-lg hover:bg-gray-200">
                Kembali
            </a>
        </div>

        <div class="grid md:grid-cols-3 gap-6">
            <!-- Kolom Kiri (Konten Utama - Gambar) -->
            <div class="md:col-span-2 space-y-6">
                <!-- Gambar -->
                <div class="bg-white rounded-xl shadow p-4">
                    @if ($gallery->image)
                        <img src="{{ Storage::url($gallery->image) }}" alt="{{ $gallery->title }}"
                            class="rounded-lg w-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center bg-gray-100 text-gray-400 rounded-lg">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16l4.586-4.586a2 2 0
                                       012.828 0L16 16m-2-2
                                       l1.586-1.586a2 2 0
                                       012.828 0L20 14
                                       m-6-6h.01M6 20h12a2
                                       2 0 002-2V6a2 2 0
                                       00-2-2H6a2 2 0
                                       00-2 2v12a2 2 0
                                       002 2z" />
                            </svg>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Kolom Kanan (Sidebar Info) -->
            <div class="space-y-6">
                <!-- Aksi -->
                <div class="bg-white rounded-xl shadow p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Aksi</h3>
                    <a href="{{ route('gallery.edit', $gallery) }}"
                        class="w-full inline-block px-4 py-2 bg-emerald-600 text-white text-center rounded-lg hover:bg-emerald-700">
                        Edit
                    </a>
                </div>

                <!-- Informasi -->
                <div class="bg-white rounded-xl shadow p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Informasi</h3>
                    <dl class="space-y-2 text-sm">
                        <div class="flex justify-between">
                            <dt class="text-gray-600">Kategori</dt>
                            <dd class="font-medium text-emerald-700">
                                {{ $gallery->category->name ?? '-' }}
                            </dd>
                        </div>
                        <div class="flex justify-between">
                            <dt class="text-gray-600">Tanggal Publikasi</dt>
                            <dd class="font-medium text-gray-800">
                                {{ $gallery->pub_date ? \Carbon\Carbon::parse($gallery->pub_date)->format('d M Y') : '-' }}
                            </dd>
                        </div>
                        <div class="flex justify-between">
                            <dt class="text-gray-600">Dibuat Oleh</dt>
                            <dd class="font-medium text-gray-800">
                                {{ $gallery->user->name ?? '-' }}
                            </dd>
                        </div>
                        <div class="flex justify-between">
                            <dt class="text-gray-600">ID</dt>
                            <dd class="font-medium text-gray-800">#{{ $gallery->id }}</dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>

        <!-- Deskripsi (Full Width di Bawah Grid) -->
        <div class="bg-white rounded-xl shadow p-6">
            <h2 class="text-lg font-semibold text-emerald-700 mb-2">Deskripsi</h2>
            <div class="prose max-w-none text-gray-700">
                {!! $gallery->description ?? '<p>-</p>' !!}
            </div>
        </div>
    </div>
@endsection
