<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CodeSprint 2025 - Registration Status</title>
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
            <div class="text-center">
                <div class="inline-block mb-4 px-6 py-2 bg-indigo-900/30 border border-indigo-700/50 rounded-full">
                    <span class="text-indigo-300 text-sm font-medium">Registration Token: </span>
                    <span class="text-indigo-100 font-mono text-lg font-bold tracking-wider">{{ $registration->registration_token }}</span>
                </div>
                <h1 class="text-4xl sm:text-5xl font-bold mb-4 header-gradient">
                    Team Status: {{ $registration->team_name }}
                </h1>
                <p class="text-xl max-w-2xl mx-auto text-gray-300">Track your registration and submission progress</p>
            </div>
        </header>

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
                            {{ $registration->project_submitted_at ? 'bg-green-900/30' : 'bg-gray-900/30' }}">
                    <i class="bi {{ $registration->project_submitted_at ? 'bi-file-earmark-zip text-green-400' : 'bi-file-earmark-zip text-gray-400' }} text-2xl"></i>
                </div>
                <h3 class="font-bold text-lg mb-2">Final Project</h3>
                <span class="badge {{ $registration->project_submitted_at ? 'badge-success' : 'badge-warning' }}">
                    {{ $registration->project_submitted_at ? 'Submitted' : 'Pending' }}
                </span>
            </div>
            
            <div class="card p-6 text-center">
                <div class="w-16 h-16 mx-auto mb-4 rounded-full flex items-center justify-center 
                            {{ $registration->selected_for_presentation ? 'bg-purple-900/30' : 'bg-gray-900/30' }}">
                    <i class="bi {{ $registration->selected_for_presentation ? 'bi-trophy text-purple-400' : 'bi-trophy text-gray-400' }} text-2xl"></i>
                </div>
                <h3 class="font-bold text-lg mb-2">Presentation</h3>
                <span class="badge {{ $registration->selected_for_presentation ? 'badge-info' : 'badge-warning' }}">
                    {{ $registration->selected_for_presentation ? 'Selected' : 'TBD' }}
                </span>
            </div>
        </div>

        <!-- Team Information -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12">
            <div class="card p-8">
                <div class="flex items-center mb-6">
                    <div class="icon-container">
                        <i class="bi bi-people text-indigo-400"></i>
                    </div>
                    <h2 class="text-2xl font-bold section-title">Team Details</h2>
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
                        <span class="font-semibold">{{ $registration->created_at->format('M d, Y') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">Registration Status:</span>
                        <span class="badge {{ $registration->registration_status === 'active' ? 'badge-success' : 'badge-danger' }}">
                            {{ ucfirst($registration->registration_status) }}
                        </span>
                    </div>
                    @if($registration->contact_phone)
                    <div class="flex justify-between">
                        <span class="text-gray-400">Contact:</span>
                        <span class="font-semibold">{{ $registration->contact_phone }}</span>
                    </div>
                    @endif
                </div>
            </div>

            <div class="card p-8">
                <div class="flex items-center mb-6">
                    <div class="icon-container">
                        <i class="bi bi-calendar-event text-emerald-400"></i>
                    </div>
                    <h2 class="text-2xl font-bold section-title">Important Deadlines</h2>
                </div>
                
                <div class="space-y-4">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-400">GitHub Submission:</span>
                        <div class="text-right">
                            <div class="font-semibold">July 22, 2025 6:00 PM</div>
                            @php
                                $now = now();
                                $githubDeadline = \Carbon\Carbon::create(2025, 7, 22, 18, 0, 0);
                            @endphp
                            @if($now > $githubDeadline)
                                <span class="badge badge-danger text-xs">Deadline Passed</span>
                            @else
                                @php
                                    $diff = $now->diff($githubDeadline);
                                    $timeLeft = '';
                                    if ($diff->days > 0) {
                                        $timeLeft = $diff->days . ' days';
                                    } elseif ($diff->h > 0) {
                                        $timeLeft = $diff->h . ' hours';
                                    } else {
                                        $timeLeft = $diff->i . ' minutes';
                                    }
                                @endphp
                                <span class="badge badge-warning text-xs">{{ $timeLeft }} left</span>
                            @endif
                        </div>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-400">Final Submission:</span>
                        <div class="text-right">
                            <div class="font-semibold">July 30, 2025 11:59 PM</div>
                            @php
                                $projectDeadline = \Carbon\Carbon::create(2025, 7, 30, 23, 59, 0);
                            @endphp
                            @if($now > $projectDeadline)
                                <span class="badge badge-danger text-xs">Deadline Passed</span>
                            @else
                                @php
                                    $diff = $now->diff($projectDeadline);
                                    $timeLeft = '';
                                    if ($diff->days > 0) {
                                        $timeLeft = $diff->days . ' days';
                                    } elseif ($diff->h > 0) {
                                        $timeLeft = $diff->h . ' hours';
                                    } else {
                                        $timeLeft = $diff->i . ' minutes';
                                    }
                                @endphp
                                <span class="badge badge-warning text-xs">{{ $timeLeft }} left</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Team Members -->
        <div class="card p-8 mb-12">
            <div class="flex items-center mb-6">
                <div class="icon-container">
                    <i class="bi bi-person-lines-fill text-cyan-400"></i>
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
                        <div><strong>Email:</strong> {{ $registration->member1_email }}</div>
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
                        <div><strong>Email:</strong> {{ $registration->member2_email }}</div>
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
                        <div><strong>Email:</strong> {{ $registration->member3_email }}</div>
                        <div><strong>Student ID:</strong> {{ $registration->member3_student_id }}</div>
                        <div><strong>Department:</strong> {{ $registration->member3_department }}</div>
                        <div><strong>Year:</strong> {{ $registration->member3_year }}</div>
                    </div>
                </div>
                @endif
            </div>
        </div>

        <!-- Submission Forms -->
        @if($registration->payment_status === 'verified' && $registration->registration_status === 'active')
            @php
                $now = now();
                $githubDeadline = \Carbon\Carbon::create(2025, 7, 22, 18, 0, 0);
                $projectDeadline = \Carbon\Carbon::create(2025, 7, 30, 23, 59, 0);
            @endphp
            @if($now <= $githubDeadline && !$registration->github_repo_url)
            <!-- GitHub Submission Form -->
            <div class="card p-8 mb-8">
                <div class="flex items-center mb-6">
                    <div class="icon-container">
                        <i class="bi bi-github text-purple-400"></i>
                    </div>
                    <h2 class="text-2xl font-bold section-title">Submit GitHub Repository</h2>
                </div>
                
                <form action="{{ route('codesprint.github.submit') }}" method="POST" class="space-y-6">
                    @csrf
                    <input type="hidden" name="registration_token" value="{{ $registration->registration_token }}">
                    
                    <div>
                        <label class="block text-sm font-medium mb-2 text-gray-300" for="github_repo_url">GitHub Repository URL *</label>
                        <input type="url" id="github_repo_url" name="github_repo_url" 
                               class="form-input w-full" placeholder="https://github.com/username/repository" required>
                        <p class="text-sm text-gray-400 mt-1">Make sure your repository is public and contains your project</p>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-upload me-2"></i>
                        Submit GitHub Repository
                    </button>
                </form>
            </div>
            @endif

            @if($now <= $projectDeadline && $registration->github_repo_url && !$registration->project_submitted_at)
            <!-- Final Project Submission Button -->
            <div class="card p-8 mb-8">
                <div class="flex items-center mb-6">
                    <div class="icon-container">
                        <i class="bi bi-file-earmark-zip text-amber-400"></i>
                    </div>
                    <h2 class="text-2xl font-bold section-title">Submit Final Project</h2>
                </div>
                
                <div class="text-center">
                    <p class="text-gray-300 mb-6">
                        Your GitHub repository has been submitted successfully. Now it's time to submit your final project with demo video and complete documentation.
                    </p>
                    
                    <a href="{{ route('codesprint.project.form') }}" class="btn btn-success btn-lg">
                        <i class="bi bi-upload me-2"></i>
                        Submit Final Project
                    </a>
                    
                    <div class="mt-4 text-sm text-gray-400">
                        <p>You'll need to provide:</p>
                        <ul class="list-disc list-inside mt-2 space-y-1">
                            <li>Project ZIP file URL (Google Drive/Dropbox)</li>
                            <li>Demo video URL (YouTube/Google Drive)</li>
                            <li>Detailed project description</li>
                            <li>Technologies used</li>
                            <li>Optional: Live deployment URL</li>
                        </ul>
                    </div>
                </div>
            </div>
            @endif
        @endif

        <!-- Submitted Information -->
        @if($registration->github_repo_url || $registration->project_submitted_at)
        <div class="card p-8 mb-8">
            <div class="flex items-center mb-6">
                <div class="icon-container">
                    <i class="bi bi-check-square text-green-400"></i>
                </div>
                <h2 class="text-2xl font-bold section-title">Submitted Information</h2>
            </div>
            
            @if($registration->github_repo_url)
            <div class="mb-6">
                <h3 class="font-bold text-lg mb-2">GitHub Repository</h3>
                <a href="{{ $registration->github_repo_url }}" target="_blank" class="text-indigo-400 hover:text-indigo-300">
                    {{ $registration->github_repo_url }}
                </a>
                <p class="text-sm text-gray-400">Submitted: {{ $registration->github_submitted_at->format('M d, Y H:i') }}</p>
            </div>
            @endif
            
            @if($registration->project_submitted_at)
            <div class="space-y-4">
                <h3 class="font-bold text-lg">Final Project Details</h3>
                
                @if($registration->project_description)
                <div>
                    <strong class="text-gray-300">Description:</strong>
                    <p class="mt-1">{{ $registration->project_description }}</p>
                </div>
                @endif
                
                @if($registration->technologies_used)
                <div>
                    <strong class="text-gray-300">Technologies:</strong>
                    <p class="mt-1">{{ $registration->technologies_used }}</p>
                </div>
                @endif
                
                @if($registration->deployment_url)
                <div>
                    <strong class="text-gray-300">Live Demo:</strong>
                    <a href="{{ $registration->deployment_url }}" target="_blank" class="text-indigo-400 hover:text-indigo-300 ml-2">
                        {{ $registration->deployment_url }}
                    </a>
                </div>
                @endif
                
                <div>
                    <strong class="text-gray-300">Uses AI/ML:</strong>
                    <span class="ml-2 badge {{ $registration->uses_ai_ml ? 'badge-info' : 'badge-warning' }}">
                        {{ $registration->uses_ai_ml ? 'Yes' : 'No' }}
                    </span>
                </div>
                
                <p class="text-sm text-gray-400">Submitted: {{ $registration->project_submitted_at->format('M d, Y H:i') }}</p>
            </div>
            @endif
        </div>
        @endif

        <!-- Navigation -->
        <div class="text-center">
            <a href="{{ route('codesprint.rulebook') }}" class="btn btn-secondary me-4">
                <i class="bi bi-book me-2"></i>
                View Rulebook
            </a>
            <a href="{{ route('codesprint.register') }}" class="btn btn-secondary">
                <i class="bi bi-plus-circle me-2"></i>
                Register New Team
            </a>
        </div>
    </div>

    @include('layouts.footer')
</body>
</html>
