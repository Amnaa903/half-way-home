<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration List - Half Way Home</title>
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
        
        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }
        
        .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
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
        
        .alert {
            border-left: 4px solid #3D7C77;
        }
        
        .action-buttons {
            display: flex;
            gap: 5px;
            flex-wrap: wrap;
        }
        
        .status-badge {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.8em;
            font-weight: 500;
        }
        
        .status-pending {
            background-color: #fff3cd;
            color: #856404;
        }
        
        .status-registered {
            background-color: #d1edff;
            color: #0c5460;
        }
        
        .bulk-actions {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            border-left: 4px solid #3D7C77;
        }
    </style>
</head>
<body class="bg-light">
    <nav class="navbar navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="http://127.0.0.1:8000/incharge/dashboard">
                <i class="fas fa-home"></i> Half Way Home
            </a>
            <div>
                <a href="http://127.0.0.1:8000/incharge/dashboard" class="btn btn-light me-2">
                    <i class="fas fa-arrow-left"></i> Dashboard
                </a>
                <a href="http://127.0.0.1:8000/incharge/registration/create" class="btn btn-success">
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
                
                
                
                <!-- User Info -->
                <div class="alert alert-info">
                    <strong>User Info:</strong><br>
                    District: Lahore<br>
                    Total Records: 2
                </div>

                <!-- Bulk Actions -->
                <div class="bulk-actions">
                    <form id="bulkForm" action="http://127.0.0.1:8000/incharge/registration/bulk-delete" method="POST">
                        <input type="hidden" name="_token" value="WJHzvmX8xj51bUQRhPRSceuxrjL2TZjc6ICLyy8t" autocomplete="off">                        <input type="hidden" name="_method" value="DELETE">                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="selectAll">
                                    <label class="form-check-label" for="selectAll">
                                        <strong>Select All</strong>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6 text-end">
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete selected registrations?')">
                                    <i class="fas fa-trash"></i> Delete Selected
                                </button>
                                <a href="http://127.0.0.1:8000/incharge/registration/export" class="btn btn-warning btn-sm">
                                    <i class="fas fa-download"></i> Export
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th width="50">Select</th>
                                <th>#</th>
                                <th>Full Name</th>
                                <th>Date</th>
                                <th>CNIC</th>
                                <th>District</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <input type="checkbox" name="selected_ids[]" value="19" class="form-check-input row-checkbox">
                                </td>
                                <td>1</td>
                                <td>zeeshan</td>
                                <td>2025-11-18</td>
                                <td>3333333333333</td>
                                <td>Lahore</td>
                                <td>
                                    <span class="status-badge status-pending">
                                        <i class="fas fa-clock"></i> Pending
                                    </span>
                                </td>
                                <td>23-11-2025 13:44</td>
                                <td>
                                    <div class="action-buttons">
                                        <!-- Delete Button -->
                                        <form action="http://127.0.0.1:8000/incharge/registration/19" method="POST" class="d-inline">
                                            <input type="hidden" name="_token" value="WJHzvmX8xj51bUQRhPRSceuxrjL2TZjc6ICLyy8t" autocomplete="off">                                                <input type="hidden" name="_method" value="DELETE">                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete this registration?')">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </form>
                                        
                                        <!-- Edit Button -->
                                        <button type="button" class="btn btn-primary btn-sm" onclick="editRegistration(19)">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="checkbox" name="selected_ids[]" value="14" class="form-check-input row-checkbox">
                                </td>
                                <td>2</td>
                                <td>waqar</td>
                                <td>2025-11-21</td>
                                <td>1111111111111</td>
                                <td>Lahore</td>
                                <td>
                                    <span class="status-badge status-pending">
                                        <i class="fas fa-clock"></i> Pending
                                    </span>
                                </td>
                                <td>21-11-2025 10:22</td>
                                <td>
                                    <div class="action-buttons">
                                        <!-- Delete Button -->
                                        <form action="http://127.0.0.1:8000/incharge/registration/14" method="POST" class="d-inline">
                                            <input type="hidden" name="_token" value="WJHzvmX8xj51bUQRhPRSceuxrjL2TZjc6ICLyy8t" autocomplete="off">                                                <input type="hidden" name="_method" value="DELETE">                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete this registration?')">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </form>
                                        
                                        <!-- Edit Button -->
                                        <button type="button" class="btn btn-primary btn-sm" onclick="editRegistration(14)">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Registration</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editForm" method="POST">
                    <input type="hidden" name="_token" value="WJHzvmX8xj51bUQRhPRSceuxrjL2TZjc6ICLyy8t" autocomplete="off">                    <input type="hidden" name="_method" value="PUT">                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="edit_rname" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="edit_rname" name="rname" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_reg_date" class="form-label">Date</label>
                            <input type="date" class="form-control" id="edit_reg_date" name="reg_date" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_rcnic" class="form-label">CNIC</label>
                            <input type="text" class="form-control" id="edit_rcnic" name="rcnic" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
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

        // Select All functionality
        document.getElementById('selectAll').addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('.row-checkbox');
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
        });

        // Bulk form submission
        document.getElementById('bulkForm').addEventListener('submit', function(e) {
            const selectedCheckboxes = document.querySelectorAll('.row-checkbox:checked');
            if (selectedCheckboxes.length === 0) {
                e.preventDefault();
                alert('Please select at least one registration to delete.');
                return false;
            }
        });

        // Edit Registration Function
        function editRegistration(id) {
            // Fetch registration data
            fetch(`/incharge/registration/${id}/edit-data`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Populate form
                        document.getElementById('edit_rname').value = data.registration.rname;
                        document.getElementById('edit_reg_date').value = data.registration.reg_date;
                        document.getElementById('edit_rcnic').value = data.registration.rcnic;
                        
                        // Set form action
                        document.getElementById('editForm').action = `/incharge/registration/${id}`;
                        
                        // Show modal
                        const modal = new bootstrap.Modal(document.getElementById('editModal'));
                        modal.show();
                    } else {
                        alert('Error loading registration data.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error loading registration data.');
                });
        }

        // Edit form submission
        document.getElementById('editForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            
            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert('Error updating registration.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error updating registration.');
            });
        });

        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            // Ctrl + E to refresh
            if (e.ctrlKey && e.key === 'e') {
                e.preventDefault();
                window.location.reload();
            }
            
            // Ctrl + N for new registration
            if (e.ctrlKey && e.key === 'n') {
                e.preventDefault();
                window.location.href = "http://127.0.0.1:8000/incharge/registration/create";
            }
        });
    </script>
</body>
</html>