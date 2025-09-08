@extends('layouts.app', ['title' => 'About'])

@section('content')
    <div class="bg-white rounded-lg p-6 space-y-6">
        <!-- Header -->
        <div class="grid grid-cols-1 md:grid-cols-2 items-center justify-between">
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
            <div class="mt-4 md:text-right">
                <a href="{{ route('about.create') }}"
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-emerald-600 text-white font-semibold hover:bg-emerald-700 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M12 5c.552 0 1 .448 1 1v5h5a1 1 0 1 1 0 2h-5v5a1 1 0 1 1-2 0v-5H6a1 1 0 1 1 0-2h5V6c0-.552.448-1 1-1" />
                    </svg>
                    Tambah Data
                </a>
            </div>

        </div>

        <!-- Table (Desktop) -->
        <div class="hidden md:block overflow-x-auto bg-white shadow rounded-lg">
            <table class="w-full text-sm text-left border border-gray-200">
                <thead class="bg-emerald-50 text-emerald-700">
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
                            <td class="px-4 py-2 text-center truncate max-w-xs">
                                {!! strip_tags($about->description) !!}
                            </td>
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
                                    <a href="{{ route('about.edit', $about->id) }}"
                                        class="flex items-center gap-1 px-3 py-2 bg-green-100 text-green-600 rounded-lg hover:bg-green-200">
                                        Edit
                                    </a>
                                    <form action="{{ route('about.destroy', $about->id) }}" method="POST"
                                        class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="delete-btn flex items-center gap-1 px-3 py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200">
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

        <!-- Cards (Mobile) -->
        <div class="block md:hidden space-y-4">
            @forelse($abouts as $index => $about)
                <div
                    class="rounded-xl border-l-4 border-emerald-500 shadow-md hover:shadow-lg transition bg-white p-4 space-y-3">

                    <!-- Header -->
                    <div class="flex justify-between items-center">
                        <div class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-emerald-600" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path
                                    d="M12 2a10 10 0 100 20 10 10 0 000-20m0 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H6a1 1 0 110-2h5V6a1 1 0 011-1" />
                            </svg>
                            <h2 class="font-semibold text-emerald-700 text-lg">{{ $about->title }}</h2>
                        </div>
                        <span class="text-xs text-gray-400">#{{ $abouts->firstItem() + $index }}</span>
                    </div>

                    <!-- Description -->
                    <p class="text-sm text-gray-600 line-clamp-3">
                        {!! strip_tags($about->description) !!}
                    </p>

                    <!-- Images -->
                    <div class="flex gap-3">
                        @if ($about->image)
                            <img src="{{ asset('storage/' . $about->image) }}"
                                class="w-20 h-20 object-cover rounded-lg border border-gray-200">
                        @endif
                        @if ($about->image2)
                            <img src="{{ asset('storage/' . $about->image2) }}"
                                class="w-20 h-20 object-cover rounded-lg border border-gray-200">
                        @endif
                    </div>

                    <!-- Actions -->
                    <div class="flex gap-2 pt-2 border-t border-gray-100">
                        <a href="{{ route('about.edit', $about->id) }}"
                            class="flex items-center justify-center gap-1 flex-1 px-3 py-2 bg-green-100 text-green-600 rounded-lg hover:bg-green-200 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM21.71 6.04a1.004 1.004 0 00-1.42 0l-2.34 2.34 3.75 3.75 2.34-2.34c.39-.39.39-1.03 0-1.42l-2.33-2.33z" />
                            </svg>
                            Edit
                        </a>
                        <form action="{{ route('about.destroy', $about->id) }}" method="POST" class="delete-form flex-1">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="flex items-center justify-center gap-1 w-full px-3 py-2 bg-red-100 text-red-600 rounded-lg hover:bg-red-200 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M6 7h12v13a2 2 0 01-2 2H8a2 2 0 01-2-2V7zm3-3a1 1 0 011-1h4a1 1 0 011 1v1h5a1 1 0 010 2H4a1 1 0 010-2h5V4z" />
                                </svg>
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <p class="text-center text-gray-500">Belum ada data About.</p>
            @endforelse
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
        });
    </script>
@endsection
