<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="http://127.0.0.1:8000/images/logo.png" rel="icon">
  <title>DEO - Pending Discharges</title>
  
  <link href="http://127.0.0.1:8000/admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="http://127.0.0.1:8000/admin/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="http://127.0.0.1:8000/admin/css/ruang-admin.css" rel="stylesheet">
  <link href="http://127.0.0.1:8000/css/app.css" rel="stylesheet">
  
  <style>
    body {
      background-color: #E8F4F3;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .navbar {
      background-color: #3D7C77 !important;
    }
    .navbar-brand, .nav-link {
      color: #FFFFFF !important;
    }
    .card {
      border: 2px solid #C7EAE7 !important;
      border-radius: 12px;
      box-shadow: 0 4px 20px rgba(199, 234, 231, 0.3);
      background-color: #C7EAE7 !important;
    }
    .card-body {
      background-color: #C7EAE7 !important;
    }
    .table thead th {
      background-color: #3D7C77 !important;
      color: white !important;
      border-bottom: 2px solid #2C3E50;
      padding: 15px 12px;
      font-weight: 600;
    }
    .table tbody tr {
      background-color: #FFFFFF;
      transition: all 0.3s ease;
    }
    .table tbody tr:hover {
      background-color: #9ED8D2 !important;
    }
    .table tbody td {
      border-bottom: 1px solid #E8F4F3;
      padding: 12px;
      color: #2C3E50;
    }
    .btn-process {
      background-color: #3D7C77 !important;
      color: #FFFFFF !important;
      border: 2px solid #3D7C77 !important;
      padding: 6px 12px;
      border-radius: 6px;
      text-decoration: none;
      display: inline-block;
      transition: all 0.3s ease;
    }
    .btn-process:hover {
      background-color: #2C3E50 !important;
      border-color: #2C3E50 !important;
      transform: translateY(-2px);
      box-shadow: 0 4px 8px rgba(61, 124, 119, 0.3);
      color: #FFFFFF !important;
    }
    .btn-delete {
      background-color: #3D7C77 !important;
      color: #FFFFFF !important;
      border: 2px solid #3D7C77 !important;
      padding: 6px 12px;
      border-radius: 6px;
      transition: all 0.3s ease;
    }
    .btn-delete:hover {
      background-color: #2C3E50 !important;
      border-color: #2C3E50 !important;
      transform: translateY(-2px);
      box-shadow: 0 4px 8px rgba(61, 124, 119, 0.3);
      color: #FFFFFF !important;
    }
    .badge-pending {
      background-color: #3D7C77;
      color: white;
      padding: 5px 10px;
      border-radius: 4px;
    }
    .alert-success {
      background-color: #C7EAE7;
      color: #2C3E50;
      border: 1px solid #9ED8D2;
      border-left: 4px solid #3D7C77;
      border-radius: 8px;
    }
    .alert-info {
      background-color: #C7EAE7;
      color: #2C3E50;
      border-color: #9ED8D2;
    }
    .text-center {
      color: #2C3E50;
    }
    @media (max-width: 768px) {
      .table thead th,
      .table tbody td {
        padding: 8px 6px;
        font-size: 14px;
      }
    }
  </style>
</head>

<body id="page-top">
  <div id="wrapper">
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        
        <!-- TopBar -->
        <nav class="navbar navbar-expand-lg navbar-dark">
          <a class="navbar-brand" href="/">
            <i class="fa fa-home"></i>
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                  aria-controls="navbarSupportedContent" aria-expanded="false"
                  aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto"></ul>
            <span class="title-text" style="margin-left: 100px; color: #FFFFFF; font-size: 2rem; font-weight: bold;">Half Way Home</span>
            <ul class="navbar-nav ml-auto">
              <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link user-dropdown" href="#" role="button"
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                   style="background-color: rgba(255, 255, 255, 0.15); color: #FFFFFF; border-radius: 25px; padding: 0.5rem 1.2rem;">
                  DEO <i class="fa fa-caret-down ml-1"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown" style="background-color: #3D7C77; border-radius: 8px;">
                  <a class="dropdown-item" href="#" style="color: #FFFFFF;">
                    <i class="fa fa-user mr-2"></i> Profile
                  </a>
                  <a class="dropdown-item" href="#" style="color: #FFFFFF;">
                    <i class="fa fa-cog mr-2"></i> Settings
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="http://127.0.0.1:8000/logout"
                     onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="color: #FFFFFF;">
                    <i class="fa fa-sign-out mr-2"></i> Logout
                  </a>
                  <form id="logout-form" action="http://127.0.0.1:8000/logout" method="POST" style="display: none;">
                    <input type="hidden" name="_token" value="WAJMJ7uS9DqKKtJsGzkxBjAGlPXOl0yFafP9AisT" autocomplete="off">                  </form>
                </div>
              </li>
            </ul>
          </div>
        </nav>

        <!-- Container Fluid-->
        <div class="container mt-4">    
          <div class="card mb-4">
            <div class="card-header">
              <div class="d-flex justify-content-between align-items-center">
                <h3 class="mb-0">List Of Pending Discharges</h3>
                <small class="text-muted">Auto-removal: Discharges are automatically removed when processed</small>
              </div>
            </div>
            <div class="card-body">
              
              @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  {{ session('success') }}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
              @endif
                            
              <form id="bulkDeleteForm" action="http://127.0.0.1:8000/deo/discharge/bulk-delete" method="POST">
                <input type="hidden" name="_token" value="WAJMJ7uS9DqKKtJsGzkxBjAGlPXOl0yFafP9AisT" autocomplete="off">                <div class="mb-3">
                  <button type="submit" class="btn-delete" onclick="return confirm('Are you sure you want to delete selected discharges?')">
                    <i class="fas fa-trash"></i> Delete Selected
                  </button>
                </div>
                
                <div style="overflow-x:auto;">   
                  <table class="table table-bordered table-hover text-center">
                    <thead>
                      <tr>
                        <th><strong>#</strong></th>
                        <th><strong>Select</strong></th>
                        <th><strong>Full Name</strong></th>
                        <th><strong>Discharge Date</strong></th>
                        <th><strong>CNIC</strong></th>
                        <th><strong>Admission Date</strong></th>
                        <th><strong>District</strong></th>
                        <th><strong>Status</strong></th>
                        <th><strong>Actions</strong></th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($pendingDischarges as $index => $discharge)
                      <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                          <input type="checkbox" name="selected_discharges[]" value="{{ $discharge->id }}" form="bulkDeleteForm">
                        </td>
                        <td>{{ $discharge->name }}</td>
                        <td>{{ $discharge->discharge_date }}</td>
                        <td>{{ $discharge->cnic }}</td>
                        <td>{{ $discharge->admission_date }}</td>
                        <td>{{ $discharge->district }}</td>
                        <td>
                          <span class="badge badge-pending">Pending</span>
                        </td>
                        <td>
                          <div class="d-flex gap-1 justify-content-center">
                            <!-- ✅ FIXED: Link to discharge form with correct parameter -->
                            <a href="{{ route('hwhadmissions.discharges.create', $discharge->id) }}" 
                               class="btn-process" 
                               title="Process Discharge through HWH System">
                              <i class="fas fa-sign-out-alt"></i> Process Discharge
                            </a>
                            
                            <!-- Delete Form -->
                            <form action="{{ route('deo.discharge.destroy', $discharge->id) }}" method="POST" style="display: inline;">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="btn-delete" 
                                      onclick="return confirm('Are you sure you want to delete this pending discharge?')"
                                      title="Delete Pending Discharge">
                                <i class="fas fa-trash"></i>
                              </button>
                            </form>
                          </div>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </form>
              
              @if($pendingDischarges->isEmpty())
                <div class="text-center py-5">
                  <i class="fas fa-check-circle fa-3x text-success mb-3"></i>
                  <h4 class="text-success">No Pending Discharges</h4>
                  <p class="text-muted">All discharges have been processed or no pending discharges found.</p>
                </div>
              @endif
            </div>
          </div>
        </div>

      </div>
      
      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="row" style="background-color: white">
          <div class="col-sm-0 col-md-4" style="text-align: center;"></div>
          <div class="col-sm-12 col-md-4" style="text-align: center;">
            <img style="width: 50px" src="http://127.0.0.1:8000/assets/img/PITBLOGO.png" />
            <small><b>A project of Government of the Punjab</b></small>
            <img style="width: 60px" src="http://127.0.0.1:8000/assets/img/swd.png" />
          </div>
          <div class="col-sm-0 col-md-4" style="text-align: center;"></div>
        </div>
      </footer>
    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="http://127.0.0.1:8000/admin/vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="http://127.0.0.1:8000/admin/js/ruang-admin.min.js"></script>

  <script>
    // Auto-dismiss alerts after 5 seconds
    setTimeout(function() {
      const alerts = document.querySelectorAll('.alert');
      alerts.forEach(alert => {
        alert.style.display = 'none';
      });
    }, 5000);

    // Select all checkboxes
    function selectAll(source) {
      const checkboxes = document.getElementsByName('selected_discharges[]');
      for(let i=0; i<checkboxes.length; i++) {
        checkboxes[i].checked = source.checked;
      }
    }

    // Refresh page every 30 seconds to check for auto-removed discharges
    setInterval(function() {
      if (document.querySelector('tbody tr')) {
        window.location.reload();
      }
    }, 30000);
  </script>
</body>
</html>