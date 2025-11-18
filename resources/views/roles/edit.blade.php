<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Role - Half Way Home</title>
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

        /* Form Styles */
        .form-control {
            border: 1px solid #3D7C77;
            border-radius: 8px;
            padding: 10px 15px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #3D7C77;
            box-shadow: 0 0 0 0.2rem rgba(61, 124, 119, 0.25);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group strong {
            color: #3D7C77;
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
        }

        .btn-primary {
            background: linear-gradient(135deg, #3D7C77, #4A9A94);
            border: none;
            border-radius: 8px;
            padding: 10px 25px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #4A9A94, #5BB8B2);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        .alert {
            background-color: #9ED8D2;
            color: #2C5C58;
            border: 1px solid #3D7C77;
            border-radius: 8px;
            padding: 1rem 1.5rem;
        }

        .alert ul {
            margin-bottom: 0;
            padding-left: 1rem;
        }

        /* Permission Grid Styles */
        .permission-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 12px;
            margin-top: 10px;
        }
        
        .permission-item {
            padding: 12px 15px;
            background: rgba(255, 255, 255, 0.7);
            border-radius: 8px;
            border-left: 4px solid #3D7C77;
            transition: all 0.3s ease;
        }
        
        .permission-item:hover {
            background: rgba(255, 255, 255, 0.9);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        
        .permission-checkbox {
            margin-right: 8px;
            transform: scale(1.1);
        }
        
        .permission-item label {
            color: #3D7C77;
            font-weight: 500;
            margin-bottom: 0;
            cursor: pointer;
            display: flex;
            align-items: center;
        }

        /* Container adjustments */
        .container-fluid {
            padding: 0 15px;
        }

        @media (max-width: 768px) {
            .main-content {
                padding: 15px;
            }
            
            .card-body {
                padding: 1.5rem;
            }
            
            .permission-grid {
                grid-template-columns: 1fr;
                gap: 8px;
            }
            
            .btn-lg {
                padding: 8px 20px;
                font-size: 1rem;
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
                                    <h3 class="mb-0">Edit Role</h3>
                                </div>
                                <div class="col-md-6 text-right">
                                    <a class="btn btn-primary" href="{{ route('roles.index') }}">
                                        <i class="fa fa-arrow-left"></i> Back
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                                </ul>
                            </div>
                            @endif

                            <form method="POST" action="{{ route('roles.update', $role->id) }}">
                                @csrf
                                @method('PATCH')
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>Name:</strong>
                                            <input type="text" name="name" class="form-control" placeholder="Name" value="{{ $role->name }}">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>Permission:</strong>
                                            <br/>
                                            <div class="permission-grid">
                                                @foreach($permission as $value)
                                                <div class="permission-item">
                                                    <label>
                                                        <input type="checkbox" name="permission[]" value="{{ $value->id }}" class="name permission-checkbox" 
                                                            {{ in_array($value->id, $rolePermissions) ? 'checked' : '' }}>
                                                        {{ $value->name }}
                                                    </label>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                        <button type="submit" class="btn btn-primary btn-lg" style="padding: 10px 30px;">
                                            <i class="fa fa-save"></i> Submit
                                        </button>
                                    </div>
                                </div>
                            </form>
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