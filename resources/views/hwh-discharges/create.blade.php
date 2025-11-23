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

        .form-control.is-valid {
            border-color: var(--success-color);
        }

        .form-control.is-invalid {
            border-color: var(--error-color);
        }

        .urdu-text {
            font-family: 'Noto Nastaliq Urdu', serif !important;
            direction: rtl;
            unicode-bidi: bidi-override;
            text-align: right;
        }
        
        .jameel-noori {
            font-family: 'Noto Nastaliq Urdu', serif;
            font-weight: 500;
            line-height: 1.6;
        }
        
        .urdu-label, .urdu-title, .urdu-text {
            font-family: 'Noto Nastaliq Urdu', serif !important;
            font-weight: 500;
            direction: rtl;
            unicode-bidi: bidi-override;
            text-align: right;
            line-height: 1.6;
        }
        
        .urdu-content {
            font-family: 'Noto Nastaliq Urdu', serif;
            font-size: 1.1rem;
            direction: rtl;
            unicode-bidi: bidi-override;
            text-align: right;
            line-height: 1.8;
        }
        
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

        .auto-fill-notification {
            background: #d1ecf1;
            border: 1px solid #bee5eb;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
            animation: fadeIn 0.5s ease-in;
        }

        .debug-info {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            padding: 10px;
            margin: 10px 0;
            font-size: 0.8rem;
            display: none;
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
                            <!-- Auto-fill Notification -->
                            <div class="auto-fill-notification" id="autoFillNotification" style="display: none;">
                                <h6><i class="fas fa-info-circle"></i> Form Auto-filled</h6>
                                <p class="mb-0">This form has been automatically filled with data from the pending registration. Please review and complete the remaining fields.</p>
                            </div>

                            <!-- Debug Info -->
                            <div class="debug-info" id="debugInfo">
                                <strong>Debug Information:</strong>
                                <div id="debugContent"></div>
                            </div>

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

                            @if(session('error'))
                            <div class="alert alert-danger">
                                <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                            </div>
                            @endif

                            @if($errors->any())
                            <div class="alert alert-danger">
                                <h6 class="alert-heading">Please fix the following errors:</h6>
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif

                            <form class="registration-form" id="medicalRegistrationForm" action="{{ route('hwhadmissions.store') }}" method="POST" enctype="multipart/form-data" novalidate>
                                @csrf
                                
                                <!-- Hidden field for incharge_id -->
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
                                            <input type="text" class="form-control @error('patient_name') is-invalid @enderror" 
                                                   id="patient_name" name="patient_name" 
                                                   value="{{ old('patient_name', $prefillData['patient_name'] ?? '') }}" required>
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
                                            <input type="text" class="form-control @error('father_name') is-invalid @enderror" 
                                                   id="father_name" name="father_name" 
                                                   value="{{ old('father_name', $prefillData['father_name'] ?? '') }}" required>
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
                                            <input type="number" class="form-control @error('age') is-invalid @enderror" 
                                                   id="age" name="age" 
                                                   value="{{ old('age') }}" min="1" max="120" required>
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
                                            <select class="form-select @error('gender') is-invalid @enderror" name="gender" required>
                                                <option value="">Select</option>
                                                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                                                <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
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
                                            <input type="text" class="form-control @error('cnic') is-invalid @enderror" 
                                                   id="cnic" name="cnic" 
                                                   value="{{ old('cnic', $prefillData['cnic'] ?? '') }}" 
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
                                            <input type="tel" class="form-control @error('phone') is-invalid @enderror" 
                                                   id="phone" name="phone" 
                                                   value="{{ old('phone', $prefillData['phone'] ?? '') }}" required>
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
                                            <select class="form-select @error('education') is-invalid @enderror" 
                                                   id="education" name="education">
                                                <option value="">Select Education Level</option>
                                                <option value="No Formal Education" {{ old('education') == 'No Formal Education' ? 'selected' : '' }}>No Formal Education</option>
                                                <option value="Primary (1-5)" {{ old('education') == 'Primary (1-5)' ? 'selected' : '' }}>Primary (1-5)</option>
                                                <option value="Middle (6-8)" {{ old('education') == 'Middle (6-8)' ? 'selected' : '' }}>Middle (6-8)</option>
                                                <option value="Matric (9-10)" {{ old('education') == 'Matric (9-10)' ? 'selected' : '' }}>Matric (9-10)</option>
                                                <option value="Intermediate (11-12)" {{ old('education') == 'Intermediate (11-12)' ? 'selected' : '' }}>Intermediate (11-12)</option>
                                                <option value="Bachelor's Degree" {{ old('education') == 'Bachelor\'s Degree' ? 'selected' : '' }}>Bachelor's Degree</option>
                                                <option value="Master's Degree" {{ old('education') == 'Master\'s Degree' ? 'selected' : '' }}>Master's Degree</option>
                                                <option value="Doctorate" {{ old('education') == 'Doctorate' ? 'selected' : '' }}>Doctorate</option>
                                                <option value="Other" {{ old('education') == 'Other' ? 'selected' : '' }}>Other</option>
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
                                        <textarea class="form-control @error('address') is-invalid @enderror" 
                                                  id="address" name="address" rows="3" required>{{ old('address', $prefillData['address'] ?? '') }}</textarea>
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
                                            <select class="form-select @error('marital_status') is-invalid @enderror" 
                                                    id="marital_status" name="marital_status" required>
                                                <option value="">Select Marital Status</option>
                                                <option value="Single" {{ old('marital_status') == 'Single' ? 'selected' : '' }}>Single</option>
                                                <option value="Married" {{ old('marital_status') == 'Married' ? 'selected' : '' }}>Married</option>
                                                <option value="Widowed" {{ old('marital_status') == 'Widowed' ? 'selected' : '' }}>Widowed</option>
                                                <option value="Divorced" {{ old('marital_status') == 'Divorced' ? 'selected' : '' }}>Divorced</option>
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
                                            <input type="text" class="form-control @error('spouse_name') is-invalid @enderror" 
                                                   id="spouse_name" name="spouse_name" 
                                                   value="{{ old('spouse_name') }}"
                                                   placeholder="Enter spouse name">
                                            <div class="validation-msg" id="spouse_name_msg"></div>
                                            @error('spouse_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="religion" class="form-label">
                                            <span>Religion</span>
                                            <span class="urdu-label jameel-noori">مذہب</span>
                                        </label>
                                        <input type="text" class="form-control @error('religion') is-invalid @enderror" 
                                               id="religion" name="religion" 
                                               value="{{ old('religion') }}">
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
                                            <input type="text" class="form-control @error('guardian_name') is-invalid @enderror" 
                                                   id="guardian_name" name="guardian_name" 
                                                   value="{{ old('guardian_name', $prefillData['guardian_name'] ?? '') }}" required>
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
                                            <input type="tel" class="form-control @error('guardian_contact') is-invalid @enderror" 
                                                   id="guardian_contact" name="guardian_contact" 
                                                   value="{{ old('guardian_contact', $prefillData['guardian_contact'] ?? '') }}" required>
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
                                            <input type="text" class="form-control @error('relationship') is-invalid @enderror" 
                                               id="relationship" name="relationship" 
                                               value="{{ old('relationship') }}" required>
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
                                            <input type="text" class="form-control @error('guardian_address') is-invalid @enderror" 
                                                   id="guardian_address" name="guardian_address" 
                                                   value="{{ old('guardian_address') }}" required>
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
                                            <input type="date" class="form-control @error('admission_date') is-invalid @enderror" 
                                                   id="admission_date" name="admission_date" 
                                                   value="{{ old('admission_date') }}" required>
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
                                            <input type="text" class="form-control @error('reason') is-invalid @enderror" 
                                                   id="reason" name="reason" 
                                                   value="{{ old('reason') }}">
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
                                        <input type="text" class="form-control @error('disease_name') is-invalid @enderror" 
                                               id="disease_name" name="disease_name" 
                                               value="{{ old('disease_name') }}" required>
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
                                        <textarea class="form-control @error('treatment_details') is-invalid @enderror" 
                                                  id="treatment_details" name="treatment_details" rows="4" required>{{ old('treatment_details') }}</textarea>
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
                                        <textarea class="form-control @error('case_history') is-invalid @enderror" 
                                                  id="case_history" name="case_history" rows="4" required>{{ old('case_history') }}</textarea>
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
                                        <textarea class="form-control @error('other_diseases') is-invalid @enderror" 
                                                  id="other_diseases" name="other_diseases" rows="3">{{ old('other_diseases') }}</textarea>
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

                                    <div class="alert alert-info">
                                        <i class="fas fa-info-circle"></i> 
                                        <strong>Note:</strong> All file attachments are optional for testing. You can submit the form without uploading any files.
                                    </div>

                                    <div class="mb-3">
                                        <label for="id_card_front" class="form-label">
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
                                    </div>

                                    <div class="mb-3">
                                        <label for="id_card_back" class="form-label">
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
                                    </div>

                                    <div class="mb-3">
                                        <label for="passport_photos" class="form-label">
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
                                    </div>

                                    <div class="mb-3">
                                        <label for="medical_reports" class="form-label">
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
                                    </div>

                                    <div class="mb-3">
                                        <label for="referral_form" class="form-label">
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
                                    </div>

                                    <div class="button-container">
                                        <button type="button" class="btn btn-primary prev-step">Previous</button>
                                        <button type="submit" class="btn btn-primary" id="submitBtn">Submit Admission</button>
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
            // Debug mode
            const DEBUG_MODE = true;

            // Auto-fill form with prefill data
            function autoFillForm() {
                @if(isset($prefillData) && !empty($prefillData))
                console.log('Auto-filling form with prefill data:', @json($prefillData));
                
                // Fill form fields with prefill data
                @foreach($prefillData as $key => $value)
                    @if($key !== 'incharge_id' && $value)
                    $('#{{ $key }}').val('{{ $value }}');
                    @endif
                @endforeach
                
                // Show auto-fill notification
                $('#autoFillNotification').show();
                
                Toastify({
                    text: "Form auto-filled with registration data!",
                    duration: 3000,
                    gravity: "top",
                    position: "right",
                    style: {
                        background: "var(--success-color)",
                    },
                }).showToast();
                @endif
            }

            // Call auto-fill on page load
            autoFillForm();

            // Initialize form state
            function initializeForm() {
                $('.step-progress').removeClass('active-1 active-2 active-3').addClass('active-1');
                $('.step').removeClass('active completed');
                $('.step:eq(0)').addClass('active');
                
                // Set max date for admission date to today
                const today = new Date().toISOString().split('T')[0];
                $('#admission_date').attr('max', today);
                
                // Initialize marital status visibility
                updateMaritalStatus();
                
                if (DEBUG_MODE) {
                    $('#debugInfo').show();
                    logDebug('Form initialized successfully');
                }
            }

            // Update marital status fields visibility
            function updateMaritalStatus() {
                const maritalStatus = $('#marital_status').val();
                if (maritalStatus === 'Married') {
                    $('#spouse_name_field').show();
                } else {
                    $('#spouse_name_field').hide();
                    $('#spouse_name').val('');
                }
            }

            // Step navigation
            $('.next-step').click(function() {
                let currentStep = $('.form-step.active');
                let nextStep = currentStep.next('.form-step');
                if (validateStep(currentStep)) {
                    currentStep.removeClass('active');
                    nextStep.addClass('active');
                    updateProgress();
                    logDebug('Moved to next step');
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
                logDebug('Moved to previous step');
            });

            // Update progress bar
            function updateProgress() {
                let currentIndex = $('.form-step.active').index() + 1;
                $('.step-progress').removeClass('active-1 active-2 active-3').addClass('active-' + currentIndex);
                $('.step').removeClass('active completed');
                $('.step:lt(' + currentIndex + ')').addClass('completed');
                $('.step:eq(' + (currentIndex - 1) + ')').addClass('active');
            }

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
                
                // Validate CNIC format
                if (step.find('#cnic').length) {
                    const cnicField = $('#cnic');
                    const cnicMsg = $('#cnic_msg');
                    const cnicValue = cnicField.val().trim();
                    
                    // Basic CNIC validation (5-7-1 format)
                    const cnicRegex = /^\d{5}-\d{7}-\d{1}$/;
                    if (cnicValue && !cnicRegex.test(cnicValue)) {
                        cnicField.addClass('is-invalid');
                        cnicMsg.text('Please enter a valid CNIC (format: 12345-1234567-1)').addClass('error').show();
                        isValid = false;
                        if (!firstInvalidField) {
                            firstInvalidField = cnicField;
                        }
                    }
                }
                
                // Scroll to first invalid field
                if (!isValid && firstInvalidField) {
                    $('html, body').animate({
                        scrollTop: firstInvalidField.offset().top - 100
                    }, 500);
                }
                
                return isValid;
            }

            // Show/hide spouse field based on marital status
            $('#marital_status').on('change', function() {
                updateMaritalStatus();
            });

            // CNIC formatting
            $('#cnic').on('input', function(e) {
                let value = e.target.value.replace(/\D/g, '');
                
                if (value.length > 5) {
                    value = value.substring(0, 5) + '-' + value.substring(5);
                }
                if (value.length > 13) {
                    value = value.substring(0, 13) + '-' + value.substring(13, 14);
                }
                
                e.target.value = value;
            });

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
                    showToast("Form has been reset successfully.", "success");
                    logDebug('Form reset');
                }
            });

            // Form submission
            $('#medicalRegistrationForm').on('submit', function(e) {
                console.log('Form submission started...');
                logDebug('Form submission initiated');
                
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
                        return false;
                    }
                });
                
                if (!allStepsValid) {
                    e.preventDefault();
                    showToast("Please fix all validation errors before submitting.", "error");
                    logDebug('Form validation failed');
                    return;
                }
                
                // Show loading overlay
                $('#loadingOverlay').show();
                $('#submitBtn').prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Submitting...');
                
                logDebug('Form submitted successfully');
                // Let the form submit naturally
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

            // Debug logging
            function logDebug(message) {
                if (DEBUG_MODE) {
                    const timestamp = new Date().toLocaleTimeString();
                    $('#debugContent').prepend(`<div>[${timestamp}] ${message}</div>`);
                    console.log(`[DEBUG] ${message}`);
                }
            }

            // Initialize form on load
            initializeForm();

            // Log form data for debugging
            $('#medicalRegistrationForm').on('input', 'input, select, textarea', function() {
                if (DEBUG_MODE) {
                    const fieldName = $(this).attr('name');
                    const fieldValue = $(this).val();
                    logDebug(`Field changed: ${fieldName} = ${fieldValue}`);
                }
            });
        });
    </script>
</body>
</html>