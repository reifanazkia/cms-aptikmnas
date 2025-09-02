@extends('layouts.app', ['title' => 'Detail Career'])

@section('content')
<div class="space-y-8">
    <!-- Header Detail -->
    <div class="bg-white/90 backdrop-blur-md rounded-2xl shadow-lg p-6 flex items-center justify-between border border-emerald-100">
        <div class="flex items-center space-x-4">
            <div class="p-4 bg-emerald-50 rounded-xl shadow-sm">
                <i class="fas fa-briefcase text-emerald-600 text-2xl"></i>
            </div>
            <div>
                <h1 class="text-2xl font-bold text-gray-800">{{ $career->position_title }}</h1>
                <p class="text-gray-500 text-sm">
                    Dibuat: {{ $career->created_at->format('d F Y H:i') }}
                </p>
            </div>
        </div>
        <a href="{{ route('career.index') }}"
           class="inline-flex items-center space-x-2 px-5 py-2.5 rounded-xl bg-emerald-50 hover:bg-emerald-100 text-emerald-700 font-medium transition-colors">
            <i class="fas fa-arrow-left"></i>
            <span>Kembali</span>
        </a>
    </div>

    <div class="grid lg:grid-cols-3 gap-8">
        <!-- Konten Utama -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Ringkasan -->
            <div class="bg-white rounded-2xl shadow-md p-6 border border-gray-100">
                <h2 class="text-lg font-semibold text-gray-800 mb-3 flex items-center space-x-2">
                    <i class="fas fa-file-alt text-emerald-500"></i>
                    <span>Ringkasan</span>
                </h2>
                <p class="text-gray-600 leading-relaxed">
                    {{ $career->ringkasan ?? 'Tidak ada ringkasan untuk career ini.' }}
                </p>
            </div>

            <!-- Deskripsi -->
            <div class="bg-white rounded-2xl shadow-md p-6 border border-gray-100">
                <h2 class="text-lg font-semibold text-gray-800 mb-3 flex items-center space-x-2">
                    <i class="fas fa-info-circle text-emerald-500"></i>
                    <span>Deskripsi Pekerjaan</span>
                </h2>
                <ul class="list-disc pl-5 space-y-2 text-gray-600">
                    @if($career->deskripsi && is_array($career->deskripsi))
                        @foreach($career->deskripsi as $deskripsi)
                            <li>{{ $deskripsi }}</li>
                        @endforeach
                    @else
                        <li>Tidak ada deskripsi.</li>
                    @endif
                </ul>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Tombol Aksi -->
            <div class="bg-white rounded-2xl shadow-md p-6 border border-gray-100">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center space-x-2">
                    <i class="fas fa-cogs text-emerald-500"></i>
                    <span>Aksi</span>
                </h3>
                <a href="{{ route('career.edit', $career->id) }}"
                   class="w-full inline-flex items-center justify-center space-x-2 px-5 py-2.5 rounded-xl bg-gradient-to-r from-emerald-500 to-teal-500 text-white font-medium shadow-md hover:shadow-lg hover:scale-[1.02] transition-transform">
                    <i class="fas fa-edit"></i>
                    <span>Edit</span>
                </a>
            </div>

            <!-- Informasi Career -->
            <div class="bg-white rounded-2xl shadow-md p-6 border border-gray-100">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center space-x-2">
                    <i class="fas fa-info-circle text-emerald-500"></i>
                    <span>Informasi</span>
                </h3>
                <div class="space-y-3 text-sm text-gray-600">
                    <div class="flex justify-between">
                        <span>Lokasi</span>
                        <span class="font-semibold text-gray-800">{{ $career->lokasi ?? '-' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Tipe Pekerjaan</span>
                        <span class="font-semibold text-gray-800">{{ $career->job_type ?? '-' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Pengalaman</span>
                        <span class="font-semibold text-gray-800">{{ $career->pengalaman ?? '-' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Jam Kerja</span>
                        <span class="font-semibold text-gray-800">{{ $career->jam_kerja ?? '-' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Hari Kerja</span>
                        <span class="font-semibold text-gray-800">{{ $career->hari_kerja ?? '-' }}</span>
                    </div>
                    <div>
                        <span class="block mb-1">Klasifikasi</span>
                        <ul class="list-disc pl-5 space-y-1 text-gray-700">
                            @if($career->klasifikasi && is_array($career->klasifikasi))
                                @foreach($career->klasifikasi as $klasifikasi)
                                    <li>{{ $klasifikasi }}</li>
                                @endforeach
                            @else
                                <li>-</li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
