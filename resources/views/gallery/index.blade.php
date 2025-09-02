@extends('layouts.app', ['title' => 'Gallery'])

@section('content')
    <div class="rounded-2xl floating-card p-6 space-y-6">
        <!-- Header -->
        <div class="flex items-center justify-between">
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

        <!-- Filter -->
        <div>
            <h6 class="text-gray-600 mb-2">Filter berdasarkan Kategori:</h6>
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('gallery.index') }}"
                    class="px-3 py-1 rounded-lg border text-sm {{ request('category') ? 'text-gray-700 border-gray-300 hover:bg-gray-50' : 'bg-emerald-600 text-white border-emerald-600' }}">
                    Semua
                </a>
                @foreach ($categories as $category)
                    <a href="{{ route('gallery.index', ['category' => $category->id]) }}"
                        class="px-3 py-1 rounded-lg border text-sm {{ request('category') == $category->id ? 'bg-emerald-600 text-white border-emerald-600' : 'text-gray-700 border-gray-300 hover:bg-gray-50' }}">
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>
        </div>

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
                            <th class="px-4 py-3 border-b border-emerald-100 text-center">Deskripsi</th>
                            <th class="px-4 py-3 border-b border-emerald-100 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($galleries as $index => $gallery)
                            <tr class="hover:bg-gray-50 border-b border-emerald-50">
                                <td class="px-4 py-3 border-b border-emerald-50 text-center text-gray-700">
                                    {{ $loop->iteration + ($galleries->currentPage() - 1) * $galleries->perPage() }}
                                </td>
                                <td class="px-4 py-3 border-b border-emerald-50 text-center">
                                    @if ($gallery->image)
                                        <img src="{{ Storage::url($gallery->image) }}" alt="{{ $gallery->title }}"
                                            class="h-14 w-1/2 mx-auto rounded">
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
                                <td class="px-4 py-3 border-b border-emerald-50 text-center font-medium text-gray-800">
                                    {{ $gallery->title }}</td>
                                <td class="px-4 py-3 border-b border-emerald-50 text-center">
                                    @if ($gallery->category)
                                        <span
                                            class="px-2 py-1 text-xs font-medium bg-emerald-100 text-emerald-700 rounded-full">
                                            {{ $gallery->category->name }}
                                        </span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 border-b border-emerald-50 text-center text-gray-600">
                                    {{ Str::limit($gallery->description, 50) }}
                                </td>
                                <td class="px-4 py-3 border-b border-emerald-50 text-center">
                                    <div class="flex justify-center gap-2">
                                        <!-- Tombol Edit -->
                                        <a href="{{ route('gallery.edit', $gallery) }}"
                                            class="px-4 py-2 bg-green-100 text-green-500 rounded-lg hover:bg-green-200 text-sm inline-flex items-center gap-1.5">
                                            <!-- Icon edit (pencil) -->
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
                                        <form action="{{ route('gallery.destroy', $gallery) }}" method="POST"
                                            class="inline" onsubmit="return confirm('Yakin ingin menghapus item ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="px-4 py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 text-sm inline-flex items-center gap-1.5">
                                                <!-- Icon delete (trash) -->
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
