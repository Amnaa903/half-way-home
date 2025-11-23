<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Half Way Home Admissions Form</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600&family=Playfair+Display:wght@400;600&display=swap" rel="stylesheet">
    <!-- Jameel Noori Nastaleeq Font -->
    <link href="https://fonts.googleapis.com/css2?family=Noto+Nastaliq+Urdu:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Toastify CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <!-- jQuery for validation -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        /* Your existing CSS remains exactly the same except for text positioning */
        :root {
            --primary-color: #264653;
            --secondary-color: #2A9D8F;
            --accent-color: #E0F2F1;
            --text-color: #0F1A1B;
            --light-bg: #F5F9FF;
            --error-color: #A93226;
            --success-color: #27AE60;
            --border-color: #80CBC4;
            --hover-shadow: rgba(38, 70, 83, 0.3);
        }

        body {
            font-family: 'Montserrat', sans-serif;
            color: var(--text-color);
            background: linear-gradient(135deg, var(--accent-color), var(--light-bg));
            overflow-x: hidden;
            position: relative;
            min-height: 100vh;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('https://www.transparenttextures.com/patterns/rice-paper-2.png');
            opacity: 0.05;
            z-index: -1;
        }

        .registration-section {
            padding: 80px 0;
            display: flex;
            align-items: center;
        }

        .registration-section h2 {
            font-family: 'Playfair Display', serif;
            font-size: 2.8rem;
            text-align: center;
            color: var(--primary-color);
            text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.2);
            margin-bottom: 30px;
            animation: fadeInDown 1s ease-out;
        }

        .registration-container {
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        .registration-card {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            max-width: 850px;
            width: 100%;
        }

        .registration-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.2);
        }

        .registration-form .form-control,
        .registration-form .form-select {
            border-radius: 8px;
            padding: 10px;
            font-size: 0.95rem;
            border: 2px solid var(--border-color);
            background: #fff;
            color: var(--text-color);
            transition: all 0.3s ease;
        }

        .registration-form .form-control:focus,
        .registration-form .form-select:focus {
            border-color: var(--secondary-color);
            box-shadow: 0 0 8px var(--hover-shadow);
            transform: scale(1.02);
        }

        /* UPDATED: English text on left, Urdu on right */
        .registration-form .form-label {
            font-family: 'Playfair Display', serif;
            font-size: 1rem;
            color: var(--primary-color);
            margin-bottom: 8px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-direction: row !important;
        }

        .registration-form .form-label span:first-child {
            /* English text - left aligned */
            text-align: left;
            flex: 1;
        }

        .registration-form .form-label .urdu-label {
            font-family: 'Noto Nastaliq Urdu', serif;
            font-size: 1.1rem;
            color: var(--text-color);
            text-align: right;
            direction: rtl;
            unicode-bidi: bidi-override;
            flex: 1;
        }

        .registration-form .btn-primary {
            border-radius: 25px;
            padding: 12px;
            font-weight: 600;
            font-size: 0.95rem;
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            border: none;
            color: var(--light-bg);
            transition: all 0.3s ease;
        }

        .registration-form .btn-primary:hover {
            background: linear-gradient(45deg, var(--secondary-color), var(--primary-color));
            transform: translateY(-3px);
            box-shadow: 0 5px 12px var(--hover-shadow);
        }

        .registration-form .btn-secondary {
            border-radius: 25px;
            padding: 12px;
            font-weight: 600;
            font-size: 0.95rem;
            background: #6c757d;
            border: none;
            color: var(--light-bg);
            transition: all 0.3s ease;
        }

        /* UPDATED: Section titles with English left, Urdu right */
        .form-section-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.6rem;
            color: var(--secondary-color);
            margin-bottom: 15px;
            position: relative;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-direction: row !important;
        }

        .form-section-title span:first-child {
            /* English text - left aligned */
            text-align: left;
            flex: 1;
        }

        .form-section-title .urdu-title {
            font-family: 'Noto Nastaliq Urdu', serif;
            font-size: 1.5rem;
            color: var(--text-color);
            text-align: right;
            direction: rtl;
            unicode-bidi: bidi-override;
            flex: 1;
        }

        .form-section-title::after {
            content: '';
            width: 60px;
            height: 3px;
            background: var(--primary-color);
            position: absolute;
            bottom: -5px;
            left: 0;
        }

        /* UPDATED: Step labels with English left, Urdu right */
        .step-progress {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 25px;
            position: relative;
            padding-top: 30px;
        }

        .step {
            flex: 1;
            text-align: center;
            position: relative;
            z-index: 1;
        }

        .step .step-circle {
            width: 40px;
            height: 40px;
            line-height: 40px;
            border-radius: 50%;
            background: #BDC3C7;
            color: var(--light-bg);
            margin: 0 auto 10px;
            font-size: 1.2rem;
            font-weight: 700;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .step.active .step-circle {
            background: var(--primary-color);
            transform: scale(1.1);
        }

        .step.completed .step-circle {
            background: var(--secondary-color);
            transform: scale(1.05);
        }

        .step .step-label {
            font-size: 0.85rem;
            color: var(--text-color);
            display: flex;
            justify-content: center;
            flex-direction: column;
            gap: 4px;
            min-height: 50px;
            align-items: center;
        }

        .step .step-label span:first-child {
            /* English text - left aligned */
            text-align: center;
        }

        .step .step-label .urdu-label {
            font-family: 'Noto Nastaliq Urdu', serif;
            font-size: 0.9rem;
            direction: rtl;
            unicode-bidi: bidi-override;
            text-align: center;
        }

        .step-progress::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            width: 100%;
            height: 4px;
            background: #BDC3C7;
            z-index: 0;
            transform: translateY(-50%);
            border-radius: 2px;
        }

        .step-progress.active-1::before {
            background: linear-gradient(to right, var(--primary-color) 33.33%, #BDC3C7 33.33%);
        }

        .step-progress.active-2::before {
            background: linear-gradient(to right, var(--primary-color) 66.66%, #BDC3C7 66.66%);
        }

        .step-progress.active-3::before {
            background: var(--primary-color);
        }

        .form-step {
            display: none;
        }

        .form-step.active {
            display: block;
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .toastify {
            font-family: 'Montserrat', sans-serif;
            font-size: 0.9rem;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            padding: 12px;
            max-width: 350px;
        }

        .form-control.is-invalid, .form-select.is-invalid {
            border-color: var(--error-color);
            background-image: none;
        }

        .invalid-feedback {
            font-size: 0.8rem;
            color: var(--error-color);
            display: block;
        }

        .valid-feedback {
            font-size: 0.8rem;
            color: var(--success-color);
            display: block;
        }

        .tooltip-icon {
            cursor: pointer;
            color: var(--secondary-color);
            margin-left: 5px;
            transition: color 0.3s ease;
        }

        .tooltip-icon:hover {
            color: var(--primary-color);
        }

        .bs-tooltip-auto .tooltip-inner {
            background-color: var(--primary-color);
            color: var(--light-bg);
            font-family: 'Montserrat', sans-serif;
            border-radius: 5px;
        }

        @media (max-width: 768px) {
            .registration-container {
                flex-direction: column;
            }

            .registration-card {
                padding: 20px;
            }

            .registration-section h2 {
                font-size: 2.2rem;
            }

            .form-section-title {
                font-size: 1.4rem;
            }

            .form-section-title .urdu-title {
                font-size: 1.3rem;
            }

            .registration-form .form-control,
            .registration-form .form-select {
                font-size: 0.9rem;
            }

            .registration-form .form-label {
                font-size: 0.95rem;
            }

            .registration-form .form-label .urdu-label {
                font-size: 1rem;
            }

            .step .step-circle {
                width: 30px;
                height: 30px;
                line-height: 30px;
                font-size: 1rem;
            }

            .step .step-label {
                font-size: 0.75rem;
                min-height: 45px;
                gap: 2px;
            }

            .step .step-label .urdu-label {
                font-size: 0.8rem;
            }
        }

        .button-container {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            margin-top: 20px;
        }

        .required::after {
            content: "*";
            color: var(--error-color);
            margin-left: 4px;
        }

        .attachment-list {
            list-style-type: disc;
            padding-left: 20px;
            font-size: 0.9rem;
            color: var(--text-color);
            line-height: 1.5;
        }

        .attachment-list .urdu-text {
            font-family: 'Noto Nastaliq Urdu', serif;
            font-size: 0.9rem;
            direction: rtl;
            unicode-bidi: bidi-override;
        }

        .file-preview {
            margin-top: 5px;
            font-size: 0.8rem;
            color: var(--secondary-color);
        }

        .hidden {
            display: none;
        }
        
        .children-input-group {
            margin-bottom: 10px;
            animation: fadeIn 0.3s ease-in;
        }

        .child-card {
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            background: rgba(255, 255, 255, 0.7);
        }
        
        /* Loading overlay */
        .loading-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 9999;
            justify-content: center;
            align-items: center;
        }
        
        .loading-spinner {
            background: white;
            padding: 30px;
            border-radius: 10px;
            text-align: center;
        }

        .success-message {
            background: var(--success-color);
            color: white;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            animation: fadeIn 0.5s ease-in;
        }

        .reference-id {
            font-weight: bold;
            font-size: 1.1rem;
            background: rgba(255,255,255,0.2);
            padding: 5px 10px;
            border-radius: 4px;
            display: inline-block;
            margin-top: 5px;
        }

        /* Real-time validation styles */
        .form-control.is-valid {
            border-color: var(--success-color);
        }

        .form-control.is-invalid {
            border-color: var(--error-color);
        }

        /* Urdu text specific styles */
        .urdu-text {
            font-family: 'Noto Nastaliq Urdu', serif !important;
            direction: rtl;
            unicode-bidi: bidi-override;
            text-align: right;
        }
        
        /* Jameel Noori Nastaleeq specific styles */
        .jameel-noori {
            font-family: 'Noto Nastaliq Urdu', serif;
            font-weight: 500;
            line-height: 1.6;
        }
        
        /* Enhanced Urdu text styling */
        .urdu-label, .urdu-title, .urdu-text {
            font-family: 'Noto Nastaliq Urdu', serif !important;
            font-weight: 500;
            direction: rtl;
            unicode-bidi: bidi-override;
            text-align: right;
            line-height: 1.6;
        }
        
        /* Ensure proper rendering for Urdu text */
        .urdu-content {
            font-family: 'Noto Nastaliq Urdu', serif;
            font-size: 1.1rem;
            direction: rtl;
            unicode-bidi: bidi-override;
            text-align: right;
            line-height: 1.8;
        }
        
        /* Custom validation message styling */
        .field-error {
            color: var(--error-color);
            font-size: 0.8rem;
            margin-top: 5px;
            display: none;
        }
        
        .field-valid {
            color: var(--success-color);
            font-size: 0.8rem;
            margin-top: 5px;
            display: none;
        }

        /* CNIC Search Loading */
        .cnic-search-loading {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            display: none;
        }

        .cnic-search-container {
            position: relative;
        }
        
        /* Enhanced validation styles */
        .validation-message {
            font-size: 0.8rem;
            margin-top: 5px;
            display: none;
        }

        .validation-error {
            color: var(--error-color);
            display: block;
        }

        .validation-success {
            color: var(--success-color);
            display: block;
        }

        .field-with-error {
            border-color: var(--error-color) !important;
        }

        .field-with-success {
            border-color: var(--success-color) !important;
        }
        
        /* Validation message styling */
        .validation-msg {
            font-size: 0.8rem;
            margin-top: 5px;
            display: none;
        }
        
        .validation-msg.error {
            color: var(--error-color);
            display: block;
        }
        
        .validation-msg.success {
            color: var(--success-color);
            display: block;
        }

        /* Attachment preview styles */
        .existing-attachment {
            background: #e8f5e8;
            border: 1px solid #27AE60;
            border-radius: 5px;
            padding: 10px;
            margin: 5px 0;
            font-size: 0.85rem;
        }

        .existing-attachment a {
            color: var(--primary-color);
            text-decoration: none;
        }

        .existing-attachment a:hover {
            text-decoration: underline;
        }

        .attachment-info {
            font-size: 0.8rem;
            color: #666;
            margin-top: 5px;
        }

        /* File input styling */
        .file-input-group {
            margin-bottom: 1rem;
        }

        .file-requirements {
            font-size: 0.8rem;
            color: #666;
            margin-top: 5px;
        }

        /* Error alert styling */
        .error-alert {
            background: #f8d7da;
            border: 1px solid #f5c6cb;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
            color: #721c24;
        }
    </style>
</head>
<body>
    <!-- Loading Overlay -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="loading-spinner">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p class="mt-3">Submitting form, please wait...</p>
        </div>
    </div>

    <!-- Registration Section -->
    <section id="registration" class="registration-section">
        <div class="container m-auto">
            <h2>Half Way Home Admissions Form</h2>
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="registration-container">
                        <div class="registration-card">
                            <!-- Step Progress Bar -->
                            <div class="step-progress active-1" role="progressbar" aria-valuemin="1" aria-valuemax="3" aria-valuenow="1">
                                <div class="step active">
                                    <div class="step-circle" aria-label="Step 1: Personal Information">۱</div>
                                    <div class="step-label">
                                        <span>Personal Information</span>
                                        <span class="urdu-label jameel-noori">ذاتی معلومات</span>
                                    </div>
                                </div>
                                <div class="step">
                                    <div class="step-circle" aria-label="Step 2: Patient Medical History">۲</div>
                                    <div class="step-label">
                                        <span>Patient Medical History</span>
                                        <span class="urdu-label jameel-noori">مریض کی طبی تاریخ</span>
                                    </div>
                                </div>
                                <div class="step">
                                    <div class="step-circle" aria-label="Step 3: Attachments">۳</div>
                                    <div class="step-label">
                                        <span>Attachments</span>
                                        <span class="urdu-label jameel-noori">منسلکات</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Success Message Display -->
                            
                            <!-- Error Alert -->
                            <div class="error-alert" style="display: none;" id="errorAlert">
                                <h6 class="alert-heading"><i class="fas fa-exclamation-triangle"></i> Please fix the following errors:</h6>
                                <ul class="mb-0" id="errorList"></ul>
                            </div>

                            <!-- Validation Errors -->
                            
                            <!-- UPDATED FORM WITH CSRF TOKEN FIX -->
                            <form class="registration-form" id="medicalRegistrationForm" action="{{ route('hwhadmissions.store') }}" method="POST" enctype="multipart/form-data" novalidate>
                                @csrf
                                
                                <!-- Hidden field for incharge_id if pre-filled -->
                                @if(isset($prefillData['incharge_id']))
                                    <input type="hidden" name="incharge_id" value="{{ $prefillData['incharge_id'] }}">
                                @endif
                                
                                <!-- Step 1: Personal Information -->
                                <div class="form-step active" id="step-1">
                                    <h3 class="form-section-title">
                                        <span>Personal Information</span>
                                        <span class="urdu-title jameel-noori">ذاتی معلومات</span>
                                    </h3>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="patient_name" class="form-label required">
                                                <span>Patient Name</span>
                                                <span class="urdu-label jameel-noori">مریض کا نام</span>
                                            </label>
                                            <input type="text" class="form-control " 
                                                   id="patient_name" name="patient_name" 
                                                   value="{{ $prefillData['patient_name'] ?? '' }}" 
                                                   required maxlength="255">
                                            <div class="validation-msg" id="patient_name_msg"></div>
                                                                                    </div>
                                        
                                        <div class="col-md-6 mb-3">
                                            <label for="father_name" class="form-label required">
                                                <span>Father's Name</span>
                                                <span class="urdu-label jameel-noori">والد کا نام</span>
                                            </label>
                                            <input type="text" class="form-control " 
                                                   id="father_name" name="father_name" 
                                                   value="{{ $prefillData['father_name'] ?? '' }}" 
                                                   required maxlength="255">
                                            <div class="validation-msg" id="father_name_msg"></div>
                                                                                    </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3 mb-3">
                                            <label for="age" class="form-label required">
                                                <span>Age</span>
                                                <span class="urdu-label jameel-noori">عمر</span>
                                            </label>
                                            <select class="form-select " 
                                                   id="age" name="age" required>
                                                <option value="">Select Age</option>
                                                                                                    <option value="1" >
                                                        1 years
                                                    </option>
                                                                                                    <option value="2" >
                                                        2 years
                                                    </option>
                                                                                                    <option value="3" >
                                                        3 years
                                                    </option>
                                                                                                    <option value="4" >
                                                        4 years
                                                    </option>
                                                                                                    <option value="5" >
                                                        5 years
                                                    </option>
                                                                                                    <option value="6" >
                                                        6 years
                                                    </option>
                                                                                                    <option value="7" >
                                                        7 years
                                                    </option>
                                                                                                    <option value="8" >
                                                        8 years
                                                    </option>
                                                                                                    <option value="9" >
                                                        9 years
                                                    </option>
                                                                                                    <option value="10" >
                                                        10 years
                                                    </option>
                                                                                                    <option value="11" >
                                                        11 years
                                                    </option>
                                                                                                    <option value="12" >
                                                        12 years
                                                    </option>
                                                                                                    <option value="13" >
                                                        13 years
                                                    </option>
                                                                                                    <option value="14" >
                                                        14 years
                                                    </option>
                                                                                                    <option value="15" >
                                                        15 years
                                                    </option>
                                                                                                    <option value="16" >
                                                        16 years
                                                    </option>
                                                                                                    <option value="17" >
                                                        17 years
                                                    </option>
                                                                                                    <option value="18" >
                                                        18 years
                                                    </option>
                                                                                                    <option value="19" >
                                                        19 years
                                                    </option>
                                                                                                    <option value="20" >
                                                        20 years
                                                    </option>
                                                                                                    <option value="21" >
                                                        21 years
                                                    </option>
                                                                                                    <option value="22" >
                                                        22 years
                                                    </option>
                                                                                                    <option value="23" >
                                                        23 years
                                                    </option>
                                                                                                    <option value="24" >
                                                        24 years
                                                    </option>
                                                                                                    <option value="25" >
                                                        25 years
                                                    </option>
                                                                                                    <option value="26" >
                                                        26 years
                                                    </option>
                                                                                                    <option value="27" >
                                                        27 years
                                                    </option>
                                                                                                    <option value="28" >
                                                        28 years
                                                    </option>
                                                                                                    <option value="29" >
                                                        29 years
                                                    </option>
                                                                                                    <option value="30" >
                                                        30 years
                                                    </option>
                                                                                                    <option value="31" >
                                                        31 years
                                                    </option>
                                                                                                    <option value="32" >
                                                        32 years
                                                    </option>
                                                                                                    <option value="33" >
                                                        33 years
                                                    </option>
                                                                                                    <option value="34" >
                                                        34 years
                                                    </option>
                                                                                                    <option value="35" >
                                                        35 years
                                                    </option>
                                                                                                    <option value="36" >
                                                        36 years
                                                    </option>
                                                                                                    <option value="37" >
                                                        37 years
                                                    </option>
                                                                                                    <option value="38" >
                                                        38 years
                                                    </option>
                                                                                                    <option value="39" >
                                                        39 years
                                                    </option>
                                                                                                    <option value="40" >
                                                        40 years
                                                    </option>
                                                                                                    <option value="41" >
                                                        41 years
                                                    </option>
                                                                                                    <option value="42" >
                                                        42 years
                                                    </option>
                                                                                                    <option value="43" >
                                                        43 years
                                                    </option>
                                                                                                    <option value="44" >
                                                        44 years
                                                    </option>
                                                                                                    <option value="45" >
                                                        45 years
                                                    </option>
                                                                                                    <option value="46" >
                                                        46 years
                                                    </option>
                                                                                                    <option value="47" >
                                                        47 years
                                                    </option>
                                                                                                    <option value="48" >
                                                        48 years
                                                    </option>
                                                                                                    <option value="49" >
                                                        49 years
                                                    </option>
                                                                                                    <option value="50" >
                                                        50 years
                                                    </option>
                                                                                                    <option value="51" >
                                                        51 years
                                                    </option>
                                                                                                    <option value="52" >
                                                        52 years
                                                    </option>
                                                                                                    <option value="53" >
                                                        53 years
                                                    </option>
                                                                                                    <option value="54" >
                                                        54 years
                                                    </option>
                                                                                                    <option value="55" >
                                                        55 years
                                                    </option>
                                                                                                    <option value="56" >
                                                        56 years
                                                    </option>
                                                                                                    <option value="57" >
                                                        57 years
                                                    </option>
                                                                                                    <option value="58" >
                                                        58 years
                                                    </option>
                                                                                                    <option value="59" >
                                                        59 years
                                                    </option>
                                                                                                    <option value="60" >
                                                        60 years
                                                    </option>
                                                                                                    <option value="61" >
                                                        61 years
                                                    </option>
                                                                                                    <option value="62" >
                                                        62 years
                                                    </option>
                                                                                                    <option value="63" >
                                                        63 years
                                                    </option>
                                                                                                    <option value="64" >
                                                        64 years
                                                    </option>
                                                                                                    <option value="65" >
                                                        65 years
                                                    </option>
                                                                                                    <option value="66" >
                                                        66 years
                                                    </option>
                                                                                                    <option value="67" >
                                                        67 years
                                                    </option>
                                                                                                    <option value="68" >
                                                        68 years
                                                    </option>
                                                                                                    <option value="69" >
                                                        69 years
                                                    </option>
                                                                                                    <option value="70" >
                                                        70 years
                                                    </option>
                                                                                                    <option value="71" >
                                                        71 years
                                                    </option>
                                                                                                    <option value="72" >
                                                        72 years
                                                    </option>
                                                                                                    <option value="73" >
                                                        73 years
                                                    </option>
                                                                                                    <option value="74" >
                                                        74 years
                                                    </option>
                                                                                                    <option value="75" >
                                                        75 years
                                                    </option>
                                                                                                    <option value="76" >
                                                        76 years
                                                    </option>
                                                                                                    <option value="77" >
                                                        77 years
                                                    </option>
                                                                                                    <option value="78" >
                                                        78 years
                                                    </option>
                                                                                                    <option value="79" >
                                                        79 years
                                                    </option>
                                                                                                    <option value="80" >
                                                        80 years
                                                    </option>
                                                                                                    <option value="81" >
                                                        81 years
                                                    </option>
                                                                                                    <option value="82" >
                                                        82 years
                                                    </option>
                                                                                                    <option value="83" >
                                                        83 years
                                                    </option>
                                                                                                    <option value="84" >
                                                        84 years
                                                    </option>
                                                                                                    <option value="85" >
                                                        85 years
                                                    </option>
                                                                                                    <option value="86" >
                                                        86 years
                                                    </option>
                                                                                                    <option value="87" >
                                                        87 years
                                                    </option>
                                                                                                    <option value="88" >
                                                        88 years
                                                    </option>
                                                                                                    <option value="89" >
                                                        89 years
                                                    </option>
                                                                                                    <option value="90" >
                                                        90 years
                                                    </option>
                                                                                                    <option value="91" >
                                                        91 years
                                                    </option>
                                                                                                    <option value="92" >
                                                        92 years
                                                    </option>
                                                                                                    <option value="93" >
                                                        93 years
                                                    </option>
                                                                                                    <option value="94" >
                                                        94 years
                                                    </option>
                                                                                                    <option value="95" >
                                                        95 years
                                                    </option>
                                                                                                    <option value="96" >
                                                        96 years
                                                    </option>
                                                                                                    <option value="97" >
                                                        97 years
                                                    </option>
                                                                                                    <option value="98" >
                                                        98 years
                                                    </option>
                                                                                                    <option value="99" >
                                                        99 years
                                                    </option>
                                                                                                    <option value="100" >
                                                        100 years
                                                    </option>
                                                                                                    <option value="101" >
                                                        101 years
                                                    </option>
                                                                                                    <option value="102" >
                                                        102 years
                                                    </option>
                                                                                                    <option value="103" >
                                                        103 years
                                                    </option>
                                                                                                    <option value="104" >
                                                        104 years
                                                    </option>
                                                                                                    <option value="105" >
                                                        105 years
                                                    </option>
                                                                                                    <option value="106" >
                                                        106 years
                                                    </option>
                                                                                                    <option value="107" >
                                                        107 years
                                                    </option>
                                                                                                    <option value="108" >
                                                        108 years
                                                    </option>
                                                                                                    <option value="109" >
                                                        109 years
                                                    </option>
                                                                                                    <option value="110" >
                                                        110 years
                                                    </option>
                                                                                                    <option value="111" >
                                                        111 years
                                                    </option>
                                                                                                    <option value="112" >
                                                        112 years
                                                    </option>
                                                                                                    <option value="113" >
                                                        113 years
                                                    </option>
                                                                                                    <option value="114" >
                                                        114 years
                                                    </option>
                                                                                                    <option value="115" >
                                                        115 years
                                                    </option>
                                                                                                    <option value="116" >
                                                        116 years
                                                    </option>
                                                                                                    <option value="117" >
                                                        117 years
                                                    </option>
                                                                                                    <option value="118" >
                                                        118 years
                                                    </option>
                                                                                                    <option value="119" >
                                                        119 years
                                                    </option>
                                                                                                    <option value="120" >
                                                        120 years
                                                    </option>
                                                                                            </select>
                                            <div class="validation-msg" id="age_msg"></div>
                                                                                    </div>
                                        
                                        <div class="col-md-3 mb-3">
                                            <label for="gender" class="form-label required">
                                                <span>Gender</span>
                                                <span class="urdu-label jameel-noori">جنس</span>
                                            </label>
                                            <select class="form-select " name="gender" required>
                                                <option value="">Select</option>
                                                <option value="male" >Male</option>
                                                <option value="female" >Female</option>
                                                <option value="other" >Other</option>
                                            </select>
                                            <div class="validation-msg" id="gender_msg"></div>
                                                                                    </div>
                                        
                                        <div class="col-md-6 mb-3 cnic-search-container">
                                            <label for="cnic" class="form-label required">
                                                <span>CNIC</span>
                                                <span class="urdu-label jameel-noori">شناختی کارڈ نمبر</span>
                                            </label>
                                            <input type="text" class="form-control " 
                                                   id="cnic" name="cnic" 
                                                   value="{{ $prefillData['cnic'] ?? '' }}" 
                                                   placeholder="12345-1234567-1" required maxlength="15">
                                            <div class="cnic-search-loading" id="cnicSearchLoading">
                                                <div class="spinner-border spinner-border-sm text-primary" role="status">
                                                    <span class="visually-hidden">Loading...</span>
                                                </div>
                                            </div>
                                            <div class="validation-msg" id="cnic_msg"></div>
                                                                                        <div class="form-text text-primary" id="cnicSearchResult" style="display: none;"></div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="phone" class="form-label required">
                                                <span>Phone Number</span>
                                                <span class="urdu-label jameel-noori">فون نمبر</span>
                                            </label>
                                            <input type="tel" class="form-control " 
                                                   id="phone" name="phone" 
                                                   value="{{ $prefillData['phone'] ?? '' }}" 
                                                   required maxlength="15">
                                            <div class="validation-msg" id="phone_msg"></div>
                                                                                    </div>
                                        
                                        <div class="col-md-6 mb-3">
                                            <label for="education" class="form-label">
                                                <span>Education</span>
                                                <span class="urdu-label jameel-noori">تعلیم</span>
                                            </label>
                                            <select class="form-select " 
                                                   id="education" name="education">
                                                <option value="">Select Education Level</option>
                                                <option value="No Formal Education" >No Formal Education</option>
                                                <option value="Primary (1-5)" >Primary (1-5)</option>
                                                <option value="Middle (6-8)" >Middle (6-8)</option>
                                                <option value="Matric (9-10)" >Matric (9-10)</option>
                                                <option value="Intermediate (11-12)" >Intermediate (11-12)</option>
                                                <option value="Bachelor's Degree" >Bachelor's Degree</option>
                                                <option value="Master's Degree" >Master's Degree</option>
                                                <option value="Doctorate" >Doctorate</option>
                                                <option value="Other" >Other</option>
                                            </select>
                                            <div class="validation-msg" id="education_msg"></div>
                                                                                    </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="address" class="form-label required">
                                            <span>Address</span>
                                            <span class="urdu-label jameel-noori">پتہ</span>
                                        </label>
                                        <textarea class="form-control " 
                                                  id="address" name="address" rows="3" required>{{ $prefillData['address'] ?? '' }}</textarea>
                                        <div class="validation-msg" id="address_msg"></div>
                                                                            </div>

                                    <h3 class="form-section-title">
                                        <span>Family Information</span>
                                        <span class="urdu-title jameel-noori">خاندانی معلومات</span>
                                    </h3>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="marital_status" class="form-label required">
                                                <span>Marital Status</span>
                                                <span class="urdu-label jameel-noori">شادی شدہ/غیر شادی شدہ</span>
                                            </label>
                                            <select class="form-select " 
                                                    id="marital_status" name="marital_status" required>
                                                <option value="">Select Marital Status</option>
                                                <option value="Single" >Single</option>
                                                <option value="Married" >Married</option>
                                                <option value="Widowed" >Widowed</option>
                                                <option value="Divorced" >Divorced</option>
                                            </select>
                                            <div class="validation-msg" id="marital_status_msg"></div>
                                                                                    </div>
                                        
                                        <div class="col-md-6 mb-3" id="spouse_name_field" style="display: none;">
                                            <label for="spouse_name" class="form-label">
                                                <span>Spouse Name</span>
                                                <span class="urdu-label jameel-noori">بیوی/شوہر کا نام</span>
                                            </label>
                                            <input type="text" class="form-control " 
                                                   id="spouse_name" name="spouse_name" 
                                                   value="" 
                                                   placeholder="Enter spouse name" maxlength="255">
                                            <div class="validation-msg" id="spouse_name_msg"></div>
                                                                                    </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label for="children_count" class="form-label">
                                                <span>Number of Children</span>
                                                <span class="urdu-label jameel-noori">بچوں کی تعداد</span>
                                            </label>
                                            <input type="number" class="form-control " 
                                                   id="children_count" name="children_count" 
                                                   value="0" min="0" max="20"
                                                   placeholder="Enter number of children">
                                            <div class="validation-msg" id="children_count_msg"></div>
                                                                                    </div>
                                        
                                        <div class="col-md-4 mb-3" id="boys_count_field" style="display: none;">
                                            <label for="boys_count" class="form-label">
                                                <span>Number of Boys</span>
                                                <span class="urdu-label jameel-noori">لڑکوں کی تعداد</span>
                                            </label>
                                            <input type="number" class="form-control " 
                                                   id="boys_count" name="boys_count" 
                                                   value="0" min="0" max="20">
                                            <div class="validation-msg" id="boys_count_msg"></div>
                                                                                    </div>
                                        
                                        <div class="col-md-4 mb-3" id="girls_count_field" style="display: none;">
                                            <label for="girls_count" class="form-label">
                                                <span>Number of Girls</span>
                                                <span class="urdu-label jameel-noori">لڑکیوں کی تعداد</span>
                                            </label>
                                            <input type="number" class="form-control " 
                                                   id="girls_count" name="girls_count" 
                                                   value="0" min="0" max="20">
                                            <div class="validation-msg" id="girls_count_msg"></div>
                                                                                    </div>
                                    </div>

                                    <div class="row" id="children_sum_error_field" style="display: none;">
                                        <div class="col-12 mb-3">
                                            <div class="invalid-feedback">Number of boys and girls must equal the total number of children.</div>
                                        </div>
                                    </div>

                                    <!-- Dynamic Children Information -->
                                    <div id="children_container">
                                        <!-- Children fields will be dynamically inserted here -->
                                    </div>

                                    <div class="mb-3">
                                        <label for="religion" class="form-label">
                                            <span>Religion</span>
                                            <span class="urdu-label jameel-noori">مذہب</span>
                                        </label>
                                        <input type="text" class="form-control " 
                                               id="religion" name="religion" 
                                               value="" 
                                               placeholder="Enter religion" maxlength="255">
                                        <div class="validation-msg" id="religion_msg"></div>
                                                                            </div>

                                    <h3 class="form-section-title">
                                        <span>Guardian Information</span>
                                        <span class="urdu-title jameel-noori">سرپرست کی معلومات</span>
                                    </h3>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="guardian_name" class="form-label required">
                                                <span>Guardian Name</span>
                                                <span class="urdu-label jameel-noori">سرپرست کا نام</span>
                                            </label>
                                            <input type="text" class="form-control " 
                                                   id="guardian_name" name="guardian_name" 
                                                   value="{{ $prefillData['guardian_name'] ?? '' }}" 
                                                   required maxlength="255">
                                            <div class="validation-msg" id="guardian_name_msg"></div>
                                                                                    </div>
                                        
                                        <div class="col-md-6 mb-3">
                                            <label for="guardian_contact" class="form-label required">
                                                <span>Guardian Contact</span>
                                                <span class="urdu-label jameel-noori">سرپرست کا رابطہ نمبر</span>
                                            </label>
                                            <input type="tel" class="form-control " 
                                                   id="guardian_contact" name="guardian_contact" 
                                                   value="{{ $prefillData['guardian_contact'] ?? '' }}" 
                                                   required maxlength="15">
                                            <div class="validation-msg" id="guardian_contact_msg"></div>
                                                                                    </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="relationship" class="form-label required">
                                                <span>Relationship with Patient</span>
                                                <span class="urdu-label jameel-noori">مریض سے تعلق</span>
                                            </label>
                                            <input type="text" class="form-control " 
                                               id="relationship" name="relationship" 
                                               value="" 
                                               required maxlength="255">
                                            <div class="validation-msg" id="relationship_msg"></div>
                                                                                    </div>
                                        
                                        <div class="col-md-6 mb-3">
                                            <label for="guardian_address" class="form-label required">
                                                <span>Guardian Address</span>
                                                <span class="urdu-label jameel-noori">سرپرست کا پتہ</span>
                                            </label>
                                            <input type="text" class="form-control " 
                                                   id="guardian_address" name="guardian_address" 
                                                   value="" 
                                                   required maxlength="255">
                                            <div class="validation-msg" id="guardian_address_msg"></div>
                                                                                    </div>
                                    </div>

                                    <div class="button-container">
                                        <button type="button" class="btn btn-secondary reset-form">Reset Form</button>
                                        <button type="button" class="btn btn-primary next-step">Next</button>
                                    </div>
                                </div>

                                <!-- Step 2: Patient Medical History -->
                                <div class="form-step" id="step-2">
                                    <h3 class="form-section-title">
                                        <span>Patient Medical History</span>
                                        <span class="urdu-title jameel-noori">مریض کی طبی تاریخ</span>
                                    </h3>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="admission_date" class="form-label required">
                                                <span>Admission Date</span>
                                                <span class="urdu-label jameel-noori">داخلے کی تاریخ</span>
                                            </label>
                                            <input type="date" class="form-control " 
                                                   id="admission_date" name="admission_date" 
                                                   value="" required>
                                            <div class="validation-msg" id="admission_date_msg"></div>
                                                                                    </div>
                                        
                                        <div class="col-md-6 mb-3">
                                            <label for="reason" class="form-label">
                                                <span>Reason for Admission</span>
                                                <span class="urdu-label jameel-noori">داخلے کی وجہ</span>
                                            </label>
                                            <input type="text" class="form-control " 
                                                   id="reason" name="reason" 
                                                   value="" 
                                                   placeholder="Reason for admission" maxlength="255">
                                            <div class="validation-msg" id="reason_msg"></div>
                                                                                    </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="disease_name" class="form-label required">
                                            <span>Disease Name</span>
                                            <span class="urdu-label jameel-noori">بیماری کا نام</span>
                                        </label>
                                        <input type="text" class="form-control " 
                                               id="disease_name" name="disease_name" 
                                               value="" 
                                               required maxlength="255">
                                        <div class="validation-msg" id="disease_name_msg"></div>
                                                                            </div>

                                    <div class="mb-3">
                                        <label for="treatment_details" class="form-label required">
                                            <span>Treatment Details</span>
                                            <span class="urdu-label jameel-noori">علاج کی تفصیل</span>
                                        </label>
                                        <textarea class="form-control " 
                                                  id="treatment_details" name="treatment_details" 
                                                  rows="4" required></textarea>
                                        <div class="validation-msg" id="treatment_details_msg"></div>
                                                                            </div>

                                    <div class="mb-3">
                                        <label for="case_history" class="form-label required">
                                            <span>Case History</span>
                                            <span class="urdu-label jameel-noori">کیس ہسٹری</span>
                                        </label>
                                        <textarea class="form-control " 
                                                  id="case_history" name="case_history" 
                                                  rows="4" required></textarea>
                                        <div class="validation-msg" id="case_history_msg"></div>
                                                                            </div>

                                    <div class="mb-3">
                                        <label for="other_diseases" class="form-label">
                                            <span>Other Diseases</span>
                                            <span class="urdu-label jameel-noori">دیگر بیماریاں</span>
                                        </label>
                                        <textarea class="form-control " 
                                                  id="other_diseases" name="other_diseases" 
                                                  rows="3"></textarea>
                                        <div class="validation-msg" id="other_diseases_msg"></div>
                                                                            </div>

                                    <div class="button-container">
                                        <button type="button" class="btn btn-primary prev-step">Previous</button>
                                        <button type="button" class="btn btn-primary next-step">Next</button>
                                    </div>
                                </div>

                                <!-- Step 3: Attachments -->
                                <div class="form-step" id="step-3">
                                    <h3 class="form-section-title">
                                        <span>Attachments</span>
                                        <span class="urdu-title jameel-noori">منسلکات</span>
                                    </h3>
                                    
                                    <div class="alert alert-info">
                                        <h6><i class="fas fa-info-circle"></i> File Requirements</h6>
                                        <ul class="mb-0">
                                            <li>All files must be in PDF, JPG, JPEG, or PNG format</li>
                                            <li>Maximum file size: 5MB per file</li>
                                            <li>Required files are marked with <span class="required"></span></li>
                                        </ul>
                                    </div>

                                    <div class="mb-3 file-input-group">
                                        <label for="id_card_front" class="form-label required">
                                            <span>Copy of ID Card (Front)</span>
                                            <span class="urdu-label jameel-noori">شناختی کارڈ کی کاپی (سامنے)</span>
                                        </label>
                                        <input type="file" class="form-control " 
                                               id="id_card_front" name="id_card_front" 
                                               accept=".pdf,.jpg,.jpeg,.png" required>
                                        <div class="file-requirements">Accepted formats: PDF, JPG, JPEG, PNG | Max size: 5MB</div>
                                        <div class="validation-msg" id="id_card_front_msg"></div>
                                                                                <div class="file-preview" id="id_card_front_preview"></div>
                                    </div>

                                    <div class="mb-3 file-input-group">
                                        <label for="id_card_back" class="form-label required">
                                            <span>Copy of ID Card (Back)</span>
                                            <span class="urdu-label jameel-noori">شناختی کارڈ کی کاپی (پیچھے)</span>
                                        </label>
                                        <input type="file" class="form-control " 
                                               id="id_card_back" name="id_card_back" 
                                               accept=".pdf,.jpg,.jpeg,.png" required>
                                        <div class="file-requirements">Accepted formats: PDF, JPG, JPEG, PNG | Max size: 5MB</div>
                                        <div class="validation-msg" id="id_card_back_msg"></div>
                                                                                <div class="file-preview" id="id_card_back_preview"></div>
                                    </div>

                                    <div class="mb-3 file-input-group">
                                        <label for="passport_photos" class="form-label required">
                                            <span>Passport-Sized Photographs</span>
                                            <span class="urdu-label jameel-noori">پاسپورٹ سائز تصاویر</span>
                                        </label>
                                        <input type="file" class="form-control " 
                                               id="passport_photos" name="passport_photos[]" 
                                               accept=".jpg,.jpeg,.png" multiple required>
                                        <div class="file-requirements">Upload at least one recent photograph. Accepted formats: JPG, JPEG, PNG | Max size: 5MB per file</div>
                                        <div class="validation-msg" id="passport_photos_msg"></div>
                                                                                                                        <div class="file-preview" id="passport_photos_preview"></div>
                                    </div>

                                    <div class="mb-3 file-input-group">
                                        <label for="medical_reports" class="form-label required">
                                            <span>Medical Reports (including HIV Test)</span>
                                            <span class="urdu-label jameel-noori">طبی رپورٹس (بشمول ایچ آئی وی ٹیسٹ)</span>
                                        </label>
                                        <input type="file" class="form-control " 
                                               id="medical_reports" name="medical_reports[]" 
                                               accept=".pdf,.jpg,.jpeg,.png" multiple required>
                                        <div class="file-requirements">Upload at least one medical report. Accepted formats: PDF, JPG, JPEG, PNG | Max size: 5MB per file</div>
                                        <div class="validation-msg" id="medical_reports_msg"></div>
                                                                                                                        <div class="file-preview" id="medical_reports_preview"></div>
                                    </div>

                                    <div class="mb-3 file-input-group">
                                        <label for="referral_form" class="form-label required">
                                            <span>Referral Form</span>
                                            <span class="urdu-label jameel-noori">ریفرل فارم</span>
                                        </label>
                                        <input type="file" class="form-control " 
                                               id="referral_form" name="referral_form" 
                                               accept=".pdf,.jpg,.jpeg,.png" required>
                                        <div class="file-requirements">Accepted formats: PDF, JPG, JPEG, PNG | Max size: 5MB</div>
                                        <div class="validation-msg" id="referral_form_msg"></div>
                                                                                <div class="file-preview" id="referral_form_preview"></div>
                                    </div>

                                    <div class="mb-3 file-input-group">
                                        <label for="affidavit" class="form-label">
                                            <span>Affidavit on Stamp Paper (Optional)</span>
                                            <span class="urdu-label jameel-noori">اسٹامپ پیپر پر بیان (اختیاری)</span>
                                        </label>
                                        <input type="file" class="form-control " 
                                               id="affidavit" name="affidavit" 
                                               accept=".pdf,.jpg,.jpeg,.png">
                                        <div class="file-requirements">Accepted formats: PDF, JPG, JPEG, PNG | Max size: 5MB</div>
                                        <div class="validation-msg" id="affidavit_msg"></div>
                                                                                <div class="file-preview" id="affidavit_preview"></div>
                                    </div>

                                    <div class="mb-3 file-input-group">
                                        <label for="additional_documents" class="form-label">
                                            <span>Additional Documents (Optional)</span>
                                            <span class="urdu-label jameel-noori">اضافی دستاویزات (اختیاری)</span>
                                        </label>
                                        <input type="file" class="form-control " 
                                               id="additional_documents" name="additional_documents[]" 
                                               accept=".pdf,.jpg,.jpeg,.png" multiple>
                                        <div class="file-requirements">Accepted formats: PDF, JPG, JPEG, PNG | Max size: 5MB per file</div>
                                        <div class="validation-msg" id="additional_documents_msg"></div>
                                                                                                                        <div class="file-preview" id="additional_documents_preview"></div>
                                    </div>

                                    <div class="button-container">
                                        <button type="button" class="btn btn-primary prev-step">Previous</button>
                                        <button type="submit" class="btn btn-success" id="submitBtn">
                                            <i class="fas fa-paper-plane"></i> Submit Application
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    <!-- Toastify JS -->
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script>
        $(document).ready(function() {
            // Form data persistence using localStorage
            const FORM_STORAGE_KEY = 'hwh_admission_form_data';
            
            // Clear localStorage when page loads to ensure fresh start
            localStorage.removeItem(FORM_STORAGE_KEY);
            
            // UPDATED AUTO-FILL FUNCTION
            function autoFillForm(data) {
                console.log('🚀 AUTO-FILL STARTED with data:', data);
                
                // Clear any previous validation errors
                $('.validation-msg').hide();
                $('.form-control, .form-select').removeClass('is-invalid');
                
                // Personal Information
                if (data.patient_name) {
                    $('#patient_name').val(data.patient_name);
                    console.log('✅ Set patient_name:', data.patient_name);
                }
                if (data.father_name) {
                    $('#father_name').val(data.father_name);
                    console.log('✅ Set father_name:', data.father_name);
                }
                if (data.age) {
                    $('#age').val(data.age.toString());
                    console.log('✅ Set age:', data.age);
                }
                if (data.gender) {
                    $('select[name="gender"]').val(data.gender);
                    console.log('✅ Set gender:', data.gender);
                }
                if (data.phone) {
                    $('#phone').val(data.phone);
                    console.log('✅ Set phone:', data.phone);
                }
                
                // EDUCATION FIELD
                if (data.education) {
                    let educationValue = data.education;
                    console.log('📚 Education data:', educationValue);
                    
                    // Handle different data structures
                    if (typeof educationValue === 'object') {
                        if (educationValue.value) educationValue = educationValue.value;
                        else if (educationValue.education_level) educationValue = educationValue.education_level;
                        else if (educationValue.level) educationValue = educationValue.level;
                        else if (educationValue.name) educationValue = educationValue.name;
                    }
                    
                    $('#education').val(educationValue);
                    console.log('✅ Set education to:', educationValue);
                }
                
                if (data.address) {
                    $('#address').val(data.address);
                    console.log('✅ Set address:', data.address);
                }
                
                // Family Information
                if (data.marital_status) {
                    $('#marital_status').val(data.marital_status);
                    updateDependentFields();
                    console.log('✅ Set marital_status:', data.marital_status);
                }
                if (data.spouse_name) {
                    $('#spouse_name').val(data.spouse_name);
                    console.log('✅ Set spouse_name:', data.spouse_name);
                }
                
                // CHILDREN DATA
                if (data.children_count && data.children_count > 0) {
                    console.log('👶 Processing children data. Count:', data.children_count);
                    
                    // Set children count first
                    $('#children_count').val(data.children_count);
                    
                    // Trigger input to generate fields
                    $('#children_count').trigger('input');
                    
                    // Wait for fields to be generated, then fill them
                    setTimeout(() => {
                        console.log('🕒 Filling children fields after generation...');
                        
                        // Get children data
                        let childrenData = [];
                        
                        if (data.children && Array.isArray(data.children)) {
                            childrenData = data.children;
                            console.log('✅ Using children array with', childrenData.length, 'items');
                        } else if (data.children_data && Array.isArray(data.children_data)) {
                            childrenData = data.children_data;
                            console.log('✅ Using children_data array with', childrenData.length, 'items');
                        }
                        
                        // Fill each child's data
                        if (childrenData.length > 0) {
                            console.log(`🎯 Found ${childrenData.length} children to populate`);
                            
                            childrenData.forEach((child, index) => {
                                if (index < data.children_count) {
                                    console.log(`👶 Filling child ${index}:`, child);
                                    
                                    const nameField = $(`input[name="children[${index}][name]"]`);
                                    const genderField = $(`select[name="children[${index}][gender]"]`);
                                    const ageField = $(`input[name="children[${index}][age]"]`);
                                    
                                    if (nameField.length && child.name) {
                                        nameField.val(child.name);
                                        console.log(`✅ Set child ${index} name:`, child.name);
                                    }
                                    
                                    if (genderField.length && child.gender) {
                                        genderField.val(child.gender);
                                        console.log(`✅ Set child ${index} gender:`, child.gender);
                                    }
                                    
                                    if (ageField.length && child.age) {
                                        ageField.val(child.age);
                                        console.log(`✅ Set child ${index} age:`, child.age);
                                    }
                                }
                            });
                        }
                        
                        // Set boys and girls count
                        if (data.boys_count) {
                            $('#boys_count').val(data.boys_count);
                            console.log('✅ Set boys_count:', data.boys_count);
                        }
                        if (data.girls_count) {
                            $('#girls_count').val(data.girls_count);
                            console.log('✅ Set girls_count:', data.girls_count);
                        }
                        
                    }, 500);
                }
                
                // Medical Information
                if (data.admission_date) {
                    $('#admission_date').val(data.admission_date);
                    console.log('✅ Set admission_date:', data.admission_date);
                }
                if (data.reason) {
                    $('#reason').val(data.reason);
                    console.log('✅ Set reason:', data.reason);
                }
                if (data.disease_name) {
                    $('#disease_name').val(data.disease_name);
                    console.log('✅ Set disease_name:', data.disease_name);
                }
                if (data.treatment_details) {
                    $('#treatment_details').val(data.treatment_details);
                    console.log('✅ Set treatment_details');
                }
                if (data.case_history) {
                    $('#case_history').val(data.case_history);
                    console.log('✅ Set case_history');
                }
                if (data.other_diseases) {
                    $('#other_diseases').val(data.other_diseases);
                    console.log('✅ Set other_diseases');
                }
                if (data.religion) {
                    $('#religion').val(data.religion);
                    console.log('✅ Set religion:', data.religion);
                }
                
                // Guardian Information
                if (data.guardian_name) {
                    $('#guardian_name').val(data.guardian_name);
                    console.log('✅ Set guardian_name:', data.guardian_name);
                }
                if (data.guardian_contact) {
                    $('#guardian_contact').val(data.guardian_contact);
                    console.log('✅ Set guardian_contact:', data.guardian_contact);
                }
                if (data.relationship) {
                    $('#relationship').val(data.relationship);
                    console.log('✅ Set relationship:', data.relationship);
                }
                if (data.guardian_address) {
                    $('#guardian_address').val(data.guardian_address);
                    console.log('✅ Set guardian_address');
                }
                
                // Save to localStorage
                saveFormData();
                
                // Show success message
                Toastify({
                    text: "Form auto-filled with existing data!",
                    duration: 3000,
                    gravity: "top",
                    position: "right",
                    style: {
                        background: "var(--success-color)",
                    },
                }).showToast();
                
                console.log('🎉 AUTO-FILL COMPLETED');
            }

            // Save form data to localStorage
            function saveFormData() {
                const formData = {};
                $('#medicalRegistrationForm').find('input, select, textarea').each(function() {
                    const fieldName = $(this).attr('name');
                    if (fieldName && !fieldName.includes('_token') && !$(this).attr('type') === 'file') {
                        formData[fieldName] = $(this).val();
                    }
                });
                
                // Save children data
                const childrenData = [];
                $('#children_container .child-card').each(function(index) {
                    const childData = {
                        name: $(this).find(`input[name="children[${index}][name]"]`).val(),
                        gender: $(this).find(`select[name="children[${index}][gender]"]`).val(),
                        age: $(this).find(`input[name="children[${index}][age]"]`).val()
                    };
                    childrenData.push(childData);
                });
                formData.children = childrenData;
                
                localStorage.setItem(FORM_STORAGE_KEY, JSON.stringify(formData));
            }
            
            // Load form data from localStorage
            function loadFormData() {
                const savedData = localStorage.getItem(FORM_STORAGE_KEY);
                if (savedData) {
                    const formData = JSON.parse(savedData);
                    Object.keys(formData).forEach(fieldName => {
                        if (fieldName === 'children') {
                            // Handle children data separately
                            return;
                        }
                        
                        const field = $(`[name="${fieldName}"]`);
                        if (field.length) {
                            field.val(formData[fieldName]);
                        }
                    });
                    
                    // Load children data if exists
                    if (formData.children && formData.children.length > 0) {
                        const childrenCount = formData.children.length;
                        $('#children_count').val(childrenCount).trigger('input');
                        
                        // Wait a bit for the children fields to be generated
                        setTimeout(() => {
                            formData.children.forEach((child, index) => {
                                if (index < childrenCount) {
                                    $(`input[name="children[${index}][name]"]`).val(child.name || '');
                                    $(`select[name="children[${index}][gender]"]`).val(child.gender || '');
                                    $(`input[name="children[${index}][age]"]`).val(child.age || '');
                                }
                            });
                        }, 100);
                    }
                    
                    // Update dependent fields
                    updateDependentFields();
                }
            }
            
            // Clear form data from localStorage
            function clearFormData() {
                localStorage.removeItem(FORM_STORAGE_KEY);
            }
            
            // Update dependent fields
            function updateDependentFields() {
                const maritalStatus = $('#marital_status').val();
                const spouseField = $('#spouse_name_field');
                
                if (maritalStatus === 'Married') {
                    spouseField.show();
                } else {
                    spouseField.hide();
                    $('#spouse_name').val('');
                }
                
                const childrenCount = parseInt($('#children_count').val()) || 0;
                const boysField = $('#boys_count_field');
                const girlsField = $('#girls_count_field');
                
                if (childrenCount > 0) {
                    boysField.show();
                    girlsField.show();
                } else {
                    boysField.hide();
                    girlsField.hide();
                }
            }
            
            // CNIC Auto-fill functionality
            function setupCnicAutoFill() {
                const cnicInput = $('#cnic');
                const searchResult = $('#cnicSearchResult');
                const searchLoading = $('#cnicSearchLoading');
                
                let searchTimeout;
                
                cnicInput.on('input', function() {
                    const cnic = $(this).val().trim();
                    
                    // Clear previous timeout
                    clearTimeout(searchTimeout);
                    
                    // Hide previous results
                    searchResult.hide();
                    
                    // Validate CNIC format
                    const cnicRegex = /^\d{5}-\d{7}-\d{1}$/;
                    if (!cnicRegex.test(cnic)) {
                        return;
                    }
                    
                    // Show loading indicator
                    searchLoading.show();
                    
                    // Set timeout to search after user stops typing
                    searchTimeout = setTimeout(() => {
                        $.get(`/hwhadmissions/search-by-cnic?cnic=${encodeURIComponent(cnic)}`)
                            .done(function(response) {
                                searchLoading.hide();
                                
                                if (response.exists) {
                                    searchResult.html(`<i class="fas fa-info-circle"></i> ${response.message}`).show();
                                    searchResult.removeClass('text-danger').addClass('text-primary');
                                    
                                    // Auto-fill form if data is found
                                    if (response.data) {
                                        autoFillForm(response.data);
                                    }
                                } else {
                                    searchResult.html(`<i class="fas fa-info-circle"></i> No existing record found. Please proceed with new registration.`).show();
                                    searchResult.removeClass('text-danger').addClass('text-info');
                                }
                            })
                            .fail(function(xhr, status, error) {
                                searchLoading.hide();
                                console.error('CNIC search error:', error);
                                searchResult.html(`<i class="fas fa-exclamation-triangle"></i> Error searching for CNIC`).show();
                                searchResult.removeClass('text-primary').addClass('text-danger');
                            });
                    }, 1000);
                });
            }
            
            // Initialize form state
            function initializeForm() {
                $('.step-progress').removeClass('active-1 active-2 active-3').addClass('active-1');
                $('.step').removeClass('active completed');
                $('.step:eq(0)').addClass('active');
                
                // Set max date for admission date to today
                const today = new Date().toISOString().split('T')[0];
                $('#admission_date').attr('max', today);
                
                // Initialize marital status visibility
                updateDependentFields();
                
                // Initialize children count
                $('#children_count').trigger('input');
            }
            
            // Step navigation
            $('.next-step').click(function() {
                let currentStep = $('.form-step.active');
                let nextStep = currentStep.next('.form-step');
                if (validateStep(currentStep)) {
                    currentStep.removeClass('active');
                    nextStep.addClass('active');
                    updateProgress();
                    saveFormData();
                } else {
                    showToast("Please fill out all required fields correctly.", "error");
                }
            });
            
            $('.prev-step').click(function() {
                let currentStep = $('.form-step.active');
                let prevStep = currentStep.prev('.form-step');
                currentStep.removeClass('active');
                prevStep.addClass('active');
                updateProgress();
            });
            
            // Form validation
            function validateStep(step) {
                let isValid = true;
                let firstInvalidField = null;
                let errorMessages = [];
                
                // Validate required fields
                step.find('input[required], select[required], textarea[required]').each(function() {
                    const field = $(this);
                    const fieldId = field.attr('id');
                    const msgElement = $(`#${fieldId}_msg`);
                    const fieldName = field.attr('name');
                    
                    if (!field.val().trim()) {
                        field.addClass('is-invalid');
                        msgElement.text('This field is required').addClass('error').show();
                        isValid = false;
                        errorMessages.push(`${getFieldLabel(fieldName)} is required`);
                        if (!firstInvalidField) {
                            firstInvalidField = field;
                        }
                    } else {
                        field.removeClass('is-invalid');
                        msgElement.hide();
                    }
                });
                
                // Validate file fields in step 3
                if (step.attr('id') === 'step-3') {
                    const fileFields = [
                        'id_card_front', 'id_card_back', 'passport_photos', 
                        'medical_reports', 'referral_form'
                    ];
                    
                    fileFields.forEach(fieldName => {
                        const field = $(`#${fieldName}`);
                        const msgElement = $(`#${fieldName}_msg`);
                        
                        if (field.attr('required')) {
                            if (field.attr('multiple')) {
                                // Multiple file input
                                if (!field[0].files || field[0].files.length === 0) {
                                    field.addClass('is-invalid');
                                    msgElement.text('At least one file is required').addClass('error').show();
                                    isValid = false;
                                    errorMessages.push(`${getFieldLabel(fieldName)} is required`);
                                    if (!firstInvalidField) {
                                        firstInvalidField = field;
                                    }
                                } else {
                                    field.removeClass('is-invalid');
                                    msgElement.hide();
                                }
                            } else {
                                // Single file input
                                if (!field[0].files || field[0].files.length === 0) {
                                    field.addClass('is-invalid');
                                    msgElement.text('This file is required').addClass('error').show();
                                    isValid = false;
                                    errorMessages.push(`${getFieldLabel(fieldName)} is required`);
                                    if (!firstInvalidField) {
                                        firstInvalidField = field;
                                    }
                                } else {
                                    field.removeClass('is-invalid');
                                    msgElement.hide();
                                }
                            }
                        }
                    });
                }
                
                // Validate children fields if applicable
                if (step.attr('id') === 'step-1') {
                    let childrenCount = parseInt($('#children_count').val()) || 0;
                    
                    if (childrenCount > 0) {
                        // Validate children information
                        $('#children_container input[required], #children_container select[required]').each(function() {
                            const field = $(this);
                            const fieldId = field.attr('id');
                            const msgElement = $(`#${fieldId}_msg`);
                            
                            if (!field.val().trim()) {
                                field.addClass('is-invalid');
                                msgElement.text('This field is required').addClass('error').show();
                                isValid = false;
                                if (!firstInvalidField) {
                                    firstInvalidField = field;
                                }
                            } else {
                                field.removeClass('is-invalid');
                                msgElement.hide();
                            }
                        });
                        
                        // Validate children count consistency
                        let boysCount = parseInt($('#boys_count').val()) || 0;
                        let girlsCount = parseInt($('#girls_count').val()) || 0;
                        
                        if (boysCount + girlsCount !== childrenCount) {
                            $('#children_sum_error_field').show();
                            $('#boys_count').addClass('is-invalid');
                            $('#girls_count').addClass('is-invalid');
                            $('#boys_count_msg').text('Number of boys and girls must equal the total number of children').addClass('error').show();
                            $('#girls_count_msg').text('Number of boys and girls must equal the total number of children').addClass('error').show();
                            isValid = false;
                        } else {
                            $('#children_sum_error_field').hide();
                            $('#boys_count').removeClass('is-invalid');
                            $('#girls_count').removeClass('is-invalid');
                            $('#boys_count_msg').hide();
                            $('#girls_count_msg').hide();
                        }
                    }
                }
                
                // Validate phone numbers
                step.find('input[type="tel"]').each(function() {
                    const field = $(this);
                    const fieldId = field.attr('id');
                    const msgElement = $(`#${fieldId}_msg`);
                    let phoneRegex = /^\+?[\d\s-]{10,15}$/;
                    
                    if (field.val() && !phoneRegex.test(field.val().replace(/\s/g, ''))) {
                        field.addClass('is-invalid');
                        msgElement.text('Please enter a valid phone number').addClass('error').show();
                        isValid = false;
                        if (!firstInvalidField) {
                            firstInvalidField = field;
                        }
                    } else {
                        field.removeClass('is-invalid');
                        msgElement.hide();
                    }
                });
                
                // Validate CNIC number
                if (step.find('#cnic').length) {
                    const cnicField = $('#cnic');
                    const cnicMsg = $('#cnic_msg');
                    let cnicRegex = /^\d{5}-\d{7}-\d{1}$/;
                    
                    if (cnicField.val() && !cnicRegex.test(cnicField.val())) {
                        cnicField.addClass('is-invalid');
                        cnicMsg.text('Please enter a valid CNIC number (format: 12345-1234567-1)').addClass('error').show();
                        isValid = false;
                        if (!firstInvalidField) {
                            firstInvalidField = cnicField;
                        }
                    } else {
                        cnicField.removeClass('is-invalid');
                        cnicMsg.hide();
                    }
                }
                
                // Show error messages
                if (!isValid) {
                    $('#errorList').empty();
                    errorMessages.forEach(msg => {
                        $('#errorList').append(`<li>${msg}</li>`);
                    });
                    $('#errorAlert').show();
                } else {
                    $('#errorAlert').hide();
                }
                
                // Scroll to first invalid field
                if (!isValid && firstInvalidField) {
                    $('html, body').animate({
                        scrollTop: firstInvalidField.offset().top - 100
                    }, 500);
                }
                
                return isValid;
            }
            
            // Helper function to get field label
            function getFieldLabel(fieldName) {
                const labels = {
                    'patient_name': 'Patient Name',
                    'father_name': 'Father\'s Name',
                    'age': 'Age',
                    'gender': 'Gender',
                    'cnic': 'CNIC',
                    'phone': 'Phone Number',
                    'address': 'Address',
                    'marital_status': 'Marital Status',
                    'guardian_name': 'Guardian Name',
                    'guardian_contact': 'Guardian Contact',
                    'relationship': 'Relationship',
                    'guardian_address': 'Guardian Address',
                    'admission_date': 'Admission Date',
                    'disease_name': 'Disease Name',
                    'treatment_details': 'Treatment Details',
                    'case_history': 'Case History',
                    'id_card_front': 'ID Card Front',
                    'id_card_back': 'ID Card Back',
                    'passport_photos': 'Passport Photos',
                    'medical_reports': 'Medical Reports',
                    'referral_form': 'Referral Form'
                };
                
                return labels[fieldName] || fieldName;
            }
            
            // Update progress bar
            function updateProgress() {
                let currentIndex = $('.form-step.active').index() + 1;
                $('.step-progress').removeClass('active-1 active-2 active-3').addClass('active-' + currentIndex);
                $('.step').removeClass('active completed');
                $('.step:lt(' + currentIndex + ')').addClass('completed');
                $('.step:eq(' + (currentIndex - 1) + ')').addClass('active');
            }
            
            // Reset form
            $('.reset-form').click(function() {
                if (confirm('Are you sure you want to reset the form? All entered data will be lost.')) {
                    $('#medicalRegistrationForm')[0].reset();
                    $('.form-step').removeClass('active');
                    $('#step-1').addClass('active');
                    initializeForm();
                    $('input, select, textarea').removeClass('is-invalid');
                    $('.file-preview').empty();
                    $('.validation-msg').hide();
                    $('#errorAlert').hide();
                    clearFormData();
                    showToast("Form has been reset successfully.", "success");
                }
            });
            
            // Show/hide children gender fields and handle dynamic children
            $('#children_count').on('input', function() {
                let childrenCount = parseInt($(this).val()) || 0;
                if (childrenCount > 0) {
                    $('#boys_count_field').show();
                    $('#girls_count_field').show();
                    generateChildrenFields(childrenCount);
                } else {
                    $('#boys_count_field').hide();
                    $('#girls_count_field').hide();
                    $('#children_container').empty();
                    $('#children_sum_error_field').hide();
                }
                saveFormData();
            });
            
            // Generate dynamic children fields
            function generateChildrenFields(count) {
                $('#children_container').empty();
                
                if (count > 0) {
                    const title = document.createElement('h6');
                    title.className = 'mt-3 mb-2';
                    title.innerHTML = '<span>Children Information</span> <span class="urdu-label jameel-noori">بچوں کی معلومات</span>';
                    $('#children_container').append(title);
                    
                    for (let i = 0; i < count; i++) {
                        const childCard = document.createElement('div');
                        childCard.className = 'child-card';
                        childCard.id = `child-card-${i}`;
                        childCard.innerHTML = `
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label required">
                                        <span>Child Name</span>
                                        <span class="urdu-label jameel-noori">بچے کا نام</span>
                                    </label>
                                    <input type="text" class="form-control child-name" name="children[${i}][name]" id="child-name-${i}" required>
                                    <div class="validation-msg" id="child-name-${i}_msg"></div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label required">
                                        <span>Gender</span>
                                        <span class="urdu-label jameel-noori">جنس</span>
                                    </label>
                                    <select class="form-select child-gender" name="children[${i}][gender]" id="child-gender-${i}" required>
                                        <option value="">Select</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                    <div class="validation-msg" id="child-gender-${i}_msg"></div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">
                                        <span>Age</span>
                                        <span class="urdu-label jameel-noori">عمر</span>
                                    </label>
                                    <input type="number" class="form-control child-age" name="children[${i}][age]" id="child-age-${i}" min="0" max="25">
                                    <div class="validation-msg" id="child-age-${i}_msg"></div>
                                </div>
                            </div>
                        `;
                        $('#children_container').append(childCard);
                    }
                }
            }
            
            // Validate children count consistency
            $('#boys_count, #girls_count').on('input', function() {
                let childrenCount = parseInt($('#children_count').val()) || 0;
                let boysCount = parseInt($('#boys_count').val()) || 0;
                let girlsCount = parseInt($('#girls_count').val()) || 0;
                
                if (childrenCount > 0 && boysCount + girlsCount !== childrenCount) {
                    $('#children_sum_error_field').show();
                    $('#boys_count').addClass('is-invalid');
                    $('#girls_count').addClass('is-invalid');
                    $('#boys_count_msg').text('Number of boys and girls must equal the total number of children').addClass('error').show();
                    $('#girls_count_msg').text('Number of boys and girls must equal the total number of children').addClass('error').show();
                } else {
                    $('#children_sum_error_field').hide();
                    $('#boys_count').removeClass('is-invalid');
                    $('#girls_count').removeClass('is-invalid');
                    $('#boys_count_msg').hide();
                    $('#girls_count_msg').hide();
                }
                saveFormData();
            });
            
            // Show/hide spouse field based on marital status
            $('#marital_status').on('change', function() {
                updateDependentFields();
                saveFormData();
            });
            
            // CNIC formatting
            document.getElementById('cnic').addEventListener('input', function(e) {
                let value = e.target.value.replace(/\D/g, '');
                
                if (value.length > 5) {
                    value = value.substring(0, 5) + '-' + value.substring(5);
                }
                if (value.length > 13) {
                    value = value.substring(0, 13) + '-' + value.substring(13, 14);
                }
                
                e.target.value = value;
            });
            
            // File preview functionality
            $('input[type="file"]').on('change', function() {
                const previewId = $(this).attr('id') + '_preview';
                const previewElement = $('#' + previewId);
                previewElement.empty();
                
                if (this.files && this.files.length > 0) {
                    if (this.multiple) {
                        for (let i = 0; i < this.files.length; i++) {
                            previewElement.append(`<div>${this.files[i].name} (${formatFileSize(this.files[i].size)})</div>`);
                        }
                    } else {
                        previewElement.text(`${this.files[0].name} (${formatFileSize(this.files[0].size)})`);
                    }
                }
            });
            
            function formatFileSize(bytes) {
                if (bytes === 0) return '0 Bytes';
                const k = 1024;
                const sizes = ['Bytes', 'KB', 'MB', 'GB'];
                const i = Math.floor(Math.log(bytes) / Math.log(k));
                return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
            }
            
            // File size validation
            $('input[type="file"]').on('change', function() {
                const maxSize = 5 * 1024 * 1024; // 5MB in bytes
                const files = this.files;
                const fieldId = $(this).attr('id');
                const msgElement = $(`#${fieldId}_msg`);
                
                if (files) {
                    for (let i = 0; i < files.length; i++) {
                        if (files[i].size > maxSize) {
                            msgElement.text(`File ${files[i].name} exceeds the maximum size of 5MB`).addClass('error').show();
                            $(this).addClass('is-invalid');
                            this.value = '';
                            const previewId = $(this).attr('id') + '_preview';
                            $('#' + previewId).empty();
                            break;
                        } else {
                            msgElement.hide();
                            $(this).removeClass('is-invalid');
                        }
                    }
                }
            });
            
            // Form submission
            $('#medicalRegistrationForm').on('submit', function(e) {
                console.log('Form submission started...');
                
                // Validate all steps before submission
                let allStepsValid = true;
                $('.form-step').each(function() {
                    if (!validateStep($(this))) {
                        allStepsValid = false;
                        // Show the first invalid step
                        if (!$('.form-step.active').is($(this))) {
                            $('.form-step').removeClass('active');
                            $(this).addClass('active');
                            updateProgress();
                        }
                        return false; // break the loop
                    }
                });
                
                if (!allStepsValid) {
                    e.preventDefault();
                    showToast("Please fix all validation errors before submitting.", "error");
                    return;
                }
                
                // Show loading overlay and let form submit naturally
                $('#loadingOverlay').show();
                $('#submitBtn').prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Submitting...');
                
                console.log('Form is being submitted to server...');
                // Let the form submit naturally - server validation will handle errors
                
                // Clear form data after successful submission
                setTimeout(() => {
                    clearFormData();
                }, 2000);
            });
            
            // Remove loading if page is refreshed
            $(window).on('beforeunload', function() {
                $('#loadingOverlay').hide();
            });
            
            // Toast function
            function showToast(message, type = "info") {
                const backgroundColor = type === "error" ? "#A93226" : 
                                      type === "success" ? "#27AE60" : 
                                      "#264653";
                
                Toastify({
                    text: message,
                    duration: 4000,
                    gravity: "top",
                    position: "right",
                    style: {
                        background: backgroundColor,
                    },
                }).showToast();
            }
            
            // Save form data on input
            $('#medicalRegistrationForm').on('input', 'input, select, textarea', function() {
                saveFormData();
            });
            
            // Save children data when children fields change
            $(document).on('input', '#children_container input, #children_container select', function() {
                saveFormData();
            });
            
            // Initialize CNIC auto-fill
            setupCnicAutoFill();
            
            // Load any saved form data
            loadFormData();
            
            // Initialize form on load
            initializeForm();
        });
    </script>
</body>
</html>