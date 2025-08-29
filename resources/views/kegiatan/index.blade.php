@extends('layouts.app', ['title' => 'Daftar Kegiatan'])

@section('content')
    <div class="bg-white rounded-2xl shadow-lg floating-card p-6 space-y-6">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <h1 class="text-3xl font-bold text-emerald-700 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-emerald-600" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2v-7H3v7a2 2 0 002 2z" />
                </svg>
                Daftar Kegiatan
            </h1>
            <a href="{{ route('kegiatan.create') }}"
                class="inline-flex items-center px-4 py-2 bg-emerald-600 text-white rounded-xl hover:bg-emerald-700 shadow-sm transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Kegiatan
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
                <a href="{{ route('kegiatan.index') }}"
                    class="px-3 py-1 rounded-lg border text-sm {{ request()->routeIs('kegiatan.index') ? 'bg-emerald-600 text-white border-emerald-600' : 'text-gray-700 border-gray-300 hover:bg-gray-50' }}">
                    Semua
                </a>
                @foreach ($categories as $category)
                    <a href="{{ route('kegiatan.byCategory', $category->id) }}"
                        class="px-3 py-1 rounded-lg border text-sm {{ request()->is('kegiatan/category/' . $category->id) ? 'bg-emerald-600 text-white border-emerald-600' : 'text-gray-700 border-gray-300 hover:bg-gray-50' }}">
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto bg-white shadow-md rounded-2xl">
            <table class="min-w-full text-sm text-left border-collapse">
                <thead>
                    <tr class="bg-emerald-50 text-emerald-800 font-semibold">
                        <th class="px-4 py-3 border-b border-emerald-100 text-center">Gambar</th>
                        <th class="px-4 py-3 border-b border-emerald-100 text-center">Judul</th>
                        <th class="px-4 py-3 border-b border-emerald-100 text-center">Kategori</th>
                        <th class="px-4 py-3 border-b border-emerald-100 text-center">Deskripsi</th>
                        <th class="px-4 py-3 border-b border-emerald-100 text-center">Tanggal</th>
                        <th class="px-4 py-3 border-b border-emerald-100 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kegiatans as $kegiatan)
                        <tr class="hover:bg-gray-50 border-b border-emerald-50">
                            <td class="px-4 py-3 border-b border-emerald-50 text-center">
                                @if ($kegiatan->image)
                                    <img src="{{ asset('storage/' . $kegiatan->image) }}" class="h-14 w-1/2 mx-auto rounded"
                                        alt="{{ $kegiatan->title }}">
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
                                {{ $kegiatan->title }}
                            </td>
                            <td class="px-4 py-3 border-b border-emerald-50 text-center">
                                <span class="px-2 py-1 text-xs font-medium bg-emerald-100 text-emerald-700 rounded-full">
                                    {{ $kegiatan->category->name }}
                                </span>
                            </td>
                            <td class="px-4 py-3 border-b border-emerald-50 text-center text-gray-600">
                                {{ Str::limit($kegiatan->description ?? 'Tidak ada deskripsi', 50) }}
                            </td>
                            <td class="px-4 py-3 border-b border-emerald-50 text-center text-gray-500">
                                {{ $kegiatan->created_at->format('d M Y, H:i') }}
                            </td>
                            <td class="px-4 py-3 border-b border-emerald-50 text-center">
                                <div class="flex justify-center gap-2">
                                    <!-- Tombol Detail -->
                                    <a href="{{ route('kegiatan.show', $kegiatan->id) }}"
                                        class="px-3 py-1 bg-blue-100 text-blue-600 rounded-lg hover:bg-blue-200 text-sm inline-flex items-center gap-1.5">
                                        <!-- Icon detail (eye) -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            viewBox="0 0 24 24" fill="currentColor">
                                            <path
                                                d="M20 3H4c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2h16c1.103 0 2-.897 2-2V5c0-1.103-.897-2-2-2M4 19V5h16l.002 14z" />
                                            <path d="M6 7h12v2H6zm0 4h12v2H6zm0 4h6v2H6z" />
                                        </svg>
                                        Detail
                                    </a>

                                    <!-- Tombol Edit -->
                                    <a href="{{ route('kegiatan.edit', $kegiatan->id) }}"
                                        class="px-3 py-1 bg-green-100 text-green-500 rounded-lg hover:bg-green-200 text-sm inline-flex items-center gap-1.5">
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
                                    <button type="button"
                                        class="px-3 py-1 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 text-sm inline-flex items-center gap-1.5 delete-btn"
                                        data-id="{{ $kegiatan->id }}" data-title="{{ $kegiatan->title }}">
                                        <!-- Icon delete (trash) -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            viewBox="-3 -2 24 24" fill="currentColor">
                                            <path
                                                d="M6 2V1a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v1h4a2 2 0 0 1 2 2v1a2 2 0 0 1-2 2h-.133l-.68 10.2a3 3 0 0 1-2.993 2.8H5.826a3 3 0 0 1-2.993-2.796L2.137 7H2a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2zm10 2H2v1h14zM4.141 7l.687 10.068a1 1 0 0 0 .998.932h6.368a1 1 0 0 0 .998-.934L13.862 7zM7 8a1 1 0 0 1 1 1v7a1 1 0 0 1-2 0V9a1 1 0 0 1 1-1m4 0a1 1 0 0 1 1 1v7a1 1 0 0 1-2 0V9a1 1 0 0 1 1-1" />
                                        </svg>
                                        Hapus
                                    </button>
                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-6 text-center text-gray-500">
                                Belum ada kegiatan
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Script Hapus dengan SweetAlert -->
    <script>
        document.querySelectorAll('.delete-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                const id = btn.dataset.id;
                const title = btn.dataset.title;

                Swal.fire({
                    title: 'Yakin hapus?',
                    text: `Kegiatan "${title}" akan dihapus permanen!`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Ya, hapus',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        const form = document.createElement('form');
                        form.action = `/kegiatan/${id}`;
                        form.method = 'POST';
                        form.innerHTML = `@csrf @method('DELETE')`;
                        document.body.appendChild(form);
                        form.submit();
                    }
                });
            });
        });
    </script>
@endsection
