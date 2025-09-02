@extends('layouts.app', ['title' => 'Data Pengurus'])

@section('content')
    <div class="max-w-7xl mx-auto">
        <!-- Card Container -->
        <div class="bg-white rounded-2xl shadow-lg floating-card p-6 space-y-6">
            <!-- Header -->
            <div class="flex items-center justify-between border-b border-emerald-100 pb-4">
                <h1 class="text-2xl font-bold text-emerald-700 flex items-center gap-2">
                    <svg class="w-7 h-7" xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 36 36">
                        <path fill="currentColor"
                            d="M14.68 14.81a6.76 6.76 0 1 1 6.76-6.75a6.77 6.77 0 0 1-6.76 6.75m0-11.51a4.76 4.76 0 1 0 4.76 4.76a4.76 4.76 0 0 0-4.76-4.76"
                            class="clr-i-outline clr-i-outline-path-1" />
                        <path fill="currentColor"
                            d="M16.42 31.68A2.14 2.14 0 0 1 15.8 30H4v-5.78a14.8 14.8 0 0 1 11.09-4.68h.72a2.2 2.2 0 0 1 .62-1.85l.12-.11c-.47 0-1-.06-1.46-.06A16.47 16.47 0 0 0 2.2 23.26a1 1 0 0 0-.2.6V30a2 2 0 0 0 2 2h12.7Z"
                            class="clr-i-outline clr-i-outline-path-2" />
                        <path fill="currentColor" d="M26.87 16.29a.4.4 0 0 1 .15 0a.4.4 0 0 0-.15 0"
                            class="clr-i-outline clr-i-outline-path-3" />
                        <path fill="currentColor"
                            d="m33.68 23.32l-2-.61a7.2 7.2 0 0 0-.58-1.41l1-1.86A.38.38 0 0 0 32 19l-1.45-1.45a.36.36 0 0 0-.44-.07l-1.84 1a7 7 0 0 0-1.43-.61l-.61-2a.36.36 0 0 0-.36-.24h-2.05a.36.36 0 0 0-.35.26l-.61 2a7 7 0 0 0-1.44.6l-1.82-1a.35.35 0 0 0-.43.07L17.69 19a.38.38 0 0 0-.06.44l1 1.82a6.8 6.8 0 0 0-.63 1.43l-2 .6a.36.36 0 0 0-.26.35v2.05A.35.35 0 0 0 16 26l2 .61a7 7 0 0 0 .6 1.41l-1 1.91a.36.36 0 0 0 .06.43l1.45 1.45a.38.38 0 0 0 .44.07l1.87-1a7 7 0 0 0 1.4.57l.6 2a.38.38 0 0 0 .35.26h2.05a.37.37 0 0 0 .35-.26l.61-2.05a7 7 0 0 0 1.38-.57l1.89 1a.36.36 0 0 0 .43-.07L32 30.4a.35.35 0 0 0 0-.4l-1-1.88a7 7 0 0 0 .58-1.39l2-.61a.36.36 0 0 0 .26-.35v-2.1a.36.36 0 0 0-.16-.35M24.85 28a3.34 3.34 0 1 1 3.33-3.33A3.34 3.34 0 0 1 24.85 28"
                            class="clr-i-outline clr-i-outline-path-4" />
                        <path fill="none" d="M0 0h36v36H0z" />
                    </svg>
                    Data Pengurus
                </h1>
                <a href="{{ route('pengurus.create') }}"
                    class="inline-flex items-center px-4 py-2 bg-emerald-600 text-white rounded-xl hover:bg-emerald-700 transition-all duration-200 shadow-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Pengurus
                </a>
            </div>

            <!-- Notifikasi -->
            @if (session('success'))
                <div class="p-4 rounded-lg bg-green-50 border border-green-200 text-green-700 text-sm font-medium">
                    {{ session('success') }}
                </div>
            @endif

            @if ($pengurus->count() > 0)
                <!-- Table -->
                <div class="overflow-x-auto rounded-lg border border-emerald-100">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-emerald-100 text-emerald-700">
                            <tr>
                                <th class="px-4 py-2">No</th>
                                <th class="px-4 py-2">Foto</th>
                                <th class="px-4 py-2">Nama</th>
                                <th class="px-4 py-2">Email</th>
                                <th class="px-4 py-2">Telepon</th>
                                <th class="px-4 py-2">Daftar Pengurus DPD</th>
                                <th class="px-4 py-2">Kategori Pengurus</th>
                                <th class="px-4 py-2 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-emerald-100">
                            @foreach ($pengurus as $index => $item)
                                <tr class="hover:bg-gray-50 border-b border-emerald-50">
                                    <td class="px-4 py-2">{{ $pengurus->firstItem() + $index }}</td>
                                    <td class="px-4 py-2">
                                        @if ($item->image)
                                            <img src="{{ asset('storage/' . $item->image) }}" alt="Foto"
                                                class="w-12 h-12 rounded-full object-cover">
                                        @else
                                            <div
                                                class="w-12 h-12 rounded-full bg-emerald-200 flex items-center justify-center text-white">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M5.121 17.804A9.995 9.995 0 0112 15c2.485 0 4.735.912 6.879 2.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                                </svg>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-4 py-2">{{ $item->title }}</td>
                                    <td class="px-4 py-2">{{ $item->email }}</td>
                                    <td class="px-4 py-2">{{ $item->phone }}</td>
                                    <td class="px-4 py-2">
                                        @if ($item->categoryDaftar)
                                            <span
                                                class="px-2 py-1 bg-emerald-100 text-emerald-700 rounded-md text-xs font-semibold">
                                                {{ $item->categoryDaftar->name }}
                                            </span>
                                        @else
                                            <span class="text-gray-400">-</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-2">
                                        @if ($item->categoryPengurus)
                                            <span
                                                class="px-2 py-1 bg-green-100 text-green-700 rounded-md text-xs font-semibold">
                                                {{ $item->categoryPengurus->name }}
                                            </span>
                                        @else
                                            <span class="text-gray-400">-</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-2 text-center">
                                        <div class="flex justify-center gap-2">
                                            <!-- Tombol Edit -->
                                            <a href="{{ route('pengurus.edit', $item->id) }}"
                                                class="px-4 py-2 bg-green-100 text-green-500 rounded-md hover:bg-yellow-200 text-xs font-medium transition inline-flex items-center gap-1.5">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                    viewBox="0 0 24 24" fill="currentColor">
                                                    <path
                                                        d="m7 17.013 4.413-.015 9.632-9.54c.378-.378.586-.88.586-1.414s-.208-1.036-.586-1.414l-1.586-1.586c-.756-.756-2.075-.752-2.825-.003L7 12.583zM18.045 4.458l1.589 1.583-1.597 1.582-1.586-1.585zM9 13.417l6.03-5.973 1.586 1.586-6.029 5.971L9 15.006z" />
                                                    <path
                                                        d="M5 21h14c1.103 0 2-.897 2-2v-8.668l-2 2V19H8.158c-.026 0-.053.01-.079.01-.033 0-.066-.009-.1-.01H5V5h6.847l2-2H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2" />
                                                </svg>
                                                Edit
                                            </a>

                                            <!-- Tombol Hapus -->
                                            <form action="{{ route('pengurus.destroy', $item->id) }}" method="POST"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="px-4 py-2 bg-red-100 text-red-700 rounded-md hover:bg-red-200 text-xs font-medium transition inline-flex items-center gap-1.5">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                        viewBox="-3 -2 24 24" fill="currentColor">
                                                        <path
                                                            d="M6 2V1a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v1h4a2 2 0 0 1 2 2v1a2 2 0 0 1-2 2h-.133l-.68 10.2a3 3 0 0 1-2.993 2.8H5.826a3 3 0 0 1-2.993-2.796L2.137 7H2a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2zm10 2H2v1h14zM4.141 7l.687 10.068a1 1 0 0 0 .998.932h6.368a1 1 0 0 0 .998-.934L13.862 7zM7 8a1 1 0 0 1 1 1v7a1 1 0 0 1-2 0V9a1 1 0 0 1 1-1m4 0a1 1 0 0 1 1 1v7a1 1 0 0 1-2 0V9a1 1 0 0 1 1-1" />
                                                    </svg>
                                                    Delete
                                                </button>
                                            </form>
                                        </div>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="flex justify-center mt-4">
                    {{ $pengurus->links() }}
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-10">
                    <svg class="w-12 h-12 mx-auto mb-4" xmlns="http://www.w3.org/2000/svg" width="36" height="36"
                        viewBox="0 0 36 36">
                        <path fill="currentColor"
                            d="M14.68 14.81a6.76 6.76 0 1 1 6.76-6.75a6.77 6.77 0 0 1-6.76 6.75m0-11.51a4.76 4.76 0 1 0 4.76 4.76a4.76 4.76 0 0 0-4.76-4.76"
                            class="clr-i-outline clr-i-outline-path-1" />
                        <path fill="currentColor"
                            d="M16.42 31.68A2.14 2.14 0 0 1 15.8 30H4v-5.78a14.8 14.8 0 0 1 11.09-4.68h.72a2.2 2.2 0 0 1 .62-1.85l.12-.11c-.47 0-1-.06-1.46-.06A16.47 16.47 0 0 0 2.2 23.26a1 1 0 0 0-.2.6V30a2 2 0 0 0 2 2h12.7Z"
                            class="clr-i-outline clr-i-outline-path-2" />
                        <path fill="currentColor" d="M26.87 16.29a.4.4 0 0 1 .15 0a.4.4 0 0 0-.15 0"
                            class="clr-i-outline clr-i-outline-path-3" />
                        <path fill="currentColor"
                            d="m33.68 23.32l-2-.61a7.2 7.2 0 0 0-.58-1.41l1-1.86A.38.38 0 0 0 32 19l-1.45-1.45a.36.36 0 0 0-.44-.07l-1.84 1a7 7 0 0 0-1.43-.61l-.61-2a.36.36 0 0 0-.36-.24h-2.05a.36.36 0 0 0-.35.26l-.61 2a7 7 0 0 0-1.44.6l-1.82-1a.35.35 0 0 0-.43.07L17.69 19a.38.38 0 0 0-.06.44l1 1.82a6.8 6.8 0 0 0-.63 1.43l-2 .6a.36.36 0 0 0-.26.35v2.05A.35.35 0 0 0 16 26l2 .61a7 7 0 0 0 .6 1.41l-1 1.91a.36.36 0 0 0 .06.43l1.45 1.45a.38.38 0 0 0 .44.07l1.87-1a7 7 0 0 0 1.4.57l.6 2a.38.38 0 0 0 .35.26h2.05a.37.37 0 0 0 .35-.26l.61-2.05a7 7 0 0 0 1.38-.57l1.89 1a.36.36 0 0 0 .43-.07L32 30.4a.35.35 0 0 0 0-.4l-1-1.88a7 7 0 0 0 .58-1.39l2-.61a.36.36 0 0 0 .26-.35v-2.1a.36.36 0 0 0-.16-.35M24.85 28a3.34 3.34 0 1 1 3.33-3.33A3.34 3.34 0 0 1 24.85 28"
                            class="clr-i-outline clr-i-outline-path-4" />
                        <path fill="none" d="M0 0h36v36H0z" />
                    </svg>
                    <h5 class="text-gray-500 font-medium text-lg">Belum ada data pengurus</h5>
                    <p class="text-gray-400">Klik tombol "Tambah Pengurus" untuk menambah data baru</p>
                </div>
            @endif
        </div>
    </div>
@endsection
