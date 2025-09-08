@extends('layouts.app', ['title' => 'Data Pengurus'])

@section('content')
    <div class="max-w-7xl mx-auto">
        <!-- Card Container -->
        <div class="bg-white rounded-2xl shadow-lg floating-card p-6 space-y-6">
            <!-- Header -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-2 items-center justify-between border-b border-emerald-100 pb-4">
                <div class=>
                    <h1 class="text-2xl font-bold text-emerald-700 flex items-center gap-2">
                        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                            <path fill="currentColor" fill-rule="evenodd"
                                d="M2 4.75A.75.75 0 0 1 2.75 4h14.5a.75.75 0 0 1 0 1.5H2.75A.75.75 0 0 1 2 4.75M2 10a.75.75 0 0 1 .75-.75h14.5a.75.75 0 0 1 0 1.5H2.75A.75.75 0 0 1 2 10m0 5.25a.75.75 0 0 1 .75-.75h14.5a.75.75 0 0 1 0 1.5H2.75a.75.75 0 0 1-.75-.75"
                                clip-rule="evenodd" />
                        </svg>
                        Data Pengurus
                    </h1>
                </div>
                <div class="text-left md:text-right mt-1">
                    <a href="{{ route('pengurus.create') }}"
                        class="inline-flex items-center px-4 py-2 bg-emerald-600 text-white rounded-xl hover:bg-emerald-700 transition-all duration-200 shadow-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Tambah Pengurus
                    </a>
                </div>
            </div>

            @if ($pengurus->count() > 0)
                <!-- Versi Tabel (Desktop) -->
                <div class="hidden sm:block overflow-x-auto rounded-lg border border-emerald-100">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-emerald-100 text-emerald-700">
                            <tr>
                                <th class="px-4 py-2">No</th>
                                <th class="px-4 py-2">Foto</th>
                                <th class="px-4 py-2">Nama</th>
                                <th class="px-4 py-2">Email</th>
                                <th class="px-4 py-2">Telepon</th>
                                <th class="px-4 py-2">Daftar Pengurus DPD</th>
                                <th class="px-4 py-2">Kategori Pengurus</th>
                                <th class="px-4 py-2 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-emerald-100">
                            @foreach ($pengurus as $index => $item)
                                <tr class="hover:bg-gray-50 border-b border-emerald-50">
                                    <td class="px-4 py-2">{{ $pengurus->firstItem() + $index }}</td>
                                    <td class="px-4 py-2">
                                        @if ($item->image)
                                            <img src="{{ asset('storage/' . $item->image) }}" alt="Foto"
                                                class="w-12 h-12 rounded-full object-cover">
                                        @else
                                            <div
                                                class="w-12 h-12 rounded-full bg-emerald-200 flex items-center justify-center text-white">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M5.121 17.804A9.995 9.995 0 0112 15c2.485 0 4.735.912 6.879 2.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                                </svg>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-4 py-2">{{ $item->title }}</td>
                                    <td class="px-4 py-2">{{ $item->email }}</td>
                                    <td class="px-4 py-2">{{ $item->phone }}</td>
                                    <td class="px-4 py-2">
                                        @if ($item->categoryDaftar)
                                            <span
                                                class="px-2 py-1 bg-emerald-100 text-emerald-700 rounded-md text-xs font-semibold">
                                                {{ $item->categoryDaftar->name }}
                                            </span>
                                        @else
                                            <span class="text-gray-400">-</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-2">
                                        @if ($item->categoryPengurus)
                                            <span
                                                class="px-2 py-1 bg-green-100 text-green-700 rounded-md text-xs font-semibold">
                                                {{ $item->categoryPengurus->name }}
                                            </span>
                                        @else
                                            <span class="text-gray-400">-</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-2 text-center">
                                        <div class="flex justify-center gap-2">
                                            <a href="{{ route('pengurus.edit', $item->id) }}"
                                                class="px-4 py-2 bg-green-100 text-green-500 rounded-md hover:bg-yellow-200 text-xs font-medium transition inline-flex items-center gap-1.5">
                                                Edit
                                            </a>

                                            <form action="{{ route('pengurus.destroy', $item->id) }}" method="POST"
                                                class="delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="px-4 py-2 bg-red-100 text-red-700 rounded-md hover:bg-red-200 text-xs font-medium transition inline-flex items-center gap-1.5">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Versi Mobile (Card) -->
                <div class="grid gap-4 sm:hidden">
                    @foreach ($pengurus as $index => $item)
                        <div class="bg-gray-50 rounded-xl border border-emerald-100 p-4 shadow-sm">
                            <div class="flex items-center gap-3">
                                @if ($item->image)
                                    <img src="{{ asset('storage/' . $item->image) }}" alt="Foto"
                                        class="w-14 h-14 rounded-full object-cover">
                                @else
                                    <div
                                        class="w-14 h-14 rounded-full bg-emerald-200 flex items-center justify-center text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5.121 17.804A9.995 9.995 0 0112 15c2.485 0 4.735.912 6.879 2.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </div>
                                @endif
                                <div>
                                    <h3 class="font-semibold text-emerald-700">{{ $item->title }}</h3>
                                    <p class="text-sm text-gray-500">{{ $item->email }}</p>
                                    <p class="text-sm text-gray-500">{{ $item->phone }}</p>
                                </div>
                            </div>

                            <div class="mt-3 flex flex-wrap gap-2 text-xs">
                                @if ($item->categoryDaftar)
                                    <span
                                        class="px-2 py-1 bg-emerald-100 text-emerald-700 rounded-md font-semibold">{{ $item->categoryDaftar->name }}</span>
                                @endif
                                @if ($item->categoryPengurus)
                                    <span
                                        class="px-2 py-1 bg-green-100 text-green-700 rounded-md font-semibold">{{ $item->categoryPengurus->name }}</span>
                                @endif
                            </div>

                            <div class="mt-3 flex justify-end gap-2">
                                <a href="{{ route('pengurus.edit', $item->id) }}"
                                    class="px-3 py-1 bg-green-100 text-green-500 rounded-md hover:bg-yellow-200 text-xs font-medium transition">
                                    Edit
                                </a>
                                <form action="{{ route('pengurus.destroy', $item->id) }}" method="POST"
                                    class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="px-3 py-1 bg-red-100 text-red-700 rounded-md hover:bg-red-200 text-xs font-medium transition">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="flex justify-center mt-4">
                    {{ $pengurus->links() }}
                </div>
            @else
                <div class="text-center py-10">
                    <h5 class="text-gray-500 font-medium text-lg">Belum ada data pengurus</h5>
                    <p class="text-gray-400">Klik tombol "Tambah Pengurus" untuk menambah data baru</p>
                </div>
            @endif
        </div>
    </div>

    <!-- SweetAlert2 -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Delete confirmation
            document.querySelectorAll('.delete-form').forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Apakah yakin ingin menghapus?',
                        text: "Data yang dihapus tidak bisa dikembalikan!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });

            // Success notification
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: '{{ session('success') }}',
                    timer: 2000,
                    showConfirmButton: false
                });
            @endif
        });
    </script>
@endsection
