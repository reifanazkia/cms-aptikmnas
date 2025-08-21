<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .social-icon {
            font-size: 1.2rem;
            margin-right: 8px;
        }
        .action-buttons {
            white-space: nowrap;
        }
        .table th, .table td {
            vertical-align: middle;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Contact Management</h4>
                        <a href="{{ route('contact.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Add New Contact
                        </a>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Email DPP</th>
                                        <th>Email DPD</th>
                                        <th>Alamat</th>
                                        <th>No Telepon</th>
                                        <th>Social Media</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($contacts as $contact)
                                        <tr>
                                            <td>{{ $contact->id }}</td>
                                            <td>{{ $contact->email_dpp }}</td>
                                            <td>{{ $contact->email_dpd }}</td>
                                            <td>{{ Str::limit($contact->alamat, 50) }}</td>
                                            <td>{{ $contact->notlp }}</td>
                                            <td>
                                                @if($contact->url_ig)
                                                    <a href="{{ $contact->url_ig }}" target="_blank" class="social-icon text-decoration-none">
                                                        <i class="fab fa-instagram text-danger"></i>
                                                    </a>
                                                @endif
                                                @if($contact->url_twit)
                                                    <a href="{{ $contact->url_twit }}" target="_blank" class="social-icon text-decoration-none">
                                                        <i class="fab fa-twitter text-info"></i>
                                                    </a>
                                                @endif
                                                @if($contact->url_yt)
                                                    <a href="{{ $contact->url_yt }}" target="_blank" class="social-icon text-decoration-none">
                                                        <i class="fab fa-youtube text-danger"></i>
                                                    </a>
                                                @endif
                                                @if($contact->url_fb)
                                                    <a href="{{ $contact->url_fb }}" target="_blank" class="social-icon text-decoration-none">
                                                        <i class="fab fa-facebook text-primary"></i>
                                                    </a>
                                                @endif
                                                @if(!$contact->url_ig && !$contact->url_twit && !$contact->url_yt && !$contact->url_fb)
                                                    <span class="text-muted">No social media</span>
                                                @endif
                                            </td>
                                            <td class="action-buttons">
                                                <a href="{{ route('contact.edit', $contact->id) }}" class="btn btn-sm btn-warning">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('contact.destroy', $contact->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this contact?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">No contacts found.</td>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
