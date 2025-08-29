@extends('layouts.app', ['title' => 'Detail Kegiatan'])

@section('content')
    <div class="space-y-6">
        <!-- Header Detail -->
        <div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-md p-6 flex items-center justify-between floating-card">
            <div class="flex items-center space-x-4">
                <div class="p-3 bg-emerald-100 rounded-full">
                    <i class="fas fa-calendar-alt text-2xl text-emerald-600"></i>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-emerald-700">{{ $kegiatan->title }}</h1>
                    <p class="text-emerald-600 text-sm">{{ $kegiatan->created_at->format('d F Y H:i') }}</p>
                </div>
            </div>
            <a href="{{ route('kegiatan.index') }}"
                class="px-4 py-2 rounded-lg bg-emerald-100 hover:bg-emerald-200 text-emerald-800 transition-all flex items-center space-x-2">
                <i class="fas fa-arrow-left"></i>
                <span>Kembali</span>
            </a>
        </div>

        <div class="grid lg:grid-cols-3 gap-6">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Gambar Kegiatan -->
                <div
                    class="bg-white/80 backdrop-blur-sm rounded-xl shadow-md overflow-hidden floating-card animate-slide-up ">
                    <div class="group">
                        @if ($kegiatan->image)
                            <img src="{{ asset('storage/' . $kegiatan->image) }}" alt="{{ $kegiatan->title }}"
                                class="w-full h-80 object-cover transition-transform duration-500 group-hover:scale-105">
                        @else
                            <div class="h-80 bg-emerald-50 flex items-center justify-center">
                                <i class="fas fa-image text-6xl text-emerald-300"></i>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Deskripsi -->
                <div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-md p-6 floating-card">
                    <h2 class="text-xl font-semibold text-emerald-700 mb-2 flex items-center">
                        <i class="fas fa-info-circle mr-2"></i>
                        Deskripsi Kegiatan
                    </h2>
                    <p class="text-gray-700 leading-relaxed">
                        {{ $kegiatan->description ?? 'Tidak ada deskripsi untuk kegiatan ini.' }}
                    </p>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Action Buttons -->
                <div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-md p-6 floating-card">
                    <h3 class="text-lg font-semibold text-emerald-700 mb-3 flex items-center">
                        <i class="fas fa-cogs mr-2"></i> Aksi
                    </h3>
                    <div class="space-y-2">
                        <a href="{{ route('kegiatan.edit', $kegiatan->id) }}"
                            class="w-full px-4 py-2 bg-gradient-to-r from-emerald-400 to-teal-500 text-white rounded-lg hover:scale-105 flex items-center justify-center space-x-2 transition-all">
                            <i class="fas fa-edit"></i>
                            <span>Edit</span>
                        </a>

                        <button type="button"
                            class="w-full px-4 py-2 bg-gradient-to-r from-red-400 to-rose-500 text-white rounded-lg hover:scale-105 flex items-center justify-center space-x-2 transition-all delete-btn"
                            data-id="{{ $kegiatan->id }}" data-title="{{ $kegiatan->title }}">
                            <i class="fas fa-trash"></i>
                            <span>Hapus</span>
                        </button>
                    </div>
                </div>

                <!-- Info Summary -->
                <div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-md p-6 floating-card">
                    <h3 class="text-lg font-semibold text-emerald-700 mb-3 flex items-center">
                        <i class="fas fa-info-circle mr-2"></i> Informasi
                    </h3>
                    <div class="space-y-2">
                        <div class="flex justify-between">
                            <span>ID Kegiatan</span>
                            <span class="font-semibold">#{{ $kegiatan->id }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Kategori</span>
                            <span class="font-semibold text-emerald-600">{{ $kegiatan->category->name }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Dibuat</span>
                            <span class="font-semibold">{{ $kegiatan->created_at->format('d/m/Y H:i') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Terakhir Update</span>
                            <span class="font-semibold">{{ $kegiatan->updated_at->format('d/m/Y H:i') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Hapus -->
        <div id="deleteModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden items-center justify-center z-50">
            <div class="bg-white rounded-xl shadow-2xl w-full max-w-md p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-bold text-red-600 flex items-center">
                        <i class="fas fa-exclamation-triangle mr-2"></i> Konfirmasi Hapus
                    </h3>
                    <button type="button" class="text-gray-400 hover:text-gray-600 closeModal">&times;</button>
                </div>
                <p>Apakah Anda yakin ingin menghapus kegiatan "<span id="deleteTitle" class="font-semibold"></span>"?</p>
                <div class="mt-4 flex justify-end space-x-2">
                    <button class="px-4 py-2 bg-gray-100 rounded-lg closeModal">Batal</button>
                    <button id="confirmDelete" class="px-4 py-2 bg-red-500 text-white rounded-lg">Hapus</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Modal delete
        const deleteModal = document.getElementById('deleteModal');
        const deleteBtn = document.querySelector('.delete-btn');
        const closeButtons = document.querySelectorAll('.closeModal');
        const confirmDeleteBtn = document.getElementById('confirmDelete');

        if (deleteBtn) {
            deleteBtn.addEventListener('click', function() {
                document.getElementById('deleteTitle').textContent = this.dataset.title;
                confirmDeleteBtn.dataset.id = this.dataset.id;
                deleteModal.classList.remove('hidden');
                deleteModal.classList.add('flex');
            });
        }

        closeButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                deleteModal.classList.add('hidden');
                deleteModal.classList.remove('flex');
            });
        });

        deleteModal.addEventListener('click', (e) => {
            if (e.target === deleteModal) {
                deleteModal.classList.add('hidden');
                deleteModal.classList.remove('flex');
            }
        });

        confirmDeleteBtn.addEventListener('click', function() {
            const id = this.dataset.id;
            fetch(`/kegiatan/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Content-Type': 'application/json',
                    }
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) window.location.href = "{{ route('kegiatan.index') }}";
                    else alert('Gagal menghapus kegiatan');
                });
        });
    </script>
@endsection
