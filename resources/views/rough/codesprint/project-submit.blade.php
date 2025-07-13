<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CodeSprint 2025 - Final Project Submission</title>
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
    
    <div class="container mx-auto px-4 py-12 max-w-4xl">
        <!-- Header -->
        <header class="text-center mb-12 pt-8">
            <div class="inline-block mb-4 px-4 py-1 
                {{ $isDeadlinePassed ? 'bg-red-900/30 text-red-300 border-red-700/50' : 'bg-indigo-900/30 text-indigo-300 border-indigo-700/50' }} 
                rounded-full text-sm font-medium border">
                @if($isDeadlinePassed)
                    <i class="bi bi-x-circle me-2"></i>Final Submission Deadline Passed
                @else
                    <i class="bi bi-clock me-2"></i>Final Submission Deadline: {{ $projectDeadline->format('F j, Y g:i A') }}
                @endif
            </div>
            <h1 class="text-4xl sm:text-5xl font-bold mb-4 header-gradient">
                <i class="bi bi-upload me-3"></i>Final Project Submission
            </h1>
            <p class="text-xl max-w-2xl mx-auto text-gray-300">Submit your complete project files and demonstration video</p>
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
                    <a href="{{ route('codesprint.github.form') }}" class="btn btn-secondary">
                        <i class="bi bi-github me-2"></i>GitHub Submission
                    </a>
                    <a href="{{ route('codesprint.rulebook') }}" class="btn btn-secondary">
                        <i class="bi bi-book me-2"></i>Rulebook
                    </a>
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
                    <h2 class="text-2xl font-bold mb-4 text-red-400">Final Submission Deadline Has Passed</h2>
                    <p class="text-gray-300 mb-6">
                        The final project submission deadline was <strong>{{ $projectDeadline->format('F j, Y \a\t g:i A') }}</strong>.
                        You can no longer submit your final project.
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
            <!-- Page Header -->
            <div class="form-card mb-8">
                <div class="p-8 text-center">
                    <div class="text-blue-400 text-5xl mb-4">
                        <i class="bi bi-upload"></i>
                    </div>
                    <h2 class="text-3xl font-bold mb-4 text-white">
                        Submit Your Final Project
                    </h2>
                    <p class="text-lg text-gray-300 max-w-2xl mx-auto">
                        Complete each section below to submit your project
                    </p>
                </div>
            </div>
                    
            <form method="POST" action="{{ route('codesprint.project.submit') }}">
                @csrf
                
                <!-- Registration Token -->
                <div class="form-card mb-6">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-white mb-3 flex items-center">
                            <i class="bi bi-key me-2 text-indigo-400"></i>Registration Token
                        </h3>
                        <p class="text-gray-400 text-sm mb-4">Enter your 6-character team registration token</p>
                        
                        <input 
                            type="text" 
                            id="registration_token" 
                            name="registration_token" 
                            class="form-input w-full font-mono text-lg tracking-wider" 
                            placeholder="ABC123"
                            maxlength="6"
                            pattern="[A-Za-z0-9]{6}"
                            value="{{ old('registration_token') }}"
                            required
                        >
                    </div>
                </div>

                <!-- Project ZIP File -->
                <div class="form-card mb-6">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-white mb-3 flex items-center">
                            <i class="bi bi-file-zip me-2 text-blue-400"></i>Project ZIP File URL
                            <span class="text-red-400 ml-1">*</span>
                        </h3>
                        <p class="text-gray-400 text-sm mb-4">Upload your complete project source code as a ZIP file to Google Drive and share the public link</p>
                        
                        <input 
                            type="url" 
                            id="project_zip_url" 
                            name="project_zip_url" 
                            class="form-input w-full" 
                            placeholder="https://drive.google.com/file/d/..."
                            value="{{ old('project_zip_url') }}"
                            required
                        >
                    </div>
                </div>

                <!-- Demo Video -->
                <div class="form-card mb-6">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-white mb-3 flex items-center">
                            <i class="bi bi-play-circle me-2 text-purple-400"></i>Demo Video URL
                            <span class="text-red-400 ml-1">*</span>
                        </h3>
                        <p class="text-gray-400 text-sm mb-4">YouTube (public/unlisted) or Google Drive link to your demo video (maximum 15 minutes)</p>
                        
                        <input 
                            type="url" 
                            id="video_submission_url" 
                            name="video_submission_url" 
                            class="form-input w-full" 
                            placeholder="https://youtu.be/... or https://drive.google.com/file/d/..."
                            value="{{ old('video_submission_url') }}"
                            required
                        >
                    </div>
                </div>

                <!-- Project Description -->
                <div class="form-card mb-6">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-white mb-3 flex items-center">
                            <i class="bi bi-file-text me-2 text-green-400"></i>Project Description
                            <span class="text-red-400 ml-1">*</span>
                        </h3>
                        <p class="text-gray-400 text-sm mb-4">Provide a comprehensive description of your project, its features, and functionality (up to 2000 characters)</p>
                        
                        <div class="bg-gray-800/30 rounded-lg p-1 border border-gray-600/50">
                            <textarea 
                                id="project_description" 
                                name="project_description" 
                                class="form-input w-full border-0 bg-transparent resize-none" 
                                rows="10"
                                placeholder="Describe your project in detail...

• What problem does your project solve?
• What are the key features and functionality?
• How does it work technically?
• What makes it unique or innovative?
• What challenges did you overcome during development?

Write in detail to showcase your work!"
                                required
                            >{{ old('project_description') }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Technologies Used -->
                <div class="form-card mb-6">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-white mb-3 flex items-center">
                            <i class="bi bi-tools me-2 text-orange-400"></i>Technologies Used
                            <span class="text-red-400 ml-1">*</span>
                        </h3>
                        <p class="text-gray-400 text-sm mb-4">List all programming languages, frameworks, libraries, and tools used in your project</p>
                        
                        <div class="bg-gray-800/30 rounded-lg p-1 border border-gray-600/50">
                            <textarea 
                                id="technologies_used" 
                                name="technologies_used" 
                                class="form-input w-full border-0 bg-transparent resize-none" 
                                rows="6"
                                placeholder="List technologies used in your project...

Examples:
• Frontend: React, Vue.js, Angular, HTML5, CSS3, JavaScript
• Backend: Node.js, Python, Django, Flask, Express.js, PHP, Laravel
• Database: MongoDB, MySQL, PostgreSQL, Firebase
• Cloud/Deployment: AWS, Heroku, Vercel, Netlify
• APIs: REST APIs, GraphQL, third-party integrations"
                                required
                            >{{ old('technologies_used') }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- AI/ML Usage -->
                <div class="form-card mb-6">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-white mb-3 flex items-center">
                            <i class="bi bi-robot me-2 text-cyan-400"></i>AI/ML Technologies
                        </h3>
                        <p class="text-gray-400 text-sm mb-4">Does your project incorporate artificial intelligence or machine learning?</p>
                        
                        <div class="flex flex-col sm:flex-row gap-4">
                            <label class="flex items-center cursor-pointer bg-gray-800/30 rounded-lg px-6 py-4 border border-gray-600/50 hover:bg-gray-700/30 transition-colors flex-1">
                                <input 
                                    type="radio" 
                                    name="uses_ai_ml" 
                                    value="1" 
                                    class="form-radio mr-3" 
                                    {{ old('uses_ai_ml') == '1' ? 'checked' : '' }}
                                >
                                <span class="text-green-400 font-medium">Yes, it uses AI/ML</span>
                            </label>
                            <label class="flex items-center cursor-pointer bg-gray-800/30 rounded-lg px-6 py-4 border border-gray-600/50 hover:bg-gray-700/30 transition-colors flex-1">
                                <input 
                                    type="radio" 
                                    name="uses_ai_ml" 
                                    value="0" 
                                    class="form-radio mr-3" 
                                    {{ old('uses_ai_ml') == '0' ? 'checked' : '' }}
                                >
                                <span class="text-gray-300 font-medium">No AI/ML used</span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Live Demo URL -->
                <div class="form-card mb-6">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-white mb-3 flex items-center">
                            <i class="bi bi-globe me-2 text-teal-400"></i>Live Demo URL
                            <span class="text-gray-500 ml-1">(Optional)</span>
                        </h3>
                        <p class="text-gray-400 text-sm mb-4">If you have deployed your project online, provide the live demo URL</p>
                        
                        <input 
                            type="url" 
                            id="deployment_url" 
                            name="deployment_url" 
                            class="form-input w-full" 
                            placeholder="https://your-project-demo.com"
                            value="{{ old('deployment_url') }}"
                        >
                    </div>
                </div>

                <!-- Additional Notes -->
                <div class="form-card mb-6">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-white mb-3 flex items-center">
                            <i class="bi bi-chat-text me-2 text-pink-400"></i>Additional Notes & Reflections
                            <span class="text-gray-500 ml-1">(Optional)</span>
                        </h3>
                        <p class="text-gray-400 text-sm mb-4">Share any additional thoughts, challenges, achievements, or future plans for your project</p>
                        
                        <div class="bg-gray-800/30 rounded-lg p-1 border border-gray-600/50">
                            <textarea 
                                id="team_notes" 
                                name="team_notes" 
                                class="form-input w-full border-0 bg-transparent resize-none" 
                                rows="6"
                                placeholder="Share your thoughts about the project development process...

• What challenges did your team face?
• What are you most proud of?
• What would you do differently with more time?
• Any lessons learned during the competition?"
                            >{{ old('team_notes') }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Submission Requirements -->
                <div class="form-card mb-8">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-yellow-300 mb-4 flex items-center">
                            <i class="bi bi-info-circle me-2"></i>Submission Requirements
                        </h3>
                        
                        <div class="space-y-6">
                            <div class="bg-blue-900/20 border border-blue-700/50 rounded-lg p-4">
                                <h4 class="font-semibold text-blue-300 mb-3 flex items-center">
                                    <i class="bi bi-file-zip me-2"></i>Project ZIP File Requirements
                                </h4>
                                <ul class="space-y-2 text-sm text-gray-300">
                                    <li class="flex items-start">
                                        <i class="bi bi-check-circle text-green-400 me-2 mt-0.5 flex-shrink-0"></i>
                                        Complete source code (all files)
                                    </li>
                                    <li class="flex items-start">
                                        <i class="bi bi-check-circle text-green-400 me-2 mt-0.5 flex-shrink-0"></i>
                                        README.md with setup instructions
                                    </li>
                                    <li class="flex items-start">
                                        <i class="bi bi-check-circle text-green-400 me-2 mt-0.5 flex-shrink-0"></i>
                                        Dependencies list (package.json, requirements.txt, etc.)
                                    </li>
                                    <li class="flex items-start">
                                        <i class="bi bi-check-circle text-green-400 me-2 mt-0.5 flex-shrink-0"></i>
                                        Documentation and comments
                                    </li>
                                </ul>
                            </div>
                            
                            <div class="bg-purple-900/20 border border-purple-700/50 rounded-lg p-4">
                                <h4 class="font-semibold text-purple-300 mb-3 flex items-center">
                                    <i class="bi bi-play-circle me-2"></i>Demo Video Requirements
                                </h4>
                                <ul class="space-y-2 text-sm text-gray-300">
                                    <li class="flex items-start">
                                        <i class="bi bi-check-circle text-green-400 me-2 mt-0.5 flex-shrink-0"></i>
                                        Maximum 15 minutes duration
                                    </li>
                                    <li class="flex items-start">
                                        <i class="bi bi-check-circle text-green-400 me-2 mt-0.5 flex-shrink-0"></i>
                                        Clear demonstration of key features
                                    </li>
                                    <li class="flex items-start">
                                        <i class="bi bi-check-circle text-green-400 me-2 mt-0.5 flex-shrink-0"></i>
                                        Good audio and video quality
                                    </li>
                                    <li class="flex items-start">
                                        <i class="bi bi-check-circle text-green-400 me-2 mt-0.5 flex-shrink-0"></i>
                                        Show live application running
                                    </li>
                                </ul>
                            </div>
                        </div>
                        
                        <div class="bg-yellow-900/20 border border-yellow-700/50 rounded-lg p-4 mt-6">
                            <div class="flex items-start">
                                <i class="bi bi-exclamation-triangle text-yellow-400 text-lg mr-3 mt-1"></i>
                                <div>
                                    <h5 class="font-semibold text-yellow-300 mb-2">Important Reminders</h5>
                                    <ul class="text-sm text-gray-300 space-y-1">
                                        <li>• Make sure all links are publicly accessible and working</li>
                                        <li>• Test your video link in an incognito browser window</li>
                                        <li>• Submit your GitHub repository before final project submission</li>
                                        <li>• You cannot modify submissions after deadline</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="form-card mb-8">
                    <div class="p-8 text-center">
                        <div class="mb-6">
                            <h3 class="text-2xl font-bold text-white mb-2">Ready to Submit?</h3>
                            <p class="text-gray-400">Double-check all information before submitting</p>
                        </div>
                        
                        <div class="flex flex-col sm:flex-row justify-center gap-4 max-w-md mx-auto">
                            <button type="submit" class="btn btn-primary btn-lg px-8 py-4 text-lg w-full sm:w-auto">
                                <i class="bi bi-upload me-2"></i>Submit Project
                            </button>
                            <a href="{{ route('codesprint.home') }}" class="btn btn-secondary btn-lg px-8 py-4 text-lg w-full sm:w-auto">
                                <i class="bi bi-arrow-left me-2"></i>Cancel
                            </a>
                        </div>
                        
                        <p class="text-xs text-gray-500 mt-4 max-w-lg mx-auto">
                            By submitting, you confirm that this work is original and created during the CodeSprint competition period.
                        </p>
                    </div>
                </div>
            </form>

            <!-- What Happens Next -->
            <div class="form-card">
                <div class="p-6">
                    <h3 class="text-xl font-semibold mb-4 text-blue-300 flex items-center">
                        <i class="bi bi-info-circle me-2"></i>What Happens Next?
                    </h3>
                    <div class="grid md:grid-cols-3 gap-6 text-sm text-gray-300">
                        <div class="text-center">
                            <div class="w-12 h-12 bg-green-600 rounded-full flex items-center justify-center text-white text-xl mx-auto mb-3">
                                <i class="bi bi-check-circle"></i>
                            </div>
                            <h4 class="font-semibold text-white mb-2">Submission Received</h4>
                            <p>Your project will be confirmed and you'll receive a submission receipt</p>
                        </div>
                        <div class="text-center">
                            <div class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center text-white text-xl mx-auto mb-3">
                                <i class="bi bi-eye"></i>
                            </div>
                            <h4 class="font-semibold text-white mb-2">Evaluation</h4>
                            <p>Judges will review your code, video, and documentation</p>
                        </div>
                        <div class="text-center">
                            <div class="w-12 h-12 bg-purple-600 rounded-full flex items-center justify-center text-white text-xl mx-auto mb-3">
                                <i class="bi bi-trophy"></i>
                            </div>
                            <h4 class="font-semibold text-white mb-2">Onsite Round</h4>
                            <p>Top 10 Teams will be called for final presentation</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-format token input with visual feedback
            const tokenInput = document.getElementById('registration_token');
            tokenInput.addEventListener('input', function(e) {
                let value = e.target.value.toUpperCase().replace(/[^A-Z0-9]/g, '');
                if (value.length > 6) value = value.substring(0, 6);
                e.target.value = value;
                
                // Visual feedback for token completion
                if (value.length === 6) {
                    e.target.classList.add('border-green-500');
                    e.target.classList.remove('border-gray-600');
                } else {
                    e.target.classList.remove('border-green-500');
                    e.target.classList.add('border-gray-600');
                }
            });

            // Enhanced character counter with progress bar
            function addCharCounter(textareaId, maxLength) {
                const textarea = document.getElementById(textareaId);
                if (!textarea) return;
                
                // Create counter container
                const counterContainer = document.createElement('div');
                counterContainer.className = 'mt-2 flex items-center justify-between text-xs';
                
                // Character count display
                const counter = document.createElement('div');
                counter.className = 'text-gray-500';
                counter.innerHTML = `0/${maxLength} characters`;
                
                // Progress bar
                const progressBar = document.createElement('div');
                progressBar.className = 'w-24 h-1 bg-gray-700 rounded-full overflow-hidden';
                const progressFill = document.createElement('div');
                progressFill.className = 'h-full bg-indigo-500 transition-all duration-300';
                progressFill.style.width = '0%';
                progressBar.appendChild(progressFill);
                
                counterContainer.appendChild(counter);
                counterContainer.appendChild(progressBar);
                textarea.parentNode.appendChild(counterContainer);
                
                // Update counter and progress
                textarea.addEventListener('input', function() {
                    const length = this.value.length;
                    const percentage = (length / maxLength) * 100;
                    
                    counter.innerHTML = `${length}/${maxLength} characters`;
                    progressFill.style.width = `${Math.min(percentage, 100)}%`;
                    
                    // Color coding
                    if (percentage > 95) {
                        counter.className = 'text-red-400';
                        progressFill.className = 'h-full bg-red-500 transition-all duration-300';
                    } else if (percentage > 80) {
                        counter.className = 'text-yellow-400';
                        progressFill.className = 'h-full bg-yellow-500 transition-all duration-300';
                    } else {
                        counter.className = 'text-gray-500';
                        progressFill.className = 'h-full bg-indigo-500 transition-all duration-300';
                    }
                });
            }

            // Add enhanced character counters
            addCharCounter('project_description', 2000);
            addCharCounter('technologies_used', 500);
            addCharCounter('team_notes', 1000);

            // URL validation with visual feedback
            function addUrlValidation(inputId) {
                const input = document.getElementById(inputId);
                if (!input) return;
                
                input.addEventListener('blur', function() {
                    const url = this.value.trim();
                    if (url && !isValidUrl(url)) {
                        this.classList.add('border-red-500');
                        this.classList.remove('border-green-500');
                    } else if (url) {
                        this.classList.add('border-green-500');
                        this.classList.remove('border-red-500');
                    } else {
                        this.classList.remove('border-red-500', 'border-green-500');
                    }
                });
            }
            
            function isValidUrl(string) {
                try {
                    new URL(string);
                    return true;
                } catch (_) {
                    return false;
                }
            }
            
            // Add URL validation
            addUrlValidation('project_zip_url');
            addUrlValidation('video_submission_url');
            addUrlValidation('deployment_url');

            // Form submission confirmation
            document.querySelector('form').addEventListener('submit', function(e) {
                const confirmation = confirm('Are you sure you want to submit your final project? You cannot modify it after submission.');
                if (!confirmation) {
                    e.preventDefault();
                }
            });
        });
    </script>
</body>
</html>
