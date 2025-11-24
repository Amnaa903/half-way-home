<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Discharge Patient - HWH</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
        }
        
        /* Custom color palette */
        .dark-primary { background-color: #3D7C77; }
        .light-primary { background-color: #C7EAE7; }
        .medium-primary { background-color: #9ED8D2; }
        
        .dark-text { color: #3D7C77; }
        .light-text { color: #C7EAE7; }
        .medium-text { color: #9ED8D2; }
        
        .dark-border { border-color: #3D7C77; }
        .light-border { border-color: #C7EAE7; }
        .medium-border { border-color: #9ED8D2; }
        
        .dark-focus:focus { 
            border-color: #3D7C77; 
            box-shadow: 0 0 0 3px rgba(61, 124, 119, 0.1);
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
    <div class="container mx-auto px-4 py-6">
        <div class="max-w-2xl mx-auto">
            <!-- Back Button -->
            <div class="mb-6">
                <a href="{{ isset($pendingDischarge) ? route('incharge.discharge.pending') : route('hwhadmissions.discharges.index') }}" 
                   class="inline-flex items-center dark-text hover:text-green-800 font-medium transition-colors duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    {{ isset($pendingDischarge) ? 'Back to Pending Discharges' : 'Back to Active Admissions' }}
                </a>
            </div>

            <!-- Discharge Form Card -->
            <div class="bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden transition-all duration-300 hover:shadow-lg">
                <!-- Header -->
                <div class="dark-primary px-6 py-5">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-white mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div>
                            <h1 class="text-xl font-bold text-white">Process Discharge</h1>
                            @if(isset($pendingDischarge))
                                <p class="text-green-100 text-sm mt-1">Completing discharge for {{ $pendingDischarge->resident_name }}</p>
                            @else
                                <p class="text-green-100 text-sm mt-1">Completing discharge for {{ $admission->name ?? 'Unknown Patient' }}</p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Patient Info Section -->
                <div class="light-primary px-6 py-4 border-b light-border">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                        <!-- Patient Name -->
                        <div class="flex items-center">
                            <svg class="w-4 h-4 dark-text mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <div>
                                <span class="font-medium text-gray-700">Patient:</span>
                                <span class="text-gray-900 ml-1">
                                    {{ $pendingDischarge->resident_name ?? $admission->name ?? 'N/A' }}
                                </span>
                            </div>
                        </div>

                        <!-- CNIC -->
                        <div class="flex items-center">
                            <svg class="w-4 h-4 dark-text mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <div>
                                <span class="font-medium text-gray-700">CNIC:</span>
                                <span class="text-gray-900 ml-1">
                                    {{ $pendingDischarge->cnic ?? $admission->cnic ?? 'N/A' }}
                                </span>
                            </div>
                        </div>

                        <!-- Admission Date -->
                        <div class="flex items-center">
                            <svg class="w-4 h-4 dark-text mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <div>
                                <span class="font-medium text-gray-700">Admission Date:</span>
                                <span class="text-gray-900 ml-1">
                                    {{ \Carbon\Carbon::parse($admission->admission_date ?? now())->format('M d, Y') }}
                                </span>
                            </div>
                        </div>

                        <!-- Pending Discharge Date (if exists) -->
                        @if(isset($pendingDischarge))
                        <div class="flex items-center">
                            <svg class="w-4 h-4 dark-text mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <div>
                                <span class="font-medium text-gray-700">Pending Discharge Date:</span>
                                <span class="text-gray-900 ml-1">
                                    {{ \Carbon\Carbon::parse($pendingDischarge->discharge_date)->format('M d, Y') }}
                                </span>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Discharge Form -->
                <form action="{{ route('hwhadmissions.discharges.store') }}" method="POST" class="p-6">
                    @csrf

                    <!-- Hidden IDs -->
                    <input type="hidden" name="admission_id" value="{{ $admission->id ?? '' }}">
                    @if(isset($pendingDischarge))
                        <input type="hidden" name="pending_discharge_id" value="{{ $pendingDischarge->id }}">
                    @endif

                    <div class="space-y-6">
                        <!-- Discharge Date -->
                        <div class="max-w-xs">
                            <label for="discharge_date" class="block text-sm font-medium text-gray-700 mb-2">
                                Discharge Date *
                            </label>
                            <div class="relative">
                                <input type="date" 
                                       name="discharge_date" 
                                       id="discharge_date"
                                       value="{{ old('discharge_date', $pendingDischarge->discharge_date ?? now()->format('Y-m-d')) }}"
                                       max="{{ date('Y-m-d') }}"
                                       class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 dark-focus focus:border-green-700 transition-colors duration-200"
                                       required>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            </div>
                            @error('discharge_date')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Discharge Reason -->
                        <div>
                            <label for="discharge_reason" class="block text-sm font-medium text-gray-700 mb-2">
                                Reason for Discharge *
                            </label>
                            <textarea name="discharge_reason" 
                                      id="discharge_reason"
                                      rows="4"
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 dark-focus focus:border-green-700 transition-colors duration-200"
                                      placeholder="Enter the reason for discharge..."
                                      required>{{ old('discharge_reason') }}</textarea>
                            @error('discharge_reason')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Discharge Notes -->
                        <div>
                            <label for="discharge_notes" class="block text-sm font-medium text-gray-700 mb-2">
                                Additional Notes (Optional)
                            </label>
                            <textarea name="discharge_notes" 
                                      id="discharge_notes"
                                      rows="3"
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 dark-focus focus:border-green-700 transition-colors duration-200"
                                      placeholder="Any additional notes or comments...">{{ old('discharge_notes') }}</textarea>
                            @error('discharge_notes')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Warning Message -->
                        <div class="bg-amber-50 border border-amber-200 rounded-lg p-4">
                            <div class="flex">
                                <svg class="w-5 h-5 text-amber-400 mr-3 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.35 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                                </svg>
                                <div>
                                    <h3 class="text-sm font-medium text-amber-800">Important</h3>
                                    <p class="text-sm text-amber-700 mt-1">
                                        Once discharged, this patient will be removed from both active admissions and pending discharges list. 
                                        This action completes the discharge process.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Buttons -->
                        <div class="flex flex-col sm:flex-row justify-end space-y-3 sm:space-y-0 sm:space-x-3 pt-4">
                            <a href="{{ isset($pendingDischarge) ? route('incharge.discharge.pending') : route('hwhadmissions.discharges.index') }}" 
                               class="px-6 py-3 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition duration-200 font-medium text-center">
                                Cancel
                            </a>
                            <button type="submit" 
                                    class="px-6 py-3 dark-primary text-white rounded-lg hover:bg-green-700 transition duration-200 font-medium shadow-sm hover:shadow-md">
                                Complete Discharge
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Ensure discharge date cannot exceed today
        document.getElementById('discharge_date').max = new Date().toISOString().split('T')[0];
    </script>
</body>
</html>