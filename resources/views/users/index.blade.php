<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users Management - Half Way Home</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta/css/bootstrap.min.css">
    <style>
        /* Navbar Styles - Fixed */
        .navbar {
            background: linear-gradient(135deg, #3D7C77 0%, #2C5C58 100%) !important;
            padding: 0.5rem 1rem;
            box-shadow: 0 4px 18px rgba(0,0,0,0.15);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1030;
            transition: all 0.3s ease;
        }
        
        .navbar-brand {
            color: #FFFFFF !important;
            font-weight: bold;
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
            font-size: 1.4rem;
        }
        
        .navbar-brand:hover {
            transform: scale(1.05);
            color: #9ED8D2 !important;
        }
        
        .navbar-brand i {
            font-size: 1.8rem;
            margin-right: 0.5rem;
        }
        
        .navbar-toggler {
            border-color: rgba(255,255,255,0.5);
            padding: 0.25rem 0.5rem;
        }
        
        .navbar-toggler:focus {
            box-shadow: 0 0 0 2px rgba(255,255,255,0.5);
        }
        
        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3e%3cpath stroke='rgba(255, 255, 255, 0.9)' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
            width: 1.2em;
            height: 1.2em;
        }
        
        .nav-link {
            color: #FFFFFF !important;
            transition: all 0.3s ease;
            margin: 0 8px;
            font-weight: 500;
            position: relative;
            padding: 0.5rem 1rem !important;
            border-radius: 6px;
        }
        
        .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.15);
            transform: translateY(-2px);
        }
        
        .nav-link.active {
            background-color: rgba(255, 255, 255, 0.2);
            font-weight: 600;
        }
        
        .dropdown-menu {
            border: none;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
            background-color: #3D7C77;
            border-radius: 10px;
            padding: 8px 0;
            margin-top: 10px;
            min-width: 200px;
        }
        
        .dropdown-item {
            color: #FFFFFF;
            transition: all 0.3s ease;
            padding: 10px 20px;
            font-weight: 500;
            display: flex;
            align-items: center;
        }
        
        .dropdown-item:hover {
            background-color: #9ED8D2;
            color: #2C3E50;
            transform: translateX(5px);
        }
        
        .dropdown-divider {
            border-top: 1px solid rgba(255,255,255,0.2);
            margin: 8px 0;
        }
        
        .user-dropdown {
            background: linear-gradient(135deg, rgba(255,255,255,0.15), rgba(255,255,255,0.1));
            color: #FFFFFF;
            border-radius: 30px;
            padding: 0.5rem 1.2rem;
            transition: all 0.3s ease;
            border: 1px solid rgba(255,255,255,0.3);
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            display: flex;
            align-items: center;
        }
        
        .user-dropdown:hover {
            background: linear-gradient(135deg, rgba(255,255,255,0.25), rgba(255,255,255,0.15));
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(0,0,0,0.2);
            border-color: rgba(255,255,255,0.5);
        }
        
        .nav-item.dropdown.show .user-dropdown {
            background: linear-gradient(135deg, rgba(255,255,255,0.25), rgba(255,255,255,0.15));
        }

        .login-btn {
            background: linear-gradient(135deg, rgba(255,255,255,0.15), rgba(255,255,255,0.1));
            color: #FFFFFF;
            border: 1px solid rgba(255,255,255,0.3);
            border-radius: 25px;
            padding: 8px 20px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            display: flex;
            align-items: center;
        }

        .login-btn:hover {
            background: linear-gradient(135deg, rgba(255,255,255,0.25), rgba(255,255,255,0.15));
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(0,0,0,0.2);
            color: #FFFFFF;
        }

        @media (max-width: 991px) {
            .navbar-nav {
                margin-top: 15px;
                text-align: center;
            }
            
            .user-dropdown, .login-btn {
                display: inline-flex;
                margin-top: 10px;
                justify-content: center;
            }
            
            .dropdown-menu {
                text-align: center;
            }
        }

        /* Main Content - Adjusted for fixed navbar */
        .main-content {
            padding: 30px;
            min-height: 100vh;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            margin-top: 70px; /* Navbar height */
        }

        /* Card Styles */
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        .card-header {
            background: linear-gradient(135deg, #3D7C77 0%, #2C5C58 100%) !important;
            color: #FFFFFF;
            padding: 1.5rem;
            border-bottom: none;
        }

        .card-body {
            background-color: #C7EAE7;
            padding: 2rem;
        }

        /* Table Styles */
        .table {
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        }

        .table th {
            background-color: #3D7C77;
            color: white;
            border: none;
            padding: 15px 10px;
            font-weight: 600;
            text-align: center;
        }

        .table td {
            border-color: #e9ecef;
            padding: 12px 10px;
            vertical-align: middle;
            text-align: center;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(61, 124, 119, 0.05);
        }

        /* Button Styles */
        .btn-success {
            background: linear-gradient(135deg, #3D7C77, #4A9A94);
            border: none;
            border-radius: 8px;
            padding: 10px 20px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-success:hover {
            background: linear-gradient(135deg, #4A9A94, #5BB8B2);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        .btn-info, .btn-primary, .btn-danger {
            border: none;
            border-radius: 6px;
            padding: 6px 12px;
            font-weight: 500;
            transition: all 0.3s ease;
            font-size: 0.875rem;
        }

        .btn-info {
            background: linear-gradient(135deg, #3D7C77, #4A9A94);
        }

        .btn-info:hover {
            background: linear-gradient(135deg, #4A9A94, #5BB8B2);
            transform: translateY(-1px);
        }

        .btn-primary {
            background: linear-gradient(135deg, #9ED8D2, #8BC8C2);
            color: #2C3E50;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #8BC8C2, #7AB8B2);
            transform: translateY(-1px);
            color: #2C3E50;
        }

        .btn-danger {
            background: linear-gradient(135deg, #C7EAE7, #B6DAD7);
            color: #2C3E50;
        }

        .btn-danger:hover {
            background: linear-gradient(135deg, #B6DAD7, #A5CAC7);
            transform: translateY(-1px);
            color: #2C3E50;
        }

        /* Alert Styles */
        .alert {
            background-color: #9ED8D2;
            color: #2C5C58;
            border: 1px solid #3D7C77;
            border-radius: 8px;
            padding: 1rem 1.5rem;
        }

        /* Badge Styles */
        .badge {
            background-color: #9ED8D2;
            color: #2C3E50;
            padding: 5px 10px;
            border-radius: 12px;
            font-size: 0.75em;
            font-weight: 500;
        }

        /* Pagination Styles */
        .pagination {
            justify-content: center;
        }

        .page-link {
            color: #3D7C77;
            border: 1px solid #9ED8D2;
            padding: 8px 16px;
        }

        .page-link:hover {
            color: #2C5C58;
            background-color: #9ED8D2;
            border-color: #3D7C77;
        }

        .page-item.active .page-link {
            background-color: #3D7C77;
            border-color: #3D7C77;
            color: white;
        }

        /* Button Group */
        .btn-group .btn {
            margin: 2px;
        }

        .btn-group form {
            display: inline;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .main-content {
                padding: 15px;
            }
            
            .card-body {
                padding: 1.5rem;
            }
            
            .table-responsive {
                font-size: 0.875rem;
            }
            
            .btn-group {
                display: flex;
                flex-direction: column;
            }
            
            .btn-group .btn {
                margin: 2px 0;
            }
        }
    </style>
</head>
<body>
    @include('layouts.app1')
    <!-- Navbar - Fixed -->
    <!-- <nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand" href="/">
            <i class="fa fa-home"></i>
            <span>Half Way Home</span>
        </a>
        
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                @guest
                <li class="nav-item">
                    <a class="nav-link login-btn" href="{{ route('login') }}">
                        <i class="fa fa-sign-in me-2"></i>Login
                    </a>
                </li>
                @endguest
                
                @auth
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link user-dropdown" href="#" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-user me-2"></i>{{ Auth::user()->name }} <i class="fa fa-caret-down ml-1"></i>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">
                            <i class="fa fa-user-circle mr-2"></i> My Profile
                        </a>
                        <a class="dropdown-item" href="#">
                            <i class="fa fa-cog mr-2"></i> Settings
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out mr-2"></i> Logout
                        </a>
                        
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
                @endauth
            </ul>
        </div>
    </nav> -->

    <!-- Main Content -->
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="mb-0">Users Management</h3>
                                </div>
                                <div class="col-md-6 text-right">
                                    <a class="btn btn-success" href="{{ route('users.create') }}">
                                        <i class="fa fa-plus"></i> Create New User
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <p class="mb-0">{{ $message }}</p>
                            </div>
                            @endif

                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th style="width: 50px;">No</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>District</th>
                                            <th>Roles</th>
                                            <th width="280px">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $key => $user)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->district }}</td>
                                            <td>
                                                @if(!empty($user->getRoleNames()))
                                                    @foreach($user->getRoleNames() as $v)
                                                        <span class="badge badge-pill">{{ $v }}</span>
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a class="btn btn-info btn-sm" href="{{ route('users.show',$user->id) }}">
                                                        <i class="fa fa-eye"></i> Show
                                                    </a>
                                                    <a class="btn btn-primary btn-sm" href="{{ route('users.edit',$user->id) }}">
                                                        <i class="fa fa-edit"></i> Edit
                                                    </a>
                                                    <form method="POST" action="{{ route('users.destroy', $user->id) }}" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?')">
                                                            <i class="fa fa-trash"></i> Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="d-flex justify-content-center mt-4">
                                {!! $data->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>