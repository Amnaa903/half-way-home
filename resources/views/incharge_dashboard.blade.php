<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Incharge Dashboard - Half Way Home</title>
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
      integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
      crossorigin="anonymous"
    />
    <script
      src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
      integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
      integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
      integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
      crossorigin="anonymous"
    ></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
      :root {
        --primary: #3D7C77;
        --primary-light: #9ED8D2;
        --card-light: #FFFFFF; /* Changed to white */
        --background-light: #E8F4F3;
        --secondary: #2C3E50;
        --light: #F8F9FA;
        --light-gray: #E9ECEF;
        --text-dark: #2C3E50;
        --text-light: #6C757D;
      }
      
      body {
        background-color: var(--background-light);
        color: var(--text-dark);
        min-height: 100vh;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      }
      
      .webcontainer {
        padding: 30px 0;
        background-color: var(--background-light);
        margin-top: 80px;
      }
      
      .card {
        margin-top: 20px;
        margin-bottom: 20px;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        background-color: var(--card-light); /* White background */
        color: var(--text-dark);
        border: none;
        transition: all 0.3s ease;
        border-left: 4px solid var(--primary); /* Added accent border */
      }
      
      .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.12);
      }
      
      .card-header {
        background: linear-gradient(135deg, var(--primary) 0%, #2C5C58 100%); /* Gradient header */
        color: white;
        border-radius: 12px 12px 0 0 !important;
        border: none;
        padding: 15px 20px;
        font-weight: 600;
        border-bottom: 2px solid rgba(255,255,255,0.2);
      }
      
      .card-body {
        background-color: var(--card-light); /* White background */
        padding: 20px;
        text-align: center;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
      }
      
      .cardimages {
        height: 70px;
        width: 70px;
        margin: 15px auto;
        transition: transform 0.3s ease;
      }
      
      .card:hover .cardimages {
        transform: scale(1.05);
      }
      
      .icon-wrapper {
        background: linear-gradient(135deg, var(--primary-light), var(--primary)); /* Gradient icon background */
        width: 90px;
        height: 90px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
        margin-bottom: 15px;
        box-shadow: 0 4px 10px rgba(61, 124, 119, 0.3);
        border: 3px solid white;
      }
      
      /* CENTERED BUTTONS STYLES */
      .nav {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        text-align: center;
        width: 100%;
        padding: 0;
        margin: 0;
      }

      .nav li {
        display: block;
        list-style: none;
        margin: 10px 0;
        width: 100%;
        text-align: center;
      }

      .nav .button-dropdown {
        position: relative;
        display: flex;
        justify-content: center;
        width: 100%;
      }

      .nav li a {
        display: inline-block;
        color: white;
        background: linear-gradient(135deg, var(--primary) 0%, #2C5C58 100%); /* Gradient button */
        padding: 12px 24px;
        text-decoration: none;
        border-radius: 8px;
        transition: all 0.3s ease;
        font-weight: 500;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        text-align: center;
        min-width: 200px;
        border: 2px solid rgba(255,255,255,0.3);
      }

      .nav li a:hover {
        background: linear-gradient(135deg, #2C5C58 0%, #25544f 100%); /* Darker gradient on hover */
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        border-color: rgba(255,255,255,0.5);
      }

      .nav li .dropdown-menu {
        display: none;
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        padding: 0;
        margin: 0;
        text-align: left;
        background: white;
        border-radius: 8px;
        overflow: hidden;
        z-index: 1000;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
        border: none;
        width: 220px;
        top: 100%;
        margin-top: 5px;
        border: 2px solid var(--primary-light);
      }

      .nav li .dropdown-menu.active {
        display: block;
        animation: fadeIn 0.3s ease;
      }

      .nav li .dropdown-menu a {
        width: 100%;
        color: var(--text-dark);
        background: white;
        padding: 12px 20px;
        display: block;
        text-decoration: none;
        transition: all 0.2s ease;
        border-bottom: 1px solid var(--light-gray);
        box-shadow: none;
        border-radius: 0;
        text-align: left;
      }

      .nav li .dropdown-menu a:hover {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
        color: white;
        padding-left: 25px;
        transform: translateX(5px);
      }
      
      .nav li .dropdown-menu a:last-child {
        border-bottom: none;
      }
      
      .footer {
        background: white;
        padding: 20px;
        border-radius: 12px;
        margin-top: 30px;
        box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.05);
        border-top: 3px solid var(--primary-light);
      }
      
      .government-text {
        font-size: 1.3rem;
        color: var(--primary);
        font-weight: 700;
      }
      
      .logo-container img {
        transition: transform 0.3s ease;
      }
      
      .logo-container img:hover {
        transform: scale(1.1);
      }
      
      .empty-state {
        color: var(--text-light);
        font-style: italic;
        margin-top: 10px;
        padding: 10px;
        border-radius: 8px;
        background-color: var(--light-gray);
        width: 100%;
      }
      
      @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
      }
      
      @media (max-width: 768px) {
        .card {
          margin-bottom: 20px;
        }
        
        .webview {
          margin-top: 30px !important;
        }
        
        .webcontainer {
          margin-top: 70px;
          padding: 15px 0;
        }
        
        .nav li a {
          min-width: 180px;
          padding: 10px 20px;
        }
      }
    </style>
  </head>
  <body>
    <!-- Navbar include -->
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
                    <a class="nav-link login-btn" href="http://127.0.0.1:8000/login">
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
                        <a class="dropdown-item" href="http://127.0.0.1:8000/logout"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out mr-2"></i> Logout
                        </a>
                        
                        <form id="logout-form" action="http://127.0.0.1:8000/logout" method="POST" style="display: none;">
                            <input type="hidden" name="_token" value="hfQxtDhNHyhp6LxDxl3oPbWhHUkqWc3S1FVpOufC" autocomplete="off">                        </form>
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
    <div class="container-fluid webcontainer">
      <div class="row justify-content-center">
        <div class="col-sm-12 col-md-5 col-lg-4">
          <div class="card webview mx-auto">
            <div class="card-header text-center">
              <i class="fas fa-user-plus me-2"></i>Resident Management
            </div>
            <div class="card-body text-center">
              <div class="icon-wrapper">
                <img src="http://127.0.0.1:8000/images/rf.png" class="cardimages" alt="Resident Management"/>
              </div>
              <ul class="nav card-text">
                <li class="button-dropdown">
                  <a href="javascript:void(0)" class="dropdown-toggle">
                    <i class="fas fa-users me-2"></i>Manage Residents
                  </a>
                  <ul class="dropdown-menu">
                    <li>
                      <a href="/create-registration"><i class="fas fa-plus-circle me-2"></i>Add Residents</a>
                    </li>
                    <li>
                      <a href="/pending-registration"><i class="fas fa-clock me-2"></i>Pending Registration</a>
                    </li>
                  </ul>
                </li>
              </ul>
              
            </div>
          </div>
        </div>
        
        <div class="col-sm-12 col-md-5 col-lg-4">
          <div class="card webview mx-auto">
            <div class="card-header text-center">
              <i class="fas fa-sign-out-alt me-2"></i>Discharge Process
            </div>
            <div class="card-body text-center">
              <div class="icon-wrapper">
                <img src="http://127.0.0.1:8000/images/discharge.png" class="cardimages" alt="Discharge Management"/>
              </div>
              <ul class="nav card-text">
                <li class="button-dropdown">
                  <a href="javascript:void(0)" class="dropdown-toggle">
                    <i class="fas fa-user-minus me-2"></i>Discharge Residents
                  </a>
                  <ul class="dropdown-menu">
                    <li>
                      <a href="#"><i class="fas fa-file-export me-2"></i>Discharge Residents</a>
                    </li>
                    <li>
                      <a href="#"><i class="fas fa-clock me-2"></i>Pending Discharge</a>
                    </li>
                  </ul>
                </li>
              </ul>
              
            </div>
          </div>
        </div>
      </div>
      
      <div class="row footer justify-content-center">
        <div class="col-md-8 text-center">
          <div class="government-text mb-2 text-dark">
            <strong>A Project of Government of Punjab</strong>
          </div>
          <div class="logo-container">
            <img style="width: 50px" src="http://127.0.0.1:8000/images/PITBLOGO.png" class="mx-3" />
            <img style="width: 60px" src="http://127.0.0.1:8000/images/swd.png" class="mx-3" />
          </div>
        </div>
      </div>
    </div>
    
    <script>
      $(document).ready(() => {
        $(document.body).on("click", ".card[data-clickable=true]", (e) => {
          var href = $(e.currentTarget).data("href");
          window.location = href;
        });
      });
      
      jQuery(document).ready(function (e) {
        function t(t) {
          e(t).bind("click", function (t) {
            t.preventDefault();
            e(this).parent().fadeOut()
          })
        }
        e(".dropdown-toggle").click(function () {
          var t = e(this).parents(".button-dropdown").children(".dropdown-menu").is(":hidden");
          e(".button-dropdown .dropdown-menu").hide();
          e(".button-dropdown .dropdown-toggle").removeClass("active");
          if (t) {
            e(this).parents(".button-dropdown").children(".dropdown-menu").toggle().parents(".button-dropdown").children(".dropdown-toggle").addClass("active")
          }
        });
        e(document).bind("click", function (t) {
          var n = e(t.target);
          if (!n.parents().hasClass("button-dropdown")) e(".button-dropdown .dropdown-menu").hide();
        });
        e(document).bind("click", function (t) {
          var n = e(t.target);
          if (!n.parents().hasClass("button-dropdown")) e(".button-dropdown .dropdown-toggle").removeClass("active");
        })
      });
    </script>
  </body>
</html>