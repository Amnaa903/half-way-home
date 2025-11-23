<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Discharged Patients - HWH</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
        .teal-primary { background-color: #0d9488; }
        .teal-light { background-color: #f0fdfa; }
        .teal-dark { background-color: #0f766e; }
        .teal-text { color: #0d9488; }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-6 py-6">
        <!-- Header -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6 mb-6">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                <div class="mb-4 lg:mb-0">
                    <div class="flex items-center">
                        <div class="teal-primary p-2 rounded-lg mr-4">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold text-gray-800 mb-2">Discharged Patients</h1>
                            <p class="text-gray-600">List of all discharged patients from HWH</p>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-3">
                    <a href="{{ route('hwhadmissions.discharges.index') }}" 
                       class="px-4 py-2.5 teal-primary text-white rounded-lg hover:teal-dark transition duration-200 font-medium text-center flex items-center justify-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Active Patients
                    </a>
                    <a href="{{ route('hwhadmissions.index') }}" 
                       class="px-4 py-2.5 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition duration-200 font-medium text-center flex items-center justify-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        All Admissions
                    </a>
                </div>
            </div>
        </div>

        <!-- Patients List -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 teal-light">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <div class="mb-3 sm:mb-0">
                        <h2 class="text-lg font-semibold text-gray-800 flex items-center">
                            <svg class="w-5 h-5 teal-text mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Discharged Patients History
                        </h2>
                        <p class="text-sm text-gray-600 mt-1">Total: {{ $dischargedAdmissions->total() }} patients</p>
                    </div>
                    <div class="flex items-center text-sm teal-text bg-white px-3 py-2 rounded-lg border border-teal-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                        Sorted by discharge date
                    </div>
                </div>
            </div>

            @if($dischargedAdmissions->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="teal-light">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium teal-text uppercase tracking-wider">
                                    Patient Info
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium teal-text uppercase tracking-wider">
                                    Admission Date
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium teal-text uppercase tracking-wider">
                                    Discharge Date
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium teal-text uppercase tracking-wider">
                                    Discharge Reason
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium teal-text uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($dischargedAdmissions as $admission)
                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="shrink-0 h-10 w-10 bg-teal-100 rounded-lg flex items-center justify-center mr-4">
                                                <svg class="w-5 h-5 teal-text" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
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
                                        <div class="text-sm text-gray-900">
                                            {{ \Carbon\Carbon::parse($admission->admission_date)->format('M d, Y') }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ \Carbon\Carbon::parse($admission->discharge_date)->format('M d, Y') }}
                                        </div>
                                        <div class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded-full inline-block mt-1">
                                            {{ \Carbon\Carbon::parse($admission->discharge_date)->diffForHumans() }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900 max-w-xs">
                                            <div class="flex items-start">
                                                <svg class="w-4 h-4 text-gray-400 mr-2 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                                                </svg>
                                                <span>{{ Str::limit($admission->discharge_reason, 100) }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('hwhadmissions.show', $admission->id) }}" 
                                               class="inline-flex items-center px-3 py-2 bg-blue-50 text-blue-700 rounded-lg hover:bg-blue-100 transition duration-200 text-sm font-medium">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                                View
                                            </a>
                                            <form action="{{ route('hwhadmissions.discharges.reverse', $admission->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" 
                                                        class="inline-flex items-center px-3 py-2 bg-green-50 text-green-700 rounded-lg hover:bg-green-100 transition duration-200 text-sm font-medium"
                                                        onclick="return confirm('Are you sure you want to reverse this discharge? Patient will be active again.')">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                                    </svg>
                                                    Reverse
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="px-6 py-4 border-t border-gray-200 teal-light">
                    {{ $dischargedAdmissions->links() }}
                </div>
            @else
                <div class="text-center py-12">
                    <div class="teal-light w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 teal-text" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">No discharged patients found</h3>
                    <p class="text-gray-600 mb-4">No patients have been discharged yet.</p>
                    <a href="{{ route('hwhadmissions.discharges.index') }}" 
                       class="inline-flex items-center px-4 py-2 teal-primary text-white rounded-lg hover:teal-dark transition duration-200 font-medium">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Back to Active Patients
                    </a>
                </div>
            @endif
        </div>
    </div>
</body>
</html>