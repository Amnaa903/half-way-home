
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending Discharge List - Incharge</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        body { background-color: #E8F4F3; font-family: 'Segoe UI'; color: #2C3E50; }
        .card { border: 2px solid #3D7C77; border-radius: 12px; }
        .card-header { background: linear-gradient(135deg, #3D7C77 0%, #2C5C58 100%); color: white; }
        .table thead th { background-color: #3D7C77 !important; color: white !important; }
        .btn-light { background-color: #9ED8D2; color: #2C3E50; }
        .badge-pending { background-color: #3D7C77; color: white; }
    </style>
</head>
<body>
<div class="container mt-4">
    <div class="card mb-4">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="mb-0"><i class="fas fa-list"></i> Pending Discharge List</h3>
                <a href="{{ route('incharge.discharge.create') }}" class="btn btn-light btn-sm">
                    <i class="fas fa-plus"></i> Add New
                </a>
            </div>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            
            @if($pendingDischarges->count() > 0)
            <div style="overflow-x:auto;">
                <table class="table table-bordered table-hover text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Full Name</th>
                            <th>Discharge Date</th>
                            <th>CNIC</th>
                            <th>Admission Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pendingDischarges as $index => $discharge)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $discharge->resident_name }}</td>
                            <td>{{ $discharge->discharge_date }}</td>
                            <td>{{ $discharge->cnic }}</td>
                            <td>{{ $discharge->admission_date }}</td>
                            <td><span class="badge badge-pending">Pending</span></td>
                            <td>
                                <form action="{{ route('discharge.destroy', $discharge->id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" 
                                            onclick="return confirm('Delete this discharge?')">
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
            <div class="text-center py-4">
                <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">No Pending Discharges</h5>
                <a href="{{ route('incharge.discharge.create') }}" class="btn btn-light">
                    <i class="fas fa-plus"></i> Create New Discharge List
                </a>
            </div>
            @endif
        </div>
    </div>
</div>
</body>
</html>