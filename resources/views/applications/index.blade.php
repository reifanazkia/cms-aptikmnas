@extends('layouts.app', ['title' => 'Lamaran Kerja'])

@section('content')
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold text-emerald-700">Daftar Lamaran Kerja</h1>
            <a href="{{ route('applications.create') }}"
                class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700">
                + Tambah Lamaran
            </a>
        </div>

        <!-- Search -->
        <form method="GET" class="flex items-center gap-2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama..."
                class="w-64 px-3 py-2 border rounded-lg focus:ring-emerald-500 focus:border-emerald-500">
            <button class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">Cari</button>
        </form>

        <!-- Table -->
        <form method="POST" action="{{ route('applications.bulk-delete') }}">
            @csrf
            @method('DELETE')

            <div class="overflow-x-auto bg-white rounded-xl shadow">
                <table class="min-w-full text-sm">
                    <thead class="bg-gray-100 text-gray-600">
                        <tr>
                            <th class="px-4 py-2">
                                <input type="checkbox" id="selectAll">
                            </th>
                            <th class="px-4 py-2 text-center">Posisi</th>
                            <th class="px-4 py-2 text-center">Nama</th>
                            <th class="px-4 py-2 text-center">Email</th>
                            <th class="px-4 py-2 text-center">Telepon</th>
                            <th class="px-4 py-2 text-center">File</th>
                            <th class="px-4 py-2 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($applications as $application)
                            <tr class="border-b">
                                <td class="px-4 py-2 text-center">
                                    <input type="checkbox" name="ids[]" value="{{ $application->id }}">
                                </td>
                                <td class="px-4 py-2 text-center">{{ $application->career->position_title ?? '-' }}</td>
                                <td class="px-4 py-2 text-center">{{ $application->nama }}</td>
                                <td class="px-4 py-2 text-center">{{ $application->email }}</td>
                                <td class="px-4 py-2 text-center">{{ $application->no_telepon }}</td>

                                <td class="px-4 py-2">
                                    @if ($application->file)
                                        <a href="{{ route('applications.downloadFile', $application->id) }}"
                                            class="text-emerald-600 hover:underline">Download</a>
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif
                                </td>
                                <td class="px-4 py-2 text-right space-x-2">
                                    <a href="{{ route('applications.edit', $application->id) }}"
                                        class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">Edit</a>
                                    <form action="{{ route('applications.destroy', $application->id) }}" method="POST"
                                        class="inline">
                                        @csrf @method('DELETE')
                                        <button onclick="return confirm('Hapus lamaran ini?')"
                                            class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-4 py-4 text-center text-gray-500">Belum ada data lamaran</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="flex justify-between items-center mt-4">
                <!-- Tombol bulk delete, disembunyikan dulu -->
                <button id="bulkDeleteBtn" type="submit"
                    class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 hidden">
                    Hapus Terpilih
                </button>

                {{ $applications->links() }}
            </div>

        </form>
    </div>

    <script>
        const selectAll = document.getElementById('selectAll');
        const checkboxes = document.querySelectorAll('input[name="ids[]"]');
        const bulkDeleteBtn = document.getElementById('bulkDeleteBtn');

        // Toggle semua checkbox
        selectAll.addEventListener('change', function(e) {
            checkboxes.forEach(cb => cb.checked = e.target.checked);
            toggleBulkDelete();
        });

        // Toggle tombol saat ada perubahan pada checkbox
        checkboxes.forEach(cb => {
            cb.addEventListener('change', toggleBulkDelete);
        });

        function toggleBulkDelete() {
            const anyChecked = Array.from(checkboxes).some(cb => cb.checked);
            bulkDeleteBtn.classList.toggle('hidden', !anyChecked);
        }
    </script>
@endsection
