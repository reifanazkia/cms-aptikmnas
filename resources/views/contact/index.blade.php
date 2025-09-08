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
                    <form method="GET" action="{{ route('contact.index') }}"
                        class="flex items-center gap-2">
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
                        @forelse($contacts as $contact)
                            <tr class="hover:bg-gray-50 border-b border-emerald-50">
                                <td class="px-4 py-3">{{ $contact->id }}</td>
                                <td class="px-4 py-3">{{ $contact->email_dpp }}</td>
                                <td class="px-4 py-3">{{ $contact->email_dpd }}</td>
                                <td class="px-4 py-3">{{ Str::limit($contact->alamat, 50) }}</td>
                                <td class="px-4 py-3">{{ $contact->notlp }}</td>
                                <td class="px-4 py-2 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('contact.edit', $contact->id) }}"
                                            class="px-3 py-1 rounded-lg bg-green-100 text-green-600 hover:bg-green-200 text-sm">Edit</a>
                                        <form action="{{ route('contact.destroy', $contact->id) }}" method="POST"
                                            class="inline-block form-delete">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button"
                                                class="btn-delete px-3 py-1 rounded-lg bg-red-100 text-red-600 hover:bg-red-200 text-sm"
                                                data-action="{{ route('contact.destroy', $contact->id) }}">
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

            <!-- Mobile Card -->
            <div class="grid gap-4 md:hidden">
                @forelse($contacts as $contact)
                    <div class="border border-emerald-100 rounded-xl p-4 shadow-sm bg-white space-y-2">
                        <div class="flex justify-between items-center">
                            <h2 class="font-semibold text-emerald-700">#{{ $contact->id }}</h2>
                            <div class="flex gap-2">
                                <a href="{{ route('contact.edit', $contact->id) }}"
                                    class="px-3 py-1 rounded-lg bg-green-100 text-green-600 hover:bg-green-200 text-sm">Edit</a>
                                <form action="{{ route('contact.destroy', $contact->id) }}" method="POST"
                                    class="inline-block form-delete">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button"
                                        class="btn-delete px-3 py-1 rounded-lg bg-red-100 text-red-600 hover:bg-red-200 text-sm"
                                        data-action="{{ route('contact.destroy', $contact->id) }}">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                        <p><span class="font-medium">Email DPP:</span> {{ $contact->email_dpp }}</p>
                        <p><span class="font-medium">Email DPD:</span> {{ $contact->email_dpd }}</p>
                        <p><span class="font-medium">Alamat:</span> {{ Str::limit($contact->alamat, 50) }}</p>
                        <p><span class="font-medium">No Telepon:</span> {{ $contact->notlp }}</p>
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
