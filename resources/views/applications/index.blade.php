@extends('layouts.app', ['title' => 'Lamaran Kerja'])

@section('content')
    <div class="bg-white p-8 rounded-xl max-w-7xl mx-auto space-y-6">

        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">
            <h1 class="text-2xl font-bold text-emerald-700">Daftar Lamaran Kerja</h1>

            <!-- Search & Action -->
            <div class="flex flex-col sm:flex-row gap-2">
                <!-- Search Form -->
                <form action="{{ route('applications.index') }}" method="GET" class="flex gap-2">
                    <input type="text" name="search" placeholder="Cari nama..."
                        class="w-full sm:w-60 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-emerald-500 focus:outline-none">

                    <button type="submit"
                        class="flex items-center gap-1 px-4 py-2 bg-emerald-600 text-white rounded-lg text-sm font-medium hover:bg-emerald-700 transition">
                        <!-- Search Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1010.5 18a7.5 7.5 0 006.15-3.35z" />
                        </svg>
                        Cari
                    </button>
                </form>
            </div>
        </div>

        <!-- Tombol Bulk Delete (default hidden) -->
        <form id="bulkDeleteForm" action="{{ route('applications.bulk-delete') }}" method="POST" class="hidden">
            @csrf
            @method('DELETE')

            <button type="submit"
                class="inline-flex items-center gap-2 px-4 py-2
               bg-red-600 hover:bg-red-700 active:bg-red-800
               text-white text-sm font-medium rounded-lg shadow-md
               transition duration-200 ease-in-out transform hover:scale-[1.02]">
                <!-- SVG Trash Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M1 7h22M10 3h4a1 1 0 011 1v2H9V4a1 1 0 011-1z" />
                </svg>
                Hapus Terpilih
            </button>
        </form>


        <!-- Tabel untuk Desktop -->
        <form id="bulkDeleteForm" method="POST" action="{{ route('applications.bulk-delete') }}">
            @csrf
            @method('DELETE')

            <!-- Table View -->
            <div class="overflow-x-auto bg-white rounded-lg shadow-sm border border-emerald-100 hidden md:block">
                <table class="min-w-full text-sm divide-y divide-emerald-100">
                    <thead class="bg-emerald-100 text-emerald-800 uppercase text-xs font-semibold">
                        <tr>
                            <th class="px-4 py-3 text-center">
                                <input type="checkbox" id="selectAll" class="rounded">
                            </th>
                            <th class="px-4 py-3 text-center">Posisi</th>
                            <th class="px-4 py-3 text-center">Nama</th>
                            <th class="px-4 py-3 text-center">Email</th>
                            {{-- <th class="px-4 py-3 text-center">Telepon</th>
                            <th class="px-4 py-3 text-center">File</th> --}}
                            <th class="px-4 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-emerald-100">
                        @forelse($applications as $application)
                            <tr class="hover:bg-emerald-50 transition">
                                <td class="px-4 py-2 text-center">
                                    <input type="checkbox" name="ids[]" value="{{ $application->id }}" class="rounded">
                                </td>
                                <td class="px-4 py-2 text-center">{{ $application->career->position_title ?? '-' }}</td>
                                <td class="px-4 py-2 text-center">{{ $application->nama }}</td>
                                <td class="px-4 py-2 text-center">{{ $application->email }}</td>
                                {{-- <td class="px-4 py-2 text-center">{{ $application->no_telepon }}</td>
                                <td class="px-4 py-2 text-center">
                                    @if ($application->file)
                                        <a href="{{ route('applications.downloadFile', $application->id) }}"
                                            class="inline-block px-2 py-1 bg-emerald-100 text-emerald-800 rounded text-xs font-medium hover:bg-emerald-200 transition">
                                            Download
                                        </a>
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif
                                </td> --}}
                                <td class="px-4 py-2 text-center flex justify-center gap-2">
                                    <a href="{{ route('applications.edit', $application->id) }}"
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
                                    <form action="{{ route('applications.destroy', $application->id) }}" method="POST"
                                        class="inline delete-form">
                                        @csrf @method('DELETE')
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
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-4 py-6 text-center text-gray-400">
                                    Belum ada data lamaran
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Card View untuk Mobile -->
            <div class="grid gap-4 md:hidden">
                @forelse($applications as $application)
                    <div class="border border-emerald-200 rounded-xl p-4 shadow-sm hover:shadow-md transition bg-white">
                        <!-- Header -->
                        <div class="flex justify-between items-start">
                            <div>
                                <h2 class="font-semibold text-emerald-700 text-base">
                                    {{ $application->career->position_title ?? '-' }}
                                </h2>
                                <p class="text-gray-800 font-medium">{{ $application->nama }}</p>
                            </div>
                            <input type="checkbox" name="ids[]" value="{{ $application->id }}" class="rounded mt-1">
                        </div>

                        <!-- Info -->
                        <div class="mt-2 text-sm text-gray-600 space-y-1">
                            <div class="flex items-center gap-2">
                                <!-- Email Icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-emerald-500" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 12H8m0 0l4 4m-4-4l4-4m8-4H4v16h16V4z" />
                                </svg>
                                <span>{{ $application->email }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <!-- Phone Icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-emerald-500" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3l2 5-2 2c1 2 3 4 5 5l2-2 5 2v3a2 2 0 01-2 2h-1c-7.18 0-13-5.82-13-13V5z" />
                                </svg>
                                <span>{{ $application->no_telepon }}</span>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="mt-4 flex flex-wrap gap-2">
                            @if ($application->file)
                                <a href="{{ route('applications.downloadFile', $application->id) }}"
                                    class="flex items-center gap-1 px-3 py-1.5 bg-emerald-100 text-emerald-700 rounded-lg text-xs font-medium hover:bg-emerald-200 transition">
                                    <!-- Download Icon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5 5m0 0l5-5m-5 5V4" />
                                    </svg>
                                    Download
                                </a>
                            @endif

                            <a href="{{ route('applications.edit', $application->id) }}"
                                class="flex items-center gap-1 px-3 py-1.5 bg-blue-500 text-white rounded-lg text-xs font-medium hover:bg-blue-600 transition">
                                <!-- Edit Icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 4h2m-1 0v16m7-8H5" />
                                </svg>
                                Edit
                            </a>

                            <form action="{{ route('applications.destroy', $application->id) }}" method="POST"
                                class="inline delete-form">
                                @csrf @method('DELETE')
                                <button type="button"
                                    class="flex items-center gap-1 px-3 py-1.5 bg-red-500 text-white rounded-lg text-xs font-medium hover:bg-red-600 transition delete-btn">
                                    <!-- Trash Icon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="text-center text-gray-400 py-6">Belum ada data lamaran</div>
                @endforelse
            </div>

            <!-- Bulk Delete & Pagination -->
            <div class="flex justify-end mt-4">
                <div>
                    {{ $applications->links() }}
                </div>
            </div>
        </form>
    </div>

    <!-- Script -->
    <script>
        const selectAll = document.getElementById('selectAll');
        const checkboxes = document.querySelectorAll('input[name="ids[]"]');
        const bulkDeleteForm = document.getElementById('bulkDeleteForm');

        if (selectAll) {
            selectAll.addEventListener('change', function(e) {
                checkboxes.forEach(cb => cb.checked = e.target.checked);
                toggleBulkDelete();
            });
        }

        checkboxes.forEach(cb => cb.addEventListener('change', toggleBulkDelete));

        function toggleBulkDelete() {
            const checkedCount = Array.from(checkboxes).filter(cb => cb.checked).length;
            if (checkedCount > 0) {
                bulkDeleteForm.classList.remove('hidden');
            } else {
                bulkDeleteForm.classList.add('hidden');
            }
        }
    </script>
@endsection
