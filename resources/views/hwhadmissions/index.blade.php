<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HWH Admissions List</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
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
    <style>
        /* Previous styles remain the same */
        .dashboard-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            border: 1px solid #e2e8f0;
            transition: all 0.3s ease;
        }
        
        .dashboard-card:hover {
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.12);
            transform: translateY(-2px);
        }
        
        .stats-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            border-left: 4px solid #14b8a6;
            transition: all 0.3s ease;
        }
        
        .stats-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.12);
        }
        
        .patient-table {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }
        
        .table-header {
            background: linear-gradient(135deg, #0d9488, #115e59);
        }
        
        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }
        
        .status-active {
            background: #f0fdfa;
            color: #0f766e;
            border: 1px solid #ccfbf1;
        }
        
        .status-discharged {
            background: #fef2f2;
            color: #dc2626;
            border: 1px solid #fecaca;
        }
        
        .action-dropdown {
            position: relative;
            display: inline-block;
        }
        
        .action-btn {
            background: #0d9488;
            color: white;
            border: none;
            border-radius: 6px;
            padding: 6px 12px;
            font-size: 0.85rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 4px;
            transition: all 0.3s ease;
        }
        
        .action-btn:hover {
            background: #115e59;
        }
        
        .dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            background: white;
            min-width: 140px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            border-radius: 6px;
            z-index: 100;
            border: 1px solid #e2e8f0;
            padding: 4px 0;
        }
        
        .dropdown-content.show {
            display: block;
        }
        
        .dropdown-item {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 12px;
            text-decoration: none;
            color: #374151;
            font-size: 0.85rem;
            transition: all 0.2s ease;
            border: none;
            background: none;
            width: 100%;
            text-align: left;
        }
        
        .dropdown-item:hover {
            background: #f0fdfa;
            color: #0f766e;
        }
        
        .dropdown-item i {
            width: 14px;
            text-align: center;
            font-size: 0.75rem;
        }
        
        .dropdown-divider {
            height: 1px;
            background: #e5e7eb;
            margin: 4px 0;
        }
        
        .search-box {
            position: relative;
        }
        
        .search-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #64748b;
            font-size: 0.8rem;
        }
        
        .empty-state {
            text-align: center;
            padding: 60px 20px;
        }
        
        .empty-icon {
            font-size: 3.5rem;
            color: #cbd5e1;
            margin-bottom: 20px;
        }
        
        .alert-message {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1050;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            max-width: 400px;
        }
        
        .filter-btn {
            background: white;
            border: 1px solid #e2e8f0;
            color: #475569;
            border-radius: 6px;
            padding: 4px 12px;
            font-size: 0.75rem;
            transition: all 0.3s ease;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            white-space: nowrap;
        }
        
        .filter-btn.active {
            background: #0d9488;
            color: white;
            border-color: #0d9488;
        }
        
        .filter-btn:hover:not(.active) {
            background: #f8fafc;
            border-color: #cbd5e1;
        }
        
        /* Export Dropdown Styles */
        .export-dropdown {
            position: relative;
            display: inline-block;
        }
        
        .export-btn {
            background: #10b981;
            color: white;
            border: none;
            border-radius: 6px;
            padding: 8px 16px;
            font-size: 0.85rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: all 0.3s ease;
        }
        
        .export-btn:hover {
            background: #059669;
        }
        
        .export-content {
            display: none;
            position: absolute;
            right: 0;
            background: white;
            min-width: 160px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            border-radius: 6px;
            z-index: 100;
            border: 1px solid #e2e8f0;
            padding: 6px 0;
        }
        
        .export-content.show {
            display: block;
        }
        
        .export-item {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 12px;
            text-decoration: none;
            color: #374151;
            font-size: 0.85rem;
            transition: all 0.2s ease;
            border: none;
            background: none;
            width: 100%;
            text-align: left;
            cursor: pointer;
        }
        
        .export-item:hover {
            background: #f0fdfa;
            color: #0f766e;
        }
        
        .export-item i {
            width: 14px;
            text-align: center;
            font-size: 0.75rem;
        }
        
        /* Elegant small icons */
        .stats-icon {
            font-size: 1.5rem;
            margin-bottom: 15px;
            color: #0d9488;
        }
        
        .header-icon {
            font-size: 0.9rem;
            margin-right: 6px;
        }
        
        .status-icon {
            font-size: 0.6rem;
            margin-right: 3px;
        }
        
        .pagination-icon {
            font-size: 0.8rem;
        }
        
        @media (max-width: 768px) {
            .table-responsive {
                border-radius: 8px;
            }
            
            .stats-card {
                margin-bottom: 15px;
            }
            
            .stats-icon {
                font-size: 1.25rem;
            }
        }
    </style>
</head>
<body class="bg-teal-50 min-h-screen">
    <div class="container mx-auto px-4 py-6">
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div class="stats-card p-5">
                <div class="flex items-center">
                    <div class="bg-teal-100 p-3 rounded-lg mr-4">
                        <i class="fas fa-users stats-icon"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-teal-600">Total Patients</p>
                        <p class="text-2xl font-bold text-teal-900">{{ $hwhadmissions->total() }}</p>
                    </div>
                </div>
            </div>
            
            <div class="stats-card p-5">
                <div class="flex items-center">
                    <div class="bg-teal-100 p-3 rounded-lg mr-4">
                        <i class="fas fa-user-check stats-icon"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-teal-600">Active Patients</p>
                        <p class="text-2xl font-bold text-teal-900">
                            {{ $hwhadmissions->where('status', '!=', 'discharged')->count() }}
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="stats-card p-5">
                <div class="flex items-center">
                    <div class="bg-teal-100 p-3 rounded-lg mr-4">
                        <i class="fas fa-file-medical stats-icon"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-teal-600">Discharged Patients</p>
                        <p class="text-2xl font-bold text-teal-900">
                            {{ $hwhadmissions->where('status', 'discharged')->count() }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search and Action Bar -->
        <div class="flex flex-col sm:flex-row gap-4 items-start sm:items-center justify-between mb-6">
            <!-- Search and Filters -->
            <div class="flex flex-col sm:flex-row gap-3 items-start sm:items-center w-full sm:w-auto">
                <!-- Search Input -->
                <div class="relative max-w-md w-full sm:w-auto">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" 
                           name="search" 
                           value="{{ request('search') }}" 
                           placeholder="Search..." 
                           class="w-full pl-9 pr-4 py-2 border border-teal-200 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 bg-white text-teal-900 placeholder-teal-400 text-sm">
                </div>
                
                <!-- Status Filter Buttons -->
                <div class="flex gap-2">
                    <a href="{{ route('hwhadmissions.index', ['search' => request('search'), 'status' => 'active']) }}" 
                       class="filter-btn {{ request('status') == 'active' || !request('status') ? 'active' : '' }}">
                        Active
                    </a>
                    <a href="{{ route('hwhadmissions.index', ['search' => request('search'), 'status' => 'discharged']) }}" 
                       class="filter-btn {{ request('status') == 'discharged' ? 'active' : '' }}">
                        Discharged
                    </a>
                    <a href="{{ route('hwhadmissions.index', ['search' => request('search')]) }}" 
                       class="filter-btn {{ !request('status') && !request('search') ? 'active' : '' }}">
                        All
                    </a>
                </div>

                <!-- Clear Filter Button -->
                @if(request('search') || request('status'))
                    <a href="{{ route('hwhadmissions.index') }}" class="px-3 py-2 bg-teal-100 text-teal-700 rounded-lg hover:bg-teal-200 transition duration-200 font-medium text-sm flex items-center gap-1 whitespace-nowrap">
                        <i class="fas fa-times text-xs"></i>
                        Clear
                    </a>
                @endif
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-2 w-full sm:w-auto">
                <!-- Export Dropdown -->
                <div class="export-dropdown">
                    <button class="export-btn" onclick="toggleExportDropdown(this)">
                        <i class="fas fa-download header-icon"></i>
                        Export Data
                    </button>
                    <div class="export-content">
                        <button class="export-item" onclick="exportToExcel()">
                            <i class="fas fa-file-excel text-green-600"></i>
                            Export to Excel
                        </button>
                        <button class="export-item" onclick="exportToCSV()">
                            <i class="fas fa-file-csv text-blue-600"></i>
                            Export to CSV
                        </button>
                        <div class="dropdown-divider"></div>
                        <button class="export-item" onclick="exportFilteredData()">
                            <i class="fas fa-filter text-purple-600"></i>
                            Export Filtered Data
                        </button>
                    </div>
                </div>
                
                <!-- ✅ DISCHARGED LIST BUTTON ONLY -->
                <a href="{{ route('hwhadmissions.discharges.discharged-list') }}" 
                   class="inline-flex items-center justify-center px-4 py-2 bg-teal-500 text-white rounded-lg hover:bg-teal-600 transition duration-200 font-medium text-sm">
                    <i class="fas fa-list header-icon"></i>
                    Discharged List
                </a>
            </div>
        </div>

        <!-- Records Table -->
        <div class="patient-table">
            @if($hwhadmissions->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full" id="applicationsTable">
                        <thead class="table-header">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Patient Name</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Father Name</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">CNIC</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Phone</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Admission Date</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Status</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-teal-100">
                            @foreach($hwhadmissions as $admission)
                                <tr class="hover:bg-teal-50 transition duration-150">
                                    <td class="px-4 py-3 whitespace-nowrap">
                                        <div class="text-sm font-semibold text-teal-900">{{ $admission->patient_name }}</div>
                                        @if($admission->status == 'discharged')
                                            <div class="text-xs text-red-600 font-medium flex items-center gap-1">
                                                <i class="fas fa-check status-icon"></i>
                                                Discharged
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap">
                                        <div class="text-sm text-teal-700">{{ $admission->father_name }}</div>
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap">
                                        <div class="text-sm text-teal-700 font-mono">{{ $admission->cnic }}</div>
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap">
                                        <div class="text-sm text-teal-700">{{ $admission->phone }}</div>
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap">
                                        <div class="text-sm text-teal-700">
                                            @if($admission->admission_date)
                                                {{ \Carbon\Carbon::parse($admission->admission_date)->format('Y-m-d') }}
                                            @else
                                                {{ $admission->created_at->format('Y-m-d') }}
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap">
                                        @if($admission->status == 'discharged')
                                            <span class="status-badge status-discharged flex items-center">
                                                <i class="fas fa-check-circle status-icon"></i>
                                                Discharged
                                            </span>
                                            @if($admission->discharge_date)
                                                <div class="text-xs text-gray-500 mt-1">
                                                    {{ \Carbon\Carbon::parse($admission->discharge_date)->format('M d, Y') }}
                                                </div>
                                            @endif
                                        @else
                                            <span class="status-badge status-active flex items-center">
                                                <i class="fas fa-user status-icon"></i>
                                                Active
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm font-medium">
                                        <div class="action-dropdown">
                                            <button class="action-btn" onclick="toggleDropdown(this)">
                                                <i class="fas fa-ellipsis-v"></i>
                                                Actions
                                            </button>
                                            <div class="dropdown-content">
                                                <a href="{{ route('hwhadmissions.show', $admission->id) }}" class="dropdown-item">
                                                    <i class="fas fa-eye text-teal-600"></i>
                                                    View
                                                </a>
                                                <a href="{{ route('hwhadmissions.edit', $admission->id) }}" class="dropdown-item">
                                                    <i class="fas fa-edit text-teal-600"></i>
                                                    Edit
                                                </a>
                                                <div class="dropdown-divider"></div>
                                                @if($admission->status !== 'discharged')
                                                    <a href="{{ route('hwhadmissions.discharges.create', $admission->id) }}" class="dropdown-item">
                                                        <i class="fas fa-sign-out-alt text-red-500"></i>
                                                        Discharge
                                                    </a>
                                                @else
                                                    <button class="dropdown-item text-gray-400 cursor-not-allowed" disabled>
                                                        <i class="fas fa-check text-gray-400"></i>
                                                        Discharged
                                                    </button>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="bg-teal-50 px-4 py-3 border-t border-teal-200 flex items-center justify-between">
                    <div class="text-sm text-teal-700">
                        Showing {{ $hwhadmissions->firstItem() }} to {{ $hwhadmissions->lastItem() }} of {{ $hwhadmissions->total() }} results
                    </div>
                    <div class="flex items-center space-x-1">
                        @if($hwhadmissions->onFirstPage())
                            <span class="px-3 py-1 text-gray-400 cursor-not-allowed">
                                <i class="fas fa-chevron-left pagination-icon"></i>
                            </span>
                        @else
                            <a href="{{ $hwhadmissions->previousPageUrl() }}" class="px-3 py-1 text-teal-600 hover:text-teal-800">
                                <i class="fas fa-chevron-left pagination-icon"></i>
                            </a>
                        @endif
                        
                        @foreach($hwhadmissions->getUrlRange(1, $hwhadmissions->lastPage()) as $page => $url)
                            @if($page == $hwhadmissions->currentPage())
                                <span class="px-3 py-1 bg-teal-600 text-white rounded">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}" class="px-3 py-1 text-teal-600 hover:text-teal-800">{{ $page }}</a>
                            @endif
                        @endforeach
                        
                        @if($hwhadmissions->hasMorePages())
                            <a href="{{ $hwhadmissions->nextPageUrl() }}" class="px-3 py-1 text-teal-600 hover:text-teal-800">
                                <i class="fas fa-chevron-right pagination-icon"></i>
                            </a>
                        @else
                            <span class="px-3 py-1 text-gray-400 cursor-not-allowed">
                                <i class="fas fa-chevron-right pagination-icon"></i>
                            </span>
                        @endif
                    </div>
                </div>
            @else
                <!-- No Records Found -->
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="far fa-folder-open"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-teal-900 mb-2">No admission records found</h3>
                    <p class="text-teal-600 text-sm">
                        @if(request('search') || request('status'))
                            Try adjusting your search criteria or filter.
                        @else
                            No patient admission forms have been submitted yet.
                        @endif
                    </p>
                    <!-- ✅ DISCHARGED LIST LINK -->
                    @if(request('status') == 'discharged')
                        <div class="mt-4">
                            <a href="{{ route('hwhadmissions.discharges.discharged-list') }}" 
                               class="inline-flex items-center px-4 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition duration-200 text-sm">
                                <i class="fas fa-list header-icon"></i>
                                View Full Discharged List
                            </a>
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </div>

    <!-- Success/Error Messages -->
    @if(session('success'))
        <div class="alert-message bg-teal-500 text-white px-6 py-3 rounded-lg shadow-lg transition duration-300" id="successMessage">
            <div class="flex items-center">
                <i class="fas fa-check-circle mr-2"></i>
                {{ session('success') }}
            </div>
        </div>
        <script>
            setTimeout(() => {
                const successMessage = document.getElementById('successMessage');
                if (successMessage) {
                    successMessage.style.display = 'none';
                }
            }, 5000);
        </script>
    @endif

    @if(session('error'))
        <div class="alert-message bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg transition duration-300" id="errorMessage">
            <div class="flex items-center">
                <i class="fas fa-exclamation-circle mr-2"></i>
                {{ session('error') }}
            </div>
        </div>
        <script>
            setTimeout(() => {
                const errorMessage = document.getElementById('errorMessage');
                if (errorMessage) {
                    errorMessage.style.display = 'none';
                }
            }, 5000);
        </script>
    @endif

    <script>
        // Toggle dropdown visibility
        function toggleDropdown(button) {
            const dropdown = button.nextElementSibling;
            dropdown.classList.toggle('show');
        }
        
        // Toggle export dropdown visibility
        function toggleExportDropdown(button) {
            const dropdown = button.nextElementSibling;
            dropdown.classList.toggle('show');
        }
        
        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const dropdowns = document.querySelectorAll('.dropdown-content, .export-content');
            dropdowns.forEach(dropdown => {
                if (!dropdown.parentElement.contains(event.target)) {
                    dropdown.classList.remove('show');
                }
            });
        });
        
        // Close dropdown when clicking on an item
        document.querySelectorAll('.dropdown-item, .export-item').forEach(item => {
            item.addEventListener('click', function() {
                this.closest('.dropdown-content, .export-content').classList.remove('show');
            });
        });

        // Auto-submit search form when typing (with delay)
        let searchTimeout;
        document.querySelector('input[name="search"]').addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                // Create form and submit
                const form = document.createElement('form');
                form.method = 'GET';
                form.action = '{{ route('hwhadmissions.index') }}';
                
                // Add search parameter
                const searchInput = document.createElement('input');
                searchInput.type = 'hidden';
                searchInput.name = 'search';
                searchInput.value = this.value;
                form.appendChild(searchInput);
                
                // Add status parameter if exists
                const urlParams = new URLSearchParams(window.location.search);
                const status = urlParams.get('status');
                if (status) {
                    const statusInput = document.createElement('input');
                    statusInput.type = 'hidden';
                    statusInput.name = 'status';
                    statusInput.value = status;
                    form.appendChild(statusInput);
                }
                
                document.body.appendChild(form);
                form.submit();
            }, 500);
        });

        // Export Functions
        function exportToExcel() {
            const table = document.getElementById('applicationsTable');
            const workbook = XLSX.utils.table_to_book(table, {sheet: "Applications"});
            XLSX.writeFile(workbook, 'applications_data.xlsx');
            showExportMessage('Data exported to Excel successfully!');
        }

        function exportToCSV() {
            const table = document.getElementById('applicationsTable');
            const worksheet = XLSX.utils.table_to_sheet(table);
            const csv = XLSX.utils.sheet_to_csv(worksheet);
            downloadCSV(csv, 'applications_data.csv');
            showExportMessage('Data exported to CSV successfully!');
        }

        function exportFilteredData() {
            // Get current filter parameters
            const urlParams = new URLSearchParams(window.location.search);
            const search = urlParams.get('search') || '';
            const status = urlParams.get('status') || '';
            
            // Create a message about what's being exported
            let filterInfo = 'All data';
            if (search || status) {
                filterInfo = 'Filtered data';
                if (search) filterInfo += ` (search: "${search}")`;
                if (status) filterInfo += ` (status: ${status})`;
            }
            
            const table = document.getElementById('applicationsTable');
            const workbook = XLSX.utils.table_to_book(table, {sheet: "Applications"});
            XLSX.writeFile(workbook, 'filtered_applications.xlsx');
            showExportMessage(`${filterInfo} exported to Excel successfully!`);
        }

        function downloadCSV(csv, filename) {
            const blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
            const link = document.createElement('a');
            const url = URL.createObjectURL(blob);
            link.setAttribute('href', url);
            link.setAttribute('download', filename);
            link.style.visibility = 'hidden';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }

        function showExportMessage(message) {
            // Create a temporary success message
            const alertDiv = document.createElement('div');
            alertDiv.className = 'alert-message bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg transition duration-300';
            alertDiv.innerHTML = `
                <div class="flex items-center">
                    <i class="fas fa-check-circle mr-2"></i>
                    ${message}
                </div>
            `;
            document.body.appendChild(alertDiv);
            
            // Remove after 3 seconds
            setTimeout(() => {
                alertDiv.remove();
            }, 3000);
        }
    </script>
</body>
</html>