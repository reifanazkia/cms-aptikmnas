<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kegiatan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">
                                <i class="fas fa-plus-circle me-2"></i>Tambah Kegiatan Baru
                            </h4>
                            <a href="{{ route('kegiatan.index') }}" class="btn btn-light btn-sm">
                                <i class="fas fa-arrow-left me-1"></i>Kembali
                            </a>
                        </div>
                    </div>

                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <h6><i class="fas fa-exclamation-triangle me-2"></i>Terdapat kesalahan:</h6>
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('kegiatan.store') }}" method="POST" enctype="multipart/form-data" id="kegiatanForm">
                            @csrf

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="category_kegiatan_id" class="form-label required">
                                            <i class="fas fa-tag me-1"></i>Kategori Kegiatan
                                        </label>
                                        <select class="form-select @error('category_kegiatan_id') is-invalid @enderror"
                                                id="category_kegiatan_id" name="category_kegiatan_id" required>
                                            <option value="">Pilih Kategori</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}"
                                                        {{ old('category_kegiatan_id') == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('category_kegiatan_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="title" class="form-label required">
                                            <i class="fas fa-heading me-1"></i>Judul Kegiatan
                                        </label>
                                        <input type="text"
                                               class="form-control @error('title') is-invalid @enderror"
                                               id="title" name="title"
                                               value="{{ old('title') }}"
                                               placeholder="Masukkan judul kegiatan"
                                               maxlength="255" required>
                                        @error('title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-text">Maksimal 255 karakter</div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">
                                    <i class="fas fa-align-left me-1"></i>Deskripsi
                                </label>
                                <textarea class="form-control @error('description') is-invalid @enderror"
                                          id="description" name="description" rows="4">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="image" class="form-label required">
                                    <i class="fas fa-image me-1"></i>Gambar Kegiatan
                                </label>
                                <input type="file"
                                       class="form-control @error('image') is-invalid @enderror"
                                       id="image" name="image"
                                       accept="image/jpeg,image/jpg,image/png"
                                       required>
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Format: JPG, JPEG, PNG. Maksimal 2MB</div>

                                <!-- Preview Image -->
                                <div id="imagePreview" class="mt-3" style="display: none;">
                                    <img id="previewImg" src="" alt="Preview" class="img-thumbnail" style="max-width: 200px;">
                                    <div class="mt-2">
                                        <button type="button" class="btn btn-sm btn-outline-danger" id="removeImage">
                                            <i class="fas fa-times me-1"></i>Hapus Gambar
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="border-top pt-3">
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('kegiatan.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-times me-1"></i>Batal
                                    </a>
                                    <div>
                                        <button type="reset" class="btn btn-outline-secondary me-2">
                                            <i class="fas fa-undo me-1"></i>Reset
                                        </button>
                                        <button type="submit" class="btn btn-primary" id="submitBtn">
                                            <i class="fas fa-save me-1"></i>Simpan Kegiatan
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Image Preview
        document.getElementById('image').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                // Validate file type
                if (!['image/jpeg', 'image/jpg', 'image/png'].includes(file.type)) {
                    alert('Format file harus JPG, JPEG, atau PNG');
                    this.value = '';
                    return;
                }

                // Validate file size (2MB = 2048KB = 2097152 bytes)
                if (file.size > 2097152) {
                    alert('Ukuran file maksimal 2MB');
                    this.value = '';
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('previewImg').src = e.target.result;
                    document.getElementById('imagePreview').style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        });

        // Remove image preview
        document.getElementById('removeImage').addEventListener('click', function() {
            document.getElementById('image').value = '';
            document.getElementById('imagePreview').style.display = 'none';
        });

        // Form validation and submission
        document.getElementById('kegiatanForm').addEventListener('submit', function(e) {
            const submitBtn = document.getElementById('submitBtn');
            const originalText = submitBtn.innerHTML;

            // Disable submit button and show loading
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Menyimpan...';

            // Re-enable button after 3 seconds (in case of error)
            setTimeout(function() {
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;
            }, 3000);
        });

        // Character counter for title
        document.getElementById('title').addEventListener('input', function() {
            const maxLength = 255;
            const currentLength = this.value.length;
            const remaining = maxLength - currentLength;

            // Update or create character counter
            let counter = document.getElementById('titleCounter');
            if (!counter) {
                counter = document.createElement('div');
                counter.id = 'titleCounter';
                counter.className = 'form-text';
                this.parentNode.appendChild(counter);
            }

            counter.textContent = `${currentLength}/${maxLength} karakter`;
            counter.style.color = remaining < 20 ? '#dc3545' : '#6c757d';
        });

        // Reset form
        document.querySelector('button[type="reset"]').addEventListener('click', function() {
            document.getElementById('imagePreview').style.display = 'none';

            // Reset character counter
            const counter = document.getElementById('titleCounter');
            if (counter) {
                counter.textContent = '0/255 karakter';
                counter.style.color = '#6c757d';
            }
        });

        // Auto-resize textarea
        document.getElementById('description').addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = (this.scrollHeight) + 'px';
        });
    </script>

    <style>
        .required::after {
            content: " *";
            color: #dc3545;
        }

        .form-control:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
        }

        .img-thumbnail {
            border: 2px dashed #dee2e6;
            padding: 10px;
        }

        #imagePreview {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 0.375rem;
            border: 1px solid #dee2e6;
        }
    </style>
</body>
</html>
