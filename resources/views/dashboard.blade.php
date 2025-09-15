@extends('layouts.app', ['title' => 'Dashboard'])

@section('content')
    <!-- Hero Section -->
    <section class="bg-green-50 rounded-2xl p-10 shadow-sm text-center relative overflow-hidden">
        <!-- Badge -->
        <div
            class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-100 text-emerald-700 text-sm font-medium mb-6">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            Launching Soon
        </div>

        <!-- Heading -->
        <h1 class="text-4xl font-extrabold text-emerald-800 mb-4">
            Elevate Your Workflow with <span class="text-emerald-600">APTIKNAS</span>
        </h1>
        <p class="text-gray-600 max-w-2xl mx-auto mb-8 leading-relaxed">
            Platform terpadu untuk membantu tim berkolaborasi, mengelola kegiatan, dan mencapai hasil terbaik.
            Sederhanakan proses Anda dan fokus pada hal yang paling penting.
        </p>

        <!-- CTA -->
        <div class="flex justify-center gap-4">
            <a href="#"
                class="px-6 py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-medium rounded-xl shadow transition">
                Mulai Sekarang
            </a>
            <a href="#"
                class="px-6 py-3 border border-emerald-300 hover:bg-emerald-50 text-emerald-700 font-medium rounded-xl transition">
                Pelajari Lebih Lanjut
            </a>
        </div>
    </section>

    <!-- Keunggulan Section -->
    <section class="mt-16">
        <h2 class="text-2xl font-bold text-center text-emerald-700 mb-10">Keunggulan APTIKNAS</h2>

        <div class="grid md:grid-cols-3 gap-8 text-center">
            <!-- Fitur 1 -->
            <div class="p-6 bg-white rounded-2xl shadow hover:shadow-md transition">
                <div
                    class="w-12 h-12 mx-auto mb-4 flex items-center justify-center rounded-full bg-emerald-100 text-emerald-600">
                    <!-- Icon Users untuk kolaborasi -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m6 5.87v-2a4 4 0 00-3-3.87m6 0A4 4 0 0012 7a4 4 0 00-3 6.13m6-6.13a4 4 0 013 6.13" />
                    </svg>
                </div>
                <h3 class="text-lg font-semibold mb-2">Kolaborasi Mudah</h3>
                <p class="text-gray-600 text-sm">Kerja sama tim lebih cepat dengan fitur yang memudahkan koordinasi.</p>
            </div>

            <!-- Fitur 2 -->
            <div class="p-6 bg-white rounded-2xl shadow hover:shadow-md transition">
                <div
                    class="w-12 h-12 mx-auto mb-4 flex items-center justify-center rounded-full bg-emerald-100 text-emerald-600">
                    <!-- Icon Clipboard List untuk manajemen -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12h6m-6 4h6m2 4H7a2 2 0 01-2-2V6a2 2 0 012-2h4l2-2h4a2 2 0 012 2v16a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <h3 class="text-lg font-semibold mb-2">Manajemen Efisien</h3>
                <p class="text-gray-600 text-sm">Kelola data & kegiatan dengan lebih terstruktur dan efisien.</p>
            </div>

            <!-- Fitur 3 -->
            <div class="p-6 bg-white rounded-2xl shadow hover:shadow-md transition">
                <div
                    class="w-12 h-12 mx-auto mb-4 flex items-center justify-center rounded-full bg-emerald-100 text-emerald-600">
                    <!-- Icon Target (bullseye) untuk fokus hasil -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 6v6l4 2m6-2a10 10 0 11-20 0 10 10 0 0120 0z" />
                    </svg>
                </div>
                <h3 class="text-lg font-semibold mb-2">Fokus Hasil</h3>
                <p class="text-gray-600 text-sm">Dapatkan hasil terbaik dengan fokus pada hal yang paling penting.</p>
            </div>
        </div>
    </section>
@endsection
