<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kegiatan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .card {
            border: none;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }
        .table th {
            border-top: none;
            font-weight: 600;
        }
        .btn-group-sm .btn {
            padding: 0.25rem 0.5rem;
        }
        .img-thumbnail {
            border-radius: 0.375rem;
        }
        .alert {
            border: none;
            border-radius: 0.5rem;
        }
        .btn {
            border-radius: 0.375rem;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center py-3">
                        <h3 class="mb-0 text-dark">
                            <i class="fas fa-calendar-alt me-2 text-primary"></i>Daftar Kegiatan
                        </h3>
                        <div class="d-flex gap-2">
                            <a href="{{ route('kegiatan.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus me-1"></i>Tambah Kegiatan
                            </a>
                        </div>
                    </div>

                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <!-- Filter Kategori -->
                        <div class="mb-4">
                            <h6 class="text-muted">Filter berdasarkan Kategori:</h6>
                            <div class="btn-group flex-wrap" role="group">
                                <a href="{{ route('kegiatan.index') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-list me-1"></i>Semua
                                </a>
                                @foreach($categories as $category)
                                    <a href="{{ route('kegiatan.byCategory', $category->id) }}"
                                       class="btn btn-outline-secondary">
                                        {{ $category->name }}
                                    </a>
                                @endforeach
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-dark">
                                    <tr>
                                        <th width="80">Gambar</th>
                                        <th>Judul</th>
                                        <th>Kategori</th>
                                        <th>Deskripsi</th>
                                        <th>Tanggal</th>
                                        <th width="120">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($kegiatans as $kegiatan)
                                        <tr>
                                            <td>
                                                @if($kegiatan->image)
                                                    <img src="{{ asset('storage/' . $kegiatan->image) }}"
                                                         alt="{{ $kegiatan->title }}"
                                                         class="img-thumbnail"
                                                         style="width: 60px; height: 60px; object-fit: cover;">
                                                @else
                                                    <div class="bg-light d-flex align-items-center justify-content-center rounded"
                                                         style="width: 60px; height: 60px;">
                                                        <i class="fas fa-image text-muted"></i>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                <strong class="text-dark">{{ $kegiatan->title }}</strong>
                                            </td>
                                            <td>
                                                <span class="badge bg-info">{{ $kegiatan->category->name }}</span>
                                            </td>
                                            <td>
                                                <span class="text-muted">{{ Str::limit($kegiatan->description ?? 'Tidak ada deskripsi', 50) }}</span>
                                            </td>
                                            <td>
                                                <small class="text-muted">{{ $kegiatan->created_at->format('d M Y, H:i') }}</small>
                                            </td>
                                            <td>
                                                <div class="btn-group btn-group-sm" role="group">
                                                    <a href="{{ route('kegiatan.show', $kegiatan->id) }}"
                                                       class="btn btn-outline-info" title="Lihat">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('kegiatan.edit', $kegiatan->id) }}"
                                                       class="btn btn-outline-warning" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-outline-danger delete-btn"
                                                            title="Hapus" data-id="{{ $kegiatan->id }}"
                                                            data-title="{{ $kegiatan->title }}">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center py-5">
                                                <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
                                                <h5 class="text-muted">Belum ada kegiatan</h5>
                                                <p class="text-muted mb-0">Silakan tambah kegiatan baru</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi Hapus -->
    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-exclamation-triangle text-warning me-2"></i>
                        Konfirmasi Hapus
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-warning" role="alert">
                        <i class="fas fa-info-circle me-2"></i>
                        Apakah Anda yakin ingin menghapus kegiatan <strong id="modalItemTitle"></strong>?
                    </div>
                    <p class="text-muted mb-0">Tindakan ini tidak dapat dibatalkan.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i>Batal
                    </button>
                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash me-1"></i>Ya, Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Loading Modal -->
    <div class="modal fade" id="loadingModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center py-4">
                    <div class="spinner-border text-primary mb-3" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <h5>Menghapus kegiatan...</h5>
                    <p class="text-muted mb-0">Mohon tunggu sebentar</p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            // CSRF Token untuk Ajax
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Handle delete button click
            $('.delete-btn').on('click', function() {
                const id = $(this).data('id');
                const title = $(this).data('title');

                // Set modal content
                $('#modalItemTitle').text(title);

                // Set form action
                $('#deleteForm').attr('action', '/kegiatan/' + id);

                // Show modal
                $('#deleteModal').modal('show');
            });

            // Handle form submission
            $('#deleteForm').on('submit', function(e) {
                e.preventDefault();

                // Hide confirmation modal and show loading
                $('#deleteModal').modal('hide');
                $('#loadingModal').modal('show');

                // Submit the form
                this.submit();
            });

            // Auto-hide alerts after 5 seconds
            setTimeout(function() {
                $('.alert').fadeOut('slow');
            }, 5000);

            // Initialize tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[title]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>
</body>
</html>
