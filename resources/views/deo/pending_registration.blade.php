<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending Registration - DEO Dashboard</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body {
            background-color: #E8F4F3;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #2C3E50;
            padding: 20px;
        }
        
        .list-card {
            background: #3D7C77;
            margin: 30px auto;
            padding: 30px;
            width: 90%;
            max-width: 1200px;
            border-radius: 12px;
            color: #ffffff;
            box-shadow: 0 8px 32px rgba(61, 124, 119, 0.3);
        }
        
        .list-header {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .list-title {
            color: #ffffff;
            font-weight: 600;
            margin-bottom: 10px;
            font-size: 28px;
        }
        
        .list-subtitle {
            color: #C7EAE7;
            font-size: 16px;
        }
        
        .btn {
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 14px;
            text-decoration: none;
            display: inline-block;
        }
        
        .btn-light {
            background: #C7EAE7;
            color: #2C3E50;
            border: 2px solid #C7EAE7 !important;
        }
        
        .btn-light:hover {
            background: #9ED8D2;
            border-color: #9ED8D2 !important;
            transform: translateY(-2px);
        }
        
        .btn-register {
            background: #28a745;
            color: #ffffff;
            border: 2px solid #28a745 !important;
            padding: 8px 16px;
            font-size: 14px;
        }
        
        .btn-register:hover {
            background: #218838;
            border-color: #218838 !important;
            transform: translateY(-2px);
        }
        
        .btn-delete {
            background: #dc3545;
            color: #ffffff;
            border: 2px solid #dc3545 !important;
            padding: 8px 16px;
            font-size: 14px;
        }
        
        .btn-delete:hover {
            background: #c82333;
            border-color: #c82333 !important;
            transform: translateY(-2px);
        }
        
        .table-container {
            background: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            border: 1px solid #C7EAE7;
            max-height: 600px;
            overflow-y: auto;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        table th {
            background: #3D7C77;
            color: white;
            padding: 15px 12px;
            text-align: center;
            font-weight: 600;
            font-size: 14px;
            position: sticky;
            top: 0;
        }
        
        table td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #E8F4F3;
            background: #ffffff;
            color: #2C3E50;
        }
        
        table tr:hover {
            background: #C7EAE7 !important;
        }
        
        .alert {
            background: #C7EAE7;
            color: #2C3E50;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            border-left: 4px solid #9ED8D2;
        }
        
        .alert-success {
            background: #d4edda;
            color: #155724;
            border-left: 4px solid #28a745;
        }
        
        .alert-info {
            background: #d1ecf1;
            color: #0c5460;
            border-left: 4px solid #17a2b8;
        }
        
        .badge {
            padding: 6px 10px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 600;
        }
        
        .bg-warning {
            background: #ffc107 !important;
            color: #000 !important;
        }
        
        .bg-success {
            background: #28a745 !important;
            color: #fff !important;
        }
        
        .empty-state {
            text-align: center;
            padding: 40px;
            color: #6c757d;
        }
        
        .empty-state i {
            font-size: 48px;
            margin-bottom: 15px;
            color: #9ED8D2;
        }

        @media (max-width: 768px) {
            body {
                padding: 10px;
            }
            
            .list-card {
                width: 95%;
                padding: 20px;
                margin: 20px auto;
            }
            
            table th,
            table td {
                padding: 10px 8px;
                font-size: 13px;
            }
            
            .btn {
                padding: 8px 12px;
                font-size: 12px;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="list-card">
        <div class="list-header">
            <h1 class="list-title">Pending Registration List</h1>
            <p class="list-subtitle">Manage pending registrations from incharges</p>
        </div>
        
        <!-- Success/Error Messages -->
        @if (session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
        @endif
        
        @if (session('error'))
        <div class="alert">
            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
        </div>
        @endif
        
        @if (session('auto_removed'))
        <div class="alert alert-info">
            <i class="fas fa-info-circle"></i> {{ session('auto_removed') }}
        </div>
        @endif
        
        <div class="text-end mb-3">
            <a href="{{ route('deo.dashboard') }}" class="btn btn-light">
                <i class="fas fa-arrow-left"></i> Back to Dashboard
            </a>
        </div>

        <div class="table-container">
            <table id="dataTable">
                <thead>
                    <tr>
                        <th style="width: 60px;">#</th>
                        <th style="width: 200px;">Full Name</th>
                        <th style="width: 150px;">Date</th>
                        <th style="width: 200px;">CNIC</th>
                        <th style="width: 150px;">Incharge District</th>
                        <th style="width: 200px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($incharges) && count($incharges) > 0)
                        @foreach($incharges as $index => $incharge)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $incharge->rname }}</td>
                            <td>{{ \Carbon\Carbon::parse($incharge->reg_date)->format('d-m-Y') }}</td>
                            <td>{{ $incharge->rcnic }}</td>
                            <td>
                                <span class="badge bg-warning">{{ $incharge->user_district }}</span>
                            </td>
                            <td>
                                <!-- Register Button - Link to Admission Form -->
                                <!-- UPDATED: Using named route instead of direct URL -->
                                <a href="{{ route('hwhadmissions.create', [
                                    'incharge_id' => $incharge->id, 
                                    'name' => $incharge->rname, 
                                    'cnic' => $incharge->rcnic,
                                    'father_name' => $incharge->father_name ?? '',
                                    'phone' => $incharge->phone ?? '',
                                    'address' => $incharge->address ?? '',
                                    'guardian_name' => $incharge->guardian_name ?? '',
                                    'guardian_contact' => $incharge->guardian_contact ?? ''
                                ]) }}" 
                                   class="btn btn-register">
                                    <i class="fas fa-user-plus"></i> Register
                                </a>
                                
                                <!-- Delete Button -->
                                <form action="{{ route('incharge.registration.destroy', $incharge->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-delete" onclick="return confirm('Are you sure you want to delete this registration?')">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6" class="empty-state">
                                <i class="fas fa-clipboard-list"></i>
                                <h4>No Pending Registrations</h4>
                                <p>There are no pending registrations from incharges at the moment.</p>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        
        <!-- Summary -->
        @if(isset($incharges) && count($incharges) > 0)
        <div class="mt-3 text-center">
            <p class="text-light">
                <i class="fas fa-info-circle"></i> 
                Showing <strong>{{ count($incharges) }}</strong> pending registration(s)
            </p>
        </div>
        @endif
        
        <div class="text-center mt-4">
            <a href="{{ route('deo.dashboard') }}" class="btn btn-light me-2">
                <i class="fas fa-home"></i> DEO Dashboard
            </a>
            
            <!-- NEW: Direct link to HWH Admissions List -->
            <a href="{{ route('hwhadmissions.index') }}" class="btn btn-light me-2">
                <i class="fas fa-list"></i> View All Admissions
            </a>
            
            <button onclick="window.location.reload()" class="btn btn-light">
                <i class="fas fa-sync-alt"></i> Refresh
            </button>
        </div>
    </div>
</div>

<!-- JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        // Auto-hide alerts after 5 seconds
        setTimeout(function() {
            $('.alert').fadeOut('slow');
        }, 5000);

        // Auto-refresh every 30 seconds if there are pending registrations
        @if(isset($incharges) && count($incharges) > 0)
        setInterval(function() {
            window.location.reload();
        }, 30000); // 30 seconds
        @endif

        // Confirm before delete
        $('form').on('submit', function(e) {
            if ($(this).find('.btn-delete').length > 0) {
                if (!confirm('Are you sure you want to delete this registration?')) {
                    e.preventDefault();
                }
            }
        });

        // NEW: Success message for auto-removal
        @if(session('auto_removed'))
        setTimeout(function() {
            // Show a toast notification for auto-removal
            const toast = document.createElement('div');
            toast.className = 'alert alert-success';
            toast.style.position = 'fixed';
            toast.style.top = '20px';
            toast.style.right = '20px';
            toast.style.zIndex = '9999';
            toast.innerHTML = '<i class="fas fa-check-circle"></i> {{ session('auto_removed') }}';
            document.body.appendChild(toast);
            
            setTimeout(() => {
                toast.remove();
            }, 5000);
        }, 1000);
        @endif
    });

    // Keyboard shortcut for refresh
    document.addEventListener('keydown', function(e) {
        if (e.ctrlKey && e.key === 'r') {
            e.preventDefault();
            window.location.reload();
        }
    });

    // NEW: Enhanced user experience
    document.addEventListener('DOMContentLoaded', function() {
        // Add loading state to register buttons
        const registerButtons = document.querySelectorAll('.btn-register');
        registerButtons.forEach(button => {
            button.addEventListener('click', function() {
                this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Loading...';
                this.disabled = true;
            });
        });

        // Show notification when form opens in new tab
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.get('form_opened')) {
            setTimeout(() => {
                alert('Admission form opened in new tab. You can continue working here.');
            }, 1000);
        }
    });
</script>

</body>
</html>