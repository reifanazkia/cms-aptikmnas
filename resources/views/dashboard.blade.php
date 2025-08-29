@extends('layouts.app', ['title' => 'Dashboard'])

@section('content')
    <div class="max-w-7xl mx-auto">
        <!-- Hero Section -->
        <div class="bg-gradient-to-br from-emerald-50 to-green-50 rounded-2xl shadow-lg p-10 text-center space-y-6 border border-emerald-100">
            <span class="px-4 py-1 bg-emerald-100 text-emerald-700 rounded-full text-sm font-medium shadow">
                🚀 Launching Soon
            </span>

            <h1 class="text-3xl md:text-5xl font-bold text-emerald-800 leading-tight">
                Elevate Your Workflow with <span class="text-emerald-600">APTIKNAS</span>
            </h1>

            <p class="text-emerald-600 max-w-2xl mx-auto text-sm md:text-base">
                Platform terpadu untuk membantu tim berkolaborasi, mengelola kegiatan, dan mencapai hasil terbaik.
                Sederhanakan proses Anda dan fokus pada hal yang paling penting.
            </p>

            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('kegiatan.index') }}"
                   class="inline-flex items-center px-6 py-3 rounded-xl bg-emerald-600 text-white font-medium hover:bg-emerald-700 transition">
                    Mulai Sekarang →
                </a>
                <a href="{{ route('category-kegiatan.index') }}"
                   class="inline-flex items-center px-6 py-3 rounded-xl border border-emerald-300 text-emerald-700 font-medium hover:bg-emerald-50 transition">
                    Kelola Kategori
                </a>
            </div>
        </div>

        <!-- Quick Links / Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-10">
            <!-- Kategori -->
            <a href="{{ route('category-kegiatan.index') }}"
               class="bg-white border border-emerald-100 rounded-xl p-6 shadow-sm hover:shadow-md transition flex flex-col items-center text-center">
                <div class="w-12 h-12 flex items-center justify-center rounded-full bg-emerald-100 mb-3">
                    <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path d="M3 10h18M9 21V3m6 18V3" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <h3 class="font-bold text-emerald-700">Kategori</h3>
                <p class="text-sm text-emerald-500">Kelola kategori konten</p>
            </a>

            <!-- Konten -->
            <a href="{{ route('kegiatan.index') }}"
               class="bg-white border border-emerald-100 rounded-xl p-6 shadow-sm hover:shadow-md transition flex flex-col items-center text-center">
                <div class="w-12 h-12 flex items-center justify-center rounded-full bg-emerald-100 mb-3">
                    <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path d="M12 8v8m-4-4h8" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <h3 class="font-bold text-emerald-700">Tambah Konten</h3>
                <p class="text-sm text-emerald-500">Upload kegiatan / produk</p>
            </a>

            <!-- Profil -->
            <a href="#"
               class="bg-white border border-emerald-100 rounded-xl p-6 shadow-sm hover:shadow-md transition flex flex-col items-center text-center">
                <div class="w-12 h-12 flex items-center justify-center rounded-full bg-emerald-100 mb-3">
                    <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path d="M16 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2m12 0h4m-10-8a4 4 0 100-8 4 4 0 000 8z"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <h3 class="font-bold text-emerald-700">Akun Saya</h3>
                <p class="text-sm text-emerald-500">Kelola profil pengguna</p>
            </a>
        </div>
    </div>
@endsection
