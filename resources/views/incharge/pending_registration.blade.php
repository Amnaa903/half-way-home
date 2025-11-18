<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Pending Registration - Half Way Home</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  
  <style>
    body {
        background-color: #E8F4F3;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: #2C3E50;
    }

    .navbar {
        background-color: #3D7C77 !important;
        padding: 0.5rem 1rem;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    
    .navbar-brand {
        color: #FFFFFF !important;
        font-weight: bold;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }
    
    .navbar-brand:hover {
        transform: scale(1.1);
    }
    
    .navbar-brand i {
        font-size: 1.5rem;
        margin-right: 0.5rem;
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

    .table thead tr {
        background-color: #3D7C77 !important;
        color: #FFFFFF !important;
    }

    .table thead th {
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

    .button {
        border: none;
        border-radius: 8px;
        padding: 8px 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
        text-align: center;
    }

    .btn-register {
        background-color: #3D7C77 !important;
        color: #FFFFFF !important;
        border: 2px solid #3D7C77 !important;
    }

    .btn-register:hover {
        background-color: #2C3E50 !important;
        border-color: #2C3E50 !important;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(61, 124, 119, 0.3);
    }

    .btn-delete {
        background-color: #3D7C77 !important;
        color: #FFFFFF !important;
        border: 2px solid #3D7C77 !important;
    }

    .btn-delete:hover {
        background-color: #2C3E50 !important;
        border-color: #2C3E50 !important;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(61, 124, 119, 0.3);
    }

    .danger-text {
        color: #3D7C77 !important;
    }

    .text-center {
        color: #2C3E50;
    }

    .container {
        background-color: #E8F4F3;
        padding: 20px;
        border-radius: 12px;
        margin-top: 80px;
    }

    @media (max-width: 768px) {
        .table thead th,
        .table tbody td {
            padding: 8px 6px;
            font-size: 14px;
        }
        
        .button {
            padding: 6px 12px;
            font-size: 14px;
        }
    }
  </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <a class="navbar-brand" href="/">
            <i class="fas fa-home"></i>
        </a>
        
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <span class="navbar-text mx-auto" style="font-size: 1.8rem; font-weight: bold; color: white;">Half Way Home</span>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link" href="#" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                       style="background-color: rgba(255, 255, 255, 0.15); color: #FFFFFF; border-radius: 25px; padding: 0.5rem 1.2rem;">
                        INCHARGE <i class="fas fa-caret-down ml-1"></i>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-user mr-2"></i> Profile
                        </a>
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-cog mr-2"></i> Settings
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-sign-out-alt mr-2"></i> Logout
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

<div class="container mt-4">    
<div class="card mb-4">
    <div class="card-body">
        <!-- Grid row -->
        <div class="row">
            <!-- Grid column -->
            <div class="col-md-12">
                <h3 class="pt-3 pb-4 text-center font-bold font-up danger-text">List Of Residents For Registration</h3>
            </div>
            <!-- Grid column -->
        </div>
        <!-- Grid row -->

        <div style="overflow-x:auto;">   
        <table class="table table-bordered text-center">
            <thead>
                 <tr>
                    <th><strong>#</strong></th>
                    <th><strong>Full Name</strong></th>
                    <th><strong>Date</strong></th>
                    <th><strong>CNIC</strong></th>
                    <th><strong>Action</strong></th>
                </tr>
            </thead>
            <tbody>
                <!-- Dynamic data will appear here -->
                <tr>
                    <th>1</th>
                    <td>John Doe</td>
                    <td>2024-01-15</td>
                    <td>12345-6789012-3</td>
                    <td>
                        <form action="#" method="post" style="display: inline-block; margin-top: 5px;">
                            @csrf
                            @method('DELETE')
                            <button class="button btn-delete">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </form>
                    </td>
                </tr>
                <tr>
                    <th>2</th>
                    <td>Jane Smith</td>
                    <td>2024-01-16</td>
                    <td>98765-4321098-7</td>
                    <td>
                        <form action="#" method="post" style="display: inline-block; margin-top: 5px;">
                            @csrf
                            @method('DELETE')
                            <button class="button btn-delete">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
</div>

<!-- Footer -->
<footer class="sticky-footer bg-white mt-4">
  <div class="row" style="background-color: white">
        <div class="col-sm-0 col-md-4" style="text-align: center;"></div>
        <div class="col-sm-12 col-md-4" style="text-align: center;">
          <img style="width: 50px" src="http://127.0.0.1:8000/images/PITBLOGO.png" />
          <small><b>A project of Government of the Punjab</b></small>
          <img style="width: 60px" src="http://127.0.0.1:8000/images/swd.png" />
        </div>
        <div class="col-sm-0 col-md-4" style="text-align: center;"></div>
  </div>
</footer>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>