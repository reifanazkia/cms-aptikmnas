@extends('layouts.app', ['title' => 'Daftar Partner'])

@section('content')
    <div class="max-w-7xl mx-auto">
        <div class="bg-white rounded-2xl shadow-lg floating-card p-6 space-y-6">
            <!-- Header -->
            <div class="flex flex-col md:flex-row md:items-center md:justify-between border-b border-emerald-100 pb-4">
                <h1 class="text-2xl font-bold text-emerald-700 mb-3 md:mb-0">Daftar Partner</h1>
                <a href="{{ route('partners.create') }}"
                    class="inline-flex items-center px-4 py-2 bg-emerald-600 text-white rounded-xl hover:bg-emerald-700 transition-all duration-200 shadow-md">
                    + Tambah Partner
                </a>
            </div>

            <!-- Alerts -->
            @if (session('success'))
                <div class="p-4 rounded-lg bg-green-50 border border-green-200 text-green-700 text-sm font-medium">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Table -->
            <div class="overflow-x-auto rounded-lg border border-emerald-100">
                <table class="w-full text-sm text-left">
                    <thead class="bg-emerald-100 text-emerald-700">
                        <tr>
                            <th class="px-4 py-2 text-center">No</th>
                            <th class="px-4 py-2 text-center">Nama</th>
                            <th class="px-4 py-2 text-center">Website</th>
                            <th class="px-4 py-2 text-center">Deskripsi</th>
                            <th class="px-4 py-2 text-center">Gambar</th>
                            <th class="px-4 py-2 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-emerald-100">
                        @forelse($partners as $partner)
                            <tr class="hover:bg-gray-50 border-b border-emerald-50">
                                <td class="px-4 py-2 text-center">{{ $loop->iteration }}</td>
                                <td class="px-4 py-2 text-center">{{ $partner->name }}</td>
                                <td class="px-4 py-2 text-center">
                                    @if ($partner->web_address)
                                        <a href="{{ $partner->web_address }}" target="_blank"
                                            class="text-emerald-600 hover:underline">
                                            {{ $partner->web_address }}
                                        </a>
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif
                                </td>
                                <td class="px-4 py-2 text-center">{{ Str::limit($partner->description, 50) }}</td>
                                <td class="px-4 py-2 text-center">
                                    @if ($partner->image)
                                        <img src="{{ asset('storage/' . $partner->image) }}"
                                            class="w-20 h-20 object-cover mx-auto rounded-lg" alt="Gambar Partner">
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif
                                </td>
                                <td class="px-4 py-2 text-center">
                                    <div class="flex justify-center items-center gap-2">
                                        <a href="{{ route('partners.edit', $partner->id) }}"
                                            class="px-4 py-2 bg-green-100 text-green-500 rounded-md hover:bg-green-200 text-xs font-medium transition inline-flex items-center gap-1.5">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                viewBox="0 0 24 24" fill="currentColor">
                                                <path
                                                    d="m7 17.013 4.413-.015 9.632-9.54c.378-.378.586-.88.586-1.414s-.208-1.036-.586-1.414l-1.586-1.586c-.756-.756-2.075-.752-2.825-.003L7 12.583zM18.045 4.458l1.589 1.583-1.597 1.582-1.586-1.585zM9 13.417l6.03-5.973 1.586 1.586-6.029 5.971L9 15.006z" />
                                                <path
                                                    d="M5 21h14c1.103 0 2-.897 2-2v-8.668l-2 2V19H8.158c-.026 0-.053.01-.079.01-.033 0-.066-.009-.1-.01H5V5h6.847l2-2H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2" />
                                            </svg>
                                            Edit
                                        </a>
                                        <form action="{{ route('partners.destroy', $partner->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin hapus partner ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                class="px-4 py-2 bg-red-100 text-red-700 rounded-md hover:bg-red-200 text-xs font-medium transition inline-flex items-center gap-1.5">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                    viewBox="-3 -2 24 24" fill="currentColor">
                                                    <path
                                                        d="M6 2V1a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v1h4a2 2 0 0 1 2 2v1a2 2 0 0 1-2 2h-.133l-.68 10.2a3 3 0 0 1-2.993 2.8H5.826a3 3 0 0 1-2.993-2.796L2.137 7H2a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2zm10 2H2v1h14zM4.141 7l.687 10.068a1 1 0 0 0 .998.932h6.368a1 1 0 0 0 .998-.934L13.862 7zM7 8a1 1 0 0 1 1 1v7a1 1 0 0 1-2 0V9a1 1 0 0 1 1-1m4 0a1 1 0 0 1 1 1v7a1 1 0 0 1-2 0V9a1 1 0 0 1 1-1" />
                                                </svg>
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-4 text-center text-gray-500">Belum ada data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
