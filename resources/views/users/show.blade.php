<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details - Half Way Home</title>
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
        
        .title-text {
            color: #FFFFFF;
            font-size: 1.8rem;
            font-weight: bold;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.3);
            letter-spacing: 0.5px;
            margin: 0 1rem;
            position: relative;
            padding: 0.3rem 1rem;
            background: rgba(255,255,255,0.1);
            border-radius: 10px;
            border-left: 3px solid #9ED8D2;
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
            .title-text {
                font-size: 1.5rem;
                margin: 10px 0;
                text-align: center;
                width: 100%;
            }
            
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

        /* Detail Items Styling */
        .detail-item {
            margin-bottom: 1.5rem;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            border-left: 5px solid #3D7C77;
            transition: all 0.3s ease;
        }

        .detail-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .detail-value {
            font-size: 18px;
            color: #2C3E50;
            margin: 8px 0 0 0;
            font-weight: 600;
        }

        .detail-item strong {
            font-size: 16px;
            color: #3D7C77;
            display: block;
            margin-bottom: 5px;
        }

        /* Badge Styling */
        .badge-pill {
            background-color: #9ED8D2 !important;
            color: #2C3E50 !important;
            padding: 10px 20px !important;
            font-size: 14px !important;
            margin: 5px !important;
            border-radius: 20px !important;
            font-weight: 600;
            border: 2px solid transparent;
            transition: all 0.3s ease;
        }

        .badge-pill:hover {
            background-color: #3D7C77 !important;
            color: #FFFFFF !important;
            border-color: #9ED8D2;
        }

        /* Button Styling */
        .btn-primary {
            background: linear-gradient(135deg, #9ED8D2 0%, #7DC6C0 100%);
            border: none;
            border-radius: 8px;
            padding: 12px 25px;
            font-weight: 600;
            transition: all 0.3s ease;
            color: #2C3E50;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #7DC6C0 0%, #9ED8D2 100%);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            color: #2C3E50;
        }

        .btn-secondary {
            background: linear-gradient(135deg, #3D7C77 0%, #2C5C58 100%);
            border: none;
            border-radius: 8px;
            padding: 12px 25px;
            font-weight: 600;
            transition: all 0.3s ease;
            color: #FFFFFF;
        }

        .btn-secondary:hover {
            background: linear-gradient(135deg, #2C5C58 0%, #3D7C77 100%);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            color: #FFFFFF;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .main-content {
                padding: 15px;
            }
            
            .card-body {
                padding: 1.5rem;
            }
            
            .detail-item {
                padding: 15px;
                margin-bottom: 1rem;
            }
            
            .detail-value {
                font-size: 16px;
            }
            
            .btn {
                display: block;
                width: 100%;
                margin-bottom: 10px;
            }
        }
    </style>
</head>
<body>
    @include('layouts.app1')

    <!-- Main Content -->
    <div class="main-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-10 col-xl-8">

                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <h3 class="mb-0">
                                        <i class="fa fa-user-circle mr-2"></i>User Details
                                    </h3>
                                </div>
                                <div class="col-md-6 text-md-right">
                                    <a class="btn btn-secondary" href="{{ route('users.index') }}">
                                        <i class="fa fa-arrow-left mr-2"></i> Back to Users
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row">

                                <!-- Name -->
                                <div class="col-md-6">
                                    <div class="detail-item">
                                        <strong><i class="fa fa-user mr-2"></i>Full Name:</strong>
                                        <p class="detail-value">{{ $user->name ?? 'N/A' }}</p>
                                    </div>
                                </div>

                                <!-- Email -->
                                <div class="col-md-6">
                                    <div class="detail-item">
                                        <strong><i class="fa fa-envelope mr-2"></i>Email Address:</strong>
                                        <p class="detail-value">{{ $user->email ?? 'N/A' }}</p>
                                    </div>
                                </div>

                                <!-- District -->
                                <div class="col-md-6">
                                    <div class="detail-item">
                                        <strong><i class="fa fa-map-marker mr-2"></i>District:</strong>
                                        <p class="detail-value">{{ $user->district ?? 'N/A' }}</p>
                                    </div>
                                </div>

                                <!-- Roles -->
                                <div class="col-md-6">
                                    <div class="detail-item">
                                        <strong><i class="fa fa-shield mr-2"></i>User Roles:</strong>
                                        <p class="detail-value">
                                            @if(!empty($user->getRoleNames()))
                                                @foreach($user->getRoleNames() as $v)
                                                    <span class="badge badge-pill">
                                                        <i class="fa fa-tag mr-1"></i>{{ $v }}
                                                    </span>
                                                @endforeach
                                            @else
                                                <span class="text-muted">No roles assigned</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>

                                <!-- Created At -->
                                <div class="col-md-6">
                                    <div class="detail-item">
                                        <strong><i class="fa fa-calendar-plus mr-2"></i>Created At:</strong>
                                        <p class="detail-value">
                                            @if($user->created_at)
                                                {{ $user->created_at->format('M d, Y h:i A') }}
                                            @else
                                                N/A
                                            @endif
                                        </p>
                                    </div>
                                </div>

                                <!-- Updated At -->
                                <div class="col-md-6">
                                    <div class="detail-item">
                                        <strong><i class="fa fa-calendar-check mr-2"></i>Last Updated:</strong>
                                        <p class="detail-value">
                                            @if($user->updated_at)
                                                {{ $user->updated_at->format('M d, Y h:i A') }}
                                            @else
                                                N/A
                                            @endif
                                        </p>
                                    </div>
                                </div>

                            </div>

                            <!-- Action Buttons -->
                            <div class="row mt-4">
                                <div class="col-12 text-center">
                                    <a class="btn btn-primary mr-2 mb-2" 
                                       href="{{ route('users.edit', $user->id) }}">
                                        <i class="fa fa-edit mr-2"></i> Edit User
                                    </a>

                                    <a class="btn btn-secondary mb-2" 
                                       href="{{ route('users.index') }}">
                                        <i class="fa fa-list mr-2"></i> All Users
                                    </a>
                                </div>
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