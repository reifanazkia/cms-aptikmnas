@extends('layouts.app', ['title' => 'Daftar Agenda'])

@section('content')
    <div class="bg-white rounded-xl p-6 space-y-6">
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
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-emerald-700">Daftar Agenda</h1>
                <p class="text-sm text-emerald-600">Kelola semua agenda kegiatan Anda</p>
            </div>
        </div>

        <!-- Filter -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:items-center">
            <div class="w-[160px] md:w-full sm:w-auto relative">
                <select id="agendaFilter"
                    class="appearance-none w-full sm:w-auto rounded-lg px-4 py-3 pr-10 text-sm text-center border border-gray-300 focus:ring-emerald-500 focus:border-emerald-500">
                    <option value="">Semua Lokasi</option>
                    @foreach ($agendas->pluck('location')->unique() as $loc)
                        <option value="{{ $loc }}">{{ $loc }}</option>
                    @endforeach
                </select>
                <div class="pointer-events-none absolute top-3.5 left-27 flex items-center px-3 text-gray-700">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>
            </div>
            <div class="text-left md:text-right mt-2">
                <a href="{{ route('agenda.create') }}"
                    class="px-4 py-3 rounded-lg bg-emerald-600 text-white font-semibold hover:bg-emerald-700 transition">
                    + Tambah Agenda
                </a>
            </div>
        </div>

        <!-- Tabel Desktop -->
        <div class="hidden sm:block overflow-x-auto bg-white shadow rounded-lg">
            <table class="w-full text-sm text-left border border-gray-200">
                <thead class="bg-emerald-600 text-white">
                    <tr>
                        <th class="px-4 py-2 text-center">No</th>
                        <th class="px-4 py-2 text-center">Gambar</th>
                        <th class="px-4 py-2 text-center">Judul</th>
                        <th class="px-4 py-2 text-center">Penyelenggara</th>
                        <th class="px-4 py-2 text-center">Lokasi</th>
                        <th class="px-4 py-2 text-center">Tanggal</th>
                        <th class="px-4 py-2 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody id="agendaTable">
                    @forelse ($agendas as $index => $agenda)
                        <tr class="agenda-row hover:bg-gray-50" data-location="{{ $agenda->location }}">
                            <td class="px-4 py-2 text-center">{{ $agendas->firstItem() + $index }}</td>
                            <td class="px-4 py-2 text-center">
                                @if ($agenda->image)
                                    <img src="{{ asset('storage/agenda/' . $agenda->image) }}" alt="Agenda Image"
                                        class="w-16 h-16 object-cover rounded">
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>
                            <td class="px-4 py-2 text-center">{{ $agenda->title }}</td>
                            <td class="px-4 py-2 text-center">{{ $agenda->event_organizer ?? '-' }}</td>
                            <td class="px-4 py-2 text-center">{{ $agenda->location ?? '-' }}</td>
                            <td class="px-4 py-2 text-center">
                                {{ \Carbon\Carbon::parse($agenda->start_datetime)->format('d M Y H:i') }}
                            </td>
                            <td class="px-4 py-2 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('agenda.edit', $agenda->id) }}"
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

                                    <form action="{{ route('agenda.destroy', $agenda->id) }}" method="POST"
                                        class="delete-form inline" id="delete-form-desktop-{{ $agenda->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" onclick="confirmDelete(event, 'desktop', {{ $agenda->id }})"
                                            class="delete-btn flex items-center gap-1 px-3 py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                fill="currentColor" viewBox="-3 -2 24 24">
                                                <path
                                                    d="M6 2V1a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v1h4a2 2 0 0 1 2 2v1a2 2 0 0 1-2 2h-.133l-.68 10.2a3 3 0 0 1-2.993 2.8H5.826a3 3 0 0 1-2.993-2.796L2.137 7H2a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2zm10 2H2v1h14zM4.141 7l.687 10.068a1 1 0 0 0 .998.932h6.368a1 1 0 0 0 .998-.934L13.862 7zM7 8a1 1 0 0 1 1 1v7a1 1 0 0 1-2 0V9a1 1 0 0 1 1-1m4 0a1 1 0 0 1 1 1v7a1 1 0 0 1-2 0V9a1 1 0 0 1 1-1" />
                                            </svg>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-4 text-center text-gray-500">Belum ada agenda.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Card Mobile -->
        <div class="sm:hidden space-y-4">
            @forelse ($agendas as $agenda)
                <div class="agenda-row p-4 border border-gray-200 rounded-lg shadow-sm"
                    data-location="{{ $agenda->location }}">
                    @if ($agenda->image)
                        <img src="{{ asset('storage/agenda/' . $agenda->image) }}" alt="Agenda Image"
                            class="w-full h-40 object-cover rounded mb-2">
                    @endif

                    <h2 class="text-lg font-bold text-emerald-700 mb-1">{{ $agenda->title }}</h2>

                    <div class="text-sm text-gray-600 space-y-1">
                        <p>Penyelenggara: {{ $agenda->event_organizer ?? '-' }}</p>
                        <p>Lokasi: <span class="font-medium">{{ $agenda->location ?? '-' }}</span></p>
                        <p>Tanggal: <span
                                class="font-medium">{{ \Carbon\Carbon::parse($agenda->start_datetime)->format('d M Y H:i') }}</span>
                        </p>
                    </div>

                    <div class="flex gap-2 mt-3">
                        <a href="{{ route('agenda.edit', $agenda->id) }}"
                            class="flex-1 flex items-center justify-center gap-1 px-3 py-2 bg-green-100 text-green-600 rounded-lg hover:bg-green-200">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path
                                    d="m7 17.013 4.413-.015 9.632-9.54c.378-.378.586-.88.586-1.414s-.208-1.036-.586-1.414l-1.586-1.586c-.756-.756-2.075-.752-2.825-.003L7 12.583zM18.045 4.458l1.589 1.583-1.597 1.582-1.586-1.585zM9 13.417l6.03-5.973 1.586 1.586-6.029 5.971L9 15.006z" />
                                <path
                                    d="M5 21h14c1.103 0 2-.897 2-2v-8.668l-2 2V19H8.158c-.026 0-.053.01-.079.01-.033 0-.066-.009-.1-.01H5V5h6.847l2-2H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2" />
                            </svg>
                            Edit
                        </a>
                        <form action="{{ route('agenda.destroy', $agenda->id) }}" method="POST"
                            class="delete-form flex-1" id="delete-form-mobile-{{ $agenda->id }}">
                            @csrf
                            @method('DELETE')
                            <button type="button" onclick="confirmDelete(event, 'mobile', {{ $agenda->id }})"
                                class="w-full flex items-center justify-center gap-1 px-3 py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200">
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
                <p class="text-center text-gray-500">Belum ada agenda.</p>
            @endforelse
        </div>

        <!-- Pagination -->
        <div>
            {{ $agendas->links() }}
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(event, device, id) {
            event.preventDefault();
            Swal.fire({
                title: 'Yakin hapus agenda ini?',
                text: "Data yang dihapus tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit form berdasarkan device (desktop atau mobile)
                    document.getElementById('delete-form-' + device + '-' + id).submit();
                }
            });
        }

        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}',
                timer: 2000,
                showConfirmButton: false
            });
        @endif

        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: '{{ session('error') }}',
            });
        @endif

        // Filter functionality
        document.getElementById('agendaFilter').addEventListener('change', function() {
            let selected = this.value;
            document.querySelectorAll('.agenda-row').forEach(row => {
                if (selected === '' || row.dataset.location === selected) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>
@endsection
