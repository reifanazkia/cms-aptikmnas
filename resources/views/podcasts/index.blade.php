@extends('layouts.app', ['title' => 'Daftar Podcast'])

@section('content')
    <div class="max-w-full mx-auto">
        <!-- Card Container -->
        <div class="bg-white rounded-2xl shadow-xl p-6 space-y-6">

            <!-- Header -->
            <div class="flex items-center justify-between rounded-xl px-5 py-3">
                <h1 class="text-2xl font-bold text-emerald-700 flex items-center gap-2">
                    <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                        <path
                            d="M2 3.75A.75.75 0 0 1 2.75 3h10.5a.75.75 0 0 1 0 1.5H2.75A.75.75 0 0 1 2 3.75M2 8a.75.75 0 0 1 .75-.75h10.5a.75.75 0 0 1 0 1.5H2.75A.75.75 0 0 1 2 8m0 4.25a.75.75 0 0 1 .75-.75h10.5a.75.75 0 0 1 0 1.5H2.75a.75.75 0 0 1-.75-.75" />
                    </svg>
                    Daftar Podcast
                </h1>
            </div>

            <!-- Flash message -->
            @if (session('success'))
                <div x-data="{ show: true }" x-show="show" x-transition
                    class="flex items-center justify-between bg-emerald-100 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-lg shadow">
                    <div class="flex items-center gap-3">
                        <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span class="font-medium">{{ session('success') }}</span>
                    </div>
                    <button @click="show = false" class="text-emerald-600 hover:text-emerald-800 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            @endif

            <div class="flex items-center justify-between">
                <!-- Search -->
                <form method="GET" action="{{ route('podcasts.index') }}" class="flex items-center gap-3">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari podcast..."
                        class="px-4 py-2.5 w-64 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                    <button type="submit"
                        class="px-5 py-2.5 bg-emerald-600 text-white rounded-lg shadow hover:bg-emerald-700 transition">
                        Search
                    </button>
                </form>

                <a href="{{ route('podcasts.create') }}"
                    class="inline-flex items-center px-5 py-2.5 bg-emerald-600 text-white rounded-lg shadow hover:bg-emerald-700 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Podcast
                </a>
            </div>


            <!-- Table -->
            <div class="overflow-x-auto rounded-xl border border-emerald-100 shadow-sm">
                <table class="min-w-full text-sm text-left">
                    <thead>
                        <tr class="bg-emerald-100 text-emerald-900 font-semibold">
                            <th class="px-4 py-3 text-center">#</th>
                            <th class="px-4 py-3 text-center">Judul</th>
                            <th class="px-4 py-3 text-center">Kategori</th>
                            <th class="px-4 py-3 text-center">Tanggal Publikasi</th>
                            <th class="px-4 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($podcasts as $podcast)
                            <tr class="hover:bg-emerald-50 border-b border-emerald-100">
                                <td class="px-4 py-3 text-center">{{ $loop->iteration }}</td>
                                <td class="px-4 py-3 text-center font-medium text-gray-800">{{ $podcast->title }}</td>
                                <td class="px-4 py-3 text-center">{{ $podcast->category->name ?? '-' }}</td>
                                <td class="px-4 py-3 text-center text-gray-600">{{ $podcast->pub_date->format('d M Y') }}
                                </td>
                                <td class="px-4 py-2 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('podcasts.show', $podcast->id) }}"
                                            class="p-2 rounded-lg flex items-center gap-1 bg-blue-100 text-blue-600 hover:bg-blue-200 transition"
                                            title="Lihat">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M12 5c-7.633 0-12 7-12 7s4.367 7 12 7 12-7 12-7-4.367-7-12-7zm0 12a5 5 0 1 1 0-10 5 5 0 0 1 0 10z" />
                                                <circle cx="12" cy="12" r="2.5" />
                                            </svg>
                                            Detail
                                        </a>
                                        <a href="{{ route('podcasts.edit', $podcast->id) }}"
                                            class="p-2 rounded-lg flex items-center gap-1 bg-green-100 text-green-600 hover:bg-green-200 transition"
                                            title="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41L18.37 3.29a.9959.9959 0 0 0-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z" />
                                            </svg>
                                            Edit
                                        </a>
                                        <form action="{{ route('podcasts.destroy', $podcast->id) }}" method="POST"
                                            class="inline-block form-delete">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button"
                                                class="p-2 rounded-lg flex items-center gap-1 bg-red-100 text-red-600 hover:bg-red-200 transition btn-delete"
                                                data-action="{{ route('podcasts.destroy', $podcast->id) }}" title="Hapus">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path
                                                        d="M9 3v1H4v2h1v13c0 1.1.9 2 2 2h10c1.1 0 2-.9 2-2V6h1V4h-5V3H9zm2 5h2v9h-2V8zm-4 0h2v9H7V8zm8 0h2v9h-2V8z" />
                                                </svg>
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-6 text-center text-gray-500">
                                    <p class="italic">Belum ada data podcast.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $podcasts->links() }}
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.btn-delete').forEach(function(button) {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    let form = this.closest('form');
                    Swal.fire({
                        title: 'Yakin ingin menghapus?',
                        text: "Data akan dihapus secara permanen!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Ya, hapus!',
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
