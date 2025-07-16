<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CodeSprint 2025 - GitHub Submission</title>
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
    
    <div class="container mx-auto px-4 py-12 max-w-3xl">
        <!-- Header -->
        <header class="text-center mb-12 pt-8">
            <div class="inline-block mb-4 px-4 py-1 
                {{ $isDeadlinePassed ? 'bg-red-900/30 text-red-300 border-red-700/50' : 'bg-indigo-900/30 text-indigo-300 border-indigo-700/50' }} 
                rounded-full text-sm font-medium border">
                @if($isDeadlinePassed)
                    <i class="bi bi-x-circle me-2"></i>GitHub Submission Deadline Passed
                @else
                    <i class="bi bi-clock me-2"></i>GitHub Submission Deadline: {{ $githubDeadline->format('F j, Y g:i A') }}
                @endif
            </div>
            <h1 class="text-4xl sm:text-5xl font-bold mb-4 header-gradient">
                <i class="bi bi-github me-3"></i>GitHub Repository Submission
            </h1>
            <p class="text-xl max-w-2xl mx-auto text-gray-300">Submit your team's GitHub repository for CodeSprint 2025</p>
        </header>

        <!-- Navigation -->
        <div class="card mb-8">
            <div class="p-6">
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="{{ route('codesprint.home') }}" class="btn btn-secondary">
                        <i class="bi bi-house me-2"></i>Home
                    </a>
                    <a href="{{ route('codesprint.status.lookup') }}" class="btn btn-secondary">
                        <i class="bi bi-search me-2"></i>Check Status
                    </a>
                    <a href="{{ route('codesprint.project.form') }}" class="btn btn-secondary">
                        <i class="bi bi-upload me-2"></i>Project Submission
                    </a>
                    <a href="{{ route('codesprint.rulebook') }}" class="btn btn-secondary">
                        <i class="bi bi-book me-2"></i>Rulebook
                    </a>
                </div>
            </div>
        </div>

        <!-- Token Help Card -->
        <div class="card mb-8 border border-amber-500/30">
            <div class="p-6 bg-gradient-to-r from-amber-900/20 to-orange-900/20">
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <i class="bi bi-question-circle text-3xl text-amber-400"></i>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-lg font-semibold text-amber-300 mb-2">
                            <i class="bi bi-key me-2"></i>Don't Have Your Registration Token?
                        </h3>
                        <p class="text-gray-300 mb-4">
                            If you forgot your 6-character registration token or never received it, don't worry! 
                            Our team can help you retrieve it quickly.
                        </p>
                        <div class="bg-gray-800/50 rounded-lg p-4 border border-amber-500/20">
                            <div class="flex items-center space-x-3">
                                <i class="bi bi-envelope text-amber-400 text-xl"></i>
                                <div>
                                    <p class="text-sm text-gray-400 mb-1">Contact us at:</p>
                                    <a href="mailto:adibsakhawat@iut-dhaka.edu" 
                                       class="text-amber-300 font-semibold hover:text-amber-200 transition-colors">
                                        adibsakhawat@iut-dhaka.edu
                                    </a>
                                </div>
                            </div>
                            <p class="text-xs text-gray-400 mt-3">
                                <i class="bi bi-info-circle me-1"></i>
                                Please include your team name and team leader's email in your message for faster assistance.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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

        @if($isDeadlinePassed)
            <!-- Deadline Passed Message -->
            <div class="card">
                <div class="p-8 text-center">
                    <div class="text-red-400 text-6xl mb-6">
                        <i class="bi bi-clock-history"></i>
                    </div>
                    <h2 class="text-2xl font-bold mb-4 text-red-400">GitHub Submission Deadline Has Passed</h2>
                    <p class="text-gray-300 mb-6">
                        The GitHub repository submission deadline was <strong>{{ $githubDeadline->format('F j, Y \a\t g:i A') }}</strong>.
                        You can no longer submit your GitHub repository.
                    </p>
                    <div class="flex justify-center gap-4">
                        <a href="{{ route('codesprint.home') }}" class="btn btn-primary">
                            <i class="bi bi-house me-2"></i>Back to Home
                        </a>
                        <a href="{{ route('codesprint.status.lookup') }}" class="btn btn-secondary">
                            <i class="bi bi-search me-2"></i>Check Status
                        </a>
                    </div>
                </div>
            </div>
        @else
            <!-- Submission Form -->
            <div class="form-card">
                <div class="p-8">
                    <div class="mb-8">
                        <h2 class="text-2xl font-bold mb-2">
                            <i class="bi bi-github me-3"></i>Submit Your GitHub Repository
                        </h2>
                        <p class="text-gray-400">Provide your 6-character registration token and GitHub repository link</p>
                    </div>
                    
                    <form method="POST" action="{{ route('codesprint.github.submit') }}">
                        @csrf
                        
                        <!-- Registration Token -->
                        <div class="mb-6">
                            <label for="registration_token" class="block text-sm font-medium mb-2 text-gray-300">
                                <i class="bi bi-key me-2"></i>Registration Token
                            </label>
                            <input 
                                type="text" 
                                id="registration_token" 
                                name="registration_token" 
                                class="form-input w-full font-mono" 
                                placeholder="ABC123"
                                maxlength="6"
                                pattern="[A-Za-z0-9]{6}"
                                value="{{ old('registration_token') }}"
                                required
                            >
                            <p class="text-sm text-gray-400 mt-1">Enter your 6-character registration token (received after successful registration)</p>
                        </div>

                        <!-- GitHub Repository URL -->
                        <div class="mb-8">
                            <label for="github_repo_url" class="block text-sm font-medium mb-2 text-gray-300">
                                <i class="bi bi-github me-2"></i>GitHub Repository URL
                            </label>
                            <input 
                                type="url" 
                                id="github_repo_url" 
                                name="github_repo_url" 
                                class="form-input w-full" 
                                placeholder="https://github.com/username/repository-name"
                                pattern="https://github\.com/.*"
                                value="{{ old('github_repo_url') }}"
                                required
                            >
                            <p class="text-sm text-gray-400 mt-1">Your repository must be public and contain your complete source code</p>
                        </div>

                        <!-- Requirements -->
                        <div class="bg-blue-900/20 border border-blue-700/50 rounded-lg p-6 mb-8">
                            <h3 class="text-lg font-semibold mb-4 text-blue-300">
                                <i class="bi bi-info-circle me-2"></i>GitHub Repository Requirements
                            </h3>
                            <ul class="space-y-2 text-sm text-gray-300">
                                <li class="flex items-start">
                                    <i class="bi bi-check-circle text-green-400 me-2 mt-0.5 flex-shrink-0"></i>
                                    Repository must be <strong>public</strong>
                                </li>
                                <li class="flex items-start">
                                    <i class="bi bi-check-circle text-green-400 me-2 mt-0.5 flex-shrink-0"></i>
                                    Include a comprehensive <strong>README.md</strong> with project description
                                </li>
                                <li class="flex items-start">
                                    <i class="bi bi-check-circle text-green-400 me-2 mt-0.5 flex-shrink-0"></i>
                                    All source code must be included and properly organized
                                </li>
                                <li class="flex items-start">
                                    <i class="bi bi-check-circle text-green-400 me-2 mt-0.5 flex-shrink-0"></i>
                                    Include setup/installation instructions
                                </li>
                                <li class="flex items-start">
                                    <i class="bi bi-check-circle text-green-400 me-2 mt-0.5 flex-shrink-0"></i>
                                    Repository must be accessible for evaluation
                                </li>
                            </ul>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-center gap-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-github me-2"></i>Submit GitHub Repository
                            </button>
                            <a href="{{ route('codesprint.home') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left me-2"></i>Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Next Steps -->
            <div class="card mt-8">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4 text-yellow-300">
                        <i class="bi bi-lightbulb me-2"></i>What Happens Next?
                    </h3>
                    <div class="grid md:grid-cols-2 gap-6 text-sm text-gray-300">
                        <div class="flex items-start">
                            <i class="bi bi-1-circle text-indigo-400 me-3 mt-0.5 flex-shrink-0"></i>
                            <div>
                                <strong class="text-white">GitHub Verification</strong>
                                <p>Your repository will be verified for accessibility and requirements</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <i class="bi bi-2-circle text-indigo-400 me-3 mt-0.5 flex-shrink-0"></i>
                            <div>
                                <strong class="text-white">Final Project Submission</strong>
                                <p>Submit your final project files and video after GitHub submission</p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-6 pt-4 border-t border-gray-700">
                        <p class="text-center text-sm text-gray-400">
                            <i class="bi bi-info-circle me-2"></i>
                            You can update your GitHub repository anytime before the final evaluation
                        </p>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <script>
        // Auto-format token input
        document.addEventListener('DOMContentLoaded', function() {
            const tokenInput = document.getElementById('registration_token');
            if (tokenInput) {
                tokenInput.addEventListener('input', function(e) {
                    let value = e.target.value.toUpperCase().replace(/[^A-Z0-9]/g, '');
                    if (value.length > 6) value = value.substring(0, 6);
                    e.target.value = value;
                });
            }

            // GitHub URL validation
            const githubInput = document.getElementById('github_repo_url');
            if (githubInput) {
                githubInput.addEventListener('input', function(e) {
                    const value = e.target.value;
                    const isValid = /^https:\/\/github\.com\/.*/.test(value);
                    if (value && !isValid) {
                        e.target.setCustomValidity('Please enter a valid GitHub repository URL (https://github.com/username/repository)');
                    } else {
                        e.target.setCustomValidity('');
                    }
                });
            }
        });
    </script>
</body>
</html>
