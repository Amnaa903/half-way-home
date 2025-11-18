<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Half Way Home - Admin Dashboard</title>
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

        /* Dashboard Styles */
        .dashboard-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            margin: 2rem auto;
            padding: 2rem;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            border: 1px solid rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            max-width: 1200px;
        }

        .main-title {
            color: #3D7C77;
            font-size: 2.8rem;
            font-weight: bold;
            text-align: center;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
            position: relative;
            padding-bottom: 1rem;
        }

        .main-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 4px;
            background: linear-gradient(135deg, #3D7C77, #4A9A94);
            border-radius: 2px;
        }

        .welcome-text {
            color: #666;
            font-size: 1.3rem;
            text-align: center;
            margin-bottom: 2rem;
            font-weight: 500;
            line-height: 1.6;
        }

        /* Cards Container - Updated for smaller cards */
        .cards-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin: 2rem 0;
        }

        .management-card {
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
            border: none;
            border-radius: 12px;
            padding: 20px;
            text-align: center;
            transition: all 0.3s ease;
            box-shadow: 0 6px 15px rgba(0,0,0,0.08);
            border-left: 4px solid #3D7C77;
            position: relative;
            overflow: hidden;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .management-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(135deg, #3D7C77, #4A9A94);
        }

        .management-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.12);
        }

        .card-icon {
            font-size: 2.5rem;
            color: #3D7C77;
            margin-bottom: 1rem;
            transition: all 0.3s ease;
        }

        .management-card:hover .card-icon {
            transform: scale(1.05);
            color: #4A9A94;
        }

        .card-title {
            color: #2C5C58;
            font-size: 1.2rem;
            font-weight: bold;
            margin-bottom: 0.8rem;
        }

        .card-description {
            color: #666;
            font-size: 0.85rem;
            line-height: 1.4;
            margin-bottom: 1.2rem;
            flex-grow: 1;
        }

        .card-btn {
            background: linear-gradient(135deg, #3D7C77, #4A9A94);
            color: white;
            border: none;
            border-radius: 6px;
            padding: 8px 18px;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            align-self: flex-start;
            margin: 0 auto;
        }

        .card-btn:hover {
            background: linear-gradient(135deg, #4A9A94, #5BB8B2);
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0,0,0,0.15);
            color: white;
            text-decoration: none;
        }

        /* Statistics Section */
        .statistics-section {
            background: linear-gradient(135deg, #3D7C77, #4A9A94);
            border-radius: 15px;
            padding: 2rem;
            margin-top: 2rem;
            color: white;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }

        .statistics-title {
            color: white;
            font-size: 1.6rem;
            font-weight: bold;
            margin-bottom: 1.5rem;
            text-align: center;
            position: relative;
            padding-bottom: 1rem;
        }

        .statistics-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background: rgba(255,255,255,0.5);
            border-radius: 2px;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            padding: 1.2rem;
            text-align: center;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
            height: 100%;
        }

        .stat-card:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-3px);
        }

        .stat-number {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
            color: #9ED8D2;
        }

        .stat-label {
            font-size: 0.9rem;
            opacity: 0.9;
        }

        @media (max-width: 768px) {
            .cards-container {
                grid-template-columns: 1fr;
            }
            
            .main-title {
                font-size: 2.2rem;
            }
            
            .dashboard-container {
                padding: 1.5rem;
                margin: 1rem;
            }
            
            .statistics-section {
                padding: 1.5rem;
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
        <div class="dashboard-container">
            <!-- Main Title -->
            <h1 class="main-title">Half Way Home - Admin Dashboard</h1>

            
            <!-- Management Cards -->
            <div class="cards-container">
                <div class="management-card">
                    <div class="card-icon">
                        <i class="fa fa-users"></i>
                    </div>
                    <h3 class="card-title">Manage Users</h3>
                    <a href="{{ route('users.index') }}" class="card-btn">
                        <i class="fa fa-arrow-right me-2"></i>Access Panel
                    </a>
                </div>

                <div class="management-card">
                    <div class="card-icon">
                        <i class="fa fa-user-secret"></i>
                    </div>
                    <h3 class="card-title">Manage Roles</h3>
                    <a href="{{ route('roles.index') }}" class="card-btn">
                        <i class="fa fa-arrow-right me-2"></i>Access Panel
                    </a>
                </div>

             

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>