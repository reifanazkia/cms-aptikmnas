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


        <!-- Filter + Button -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 justify-between sm:items-center">

            <!-- Select Kategori -->
            <div class="row-cols-2 md:col-start-1 md:row-start-1 flex w-[160px] md:w-full sm:w-auto text-left relative">
                <select id="categoryFilter"
                    class="appearance-none rounded-lg px-4 py-2 pr-10 text-sm text-center border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 w-full sm:w-auto">
                    <option value="">Semua Kategori</option>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->nama }}</option>
                    @endforeach
                </select>

                <!-- Custom Arrow SVG -->
                <div class="absolute left-34 top-1/2 transform -translate-y-1/2 pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-500" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>
            </div>

            <!-- Tombol Tambah Data -->
            <div class="text-left md:text-right row-start-1 md:col-start-2 md:row-start-1">
                <a href="{{ route('aboutus.create') }}"
                    class="inline-flex w-[160px] items-center px-4 py-2 bg-emerald-600 text-white rounded-lg shadow hover:bg-emerald-700 transition">
                    <!-- SVG Plus Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Data
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
                            class="px-3 py-1.5 bg-blue-100 text-blue-600 rounded-lg hover:bg-blue-200 text-xs inline-flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path d="M4 21h4l10.586-10.586a1 1 0
                                                           000-1.414L15 4a1 1 0 00-1.414
                                                           0L3 14.586V19a2 2 0 002 2z" />
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
                                                               0v8a1 1 0 11-2 0V9z" clip-rule="evenodd" />
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
        <div class="hidden sm:block overflow-x-auto">
            <table class="w-full border border-gray-200 rounded-lg overflow-hidden">
                <thead class="bg-gray-100 text-gray-700 text-sm">
                    <tr>
                        <th class="px-4 py-3 text-center">Gambar</th>
                        <th class="px-4 py-3 text-center">Judul</th>
                        <th class="px-4 py-3 text-center">Deskripsi</th>
                        <th class="px-4 py-3 text-center">Kategori</th>
                        <th class="px-4 py-3 text-center">Home</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody id="aboutusTable" class="divide-y divide-gray-200 text-sm">
                    @forelse($aboutus as $item)
                        <tr class="aboutus-row" data-category="{{ $item->category_aboutus_id }}">
                            <td class="px-4 py-3">
                                @if ($item->image)
                                    <img src="{{ asset($item->image) }}" alt="{{ $item->title }}"
                                        class="w-20 h-14 object-cover rounded-md">
                                @else
                                    <div
                                        class="w-20 h-14 bg-gray-100 flex items-center justify-center text-gray-400 text-xs rounded-md">
                                        No Image
                                    </div>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-center font-medium text-emerald-700">{{ $item->title }}</td>
                            <td class="px-4 py-3 text-center text-gray-500 max-w-xs truncate">{{ strip_tags($item->description) }}</td>

                            <td class="px-4 py-3 text-center">{{ $item->category->nama ?? '-' }}</td>
                            <td class="px-4 py-3 text-center">
                                @if ($item->display_on_home)
                                    <span class="px-2 py-1 bg-emerald-100 text-emerald-600 rounded-full text-xs">Ya</span>
                                @else
                                    <span class="px-2 py-1 bg-gray-100 text-gray-500 rounded-full text-xs">Tidak</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-center space-x-2">
                                <a href="{{ route('aboutus.edit', $item) }}"
                                    class="px-3 py-1 bg-blue-500 text-white text-xs rounded-lg hover:bg-blue-600">Edit</a>
                                <form action="{{ route('aboutus.destroy', $item) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus data ini?')" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="px-3 py-1 bg-red-500 text-white text-xs rounded-lg hover:bg-red-600">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-6 text-center text-gray-500 bg-gray-50">
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
