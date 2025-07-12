<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CodeSprint 2025 - Registration Details</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/codesprint-style.css') }}">
</head>
<body>
    @include('layouts.dangling_header')
    
    <div class="container mx-auto px-4 py-12 max-w-6xl">
        <!-- Header -->
        <header class="mb-12 pt-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-4xl font-bold mb-2 header-gradient">
                        {{ $registration->team_name }}
                    </h1>
                    <p class="text-xl text-gray-300">Registration Details & Management</p>
                </div>
                <div class="flex space-x-4">
                    <a href="{{ route('admin.codesprint.registrations') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-2"></i>
                        Back to List
                    </a>
                    <button onclick="openStatusModal()" class="btn btn-primary">
                        <i class="bi bi-pencil me-2"></i>
                        Update Status
                    </button>
                </div>
            </div>
        </header>

        <!-- Alerts -->
        @if(session('success'))
            <div class="alert alert-success animate-fade-in">
                <i class="bi bi-check-circle me-2"></i>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error animate-fade-in">
                <i class="bi bi-exclamation-triangle me-2"></i>
                {{ session('error') }}
            </div>
        @endif

        <!-- Status Overview -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-12">
            <div class="card p-6 text-center">
                <div class="w-16 h-16 mx-auto mb-4 rounded-full flex items-center justify-center 
                            {{ $registration->payment_status === 'verified' ? 'bg-green-900/30' : ($registration->payment_status === 'pending' ? 'bg-yellow-900/30' : 'bg-red-900/30') }}">
                    <i class="bi {{ $registration->payment_status === 'verified' ? 'bi-check-circle text-green-400' : ($registration->payment_status === 'pending' ? 'bi-clock text-yellow-400' : 'bi-x-circle text-red-400') }} text-2xl"></i>
                </div>
                <h3 class="font-bold text-lg mb-2">Payment Status</h3>
                <span class="badge {{ $registration->payment_status === 'verified' ? 'badge-success' : ($registration->payment_status === 'pending' ? 'badge-warning' : 'badge-danger') }}">
                    {{ ucfirst($registration->payment_status) }}
                </span>
            </div>
            
            <div class="card p-6 text-center">
                <div class="w-16 h-16 mx-auto mb-4 rounded-full flex items-center justify-center 
                            {{ $registration->registration_status === 'active' ? 'bg-green-900/30' : 'bg-red-900/30' }}">
                    <i class="bi {{ $registration->registration_status === 'active' ? 'bi-check-circle text-green-400' : 'bi-x-circle text-red-400' }} text-2xl"></i>
                </div>
                <h3 class="font-bold text-lg mb-2">Registration Status</h3>
                <span class="badge {{ $registration->registration_status === 'active' ? 'badge-success' : 'badge-danger' }}">
                    {{ ucfirst($registration->registration_status) }}
                </span>
            </div>
            
            <div class="card p-6 text-center">
                <div class="w-16 h-16 mx-auto mb-4 rounded-full flex items-center justify-center 
                            {{ $registration->github_repo_url ? 'bg-green-900/30' : 'bg-gray-900/30' }}">
                    <i class="bi {{ $registration->github_repo_url ? 'bi-github text-green-400' : 'bi-github text-gray-400' }} text-2xl"></i>
                </div>
                <h3 class="font-bold text-lg mb-2">GitHub Repo</h3>
                <span class="badge {{ $registration->github_repo_url ? 'badge-success' : 'badge-warning' }}">
                    {{ $registration->github_repo_url ? 'Submitted' : 'Pending' }}
                </span>
            </div>
            
            <div class="card p-6 text-center">
                <div class="w-16 h-16 mx-auto mb-4 rounded-full flex items-center justify-center 
                            {{ $registration->selected_for_presentation ? 'bg-purple-900/30' : 'bg-gray-900/30' }}">
                    <i class="bi {{ $registration->selected_for_presentation ? 'bi-trophy text-purple-400' : 'bi-trophy text-gray-400' }} text-2xl"></i>
                </div>
                <h3 class="font-bold text-lg mb-2">Presentation</h3>
                <span class="badge {{ $registration->selected_for_presentation ? 'badge-info' : 'badge-warning' }}">
                    {{ $registration->selected_for_presentation ? 'Selected' : 'Not Selected' }}
                </span>
            </div>
        </div>

        <!-- Basic Information -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12">
            <div class="card p-8">
                <div class="flex items-center mb-6">
                    <div class="icon-container">
                        <i class="bi bi-info-circle text-indigo-400"></i>
                    </div>
                    <h2 class="text-2xl font-bold section-title">Basic Information</h2>
                </div>
                
                <div class="space-y-4">
                    <div class="flex justify-between">
                        <span class="text-gray-400">Team Name:</span>
                        <span class="font-semibold">{{ $registration->team_name }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">Team Size:</span>
                        <span class="font-semibold">{{ $registration->team_size }} member{{ $registration->team_size > 1 ? 's' : '' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">Registration Date:</span>
                        <span class="font-semibold">{{ $registration->created_at->format('M d, Y H:i') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">Registration Token:</span>
                        <span class="font-mono text-lg font-bold text-indigo-400">{{ $registration->registration_token }}</span>
                    </div>
                    @if($registration->contact_phone)
                    <div class="flex justify-between">
                        <span class="text-gray-400">Contact Phone:</span>
                        <span class="font-semibold">{{ $registration->contact_phone }}</span>
                    </div>
                    @endif
                </div>
            </div>

            <div class="card p-8">
                <div class="flex items-center mb-6">
                    <div class="icon-container">
                        <i class="bi bi-credit-card text-emerald-400"></i>
                    </div>
                    <h2 class="text-2xl font-bold section-title">Payment Information</h2>
                </div>
                
                <div class="space-y-4">
                    <div class="flex justify-between">
                        <span class="text-gray-400">Transaction ID:</span>
                        <span class="font-semibold">{{ $registration->transaction_id }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">Amount:</span>
                        <span class="font-semibold">{{ $registration->payment_amount }} Taka</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">Payment Date:</span>
                        <span class="font-semibold">{{ $registration->payment_date ? $registration->payment_date->format('M d, Y H:i') : 'N/A' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">Status:</span>
                        <span class="badge {{ $registration->payment_status === 'verified' ? 'badge-success' : ($registration->payment_status === 'pending' ? 'badge-warning' : 'badge-danger') }}">
                            {{ ucfirst($registration->payment_status) }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Team Members -->
        <div class="card p-8 mb-12">
            <div class="flex items-center mb-6">
                <div class="icon-container">
                    <i class="bi bi-people text-cyan-400"></i>
                </div>
                <h2 class="text-2xl font-bold section-title">Team Members</h2>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-{{ $registration->team_size }} gap-6">
                <!-- Member 1 (Leader) -->
                <div class="card p-6">
                    <div class="flex items-center mb-4">
                        <i class="bi bi-person-badge text-indigo-400 text-xl me-2"></i>
                        <h3 class="font-bold text-lg">Team Leader</h3>
                    </div>
                    <div class="space-y-2 text-sm">
                        <div><strong>Name:</strong> {{ $registration->member1_name }}</div>
                        <div><strong>Email:</strong> <a href="mailto:{{ $registration->member1_email }}" class="text-indigo-400 hover:text-indigo-300">{{ $registration->member1_email }}</a></div>
                        <div><strong>Student ID:</strong> {{ $registration->member1_student_id }}</div>
                        <div><strong>Department:</strong> {{ $registration->member1_department }}</div>
                        <div><strong>Year:</strong> {{ $registration->member1_year }}</div>
                    </div>
                </div>

                <!-- Member 2 -->
                @if($registration->member2_name)
                <div class="card p-6">
                    <div class="flex items-center mb-4">
                        <i class="bi bi-person text-emerald-400 text-xl me-2"></i>
                        <h3 class="font-bold text-lg">Member 2</h3>
                    </div>
                    <div class="space-y-2 text-sm">
                        <div><strong>Name:</strong> {{ $registration->member2_name }}</div>
                        <div><strong>Email:</strong> <a href="mailto:{{ $registration->member2_email }}" class="text-indigo-400 hover:text-indigo-300">{{ $registration->member2_email }}</a></div>
                        <div><strong>Student ID:</strong> {{ $registration->member2_student_id }}</div>
                        <div><strong>Department:</strong> {{ $registration->member2_department }}</div>
                        <div><strong>Year:</strong> {{ $registration->member2_year }}</div>
                    </div>
                </div>
                @endif

                <!-- Member 3 -->
                @if($registration->member3_name)
                <div class="card p-6">
                    <div class="flex items-center mb-4">
                        <i class="bi bi-person text-violet-400 text-xl me-2"></i>
                        <h3 class="font-bold text-lg">Member 3</h3>
                    </div>
                    <div class="space-y-2 text-sm">
                        <div><strong>Name:</strong> {{ $registration->member3_name }}</div>
                        <div><strong>Email:</strong> <a href="mailto:{{ $registration->member3_email }}" class="text-indigo-400 hover:text-indigo-300">{{ $registration->member3_email }}</a></div>
                        <div><strong>Student ID:</strong> {{ $registration->member3_student_id }}</div>
                        <div><strong>Department:</strong> {{ $registration->member3_department }}</div>
                        <div><strong>Year:</strong> {{ $registration->member3_year }}</div>
                    </div>
                </div>
                @endif
            </div>
        </div>

        <!-- Project Submissions -->
        @if($registration->github_repo_url || $registration->project_submitted_at)
        <div class="card p-8 mb-12">
            <div class="flex items-center mb-6">
                <div class="icon-container">
                    <i class="bi bi-file-earmark-code text-purple-400"></i>
                </div>
                <h2 class="text-2xl font-bold section-title">Project Submissions</h2>
            </div>
            
            @if($registration->github_repo_url)
            <div class="mb-8">
                <h3 class="font-bold text-lg mb-4 flex items-center">
                    <i class="bi bi-github me-2"></i>
                    GitHub Repository
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <strong class="text-gray-300">Repository URL:</strong>
                        <a href="{{ $registration->github_repo_url }}" target="_blank" class="text-indigo-400 hover:text-indigo-300 break-all">
                            {{ $registration->github_repo_url }}
                        </a>
                    </div>
                    <div>
                        <strong class="text-gray-300">Submitted:</strong>
                        <span>{{ $registration->github_submitted_at->format('M d, Y H:i') }}</span>
                    </div>
                </div>
            </div>
            @endif
            
            @if($registration->project_submitted_at)
            <div>
                <h3 class="font-bold text-lg mb-4 flex items-center">
                    <i class="bi bi-file-earmark-zip me-2"></i>
                    Final Project
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        @if($registration->project_zip_path)
                        <div>
                            <strong class="text-gray-300">Project ZIP:</strong>
                            <a href="{{ $registration->project_zip_path }}" target="_blank" class="text-indigo-400 hover:text-indigo-300 break-all">
                                View Project Files
                            </a>
                        </div>
                        @endif
                        
                        @if($registration->video_submission_url)
                        <div>
                            <strong class="text-gray-300">Demo Video:</strong>
                            <a href="{{ $registration->video_submission_url }}" target="_blank" class="text-indigo-400 hover:text-indigo-300 break-all">
                                View Demo Video
                            </a>
                        </div>
                        @endif
                        
                        @if($registration->deployment_url)
                        <div>
                            <strong class="text-gray-300">Live Demo:</strong>
                            <a href="{{ $registration->deployment_url }}" target="_blank" class="text-indigo-400 hover:text-indigo-300 break-all">
                                {{ $registration->deployment_url }}
                            </a>
                        </div>
                        @endif
                    </div>
                    
                    <div class="space-y-4">
                        @if($registration->technologies_used)
                        <div>
                            <strong class="text-gray-300">Technologies Used:</strong>
                            <p>{{ $registration->technologies_used }}</p>
                        </div>
                        @endif
                        
                        <div>
                            <strong class="text-gray-300">Uses AI/ML:</strong>
                            <span class="badge {{ $registration->uses_ai_ml ? 'badge-info' : 'badge-warning' }}">
                                {{ $registration->uses_ai_ml ? 'Yes' : 'No' }}
                            </span>
                        </div>
                        
                        <div>
                            <strong class="text-gray-300">Submitted:</strong>
                            <span>{{ $registration->project_submitted_at->format('M d, Y H:i') }}</span>
                        </div>
                    </div>
                </div>
                
                @if($registration->project_description)
                <div class="mt-6">
                    <strong class="text-gray-300">Project Description:</strong>
                    <p class="mt-2 p-4 rounded-lg" style="background: rgba(255, 255, 255, 0.05);">
                        {{ $registration->project_description }}
                    </p>
                </div>
                @endif
                
                @if($registration->team_notes)
                <div class="mt-4">
                    <strong class="text-gray-300">Team Notes:</strong>
                    <p class="mt-2 p-4 rounded-lg" style="background: rgba(255, 255, 255, 0.05);">
                        {{ $registration->team_notes }}
                    </p>
                </div>
                @endif
            </div>
            @endif
        </div>
        @endif

        <!-- Admin Notes -->
        @if($registration->admin_notes)
        <div class="card p-8 mb-12">
            <div class="flex items-center mb-6">
                <div class="icon-container">
                    <i class="bi bi-sticky text-amber-400"></i>
                </div>
                <h2 class="text-2xl font-bold section-title">Admin Notes</h2>
            </div>
            <p class="p-4 rounded-lg" style="background: rgba(255, 255, 255, 0.05);">
                {{ $registration->admin_notes }}
            </p>
        </div>
        @endif

        <!-- Danger Zone -->
        <div class="card p-8 border border-red-500/30">
            <div class="flex items-center mb-6">
                <div class="icon-container">
                    <i class="bi bi-exclamation-triangle text-red-400"></i>
                </div>
                <h2 class="text-2xl font-bold section-title text-red-400">Danger Zone</h2>
            </div>
            
            <div class="flex justify-between items-center">
                <div>
                    <h3 class="font-bold text-lg text-white mb-2">Delete Registration</h3>
                    <p class="text-gray-400">This action cannot be undone. All registration data will be permanently deleted.</p>
                </div>
                <button onclick="confirmDelete()" class="btn btn-danger">
                    <i class="bi bi-trash me-2"></i>
                    Delete Registration
                </button>
            </div>
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
                
                <form action="{{ route('admin.codesprint.registration.status', $registration->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium mb-2 text-gray-300">Payment Status</label>
                            <select name="payment_status" class="form-select w-full">
                                <option value="pending" {{ $registration->payment_status === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="verified" {{ $registration->payment_status === 'verified' ? 'selected' : '' }}>Verified</option>
                                <option value="rejected" {{ $registration->payment_status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium mb-2 text-gray-300">Registration Status</label>
                            <select name="registration_status" class="form-select w-full">
                                <option value="active" {{ $registration->registration_status === 'active' ? 'selected' : '' }}>Active</option>
                                <option value="disqualified" {{ $registration->registration_status === 'disqualified' ? 'selected' : '' }}>Disqualified</option>
                                <option value="withdrawn" {{ $registration->registration_status === 'withdrawn' ? 'selected' : '' }}>Withdrawn</option>
                            </select>
                        </div>
                    </div>
                    
                    <div>
                        <label class="flex items-center">
                            <input type="checkbox" name="selected_for_presentation" value="1" 
                                   {{ $registration->selected_for_presentation ? 'checked' : '' }} class="me-2">
                            <span class="text-gray-300">Selected for presentation</span>
                        </label>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium mb-2 text-gray-300">Admin Notes</label>
                        <textarea name="admin_notes" rows="3" class="form-textarea w-full" placeholder="Optional admin notes...">{{ $registration->admin_notes }}</textarea>
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
        function openStatusModal() {
            document.getElementById('statusModal').classList.remove('hidden');
        }

        function closeStatusModal() {
            document.getElementById('statusModal').classList.add('hidden');
        }

        function confirmDelete() {
            if (confirm('Are you sure you want to delete this registration? This action cannot be undone.')) {
                // Create and submit delete form
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '{{ route("admin.codesprint.registration.delete", $registration->id) }}';
                
                const csrfToken = document.createElement('input');
                csrfToken.type = 'hidden';
                csrfToken.name = '_token';
                csrfToken.value = '{{ csrf_token() }}';
                
                const methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'DELETE';
                
                form.appendChild(csrfToken);
                form.appendChild(methodInput);
                document.body.appendChild(form);
                form.submit();
            }
        }

        // Close modal when clicking outside
        document.getElementById('statusModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeStatusModal();
            }
        });
    </script>
</body>
</html>
