<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kegiatan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-warning text-dark">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">
                                <i class="fas fa-edit me-2"></i>Edit Kegiatan
                            </h4>
                            <a href="{{ route('kegiatan.index') }}" class="btn btn-dark btn-sm">
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

                        <form action="{{ route('kegiatan.update', $kegiatan->id) }}" method="POST" enctype="multipart/form-data" id="kegiatanForm">
                            @csrf
                            @method('PUT')

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
                                                        {{ (old('category_kegiatan_id') ?? $kegiatan->category_kegiatan_id) == $category->id ? 'selected' : '' }}>
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
                                               value="{{ old('title') ?? $kegiatan->title }}"
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
                                          id="description" name="description" rows="4"
                                          placeholder="Masukkan deskripsi kegiatan (opsional)">{{ old('description') ?? $kegiatan->description }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Deskripsi bersifat opsional</div>
                            </div>

                            <!-- Current Image Display -->
                            @if($kegiatan->image)
                                <div class="mb-3">
                                    <label class="form-label">
                                        <i class="fas fa-image me-1"></i>Gambar Saat Ini
                                    </label>
                                    <div class="current-image-container">
                                        <img src="{{ asset('storage/' . $kegiatan->image) }}"
                                             alt="{{ $kegiatan->title }}"
                                             class="img-thumbnail current-image"
                                             style="max-width: 200px;">
                                        <div class="mt-2">
                                            <small class="text-muted">Gambar yang sedang digunakan</small>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <div class="mb-4">
                                <label for="image" class="form-label">
                                    <i class="fas fa-image me-1"></i>{{ $kegiatan->image ? 'Ganti Gambar' : 'Gambar Kegiatan' }}
                                </label>
                                <input type="file"
                                       class="form-control @error('image') is-invalid @enderror"
                                       id="image" name="image"
                                       accept="image/jpeg,image/jpg,image/png">
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">
                                    Format: JPG, JPEG, PNG. Maksimal 2MB.
                                    {{ $kegiatan->image ? 'Kosongkan jika tidak ingin mengganti gambar.' : '' }}
                                </div>

                                <!-- Preview New Image -->
                                <div id="imagePreview" class="mt-3" style="display: none;">
                                    <label class="form-label">Preview Gambar Baru:</label>
                                    <div class="preview-container">
                                        <img id="previewImg" src="" alt="Preview" class="img-thumbnail" style="max-width: 200px;">
                                        <div class="mt-2">
                                            <button type="button" class="btn btn-sm btn-outline-danger" id="removeImage">
                                                <i class="fas fa-times me-1"></i>Batal Ganti
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="border-top pt-3">
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('kegiatan.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-times me-1"></i>Batal
                                    </a>
                                    <div>
                                        <a href="{{ route('kegiatan.show', $kegiatan->id) }}" class="btn btn-outline-info me-2">
                                            <i class="fas fa-eye me-1"></i>Lihat Detail
                                        </a>
                                        <button type="submit" class="btn btn-warning" id="submitBtn">
                                            <i class="fas fa-save me-1"></i>Update Kegiatan
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

                    // Dim current image if exists
                    const currentImage = document.querySelector('.current-image');
                    if (currentImage) {
                        currentImage.style.opacity = '0.5';
                        currentImage.parentNode.querySelector('.mt-2 small').textContent = 'Gambar lama (akan diganti)';
                    }
                }
                reader.readAsDataURL(file);
            }
        });

        // Remove image preview
        document.getElementById('removeImage').addEventListener('click', function() {
            document.getElementById('image').value = '';
            document.getElementById('imagePreview').style.display = 'none';

            // Restore current image opacity
            const currentImage = document.querySelector('.current-image');
            if (currentImage) {
                currentImage.style.opacity = '1';
                currentImage.parentNode.querySelector('.mt-2 small').textContent = 'Gambar yang sedang digunakan';
            }
        });

        // Form validation and submission
        document.getElementById('kegiatanForm').addEventListener('submit', function(e) {
            const submitBtn = document.getElementById('submitBtn');
            const originalText = submitBtn.innerHTML;

            // Disable submit button and show loading
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Mengupdate...';

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

        // Initialize character counter
        document.addEventListener('DOMContentLoaded', function() {
            const titleInput = document.getElementById('title');
            titleInput.dispatchEvent(new Event('input'));

            // Auto-resize textarea
            const textarea = document.getElementById('description');
            textarea.style.height = 'auto';
            textarea.style.height = (textarea.scrollHeight) + 'px';
        });

        // Auto-resize textarea
        document.getElementById('description').addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = (this.scrollHeight) + 'px';
        });

        // Warn if leaving page with unsaved changes
        let formChanged = false;
        document.querySelectorAll('input, textarea, select').forEach(element => {
            element.addEventListener('change', function() {
                formChanged = true;
            });
        });

        window.addEventListener('beforeunload', function(e) {
            if (formChanged) {
                e.preventDefault();
                e.returnValue = '';
            }
        });

        // Reset form changed flag on submit
        document.getElementById('kegiatanForm').addEventListener('submit', function() {
            formChanged = false;
        });
    </script>

    <style>
        .required::after {
            content: " *";
            color: #dc3545;
        }

        .form-control:focus {
            border-color: #ffc107;
            box-shadow: 0 0 0 0.2rem rgba(255, 193, 7, 0.25);
        }

        .img-thumbnail {
            border: 2px dashed #dee2e6;
            padding: 10px;
        }

        .current-image-container {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 0.375rem;
            border: 1px solid #dee2e6;
        }

        #imagePreview .preview-container {
            background-color: #e7f3ff;
            padding: 15px;
            border-radius: 0.375rem;
            border: 2px solid #0d6efd;
        }

        .current-image {
            transition: opacity 0.3s ease;
        }
    </style>
</body>
</html>
