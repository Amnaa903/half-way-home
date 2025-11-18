<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Half Way Home</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta/css/bootstrap.min.css">
    <style>
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
            backdrop-filter: blur(10px);
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
            backdrop-filter: blur(10px);
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

        /* Sidebar Styles - UPDATED */
        .sidbarContainer {
            width: 250px;
            height: calc(100vh - 80px);
            overflow-y: auto;
            background: linear-gradient(180deg, #3D7C77 0%, #2C5C58 100%);
            z-index: 999;
            position: fixed;
            left: 0;
            top: 80px;
            padding: 0 !important;
            box-shadow: 3px 0 15px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }

        .sidbarContainer a {
            display: block;
            padding: 12px 15px !important;
            text-decoration: none;
            color: #FFFFFF !important;
            transition: all 0.3s ease;
            border-left: 4px solid transparent;
            font-weight: 500;
            margin: 0 !important;
            border-radius: 0 !important;
        }

        .sidbarContainer a:hover {
            background: linear-gradient(90deg, #9ED8D2 0%, rgba(158, 216, 210, 0.3) 100%);
            color: #2C3E50 !important;
            border-left: 4px solid #9ED8D2;
            transform: translateX(5px);
        }

        .sidbarContainer a i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }

        .section-title {
            color: #FFFFFF !important;
            font-weight: bold;
            font-size: 14px;
            padding: 12px 15px 8px 15px !important;
            margin: 0 !important;
            border-bottom: 2px solid #9ED8D2;
            border-top: 1px solid rgba(255,255,255,0.1);
            text-transform: uppercase;
            letter-spacing: 1px;
            background: rgba(255, 255, 255, 0.1);
        }

        .location-item {
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            color: #FFFFFF !important;
            padding: 10px 15px !important;
            text-decoration: none;
            border-left: 4px solid transparent;
            margin: 0 !important;
            border-radius: 0 !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .location-item:hover {
            background: linear-gradient(90deg, #9ED8D2 0%, rgba(158, 216, 210, 0.3) 100%);
            color: #2C3E50 !important;
            border-left: 4px solid #9ED8D2;
            transform: translateX(5px);
        }

        .dashboard-title {
            background: linear-gradient(90deg, #9ED8D2 0%, rgba(158, 216, 210, 0.3) 100%);
            color: #2C3E50 !important;
            font-weight: bold;
            font-size: 16px;
            text-align: center;
            margin: 0 !important;
            border-radius: 0 !important;
            padding: 15px !important;
            border-left: 4px solid #9ED8D2;
            border-bottom: 2px solid #9ED8D2;
        }

        /* Remove ALL gaps */
        #locationList {
            margin: 0 !important;
            padding: 0 !important;
        }

        #locationList a {
            margin: 0 !important;
            border-radius: 0 !important;
        }

        #locationList a:last-child {
            border-bottom: none;
        }

        /* Main Content */
        .main-content {
            margin-left: 250px;
            padding: 30px;
            margin-top: 80px;
            min-height: calc(100vh - 80px);
            background-color: #f8f9fa;
            transition: all 0.3s ease;
        }

        @media screen and (max-width: 768px) {
            .sidbarContainer {
                width: 100%;
                height: auto;
                position: relative;
                top: 0;
            }

            .sidbarContainer a {
                float: left;
                width: auto;
            }
            
            .main-content {
                margin-left: 0;
                margin-top: 0;
            }
        }

        /* Dashboard Cards */
        .info-box {
            display: flex;
            align-items: center;
            padding: 15px;
            background-color: white;
            border-radius: 8px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }

        .info-box:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.15);
        }

        .info-box-icon {
            background-color: #3D7C77;
            color: white;
            border-radius: 50%;
            font-size: 24px;
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
        }

        .info-box-content {
            display: flex;
            flex-direction: column;
        }

        .info-box-text {
            font-size: 14px;
            font-weight: bold;
            color: #333;
        }

        .info-box-number {
            font-size: 24px;
            font-weight: bold;
            color: #3D7C77;
            margin: 5px 0 0 0;
        }
        
        /* Chart Container */
        .chart-container {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        
        /* Map Container */
        .map-container {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        
        #mapIframe {
            width: 100%;
            height: 400px;
            border: none;
            border-radius: 8px;
        }
        
        .location-info {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 15px;
            border-left: 4px solid #3D7C77;
        }
        
        /* Quick Actions */
        .quick-actions {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }
        
        .action-btn {
            background: #3D7C77;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 6px;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            font-weight: 500;
        }
        
        .action-btn:hover {
            background: #2C5C58;
            color: white;
            text-decoration: none;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }
        
        .action-btn i {
            margin-right: 8px;
        }
        
        /* Alert Styles */
        .update-alert {
            position: fixed;
            top: 90px;
            right: 20px;
            z-index: 1050;
            display: none;
            animation: slideIn 0.3s ease;
        }

        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
    </style>
</head>
<body>
@include('layouts.app1')

@include('layouts.sidebar')
    <!-- Sidebar -->
    <!-- <div class="sidbarContainer m-0 p-0">
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
                <i class="fa fa-building"></i>Narowal
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
    </div> -->

    <!-- Update Alert -->
    <div class="alert alert-success update-alert" id="updateAlert">
        <i class="fa fa-check-circle"></i> Map has been updated successfully!
    </div>

    <!-- Main Content -->
    <div class="main-content" id="mainContent">
        <!-- Quick Actions -->
        <div class="quick-actions">
            <a href="/totalResidents" class="action-btn">
                <i class="fa fa-users"></i> Total Residents
            </a>
            <a href="/dischargeResidents" class="action-btn">
                <i class="fa fa-user-minus"></i> Discharge Residents
            </a>
        </div>

        <!-- Statistics Cards -->
        <div class="row">
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon"><i class="fa fa-users"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text"><strong>Total Residents</strong></span>
                        <p class="info-box-number">
                            <a href="/totalResidents" style="color: inherit; text-decoration: none;">
                                0
                            </a>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                    <span class="info-box-icon"><i class="fa fa-user-minus"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text"><strong>Discharge Residents</strong></span>
                        <p class="info-box-number">
                            <a href="/dischargeResidents" style="color: inherit; text-decoration: none;">
                                0
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Chart and Map Row -->
        <div class="row">
            <div class="col-lg-8">
                <div class="chart-container">
                    <h4><i class="fa fa-bar-chart"></i> Residents by Location</h4>
                    <canvas id="residentsChart" height="250"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <script>
        $(document).ready(function() {
            // Location click handler
            $('.location-item').click(function(e) {
                e.preventDefault();
                
                // Check if it's a location item with map data
                if ($(this).data('src')) {
                    const city = $(this).text().trim();
                    const phone = $(this).data('ph');
                    const address = $(this).data('ad');
                    const mapSrc = $(this).data('src');
                    
                    // Update map information
                    $('#mapCity').html('<i class="fa fa-map-marker"></i> ' + city);
                    $('#mapAddress').html('<strong>Address:</strong> ' + address);
                    $('#mapPhone').html('<strong>Contact:</strong> ' + phone);
                    
                    // Show map container and iframe
                    $('#mapContainer').show();
                    $('#mapPlaceholder').hide();
                    $('#mapIframe').attr('src', mapSrc).show();
                    
                    // Show update alert
                    $('#updateAlert').fadeIn();
                    setTimeout(function() {
                        $('#updateAlert').fadeOut();
                    }, 3000);
                    
                    // Update active state
                    $('.location-item').css({
                        'background': 'transparent',
                        'color': '#FFFFFF',
                        'border-left': '4px solid transparent',
                        'transform': 'translateX(0)'
                    });
                    $(this).css({
                        'background': 'linear-gradient(90deg, #9ED8D2 0%, rgba(158, 216, 210, 0.3) 100%)',
                        'color': '#2C3E50',
                        'border-left': '4px solid #9ED8D2',
                        'transform': 'translateX(5px)'
                    });
                }
            });
            
            // Initialize Chart
            const ctx = document.getElementById('residentsChart').getContext('2d');
            const residentsChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Lahore', 'Multan', 'Narowal', 'Rawalpindi', 'Sahiwal', 'Toba Tek Singh', 'Faisalabad'],
                    datasets: [
                        {
                            label: 'Male Residents',
                            data: [0, 0, 0, 0, 0, 0, 0],
                            backgroundColor: '#3D7C77',
                            borderColor: '#2C5C58',
                            borderWidth: 1
                        },
                        {
                            label: 'Female Residents',
                            data: [0, 0, 0, 0, 0, 0, 0],
                            backgroundColor: '#9ED8D2',
                            borderColor: '#7DC6C0',
                            borderWidth: 1
                        }
                    ]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Iframe detection
            if (window.self !== window.top) {
                document.addEventListener("DOMContentLoaded", function () {
                    $(".navbar").hide();
                    $(".sidbarContainer").hide();
                    $(".main-content").css({
                        'margin-left': '0',
                        'margin-top': '0'
                    });
                });
            }

            // Send height to parent if in iframe
            function sendHeight() {
                if (window.self !== window.top) {
                    setTimeout(() => {
                        const height = document.documentElement.scrollHeight;
                        window.parent.postMessage({ iframeHeight: height }, "*");
                    }, 100);
                }
            }

            window.onload = sendHeight;
            window.onresize = sendHeight;
            setInterval(sendHeight, 500);
        });
    </script>
</body>
</html>