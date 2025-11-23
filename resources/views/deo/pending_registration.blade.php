<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DEO - Pending Registration - Half Way Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body {
            background-color: #E8F4F3;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .navbar {
            background-color: #3D7C77 !important;
        }
        
        .card {
            border: 2px solid #C7EAE7 !important;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(199, 234, 231, 0.3);
        }
        
        .card-header {
            background-color: #3D7C77 !important;
            color: white !important;
            border-bottom: 2px solid #2C3E50;
        }
        
        .table thead tr {
            background-color: #3D7C77 !important;
            color: #FFFFFF !important;
        }
        
        .table tbody tr {
            background-color: #FFFFFF;
            transition: all 0.3s ease;
        }
        
        .table tbody tr:hover {
            background-color: #C7EAE7 !important;
        }
        
        .btn-primary {
            background-color: #3D7C77;
            border-color: #3D7C77;
        }
        
        .btn-primary:hover {
            background-color: #2C3E50;
            border-color: #2C3E50;
        }
        
        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }
        
        .btn-success:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }
        
        .btn-warning {
            background-color: #ffc107;
            border-color: #ffc107;
            color: #212529;
        }
        
        .btn-warning:hover {
            background-color: #e0a800;
            border-color: #d39e00;
        }
        
        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }
        
        .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }
        
        .btn-info {
            background-color: #17a2b8;
            border-color: #17a2b8;
        }
        
        .btn-info:hover {
            background-color: #138496;
            border-color: #117a8b;
        }
        
        .alert {
            border-left: 4px solid #3D7C77;
        }
        
        .action-buttons {
            display: flex;
            gap: 5px;
            flex-wrap: wrap;
        }
        
        .status-pending {
            background-color: #fff3cd;
            color: #856404;
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 0.8em;
        }
        
        .status-approved {
            background-color: #d1edff;
            color: #0c5460;
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 0.8em;
        }
        
        .modal-header {
            background-color: #3D7C77;
            color: white;
        }

        .btn-register {
            background-color: #17a2b8;
            border-color: #17a2b8;
        }
        
        .btn-register:hover {
            background-color: #138496;
            border-color: #117a8b;
        }
    </style>
</head>
<body class="bg-light">
    <nav class="navbar navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="{{ route('deo.dashboard') }}">
                <i class="fas fa-home"></i> Half Way Home - DEO
            </a>
            <div>
                <a href="{{ route('deo.dashboard') }}" class="btn btn-light me-2">
                    <i class="fas fa-arrow-left"></i> Dashboard
                </a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><i class="fas fa-clock"></i> DEO - Pending Registration List</h4>
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

                <!-- Statistics -->
                <div class="alert alert-info">
                    <strong>DEO Panel - All Districts</strong><br>
                    Total Pending Registrations: {{ $incharges->count() }}
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
                                    <th>Incharge Name</th>
                                    <th>Status</th>
                                    <th>Created At</th>
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
                                    <td>{{ $item->user->name ?? 'N/A' }}</td>
                                    <td>
                                        <span class="status-pending">
                                            <i class="fas fa-clock"></i> Pending
                                        </span>
                                    </td>
                                    <td>{{ $item->created_at->format('d-m-Y H:i') }}</td>
                                    <td>
                                        <div class="action-buttons">
                                            <!-- Approve Button -->
                                            <form action="{{ route('deo.registration.approve', $item->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Approve this registration?')">
                                                    <i class="fas fa-check"></i> Approve
                                                </button>
                                            </form>
                                            
                                            <!-- Register Button - Direct to HWH Admission with auto-fill data -->
                                            <a href="{{ route('hwhadmissions.create') }}?incharge_id={{ $item->id }}&name={{ urlencode($item->rname) }}&cnic={{ $item->rcnic }}&district={{ urlencode($item->user_district) }}&father_name={{ urlencode($item->father_name ?? '') }}&phone={{ urlencode($item->phone ?? '') }}&address={{ urlencode($item->address ?? '') }}" 
                                               class="btn btn-register btn-sm">
                                                <i class="fas fa-user-plus"></i> Register in HWH
                                            </a>
                                            
                                            <!-- View Details Button -->
                                            <button type="button" class="btn btn-info btn-sm" onclick="viewDetails({{ $item->id }})">
                                                <i class="fas fa-eye"></i> View
                                            </button>
                                            
                                            <!-- Delete Button -->
                                            <form action="{{ route('deo.registration.destroy', $item->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete this registration?')">
                                                    <i class="fas fa-trash"></i> Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-inbox fa-4x text-muted mb-3"></i>
                        <h4 class="text-muted">No Pending Registrations</h4>
                        <p class="text-muted">There are no pending registration requests at the moment.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- View Details Modal -->
    <div class="modal fade" id="viewDetailsModal" tabindex="-1" aria-labelledby="viewDetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewDetailsModalLabel">Registration Details</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="detailsContent">
                    <!-- Details will be loaded here via JavaScript -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <script>
        // Auto-hide alerts
        setTimeout(() => {
            document.querySelectorAll('.alert').forEach(alert => {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);

        // View Details Function
        function viewDetails(id) {
            // Show loading in modal
            $('#detailsContent').html(`
                <div class="text-center py-4">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="mt-2">Loading details...</p>
                </div>
            `);
            
            // Fetch details via AJAX
            $.ajax({
                url: '/deo/registration/' + id + '/details',
                type: 'GET',
                success: function(response) {
                    $('#detailsContent').html(`
                        <div class="row">
                            <div class="col-md-6">
                                <h6>Personal Information</h6>
                                <table class="table table-bordered">
                                    <tr>
                                        <th width="40%">Full Name:</th>
                                        <td>${response.rname}</td>
                                    </tr>
                                    <tr>
                                        <th>CNIC:</th>
                                        <td>${response.rcnic}</td>
                                    </tr>
                                    <tr>
                                        <th>Registration Date:</th>
                                        <td>${response.reg_date}</td>
                                    </tr>
                                    <tr>
                                        <th>Father Name:</th>
                                        <td>${response.father_name || 'N/A'}</td>
                                    </tr>
                                    <tr>
                                        <th>Phone:</th>
                                        <td>${response.phone || 'N/A'}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <h6>Location Information</h6>
                                <table class="table table-bordered">
                                    <tr>
                                        <th width="40%">District:</th>
                                        <td>${response.user_district}</td>
                                    </tr>
                                    <tr>
                                        <th>Address:</th>
                                        <td>${response.address || 'N/A'}</td>
                                    </tr>
                                    <tr>
                                        <th>Submitted By:</th>
                                        <td>${response.user_name}</td>
                                    </tr>
                                    <tr>
                                        <th>Submitted On:</th>
                                        <td>${response.created_at}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <h6>Quick Actions</h6>
                                <div class="d-grid gap-2 d-md-flex">
                                    <a href="/hwhadmissions/create?incharge_id=${response.id}&name=${encodeURIComponent(response.rname)}&cnic=${response.rcnic}&district=${encodeURIComponent(response.user_district)}&father_name=${encodeURIComponent(response.father_name || '')}&phone=${encodeURIComponent(response.phone || '')}&address=${encodeURIComponent(response.address || '')}" 
                                       class="btn btn-register btn-sm">
                                        <i class="fas fa-user-plus"></i> Register in HWH
                                    </a>
                                    <form action="/deo/registration/${response.id}/approve" method="POST" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-success btn-sm">
                                            <i class="fas fa-check"></i> Approve Only
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    `);
                },
                error: function(xhr) {
                    $('#detailsContent').html(`
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-triangle"></i> Error loading details. Please try again.
                        </div>
                    `);
                }
            });
            
            // Show modal
            var modal = new bootstrap.Modal(document.getElementById('viewDetailsModal'));
            modal.show();
        }

        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            // Ctrl + R to refresh
            if (e.ctrlKey && e.key === 'r') {
                e.preventDefault();
                window.location.reload();
            }
        });
    </script>
</body>
</html>