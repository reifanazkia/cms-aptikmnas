@extends('layouts.app', ['title' => 'Daftar Career'])

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
        <div class="grid grid-cols-1 md:grid-cols-2 items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-emerald-700">Daftar Career</h1>
                <p class="text-sm text-emerald-600">Kelola data career yang tersedia di website Anda</p>
            </div>
            <div class="md:text-right mt-4">
                <a href="{{ route('career.create') }}"
                    class="px-4 py-3 rounded-lg bg-emerald-600 text-white font-semibold hover:bg-emerald-700 transition">
                    + Tambah Career
                </a>
            </div>
        </div>

        <!-- Versi Mobile (Card) -->
        <div class="sm:hidden space-y-4 mt-4">
            @forelse ($careers as $index => $career)
                <div class="p-4 bg-white border border-emerald-100 shadow rounded-lg">
                    <!-- Header Card -->
                    <div class="flex justify-between items-center mb-3">
                        <span class="text-sm font-medium text-emerald-600">
                            #{{ $careers->firstItem() + $index }}
                        </span>
                        <span class="text-xs px-2 py-1 bg-emerald-100 text-emerald-600 rounded">
                            {{ $career->job_type }}
                        </span>
                    </div>

                    <!-- Position & Location -->
                    <h2 class="text-lg font-semibold text-gray-800">{{ $career->position_title }}</h2>
                    <p class="text-sm text-gray-500 mb-4">{{ $career->lokasi }}</p>

                    <!-- Action Buttons -->
                    <div class="flex w-full items-center gap-2">
                        <!-- Detail -->
                        <a href="{{ route('career.show', $career->id) }}"
                            class="flex items-center gap-1 px-2 py-2 bg-blue-100 text-blue-600 rounded-lg hover:bg-blue-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 5c-7.633 0-11 7-11 7s3.367 7 11 7 11-7 11-7-3.367-7-11-7zm0 12a5 5 0 1 1 0-10 5 5 0 0 1 0 10zm0-8a3 3 0 1 0 0 6 3 3 0 0 0 0-6z" />
                            </svg>
                            Detail
                        </a>

                        <!-- Edit -->
                        <a href="{{ route('career.edit', $career->id) }}"
                            class="flex items-center gap-1 px-2 py-2 bg-green-100 text-green-600 rounded-lg hover:bg-green-200">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path
                                    d="m7 17.013 4.413-.015 9.632-9.54c.378-.378.586-.88.586-1.414s-.208-1.036-.586-1.414l-1.586-1.586c-.756-.756-2.075-.752-2.825-.003L7 12.583zM18.045 4.458l1.589 1.583-1.597 1.582-1.586-1.585zM9 13.417l6.03-5.973 1.586 1.586-6.029 5.971L9 15.006z" />
                                <path
                                    d="M5 21h14c1.103 0 2-.897 2-2v-8.668l-2 2V19H8.158c-.026 0-.053.01-.079.01-.033 0-.066-.009-.1-.01H5V5h6.847l2-2H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2" />
                            </svg>
                            Edit
                        </a>

                        <!-- Hapus -->
                        <form action="{{ route('career.destroy', $career->id) }}" method="POST" class="delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="delete-btn flex items-center gap-1 px-2 py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                                    viewBox="-3 -2 24 24">
                                    <path
                                        d="M6 2V1a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v1h4a2 2 0 0 1 2 2v1a2 2 0 0 1-2 2h-.133l-.68 10.2a3 3 0 0 1-2.993 2.8H5.826a3 3 0 0 1-2.993-2.796L2.137 7H2a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2zm10 2H2v1h14zM4.141 7l.687 10.068a1 1 0 0 0 .998.932h6.368a1 1 0 0 0 .998-.934L13.862 7zM7 8a1 1 0 0 1 1 1v7a1 1 0 0 1-2 0V9a1 1 0 0 1 1-1m4 0a1 1 0 0 1 1 1v7a1 1 0 0 1-2 0V9a1 1 0 0 1 1-1" />
                                </svg>
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <p class="text-center text-gray-500">Belum ada data career</p>
            @endforelse
        </div>


        <!-- Versi Desktop (Tabel) -->
        <div class="hidden sm:block overflow-x-auto bg-white shadow rounded-lg mt-4">
            <table class="w-full text-sm text-left border border-gray-200">
                <thead class="bg-emerald-600 text-white">
                    <tr>
                        <th class="px-4 py-2 text-center">No</th>
                        <th class="px-4 py-2 text-center">Posisi</th>
                        <th class="px-4 py-2 text-center">Lokasi</th>
                        <th class="px-4 py-2 text-center">Job Type</th>
                        <th class="px-4 py-2 text-center w-90">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($careers as $index => $career)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 text-center">
                                {{ $careers->firstItem() + $index }}
                            </td>
                            <td class="px-4 py-2 text-center">
                                {{ $career->position_title }}
                            </td>
                            <td class="px-4 py-2 text-center">
                                {{ $career->lokasi }}
                            </td>
                            <td class="px-4 py-2 text-center">
                                {{ $career->job_type }}
                            </td>
                            <td class="px-4 py-2 text-center">
                                <div class="flex w-full items-center justify-center gap-2">
                                    <!-- Detail -->
                                    <a href="{{ route('career.show', $career->id) }}"
                                        class="flex items-center gap-1 px-3 py-2 bg-blue-100 text-blue-600 rounded-lg hover:bg-blue-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor"
                                            viewBox="0 0 24 24">
                                            <path
                                                d="M12 5c-7.633 0-11 7-11 7s3.367 7 11 7 11-7 11-7-3.367-7-11-7zm0 12a5 5 0 1 1 0-10 5 5 0 0 1 0 10zm0-8a3 3 0 1 0 0 6 3 3 0 0 0 0-6z" />
                                        </svg>
                                        Detail
                                    </a>

                                    <!-- Edit -->
                                    <a href="{{ route('career.edit', $career->id) }}"
                                        class="flex items-center gap-1 px-3 py-2 bg-green-100 text-green-600 rounded-lg hover:bg-green-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                            fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="m7 17.013 4.413-.015 9.632-9.54c.378-.378.586-.88.586-1.414s-.208-1.036-.586-1.414l-1.586-1.586c-.756-.756-2.075-.752-2.825-.003L7 12.583zM18.045 4.458l1.589 1.583-1.597 1.582-1.586-1.585zM9 13.417l6.03-5.973 1.586 1.586-6.029 5.971L9 15.006z" />
                                            <path
                                                d="M5 21h14c1.103 0 2-.897 2-2v-8.668l-2 2V19H8.158c-.026 0-.053.01-.079.01-.033 0-.066-.009-.1-.01H5V5h6.847l2-2H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2" />
                                        </svg>
                                        Edit
                                    </a>

                                    <!-- Hapus -->
                                    <form action="{{ route('career.destroy', $career->id) }}" method="POST"
                                        class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="delete-btn flex items-center gap-1 px-3 py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                fill="currentColor" viewBox="-3 -2 24 24">
                                                <path d="M6 2V1a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v1h4a2 2 0 0 1
                                                                     2 2v1a2 2 0 0 1-2 2h-.133l-.68 10.2a3 3 0 0 1-2.993
                                                                     2.8H5.826a3 3 0 0 1-2.993-2.796L2.137 7H2
                                                                     a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2zm10
                                                                     2H2v1h14zM4.141 7l.687 10.068a1 1 0 0 0
                                                                     .998.932h6.368a1 1 0 0 0 .998-.934L13.862 7zM7
                                                                     8a1 1 0 0 1 1 1v7a1 1 0 0 1-2
                                                                     0V9a1 1 0 0 1 1-1m4 0a1 1 0 0 1 1
                                                                     1v7a1 1 0 0 1-2 0V9a1 1 0 0 1 1-1" />
                                            </svg>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-4 text-center text-gray-500">
                                Belum ada data career
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>


        <!-- Pagination -->
        <div>
            {{ $careers->links() }}
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Konfirmasi hapus
            document.querySelectorAll('.delete-form').forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Yakin hapus career ini?',
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

            // Flash message success
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: '{{ session('success') }}',
                    timer: 2000,
                    showConfirmButton: false
                });
            @endif

            // Flash message error
            @if (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: '{{ session('error') }}',
                });
            @endif
        });
    </script>
@endsection
