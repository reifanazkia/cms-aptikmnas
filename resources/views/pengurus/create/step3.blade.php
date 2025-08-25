<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pengurus - Step 3</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">Tambah Pengurus - Step 3 dari 3 (Final)</h4>
                            <div>
                                <a href="{{ route('pengurus.edit.step2', $pengurus->id) }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Kembali ke Step 2
                                </a>
                                <a href="{{ route('pengurus.index') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-times"></i> Batal
                                </a>
                            </div>
                        </div>
                        <!-- Progress Bar -->
                        <div class="progress mt-3" style="height: 5px;">
                            <div class="progress-bar" role="progressbar" style="width: 100%"></div>
                        </div>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Summary Previous Steps -->
                        <div class="alert alert-info">
                            <h6><i class="fas fa-info-circle"></i> Ringkasan Data:</h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <strong>Nama:</strong> {{ $pengurus->title }}<br>
                                    <strong>Email:</strong> {{ $pengurus->email }}
                                </div>
                                <div class="col-md-6">
                                    @if($pengurus->title2)
                                        <strong>Judul 2:</strong> {{ $pengurus->title2 }}<br>
                                    @endif
                                    @if($pengurus->title3)
                                        <strong>Judul 3:</strong> {{ $pengurus->title3 }}
                                    @endif
                                </div>
                            </div>
                        </div>

                        <form action="{{ route('pengurus.create.step3.store', $pengurus->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="card mb-4">
                                <div class="card-header bg-info text-white">
                                    <h5 class="mb-0">Informasi Tambahan Terakhir</h5>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="title4" class="form-label">Judul 4 <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('title4') is-invalid @enderror"
                                               id="title4" name="title4" value="{{ old('title4') }}" required>
                                        @error('title4')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="description4" class="form-label">Deskripsi 4 <span class="text-danger">*</span></label>
                                        <textarea class="form-control @error('description4') is-invalid @enderror"
                                                  id="description4" name="description4" rows="5" required>{{ old('description4') }}</textarea>
                                        @error('description4')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="image4" class="form-label">Gambar 4</label>
                                        <input type="file" class="form-control @error('image4') is-invalid @enderror"
                                               id="image4" name="image4" accept="image/*">
                                        <div class="form-text">Format: JPEG, PNG, JPG, GIF. Maksimal 2MB</div>
                                        @error('image4')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="alert alert-warning">
                                <h6><i class="fas fa-exclamation-triangle"></i> Perhatian:</h6>
                                <p class="mb-0">Setelah mengklik "Selesai", data pengurus akan tersimpan secara lengkap dan Anda akan diarahkan kembali ke halaman daftar pengurus.</p>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('pengurus.edit.step2', $pengurus->id) }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Kembali ke Step 2
                                </a>
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-check"></i> Selesai
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
