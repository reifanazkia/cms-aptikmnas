<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kegiatan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="mb-0">
                            <i class="fas fa-calendar-alt me-2"></i>Daftar Kegiatan
                        </h3>
                        <div>
                            <a href="{{ route('kegiatan.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus me-1"></i>Tambah Kegiatan
                            </a>
                            <button type="button" class="btn btn-danger" id="bulkDeleteBtn" style="display: none;">
                                <i class="fas fa-trash me-1"></i>Hapus Terpilih
                            </button>
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
                            <h6>Filter berdasarkan Kategori:</h6>
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

                        <form id="bulkDeleteForm" method="POST" action="{{ route('kegiatan.bulkDelete') }}">
                            @csrf
                            @method('DELETE')

                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="table-dark">
                                        <tr>
                                            <th width="30">
                                                <input type="checkbox" id="selectAll" class="form-check-input">
                                            </th>
                                            <th width="80">Gambar</th>
                                            <th>Judul</th>
                                            <th>Kategori</th>
                                            <th>Deskripsi</th>
                                            <th>Tanggal</th>
                                            <th width="150">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($kegiatans as $kegiatan)
                                            <tr>
                                                <td>
                                                    <input type="checkbox" name="ids[]" value="{{ $kegiatan->id }}"
                                                           class="form-check-input item-checkbox">
                                                </td>
                                                <td>
                                                    @if($kegiatan->image)
                                                        <img src="{{ asset('storage/' . $kegiatan->image) }}"
                                                             alt="{{ $kegiatan->title }}"
                                                             class="img-thumbnail"
                                                             style="width: 60px; height: 60px; object-fit: cover;">
                                                    @else
                                                        <div class="bg-light d-flex align-items-center justify-content-center"
                                                             style="width: 60px; height: 60px;">
                                                            <i class="fas fa-image text-muted"></i>
                                                        </div>
                                                    @endif
                                                </td>
                                                <td>
                                                    <strong>{{ $kegiatan->title }}</strong>
                                                </td>
                                                <td>
                                                    <span class="badge bg-info">{{ $kegiatan->category->name }}</span>
                                                </td>
                                                <td>
                                                    {{ Str::limit($kegiatan->description ?? 'Tidak ada deskripsi', 50) }}
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
                                                                data-id="{{ $kegiatan->id }}"
                                                                data-title="{{ $kegiatan->title }}" title="Hapus">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center py-5">
                                                    <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
                                                    <h5 class="text-muted">Belum ada kegiatan</h5>
                                                    <p class="text-muted">Silakan tambah kegiatan baru</p>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </form>
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
                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus kegiatan "<span id="deleteTitle"></span>"?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger" id="confirmDelete">Hapus</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi Bulk Delete -->
    <div class="modal fade" id="bulkDeleteModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Hapus Massal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus <span id="selectedCount"></span> kegiatan yang dipilih?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger" id="confirmBulkDelete">Hapus</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // CSRF Token untuk Ajax
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Select All Functionality
        document.getElementById('selectAll').addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('.item-checkbox');
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
            toggleBulkDeleteBtn();
        });

        // Individual checkbox change
        document.querySelectorAll('.item-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                toggleBulkDeleteBtn();

                // Update select all status
                const allCheckboxes = document.querySelectorAll('.item-checkbox');
                const checkedCheckboxes = document.querySelectorAll('.item-checkbox:checked');
                document.getElementById('selectAll').checked = allCheckboxes.length === checkedCheckboxes.length;
            });
        });

        // Toggle bulk delete button
        function toggleBulkDeleteBtn() {
            const checkedCheckboxes = document.querySelectorAll('.item-checkbox:checked');
            const bulkDeleteBtn = document.getElementById('bulkDeleteBtn');

            if (checkedCheckboxes.length > 0) {
                bulkDeleteBtn.style.display = 'inline-block';
            } else {
                bulkDeleteBtn.style.display = 'none';
            }
        }

        // Delete single item
        document.querySelectorAll('.delete-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.dataset.id;
                const title = this.dataset.title;

                document.getElementById('deleteTitle').textContent = title;
                document.getElementById('confirmDelete').dataset.id = id;

                new bootstrap.Modal(document.getElementById('deleteModal')).show();
            });
        });

        // Confirm single delete
        document.getElementById('confirmDelete').addEventListener('click', function() {
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
                bootstrap.Modal.getInstance(document.getElementById('deleteModal')).hide();
                location.reload();
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat menghapus data');
            });
        });

        // Bulk delete
        document.getElementById('bulkDeleteBtn').addEventListener('click', function() {
            const checkedCheckboxes = document.querySelectorAll('.item-checkbox:checked');
            document.getElementById('selectedCount').textContent = checkedCheckboxes.length;

            new bootstrap.Modal(document.getElementById('bulkDeleteModal')).show();
        });

        // Confirm bulk delete
        document.getElementById('confirmBulkDelete').addEventListener('click', function() {
            document.getElementById('bulkDeleteForm').submit();
        });
    </script>
</body>
</html>
