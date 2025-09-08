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

        <!-- Versi Desktop (Tabel) -->
        <div class="hidden sm:block overflow-x-auto bg-white shadow rounded-lg">
            <table class="w-full text-sm text-left border border-gray-200">
                <thead class="bg-emerald-600 text-white">
                    <tr>
                        <th class="px-4 py-2 text-center">No</th>
                        <th class="px-4 py-2 text-center">Judul</th>
                        <th class="px-4 py-2 text-center">Subjudul</th>
                        <th class="px-4 py-2 text-center">Gambar</th>
                        <th class="px-4 py-2 text-center">Youtube ID</th>
                        <th class="px-4 py-2 text-center">Ditampilkan</th>
                        <th class="px-4 py-2 text-center">Dibuat</th>
                        <th class="px-4 py-2 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($sliders as $slider)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 text-center">{{ $loop->iteration }}</td>
                            <td class="px-4 py-2 text-center">{{ $slider->title ?? '-' }}</td>
                            <td class="px-4 py-2 text-center">{{ $slider->subtitle ?? '-' }}</td>
                            <td class="px-4 py-2 text-center">
                                @if ($slider->image)
                                    <img src="{{ asset('storage/' . $slider->image) }}" alt="slider"
                                        class="h-12 mx-auto rounded hover:scale-110 transition">
                                @else
                                    <span class="text-gray-400">Tidak ada</span>
                                @endif
                            </td>
                            <td class="px-4 py-2 text-center">
                                @if ($slider->youtube_id)
                                    <a href="https://www.youtube.com/watch?v={{ $slider->youtube_id }}" target="_blank"
                                        class="text-blue-600 underline">
                                        {{ $slider->youtube_id }}
                                    </a>
                                @else
                                    -
                                @endif
                            </td>
                            <td class="px-4 py-2 text-center">
                                @if ($slider->display_on_home)
                                    <span class="px-2 py-1 text-xs bg-emerald-100 text-emerald-700 rounded">Ya</span>
                                @else
                                    <span class="px-2 py-1 text-xs bg-red-100 text-red-700 rounded">Tidak</span>
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
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15.232 5.232l3.536 3.536M9 13l6-6 3 3-6 6H9v-3z" />
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
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3m-7 0h8" />
                                            </svg>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-4 py-4 text-center text-gray-500">Belum ada slider</td>
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
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2
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
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15.232 5.232l3.536 3.536M9 13l6-6 3 3-6 6H9v-3z" />
                            </svg>
                            Edit
                        </a>
                        <form action="{{ route('slider.destroy', $slider->id) }}" method="POST" class="flex-1 delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="w-full px-3 py-1 bg-red-100 text-red-600 rounded-lg text-sm flex items-center justify-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0
                                           01-1.995-1.858L5 7m5 4v6m4-6v6M9
                                           7V4a1 1 0 011-1h4a1 1 0
                                           011 1v3m-7 0h8" />
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
