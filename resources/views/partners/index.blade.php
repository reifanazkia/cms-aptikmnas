@extends('layouts.app', ['title' => 'Daftar Partner'])

@section('content')
    <div class="max-w-7xl mx-auto">
        <div class="bg-white rounded-2xl shadow-lg floating-card p-6 space-y-6">

            <!-- Header -->
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 border-b border-emerald-100 pb-4">
                <h1 class="text-2xl font-bold text-emerald-700 flex items-center gap-2">
                    <svg class="w-8 h-8 text-emerald-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="M21.71 8.71c1.25-1.25.68-2.71 0-3.42l-3-3c-1.26-1.25-2.71-.68-3.42 0L13.59 4H11C9.1 4 8 5 7.44 6.15L3 10.59v4l-.71.7c-1.25 1.26-.68 2.71 0 3.42l3 3c.54.54 1.12.74 1.67.74c.71 0 1.36-.35 1.75-.74l2.7-2.71H15c1.7 0 2.56-1.06 2.87-2.1c1.13-.3 1.75-1.16 2-2C21.42 14.5 22 13.03 22 12V9h-.59zM20 12c0 .45-.19 1-1 1h-1v1c0 .45-.19 1-1 1h-1v1c0 .45-.19 1-1 1h-4.41l-3.28 3.28c-.31.29-.49.12-.6.01l-2.99-2.98c-.29-.31-.12-.49-.01-.6L5 15.41v-4l2-2V11c0 1.21.8 3 3 3s3-1.79 3-3h7zm.29-4.71L18.59 9H11v2c0 .45-.19 1-1 1s-1-.55-1-1V8c0-.46.17-2 2-2h3.41l2.28-2.28c.31-.29.49-.12.6-.01l2.99 2.98c.29.31.12.49.01.6" />
                    </svg>
                    Daftar Partner
                </h1>
                <a href="{{ route('partners.create') }}"
                    class="inline-flex items-center px-4 py-3 bg-emerald-600 text-white rounded-xl shadow-md hover:bg-emerald-700 transition-all duration-200 text-sm font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Partner
                </a>
            </div>

            <!-- Alerts -->
            @if (session('success'))
                <div x-data="{ show: true }" x-show="show" x-transition
                    class="flex items-center justify-between bg-emerald-100 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-lg shadow-md">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span class="font-medium">{{ session('success') }}</span>
                    </div>
                    <button @click="show = false" class="text-emerald-600 hover:text-emerald-800 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            @endif

            <!-- Desktop Table -->
            <div class="hidden sm:block overflow-x-auto rounded-lg border border-emerald-100">
                <table class="min-w-full text-sm text-left border-collapse">
                    <thead class="bg-emerald-50 text-emerald-800 font-semibold">
                        <tr>
                            <th class="px-4 py-3 text-center border-b border-emerald-100">No</th>
                            <th class="px-4 py-3 text-center border-b border-emerald-100">Nama</th>
                            <th class="px-4 py-3 text-center border-b border-emerald-100">Website</th>
                            <th class="px-4 py-3 text-center border-b border-emerald-100">Deskripsi</th>
                            <th class="px-4 py-3 text-center border-b border-emerald-100">Gambar</th>
                            <th class="px-4 py-3 text-center border-b border-emerald-100">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($partners as $partner)
                            <tr class="hover:bg-gray-50 border-b border-emerald-50">
                                <td class="px-4 py-2 text-center">{{ $loop->iteration }}</td>
                                <td class="px-4 py-2 text-center">{{ $partner->name }}</td>
                                <td class="px-4 py-2 text-center">
                                    @if ($partner->web_address)
                                        <a href="{{ $partner->web_address }}" target="_blank"
                                            class="text-emerald-600 hover:underline">
                                            {{ $partner->web_address }}
                                        </a>
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif
                                </td>
                                <td class="px-4 py-2 text-center">
                                    {{ Str::limit(strip_tags($partner->description), 50) }}
                                </td>

                                <td class="px-4 py-2 text-center">
                                    @if ($partner->image)
                                        <img src="{{ asset('storage/' . $partner->image) }}"
                                            class="w-20 h-20 object-cover mx-auto rounded-lg" alt="Gambar Partner">
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif
                                </td>
                                <td class="px-4 py-2 text-center">
                                    <div class="flex justify-center items-center gap-2">
                                        <a href="{{ route('partners.edit', $partner->id) }}"
                                            class="px-4 py-2 bg-green-100 text-green-500 rounded-md hover:bg-green-200 text-xs font-medium inline-flex items-center gap-1.5">
                                            Edit
                                        </a>
                                        <form action="{{ route('partners.destroy', $partner->id) }}" method="POST"
                                            class="inline-block delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button"
                                                class="delete-button px-4 py-2 bg-red-100 text-red-700 rounded-md hover:bg-red-200 text-xs font-medium inline-flex items-center gap-1.5">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-6 text-center text-gray-500">
                                    <div class="flex flex-col items-center gap-2">
                                        <p>Belum ada data partner.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Mobile Cards -->
            <div class="block sm:hidden space-y-4">
                @forelse($partners as $partner)
                    <div class="border border-emerald-100 rounded-xl p-4 shadow-sm bg-white">
                        <div class="flex items-center gap-4">
                            <div>
                                @if ($partner->image)
                                    <img src="{{ asset('storage/' . $partner->image) }}"
                                        class="w-16 h-16 object-cover rounded-lg" alt="Gambar Partner">
                                @else
                                    <div
                                        class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center text-gray-400 text-xs">
                                        No Img
                                    </div>
                                @endif
                            </div>
                            <div class="flex-1">
                                <h2 class="font-semibold text-emerald-700">{{ $partner->name }}</h2>
                                <p class="text-gray-600 text-sm">
                                    {{ Str::limit(strip_tags($partner->description), 60) }}
                                </p>

                                @if ($partner->web_address)
                                    <a href="{{ $partner->web_address }}" target="_blank"
                                        class="text-emerald-600 text-sm hover:underline">{{ $partner->web_address }}</a>
                                @endif
                            </div>
                        </div>
                        <div class="flex justify-end mt-3 gap-2">
                            <a href="{{ route('partners.edit', $partner->id) }}"
                                class="px-3 py-1.5 bg-green-100 text-green-500 rounded-md hover:bg-green-200 text-xs font-medium inline-flex items-center gap-1.5">
                                Edit
                            </a>
                            <form action="{{ route('partners.destroy', $partner->id) }}" method="POST"
                                class="delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="button"
                                    class="delete-button px-3 py-1.5 bg-red-100 text-red-700 rounded-md hover:bg-red-200 text-xs font-medium inline-flex items-center gap-1.5">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-gray-500 py-4">Belum ada data partner.</p>
                @endforelse
            </div>
        </div>
    </div>

    <!-- SweetAlert2 -->
    <script>
        document.querySelectorAll('.delete-button').forEach(button => {
            button.addEventListener('click', function() {
                let form = this.closest('.delete-form');
                Swal.fire({
                    title: 'Yakin hapus?',
                    text: "Data partner akan dihapus permanen!",
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
                })
            });
        });
    </script>
@endsection
