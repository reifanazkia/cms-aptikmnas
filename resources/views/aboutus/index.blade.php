@extends('layouts.app', ['title' => 'Tentang Kami'])

@section('content')
    <div class="bg-white p-6 rounded-xl space-y-8">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-emerald-700">Tentang Kami</h1>
                <p class="text-sm text-gray-500 mt-1">Kelola informasi tentang organisasi / perusahaan Anda</p>
            </div>
        </div>

        <!-- Alert Messages -->
        @if (session('success'))
            <div class="p-4 bg-emerald-100 text-emerald-700 rounded-lg">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="p-4 bg-red-100 text-red-700 rounded-lg">
                {{ session('error') }}
            </div>
        @endif


        <!-- Header Filter + Button -->
        <div class="grid grid-cols-1 md:grid-cols-2 md:items-center md:justify-between gap-4 mb-6">

            <!-- Select Lokasi -->
            <div class="relative w-1/2 md:w-39">
                <select id="locationFilter"
                    class="appearance-none w-full rounded-lg px-4 py-2 pr-10 text-sm border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500">
                    <option value="">Semua Lokasi</option>
                    @foreach ($categories as $loc)
                        <option value="{{ $loc->id }}">{{ $loc->nama }}</option>
                    @endforeach
                </select>

                <!-- Custom Arrow -->
                <div class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-500" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>
            </div>

            <!-- Tombol Tambah -->
            <div class="md:text-right">
                <a href="{{ route('aboutus.create') }}"
                    class="inline-flex items-center px-4 py-2 bg-emerald-600 text-white rounded-lg shadow hover:bg-emerald-700 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Agenda
                </a>
            </div>
        </div>

        <!-- Versi Mobile (Card) -->
        <div class="sm:hidden space-y-4">
            @forelse ($aboutus as $item)
                <div class="aboutus-row p-4 bg-white shadow rounded-xl border border-emerald-100"
                    data-category="{{ $item->category_aboutus_id }}">
                    <div class="flex gap-3">
                        <!-- Gambar -->
                        @if ($item->image)
                            <div class="h-20 w-28 rounded overflow-hidden flex-shrink-0">
                                <img src="{{ asset($item->image) }}" alt="{{ $item->title }}"
                                    class="h-full w-full object-cover">
                            </div>
                        @else
                            <div
                                class="h-20 w-28 flex items-center justify-center bg-gray-100 text-gray-400 rounded overflow-hidden flex-shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2
                                                                                               l1.586-1.586a2 2 0 012.828 0L20 14
                                                                                               m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2
                                                                                               0 00-2-2H6a2 2 0 00-2 2v12a2 2
                                                                                               0 002 2z" />
                                </svg>
                            </div>
                        @endif

                        <!-- Konten -->
                        <div class="flex-1">
                            <h2 class="font-semibold text-gray-800 text-sm line-clamp-2">
                                {{ $item->title }}
                            </h2>
                            <p class="text-xs text-gray-500 mt-1 line-clamp-2">{{ strip_tags($item->description) }}</p>

                            <div class="mt-2">
                                @if ($item->display_on_home)
                                    <span class="text-xs px-2 py-0.5 bg-emerald-50 text-emerald-600 rounded-full">Ya</span>
                                @else
                                    <span class="text-xs px-2 py-0.5 bg-gray-100 text-gray-500 rounded-full">Tidak</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Divider -->
                    <div class="border-t border-gray-100 mt-3 pt-3 flex justify-end gap-2">
                        <!-- Tombol Edit -->
                        <a href="{{ route('aboutus.edit', $item) }}"
                            class="px-3 py-1.5 bg-green-100 text-green-600 rounded-lg hover:bg-green-200 text-xs inline-flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path
                                    d="m7 17.013 4.413-.015 9.632-9.54c.378-.378.586-.88.586-1.414s-.208-1.036-.586-1.414l-1.586-1.586c-.756-.756-2.075-.752-2.825-.003L7 12.583zM18.045 4.458l1.589 1.583-1.597 1.582-1.586-1.585zM9 13.417l6.03-5.973 1.586 1.586-6.029 5.971L9 15.006z" />
                                <path
                                    d="M5 21h14c1.103 0 2-.897 2-2v-8.668l-2 2V19H8.158c-.026 0-.053.01-.079.01-.033 0-.066-.009-.1-.01H5V5h6.847l2-2H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2" />
                            </svg>
                            Edit
                        </a>

                        <!-- Tombol Hapus -->
                        <form action="{{ route('aboutus.destroy', $item) }}" method="POST"
                            onsubmit="return confirm('Yakin ingin menghapus item ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="px-3 py-1.5 bg-red-100 text-red-600 rounded-lg hover:bg-red-200 text-xs inline-flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24"
                                    fill="currentColor">
                                    <path fill-rule="evenodd" d="M9 3a1 1 0 00-.894.553L7.382
                                                                                           5H4a1 1 0 100 2h1v12a2 2
                                                                                           0 002 2h10a2 2 0 002-2V7h1a1
                                                                                           1 0 100-2h-3.382l-.724-1.447A1
                                                                                           1 0 0015 3H9zm2 6a1 1 0 112
                                                                                           0v8a1 1 0 11-2 0V9zm-4 0a1
                                                                                           1 0 112 0v8a1 1 0 11-2
                                                                                           0V9zm8 0a1 1 0 112
                                                                                           0v8a1 1 0 11-2 0V9z"
                                        clip-rule="evenodd" />
                                </svg>
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="p-4 text-center text-gray-500 bg-gray-50 rounded-lg">
                    Belum ada data "Tentang Kami".
                </div>
            @endforelse
        </div>

        <!-- Versi Desktop (Tabel) -->
        <!-- Table View About Us -->
        <div class="overflow-x-auto bg-white rounded-lg shadow-sm border border-emerald-100 hidden md:block">
            <table class="min-w-full text-sm divide-y divide-emerald-100">
                <thead class="bg-emerald-100 text-emerald-800 uppercase text-xs font-semibold">
                    <tr>
                        <th class="px-4 py-3 text-center">Gambar</th>
                        <th class="px-4 py-3 text-center">Judul</th>
                        <th class="px-4 py-3 text-center">Deskripsi</th>
                        <th class="px-4 py-3 text-center">Kategori</th>
                        {{-- <th class="px-4 py-3 text-center">Home</th> --}}
                        <th class="px-4 py-3 text-center w-90">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-emerald-100">
                    @forelse($aboutus as $item)
                        <tr class="hover:bg-emerald-50 transition">
                            <td class="px-4 py-3 text-center">
                                @if ($item->image)
                                    <img src="{{ asset($item->image) }}" alt="{{ $item->title }}"
                                        class="w-20 h-14 object-cover rounded-md mx-auto">
                                @else
                                    <div
                                        class="w-20 h-14 bg-gray-100 flex items-center justify-center text-gray-400 text-xs rounded-md mx-auto">
                                        No Image
                                    </div>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-center font-medium text-emerald-700">
                                {{ $item->title }}
                            </td>
                            <td class="px-4 py-3 text-center text-gray-500 max-w-xs truncate">
                                {{ strip_tags($item->description) }}
                            </td>
                            <td class="px-4 py-3 text-center">{{ $item->category->name ?? '-' }}</td>
                            {{-- <td class="px-4 py-3 text-center">
                                @if ($item->display_on_home)
                                    <span
                                        class="px-2 py-1 bg-emerald-100 text-emerald-700 rounded-full text-xs font-medium">
                                        Ya
                                    </span>
                                @else
                                    <span class="px-2 py-1 bg-gray-100 text-gray-500 rounded-full text-xs font-medium">
                                        Tidak
                                    </span>
                                @endif
                            </td> --}}
                            <td class="px-4 py-3 text-center align-middle">
                                <div class="flex justify-center gap-2 mt-2">
                                    <a href="{{ route('aboutus.edit', $item) }}"
                                        class="px-3 py-2 flex items-center gap-1 bg-green-100 text-green-600 rounded-lg hover:bg-green-200 text-xs font-medium transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                            fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="m7 17.013 4.413-.015 9.632-9.54c.378-.378.586-.88.586-1.414s-.208-1.036-.586-1.414l-1.586-1.586c-.756-.756-2.075-.752-2.825-.003L7 12.583zM18.045 4.458l1.589 1.583-1.597 1.582-1.586-1.585zM9 13.417l6.03-5.973 1.586 1.586-6.029 5.971L9 15.006z" />
                                            <path
                                                d="M5 21h14c1.103 0 2-.897 2-2v-8.668l-2 2V19H8.158c-.026 0-.053.01-.079.01-.033 0-.066-.009-.1-.01H5V5h6.847l2-2H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2" />
                                        </svg>
                                        Edit
                                    </a>
                                    <form action="{{ route('aboutus.destroy', $item) }}" method="POST"
                                        class="inline delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button"
                                            class="px-3 py-2 flex items-center gap-1 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 text-xs font-medium transition delete-btn">
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
                            <td colspan="6" class="px-4 py-6 text-center text-gray-400">
                                Belum ada data "Tentang Kami".
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Script filter kategori client-side -->
    <script>
        document.getElementById('categoryFilter').addEventListener('change', function() {
            let selected = this.value;
            document.querySelectorAll('.aboutus-row').forEach(row => {
                if (selected === '' || row.dataset.category === selected) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>
@endsection
