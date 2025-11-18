<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Half Way Home</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta/css/bootstrap.min.css">
    <style>
        /* Navbar Styles - ALL BLUR EFFECTS REMOVED */
        .navbar {
            background: linear-gradient(135deg, #3D7C77 0%, #2C5C58 100%) !important;
            padding: 0.8rem 1.5rem;
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            height: 80px;
            border-bottom: 3px solid #9ED8D2;
        }

        .navbar-brand {
            color: #FFFFFF !important;
            font-weight: bold;
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
            font-size: 1.5rem;
            padding: 0.5rem 1rem;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.1);
        }

        .navbar-brand:hover {
            transform: scale(1.05);
            background: rgba(255, 255, 255, 0.2);
            color: #FFFFFF !important;
        }

        .navbar-brand i {
            font-size: 2rem;
            margin-right: 0.8rem;
            color: #9ED8D2;
        }

        .navbar-toggler {
            border: 2px solid rgba(255,255,255,0.6);
            padding: 0.4rem 0.6rem;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .navbar-toggler:hover {
            border-color: #9ED8D2;
            background: rgba(255,255,255,0.1);
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3e%3cpath stroke='%239ED8D2' stroke-width='3' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
            width: 1.5rem;
            height: 1.5rem;
        }

        .nav-link {
            color: #FFFFFF !important;
            transition: all 0.3s ease;
            margin: 0 5px;
            font-weight: 600;
            padding: 0.8rem 1.2rem !important;
            border-radius: 25px;
            position: relative;
            overflow: hidden;
        }

        .nav-link::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 3px;
            background: #9ED8D2;
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .nav-link:hover {
            background: rgba(255, 255, 255, 0.15);
            transform: translateY(-2px);
            color: #9ED8D2 !important;
        }

        .nav-link:hover::before {
            width: 80%;
        }

        .title-text {
            color: #FFFFFF;
            font-size: 2.4rem;
            font-weight: 800;
            text-shadow: 3px 3px 6px rgba(0,0,0,0.4);
            letter-spacing: 2px;
            background: linear-gradient(45deg, #FFFFFF, #9ED8D2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            padding: 0.5rem 1.5rem;
            border-radius: 15px;
            background: rgba(255, 255, 255, 0.1);
            /* ALL BLUR EFFECTS COMPLETELY REMOVED */
            border: 2px solid rgba(255, 255, 255, 0.2);
        }

        .dropdown-menu {
            border: none;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            background: linear-gradient(135deg, #3D7C77 0%, #2C5C58 100%);
            border-radius: 15px;
            padding: 15px 0;
            margin-top: 10px;
            border: 2px solid rgba(255, 255, 255, 0.1);
            /* BLUR REMOVED FROM DROPDOWN TOO */
        }

        .dropdown-item {
            color: #FFFFFF;
            transition: all 0.3s ease;
            padding: 12px 25px;
            font-weight: 500;
            border-left: 4px solid transparent;
            margin: 2px 10px;
            border-radius: 8px;
        }

        .dropdown-item:hover {
            background: linear-gradient(90deg, #9ED8D2 0%, rgba(158, 216, 210, 0.3) 100%);
            color: #2C3E50;
            transform: translateX(8px);
            border-left: 4px solid #9ED8D2;
        }

        .dropdown-item i {
            width: 20px;
            margin-right: 10px;
            text-align: center;
        }

        .user-dropdown {
            background: linear-gradient(135deg, #9ED8D2 0%, #7DC6C0 100%);
            color: #2C3E50 !important;
            border-radius: 30px;
            padding: 0.8rem 1.8rem;
            transition: all 0.3s ease;
            border: 2px solid rgba(255,255,255,0.5);
            font-weight: 700;
            box-shadow: 0 6px 20px rgba(0,0,0,0.25);
            display: flex;
            align-items: center;
            margin-left: 10px;
        }

        .user-dropdown:hover {
            background: linear-gradient(135deg, #7DC6C0 0%, #9ED8D2 100%);
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.35);
            border-color: rgba(255,255,255,0.8);
            color: #2C3E50 !important;
        }

        .nav-item.dropdown.show .user-dropdown {
            background: linear-gradient(135deg, #7DC6C0 0%, #9ED8D2 100%);
            box-shadow: 0 4px 15px rgba(0,0,0,0.3);
        }

        .user-dropdown i {
            margin-right: 8px;
            font-size: 1.1rem;
        }

        .login-btn {
            background: linear-gradient(135deg, #9ED8D2 0%, #7DC6C0 100%);
            color: #2C3E50 !important;
            border: none;
            border-radius: 30px;
            padding: 12px 30px;
            font-weight: 700;
            transition: all 0.3s ease;
            box-shadow: 0 6px 20px rgba(0,0,0,0.2);
            display: flex;
            align-items: center;
            margin-left: 10px;
        }

        .login-btn:hover {
            background: linear-gradient(135deg, #7DC6C0 0%, #9ED8D2 100%);
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.3);
            color: #2C3E50 !important;
        }

        .login-btn i {
            margin-right: 8px;
            font-size: 1.1rem;
        }

        @media (max-width: 768px) {
            .title-text {
                font-size: 1.8rem;
                margin-left: 0 !important;
                text-align: center;
                width: 100%;
                margin-top: 10px;
                margin-bottom: 10px;
                padding: 0.8rem 1rem;
            }
            
            .navbar-nav {
                margin-top: 15px;
                text-align: center;
            }
            
            .user-dropdown, .login-btn {
                display: inline-flex;
                margin-top: 10px;
                margin-left: 0;
                justify-content: center;
            }
            
            .nav-link {
                margin: 5px 0;
                text-align: center;
            }
            
            .navbar-brand {
                font-size: 1.3rem;
                padding: 0.4rem 0.8rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
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
            <ul class="navbar-nav mr-auto">
                <!-- Additional nav items can be added here -->
            </ul>
            
            <ul class="navbar-nav ml-auto">
                <!-- Guest/Login State -->
                <li class="nav-item" id="guestState">
                    <a class="nav-link login-btn" href="{{ route('login') }}">
                        <i class="fa fa-sign-in me-2"></i>LOGIN
                    </a>
                </li>
                
                <!-- Authenticated State -->
                <li class="nav-item dropdown" id="authState" style="display: none;">
                    <a id="navbarDropdown" class="nav-link user-dropdown" href="#" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-user me-2"></i><span id="userName">User</span> <i class="fa fa-caret-down ml-1"></i>
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
            </ul>
        </div>
    </nav>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    
    <script>
        // Demo functions to toggle between logged in/out states
        function toggleAuthState() {
            const guestState = document.getElementById('guestState');
            const authState = document.getElementById('authState');
            
            if (guestState.style.display === 'none') {
                guestState.style.display = 'block';
                authState.style.display = 'none';
            } else {
                guestState.style.display = 'none';
                authState.style.display = 'block';
            }
        }
        
        function changeUserName() {
            const names = ['John Doe', 'Jane Smith', 'Alex Johnson', 'Sarah Williams'];
            const randomName = names[Math.floor(Math.random() * names.length)];
            document.getElementById('userName').textContent = randomName;
        }
    </script>
</body>
</html>