@include('rough.iiutpc.header', ['eventName' => $eventName])

<div class="min-h-screen bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 py-12 px-4">
    <div class="container mx-auto max-w-7xl">
        <!-- Admin Header -->
        <div class="text-center mb-8">
            <h1 class="text-4xl md:text-5xl font-bold header-gradient mb-4">
                Admin Dashboard
            </h1>
            <p class="text-gray-300 text-lg">
                Manage {{ $eventName }} registrations
            </p>
        </div>

        <!-- Statistics Cards -->
        <div class="grid md:grid-cols-4 gap-6 mb-8">
            <div class="card p-6 bg-gradient-to-r from-blue-800/30 to-blue-700/30 border-blue-600/30">
                <div class="flex items-center">
                    <i class="bi bi-people text-3xl text-blue-400 me-4"></i>
                    <div>
                        <h3 class="text-2xl font-bold text-white">{{ $totalTeams }}</h3>
                        <p class="text-blue-200">Total Teams</p>
                    </div>
                </div>
            </div>
            
            <div class="card p-6 bg-gradient-to-r from-green-800/30 to-green-700/30 border-green-600/30">
                <div class="flex items-center">
                    <i class="bi bi-check-circle text-3xl text-green-400 me-4"></i>
                    <div>
                        <h3 class="text-2xl font-bold text-white">{{ $verifiedTeams }}</h3>
                        <p class="text-green-200">Verified</p>
                    </div>
                </div>
            </div>
            
            <div class="card p-6 bg-gradient-to-r from-yellow-800/30 to-yellow-700/30 border-yellow-600/30">
                <div class="flex items-center">
                    <i class="bi bi-clock text-3xl text-yellow-400 me-4"></i>
                    <div>
                        <h3 class="text-2xl font-bold text-white">{{ $pendingTeams }}</h3>
                        <p class="text-yellow-200">Pending</p>
                    </div>
                </div>
            </div>
            
            <div class="card p-6 bg-gradient-to-r from-red-800/30 to-red-700/30 border-red-600/30">
                <div class="flex items-center">
                    <i class="bi bi-x-circle text-3xl text-red-400 me-4"></i>
                    <div>
                        <h3 class="text-2xl font-bold text-white">{{ $rejectedTeams }}</h3>
                        <p class="text-red-200">Rejected</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="alert alert-success mb-6">
                <i class="bi bi-check-circle me-2"></i>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error mb-6">
                <i class="bi bi-x-circle me-2"></i>
                {{ session('error') }}
            </div>
        @endif

        <!-- Teams Management Table -->
        <div class="card p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-2xl font-semibold text-white">Team Registrations</h3>
                <div class="flex gap-2">
                    <button onclick="filterTable('all')" class="btn btn-sm btn-secondary filter-btn active" data-filter="all">
                        All ({{ $totalTeams }})
                    </button>
                    <button onclick="filterTable('pending')" class="btn btn-sm btn-warning filter-btn" data-filter="pending">
                        Pending ({{ $pendingTeams }})
                    </button>
                    <button onclick="filterTable('verified')" class="btn btn-sm btn-success filter-btn" data-filter="verified">
                        Verified ({{ $verifiedTeams }})
                    </button>
                    <button onclick="filterTable('rejected')" class="btn btn-sm btn-danger filter-btn" data-filter="rejected">
                        Rejected ({{ $rejectedTeams }})
                    </button>
                </div>
            </div>
            
            @if($registrations->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full" id="teamsTable">
                    <thead>
                        <tr class="border-b border-gray-700">
                            <th class="text-left py-3 px-4 text-gray-300 font-medium">#</th>
                            <th class="text-left py-3 px-4 text-gray-300 font-medium">Team Name</th>
                            <th class="text-left py-3 px-4 text-gray-300 font-medium">Team Lead</th>
                            <th class="text-left py-3 px-4 text-gray-300 font-medium">Transaction ID</th>
                            <th class="text-left py-3 px-4 text-gray-300 font-medium">Registration Time</th>
                            <th class="text-left py-3 px-4 text-gray-300 font-medium">Status</th>
                            <th class="text-left py-3 px-4 text-gray-300 font-medium">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($registrations as $index => $registration)
                        <tr class="border-b border-gray-800 hover:bg-gray-800/30 transition-colors team-row" data-status="{{ $registration->registration_status }}">
                            <td class="py-4 px-4 text-gray-400">{{ $loop->iteration + ($registrations->currentPage() - 1) * $registrations->perPage() }}</td>
                            <td class="py-4 px-4">
                                <div class="font-semibold text-white">{{ $registration->team_name }}</div>
                                <div class="text-sm text-gray-400">{{ $registration->registration_token }}</div>
                            </td>
                            <td class="py-4 px-4">
                                <div class="text-white">{{ $registration->member1_name }}</div>
                                <div class="text-sm text-gray-400">{{ $registration->member1_email }}</div>
                            </td>
                            <td class="py-4 px-4">
                                <span class="font-mono text-white">{{ $registration->transaction_id }}</span>
                            </td>
                            <td class="py-4 px-4 text-gray-300">
                                {{ $registration->created_at->format('M j, Y') }}
                                <div class="text-sm text-gray-400">{{ $registration->created_at->format('g:i A') }}</div>
                            </td>
                            <td class="py-4 px-4">
                                <select class="status-select bg-gray-800 border border-gray-600 rounded px-3 py-1 text-white" 
                                        data-team-id="{{ $registration->id }}" 
                                        data-current-status="{{ $registration->registration_status }}">
                                    <option value="pending" {{ $registration->registration_status === 'pending' ? 'selected' : '' }}>
                                        Pending
                                    </option>
                                    <option value="verified" {{ $registration->registration_status === 'verified' ? 'selected' : '' }}>
                                        Verified
                                    </option>
                                    <option value="rejected" {{ $registration->registration_status === 'rejected' ? 'selected' : '' }}>
                                        Rejected
                                    </option>
                                </select>
                            </td>
                            <td class="py-4 px-4">
                                <a href="{{ route('iiutpc.admin.team-details', $registration->id) }}" class="btn btn-sm btn-primary">
                                    <i class="bi bi-eye me-1"></i>
                                    View Details
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            @if($registrations->hasPages())
            <div class="mt-6">
                {{ $registrations->links() }}
            </div>
            @endif
            
            @else
            <div class="text-center py-12">
                <i class="bi bi-people text-6xl text-gray-600 mb-4"></i>
                <h4 class="text-xl font-semibold text-gray-400 mb-2">No registrations found</h4>
                <p class="text-gray-500">No teams have registered yet.</p>
            </div>
            @endif
        </div>

        <!-- Back to Home -->
        <div class="text-center mt-8">
            <a href="{{ route('iiutpc.home') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left me-2"></i>
                Back to Home
            </a>
        </div>
    </div>
</div>

<script>
// Status update functionality
document.addEventListener('DOMContentLoaded', function() {
    const statusSelects = document.querySelectorAll('.status-select');
    
    statusSelects.forEach(select => {
        select.addEventListener('change', function() {
            const teamId = this.dataset.teamId;
            const newStatus = this.value;
            const currentStatus = this.dataset.currentStatus;
            
            if (newStatus === currentStatus) return;
            
            // Show loading state
            this.disabled = true;
            
            fetch(`/ahiupc/admin/update-status/${teamId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    status: newStatus
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    this.dataset.currentStatus = newStatus;
                    
                    // Show success message
                    showNotification('Status updated successfully!', 'success');
                    
                    // Update row data attribute for filtering
                    const row = this.closest('.team-row');
                    row.dataset.status = newStatus;
                    
                    // Refresh page to update statistics
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                } else {
                    // Revert selection
                    this.value = currentStatus;
                    showNotification(data.error || 'Failed to update status', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                this.value = currentStatus;
                showNotification('Network error occurred', 'error');
            })
            .finally(() => {
                this.disabled = false;
            });
        });
    });
});

// Filter functionality
function filterTable(status) {
    const rows = document.querySelectorAll('.team-row');
    const buttons = document.querySelectorAll('.filter-btn');
    
    // Update button states
    buttons.forEach(btn => {
        btn.classList.remove('active');
        if (btn.dataset.filter === status) {
            btn.classList.add('active');
        }
    });
    
    // Show/hide rows
    rows.forEach(row => {
        if (status === 'all' || row.dataset.status === status) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}

// Notification system
function showNotification(message, type) {
    const notification = document.createElement('div');
    notification.className = `alert alert-${type} fixed top-4 right-4 z-50 max-w-sm`;
    notification.innerHTML = `
        <i class="bi bi-${type === 'success' ? 'check' : 'x'}-circle me-2"></i>
        ${message}
    `;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.remove();
    }, 3000);
}
</script>

<style>
.filter-btn.active {
    opacity: 1;
    transform: scale(1.05);
}

.filter-btn {
    opacity: 0.7;
    transition: all 0.2s ease;
}

.filter-btn:hover {
    opacity: 1;
}
</style>

@include('layouts.footer')
