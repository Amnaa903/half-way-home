<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration List - Half Way Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-light">
    <nav class="navbar navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="{{ route('incharge.dashboard') }}">
                <i class="fas fa-home"></i> Half Way Home
            </a>
            <div>
                <a href="{{ route('incharge.dashboard') }}" class="btn btn-light me-2">
                    <i class="fas fa-arrow-left"></i> Dashboard
                </a>
                <a href="{{ route('incharge.registration.create') }}" class="btn btn-success">
                    <i class="fas fa-plus"></i> Add New
                </a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><i class="fas fa-list"></i> Registration List</h4>
            </div>
            <div class="card-body">
                <!-- Messages -->
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        <i class="fas fa-check-circle"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show">
                        <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if (session('auto_removed'))
                    <div class="alert alert-info alert-dismissible fade show">
                        <i class="fas fa-info-circle"></i> {{ session('auto_removed') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <!-- Debug Info -->
                <div class="alert alert-warning">
                    <strong>Debug Info:</strong><br>
                    User District: {{ auth()->user()->district }}<br>
                    Total Records: {{ $incharges->count() }}
                </div>

                @if($incharges->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Full Name</th>
                                    <th>Date</th>
                                    <th>CNIC</th>
                                    <th>District</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($incharges as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->rname }}</td>
                                    <td>{{ $item->reg_date }}</td>
                                    <td>{{ $item->rcnic }}</td>
                                    <td>{{ $item->user_district }}</td>
                                    <td>
                                        <form action="{{ route('incharge.registration.destroy', $item->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete this registration?')">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-inbox fa-4x text-muted mb-3"></i>
                        <h4 class="text-muted">No Registrations Found</h4>
                        <p class="text-muted">No registration records found for your district.</p>
                        <a href="{{ route('incharge.registration.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Create First Registration
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Auto-hide alerts
        setTimeout(() => {
            document.querySelectorAll('.alert').forEach(alert => {
                new bootstrap.Alert(alert).close();
            });
        }, 5000);
    </script>
</body>
</html>