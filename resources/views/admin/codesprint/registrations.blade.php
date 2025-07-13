<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CodeSprint 2025 - Admin Dashboard</title>
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta name="referrer" content="strict-origin-when-cross-origin">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/codesprint-style.css') }}">
</head>
<body>
    @include('layouts.dangling_header')
    
    <div class="container mx-auto px-4 py-12 max-w-7xl">
        <!-- Header -->
        <header class="text-center mb-12 pt-8">
            <h1 class="text-4xl sm:text-5xl font-bold mb-4 header-gradient">
                CodeSprint 2025 Admin
            </h1>
            <p class="text-xl max-w-2xl mx-auto text-gray-300">Manage registrations and competition data</p>
        </header>

        <!-- Statistics Overview -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
            <div class="card p-6 text-center">
                <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-indigo-900/30 flex items-center justify-center">
                    <i class="bi bi-people text-indigo-400 text-2xl"></i>
                </div>
                <h3 class="font-bold text-lg mb-2">Total Registrations</h3>
                <div class="text-3xl font-bold text-indigo-400">{{ $stats['total'] }}</div>
            </div>
            
            <div class="card p-6 text-center">
                <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-green-900/30 flex items-center justify-center">
                    <i class="bi bi-check-circle text-green-400 text-2xl"></i>
                </div>
                <h3 class="font-bold text-lg mb-2">Verified Payments</h3>
                <div class="text-3xl font-bold text-green-400">{{ $stats['verified'] }}</div>
            </div>
            
            <div class="card p-6 text-center">
                <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-purple-900/30 flex items-center justify-center">
                    <i class="bi bi-github text-purple-400 text-2xl"></i>
                </div>
                <h3 class="font-bold text-lg mb-2">GitHub Submitted</h3>
                <div class="text-3xl font-bold text-purple-400">{{ $stats['github_submitted'] }}</div>
            </div>
            
            <div class="card p-6 text-center">
                <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-amber-900/30 flex items-center justify-center">
                    <i class="bi bi-file-earmark-zip text-amber-400 text-2xl"></i>
                </div>
                <h3 class="font-bold text-lg mb-2">Projects Submitted</h3>
                <div class="text-3xl font-bold text-amber-400">{{ $stats['project_submitted'] }}</div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="card p-6 mb-8">
            <h2 class="text-2xl font-bold mb-6 section-title">Quick Actions</h2>
            <div class="flex flex-wrap gap-4">
                <a href="{{ route('admin.codesprint.export') }}" class="btn btn-success">
                    <i class="bi bi-download me-2"></i>
                    Export All Data (CSV)
                </a>
                <button onclick="refreshStats()" class="btn btn-secondary">
                    <i class="bi bi-arrow-clockwise me-2"></i>
                    Refresh Statistics
                </button>
                <a href="{{ route('codesprint.rulebook') }}" class="btn btn-secondary">
                    <i class="bi bi-book me-2"></i>
                    View Rulebook
                </a>
            </div>
        </div>

        <!-- Filters -->
        <div class="card p-6 mb-8">
            <h2 class="text-2xl font-bold mb-6 section-title">Filters & Search</h2>
            <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-2 text-gray-300">Payment Status</label>
                    <select name="payment_status" class="form-select w-full">
                        <option value="">All</option>
                        <option value="pending" {{ request('payment_status') === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="verified" {{ request('payment_status') === 'verified' ? 'selected' : '' }}>Verified</option>
                        <option value="rejected" {{ request('payment_status') === 'rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                </div>
                
                <div>
                    <label class="block text-sm font-medium mb-2 text-gray-300">Registration Status</label>
                    <select name="registration_status" class="form-select w-full">
                        <option value="">All</option>
                        <option value="active" {{ request('registration_status') === 'active' ? 'selected' : '' }}>Active</option>
                        <option value="disqualified" {{ request('registration_status') === 'disqualified' ? 'selected' : '' }}>Disqualified</option>
                        <option value="withdrawn" {{ request('registration_status') === 'withdrawn' ? 'selected' : '' }}>Withdrawn</option>
                    </select>
                </div>
                
                <div>
                    <label class="block text-sm font-medium mb-2 text-gray-300">GitHub Status</label>
                    <select name="github_status" class="form-select w-full">
                        <option value="">All</option>
                        <option value="submitted" {{ request('github_status') === 'submitted' ? 'selected' : '' }}>Submitted</option>
                        <option value="pending" {{ request('github_status') === 'pending' ? 'selected' : '' }}>Pending</option>
                    </select>
                </div>
                
                <div class="flex items-end">
                    <button type="submit" class="btn btn-primary w-full">
                        <i class="bi bi-funnel me-2"></i>
                        Apply Filters
                    </button>
                </div>
            </form>
        </div>

        <!-- Registrations Table -->
        <div class="table-glass mb-8">
            <div class="p-6 border-b border-white/10">
                <h2 class="text-2xl font-bold section-title">Registrations</h2>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr>
                            <th class="text-left">Team Details</th>
                            <th class="text-left">Leader Info</th>
                            <th class="text-center">Payment</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Progress</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($registrations as $registration)
                        <tr>
                            <td>
                                <div>
                                    <div class="font-bold text-white">{{ $registration->team_name }}</div>
                                    <div class="text-sm text-gray-400">
                                        {{ $registration->team_size }} member{{ $registration->team_size > 1 ? 's' : '' }} | 
                                        Registered: {{ $registration->created_at->format('M d, Y') }}
                                    </div>
                                </div>
                            </td>
                            
                            <td>
                                <div>
                                    <div class="font-medium text-white">{{ $registration->member1_name }}</div>
                                    <div class="text-sm text-gray-400">{{ $registration->member1_email }}</div>
                                    <div class="text-sm text-gray-400">{{ $registration->member1_student_id }}</div>
                                </div>
                            </td>
                            
                            <td class="text-center">
                                <span class="badge {{ $registration->payment_status === 'verified' ? 'badge-success' : ($registration->payment_status === 'pending' ? 'badge-warning' : 'badge-danger') }}">
                                    {{ ucfirst($registration->payment_status) }}
                                </span>
                                <div class="text-xs text-gray-400 mt-1">{{ $registration->transaction_id }}</div>
                            </td>
                            
                            <td class="text-center">
                                <span class="badge {{ $registration->registration_status === 'active' ? 'badge-success' : 'badge-danger' }}">
                                    {{ ucfirst($registration->registration_status) }}
                                </span>
                                @if($registration->selected_for_presentation)
                                    <div class="badge badge-info text-xs mt-1">Selected</div>
                                @endif
                            </td>
                            
                            <td class="text-center">
                                <div class="flex justify-center space-x-2">
                                    <span class="status-indicator {{ $registration->github_repo_url ? 'status-active' : 'status-pending' }}" title="GitHub"></span>
                                    <span class="status-indicator {{ $registration->project_submitted_at ? 'status-active' : 'status-pending' }}" title="Project"></span>
                                </div>
                                <div class="text-xs text-gray-400 mt-1">
                                    {{ $registration->github_repo_url ? 'GitHub ✓' : 'GitHub ✗' }} |
                                    {{ $registration->project_submitted_at ? 'Project ✓' : 'Project ✗' }}
                                </div>
                            </td>
                            
                            <td class="text-center">
                                <div class="flex justify-center space-x-2">
                                    <a href="{{ route('admin.codesprint.registration.details', $registration->id) }}" 
                                       class="btn btn-secondary btn-sm">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <button onclick="openStatusModal({{ $registration->id }}, '{{ $registration->team_name }}', '{{ $registration->payment_status }}', '{{ $registration->registration_status }}', {{ $registration->selected_for_presentation ? 'true' : 'false' }})" 
                                            class="btn btn-primary btn-sm">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-8 text-gray-400">
                                No registrations found
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if($registrations->hasPages())
            <div class="p-6 border-t border-white/10">
                {{ $registrations->links() }}
            </div>
            @endif
        </div>
    </div>

    <!-- Status Update Modal -->
    <div id="statusModal" class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm hidden z-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="form-card p-8 w-full max-w-2xl">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold">Update Registration Status</h2>
                    <button onclick="closeStatusModal()" class="text-gray-400 hover:text-white">
                        <i class="bi bi-x-lg text-xl"></i>
                    </button>
                </div>
                
                <form id="statusForm" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')
                    
                    <div id="teamNameDisplay" class="text-lg font-medium text-gray-300 mb-4"></div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium mb-2 text-gray-300">Payment Status</label>
                            <select id="modalPaymentStatus" name="payment_status" class="form-select w-full">
                                <option value="pending">Pending</option>
                                <option value="verified">Verified</option>
                                <option value="rejected">Rejected</option>
                            </select>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium mb-2 text-gray-300">Registration Status</label>
                            <select id="modalRegistrationStatus" name="registration_status" class="form-select w-full">
                                <option value="active">Active</option>
                                <option value="disqualified">Disqualified</option>
                                <option value="withdrawn">Withdrawn</option>
                            </select>
                        </div>
                    </div>
                    
                    <div>
                        <label class="flex items-center">
                            <input type="checkbox" id="modalSelectedForPresentation" name="selected_for_presentation" value="1" class="me-2">
                            <span class="text-gray-300">Selected for presentation</span>
                        </label>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium mb-2 text-gray-300">Admin Notes</label>
                        <textarea name="admin_notes" rows="3" class="form-textarea w-full" placeholder="Optional admin notes..."></textarea>
                    </div>
                    
                    <div class="flex justify-end space-x-4">
                        <button type="button" onclick="closeStatusModal()" class="btn btn-secondary">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update Status</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @include('layouts.footer')

    <script>
        function openStatusModal(id, teamName, paymentStatus, registrationStatus, selectedForPresentation) {
            document.getElementById('teamNameDisplay').textContent = 'Team: ' + teamName;
            document.getElementById('statusForm').action = '/admin/codesprint/registrations/' + id + '/status';
            document.getElementById('modalPaymentStatus').value = paymentStatus;
            document.getElementById('modalRegistrationStatus').value = registrationStatus;
            document.getElementById('modalSelectedForPresentation').checked = selectedForPresentation;
            document.getElementById('statusModal').classList.remove('hidden');
        }

        function closeStatusModal() {
            document.getElementById('statusModal').classList.add('hidden');
        }

        function refreshStats() {
            location.reload();
        }

        // Close modal when clicking outside
        document.getElementById('statusModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeStatusModal();
            }
        });

        // Handle form submission
        document.getElementById('statusForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const actionUrl = this.action;
            
            fetch(actionUrl, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Check if payment status was changed to verified
                    const newPaymentStatus = document.getElementById('modalPaymentStatus').value;
                    if (newPaymentStatus === 'verified') {
                        // Redirect to the team's status page
                        const registrationId = actionUrl.split('/')[4]; // Extract ID from URL
                        window.location.href = `/admin/codesprint/registrations/${registrationId}`;
                    } else {
                        // Just reload the page for other status changes
                        location.reload();
                    }
                } else {
                    alert('Error updating status: ' + (data.message || 'Unknown error'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error updating status. Please try again.');
            });
        });
    </script>

    <style>
        .btn-sm {
            padding: 8px 12px;
            font-size: 0.875rem;
        }
    </style>
</body>
</html>
