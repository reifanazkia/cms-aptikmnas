<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Kegiatan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    animation: {
                        'fade-in': 'fadeIn 0.5s ease-in-out',
                        'slide-up': 'slideUp 0.6s ease-out',
                        'bounce-gentle': 'bounceGentle 2s ease-in-out infinite',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: '0', transform: 'translateY(10px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' }
                        },
                        slideUp: {
                            '0%': { opacity: '0', transform: 'translateY(30px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' }
                        },
                        bounceGentle: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-5px)' }
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gradient-to-br from-blue-50 via-white to-purple-50 min-h-screen">
    <!-- Header dengan gradient -->
    <div class="bg-gradient-to-r from-blue-600 via-purple-600 to-pink-600 text-white py-8 shadow-2xl">
        <div class="container mx-auto px-6">
            <div class="flex items-center justify-between animate-fade-in">
                <div class="flex items-center space-x-4">
                    <div class="p-3 bg-white/10 backdrop-blur-sm rounded-full animate-bounce-gentle">
                        <i class="fas fa-calendar-alt text-2xl"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold">Detail Kegiatan</h1>
                        <p class="text-blue-100 mt-1">Informasi lengkap tentang kegiatan</p>
                    </div>
                </div>
                <div class="flex space-x-2">
                    <a href="{{ route('kegiatan.index') }}"
                       class="bg-white/10 hover:bg-white/20 backdrop-blur-sm px-4 py-2 rounded-lg transition-all duration-300 hover:scale-105 flex items-center space-x-2">
                        <i class="fas fa-arrow-left"></i>
                        <span>Kembali</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-6 py-8">
        <!-- Alert Messages -->
        @if(session('success'))
            <div class="bg-gradient-to-r from-green-400 to-emerald-500 text-white px-6 py-4 rounded-xl mb-6 shadow-lg animate-slide-up">
                <div class="flex items-center">
                    <i class="fas fa-check-circle text-xl mr-3"></i>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-gradient-to-r from-red-400 to-rose-500 text-white px-6 py-4 rounded-xl mb-6 shadow-lg animate-slide-up">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-circle text-xl mr-3"></i>
                    <span>{{ session('error') }}</span>
                </div>
            </div>
        @endif

        <div class="grid lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Gambar Kegiatan -->
                <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl overflow-hidden animate-slide-up">
                    @if($kegiatan->image)
                        <div class="relative group">
                            <img src="{{ asset('storage/' . $kegiatan->image) }}"
                                 alt="{{ $kegiatan->title }}"
                                 class="w-full h-80 object-cover transition-transform duration-500 group-hover:scale-105">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </div>
                    @else
                        <div class="h-80 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                            <div class="text-center text-gray-400">
                                <i class="fas fa-image text-6xl mb-4"></i>
                                <p class="text-lg">Tidak ada gambar</p>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Detail Kegiatan -->
                <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl p-8 animate-slide-up">
                    <div class="flex items-start justify-between mb-6">
                        <div>
                            <h1 class="text-3xl font-bold text-gray-800 mb-3">{{ $kegiatan->title }}</h1>
                            <div class="flex items-center space-x-4 text-gray-600">
                                <div class="flex items-center space-x-2">
                                    <i class="fas fa-calendar text-blue-500"></i>
                                    <span>{{ $kegiatan->created_at->format('d F Y') }}</span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <i class="fas fa-clock text-green-500"></i>
                                    <span>{{ $kegiatan->created_at->format('H:i') }} WIB</span>
                                </div>
                            </div>
                        </div>
                        <span class="bg-gradient-to-r from-blue-500 to-purple-600 text-white px-4 py-2 rounded-full text-sm font-semibold shadow-lg">
                            {{ $kegiatan->category->name }}
                        </span>
                    </div>

                    <div class="prose prose-lg max-w-none">
                        <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                            <i class="fas fa-info-circle text-blue-500 mr-2"></i>
                            Deskripsi Kegiatan
                        </h3>
                        <div class="bg-gray-50 p-6 rounded-xl border-l-4 border-blue-500">
                            @if($kegiatan->description)
                                <p class="text-gray-700 leading-relaxed">{{ $kegiatan->description }}</p>
                            @else
                                <p class="text-gray-500 italic">Tidak ada deskripsi untuk kegiatan ini.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Action Buttons -->
                <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl p-6 animate-slide-up">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-cogs text-purple-500 mr-2"></i>
                        Aksi
                    </h3>
                    <div class="space-y-3">
                        <a href="{{ route('kegiatan.edit', $kegiatan->id) }}"
                           class="w-full bg-gradient-to-r from-amber-400 to-orange-500 hover:from-amber-500 hover:to-orange-600 text-white px-4 py-3 rounded-xl transition-all duration-300 hover:scale-105 hover:shadow-lg flex items-center justify-center space-x-2 group">
                            <i class="fas fa-edit group-hover:animate-pulse"></i>
                            <span>Edit Kegiatan</span>
                        </a>
                        <button type="button"
                                class="w-full bg-gradient-to-r from-red-400 to-rose-500 hover:from-red-500 hover:to-rose-600 text-white px-4 py-3 rounded-xl transition-all duration-300 hover:scale-105 hover:shadow-lg flex items-center justify-center space-x-2 group delete-btn"
                                data-id="{{ $kegiatan->id }}"
                                data-title="{{ $kegiatan->title }}">
                            <i class="fas fa-trash group-hover:animate-pulse"></i>
                            <span>Hapus Kegiatan</span>
                        </button>
                    </div>
                </div>

                <!-- Info Summary -->
                <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl p-6 animate-slide-up">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-chart-line text-green-500 mr-2"></i>
                        Informasi
                    </h3>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center py-3 border-b border-gray-100">
                            <span class="text-gray-600">ID Kegiatan</span>
                            <span class="font-semibold text-gray-800">#{{ $kegiatan->id }}</span>
                        </div>
                        <div class="flex justify-between items-center py-3 border-b border-gray-100">
                            <span class="text-gray-600">Kategori</span>
                            <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-semibold">
                                {{ $kegiatan->category->name }}
                            </span>
                        </div>
                        <div class="flex justify-between items-center py-3 border-b border-gray-100">
                            <span class="text-gray-600">Dibuat</span>
                            <span class="font-semibold text-gray-800">{{ $kegiatan->created_at->format('d/m/Y H:i') }}</span>
                        </div>
                        <div class="flex justify-between items-center py-3">
                            <span class="text-gray-600">Terakhir Update</span>
                            <span class="font-semibold text-gray-800">{{ $kegiatan->updated_at->format('d/m/Y H:i') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Navigation -->
                <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl p-6 animate-slide-up">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-compass text-indigo-500 mr-2"></i>
                        Navigasi
                    </h3>
                    <div class="space-y-3">
                        <a href="{{ route('kegiatan.index') }}"
                           class="w-full bg-gradient-to-r from-gray-100 to-gray-200 hover:from-gray-200 hover:to-gray-300 text-gray-800 px-4 py-3 rounded-xl transition-all duration-300 hover:scale-105 flex items-center space-x-2">
                            <i class="fas fa-list"></i>
                            <span>Semua Kegiatan</span>
                        </a>
                        <a href="{{ route('kegiatan.byCategory', $kegiatan->category->id) }}"
                           class="w-full bg-gradient-to-r from-blue-100 to-purple-100 hover:from-blue-200 hover:to-purple-200 text-blue-800 px-4 py-3 rounded-xl transition-all duration-300 hover:scale-105 flex items-center space-x-2">
                            <i class="fas fa-tags"></i>
                            <span>Kegiatan {{ $kegiatan->category->name }}</span>
                        </a>
                        <a href="{{ route('kegiatan.create') }}"
                           class="w-full bg-gradient-to-r from-emerald-100 to-teal-100 hover:from-emerald-200 hover:to-teal-200 text-emerald-800 px-4 py-3 rounded-xl transition-all duration-300 hover:scale-105 flex items-center space-x-2">
                            <i class="fas fa-plus"></i>
                            <span>Tambah Kegiatan Baru</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi Hapus -->
    <div id="deleteModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden items-center justify-center z-50">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full mx-4 animate-slide-up">
            <div class="p-6 border-b border-gray-100">
                <div class="flex items-center justify-between">
                    <h3 class="text-xl font-semibold text-gray-800 flex items-center">
                        <i class="fas fa-exclamation-triangle text-red-500 mr-2"></i>
                        Konfirmasi Hapus
                    </h3>
                    <button type="button" class="text-gray-400 hover:text-gray-600 text-2xl closeModal">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="p-6">
                <p class="text-gray-600 mb-4">
                    Apakah Anda yakin ingin menghapus kegiatan "<span id="deleteTitle" class="font-semibold text-gray-800"></span>"?
                </p>
                <p class="text-red-600 text-sm">
                    <i class="fas fa-info-circle mr-1"></i>
                    Tindakan ini tidak dapat dibatalkan.
                </p>
            </div>
            <div class="flex justify-end space-x-3 p-6 border-t border-gray-100">
                <button type="button"
                        class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 rounded-lg transition-colors duration-300 closeModal">
                    Batal
                </button>
                <button type="button"
                        id="confirmDelete"
                        class="px-4 py-2 bg-gradient-to-r from-red-500 to-rose-600 hover:from-red-600 hover:to-rose-700 text-white rounded-lg transition-all duration-300 hover:scale-105">
                    Hapus
                </button>
            </div>
        </div>
    </div>

    <script>
        // Modal functionality
        const deleteModal = document.getElementById('deleteModal');
        const deleteBtn = document.querySelector('.delete-btn');
        const closeButtons = document.querySelectorAll('.closeModal');
        const confirmDeleteBtn = document.getElementById('confirmDelete');

        // Show modal
        if (deleteBtn) {
            deleteBtn.addEventListener('click', function() {
                const title = this.dataset.title;
                const id = this.dataset.id;

                document.getElementById('deleteTitle').textContent = title;
                confirmDeleteBtn.dataset.id = id;

                deleteModal.classList.remove('hidden');
                deleteModal.classList.add('flex');
            });
        }

        // Hide modal
        closeButtons.forEach(btn => {
            btn.addEventListener('click', function() {
                deleteModal.classList.add('hidden');
                deleteModal.classList.remove('flex');
            });
        });

        // Hide modal when clicking outside
        deleteModal.addEventListener('click', function(e) {
            if (e.target === this) {
                this.classList.add('hidden');
                this.classList.remove('flex');
            }
        });

        // Confirm delete
        confirmDeleteBtn.addEventListener('click', function() {
            const id = this.dataset.id;

            fetch(`{{ url('kegiatan') }}/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json',
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Redirect to index with success message
                    window.location.href = "{{ route('kegiatan.index') }}";
                } else {
                    alert('Terjadi kesalahan saat menghapus data');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat menghapus data');
            });
        });

        // Add scroll animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-slide-up');
                }
            });
        }, observerOptions);

        // Observe elements for animation
        document.querySelectorAll('[class*="animate-slide-up"]').forEach(el => {
            observer.observe(el);
        });
    </script>
</body>
</html>
