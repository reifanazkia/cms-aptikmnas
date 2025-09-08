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

                <!-- Add Button -->
                <a href="{{ route('applications.create') }}"
                    class="flex items-center gap-1 px-4 py-2 bg-emerald-500 text-white rounded-lg text-sm font-medium hover:bg-emerald-600 transition text-center">
                    <!-- Plus Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Lamaran
                </a>
            </div>
        </div>


        <!-- Tabel untuk Desktop -->
        <form id="bulkDeleteForm" method="POST" action="{{ route('applications.bulk-delete') }}">
            @csrf
            @method('DELETE')

            <!-- Table View -->
            <div class="overflow-x-auto bg-white rounded-2xl shadow-lg border border-emerald-100 hidden md:block">
                <table class="min-w-full text-sm divide-y divide-emerald-100">
                    <thead class="bg-emerald-100 text-emerald-800 uppercase text-xs font-semibold">
                        <tr>
                            <th class="px-4 py-3 text-center">
                                <input type="checkbox" id="selectAll" class="rounded">
                            </th>
                            <th class="px-4 py-3 text-center">Posisi</th>
                            <th class="px-4 py-3 text-center">Nama</th>
                            <th class="px-4 py-3 text-center">Email</th>
                            <th class="px-4 py-3 text-center">Telepon</th>
                            <th class="px-4 py-3 text-center">File</th>
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
                                <td class="px-4 py-2 text-center">{{ $application->no_telepon }}</td>
                                <td class="px-4 py-2 text-center">
                                    @if ($application->file)
                                        <a href="{{ route('applications.downloadFile', $application->id) }}"
                                            class="inline-block px-2 py-1 bg-emerald-100 text-emerald-800 rounded text-xs font-medium hover:bg-emerald-200 transition">
                                            Download
                                        </a>
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif
                                </td>
                                <td class="px-4 py-2 text-center flex justify-center gap-2">
                                    <a href="{{ route('applications.edit', $application->id) }}"
                                        class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 text-xs font-medium transition">
                                        Edit
                                    </a>
                                    <form action="{{ route('applications.destroy', $application->id) }}" method="POST"
                                        class="inline delete-form">
                                        @csrf @method('DELETE')
                                        <button type="button"
                                            class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 text-xs font-medium transition delete-btn">
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
            <div class="flex flex-col sm:flex-row justify-between items-center mt-4 gap-2">
                <button id="bulkDeleteBtn" type="button"
                    class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 hidden transition flex items-center gap-1">
                    Hapus Terpilih
                </button>

                <div class="mt-2 sm:mt-0">
                    {{ $applications->links() }}
                </div>
            </div>
        </form>
    </div>

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const selectAll = document.getElementById('selectAll');
        const checkboxes = document.querySelectorAll('input[name="ids[]"]');
        const bulkDeleteBtn = document.getElementById('bulkDeleteBtn');
        const bulkDeleteForm = document.getElementById('bulkDeleteForm');
        const deleteBtns = document.querySelectorAll('.delete-btn');

        if (selectAll) {
            selectAll.addEventListener('change', function(e) {
                checkboxes.forEach(cb => cb.checked = e.target.checked);
                toggleBulkDelete();
            });
        }

        checkboxes.forEach(cb => cb.addEventListener('change', toggleBulkDelete));

        function toggleBulkDelete() {
            const anyChecked = Array.from(checkboxes).some(cb => cb.checked);
            bulkDeleteBtn.classList.toggle('hidden', !anyChecked);
        }

        // Confirm delete single
        deleteBtns.forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const form = this.closest('form');
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data lamaran ini akan dihapus!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc2626',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });

        // Confirm bulk delete
        if (bulkDeleteBtn) {
            bulkDeleteBtn.addEventListener('click', function() {
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Semua data lamaran terpilih akan dihapus!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc2626',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        bulkDeleteForm.submit();
                    }
                });
            });
        }
    </script>
@endsection
