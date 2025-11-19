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
                            @if(session('success'))
                            <div class="success-message" id="successMessage">
                                <i class="fas fa-check-circle"></i> 
                                <span id="successText">{{ session('success') }}</span>
                                @if(session('reference_id'))
                                <div class="reference-id" id="referenceId">{{ session('reference_id') }}</div>
                                @endif
                                <p class="mb-0 mt-2"><small>Your data has been saved successfully. Please keep your reference ID for future correspondence.</small></p>
                            </div>
                            @endif

                            <div class="alert alert-danger" style="display: none;" id="errorAlert">
                                <h6 class="alert-heading">Please fix the following errors:</h6>
                                <ul class="mb-0" id="errorList"></ul>
                            </div>

                            <!-- CHANGED: Remove all old() values to ensure fresh form -->
                            <form class="registration-form" id="medicalRegistrationForm" action="{{ route('hwhadmissions.store') }}" method="POST" enctype="multipart/form-data" novalidate>
                                @csrf
                                
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
                                            <!-- CHANGED: Remove old() value -->
                                            <input type="text" class="form-control @error('patient_name') is-invalid @enderror" 
                                                   id="patient_name" name="patient_name" value="" required>
                                            <div class="validation-msg" id="patient_name_msg"></div>
                                            @error('patient_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        
                                        <div class="col-md-6 mb-3">
                                            <label for="father_name" class="form-label required">
                                                <span>Father's Name</span>
                                                <span class="urdu-label jameel-noori">والد کا نام</span>
                                            </label>
                                            <!-- CHANGED: Remove old() value -->
                                            <input type="text" class="form-control @error('father_name') is-invalid @enderror" 
                                                   id="father_name" name="father_name" value="" required>
                                            <div class="validation-msg" id="father_name_msg"></div>
                                            @error('father_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3 mb-3">
                                            <label for="age" class="form-label required">
                                                <span>Age</span>
                                                <span class="urdu-label jameel-noori">عمر</span>
                                            </label>
                                            <!-- CHANGED: Remove old() value -->
                                            <select class="form-select @error('age') is-invalid @enderror" 
                                                   id="age" name="age" required>
                                                <option value="">Select Age</option>
                                                @for ($i = 1; $i <= 120; $i++)
                                                    <option value="{{ $i }}">{{ $i }} years</option>
                                                @endfor
                                            </select>
                                            <div class="validation-msg" id="age_msg"></div>
                                            @error('age')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        
                                        <div class="col-md-3 mb-3">
                                            <label for="gender" class="form-label required">
                                                <span>Gender</span>
                                                <span class="urdu-label jameel-noori">جنس</span>
                                            </label>
                                            <!-- CHANGED: Remove old() value -->
                                            <select class="form-select @error('gender') is-invalid @enderror" name="gender" required>
                                                <option value="">Select</option>
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>
                                                <option value="other">Other</option>
                                            </select>
                                            <div class="validation-msg" id="gender_msg"></div>
                                            @error('gender')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        
                                        <div class="col-md-6 mb-3 cnic-search-container">
                                            <label for="cnic" class="form-label required">
                                                <span>CNIC</span>
                                                <span class="urdu-label jameel-noori">شناختی کارڈ نمبر</span>
                                            </label>
                                            <!-- CHANGED: Remove old() value -->
                                            <input type="text" class="form-control @error('cnic') is-invalid @enderror" 
                                                   id="cnic" name="cnic" value="" 
                                                   placeholder="12345-1234567-1" required>
                                            <div class="cnic-search-loading" id="cnicSearchLoading">
                                                <div class="spinner-border spinner-border-sm text-primary" role="status">
                                                    <span class="visually-hidden">Loading...</span>
                                                </div>
                                            </div>
                                            <div class="validation-msg" id="cnic_msg"></div>
                                            @error('cnic')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <div class="form-text text-primary" id="cnicSearchResult" style="display: none;"></div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="phone" class="form-label required">
                                                <span>Phone Number</span>
                                                <span class="urdu-label jameel-noori">فون نمبر</span>
                                            </label>
                                            <!-- CHANGED: Remove old() value -->
                                            <input type="tel" class="form-control @error('phone') is-invalid @enderror" 
                                                   id="phone" name="phone" value="" required>
                                            <div class="validation-msg" id="phone_msg"></div>
                                            @error('phone')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        
                                        <div class="col-md-6 mb-3">
                                            <label for="education" class="form-label">
                                                <span>Education</span>
                                                <span class="urdu-label jameel-noori">تعلیم</span>
                                            </label>
                                            <!-- CHANGED: Remove old() value -->
                                            <select class="form-select @error('education') is-invalid @enderror" 
                                                   id="education" name="education">
                                                <option value="">Select Education Level</option>
                                                <option value="No Formal Education">No Formal Education</option>
                                                <option value="Primary (1-5)">Primary (1-5)</option>
                                                <option value="Middle (6-8)">Middle (6-8)</option>
                                                <option value="Matric (9-10)">Matric (9-10)</option>
                                                <option value="Intermediate (11-12)">Intermediate (11-12)</option>
                                                <option value="Bachelor's Degree">Bachelor's Degree</option>
                                                <option value="Master's Degree">Master's Degree</option>
                                                <option value="Doctorate">Doctorate</option>
                                                <option value="Other">Other</option>
                                            </select>
                                            <div class="validation-msg" id="education_msg"></div>
                                            @error('education')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="address" class="form-label required">
                                            <span>Address</span>
                                            <span class="urdu-label jameel-noori">پتہ</span>
                                        </label>
                                        <!-- CHANGED: Remove old() value -->
                                        <textarea class="form-control @error('address') is-invalid @enderror" 
                                                  id="address" name="address" rows="3" required></textarea>
                                        <div class="validation-msg" id="address_msg"></div>
                                        @error('address')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
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
                                            <!-- CHANGED: Remove old() value -->
                                            <select class="form-select @error('marital_status') is-invalid @enderror" 
                                                    id="marital_status" name="marital_status" required>
                                                <option value="">Select Marital Status</option>
                                                <option value="Single">Single</option>
                                                <option value="Married">Married</option>
                                                <option value="Widowed">Widowed</option>
                                                <option value="Divorced">Divorced</option>
                                            </select>
                                            <div class="validation-msg" id="marital_status_msg"></div>
                                            @error('marital_status')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        
                                        <div class="col-md-6 mb-3" id="spouse_name_field" style="display: none;">
                                            <label for="spouse_name" class="form-label">
                                                <span>Spouse Name</span>
                                                <span class="urdu-label jameel-noori">بیوی/شوہر کا نام</span>
                                            </label>
                                            <!-- CHANGED: Remove old() value -->
                                            <input type="text" class="form-control @error('spouse_name') is-invalid @enderror" 
                                                   id="spouse_name" name="spouse_name" value=""
                                                   placeholder="Enter spouse name">
                                            <div class="validation-msg" id="spouse_name_msg"></div>
                                            @error('spouse_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label for="children_count" class="form-label">
                                                <span>Number of Children</span>
                                                <span class="urdu-label jameel-noori">بچوں کی تعداد</span>
                                            </label>
                                            <!-- CHANGED: Remove old() value -->
                                            <input type="number" class="form-control @error('children_count') is-invalid @enderror" 
                                                   id="children_count" name="children_count" 
                                                   value="0" min="0" 
                                                   placeholder="Enter number of children">
                                            <div class="validation-msg" id="children_count_msg"></div>
                                            @error('children_count')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        
                                        <div class="col-md-4 mb-3" id="boys_count_field" style="display: none;">
                                            <label for="boys_count" class="form-label">
                                                <span>Number of Boys</span>
                                                <span class="urdu-label jameel-noori">لڑکوں کی تعداد</span>
                                            </label>
                                            <!-- CHANGED: Remove old() value -->
                                            <input type="number" class="form-control @error('boys_count') is-invalid @enderror" 
                                                   id="boys_count" name="boys_count" value="0" min="0">
                                            <div class="validation-msg" id="boys_count_msg"></div>
                                            @error('boys_count')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        
                                        <div class="col-md-4 mb-3" id="girls_count_field" style="display: none;">
                                            <label for="girls_count" class="form-label">
                                                <span>Number of Girls</span>
                                                <span class="urdu-label jameel-noori">لڑکیوں کی تعداد</span>
                                            </label>
                                            <!-- CHANGED: Remove old() value -->
                                            <input type="number" class="form-control @error('girls_count') is-invalid @enderror" 
                                                   id="girls_count" name="girls_count" value="0" min="0">
                                            <div class="validation-msg" id="girls_count_msg"></div>
                                            @error('girls_count')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
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
                                        <!-- CHANGED: Remove old() value -->
                                        <input type="text" class="form-control @error('religion') is-invalid @enderror" 
                                               id="religion" name="religion" value="">
                                        <div class="validation-msg" id="religion_msg"></div>
                                        @error('religion')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
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
                                            <!-- CHANGED: Remove old() value -->
                                            <input type="text" class="form-control @error('guardian_name') is-invalid @enderror" 
                                                   id="guardian_name" name="guardian_name" value="" required>
                                            <div class="validation-msg" id="guardian_name_msg"></div>
                                            @error('guardian_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        
                                        <div class="col-md-6 mb-3">
                                            <label for="guardian_contact" class="form-label required">
                                                <span>Guardian Contact</span>
                                                <span class="urdu-label jameel-noori">سرپرست کا رابطہ نمبر</span>
                                            </label>
                                            <!-- CHANGED: Remove old() value -->
                                            <input type="tel" class="form-control @error('guardian_contact') is-invalid @enderror" 
                                                   id="guardian_contact" name="guardian_contact" value="" required>
                                            <div class="validation-msg" id="guardian_contact_msg"></div>
                                            @error('guardian_contact')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="relationship" class="form-label required">
                                                <span>Relationship with Patient</span>
                                                <span class="urdu-label jameel-noori">مریض سے تعلق</span>
                                            </label>
                                            <!-- CHANGED: Remove old() value -->
                                            <input type="text" class="form-control @error('relationship') is-invalid @enderror" 
                                               id="relationship" name="relationship" value="" required>
                                            <div class="validation-msg" id="relationship_msg"></div>
                                            @error('relationship')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        
                                        <div class="col-md-6 mb-3">
                                            <label for="guardian_address" class="form-label required">
                                                <span>Guardian Address</span>
                                                <span class="urdu-label jameel-noori">سرپرست کا پتہ</span>
                                            </label>
                                            <!-- CHANGED: Remove old() value -->
                                            <input type="text" class="form-control @error('guardian_address') is-invalid @enderror" 
                                                   id="guardian_address" name="guardian_address" value="" required>
                                            <div class="validation-msg" id="guardian_address_msg"></div>
                                            @error('guardian_address')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
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
                                            <!-- CHANGED: Remove old() value -->
                                            <input type="date" class="form-control @error('admission_date') is-invalid @enderror" 
                                                   id="admission_date" name="admission_date" 
                                                   value="" required>
                                            <div class="validation-msg" id="admission_date_msg"></div>
                                            @error('admission_date')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        
                                        <div class="col-md-6 mb-3">
                                            <label for="reason" class="form-label">
                                                <span>Reason for Admission</span>
                                                <span class="urdu-label jameel-noori">داخلے کی وجہ</span>
                                            </label>
                                            <!-- CHANGED: Remove old() value -->
                                            <input type="text" class="form-control @error('reason') is-invalid @enderror" 
                                                   id="reason" name="reason" value="">
                                            <div class="validation-msg" id="reason_msg"></div>
                                            @error('reason')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="disease_name" class="form-label required">
                                            <span>Disease Name</span>
                                            <span class="urdu-label jameel-noori">بیماری کا نام</span>
                                        </label>
                                        <!-- CHANGED: Remove old() value -->
                                        <input type="text" class="form-control @error('disease_name') is-invalid @enderror" 
                                               id="disease_name" name="disease_name" value="" required>
                                        <div class="validation-msg" id="disease_name_msg"></div>
                                        @error('disease_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="treatment_details" class="form-label required">
                                            <span>Treatment Details</span>
                                            <span class="urdu-label jameel-noori">علاج کی تفصیل</span>
                                        </label>
                                        <!-- CHANGED: Remove old() value -->
                                        <textarea class="form-control @error('treatment_details') is-invalid @enderror" 
                                                  id="treatment_details" name="treatment_details" rows="4" required></textarea>
                                        <div class="validation-msg" id="treatment_details_msg"></div>
                                        @error('treatment_details')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="case_history" class="form-label required">
                                            <span>Case History</span>
                                            <span class="urdu-label jameel-noori">کیس ہسٹری</span>
                                        </label>
                                        <!-- CHANGED: Remove old() value -->
                                        <textarea class="form-control @error('case_history') is-invalid @enderror" 
                                                  id="case_history" name="case_history" rows="4" required></textarea>
                                        <div class="validation-msg" id="case_history_msg"></div>
                                        @error('case_history')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="other_diseases" class="form-label">
                                            <span>Other Diseases</span>
                                            <span class="urdu-label jameel-noori">دیگر بیماریاں</span>
                                        </label>
                                        <!-- CHANGED: Remove old() value -->
                                        <textarea class="form-control @error('other_diseases') is-invalid @enderror" 
                                                  id="other_diseases" name="other_diseases" rows="3"></textarea>
                                        <div class="validation-msg" id="other_diseases_msg"></div>
                                        @error('other_diseases')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
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
                                    
                                    <!-- Existing Attachments Display Area -->
                                    <div id="existingAttachments" style="display: none;">
                                        <div class="alert alert-info">
                                            <h6><i class="fas fa-info-circle"></i> Existing Attachments Found</h6>
                                            <p class="mb-2">The following attachments were found from the existing record. You can keep these or upload new files.</p>
                                        </div>
                                        <div class="row" id="attachmentPreviews">
                                            <!-- Existing attachment previews will be displayed here -->
                                        </div>
                                        <hr>
                                    </div>

                                    <div class="mb-3">
                                        <label for="id_card_front" class="form-label required">
                                            <span>Copy of ID Card (Front)</span>
                                            <span class="urdu-label jameel-noori">شناختی کارڈ کی کاپی (سامنے)</span>
                                        </label>
                                        <input type="file" class="form-control @error('id_card_front') is-invalid @enderror" 
                                               id="id_card_front" name="id_card_front" accept=".pdf,.jpg,.jpeg,.png">
                                        <div class="form-text">Max file size: 5MB</div>
                                        <div class="validation-msg" id="id_card_front_msg"></div>
                                        @error('id_card_front')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="file-preview" id="id_card_front_preview"></div>
                                        <div class="existing-attachment" id="existing_id_card_front" style="display: none;"></div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="id_card_back" class="form-label required">
                                            <span>Copy of ID Card (Back)</span>
                                            <span class="urdu-label jameel-noori">شناختی کارڈ کی کاپی (پیچھے)</span>
                                        </label>
                                        <input type="file" class="form-control @error('id_card_back') is-invalid @enderror" 
                                               id="id_card_back" name="id_card_back" accept=".pdf,.jpg,.jpeg,.png">
                                        <div class="form-text">Max file size: 5MB</div>
                                        <div class="validation-msg" id="id_card_back_msg"></div>
                                        @error('id_card_back')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="file-preview" id="id_card_back_preview"></div>
                                        <div class="existing-attachment" id="existing_id_card_back" style="display: none;"></div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="passport_photos" class="form-label required">
                                            <span>Passport-Sized Photographs</span>
                                            <span class="urdu-label jameel-noori">پاسپورٹ سائز تصاویر</span>
                                        </label>
                                        <input type="file" class="form-control @error('passport_photos') is-invalid @enderror" 
                                               id="passport_photos" name="passport_photos[]" accept=".jpg,.jpeg,.png" multiple>
                                        <div class="form-text">Upload four recent photographs. Max file size: 5MB each</div>
                                        <div class="validation-msg" id="passport_photos_msg"></div>
                                        @error('passport_photos')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        @error('passport_photos.*')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="file-preview" id="passport_photos_preview"></div>
                                        <div class="existing-attachment" id="existing_passport_photos" style="display: none;"></div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="medical_reports" class="form-label required">
                                            <span>Medical Reports (including HIV Test)</span>
                                            <span class="urdu-label jameel-noori">طبی رپورٹس (بشمول ایچ آئی وی ٹیسٹ)</span>
                                        </label>
                                        <input type="file" class="form-control @error('medical_reports') is-invalid @enderror" 
                                               id="medical_reports" name="medical_reports[]" accept=".pdf,.jpg,.jpeg,.png" multiple>
                                        <div class="form-text">Max file size: 5MB each</div>
                                        <div class="validation-msg" id="medical_reports_msg"></div>
                                        @error('medical_reports')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        @error('medical_reports.*')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="file-preview" id="medical_reports_preview"></div>
                                        <div class="existing-attachment" id="existing_medical_reports" style="display: none;"></div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="referral_form" class="form-label required">
                                            <span>Referral Form</span>
                                            <span class="urdu-label jameel-noori">ریفرل فارم</span>
                                        </label>
                                        <input type="file" class="form-control @error('referral_form') is-invalid @enderror" 
                                               id="referral_form" name="referral_form" accept=".pdf,.jpg,.jpeg,.png">
                                        <div class="form-text">Max file size: 5MB</div>
                                        <div class="validation-msg" id="referral_form_msg"></div>
                                        @error('referral_form')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="file-preview" id="referral_form_preview"></div>
                                        <div class="existing-attachment" id="existing_referral_form" style="display: none;"></div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="affidavit" class="form-label">
                                            <span>Affidavit on Stamp Paper (Optional)</span>
                                            <span class="urdu-label jameel-noori">اسٹامپ پیپر پر بیان (اختیاری)</span>
                                        </label>
                                        <input type="file" class="form-control @error('affidavit') is-invalid @enderror" 
                                               id="affidavit" name="affidavit" accept=".pdf,.jpg,.jpeg,.png">
                                        <div class="form-text">Max file size: 5MB</div>
                                        <div class="validation-msg" id="affidavit_msg"></div>
                                        @error('affidavit')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="file-preview" id="affidavit_preview"></div>
                                        <div class="existing-attachment" id="existing_affidavit" style="display: none;"></div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="additional_documents" class="form-label">
                                            <span>Additional Documents (Optional)</span>
                                            <span class="urdu-label jameel-noori">اضافی دستاویزات (اختیاری)</span>
                                        </label>
                                        <input type="file" class="form-control @error('additional_documents') is-invalid @enderror" 
                                               id="additional_documents" name="additional_documents[]" accept=".pdf,.jpg,.jpeg,.png" multiple>
                                        <div class="form-text">Max file size: 5MB each</div>
                                        <div class="validation-msg" id="additional_documents_msg"></div>
                                        @error('additional_documents')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        @error('additional_documents.*')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="file-preview" id="additional_documents_preview"></div>
                                        <div class="existing-attachment" id="existing_additional_documents" style="display: none;"></div>
                                    </div>

                                    <div class="button-container">
                                        <button type="button" class="btn btn-primary prev-step">Previous</button>
                                        <button type="submit" class="btn btn-primary" id="submitBtn">Submit</button>
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
            
            // UPDATED AUTO-FILL FUNCTION - NOW HANDLES ATTACHMENTS
            function autoFillForm(data) {
                console.log('🚀 AUTO-FILL STARTED with data:', data);
                
                // Clear any previous validation errors
                $('.validation-message').hide();
                $('.form-control, .form-select').removeClass('field-with-error field-with-success');
                
                // Personal Information - SIMPLE DIRECT ASSIGNMENT
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
                
                // EDUCATION FIELD - SIMPLIFIED
                if (data.education) {
                    let educationValue = data.education;
                    console.log('📚 Education data:', educationValue, 'Type:', typeof educationValue);
                    
                    // Handle different data structures
                    if (typeof educationValue === 'object') {
                        if (educationValue.value) educationValue = educationValue.value;
                        else if (educationValue.education_level) educationValue = educationValue.education_level;
                        else if (educationValue.level) educationValue = educationValue.level;
                        else if (educationValue.name) educationValue = educationValue.name;
                    }
                    
                    $('#education').val(educationValue);
                    console.log('✅ Set education to:', educationValue);
                } else {
                    console.log('❌ No education data found');
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
                
                // CHILDREN DATA - FIXED VERSION - PROPERLY HANDLES MULTIPLE CHILDREN
                if (data.children_count && data.children_count > 0) {
                    console.log('👶 Processing children data. Count:', data.children_count);
                    
                    // Set children count first
                    $('#children_count').val(data.children_count);
                    
                    // Trigger input to generate fields
                    $('#children_count').trigger('input');
                    
                    // Wait for fields to be generated, then fill them
                    setTimeout(() => {
                        console.log('🕒 Filling children fields after generation...');
                        
                        // Get children data from various possible field names
                        let childrenData = [];
                        
                        if (data.children && Array.isArray(data.children)) {
                            childrenData = data.children;
                            console.log('✅ Using children array with', childrenData.length, 'items');
                        } else if (data.children_data && Array.isArray(data.children_data)) {
                            childrenData = data.children_data;
                            console.log('✅ Using children_data array with', childrenData.length, 'items');
                        } else if (data.children_info && Array.isArray(data.children_info)) {
                            childrenData = data.children_info;
                            console.log('✅ Using children_info array with', childrenData.length, 'items');
                        }
                        
                        // Fill each child's data - FIXED: Properly iterate through all children
                        if (childrenData.length > 0) {
                            console.log(`🎯 Found ${childrenData.length} children to populate`);
                            
                            childrenData.forEach((child, index) => {
                                if (index < data.children_count) {
                                    console.log(`👶 Filling child ${index}:`, child);
                                    
                                    // Use direct DOM selection for reliability
                                    const nameField = document.querySelector(`input[name="children[${index}][name]"]`);
                                    const genderField = document.querySelector(`select[name="children[${index}][gender]"]`);
                                    const ageField = document.querySelector(`input[name="children[${index}][age]"]`);
                                    
                                    if (nameField && child.name) {
                                        nameField.value = child.name;
                                        console.log(`✅ Set child ${index} name:`, child.name);
                                    }
                                    
                                    if (genderField && child.gender) {
                                        genderField.value = child.gender;
                                        console.log(`✅ Set child ${index} gender:`, child.gender);
                                    }
                                    
                                    if (ageField && child.age) {
                                        ageField.value = child.age;
                                        console.log(`✅ Set child ${index} age:`, child.age);
                                    }
                                    
                                    // Handle education data for each child if available
                                    if (child.education) {
                                        console.log(`📚 Child ${index} education:`, child.education);
                                        // You can add education fields for children here if needed
                                    }
                                }
                            });
                        } else {
                            console.log('❌ No children data array found');
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
                        
                    }, 500); // Wait 500ms for fields to generate
                } else {
                    console.log('❌ No children count or count is 0');
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

                // NEW: HANDLE EXISTING ATTACHMENTS
                handleExistingAttachments(data);
                
                // Save to localStorage
                saveFormData();
                
                // Show success message
                Toastify({
                    text: "Form auto-filled with existing data including attachments!",
                    duration: 3000,
                    gravity: "top",
                    position: "right",
                    style: {
                        background: "var(--success-color)",
                    },
                }).showToast();
                
                console.log('🎉 AUTO-FILL COMPLETED');
            }

            // NEW FUNCTION: Handle existing attachments display
            function handleExistingAttachments(data) {
                console.log('📎 Processing existing attachments...', data);
                
                const attachmentFields = [
                    'id_card_front', 'id_card_back', 'passport_photos', 
                    'medical_reports', 'referral_form', 'affidavit', 'additional_documents'
                ];
                
                let hasAttachments = false;
                
                attachmentFields.forEach(field => {
                    const existingElement = $(`#existing_${field}`);
                    const fileInput = $(`#${field}`);
                    
                    if (data[field]) {
                        console.log(`📁 Found existing ${field}:`, data[field]);
                        hasAttachments = true;
                        
                        // Make file input optional since we have existing files
                        fileInput.prop('required', false);
                        
                        if (field.includes('passport_photos') || field.includes('medical_reports') || field.includes('additional_documents')) {
                            // Multiple files
                            const fileCount = data[`${field}_count`] || 0;
                            const previews = data[`${field}_previews`] || [];
                            
                            let previewHtml = `<strong>Existing ${field.replace('_', ' ')}:</strong><br>`;
                            previewHtml += `<span class="attachment-info">${fileCount} file(s) found</span><br>`;
                            
                            if (previews.length > 0) {
                                previews.forEach(preview => {
                                    previewHtml += `<div class="mt-1">`;
                                    previewHtml += `<a href="${preview.url}" target="_blank" class="me-2">`;
                                    previewHtml += `<i class="fas fa-file"></i> ${preview.name}`;
                                    previewHtml += `</a>`;
                                    previewHtml += `<small class="text-muted">(Click to view)</small>`;
                                    previewHtml += `</div>`;
                                });
                            }
                            
                            existingElement.html(previewHtml).show();
                        } else {
                            // Single file
                            const preview = data[`${field}_preview`];
                            let previewHtml = `<strong>Existing ${field.replace('_', ' ')}:</strong><br>`;
                            
                            if (preview) {
                                previewHtml += `<a href="${preview.url}" target="_blank" class="me-2">`;
                                previewHtml += `<i class="fas fa-file"></i> ${preview.name}`;
                                previewHtml += `</a>`;
                                previewHtml += `<small class="text-muted">(Click to view)</small>`;
                            } else {
                                previewHtml += `<span class="attachment-info">File exists</span>`;
                            }
                            
                            existingElement.html(previewHtml).show();
                        }
                    } else {
                        existingElement.hide();
                    }
                });
                
                // Show/hide the existing attachments section
                if (hasAttachments) {
                    $('#existingAttachments').show();
                    Toastify({
                        text: "Existing attachments found! You can keep these or upload new files.",
                        duration: 5000,
                        gravity: "top",
                        position: "right",
                        style: {
                            background: "var(--secondary-color)",
                        },
                    }).showToast();
                } else {
                    $('#existingAttachments').hide();
                }
            }

            // Enhanced debugging function
            function debugData(data) {
                console.log('🔍 === DEBUG DATA STRUCTURE ===');
                console.log('Full data object:', data);
                console.log('Education field:', data.education);
                console.log('Type of education:', typeof data.education);
                
                // Check all possible education fields
                console.log('All education-related fields:');
                Object.keys(data).forEach(key => {
                    if (key.toLowerCase().includes('education')) {
                        console.log(`  ${key}:`, data[key]);
                    }
                });
                
                console.log('Children count:', data.children_count);
                console.log('Children data:', data.children);
                console.log('Children data type:', typeof data.children);
                console.log('Is children array?:', Array.isArray(data.children));
                
                if (data.children && Array.isArray(data.children)) {
                    console.log('Children array length:', data.children.length);
                    data.children.forEach((child, index) => {
                        console.log(`Child ${index}:`, child);
                        if (child.education) {
                            console.log(`  Child ${index} education:`, child.education);
                        }
                    });
                }
                
                // Check for alternative children field names
                const childrenFields = Object.keys(data).filter(key => 
                    key.toLowerCase().includes('child') || 
                    key.toLowerCase().includes('children')
                );
                console.log('All children-related fields:', childrenFields);
                
                // Check attachment fields
                const attachmentFields = Object.keys(data).filter(key => 
                    key.includes('id_card') || 
                    key.includes('passport') || 
                    key.includes('medical') || 
                    key.includes('referral') || 
                    key.includes('affidavit') || 
                    key.includes('additional')
                );
                console.log('All attachment-related fields:', attachmentFields);
                
                console.log('=== END DEBUG ===');
            }
            
            // Save form data to localStorage
            function saveFormData() {
                const formData = {};
                $('#medicalRegistrationForm').find('input, select, textarea').each(function() {
                    const fieldName = $(this).attr('name');
                    if (fieldName && !fieldName.includes('_token')) {
                        if ($(this).attr('type') === 'file') {
                            // Skip file inputs
                            return;
                        }
                        if ($(this).attr('type') === 'checkbox' || $(this).attr('type') === 'radio') {
                            formData[fieldName] = $(this).is(':checked');
                        } else {
                            formData[fieldName] = $(this).val();
                        }
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
                            if (field.attr('type') === 'checkbox' || field.attr('type') === 'radio') {
                                field.prop('checked', formData[fieldName]);
                            } else {
                                field.val(formData[fieldName]);
                            }
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
                                    
                                    // DEBUG: Log the data structure
                                    console.log('🔍 CNIC Search Response:', response);
                                    if (response.data) {
                                        debugData(response.data);
                                    }
                                    
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
                                console.error('Response:', xhr.responseText);
                                searchResult.html(`<i class="fas fa-exclamation-triangle"></i> Error searching for CNIC: ${error}`).show();
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
                document.getElementById('admission_date').max = new Date().toISOString().split('T')[0];
                
                // Initialize marital status visibility
                $('#marital_status').trigger('change');
                
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
                
                // Validate required fields
                step.find('input[required], select[required], textarea[required]').each(function() {
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
                
                // Validate file inputs - MODIFIED: Check if files are required or if we have existing attachments
                step.find('input[type="file"][required]').each(function() {
                    const field = $(this);
                    const fieldId = field.attr('id');
                    const msgElement = $(`#${fieldId}_msg`);
                    const existingAttachment = $(`#existing_${fieldId}`);
                    
                    // Only require file if no existing attachment is shown
                    if (!field[0].files || field[0].files.length === 0) {
                        if (existingAttachment.is(':visible')) {
                            // Has existing attachment, so file is optional
                            field.removeClass('is-invalid');
                            msgElement.hide();
                        } else {
                            // No existing attachment and no file uploaded
                            field.addClass('is-invalid');
                            msgElement.text('This file is required').addClass('error').show();
                            isValid = false;
                            if (!firstInvalidField) {
                                firstInvalidField = field;
                            }
                        }
                    } else {
                        field.removeClass('is-invalid');
                        msgElement.hide();
                    }
                });
                
                // Scroll to first invalid field
                if (!isValid && firstInvalidField) {
                    $('html, body').animate({
                        scrollTop: firstInvalidField.offset().top - 100
                    }, 500);
                }
                
                return isValid;
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
                    $('.existing-attachment').hide();
                    $('#existingAttachments').hide();
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
            
            // Generate dynamic children fields - FIXED: Proper field generation
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
                    
                    // Force a re-render to ensure fields are available
                    setTimeout(() => {
                        console.log(`✅ Generated ${count} children fields`);
                    }, 100);
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
                if ($(this).val() === 'Married') {
                    $('#spouse_name_field').show();
                } else {
                    $('#spouse_name_field').hide();
                    $('#spouse_name').val('');
                }
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
            
            // NEW: Clear localStorage on page load to ensure fresh form
            clearFormData();
            
            // Initialize form on load
            initializeForm();
        });
    </script>
</body>
</html>