@extends('layouts.app', ['title' => 'Detail Career'])

@section('content')
    <div class="space-y-8">
        <!-- Header Detail -->
        <div
            class="bg-white/90 backdrop-blur-md rounded-2xl shadow-lg p-6 flex items-center justify-between border border-emerald-100">
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

        <!-- Tabs -->
        <div class="border-b border-gray-200">
            <nav class="-mb-px flex space-x-6" aria-label="Tabs">
                <button id="tab-detail" onclick="showTab('detail')"
                    class="tab-btn border-b-2 border-emerald-600 text-emerald-600 px-3 py-2 font-medium text-sm">
                    Detail
                </button>
                <button id="tab-pelamar" onclick="showTab('pelamar')"
                    class="tab-btn border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 px-3 py-2 font-medium text-sm">
                    Pelamar ({{ $career->applications->count() }})
                </button>
            </nav>
        </div>

        <!-- Tab Content -->
        <div id="content-detail" class="tab-content space-y-8">
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
                            @if ($career->deskripsi && is_array($career->deskripsi))
                                @foreach ($career->deskripsi as $deskripsi)
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
                                    @if ($career->klasifikasi && is_array($career->klasifikasi))
                                        @foreach ($career->klasifikasi as $klasifikasi)
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

        <!-- Tab Pelamar -->
        <div id="content-pelamar" class="tab-content hidden">
            <div class="bg-white rounded-2xl shadow-md p-6 border border-gray-100">
                <h2 class="text-lg font-semibold text-gray-800 mb-5 flex items-center space-x-2">
                    <i class="fas fa-users text-emerald-500"></i>
                    <span>Daftar Pelamar ({{ $applicants->count() }})</span>
                </h2>

                @if ($applicants->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full border border-gray-200 rounded-lg overflow-hidden">
                            <thead class="bg-emerald-100 text-emerald-800 uppercase text-xs font-semibold">
                                <tr>
                                    <th class="px-4 py-2 text-center text-sm font-semibold text-gray-700">No</th>
                                    <th class="px-4 py-2 text-center text-sm font-semibold text-gray-700">Nama</th>
                                    <th class="px-4 py-2 text-center text-sm font-semibold text-gray-700">Email</th>
                                    <th class="px-4 py-2 text-center text-sm font-semibold text-gray-700">Posisi</th>
                                    <th class="px-4 py-2 text-center text-sm font-semibold text-gray-700">Tanggal</th>
                                    <th class="px-4 py-2 text-center text-sm font-semibold text-gray-700">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach ($applicants as $index => $app)
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="px-4 py-2 text-center text-sm text-gray-600">{{ $index + 1 }}</td>
                                        <td class="px-4 py-2 text-center text-sm font-medium text-gray-800">
                                            {{ $app->nama }}</td>
                                        <td class="px-4 py-2 text-center text-sm text-gray-600">{{ $app->email }}</td>
                                        <td class="px-4 py-2 text-center text-sm text-gray-600">
                                            {{ $app->career->position_title ?? '-' }}
                                        </td>
                                        <td class="px-4 py-2 text-center text-sm text-gray-600">
                                            {{ $app->created_at->format('d M Y') }}
                                        </td>
                                        <td class="px-4 py-2 text-center">
                                            @if ($app->cv)
                                                <a href="{{ asset('storage/' . $app->cv) }}" target="_blank"
                                                    class="px-3 py-1 text-xs font-medium rounded-lg bg-emerald-500 text-white hover:bg-emerald-600 transition">
                                                    Download CV
                                                </a>
                                            @else
                                                <span class="text-xs text-gray-400">CV tidak ada</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-gray-500 text-center py-6">Belum ada pelamar.</p>
                @endif
            </div>
        </div>
    </div>

    <script>
        function showTab(tab) {
            // sembunyikan semua tab content
            document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));
            document.querySelectorAll('.tab-btn').forEach(el => {
                el.classList.remove('border-emerald-600', 'text-emerald-600');
                el.classList.add('border-transparent', 'text-gray-500');
            });

            // tampilkan tab yang dipilih
            document.getElementById('content-' + tab).classList.remove('hidden');
            document.getElementById('tab-' + tab).classList.add('border-emerald-600', 'text-emerald-600');
            document.getElementById('tab-' + tab).classList.remove('border-transparent', 'text-gray-500');
        }
    </script>
@endsection
