@extends('layouts.app', ['title' => 'Lamaran Kerja'])

@section('content')
    <div class="bg-white p-8 rounded-xl max-w-7xl mx-auto space-y-6">

        <!-- Header -->
        <h1 class="text-2xl font-bold text-emerald-700">Daftar Lamaran Kerja</h1>

        <!-- Search -->
        <div class="flex items-center justify-between">
            <form method="GET" class="flex flex-col sm:flex-row items-start sm:items-center gap-2">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama..."
                    class="w-full sm:w-64 px-4 py-2 border border-gray-300 rounded-lg focus:ring-emerald-500 focus:border-emerald-500 transition shadow-sm">
                <button type="submit"
                    class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition shadow-sm flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-4.35-4.35M17 11a6 6 0 11-12 0 6 6 0 0112 0z" />
                    </svg>
                    Cari
                </button>
            </form>

            <div>
                <a href="{{ route('applications.create') }}"
                    class="px-4 py-3 bg-emerald-600 text-white rounded-xl hover:bg-emerald-700 transition-all shadow-md flex items-center gap-1 text-sm font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Lamaran
                </a>
            </div>
        </div>

        <!-- Table -->
        <form method="POST" action="{{ route('applications.bulk-delete') }}">
            @csrf
            @method('DELETE')

            <div class="overflow-x-auto bg-white rounded-2xl shadow-lg border border-emerald-100">
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
                                        class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 text-xs font-medium transition flex items-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15.232 5.232l3.536 3.536M9 11l6-6 3.536 3.536-6 6H9v-3.536z" />
                                        </svg>
                                        Edit
                                    </a>
                                    <form action="{{ route('applications.destroy', $application->id) }}" method="POST"
                                        class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" onclick="return confirm('Hapus lamaran ini?')"
                                            class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 text-xs font-medium transition flex items-center gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-1 12a2 2 0 01-2 2H8a2 2 0 01-2-2L5 7m5-4h4a2 2 0 012 2v2H8V5a2 2 0 012-2z" />
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

            <!-- Bulk Delete & Pagination -->
            <div class="flex flex-col sm:flex-row justify-between items-center mt-4 gap-2">
                <button id="bulkDeleteBtn" type="submit"
                    class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 hidden transition flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 7l-1 12a2 2 0 01-2 2H8a2 2 0 01-2-2L5 7m5-4h4a2 2 0 012 2v2H8V5a2 2 0 012-2z" />
                    </svg>
                    Hapus Terpilih
                </button>

                <div class="mt-2 sm:mt-0">
                    {{ $applications->links() }}
                </div>
            </div>

        </form>
    </div>

    <script>
        const selectAll = document.getElementById('selectAll');
        const checkboxes = document.querySelectorAll('input[name="ids[]"]');
        const bulkDeleteBtn = document.getElementById('bulkDeleteBtn');

        selectAll.addEventListener('change', function(e) {
            checkboxes.forEach(cb => cb.checked = e.target.checked);
            toggleBulkDelete();
        });

        checkboxes.forEach(cb => cb.addEventListener('change', toggleBulkDelete));

        function toggleBulkDelete() {
            const anyChecked = Array.from(checkboxes).some(cb => cb.checked);
            bulkDeleteBtn.classList.toggle('hidden', !anyChecked);
        }
    </script>
@endsection
