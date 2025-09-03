@extends('layouts.app', ['title' => 'About'])

@section('content')
    <div class="bg-white rounded-lg p-6 space-y-6">
        <!-- Flash Message -->
        {{-- Hapus notifikasi box, biar hanya pakai SweetAlert --}}
        @if (session('error'))
            <div class="p-3 rounded bg-red-100 text-red-700 border border-red-200">
                {{ session('error') }}
            </div>
        @endif

        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-emerald-700 flex items-center gap-1">
                    <svg class="w-7 h-7 text-emerald-600" xmlns="http://www.w3.org/2000/svg" width="512" height="512"
                        viewBox="0 0 512 512">
                        <path fill="currentColor" fill-rule="evenodd"
                            d="M256 42.667C138.18 42.667 42.667 138.179 42.667 256c0 117.82 95.513 213.334 213.333 213.334c117.822 0 213.334-95.513 213.334-213.334S373.822 42.667 256 42.667m0 384c-94.105 0-170.666-76.561-170.666-170.667S161.894 85.334 256 85.334c94.107 0 170.667 76.56 170.667 170.666S350.107 426.667 256 426.667m26.714-256c0 15.468-11.262 26.667-26.497 26.667c-15.851 0-26.837-11.2-26.837-26.963c0-15.15 11.283-26.37 26.837-26.37c15.235 0 26.497 11.22 26.497 26.666m-48 64h42.666v128h-42.666z" />
                    </svg>
                    About
                </h1>
                <p class="text-sm text-emerald-600 mt-1">Kelola informasi tentang organisasi / perusahaan Anda</p>
            </div>
            <a href="{{ route('about.create') }}"
                class="px-4 py-2 rounded-lg bg-emerald-600 text-white font-semibold hover:bg-emerald-700 transition">
                Tambah Data
            </a>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto bg-white shadow rounded-lg">
            <table class="w-full text-sm text-left border border-gray-200">
                <thead class="bg-emerald-50 text-white">
                    <tr>
                        <th class="px-4 py-2 text-center">No</th>
                        <th class="px-4 py-2 text-center">Judul</th>
                        <th class="px-4 py-2 text-center">Deskripsi</th>
                        <th class="px-4 py-2 text-center">Gambar 1</th>
                        <th class="px-4 py-2 text-center">Gambar 2</th>
                        <th class="px-4 py-2 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($abouts as $index => $about)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 text-center">{{ $abouts->firstItem() + $index }}</td>
                            <td class="px-4 py-2 text-center">{{ $about->title }}</td>
                            <td class="px-4 py-2 text-center truncate max-w-xs">{{ $about->description }}</td>
                            <td class="px-4 py-2 text-center">
                                @if ($about->image)
                                    <img src="{{ asset('storage/' . $about->image) }}" class="w-20 rounded mx-auto">
                                @else
                                    <span class="text-gray-400 text-sm">No Image</span>
                                @endif
                            </td>
                            <td class="px-4 py-2 text-center">
                                @if ($about->image2)
                                    <img src="{{ asset('storage/' . $about->image2) }}" class="w-20 rounded mx-auto">
                                @else
                                    <span class="text-gray-400 text-sm">No Image</span>
                                @endif
                            </td>
                            <td class="px-4 py-2 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <!-- Edit -->
                                    <a href="{{ route('about.edit', $about->id) }}"
                                        class="flex items-center gap-1 px-3 py-2 bg-green-100 text-green-600 rounded-lg hover:bg-green-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                            fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="m7 17.013 4.413-.015 9.632-9.54c.378-.378.586-.88.586-1.414s-.208-1.036-.586-1.414l-1.586-1.586c-.756-.756-2.075-.752-2.825-.003L7 12.583zM18.045 4.458l1.589 1.583-1.597 1.582-1.586-1.585zM9 13.417l6.03-5.973 1.586 1.586-6.029 5.971L9 15.006z" />
                                            <path
                                                d="M5 21h14c1.103 0 2-.897 2-2v-8.668l-2 2V19H8.158c-.026 0-.053.01-.079.01-.033 0-.066-.009-.1-.01H5V5h6.847l2-2H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2" />
                                        </svg>
                                        Edit
                                    </a>

                                    <!-- Delete -->
                                    <form action="{{ route('about.destroy', $about->id) }}" method="POST"
                                        class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="delete-btn flex items-center gap-1 px-3 py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
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
                            <td colspan="6" class="px-4 py-4 text-center text-gray-500">Belum ada data About.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div>
            {{ $abouts->links() }}
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll('.delete-form').forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Yakin hapus data ini?',
                        text: "Data yang dihapus tidak bisa dikembalikan!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Ya, Hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });

            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: '{{ session('success') }}',
                    timer: 2000,
                    showConfirmButton: false
                });
            @endif

            @if (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: '{{ session('error') }}',
                });
            @endif
        });
    </script>
@endsection
