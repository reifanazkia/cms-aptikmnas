@extends('layouts.app', ['title' => 'Daftar Slider'])

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
        <div class="flex items-center justify-between flex-wrap gap-3">
            <div>
                <h1 class="text-3xl font-bold text-emerald-700">Daftar Slider</h1>
                <p class="text-sm text-emerald-600">Kelola data slider yang tampil di halaman depan</p>
            </div>
            <a href="{{ route('slider.create') }}"
                class="px-4 py-2 rounded-lg bg-emerald-600 text-white font-semibold hover:bg-emerald-700 transition">
                + Tambah Slider
            </a>
        </div>

        <div class="hidden sm:block overflow-x-auto bg-white shadow rounded-lg">
            <table class="w-full text-sm text-left border border-gray-200">
                <thead class="bg-emerald-600 text-white">
                    <tr>
                        <th class="px-4 py-2 text-center">No</th>
                        <th class="px-4 py-2 text-center">Judul</th>
                        <th class="px-4 py-2 text-center">Gambar</th>
                        <th class="px-4 py-2 text-center">Dibuat</th>
                        <th class="px-4 py-2 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($sliders as $slider)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 text-center">{{ $loop->iteration }}</td>
                            <td class="px-4 py-2 text-center">{{ $slider->title ?? '-' }}</td>
                            <td class="px-4 py-2 text-center">
                                @if ($slider->image)
                                    <img src="{{ asset('storage/' . $slider->image) }}" alt="slider"
                                        class="h-12 mx-auto rounded hover:scale-110 transition">
                                @else
                                    <span class="text-gray-400">Tidak ada</span>
                                @endif
                            </td>
                            <td class="px-4 py-2 text-center">
                                {{ $slider->created_at ? $slider->created_at->format('d M Y') : '-' }}
                            </td>
                            <td class="px-4 py-2 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <!-- Tombol Edit -->
                                    <a href="{{ route('slider.edit', $slider->id) }}"
                                        class="flex items-center gap-1 px-3 py-1 bg-green-100 text-green-600 rounded-lg hover:bg-green-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="currentColor"
                                            viewBox="0 0 24 24">
                                            <path
                                                d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04a1.003 1.003 0 0 0 0-1.42l-2.34-2.34a1.003 1.003 0 0 0-1.42 0l-1.83 1.83 3.75 3.75 1.84-1.82z" />
                                        </svg>
                                        Edit
                                    </a>

                                    <!-- Tombol Hapus -->
                                    <form action="{{ route('slider.destroy', $slider->id) }}" method="POST"
                                        class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="delete-btn flex items-center gap-1 px-3 py-1 bg-red-100 text-red-700 rounded-lg hover:bg-red-200">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="currentColor"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M6 2a1 1 0 0 0-1 1v1H2v2h1v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6h1V4h-3V3a1 1 0 0 0-1-1H6zm2 4h8v12H8V6z" />
                                            </svg>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-4 text-center text-gray-500">Belum ada slider</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>


        <!-- Versi Mobile (Card) -->
        <div class="sm:hidden space-y-4">
            @forelse($sliders as $slider)
                <div class="p-4 bg-white shadow rounded-lg border border-emerald-100">
                    <div class="flex items-center gap-3 mb-3">
                        @if ($slider->image)
                            <img src="{{ asset('storage/' . $slider->image) }}" alt="slider"
                                class="h-16 w-24 object-cover rounded">
                        @else
                            <div class="h-16 w-24 flex items-center justify-center bg-gray-100 text-gray-400 rounded">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2
                                                               l1.586-1.586a2 2 0 012.828 0L20 14M6 20h12a2 2 0
                                                               002-2V6a2 2 0 00-2-2H6a2 2 0
                                                               00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        @endif
                        <div>
                            <h2 class="font-semibold text-gray-800">{{ $slider->title ?? '-' }}</h2>
                            <p class="text-sm text-gray-500">{{ $slider->subtitle ?? '-' }}</p>
                        </div>
                    </div>

                    <div class="text-sm text-gray-600 space-y-1 mb-3">
                        <p><span class="font-medium">Youtube:</span>
                            @if ($slider->youtube_id)
                                <a href="https://www.youtube.com/watch?v={{ $slider->youtube_id }}" target="_blank"
                                    class="text-blue-600 underline">{{ $slider->youtube_id }}</a>
                            @else
                                -
                            @endif
                        </p>
                        <p><span class="font-medium">Ditampilkan:</span>
                            @if ($slider->display_on_home)
                                <span class="px-2 py-0.5 text-xs bg-emerald-100 text-emerald-700 rounded">Ya</span>
                            @else
                                <span class="px-2 py-0.5 text-xs bg-red-100 text-red-700 rounded">Tidak</span>
                            @endif
                        </p>
                        <p><span class="font-medium">Dibuat:</span>
                            {{ $slider->created_at ? $slider->created_at->format('d M Y') : '-' }}
                        </p>
                    </div>

                    <div class="flex gap-2">
                        <a href="{{ route('slider.edit', $slider->id) }}"
                            class="flex-1 px-3 py-1 bg-green-100 text-green-600 rounded-lg text-center text-sm flex items-center justify-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                fill="currentColor">
                                <path
                                    d="m7 17.013 4.413-.015 9.632-9.54c.378-.378.586-.88.586-1.414s-.208-1.036-.586-1.414l-1.586-1.586c-.756-.756-2.075-.752-2.825-.003L7 12.583zM18.045 4.458l1.589 1.583-1.597 1.582-1.586-1.585zM9 13.417l6.03-5.973 1.586 1.586-6.029 5.971L9 15.006z" />
                                <path
                                    d="M5 21h14c1.103 0 2-.897 2-2v-8.668l-2 2V19H8.158c-.026 0-.053.01-.079.01-.033 0-.066-.009-.1-.01H5V5h6.847l2-2H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2" />
                            </svg>
                            Edit
                        </a>
                        <form action="{{ route('slider.destroy', $slider->id) }}" method="POST"
                            class="flex-1 delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="w-full px-3 py-1 bg-red-100 text-red-600 rounded-lg text-sm flex items-center justify-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M6 2V1a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v1h4a2 2 0 0 1 2 2v1a2 2 0 0 1-2 2h-.133l-.68 10.2A3 3 0 0 1 14.994 21H5.826a3 3 0 0 1-2.993-2.796L2.137 7H2a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h4zM4.141 7l.687 10.068a1 1 0 0 0 .998.932h6.368a1 1 0 0 0 .998-.934L13.862 7H4.141z" />
                                </svg>
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <p class="text-center text-gray-500">Belum ada slider</p>
            @endforelse
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll('.delete-form').forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Yakin hapus slider ini?',
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
        });
    </script>
@endsection
