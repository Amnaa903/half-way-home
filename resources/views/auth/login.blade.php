<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Half Way Home</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta/css/bootstrap.min.css">
    <style>
        /* Reset body margin and padding */
        body {
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        /* Navbar Styles */
        .navbar {
            background-color: #3D7C77 !important;
            padding: 0.5rem 1rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1030;
            height: 70px;
        }
        
        .navbar-brand {
            color: #FFFFFF !important;
            font-weight: bold;
            display: flex;
            align-items: center;
        }
        
        .navbar-brand i {
            font-size: 1.8rem;
            margin-right: 0.5rem;
        }
        
        .title-text {
            color: #FFFFFF;
            font-size: 2.2rem;
            font-weight: bold;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
            letter-spacing: 1px;
        }

        /* Sidebar Styles - Fixed Properly */
        .sidebar-wrapper {
            position: fixed;
            top: 70px; /* Navbar height */
            left: 0;
            width: 250px;
            height: calc(100vh - 70px);
            z-index: 1000;
            background: linear-gradient(180deg, #3D7C77 0%, #2C5C58 100%);
            overflow-y: auto;
            box-shadow: 3px 0 15px rgba(0,0,0,0.1);
        }

        .sidebar-content {
            padding: 20px 0;
            height: 100%;
        }

        .sidebar-content a {
            display: block;
            padding: 15px 20px;
            text-decoration: none;
            color: #FFFFFF;
            transition: all 0.3s ease;
            border-left: 4px solid transparent;
            font-weight: 500;
            margin: 5px 15px;
            border-radius: 8px;
        }

        .sidebar-content a:hover {
            background: linear-gradient(90deg, #9ED8D2 0%, rgba(158, 216, 210, 0.3) 100%);
            color: #2C3E50;
            border-left: 4px solid #9ED8D2;
            transform: translateX(5px);
        }

        .sidebar-content a i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }

        .section-title {
            color: #FFFFFF;
            font-weight: bold;
            font-size: 16px;
            padding: 20px 25px 10px 25px;
            margin: 20px 15px 10px 15px;
            border-bottom: 2px solid #9ED8D2;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .dashboard-title {
            background: linear-gradient(90deg, #9ED8D2 0%, rgba(158, 216, 210, 0.3) 100%);
            color: #2C3E50 !important;
            font-weight: bold;
            font-size: 18px;
            text-align: center;
            margin: 0 15px 20px 15px;
            border-radius: 10px;
            padding: 15px;
            border-left: 4px solid #9ED8D2;
        }

        /* Main Content Styles */
        .main-content-wrapper {
            margin-left: 250px;
            margin-top: 70px;
            min-height: calc(100vh - 70px);
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px;
        }

        /* Login Card Styles */
        .login-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            overflow: hidden;
            width: 100%;
            max-width: 500px;
            background: #FFFFFF;
        }

        .login-card-header {
            background: linear-gradient(135deg, #3D7C77 0%, #2C5C58 100%) !important;
            color: #FFFFFF;
            padding: 1.5rem;
            border-bottom: none;
            text-align: center;
            font-size: 1.5rem;
            font-weight: bold;
        }

        .login-card-body {
            background-color: #C7EAE7;
            padding: 2rem;
        }

        /* Form Styles */
        .form-control {
            border: 1px solid #3D7C77;
            border-radius: 8px;
            padding: 12px 15px;
            transition: all 0.3s ease;
            background-color: rgba(255, 255, 255, 0.9);
        }

        .form-control:focus {
            border-color: #3D7C77;
            box-shadow: 0 0 0 0.2rem rgba(61, 124, 119, 0.25);
            background-color: #FFFFFF;
        }

        .form-label {
            color: #3D7C77;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .btn-login {
            background: linear-gradient(135deg, #3D7C77, #4A9A94);
            border: none;
            border-radius: 8px;
            padding: 12px 25px;
            font-weight: 600;
            transition: all 0.3s ease;
            font-size: 1.1rem;
            color: #FFFFFF;
            width: 100%;
        }

        .btn-login:hover {
            background: linear-gradient(135deg, #4A9A94, #5BB8B2);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            color: #FFFFFF;
        }

        .form-check-input:checked {
            background-color: #3D7C77;
            border-color: #3D7C77;
        }

        .form-check-label {
            color: #3D7C77;
            font-weight: 500;
        }

        .forgot-password {
            color: #3D7C77;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .forgot-password:hover {
            color: #2C5C58;
            text-decoration: underline !important;
        }

        .invalid-feedback {
            color: #dc3545;
            font-weight: 500;
        }

        /* Footer Styles */
        .footer {
            background-color: white;
            padding: 20px 0;
            border-top: 1px solid #e9ecef;
            margin-left: 250px;
        }

        .footer img {
            margin: 0 10px;
        }

        .footer small {
            color: #3D7C77;
            font-weight: bold;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .sidebar-wrapper {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }
            
            .sidebar-wrapper.mobile-open {
                transform: translateX(0);
            }
            
            .main-content-wrapper {
                margin-left: 0;
            }
            
            .footer {
                margin-left: 0;
            }
            
            .title-text {
                font-size: 1.6rem;
            }
        }

        /* Mobile Menu Toggle */
        .mobile-menu-toggle {
            display: none;
            background: none;
            border: none;
            color: white;
            font-size: 1.5rem;
            margin-right: 15px;
        }

        @media (max-width: 768px) {
            .mobile-menu-toggle {
                display: block;
            }
        }

        /* Overlay for mobile */
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.5);
            z-index: 999;
        }

        @media (max-width: 768px) {
            .sidebar-overlay.mobile-open {
                display: block;
            }
        }
    </style>
</head>
<body>
    @include('layouts.app1')
    <!-- Navbar -->
    <!-- <nav class="navbar navbar-expand-lg navbar-dark">
        <button class="mobile-menu-toggle" id="mobileMenuToggle">
            <i class="fa fa-bars"></i>
        </button>
        
        <a class="navbar-brand" href="/">
            <i class="fa fa-home"></i>
            <span>Half Way Home</span>
        </a>
        
        <span class="title-text">HWH Dashboard</span>

        <ul class="navbar-nav ml-auto">
            @guest
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">
                    <i class="fa fa-sign-in me-2"></i>Login
                </a>
            </li>
            @endguest
        </ul>
    </nav> -->

    <!-- Sidebar Overlay for Mobile -->
    <!-- <div class="sidebar-overlay" id="sidebarOverlay"></div> -->
@include('layouts.sidebar')
    <!-- Sidebar -->
    <!-- <div class="sidebar-wrapper" id="sidebarWrapper">
        <div class="sidebar-content">
            <a href="/dashboard" class="dashboard-title">
                <i class="fa fa-dashboard"></i>HWH Dashboard
            </a>
            
            <a class="location-item" href="/detailReports">
                <i class="fa fa-file-text"></i>Detail Report
            </a>

            <div class="section-title">
                <i class="fa fa-map-marker"></i>Institution Location
            </div>

            <div id="locationList">
                <a class="location-item" data-ph="Contact No:4235150031" data-ad="Address:Lahore Social Welfare Complex Rana Road Near Umar Chowk Township Model Town 31.44087976,74.30901307" data-src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d3404.0282613381796!2d74.3090278!3d31.440888899999997!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zMzHCsDI2JzI3LjIiTiA3NMKwMTgnMzIuNSJF!5e0!3m2!1sen!2s!4v1732272010099!5m2!1sen!2s">
                    <i class="fa fa-building"></i>Lahore
                </a>
                <a class="location-item" data-ph="Contact No:049330231" data-ad="6F5G+26G Sqn Ldr, Sqn Ldr Sarfraz Rafiqui Shaheed, Shamsabad Colony Multan, Punjab" data-src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d13792.134182616264!2d71.475571!3d30.20759!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x393b33004b88708f%3A0x68d142c625c1d343!2sAfiyat%20Old%20age%20home!5e0!3m2!1sen!2s!4v1732269925540!5m2!1sen!2s">
                    <i class="fa fa-building"></i>Multan
                </a>
                <a class="location-item" data-ph="Contact No:542470282" data-ad="Address:Narowal Social welfare complex narowal 32.09185166666667,74.86109" data-src="https://www.google.com/maps/embed?pb=!1m13!1m8!1m3!1d3380.15930196929!2d74.8586584!3d32.09198!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zMzLCsDA1JzMwLjciTiA3NMKwNTEnMzkuOSJF!5e0!3m2!1sen!2s!4v1732270086778!5m2!1sen!2s">
                    <i class="fa fa-building"></i>Narowaal
                </a>
                <a class="location-item" data-ph="Contact No:542470282" data-ad="J3HV+9F2 Rawalpindi" data-src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d3322.11003218444!2d73.0936389!3d33.6283889!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zMzPCsDM3JzQyLjIiTiA3M8KwMDUnMzcuMSJF!5e0!3m2!1sen!2s!4v1732270281109!5m2!1sen!2s">
                    <i class="fa fa-building"></i>Rawalpindi
                </a>
                <a class="location-item" data-ph="Contact No:409200413" data-ad="Address:Sahiwal Kacha Pakka Noor Shah Road Sahiwal. 30.675611978378562,73.11982546371378" data-src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d3431.5211067667237!2d73.1198333!3d30.675611099999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zMzDCsDQwJzMyLjIiTiA3M8KwMDcnMTEuNCJF!5e0!3m2!1sen!2s!4v1732270390209!5m2!1sen!2s">
                    <i class="fa fa-building"></i>Sahiwal
                </a>
                <a class="location-item" data-ph="Contact No:409200413" data-ad="Address:Social welfare Complex. Sports stadium. Jhang road Toba tek Singh 30.983455502428114,72.47471367940307" data-src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d3420.5354223746053!2d72.4747222!3d30.983444400000003!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zMzDCsDU5JzAwLjQiTiA3MsKwMjgnMjkuMCJF!5e0!3m2!1sen!2s!4v1732270466443!5m2!1sen!2s">
                    <i class="fa fa-building"></i>Toba Tek Singh
                </a>
                <a class="location-item" data-ph="Contact No:049330231" data-ad="Address:Faisalabad Jwad club chowk narrwala road 31.44073370174545, 73.01578430727736" data-src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d3404.034316393986!2d73.0157778!3d31.440722199999993!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zMzHCsDI2JzI2LjYiTiA3M8KwMDAnNTYuOCJF!5e0!3m2!1sen!2s!4v1732270553550!5m2!1sen!2s">
                    <i class="fa fa-building"></i>Faisalabad
                </a>
            </div>
        </div>
    </div> -->

    <!-- Main Content -->
    <div class="main-content-wrapper">
        <div class="login-card">
            <div class="login-card-header">
                <i class="fa fa-sign-in me-2"></i>Login
            </div>

            <div class="login-card-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group">
                        <label for="email" class="form-label">{{ __('Email Address') }}</label>
                        <input id="email" type="email" 
                               class="form-control @error('email') is-invalid @enderror" 
                               name="email" value="{{ old('email') }}" 
                               required autocomplete="email" autofocus
                               placeholder="Enter your email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password" class="form-label">{{ __('Password') }}</label>
                        <input id="password" type="password" 
                               class="form-control @error('password') is-invalid @enderror" 
                               name="password" required autocomplete="current-password"
                               placeholder="Enter your password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" 
                                   id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>

                    <div class="form-group mb-0">
                        <button type="submit" class="btn-login">
                            <i class="fa fa-sign-in me-2"></i>{{ __('Login') }}
                        </button>
                    </div>

                    @if (Route::has('password.request'))
                        <div class="text-center mt-3">
                            <a href="{{ route('password.request') }}" class="forgot-password">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-0 col-md-4"></div>
                <div class="col-sm-12 col-md-4 text-center">
                    <img style="width: 50px" src="http://127.0.0.1:8001/assets/img/PITBLOGO.png" alt="PITB Logo" />
                    <small><b>A project of Government of the Punjab</b></small>
                    <img style="width: 60px" src="http://127.0.0.1:8001/assets/img/swd.png" alt="SWD Logo" />
                </div>
                <div class="col-sm-0 col-md-4"></div>
            </div>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script>
        // Mobile menu toggle
        document.getElementById('mobileMenuToggle').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebarWrapper');
            const overlay = document.getElementById('sidebarOverlay');
            sidebar.classList.toggle('mobile-open');
            overlay.classList.toggle('mobile-open');
        });

        // Close sidebar when overlay is clicked
        document.getElementById('sidebarOverlay').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebarWrapper');
            const overlay = document.getElementById('sidebarOverlay');
            sidebar.classList.remove('mobile-open');
            overlay.classList.remove('mobile-open');
        });

        // Sidebar hover effects
        $(document).ready(function() {
            $(".location-item").hover(function() {
                $(this).css('background-color', '#9ED8D2').css('color', '#2C3E50');
            }, function() {
                $(this).css('background-color', 'transparent').css('color', '#FFFFFF');
            });
        });
    </script>
</body>
</html>