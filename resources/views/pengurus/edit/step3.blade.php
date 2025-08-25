<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Pengurus - Step 3 of 3</h4>
                    <div class="progress mt-2">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Step 3</div>
                    </div>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="alert alert-warning">
                        <i class="fas fa-edit"></i>
                        Ini adalah langkah terakhir untuk mengedit data pengurus.
                    </div>

                    <form action="{{ route('pengurus.edit.step3.update', $pengurus->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="title4" class="form-label">Title 4 <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('title4') is-invalid @enderror"
                                   id="title4" name="title4" value="{{ old('title4', $pengurus->title4) }}" required>
                            @error('title4')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description4" class="form-label">Description 4 <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('description4') is-invalid @enderror"
                                      id="description4" name="description4" rows="5" required>{{ old('description4', $pengurus->description4) }}</textarea>
                            @error('description4')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="image4" class="form-label">Image 4</label>
                            <input type="file" class="form-control @error('image4') is-invalid @enderror"
                                   id="image4" name="image4" accept="image/*">
                            @error('image4')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            @if($pengurus->image4)
                                <div class="mt-2">
                                    <small class="text-muted">Current image:</small>
                                    <img src="{{ asset('storage/' . $pengurus->image4) }}"
                                         alt="Current Image 4" class="img-thumbnail d-block mt-1" style="max-width: 200px;">
                                </div>
                            @endif
                        </div>

                        <!-- Summary Card -->
                        <div class="card bg-light mb-4">
                            <div class="card-header">
                                <h6 class="mb-0">Ringkasan Data</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p><strong>Title:</strong> {{ $pengurus->title }}</p>
                                        <p><strong>Email:</strong> {{ $pengurus->email }}</p>
                                        <p><strong>Phone:</strong> {{ $pengurus->phone }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Title 2:</strong> {{ $pengurus->title2 ?? '-' }}</p>
                                        <p><strong>Title 3:</strong> {{ $pengurus->title3 ?? '-' }}</p>
                                        <p><strong>Category Daftar:</strong> {{ $pengurus->categoryDaftar->name ?? '-' }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <p><strong>Address:</strong> {{ Str::limit($pengurus->address, 100) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('pengurus.edit.step2', $pengurus->id) }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Back to Step 2
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save"></i> Update Complete
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
