@extends('layouts.app', ['title' => 'Daftar Testimonies'])

@section('content')
    <div class="bg-white rounded-lg p-6 space-y-6">
        <!-- Flash Message -->
        @if (session('success'))
            <div class="p-3 rounded bg-green-100 text-green-700 border border-green-200">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="p-3 rounded bg-red-100 text-red-700 border border-red-200">
                {{ session('error') }}
            </div>
        @endif

        <!-- Header -->
        <div class="grid grid-cols-1 md:grid-cols-2 items-center">
            <div>
                <h1 class="text-3xl font-bold text-emerald-700">Daftar Testimonies</h1>
                <p class="text-sm text-emerald-600">Kelola data testimoni yang tampil di website Anda</p>
            </div>

            <div class="md:text-right mt-4">
                <a href="{{ route('testimonies.create') }}"
                    class="px-4 py-3 rounded-lg w-[150px]  bg-emerald-600 text-white font-semibold hover:bg-emerald-700 transition">
                    + Tambah Testimony
                </a>
            </div>
        </div>

        <!-- Versi Mobile (Card) -->
        <div class="sm:hidden space-y-4">
            @forelse ($testimonies as $index => $testimony)
                <div class="p-4 bg-white shadow rounded-lg border border-gray-200">
                    <div class="flex items-center gap-3 mb-3">
                        <img src="{{ asset($testimony->image) }}" alt="{{ $testimony->name }}"
                            class="h-14 w-14 rounded-lg object-cover">
                        <div>
                            <h2 class="font-semibold text-emerald-700">{{ $testimony->name }}</h2>
                            <p class="text-sm text-gray-600">{{ $testimony->title }}</p>
                        </div>
                    </div>
                    <div class="text-sm space-y-1 mb-3">
                        <p><span class="font-medium text-gray-700">Kategori:</span>
                            {{ $testimony->category?->name ?? '-' }}
                        </p>
                        <p><span class="font-medium text-gray-700">Homepage:</span>
                            @if ($testimony->display_homepage)
                                <span class="px-2 py-0.5 text-xs bg-emerald-100 text-emerald-700 rounded">Ya</span>
                            @else
                                <span class="px-2 py-0.5 text-xs bg-red-100 text-red-700 rounded">Tidak</span>
                            @endif
                        </p>
                    </div>
                    <div class="flex justify-end gap-2">
                        <!-- Tombol Edit -->
                        <a href="{{ route('testimonies.edit', $testimony->id) }}"
                            class="flex items-center gap-1 px-3 py-1.5 bg-green-100 text-green-600 rounded-lg hover:bg-green-200 text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path
                                    d="m7 17.013 4.413-.015 9.632-9.54c.378-.378.586-.88.586-1.414s-.208-1.036-.586-1.414l-1.586-1.586c-.756-.756-2.075-.752-2.825-.003L7 12.583zM18.045 4.458l1.589 1.583-1.597 1.582-1.586-1.585zM9 13.417l6.03-5.973 1.586 1.586-6.029 5.971L9 15.006z" />
                                <path
                                    d="M5 21h14c1.103 0 2-.897 2-2v-8.668l-2 2V19H8.158c-.026 0-.053.01-.079.01-.033 0-.066-.009-.1-.01H5V5h6.847l2-2H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2" />
                            </svg>
                            Edit
                        </a>
                        <!-- Tombol Hapus -->
                        <form action="{{ route('testimonies.destroy', $testimony->id) }}" method="POST"
                            class="delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="flex items-center gap-1 px-3 py-1.5 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 text-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    viewBox="-3 -2 24 24">
                                    <path
                                        d="M6 2V1a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v1h4a2 2 0 0 1 2 2v1a2 2 0 0 1-2 2h-.133l-.68 10.2a3 3 0 0 1-2.993 2.8H5.826a3 3 0 0 1-2.993-2.796L2.137 7H2a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2zm10 2H2v1h14zM4.141 7l.687 10.068a1 1 0 0 0 .998.932h6.368a1 1 0 0 0 .998-.934L13.862 7zM7 8a1 1 0 0 1 1 1v7a1 1 0 0 1-2 0V9a1 1 0 0 1 1-1m4 0a1 1 0 0 1 1 1v7a1 1 0 0 1-2 0V9a1 1 0 0 1 1-1" />
                                </svg>
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <p class="text-center text-gray-500">Belum ada data testimony</p>
            @endforelse
        </div>

        <!-- Versi Desktop (Tabel) -->
        <div class="hidden sm:block overflow-x-auto bg-white shadow rounded-lg">
            <table class="w-full text-sm text-left border border-gray-200">
                <thead class="bg-emerald-600 text-white">
                    <tr>
                        <th class="px-4 py-2 text-center">No</th>
                        <th class="px-4 py-2 text-center">Gambar</th>
                        <th class="px-4 py-2 text-center">Nama</th>
                        <th class="px-4 py-2 text-center">Judul</th>
                        <th class="px-4 py-2 text-center w-70">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($testimonies as $index => $testimony)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 text-center">{{ $testimonies->firstItem() + $index }}</td>
                            <td class="px-4 py-2 text-center">
                                <img src="{{ asset('storage/' . $testimony->image) }}"   alt="{{ $testimony->name }}"
                                    class="h-12 w-12 object-cover rounded-lg mx-auto hover:scale-110 transition">
                            </td>
                            <td class="px-4 py-2 text-center">{{ $testimony->name }}</td>
                            <td class="px-4 py-2 text-center">{{ $testimony->title }}</td>
                            <td class="px-4 py-2 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <!-- Tombol Edit -->
                                    <a href="{{ route('testimonies.edit', $testimony->id) }}"
                                        class="flex items-center gap-1 px-3 py-2 bg-green-100 text-green-600 rounded-lg hover:bg-green-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="m7 17.013 4.413-.015 9.632-9.54c.378-.378.586-.88.586-1.414s-.208-1.036-.586-1.414l-1.586-1.586c-.756-.756-2.075-.752-2.825-.003L7 12.583zM18.045 4.458l1.589 1.583-1.597 1.582-1.586-1.585zM9 13.417l6.03-5.973 1.586 1.586-6.029 5.971L9 15.006z" />
                                            <path
                                                d="M5 21h14c1.103 0 2-.897 2-2v-8.668l-2 2V19H8.158c-.026 0-.053.01-.079.01-.033 0-.066-.009-.1-.01H5V5h6.847l2-2H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2" />
                                        </svg>
                                        Edit
                                    </a>
                                    <!-- Tombol Hapus -->
                                    <form action="{{ route('testimonies.destroy', $testimony->id) }}" method="POST"
                                        class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="delete-btn flex items-center gap-1 px-3 py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" viewBox="-3 -2 24 24">
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
                            <td colspan="5" class="px-4 py-4 text-center text-gray-500">Belum ada data testimony</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>


        <!-- Pagination -->
        <div>
            {{ $testimonies->links() }}
        </div>
    </div>
@endsection
