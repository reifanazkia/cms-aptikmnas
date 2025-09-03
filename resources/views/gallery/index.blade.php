@extends('layouts.app', ['title' => 'Gallery'])

@section('content')
    <div class="bg-white rounded-lg floating-card p-6 space-y-6">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <h1 class="text-3xl font-bold text-emerald-700 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-emerald-600" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18" />
                </svg>
                Gallery
            </h1>
            <a href="{{ route('gallery.create') }}"
                class="inline-flex items-center px-4 py-2 bg-emerald-600 text-white rounded-xl hover:bg-emerald-700 shadow-sm transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Item
            </a>
        </div>

        <!-- Alert -->
        @if (session('success'))
            <div class="p-4 bg-green-50 border-l-4 border-green-500 rounded-lg text-green-700">
                <strong>Sukses!</strong> {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="p-4 bg-red-50 border-l-4 border-red-500 rounded-lg text-red-700">
                <strong>Gagal!</strong> {{ session('error') }}
            </div>
        @endif

        <!-- Filter & Search -->
        <form method="GET" action="{{ route('gallery.index') }}"
            class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h6 class="text-gray-600 mb-2">Filter berdasarkan Kategori:</h6>
                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('gallery.index') }}"
                        class="px-3 py-1 rounded-lg border text-sm {{ request('category') ? 'text-gray-700 border-gray-300 hover:bg-gray-50' : 'bg-emerald-600 text-white border-emerald-600' }}">
                        Semua
                    </a>
                    @foreach ($categories as $category)
                        <a href="{{ route('gallery.index', array_merge(request()->query(), ['category' => $category->id])) }}"
                            class="px-3 py-1 rounded-lg border text-sm {{ request('category') == $category->id ? 'bg-emerald-600 text-white border-emerald-600' : 'text-gray-700 border-gray-300 hover:bg-gray-50' }}">
                            {{ $category->name }}
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="flex items-center gap-2">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul..."
                    class="rounded-lg border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 text-sm px-3 py-2">
                <button type="submit"
                    class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 text-sm inline-flex items-center gap-1.5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    Cari
                </button>
            </div>
        </form>

        <!-- Table -->
        @if ($galleries->count() > 0)
            <div class="overflow-x-auto bg-white shadow-md rounded-2xl">
                <table class="min-w-full text-sm text-left border-collapse">
                    <thead>
                        <tr class="bg-emerald-50 text-emerald-800 font-semibold">
                            <th class="px-4 py-3 border-b border-emerald-100 text-center">No</th>
                            <th class="px-4 py-3 border-b border-emerald-100 text-center">Gambar</th>
                            <th class="px-4 py-3 border-b border-emerald-100 text-center">Judul</th>
                            <th class="px-4 py-3 border-b border-emerald-100 text-center">Kategori</th>
                            {{-- <th class="px-4 py-3 border-b border-emerald-100 text-center">Deskripsi</th> --}}
                            <th class="px-4 py-3 border-b border-emerald-100 text-center">Tanggal Publikasi</th>
                            {{-- <th class="px-4 py-3 border-b border-emerald-100 text-center">Waktu Baca</th> --}}
                            <th class="px-4 py-3 border-b border-emerald-100 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($galleries as $gallery)
                            <tr class="hover:bg-gray-50 border-b border-emerald-50">
                                <td class="px-4 py-3 text-center text-gray-700">
                                    {{ $loop->iteration + ($galleries->currentPage() - 1) * $galleries->perPage() }}
                                </td>
                                <td class="px-4 py-3 text-center">
                                    @if ($gallery->image)
                                        <img src="{{ Storage::url($gallery->image) }}" alt="{{ $gallery->title }}"
                                            class="h-14 w-20 object-cover mx-auto rounded">
                                    @else
                                        <div
                                            class="h-14 w-20 flex items-center justify-center bg-gray-100 text-gray-400 rounded">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                        </div>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-center font-medium text-gray-800">
                                    {{ $gallery->title }}
                                </td>
                                <td class="px-4 py-3 text-center">
                                    @if ($gallery->category)
                                        <span
                                            class="px-2 py-1 text-xs font-medium bg-emerald-100 text-emerald-700 rounded-full">
                                            {{ $gallery->category->name }}
                                        </span>
                                    @endif
                                </td>
                                {{-- <td class="px-4 py-3 text-center text-gray-600">
                                    {{ Str::limit(strip_tags($gallery->description), 50) }}
                                </td> --}}

                                <td class="px-4 py-3 text-center text-gray-600">
                                    {{ $gallery->pub_date ? \Carbon\Carbon::parse($gallery->pub_date)->format('d M Y') : '-' }}
                                </td>
                                {{-- <td class="px-4 py-3 text-center text-gray-600">
                                    {{ $gallery->waktu_baca }}
                                </td> --}}
                                <td class="px-4 py-3 text-center">
                                    <div class="flex justify-center gap-2">
                                        <!-- Edit -->
                                        <a href="{{ route('gallery.edit', $gallery) }}"
                                            class="px-3 py-1.5 bg-green-100 text-green-600 rounded-lg hover:bg-green-200 text-sm inline-flex items-center gap-1.5">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24"
                                                fill="currentColor">
                                                <path
                                                    d="M4 21h4l10.586-10.586a1 1 0 000-1.414L15 4a1 1 0 00-1.414 0L3 14.586V19a2 2 0 002 2z" />
                                            </svg>
                                            Edit
                                        </a>

                                        <!-- Hapus -->
                                        <form action="{{ route('gallery.destroy', $gallery) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus item ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="px-3 py-1.5 bg-red-100 text-red-600 rounded-lg hover:bg-red-200 text-sm inline-flex items-center gap-1.5">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24"
                                                    fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M9 3a1 1 0 00-.894.553L7.382 5H4a1 1 0 100 2h1v12a2 2 0 002 2h10a2 2 0 002-2V7h1a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0015 3H9zm2 6a1 1 0 112 0v8a1 1 0 11-2 0V9zm-4 0a1 1 0 112 0v8a1 1 0 11-2 0V9zm8 0a1 1 0 112 0v8a1 1 0 11-2 0V9z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                Hapus
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
            <div class="mt-6 flex justify-center">
                {{ $galleries->appends(request()->query())->links() }}
            </div>
        @else
            <div class="text-center py-12 text-gray-500">
                <p>Belum ada item gallery</p>
                <a href="{{ route('gallery.create') }}"
                    class="mt-4 inline-block px-4 py-2 bg-emerald-600 text-white rounded-xl hover:bg-emerald-700">
                    Tambah Item
                </a>
            </div>
        @endif
    </div>
@endsection
