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
    </div>
@endsection
