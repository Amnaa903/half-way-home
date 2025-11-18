<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Half Way Home - @yield('title', 'Welcome')</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    
    <style>
        body {
            background: linear-gradient(135deg, #C7EAE7 0%, #9ED8D2 50%, #3D7C77 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .login-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(61, 124, 119, 0.3);
            overflow: hidden;
        }
        
        .brand-header {
            background: linear-gradient(135deg, #3D7C77 0%, #2A5D57 100%);
            color: white;
            padding: 2rem;
            text-align: center;
        }
        
        .brand-logo {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }
        
        .brand-title {
            font-size: 1.8rem;
            font-weight: bold;
            margin: 0;
        }
        
        .brand-subtitle {
            font-size: 1rem;
            opacity: 0.9;
            margin: 0;
        }
        
        .form-container {
            padding: 2rem;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #3D7C77 0%, #2A5D57 100%);
            border: none;
            padding: 12px 30px;
            font-weight: bold;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(61, 124, 119, 0.4);
        }
        
        .form-control {
            border: 2px solid #E9ECEF;
            border-radius: 8px;
            padding: 12px 15px;
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            border-color: #3D7C77;
            box-shadow: 0 0 0 0.2rem rgba(61, 124, 119, 0.25);
        }
        
        .form-label {
            color: #3D7C77;
            font-weight: 600;
            margin-bottom: 8px;
        }
        
        .login-footer {
            text-align: center;
            padding: 1rem;
            background: #F8F9FA;
            border-top: 1px solid #E9ECEF;
        }
        
        .login-footer a {
            color: #3D7C77;
            text-decoration: none;
            font-weight: 500;
        }
        
        .login-footer a:hover {
            color: #2A5D57;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="login-container">
                    <div class="brand-header">
                        <div class="brand-logo">
                            <i class="fa fa-home"></i>
                        </div>
                        <h1 class="brand-title">Half Way Home</h1>
                        <p class="brand-subtitle">Management System</p>
                    </div>
                    
                    <div class="form-container">
                        @yield('content')
                    </div>
                    
                    <div class="login-footer">
                        @if (Request::is('login'))
                            <p>Don't have an account? <a href="{{ route('register') }}">Register here</a></p>
                        @elseif (Request::is('register'))
                            <p>Already have an account? <a href="{{ route('login') }}">Login here</a></p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>