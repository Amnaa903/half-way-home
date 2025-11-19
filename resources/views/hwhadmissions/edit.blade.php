<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Patient Admission</title>
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
        <div class="max-w-4xl mx-auto">
            <!-- Back Button -->
            <div class="mb-6">
                <a href="{{ route('hwhadmissions.show', $record->id) }}" class="inline-flex items-center text-teal-700 hover:text-teal-800 font-medium">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Back to Details
                </a>
            </div>

            <!-- Main Card -->
            <div class="bg-white rounded-xl shadow-sm border border-teal-100 overflow-hidden">
                <!-- Header -->
                <div class="bg-linear-to-r from-teal-600 to-teal-700 px-6 py-5">
                    <div class="flex items-center justify-between">
                        <div>
                            <h1 class="text-2xl font-bold text-white mb-1">Edit Patient Admission</h1>
                            <p class="text-teal-100 text-sm">Update admission details for {{ $record->patient_name }}</p>
                        </div>
                        <div class="bg-teal-500 text-white px-3 py-1 rounded-full text-sm font-medium">
                            ID: {{ $record->id }}
                        </div>
                    </div>
                </div>

                <!-- Edit Form -->
                <div class="p-6">
                    <form action="{{ route('hwhadmissions.update', $record->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <!-- Personal Information -->
                        <div class="mb-8">
                            <h2 class="text-xl font-semibold text-teal-800 border-b border-teal-200 pb-2 mb-4">Personal Information</h2>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-teal-700 mb-1">Patient Name *</label>
                                    <input type="text" name="patient_name" value="{{ old('patient_name', $record->patient_name) }}" 
                                           class="w-full px-3 py-2 border border-teal-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500" required>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-teal-700 mb-1">Father Name *</label>
                                    <input type="text" name="father_name" value="{{ old('father_name', $record->father_name) }}" 
                                           class="w-full px-3 py-2 border border-teal-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500" required>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-teal-700 mb-1">Age *</label>
                                    <input type="number" name="age" value="{{ old('age', $record->age) }}" 
                                           class="w-full px-3 py-2 border border-teal-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500" required>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-teal-700 mb-1">Gender *</label>
                                    <select name="gender" class="w-full px-3 py-2 border border-teal-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500" required>
                                        <option value="male" {{ $record->gender == 'male' ? 'selected' : '' }}>Male</option>
                                        <option value="female" {{ $record->gender == 'female' ? 'selected' : '' }}>Female</option>
                                        <option value="other" {{ $record->gender == 'other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-teal-700 mb-1">CNIC *</label>
                                    <input type="text" name="cnic" value="{{ old('cnic', $record->cnic) }}" 
                                           class="w-full px-3 py-2 border border-teal-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500" required>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-teal-700 mb-1">Phone *</label>
                                    <input type="text" name="phone" value="{{ old('phone', $record->phone) }}" 
                                           class="w-full px-3 py-2 border border-teal-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500" required>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-teal-700 mb-1">Education</label>
                                    <input type="text" name="education" value="{{ old('education', $record->education) }}" 
                                           class="w-full px-3 py-2 border border-teal-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-teal-700 mb-1">Religion</label>
                                    <input type="text" name="religion" value="{{ old('religion', $record->religion) }}" 
                                           class="w-full px-3 py-2 border border-teal-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500">
                                </div>
                            </div>

                            <div class="mt-4">
                                <label class="block text-sm font-medium text-teal-700 mb-1">Address *</label>
                                <textarea name="address" rows="3" class="w-full px-3 py-2 border border-teal-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500" required>{{ old('address', $record->address) }}</textarea>
                            </div>
                        </div>

                        <!-- Family Information -->
                        <div class="mb-8">
                            <h2 class="text-xl font-semibold text-teal-800 border-b border-teal-200 pb-2 mb-4">Family Information</h2>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-teal-700 mb-1">Marital Status *</label>
                                    <select name="marital_status" class="w-full px-3 py-2 border border-teal-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500" required>
                                        <option value="Single" {{ $record->marital_status == 'Single' ? 'selected' : '' }}>Single</option>
                                        <option value="Married" {{ $record->marital_status == 'Married' ? 'selected' : '' }}>Married</option>
                                        <option value="Divorced" {{ $record->marital_status == 'Divorced' ? 'selected' : '' }}>Divorced</option>
                                        <option value="Widowed" {{ $record->marital_status == 'Widowed' ? 'selected' : '' }}>Widowed</option>
                                    </select>
                                </div>

                                <div id="spouse_name_field" style="{{ $record->marital_status == 'Married' ? '' : 'display: none;' }}">
                                    <label class="block text-sm font-medium text-teal-700 mb-1">Spouse Name</label>
                                    <input type="text" name="spouse_name" value="{{ old('spouse_name', $record->spouse_name) }}" 
                                           class="w-full px-3 py-2 border border-teal-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-teal-700 mb-1">Number of Children</label>
                                    <input type="number" name="children_count" value="{{ old('children_count', $record->children_count) }}" 
                                           class="w-full px-3 py-2 border border-teal-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500" min="0">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-teal-700 mb-1">Number of Boys</label>
                                    <input type="number" name="boys_count" value="{{ old('boys_count', $record->boys_count) }}" 
                                           class="w-full px-3 py-2 border border-teal-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500" min="0">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-teal-700 mb-1">Number of Girls</label>
                                    <input type="number" name="girls_count" value="{{ old('girls_count', $record->girls_count) }}" 
                                           class="w-full px-3 py-2 border border-teal-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500" min="0">
                                </div>
                            </div>
                        </div>

                        <!-- Guardian Information -->
                        <div class="mb-8">
                            <h2 class="text-xl font-semibold text-teal-800 border-b border-teal-200 pb-2 mb-4">Guardian Information</h2>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-teal-700 mb-1">Guardian Name *</label>
                                    <input type="text" name="guardian_name" value="{{ old('guardian_name', $record->guardian_name) }}" 
                                           class="w-full px-3 py-2 border border-teal-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500" required>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-teal-700 mb-1">Guardian Contact *</label>
                                    <input type="text" name="guardian_contact" value="{{ old('guardian_contact', $record->guardian_contact) }}" 
                                           class="w-full px-3 py-2 border border-teal-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500" required>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-teal-700 mb-1">Relationship *</label>
                                    <input type="text" name="relationship" value="{{ old('relationship', $record->relationship) }}" 
                                           class="w-full px-3 py-2 border border-teal-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500" required>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-teal-700 mb-1">Guardian Address *</label>
                                    <input type="text" name="guardian_address" value="{{ old('guardian_address', $record->guardian_address) }}" 
                                           class="w-full px-3 py-2 border border-teal-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500" required>
                                </div>
                            </div>
                        </div>

                        <!-- Medical Information -->
                        <div class="mb-8">
                            <h2 class="text-xl font-semibold text-teal-800 border-b border-teal-200 pb-2 mb-4">Medical Information</h2>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-teal-700 mb-1">Admission Date *</label>
                                    <input type="date" name="admission_date" value="{{ old('admission_date', $record->admission_date) }}" 
                                           class="w-full px-3 py-2 border border-teal-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500" required>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-teal-700 mb-1">Reason for Admission</label>
                                    <input type="text" name="reason" value="{{ old('reason', $record->reason) }}" 
                                           class="w-full px-3 py-2 border border-teal-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500">
                                </div>

                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-teal-700 mb-1">Disease Name *</label>
                                    <input type="text" name="disease_name" value="{{ old('disease_name', $record->disease_name) }}" 
                                           class="w-full px-3 py-2 border border-teal-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500" required>
                                </div>

                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-teal-700 mb-1">Treatment Details *</label>
                                    <textarea name="treatment_details" rows="4" class="w-full px-3 py-2 border border-teal-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500" required>{{ old('treatment_details', $record->treatment_details) }}</textarea>
                                </div>

                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-teal-700 mb-1">Case History *</label>
                                    <textarea name="case_history" rows="4" class="w-full px-3 py-2 border border-teal-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500" required>{{ old('case_history', $record->case_history) }}</textarea>
                                </div>

                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-teal-700 mb-1">Other Diseases</label>
                                    <textarea name="other_diseases" rows="3" class="w-full px-3 py-2 border border-teal-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500">{{ old('other_diseases', $record->other_diseases) }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- File Attachments (Optional Update) -->
                        <div class="mb-8">
                            <h2 class="text-xl font-semibold text-teal-800 border-b border-teal-200 pb-2 mb-4">File Attachments (Optional Update)</h2>
                            <p class="text-sm text-teal-600 mb-4">Leave files unchanged if you don't want to update them.</p>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-teal-700 mb-1">ID Card Front</label>
                                    <input type="file" name="id_card_front" 
                                           class="w-full px-3 py-2 border border-teal-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500">
                                    <p class="text-xs text-teal-500 mt-1">Current file will be kept if no new file is selected</p>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-teal-700 mb-1">ID Card Back</label>
                                    <input type="file" name="id_card_back" 
                                           class="w-full px-3 py-2 border border-teal-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-teal-700 mb-1">Passport Photos</label>
                                    <input type="file" name="passport_photos[]" multiple
                                           class="w-full px-3 py-2 border border-teal-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-teal-700 mb-1">Medical Reports</label>
                                    <input type="file" name="medical_reports[]" multiple
                                           class="w-full px-3 py-2 border border-teal-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-teal-700 mb-1">Referral Form</label>
                                    <input type="file" name="referral_form" 
                                           class="w-full px-3 py-2 border border-teal-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-teal-700 mb-1">Affidavit</label>
                                    <input type="file" name="affidavit" 
                                           class="w-full px-3 py-2 border border-teal-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500">
                                </div>

                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-teal-700 mb-1">Additional Documents</label>
                                    <input type="file" name="additional_documents[]" multiple
                                           class="w-full px-3 py-2 border border-teal-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500">
                                </div>
                            </div>
                        </div>

                        <!-- Submit Buttons -->
                        <div class="mt-8 pt-6 border-t border-teal-200 flex justify-end space-x-3">
                            <a href="{{ route('hwhadmissions.show', $record->id) }}" 
                               class="px-6 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition duration-200 font-medium">
                                Cancel
                            </a>
                            <button type="submit" 
                                    class="px-6 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition duration-200 font-medium">
                                Update Record
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Show/hide spouse name based on marital status
        document.querySelector('select[name="marital_status"]').addEventListener('change', function() {
            const spouseField = document.getElementById('spouse_name_field');
            if (this.value === 'Married') {
                spouseField.style.display = 'block';
            } else {
                spouseField.style.display = 'none';
                document.querySelector('input[name="spouse_name"]').value = '';
            }
        });
    </script>
</body>
</html>