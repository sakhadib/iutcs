@include('rough.iiutpc.header', ['eventName' => $eventName])

<div class="min-h-screen bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 py-12 px-4">
    <div class="container mx-auto max-w-5xl">
        <!-- Top Navigation -->
        <div class="mb-6">
            <a href="{{ route('iiutpc.admin') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left me-2"></i>
                Back to Dashboard
            </a>
        </div>
        
        <div class="text-center mb-8 animate-fade-in">
            <h1 class="text-4xl md:text-5xl font-bold header-gradient mb-4">
                Payment Verification
            </h1>
            <p class="text-gray-300 text-lg">
                Review payment and update status for {{ $registration->team_name }}
            </p>
        </div>

        <!-- Primary Action Card - Payment & Status -->
        <div class="card p-8 mb-6 bg-gradient-to-r from-blue-900/20 to-purple-900/20 border-blue-500/30">
            <div class="grid md:grid-cols-2 gap-8 items-center">
                <!-- Payment Information -->
                <div>
                    <h2 class="text-2xl font-bold text-white mb-4">Payment Details</h2>
                    <div class="space-y-4">
                        <div class="bg-gray-800/50 rounded-lg p-4">
                            <label class="block text-sm font-medium text-gray-400 mb-1">Transaction ID</label>
                            <p class="text-white font-mono text-2xl font-bold">{{ $registration->transaction_id }}</p>
                        </div>
                        <div class="bg-gray-800/50 rounded-lg p-4">
                            <label class="block text-sm font-medium text-gray-400 mb-1">Amount</label>
                            <p class="text-green-400 font-semibold text-xl">৳300</p>
                        </div>
                        <div class="bg-gray-800/50 rounded-lg p-4">
                            <label class="block text-sm font-medium text-gray-400 mb-1">Payment Method</label>
                            <p class="text-white">bKash - 01681365712</p>
                        </div>
                    </div>
                </div>

                <!-- Status Update -->
                <div>
                    <h2 class="text-2xl font-bold text-white mb-4">Update Status</h2>
                    
                    <!-- Current Status Display -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-400 mb-2">Current Status</label>
                        @if($registration->registration_status === 'verified')
                            <span class="badge badge-success text-xl px-6 py-3">
                                <i class="bi bi-check-circle me-2"></i>
                                Verified
                            </span>
                        @elseif($registration->registration_status === 'pending')
                            <span class="badge badge-warning text-xl px-6 py-3">
                                <i class="bi bi-clock me-2"></i>
                                Pending Verification
                            </span>
                        @else
                            <span class="badge badge-danger text-xl px-6 py-3">
                                <i class="bi bi-x-circle me-2"></i>
                                {{ ucfirst($registration->registration_status) }}
                            </span>
                        @endif
                    </div>

                    <!-- Status Update Buttons -->
                    <div class="space-y-3">
                        <label class="block text-sm font-medium text-gray-300 mb-3">Change Status To:</label>
                        
                        @if($registration->registration_status !== 'verified')
                        <button class="status-btn btn btn-success w-full" data-status="verified" data-team-id="{{ $registration->id }}">
                            <i class="bi bi-check-circle me-2"></i>
                            Verify Payment
                        </button>
                        @endif
                        
                        @if($registration->registration_status !== 'pending')
                        <button class="status-btn btn btn-warning w-full" data-status="pending" data-team-id="{{ $registration->id }}">
                            <i class="bi bi-clock me-2"></i>
                            Mark as Pending
                        </button>
                        @endif
                        
                        @if($registration->registration_status !== 'rejected')
                        <button class="status-btn btn btn-danger w-full" data-status="rejected" data-team-id="{{ $registration->id }}">
                            <i class="bi bi-x-circle me-2"></i>
                            Reject Payment
                        </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Team Summary Card -->
        <div class="card p-6 mb-6">
            <h3 class="text-xl font-semibold text-white mb-4">Team Summary</h3>
            <div class="grid md:grid-cols-3 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-1">Team Name</label>
                    <p class="text-white font-semibold text-lg">{{ $registration->team_name }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-1">Registration Token</label>
                    <p class="text-white font-mono">{{ $registration->registration_token }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-1">Registered On</label>
                    <p class="text-gray-300">{{ $registration->created_at->format('M j, Y g:i A') }}</p>
                </div>
            </div>
        </div>

        <!-- Team Members (Collapsible) -->
        <div class="card p-6 mb-6">
            <button class="flex items-center justify-between w-full text-left" onclick="toggleTeamDetails()">
                <h3 class="text-xl font-semibold text-white">Team Members Details</h3>
                <i class="bi bi-chevron-down text-gray-400 transition-transform" id="chevron-icon"></i>
            </button>
            
            <div id="team-details" class="hidden mt-6 space-y-4">
                <!-- Member 1 -->
                <div class="bg-gray-800/30 rounded-lg p-4">
                    <h4 class="font-semibold text-white mb-3 flex items-center">
                        <i class="bi bi-person-fill text-primary me-2"></i>
                        Team Lead
                    </h4>
                    <div class="grid md:grid-cols-3 gap-3 text-sm">
                        <div>
                            <span class="text-gray-400">Name:</span>
                            <span class="text-white ml-1">{{ $registration->member1_name }}</span>
                        </div>
                        <div>
                            <span class="text-gray-400">Email:</span>
                            <span class="text-white ml-1">{{ $registration->member1_email }}</span>
                        </div>
                        <div>
                            <span class="text-gray-400">Student ID:</span>
                            <span class="text-white ml-1">{{ $registration->member1_student_id }}</span>
                        </div>
                        <div>
                            <span class="text-gray-400">Department:</span>
                            <span class="text-white ml-1">{{ $registration->member1_department }}</span>
                        </div>
                        <div>
                            <span class="text-gray-400">Program:</span>
                            <span class="text-white ml-1">{{ $registration->member1_program }}</span>
                        </div>
                        <div>
                            <span class="text-gray-400">Phone:</span>
                            <span class="text-white ml-1">{{ $registration->member1_phone ?: 'N/A' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Member 2 -->
                <div class="bg-gray-800/30 rounded-lg p-4">
                    <h4 class="font-semibold text-white mb-3 flex items-center">
                        <i class="bi bi-person-fill text-secondary me-2"></i>
                        Member 2
                    </h4>
                    <div class="grid md:grid-cols-3 gap-3 text-sm">
                        <div>
                            <span class="text-gray-400">Name:</span>
                            <span class="text-white ml-1">{{ $registration->member2_name }}</span>
                        </div>
                        <div>
                            <span class="text-gray-400">Email:</span>
                            <span class="text-white ml-1">{{ $registration->member2_email }}</span>
                        </div>
                        <div>
                            <span class="text-gray-400">Student ID:</span>
                            <span class="text-white ml-1">{{ $registration->member2_student_id }}</span>
                        </div>
                        <div>
                            <span class="text-gray-400">Department:</span>
                            <span class="text-white ml-1">{{ $registration->member2_department }}</span>
                        </div>
                        <div>
                            <span class="text-gray-400">Program:</span>
                            <span class="text-white ml-1">{{ $registration->member2_program }}</span>
                        </div>
                        <div>
                            <span class="text-gray-400">Phone:</span>
                            <span class="text-white ml-1">{{ $registration->member2_phone ?: 'N/A' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Member 3 -->
                <div class="bg-gray-800/30 rounded-lg p-4">
                    <h4 class="font-semibold text-white mb-3 flex items-center">
                        <i class="bi bi-person-fill text-warning me-2"></i>
                        Member 3
                    </h4>
                    <div class="grid md:grid-cols-3 gap-3 text-sm">
                        <div>
                            <span class="text-gray-400">Name:</span>
                            <span class="text-white ml-1">{{ $registration->member3_name }}</span>
                        </div>
                        <div>
                            <span class="text-gray-400">Email:</span>
                            <span class="text-white ml-1">{{ $registration->member3_email }}</span>
                        </div>
                        <div>
                            <span class="text-gray-400">Student ID:</span>
                            <span class="text-white ml-1">{{ $registration->member3_student_id }}</span>
                        </div>
                        <div>
                            <span class="text-gray-400">Department:</span>
                            <span class="text-white ml-1">{{ $registration->member3_department }}</span>
                        </div>
                        <div>
                            <span class="text-gray-400">Program:</span>
                            <span class="text-white ml-1">{{ $registration->member3_program }}</span>
                        </div>
                        <div>
                            <span class="text-gray-400">Phone:</span>
                            <span class="text-white ml-1">{{ $registration->member3_phone ?: 'N/A' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-col md:flex-row gap-4 justify-center">
            <a href="{{ route('iiutpc.admin') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left me-2"></i>
                Back to Dashboard
            </a>
        </div>
    </div>
</div>

<!-- Confirmation Modal -->
<div id="confirmationModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center">
    <div class="bg-gray-800 rounded-lg shadow-xl max-w-md w-full mx-4 animate-fade-in">
        <div class="p-6">
            <div class="flex items-center mb-4">
                <div class="w-12 h-12 rounded-full bg-yellow-500/20 flex items-center justify-center mr-4">
                    <i class="bi bi-exclamation-triangle text-yellow-500 text-xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-white">Confirm Status Change</h3>
            </div>
            
            <p class="text-gray-300 mb-6" id="confirmationMessage">
                Are you sure you want to update this team's registration status?
            </p>
            
            <div class="flex gap-3 justify-end">
                <button onclick="closeConfirmationModal()" class="btn btn-secondary">
                    <i class="bi bi-x me-2"></i>
                    Cancel
                </button>
                <button id="confirmButton" onclick="confirmStatusUpdate()" class="btn btn-primary">
                    <i class="bi bi-check me-2"></i>
                    Confirm
                </button>
            </div>
        </div>
    </div>
</div>

<script>
// Global variables for modal functionality
let pendingStatusUpdate = null;

// Toggle team details visibility
function toggleTeamDetails() {
    const details = document.getElementById('team-details');
    const chevron = document.getElementById('chevron-icon');
    
    if (details.classList.contains('hidden')) {
        details.classList.remove('hidden');
        chevron.style.transform = 'rotate(180deg)';
    } else {
        details.classList.add('hidden');
        chevron.style.transform = 'rotate(0deg)';
    }
}

// Modal functions
function showConfirmationModal(teamId, status, message) {
    const modal = document.getElementById('confirmationModal');
    const messageElement = document.getElementById('confirmationMessage');
    const confirmButton = document.getElementById('confirmButton');
    
    // Store the pending update
    pendingStatusUpdate = { teamId, status };
    
    // Update modal content
    messageElement.textContent = message;
    
    // Update confirm button style based on action
    confirmButton.className = 'btn btn-primary';
    if (status === 'verified') {
        confirmButton.className = 'btn btn-success';
        confirmButton.innerHTML = '<i class="bi bi-check me-2"></i>Verify';
    } else if (status === 'rejected') {
        confirmButton.className = 'btn btn-danger';
        confirmButton.innerHTML = '<i class="bi bi-x me-2"></i>Reject';
    } else {
        confirmButton.className = 'btn btn-warning';
        confirmButton.innerHTML = '<i class="bi bi-clock me-2"></i>Set Pending';
    }
    
    // Show modal
    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeConfirmationModal() {
    const modal = document.getElementById('confirmationModal');
    modal.classList.add('hidden');
    document.body.style.overflow = 'auto';
    pendingStatusUpdate = null;
}

function confirmStatusUpdate() {
    if (!pendingStatusUpdate) return;
    
    const { teamId, status } = pendingStatusUpdate;
    const confirmButton = document.getElementById('confirmButton');
    
    // Show loading state
    const originalText = confirmButton.innerHTML;
    confirmButton.disabled = true;
    confirmButton.innerHTML = '<i class="bi bi-hourglass-split me-2"></i>Updating...';
    
    fetch(`/ahiupc/admin/update-status/${teamId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            status: status
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Close modal
            closeConfirmationModal();
            
            // Show success message
            showNotification(`Team status updated to ${status}!`, 'success');
            
            // Refresh page to update UI
            setTimeout(() => {
                location.reload();
            }, 1500);
        } else {
            // Restore button
            confirmButton.innerHTML = originalText;
            confirmButton.disabled = false;
            showNotification(data.error || 'Failed to update status', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        confirmButton.innerHTML = originalText;
        confirmButton.disabled = false;
        showNotification('Network error occurred', 'error');
    });
}

// Status update functionality
document.addEventListener('DOMContentLoaded', function() {
    const statusButtons = document.querySelectorAll('.status-btn');
    
    statusButtons.forEach(button => {
        button.addEventListener('click', function() {
            const teamId = this.dataset.teamId;
            const newStatus = this.dataset.status;
            
            // Create confirmation message based on status
            let message = '';
            let actionText = '';
            
            switch(newStatus) {
                case 'verified':
                    message = 'Are you sure you want to verify this team\'s payment? This will confirm their registration.';
                    actionText = 'verify';
                    break;
                case 'rejected':
                    message = 'Are you sure you want to reject this team\'s payment? This will cancel their registration.';
                    actionText = 'reject';
                    break;
                case 'pending':
                    message = 'Are you sure you want to mark this team as pending? This will require further review.';
                    actionText = 'mark as pending';
                    break;
                default:
                    message = `Are you sure you want to ${newStatus} this team's registration?`;
                    actionText = newStatus;
            }
            
            // Show custom modal instead of alert
            showConfirmationModal(teamId, newStatus, message);
        });
    });
    
    // Close modal when clicking outside
    document.getElementById('confirmationModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeConfirmationModal();
        }
    });
    
    // Close modal on escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeConfirmationModal();
        }
    });
});

// Notification system
function showNotification(message, type) {
    const notification = document.createElement('div');
    notification.className = `alert alert-${type} fixed top-4 right-4 z-50 max-w-sm shadow-lg`;
    notification.innerHTML = `
        <i class="bi bi-${type === 'success' ? 'check' : 'x'}-circle me-2"></i>
        ${message}
    `;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.remove();
    }, 4000);
}
</script>

<style>
.status-btn {
    transition: all 0.3s ease;
}

.status-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
}

.status-btn:disabled {
    opacity: 0.6;
    transform: none;
    cursor: not-allowed;
}

#chevron-icon {
    transition: transform 0.3s ease;
}

/* Modal animations */
.animate-fade-in {
    animation: fadeIn 0.3s ease-out;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: scale(0.9);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}

/* Modal backdrop */
#confirmationModal {
    backdrop-filter: blur(4px);
    transition: all 0.3s ease;
}

#confirmationModal.hidden {
    opacity: 0;
    pointer-events: none;
}

#confirmationModal:not(.hidden) {
    opacity: 1;
    pointer-events: auto;
}
</style>

@include('layouts.footer')
