<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Discharge Patients - HWH</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
        }
        
        /* Teal color palette */
        .teal-primary { background-color: #0d9488; }
        .teal-light { background-color: #f0fdfa; }
        .teal-dark { background-color: #0f766e; }
        .teal-border { border-color: #99f6e4; }
        .teal-text { color: #0d9488; }
        .teal-focus:focus { 
            border-color: #0d9488; 
            box-shadow: 0 0 0 3px rgba(13, 148, 136, 0.1);
        }
        .teal-hover:hover { background-color: #0f766e; }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
    <div class="container mx-auto px-4 py-6">
        <!-- Header -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-6 transition-all duration-300 hover:shadow-md">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                <div class="mb-4 lg:mb-0">
                    <div class="flex items-center">
                        <div class="teal-primary p-2 rounded-lg mr-4">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold text-gray-800 mb-2">Discharge Patients</h1>
                            <p class="text-gray-600">Select a patient to discharge from HWH</p>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-3">
                    <a href="{{ route('hwhadmissions.index') }}" 
                       class="px-4 py-2.5 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition duration-200 font-medium text-center">
                        Back to Admissions
                    </a>
                    <a href="{{ route('hwhadmissions.discharges.discharged-list') }}" 
                       class="px-4 py-2.5 teal-primary text-white rounded-lg hover:teal-dark transition duration-200 font-medium text-center shadow-sm hover:shadow-md">
                        View Discharged Patients
                    </a>
                </div>
            </div>
        </div>

        <!-- Active Patients List -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden transition-all duration-300 hover:shadow-md">
            <div class="px-6 py-5 border-b border-gray-200 teal-light">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <div class="mb-3 sm:mb-0">
                        <h2 class="text-lg font-semibold text-gray-800 flex items-center">
                            <svg class="w-5 h-5 teal-text mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                            </svg>
                            Active Patients
                        </h2>
                        <p class="text-sm text-gray-600 mt-1">Total: {{ $activeAdmissions->total() }} patients</p>
                    </div>
                    <div class="flex items-center text-sm teal-text bg-white px-3 py-1.5 rounded-lg border border-teal-200">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Click discharge to complete patient discharge process
                    </div>
                </div>
            </div>

            @if($activeAdmissions->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="teal-light">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-medium teal-text uppercase tracking-wider">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        Patient Info
                                    </div>
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-medium teal-text uppercase tracking-wider">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                        </svg>
                                        Contact
                                    </div>
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-medium teal-text uppercase tracking-wider">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        Admission Date
                                    </div>
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-medium teal-text uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($activeAdmissions as $admission)
                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="shrink-0 h-10 w-10 bg-teal-100 rounded-lg flex items-center justify-center mr-4">
                                                <svg class="w-5 h-5 teal-text" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                </svg>
                                            </div>
                                            <div>
                                                <div class="text-sm font-medium text-gray-900">{{ $admission->patient_name }}</div>
                                                <div class="text-sm text-gray-500">Father: {{ $admission->father_name }}</div>
                                                <div class="text-sm text-gray-500">CNIC: {{ $admission->cnic }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $admission->phone }}</div>
                                        <div class="text-sm text-gray-500">{{ $admission->guardian_contact }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ \Carbon\Carbon::parse($admission->admission_date)->format('M d, Y') }}
                                        </div>
                                        <div class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded-full inline-block mt-1">
                                            {{ \Carbon\Carbon::parse($admission->admission_date)->diffForHumans() }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="{{ route('hwhadmissions.discharges.create', $admission->id) }}" 
                                           class="inline-flex items-center px-4 py-2.5 teal-primary text-white rounded-lg hover:teal-dark transition duration-200 font-medium shadow-sm hover:shadow-md">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                            Discharge
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="px-6 py-4 border-t border-gray-200 teal-light">
                    {{ $activeAdmissions->links() }}
                </div>
            @else
                <div class="text-center py-12">
                    <div class="teal-light w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 teal-text" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">No active patients found</h3>
                    <p class="text-gray-600 mb-4">All patients have been discharged or no admissions yet.</p>
                    <a href="{{ route('hwhadmissions.index') }}" 
                       class="inline-flex items-center px-4 py-2 teal-primary text-white rounded-lg hover:teal-dark transition duration-200 font-medium">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Back to Admissions
                    </a>
                </div>
            @endif
        </div>
    </div>
</body>
</html>