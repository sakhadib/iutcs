<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CodeSprint 2025 - Check Status</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/codesprint-style.css') }}">
</head>
<body>
    @include('layouts.dangling_header')
    
    <div class="container mx-auto px-4 py-12 max-w-4xl">
        <!-- Header -->
        <header class="text-center mb-12 pt-8">
            <h1 class="text-4xl sm:text-5xl font-bold mb-4 header-gradient">
                Check Registration Status
            </h1>
            <p class="text-xl max-w-2xl mx-auto text-gray-300">Enter your registration token to check your team's status</p>
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

        @if($errors->any())
            <div class="alert alert-error animate-fade-in">
                <i class="bi bi-exclamation-triangle me-2"></i>
                <div>
                    <strong>Please fix the following errors:</strong>
                    <ul class="mt-2 ml-4 list-disc">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <!-- Status Lookup Form -->
        <div class="form-card p-8 mb-12 animate-fade-in">
            <div class="flex items-center mb-6">
                <div class="icon-container">
                    <i class="bi bi-search text-indigo-400"></i>
                </div>
                <h2 class="text-2xl font-bold section-title">Find Your Registration</h2>
            </div>
            
            <form action="{{ route('codesprint.status.lookup') }}" method="POST" class="space-y-6">
                @csrf
                
                <div>
                    <label class="block text-sm font-medium mb-2 text-gray-300" for="registration_token">Registration Token *</label>
                    <input type="text" id="registration_token" name="registration_token" value="{{ old('registration_token') }}" 
                           class="form-input w-full text-center text-2xl font-mono tracking-widest" 
                           placeholder="ABC123" required maxlength="6" style="letter-spacing: 0.3em;">
                    <p class="text-sm text-gray-400 mt-1">This 6-character token was provided after registration (e.g., ABC123)</p>
                </div>
                
                <button type="submit" class="btn btn-primary w-full">
                    <i class="bi bi-search me-2"></i>
                    Check Status
                </button>
            </form>
        </div>

        <!-- Help Section -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12">
            <div class="card p-6">
                <div class="flex items-start">
                    <div class="icon-container flex-shrink-0">
                        <i class="bi bi-question-circle text-amber-400"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-lg mb-2 text-white">Can't find your token?</h3>
                        <p class="text-gray-300 mb-4">Your 6-character registration token (like ABC123) was provided after successful registration. Check your browser bookmarks or saved URLs.</p>
                        <a href="{{ route('codesprint.register') }}" class="btn btn-secondary">
                            <i class="bi bi-plus-circle me-2"></i>
                            Register New Team
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="card p-6">
                <div class="flex items-start">
                    <div class="icon-container flex-shrink-0">
                        <i class="bi bi-info-circle text-cyan-400"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-lg mb-2 text-white">What can you do here?</h3>
                        <ul class="text-gray-300 space-y-2">
                            <li class="flex items-center">
                                <i class="bi bi-check text-green-400 me-2"></i>
                                Check payment verification status
                            </li>
                            <li class="flex items-center">
                                <i class="bi bi-check text-green-400 me-2"></i>
                                Submit GitHub repository link
                            </li>
                            <li class="flex items-center">
                                <i class="bi bi-check text-green-400 me-2"></i>
                                Submit final project files
                            </li>
                            <li class="flex items-center">
                                <i class="bi bi-check text-green-400 me-2"></i>
                                View team member details
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Competition Statistics -->
        <div class="card p-8 mb-8">
            <div class="flex items-center mb-6">
                <div class="icon-container">
                    <i class="bi bi-bar-chart text-emerald-400"></i>
                </div>
                <h2 class="text-2xl font-bold section-title">Competition Statistics</h2>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <div class="text-center">
                    <div class="text-3xl font-bold text-indigo-400 mb-2" id="total-teams">-</div>
                    <div class="text-sm text-gray-400">Total Teams</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-green-400 mb-2" id="verified-teams">-</div>
                    <div class="text-sm text-gray-400">Verified Teams</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-purple-400 mb-2" id="github-submitted">-</div>
                    <div class="text-sm text-gray-400">GitHub Submitted</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-amber-400 mb-2" id="projects-submitted">-</div>
                    <div class="text-sm text-gray-400">Projects Submitted</div>
                </div>
            </div>
        </div>

        <!-- Important Deadlines -->
        <div class="card p-8 mb-8">
            <div class="flex items-center mb-6">
                <div class="icon-container">
                    <i class="bi bi-calendar-event text-rose-400"></i>
                </div>
                <h2 class="text-2xl font-bold section-title">Important Deadlines</h2>
            </div>
            
            <div class="space-y-4">
                <div class="flex justify-between items-center p-4 rounded-lg" style="background: rgba(99, 102, 241, 0.1);">
                    <div>
                        <h3 class="font-bold text-white">Registration & GitHub Submission</h3>
                        <p class="text-gray-300">Last chance to register and submit GitHub repository</p>
                    </div>
                    <div class="text-right">
                        <div class="font-bold text-indigo-300">July 22, 2025</div>
                        <div class="text-sm text-gray-400">6:00 PM</div>
                    </div>
                </div>
                
                <div class="flex justify-between items-center p-4 rounded-lg" style="background: rgba(16, 185, 129, 0.1);">
                    <div>
                        <h3 class="font-bold text-white">Final Project Submission</h3>
                        <p class="text-gray-300">Submit your complete project with demo video</p>
                    </div>
                    <div class="text-right">
                        <div class="font-bold text-emerald-300">July 30, 2025</div>
                        <div class="text-sm text-gray-400">11:59 PM</div>
                    </div>
                </div>
                
                <div class="flex justify-between items-center p-4 rounded-lg" style="background: rgba(168, 85, 247, 0.1);">
                    <div>
                        <h3 class="font-bold text-white">Onsite Presentation</h3>
                        <p class="text-gray-300">Top 10 teams will present their projects</p>
                    </div>
                    <div class="text-right">
                        <div class="font-bold text-purple-300">To Be Announced</div>
                        <div class="text-sm text-gray-400">Stay tuned</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navigation Links -->
        <div class="text-center">
            <a href="{{ route('codesprint.rulebook') }}" class="btn btn-secondary me-4">
                <i class="bi bi-book me-2"></i>
                View Rulebook
            </a>
            <a href="{{ route('codesprint.register') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle me-2"></i>
                Register New Team
            </a>
        </div>
    </div>

    @include('layouts.footer')

    <script>
        // Load statistics
        async function loadStatistics() {
            try {
                const response = await fetch('{{ route("codesprint.stats") }}');
                const stats = await response.json();
                
                document.getElementById('total-teams').textContent = stats.total || 0;
                document.getElementById('verified-teams').textContent = stats.verified || 0;
                document.getElementById('github-submitted').textContent = stats.github_submitted || 0;
                document.getElementById('projects-submitted').textContent = stats.project_submitted || 0;
            } catch (error) {
                console.log('Could not load statistics');
            }
        }

        // Load statistics on page load
        document.addEventListener('DOMContentLoaded', function() {
            loadStatistics();
        });

        // Format token input
        document.getElementById('registration_token').addEventListener('input', function(e) {
            let value = e.target.value.replace(/[^a-zA-Z0-9]/g, '').toUpperCase();
            if (value.length > 6) {
                value = value.substring(0, 6);
            }
            e.target.value = value;
        });
    </script>
</body>
</html>
