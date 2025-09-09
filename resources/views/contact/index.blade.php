@extends('layouts.app', ['title' => 'Contact Management'])

@section('content')
    <div class="max-w-7xl mx-auto">
        <!-- Card Container -->
        <div class="bg-white rounded-2xl shadow-lg floating-card p-6 space-y-6">
            <!-- Header -->
            <div class="flex items-center justify-between border-b border-emerald-100 pb-4">
                <h1 class="text-2xl font-bold text-emerald-700 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-emerald-600" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    Contact Management
                </h1>
            </div>

            <!-- Search & Add -->
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 mb-4">
                <div class="text-left">
                    <form method="GET" action="{{ route('contact.index') }}" class="flex items-center gap-2">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari kontak..."
                            class="text-left w-full md:w-64 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                        <button type="submit"
                            class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition">
                            Search
                        </button>
                    </form>
                </div>

                <div class="md:text-right">
                    <a href="{{ route('contact.create') }}"
                        class="inline-flex items-center justify-center px-4 py-2 bg-emerald-600 text-white rounded-xl shadow-md hover:bg-emerald-700 transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Add New Contact
                    </a>
                </div>
            </div>

            <!-- Desktop Table -->
            <div class="overflow-x-auto hidden md:block">
                <table class="min-w-full text-sm text-left border-collapse">
                    <thead>
                        <tr class="bg-emerald-50 text-emerald-800 font-semibold">
                            <th class="px-4 py-3 border-b border-emerald-100">ID</th>
                            <th class="px-4 py-3 border-b border-emerald-100">Email DPP</th>
                            <th class="px-4 py-3 border-b border-emerald-100">Email DPD</th>
                            <th class="px-4 py-3 border-b border-emerald-100">Alamat</th>
                            <th class="px-4 py-3 border-b border-emerald-100">No Telepon</th>
                            <th class="px-4 py-3 border-b border-emerald-100 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($contacts as  $index => $contact)
                            <tr class="hover:bg-gray-50 border-b border-emerald-50">
                                <td class="px-4 py-3">{{ $index + 1 }}</td>
                                <td class="px-4 py-3">{{ $contact->email_dpp }}</td>
                                <td class="px-4 py-3">{{ $contact->email_dpd }}</td>
                                <td class="px-4 py-3">{{ Str::limit($contact->alamat, 50) }}</td>
                                <td class="px-4 py-3">{{ $contact->notlp }}</td>
                                <td class="px-4 py-2 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('contact.edit', $contact->id) }}"
                                            class="px-3 py-1 flex items-center gap-1 rounded-lg bg-green-100 text-green-600 hover:bg-green-200 text-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                fill="currentColor" viewBox="0 0 24 24">
                                                <path
                                                    d="m7 17.013 4.413-.015 9.632-9.54c.378-.378.586-.88.586-1.414s-.208-1.036-.586-1.414l-1.586-1.586c-.756-.756-2.075-.752-2.825-.003L7 12.583zM18.045 4.458l1.589 1.583-1.597 1.582-1.586-1.585zM9 13.417l6.03-5.973 1.586 1.586-6.029 5.971L9 15.006z" />
                                                <path
                                                    d="M5 21h14c1.103 0 2-.897 2-2v-8.668l-2 2V19H8.158c-.026 0-.053.01-.079.01-.033 0-.066-.009-.1-.01H5V5h6.847l2-2H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2" />
                                            </svg>
                                            Edit
                                        </a>
                                        <form action="{{ route('contact.destroy', $contact->id) }}" method="POST"
                                            class="inline-block form-delete">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button"
                                                class="btn-delete px-3 py-1 flex items-center gap-1 rounded-lg bg-red-100 text-red-600 hover:bg-red-200 text-sm"
                                                data-action="{{ route('contact.destroy', $contact->id) }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                    fill="currentColor" viewBox="-3 -2 24 24">
                                                    <path
                                                        d="M6 2V1a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v1h4a2 2 0 0 1 2 2v1a2 2 0 0 1-2 2h-.133l-.68 10.2a3 3 0 0 1-2.993 2.8H5.826a3 3 0 0 1-2.993-2.796L2.137 7H2a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2zm10 2H2v1h14zM4.141 7l.687 10.068a1 1 0 0 0 .998.932h6.368a1 1 0 0 0 .998-.934L13.862 7zM7 8a1 1 0 0 1 1 1v7a1 1 0 0 1-2 0V9a1 1 0 0 1 1-1m4 0a1 1 0 0 1 1 1v7a1 1 0 0 1-2 0V9a1 1 0 0 1 1-1" />
                                                </svg>
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-6 text-center text-gray-500">Belum ada data kontak.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="grid gap-4 md:hidden">
                @forelse($contacts as $contact)
                    <div class="bg-white border border-emerald-100 rounded-2xl shadow p-5 space-y-4">

                        <!-- Header -->
                        <h2 class="text-lg font-semibold text-emerald-700">
                            Kontak #{{ $contact->id }}
                        </h2>

                        <!-- Body -->
                        <div class="grid grid-cols-2 gap-4 text-sm">
                            <div>
                                <p class="text-gray-500 font-medium">Email DPP</p>
                                <p class="text-gray-800">{{ $contact->email_dpp }}</p>
                            </div>

                            <div>
                                <p class="text-gray-500 font-medium">Phone</p>
                                <p class="text-gray-800">{{ $contact->notlp }}</p>
                            </div>

                            <div class="col-span-2">
                                <p class="text-gray-500 font-medium">Alamat</p>
                                <p class="text-gray-800">{{ Str::limit($contact->alamat, 60) }}</p>
                            </div>

                            <div class="col-span-2">
                                <p class="text-gray-500 font-medium">Email DPD</p>
                                <p class="text-gray-800">{{ $contact->email_dpd }}</p>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="flex items-center justify-end gap-3 pt-3 border-t border-gray-100">
                            <a href="{{ route('contact.edit', $contact->id) }}"
                                class="inline-flex items-center gap-2 px-3 py-2 flex items-center gap-1 rounded-lg text-sm font-medium text-white bg-emerald-600 hover:bg-emerald-700 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="m7 17.013 4.413-.015 9.632-9.54c.378-.378.586-.88.586-1.414s-.208-1.036-.586-1.414l-1.586-1.586c-.756-.756-2.075-.752-2.825-.003L7 12.583zM18.045 4.458l1.589 1.583-1.597 1.582-1.586-1.585zM9 13.417l6.03-5.973 1.586 1.586-6.029 5.971L9 15.006z" />
                                    <path
                                        d="M5 21h14c1.103 0 2-.897 2-2v-8.668l-2 2V19H8.158c-.026 0-.053.01-.079.01-.033 0-.066-.009-.1-.01H5V5h6.847l2-2H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2" />
                                </svg>
                                Edit
                            </a>

                            <form action="{{ route('contact.destroy', $contact->id) }}" method="POST"
                                class="inline-block form-delete">
                                @csrf
                                @method('DELETE')
                                <button type="button"
                                    class="inline-flex items-center gap-2 px-3 py-2 flex items-center gap-1 rounded-lg text-sm font-medium text-white bg-red-600 hover:bg-red-700 transition btn-delete"
                                    data-action="{{ route('contact.destroy', $contact->id) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                        fill="currentColor" viewBox="-3 -2 24 24">
                                        <path
                                            d="M6 2V1a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v1h4a2 2 0 0 1 2 2v1a2 2 0 0 1-2 2h-.133l-.68 10.2a3 3 0 0 1-2.993 2.8H5.826a3 3 0 0 1-2.993-2.796L2.137 7H2a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2zm10 2H2v1h14zM4.141 7l.687 10.068a1 1 0 0 0 .998.932h6.368a1 1 0 0 0 .998-.934L13.862 7zM7 8a1 1 0 0 1 1 1v7a1 1 0 0 1-2 0V9a1 1 0 0 1 1-1m4 0a1 1 0 0 1 1 1v7a1 1 0 0 1-2 0V9a1 1 0 0 1 1-1" />
                                    </svg>
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="text-center text-gray-500 py-6">Belum ada data kontak.</div>
                @endforelse
            </div>

            <div class="mt-4">
                {{ $contacts->links() }}
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
