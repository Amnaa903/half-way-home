<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Admission Details</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        teal: {
                            50: '#f0fdfa',
                            100: '#ccfbf1',
                            500: '#14b8a6',
                            600: '#0d9488',
                            700: '#0f766e',
                            800: '#115e59',
                            900: '#134e4a',
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-teal-50 min-h-screen">
    <div class="container mx-auto px-4 py-6">
        <div class="max-w-6xl mx-auto">
            <!-- Back Button -->
            <div class="mb-6">
                <a href="{{ route('hwhadmissions.index') }}" class="inline-flex items-center text-teal-700 hover:text-teal-800 font-medium">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Back to List
                </a>
            </div>

            <!-- Main Card -->
            <div class="bg-white rounded-xl shadow-sm border border-teal-100 overflow-hidden">
               <!-- Header -->
<div class="bg-linear-to-r from-teal-600 to-teal-700 px-6 py-5">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-white mb-1">{{ $record->patient_name }}</h1>
            <p class="text-teal-100 text-sm">Patient Admission Details</p>
        </div>
        <div class="flex items-center space-x-3">
            <div class="bg-teal-500 text-white px-3 py-1 rounded-full text-sm font-medium">
                ID: {{ $record->id }}
            </div>
            <a href="{{ route('hwhadmissions.edit', $record->id) }}" 
               class="inline-flex items-center px-4 py-2 bg-white text-teal-700 rounded-lg font-medium hover:bg-teal-50 transition duration-200 text-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                Edit Record
            </a>
        </div>
    </div>
</div>

                <!-- Content -->
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Personal Information -->
                        <div class="space-y-4">
                            <div class="bg-teal-50 rounded-lg p-4 border border-teal-100">
                                <h2 class="text-lg font-semibold text-teal-800 mb-3 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                    Personal Information
                                </h2>
                                
                                <div class="space-y-3">
                                    <div class="flex justify-between border-b border-teal-100 pb-2">
                                        <span class="text-sm font-medium text-teal-700">Patient Name</span>
                                        <span class="text-sm text-teal-900">{{ $record->patient_name }}</span>
                                    </div>
                                    <div class="flex justify-between border-b border-teal-100 pb-2">
                                        <span class="text-sm font-medium text-teal-700">Father Name</span>
                                        <span class="text-sm text-teal-900">{{ $record->father_name }}</span>
                                    </div>
                                    <div class="flex justify-between border-b border-teal-100 pb-2">
                                        <span class="text-sm font-medium text-teal-700">Age</span>
                                        <span class="text-sm text-teal-900">{{ $record->age ?? 'N/A' }}</span>
                                    </div>
                                    <div class="flex justify-between border-b border-teal-100 pb-2">
                                        <span class="text-sm font-medium text-teal-700">Gender</span>
                                        <span class="text-sm text-teal-900">{{ $record->gender ?? 'N/A' }}</span>
                                    </div>
                                    <div class="flex justify-between border-b border-teal-100 pb-2">
                                        <span class="text-sm font-medium text-teal-700">CNIC</span>
                                        <span class="text-sm text-teal-900 font-mono">{{ $record->cnic }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-sm font-medium text-teal-700">Phone</span>
                                        <span class="text-sm text-teal-900">{{ $record->phone }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Address & Education -->
                        <div class="space-y-4">
                            <div class="bg-teal-50 rounded-lg p-4 border border-teal-100">
                                <h2 class="text-lg font-semibold text-teal-800 mb-3 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                    </svg>
                                    Address & Education
                                </h2>
                                
                                <div class="space-y-3">
                                    <div class="flex justify-between border-b border-teal-100 pb-2">
                                        <span class="text-sm font-medium text-teal-700">Education</span>
                                        <span class="text-sm text-teal-900">{{ $record->education ?? 'N/A' }}</span>
                                    </div>
                                    <div class="flex justify-between border-b border-teal-100 pb-2">
                                        <span class="text-sm font-medium text-teal-700">Address</span>
                                        <span class="text-sm text-teal-900">{{ $record->address ?? 'N/A' }}</span>
                                    </div>
                                    <div class="flex justify-between border-b border-teal-100 pb-2">
                                        <span class="text-sm font-medium text-teal-700">Marital Status</span>
                                        <span class="text-sm text-teal-900">{{ $record->marital_status ?? 'N/A' }}</span>
                                    </div>
                                    <div class="flex justify-between border-b border-teal-100 pb-2">
                                        <span class="text-sm font-medium text-teal-700">Religion</span>
                                        <span class="text-sm text-teal-900">{{ $record->religion ?? 'N/A' }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-sm font-medium text-teal-700">Admission Date</span>
                                        <span class="text-sm text-teal-900">
                                            @if($record->admission_date)
                                                {{ \Carbon\Carbon::parse($record->admission_date)->format('Y-m-d') }}
                                            @else
                                                N/A
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Family Information -->
                        <div class="space-y-4">
                            <div class="bg-teal-50 rounded-lg p-4 border border-teal-100">
                                <h2 class="text-lg font-semibold text-teal-800 mb-3 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                    </svg>
                                    Family Information
                                </h2>
                                
                                <div class="space-y-3">
                                    <div class="flex justify-between border-b border-teal-100 pb-2">
                                        <span class="text-sm font-medium text-teal-700">Spouse Name</span>
                                        <span class="text-sm text-teal-900">{{ $record->spouse_name ?: 'Not specified' }}</span>
                                    </div>
                                    <div class="flex justify-between border-b border-teal-100 pb-2">
                                        <span class="text-sm font-medium text-teal-700">Children Count</span>
                                        <span class="text-sm text-teal-900">{{ $record->children_count ?: '0' }}</span>
                                    </div>
                                    <div class="flex justify-between border-b border-teal-100 pb-2">
                                        <span class="text-sm font-medium text-teal-700">Boys Count</span>
                                        <span class="text-sm text-teal-900">{{ $record->boys_count ?: '0' }}</span>
                                    </div>
                                    <div class="flex justify-between border-b border-teal-100 pb-2">
                                        <span class="text-sm font-medium text-teal-700">Girls Count</span>
                                        <span class="text-sm text-teal-900">{{ $record->girls_count ?: '0' }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-sm font-medium text-teal-700">Children Names</span>
                                        <span class="text-sm text-teal-900">
                                            @if(!empty($record->children_names))
                                                {{ $record->children_names }}
                                            @elseif($record->children_count > 0)
                                                Names not specified
                                            @else
                                                No children
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Guardian Information -->
                        <div class="space-y-4">
                            <div class="bg-teal-50 rounded-lg p-4 border border-teal-100">
                                <h2 class="text-lg font-semibold text-teal-800 mb-3 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                    Guardian Information
                                </h2>
                                
                                <div class="space-y-3">
                                    <div class="flex justify-between border-b border-teal-100 pb-2">
                                        <span class="text-sm font-medium text-teal-700">Guardian Name</span>
                                        <span class="text-sm text-teal-900">{{ $record->guardian_name ?? 'N/A' }}</span>
                                    </div>
                                    <div class="flex justify-between border-b border-teal-100 pb-2">
                                        <span class="text-sm font-medium text-teal-700">Guardian Contact</span>
                                        <span class="text-sm text-teal-900">{{ $record->guardian_contact ?? 'N/A' }}</span>
                                    </div>
                                    <div class="flex justify-between border-b border-teal-100 pb-2">
                                        <span class="text-sm font-medium text-teal-700">Relationship</span>
                                        <span class="text-sm text-teal-900">{{ $record->relationship ?? 'N/A' }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-sm font-medium text-teal-700">Guardian Address</span>
                                        <span class="text-sm text-teal-900">{{ $record->guardian_address ?? 'N/A' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Medical Information -->
                        <div class="md:col-span-2 space-y-4">
                            <div class="bg-teal-50 rounded-lg p-4 border border-teal-100">
                                <h2 class="text-lg font-semibold text-teal-800 mb-3 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                                    </svg>
                                    Medical Information
                                </h2>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="space-y-3">
                                        <div class="flex justify-between border-b border-teal-100 pb-2">
                                            <span class="text-sm font-medium text-teal-700">Reason for Admission</span>
                                            <span class="text-sm text-teal-900 text-right">{{ $record->reason ?? 'N/A' }}</span>
                                        </div>
                                        <div class="flex justify-between border-b border-teal-100 pb-2">
                                            <span class="text-sm font-medium text-teal-700">Disease Name</span>
                                            <span class="text-sm text-teal-900 text-right">{{ $record->disease_name ?? 'N/A' }}</span>
                                        </div>
                                    </div>
                                    <div class="space-y-3">
                                        <div class="flex justify-between border-b border-teal-100 pb-2">
                                            <span class="text-sm font-medium text-teal-700">Treatment Details</span>
                                            <span class="text-sm text-teal-900 text-right">{{ $record->treatment_details ?? 'N/A' }}</span>
                                        </div>
                                        <div class="flex justify-between border-b border-teal-100 pb-2">
                                            <span class="text-sm font-medium text-teal-700">Case History</span>
                                            <span class="text-sm text-teal-900 text-right">{{ $record->case_history ?? 'N/A' }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3 pt-3 border-t border-teal-100">
                                    <div class="flex justify-between">
                                        <span class="text-sm font-medium text-teal-700">Other Diseases</span>
                                        <span class="text-sm text-teal-900 text-right">{{ $record->other_diseases ?? 'N/A' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <!-- Documents -->
<div class="md:col-span-2 space-y-4">
    <div class="bg-teal-50 rounded-lg p-4 border border-teal-100">
        <h2 class="text-lg font-semibold text-teal-800 mb-3 flex items-center">
            <svg class="w-5 h-5 mr-2 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            Attached Documents
        </h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
            @php
                $documents = [
                    'id_card_front' => ['label' => 'ID Card Front', 'icon' => '🆔'],
                    'id_card_back' => ['label' => 'ID Card Back', 'icon' => '🆔'],
                    'passport_photos' => ['label' => 'Passport Photos', 'icon' => '📷'],
                    'medical_reports' => ['label' => 'Medical Reports', 'icon' => '🏥'],
                    'referral_form' => ['label' => 'Referral Form', 'icon' => '📋'],
                    'affidavit' => ['label' => 'Affidavit', 'icon' => '📄'],
                    'additional_documents' => ['label' => 'Additional Docs', 'icon' => '📎']
                ];
            @endphp
            @foreach($documents as $field => $doc)
                @php
                    // Check if field has data (handles string, array, and JSON string)
                    $hasFiles = false;
                    $fileCount = 0;
                    
                    if ($record->$field) {
                        if (is_array($record->$field)) {
                            $hasFiles = !empty($record->$field);
                            $fileCount = count($record->$field);
                        } elseif (is_string($record->$field) && str_starts_with($record->$field, '[')) {
                            // Handle JSON string
                            $files = json_decode($record->$field, true);
                            $hasFiles = !empty($files);
                            $fileCount = is_array($files) ? count($files) : 0;
                        } else {
                            $hasFiles = true;
                            $fileCount = 1;
                        }
                    }
                @endphp
                
                @if($hasFiles)
                <a href="{{ route('hwhadmissions.attachment.show', ['id' => $record->id, 'field' => $field]) }}" 
                   target="_blank"
                   class="bg-white rounded-lg p-3 border border-teal-200 text-center group hover:border-teal-400 hover:shadow-md transition duration-200 block">
                    <div class="bg-teal-100 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-2 group-hover:bg-teal-200 transition duration-200">
                        <span class="text-lg">{{ $doc['icon'] }}</span>
                    </div>
                    <span class="text-xs font-medium text-teal-700 block mb-1">{{ $doc['label'] }}</span>
                    <span class="text-xs text-teal-500">
                        @if($fileCount > 1)
                            {{ $fileCount }} files
                        @else
                            Click to view
                        @endif
                    </span>
                </a>
                @else
                <div class="bg-gray-100 rounded-lg p-3 border border-gray-200 text-center opacity-60">
                    <div class="bg-gray-200 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-2">
                        <span class="text-lg text-gray-400">{{ $doc['icon'] }}</span>
                    </div>
                    <span class="text-xs font-medium text-gray-500 block mb-1">{{ $doc['label'] }}</span>
                    <span class="text-xs text-gray-400">Not uploaded</span>
                </div>
                @endif
            @endforeach
        </div>
    </div>
</div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>