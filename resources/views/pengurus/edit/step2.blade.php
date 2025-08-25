<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pengurus - Step 2</title>
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
                            <h4 class="mb-0">Edit Pengurus - Step 2 dari 3</h4>
                            <div>
                                <a href="{{ route('pengurus.edit', $pengurus->id) }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Kembali ke Step 1
                                </a>
                                <a href="{{ route('pengurus.show', $pengurus->id) }}" class="btn btn-info">
                                    <i class="fas fa-eye"></i> Lihat Detail
                                </a>
                                <a href="{{ route('pengurus.index') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-times"></i> Batal
                                </a>
                            </div>
                        </div>
                        <!-- Progress Bar -->
                        <div class="progress mt-3" style="height: 5px;">
                            <div class="progress-bar" role="progressbar" style="width: 66%"></div>
                        </div>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
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

                        <!-- Summary Step 1 -->
                        <div class="alert alert-info">
                            <h6><i class="fas fa-info-circle"></i> Data Pengurus:</h6>
                            <strong>Nama:</strong> {{ $pengurus->title }}<br>
                            <strong>Email:</strong> {{ $pengurus->email }}
                        </div>

                        <form action="{{ route('pengurus.edit.step2.update', $pengurus->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card mb-4">
                                        <div class="card-header bg-success text-white">
                                            <h5 class="mb-0">Informasi Tambahan 1</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <label for="title2" class="form-label">Judul 2 <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('title2') is-invalid @enderror"
                                                       id="title2" name="title2" value="{{ old('title2', $pengurus->title2) }}" required>
                                                @error('title2')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="description2" class="form-label">Deskripsi 2 <span class="text-danger">*</span></label>
                                                <textarea class="form-control @error('description2') is-invalid @enderror"
                                                          id="description2" name="description2" rows="4" required>{{ old('description2', $pengurus->description2) }}</textarea>
                                                @error('description2')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="image2" class="form-label">Gambar 2</label>
                                                @if($pengurus->image2)
                                                    <div class="mb-2">
                                                        <img src="{{ asset('storage/' . $pengurus->image2) }}" alt="Current Image 2"
                                                             class="img-thumbnail" width="100">
                                                        <small class="text-muted d-block">Gambar 2 saat ini</small>
                                                    </div>
                                                @endif
                                                <input type="file" class="form-control @error('image2') is-invalid @enderror"
                                                       id="image2" name="image2" accept="image/*">
                                                <div class="form-text">Format: JPEG, PNG, JPG, GIF. Maksimal 2MB. Kosongkan jika tidak ingin mengganti.</div>
                                                @error('image2')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="card mb-4">
                                        <div class="card-header bg-warning text-dark">
                                            <h5 class="mb-0">Informasi Tambahan 2</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <label for="title3" class="form-label">Judul 3 <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('title3') is-invalid @enderror"
                                                       id="title3" name="title3" value="{{ old('title3', $pengurus->title3) }}" required>
                                                @error('title3')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="description3" class="form-label">Deskripsi 3 <span class="text-danger">*</span></label>
                                                <textarea class="form-control @error('description3') is-invalid @enderror"
                                                          id="description3" name="description3" rows="4" required>{{ old('description3', $pengurus->description3) }}</textarea>
                                                @error('description3')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="image3" class="form-label">Gambar 3</label>
                                                @if($pengurus->image3)
                                                    <div class="mb-2">
                                                        <img src="{{ asset('storage/' . $pengurus->image3) }}" alt="Current Image 3"
                                                             class="img-thumbnail" width="100">
                                                        <small class="text-muted d-block">Gambar 3 saat ini</small>
                                                    </div>
                                                @endif
                                                <input type="file" class="form-control @error('image3') is-invalid @enderror"
                                                       id="image3" name="image3" accept="image/*">
                                                <div class="form-text">Format: JPEG, PNG, JPG, GIF. Maksimal 2MB. Kosongkan jika tidak ingin mengganti.</div>
                                                @error('image3')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('pengurus.edit', $pengurus->id) }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Kembali ke Step 1
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    Lanjut ke Step 3 <i class="fas fa-arrow-right"></i>
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
