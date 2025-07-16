<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta name="referrer" content="strict-origin-when-cross-origin">
    <title>Requirements & Marking Criteria - CodeSprint 2025</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/codesprint-style.css') }}">
</head>
<body>
    @include('layouts.dangling_header')
    
    @if(!$isGithubOpen)
    <!-- Countdown Page - Before 6 PM Bangladesh Time -->
    <div class="container mx-auto px-4 py-8 sm:py-12 max-w-4xl min-h-screen flex items-center justify-center">
        <div class="text-center">
            <!-- Header -->
            <div class="mb-8 sm:mb-12">
                <div class="inline-block mb-4 sm:mb-6 px-4 sm:px-6 py-2 bg-purple-900/30 text-purple-300 rounded-full text-sm sm:text-base font-medium border border-purple-700/50">
                    <i class="bi bi-clock me-2"></i>
                    Coming Soon
                </div>
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold mb-4 sm:mb-6 header-gradient">
                    Requirements & Marking Criteria
                </h1>
                <p class="text-xl sm:text-2xl max-w-2xl mx-auto text-gray-300 mb-8 sm:mb-12">
                    Full guidelines will be available at <span class="font-bold text-green-400">6:00 PM Bangladesh Time</span>
                </p>
            </div>

            <!-- Countdown Card -->
            <div class="card p-6 sm:p-8 lg:p-12 border-2 border-purple-500/50 glow max-w-2xl mx-auto">
                <div class="mb-6 sm:mb-8">
                    <i class="bi bi-stopwatch text-6xl sm:text-7xl text-purple-400 mb-4"></i>
                    <h2 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-white mb-4">
                        Countdown to Guidelines Release
                    </h2>
                    <div class="text-lg sm:text-xl text-gray-300 mb-6">
                        Target Release: <span class="font-bold text-purple-400">{{ $githubOpenTime->format('F j, Y \a\t g:i A') }} (Bangladesh Time)</span>
                    </div>
                </div>
                
                <!-- Countdown Timer -->
                <div id="countdown-timer" class="grid grid-cols-2 sm:grid-cols-4 gap-4 sm:gap-6 mb-8">
                    <div class="card p-4 border border-purple-500/30">
                        <div id="days" class="text-2xl sm:text-3xl font-bold text-purple-400">--</div>
                        <div class="text-sm sm:text-base text-gray-300">Days</div>
                    </div>
                    <div class="card p-4 border border-blue-500/30">
                        <div id="hours" class="text-2xl sm:text-3xl font-bold text-blue-400">--</div>
                        <div class="text-sm sm:text-base text-gray-300">Hours</div>
                    </div>
                    <div class="card p-4 border border-green-500/30">
                        <div id="minutes" class="text-2xl sm:text-3xl font-bold text-green-400">--</div>
                        <div class="text-sm sm:text-base text-gray-300">Minutes</div>
                    </div>
                    <div class="card p-4 border border-amber-500/30">
                        <div id="seconds" class="text-2xl sm:text-3xl font-bold text-amber-400">--</div>
                        <div class="text-sm sm:text-base text-gray-300">Seconds</div>
                    </div>
                </div>

                <!-- Current Time Display -->
                <div class="mb-6 p-4 bg-gray-800/50 rounded-lg border border-gray-600/30">
                    <div class="text-sm text-gray-400 mb-1">Current Bangladesh Time</div>
                    <div id="current-time" class="text-lg font-mono text-white">--</div>
                </div>

                <!-- What to Expect -->
                <div class="text-left space-y-4">
                    <h3 class="text-xl font-bold text-white mb-4">What you'll find here at 6 PM:</h3>
                    <div class="space-y-3">
                        <div class="flex items-start">
                            <i class="bi bi-check-circle text-green-400 me-3 mt-1 flex-shrink-0"></i>
                            <span class="text-gray-300">Detailed marking criteria (100 marks total)</span>
                        </div>
                        <div class="flex items-start">
                            <i class="bi bi-check-circle text-green-400 me-3 mt-1 flex-shrink-0"></i>
                            <span class="text-gray-300">GitHub submission guidelines</span>
                        </div>
                        <div class="flex items-start">
                            <i class="bi bi-check-circle text-green-400 me-3 mt-1 flex-shrink-0"></i>
                            <span class="text-gray-300">Project requirements and expectations</span>
                        </div>
                        <div class="flex items-start">
                            <i class="bi bi-check-circle text-green-400 me-3 mt-1 flex-shrink-0"></i>
                            <span class="text-gray-300">Evaluation criteria for each category</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="mt-8 sm:mt-12 flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('codesprint.register') }}" class="btn btn-secondary text-base sm:text-lg px-6 py-3">
                    <i class="bi bi-person-plus me-2"></i>
                    Register Team
                </a>
                <a href="{{ route('codesprint.rulebook') }}" class="btn btn-secondary text-base sm:text-lg px-6 py-3">
                    <i class="bi bi-book me-2"></i>
                    View Rulebook
                </a>
                <a href="{{ route('codesprint.stats') }}" class="btn btn-secondary text-base sm:text-lg px-6 py-3">
                    <i class="bi bi-graph-up me-2"></i>
                    Competition Stats
                </a>
            </div>
        </div>
    </div>
    @else
    <!-- Full Content - After 6 PM Bangladesh Time -->
    <div class="container mx-auto px-4 py-8 sm:py-12 max-w-6xl">
        <!-- Header -->
        <header class="text-center mb-8 sm:mb-12 pt-4 sm:pt-8">
            <div class="inline-block mb-3 sm:mb-4 px-3 sm:px-4 py-1 bg-green-900/30 text-green-300 rounded-full text-sm font-medium border border-green-700/50">
                <i class="bi bi-check-circle me-2"></i>
                Now Available
            </div>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold mb-3 sm:mb-4 header-gradient px-4">
                Requirements & Marking Criteria
            </h1>
            <p class="text-lg sm:text-xl max-w-3xl mx-auto text-gray-300 px-4">
                Understand what's expected and how your project will be evaluated
            </p>
        </header>

        <!-- GitHub Submission CTA -->
        @if(!$isGithubDeadlinePassed)
        <div class="card p-4 sm:p-6 lg:p-8 mb-8 sm:mb-12 border-2 border-green-500/50 glow text-center">
            <div class="mb-4 sm:mb-6">
                <i class="bi bi-github text-4xl sm:text-5xl text-green-400 mb-3 sm:mb-4"></i>
                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-white mb-2 sm:mb-3">
                    📢 GitHub Submission Deadline
                </h2>
                <div class="text-lg sm:text-xl text-gray-300 mb-4 sm:mb-6">
                    Submit your GitHub repository before <span class="font-bold text-green-400">{{ $githubDeadline->format('F j, Y') }} at {{ $githubDeadline->format('g:i A') }}</span>
                </div>
            </div>
            
            <div class="space-y-4">
                <a href="{{ route('codesprint.github.form') }}" class="btn btn-primary text-lg sm:text-xl px-6 sm:px-8 py-3 sm:py-4 inline-flex items-center">
                    <i class="bi bi-github me-2"></i>
                    Submit GitHub Repository
                </a>
                <p class="text-sm sm:text-base text-gray-400">
                    Make sure your repository is public.
                </p>
            </div>
        </div>
        @endif

        <!-- Marking Criteria Overview -->
        <div class="card p-4 sm:p-6 lg:p-8 mb-8 sm:mb-12">
            <div class="flex items-center mb-4 sm:mb-6">
                <div class="icon-container">
                    <i class="bi bi-trophy text-amber-400"></i>
                </div>
                <h2 class="text-xl sm:text-2xl lg:text-3xl font-bold section-title">Evaluation Overview</h2>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-6 sm:mb-8">
                <div class="card p-4 text-center border border-blue-500/30">
                    <div class="text-2xl sm:text-3xl font-bold text-blue-400 mb-2">100</div>
                    <div class="text-sm sm:text-base text-gray-300">Total Marks</div>
                </div>
                <div class="card p-4 text-center border border-green-500/30">
                    <div class="text-2xl sm:text-3xl font-bold text-green-400 mb-2">8</div>
                    <div class="text-sm sm:text-base text-gray-300">Criteria</div>
                </div>
                <div class="card p-4 text-center border border-purple-500/30">
                    <div class="text-2xl sm:text-3xl font-bold text-purple-400 mb-2">35</div>
                    <div class="text-sm sm:text-base text-gray-300">Max Single Category</div>
                </div>
                <div class="card p-4 text-center border border-amber-500/30">
                    <div class="text-2xl sm:text-3xl font-bold text-amber-400 mb-2">10</div>
                    <div class="text-sm sm:text-base text-gray-300">Min Single Category</div>
                </div>
            </div>
        </div>

        <!-- Detailed Marking Criteria -->
        <div class="space-y-6 sm:space-y-8">
            <!-- 1. Idea -->
            <div class="card p-4 sm:p-6 lg:p-8 border border-indigo-500/30">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4 sm:mb-6">
                    <div class="flex items-center mb-3 sm:mb-0">
                        <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-indigo-600 flex items-center justify-center mr-3 sm:mr-4">
                            <span class="text-white font-bold text-lg sm:text-xl">1</span>
                        </div>
                        <h3 class="text-lg sm:text-xl lg:text-2xl font-bold text-white">Idea</h3>
                    </div>
                    <div class="badge badge-info text-base sm:text-lg px-3 sm:px-4 py-1 sm:py-2">10 Marks</div>
                </div>
                
                <div class="space-y-3 sm:space-y-4">
                    <div class="flex items-start">
                        <i class="bi bi-lightbulb text-indigo-400 me-2 sm:me-3 mt-1 flex-shrink-0"></i>
                        <span class="text-sm sm:text-base text-gray-300">Clarity, creativity, and innovation in the project concept</span>
                    </div>
                    <div class="flex items-start">
                        <i class="bi bi-target text-indigo-400 me-2 sm:me-3 mt-1 flex-shrink-0"></i>
                        <span class="text-sm sm:text-base text-gray-300">How well the idea addresses a real-world problem or use case</span>
                    </div>
                    <div class="flex items-start">
                        <i class="bi bi-star text-indigo-400 me-2 sm:me-3 mt-1 flex-shrink-0"></i>
                        <span class="text-sm sm:text-base text-gray-300">Uniqueness and feasibility of the idea</span>
                    </div>
                </div>
            </div>

            <!-- 2. Tech Stack -->
            <div class="card p-4 sm:p-6 lg:p-8 border border-emerald-500/30">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4 sm:mb-6">
                    <div class="flex items-center mb-3 sm:mb-0">
                        <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-emerald-600 flex items-center justify-center mr-3 sm:mr-4">
                            <span class="text-white font-bold text-lg sm:text-xl">2</span>
                        </div>
                        <h3 class="text-lg sm:text-xl lg:text-2xl font-bold text-white">Appropriate Choice of Technology / Tech-stack</h3>
                    </div>
                    <div class="badge badge-success text-base sm:text-lg px-3 sm:px-4 py-1 sm:py-2">10 Marks</div>
                </div>
                
                <div class="space-y-3 sm:space-y-4">
                    <div class="flex items-start">
                        <i class="bi bi-gear text-emerald-400 me-2 sm:me-3 mt-1 flex-shrink-0"></i>
                        <span class="text-sm sm:text-base text-gray-300">Justification of the selected tech-stack based on project requirements</span>
                    </div>
                    <div class="flex items-start">
                        <i class="bi bi-puzzle text-emerald-400 me-2 sm:me-3 mt-1 flex-shrink-0"></i>
                        <span class="text-sm sm:text-base text-gray-300">Compatibility of technologies with the project needs (databases, backend services, etc.)</span>
                    </div>
                    <div class="flex items-start">
                        <i class="bi bi-speedometer2 text-emerald-400 me-2 sm:me-3 mt-1 flex-shrink-0"></i>
                        <span class="text-sm sm:text-base text-gray-300">Consideration of performance and resource management</span>
                    </div>
                </div>
            </div>

            <!-- 3. Solution Approach -->
            <div class="card p-4 sm:p-6 lg:p-8 border border-cyan-500/30">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4 sm:mb-6">
                    <div class="flex items-center mb-3 sm:mb-0">
                        <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-cyan-600 flex items-center justify-center mr-3 sm:mr-4">
                            <span class="text-white font-bold text-lg sm:text-xl">3</span>
                        </div>
                        <h3 class="text-lg sm:text-xl lg:text-2xl font-bold text-white">Solution Approach to Problems</h3>
                    </div>
                    <div class="badge badge-info text-base sm:text-lg px-3 sm:px-4 py-1 sm:py-2">10 Marks</div>
                </div>
                
                <div class="space-y-3 sm:space-y-4">
                    <div class="flex items-start">
                        <i class="bi bi-diagram-3 text-cyan-400 me-2 sm:me-3 mt-1 flex-shrink-0"></i>
                        <span class="text-sm sm:text-base text-gray-300">Logical flow of the solution design and problem-solving</span>
                    </div>
                    <div class="flex items-start">
                        <i class="bi bi-cpu text-cyan-400 me-2 sm:me-3 mt-1 flex-shrink-0"></i>
                        <span class="text-sm sm:text-base text-gray-300">Efficiency of the chosen algorithms or models to solve the problem</span>
                    </div>
                    <div class="flex items-start">
                        <i class="bi bi-shield-check text-cyan-400 me-2 sm:me-3 mt-1 flex-shrink-0"></i>
                        <span class="text-sm sm:text-base text-gray-300">Handling edge cases and user-specific requirements</span>
                    </div>
                </div>
            </div>

            <!-- 4. Clean Code (Highest Weight) -->
            <div class="card p-4 sm:p-6 lg:p-8 border-2 border-purple-500/50 glow">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4 sm:mb-6">
                    <div class="flex items-center mb-3 sm:mb-0">
                        <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-purple-600 flex items-center justify-center mr-3 sm:mr-4">
                            <span class="text-white font-bold text-lg sm:text-xl">4</span>
                        </div>
                        <h3 class="text-lg sm:text-xl lg:text-2xl font-bold text-white">Clean Code and Implementation</h3>
                        <span class="ml-2 text-xs sm:text-sm text-purple-300">(Most Important)</span>
                    </div>
                    <div class="badge badge-warning text-base sm:text-lg px-3 sm:px-4 py-1 sm:py-2">35 Marks</div>
                </div>
                
                <div class="space-y-3 sm:space-y-4">
                    <div class="flex items-start">
                        <i class="bi bi-code-square text-purple-400 me-2 sm:me-3 mt-1 flex-shrink-0"></i>
                        <span class="text-sm sm:text-base text-gray-300">Code readability, organization, and adherence to best practices</span>
                    </div>
                    <div class="flex items-start">
                        <i class="bi bi-git text-purple-400 me-2 sm:me-3 mt-1 flex-shrink-0"></i>
                        <span class="text-sm sm:text-base text-gray-300">Proper use of version control (e.g., Git)</span>
                    </div>
                    <div class="flex items-start">
                        <i class="bi bi-lightning text-purple-400 me-2 sm:me-3 mt-1 flex-shrink-0"></i>
                        <span class="text-sm sm:text-base text-gray-300">Efficiency and optimization of the code</span>
                    </div>
                    <div class="flex items-start">
                        <i class="bi bi-boxes text-purple-400 me-2 sm:me-3 mt-1 flex-shrink-0"></i>
                        <span class="text-sm sm:text-base text-gray-300">Modularization, DRY (Don't Repeat Yourself) principles, and documentation</span>
                    </div>
                </div>
            </div>

            <!-- 5. Sustainability -->
            <div class="card p-4 sm:p-6 lg:p-8 border border-amber-500/30">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4 sm:mb-6">
                    <div class="flex items-center mb-3 sm:mb-0">
                        <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-amber-600 flex items-center justify-center mr-3 sm:mr-4">
                            <span class="text-white font-bold text-lg sm:text-xl">5</span>
                        </div>
                        <h3 class="text-lg sm:text-xl lg:text-2xl font-bold text-white">Sustainability and Extendibility</h3>
                    </div>
                    <div class="badge badge-warning text-base sm:text-lg px-3 sm:px-4 py-1 sm:py-2">10 Marks</div>
                </div>
                
                <div class="space-y-3 sm:space-y-4">
                    <div class="flex items-start">
                        <i class="bi bi-arrows-expand text-amber-400 me-2 sm:me-3 mt-1 flex-shrink-0"></i>
                        <span class="text-sm sm:text-base text-gray-300">Scalability of the project (ability to handle increased data load, users, etc.)</span>
                    </div>
                    <div class="flex items-start">
                        <i class="bi bi-tools text-amber-400 me-2 sm:me-3 mt-1 flex-shrink-0"></i>
                        <span class="text-sm sm:text-base text-gray-300">Design for maintainability and future feature addition</span>
                    </div>
                    <div class="flex items-start">
                        <i class="bi bi-arrow-up-circle text-amber-400 me-2 sm:me-3 mt-1 flex-shrink-0"></i>
                        <span class="text-sm sm:text-base text-gray-300">Ability to update and improve without major rewrites</span>
                    </div>
                </div>
            </div>

            <!-- 6. Offline Availability -->
            <div class="card p-4 sm:p-6 lg:p-8 border border-orange-500/30">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4 sm:mb-6">
                    <div class="flex items-center mb-3 sm:mb-0">
                        <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-orange-600 flex items-center justify-center mr-3 sm:mr-4">
                            <span class="text-white font-bold text-lg sm:text-xl">6</span>
                        </div>
                        <h3 class="text-lg sm:text-xl lg:text-2xl font-bold text-white">Implementation of Offline Availability</h3>
                    </div>
                    <div class="badge badge-warning text-base sm:text-lg px-3 sm:px-4 py-1 sm:py-2">8 Marks</div>
                </div>
                
                <div class="space-y-3 sm:space-y-4">
                    <div class="flex items-start">
                        <i class="bi bi-wifi-off text-orange-400 me-2 sm:me-3 mt-1 flex-shrink-0"></i>
                        <span class="text-sm sm:text-base text-gray-300">Implementation of basic offline functionality (like a local cache or offline-first approach)</span>
                    </div>
                    <div class="flex items-start">
                        <i class="bi bi-database text-orange-400 me-2 sm:me-3 mt-1 flex-shrink-0"></i>
                        <span class="text-sm sm:text-base text-gray-300">Even in online tools, having offline support can be beneficial for certain users</span>
                    </div>
                    <div class="flex items-start">
                        <i class="bi bi-terminal text-orange-400 me-2 sm:me-3 mt-1 flex-shrink-0"></i>
                        <span class="text-sm sm:text-base text-gray-300">Examples: console apps, local storage for critical data, etc.</span>
                    </div>
                </div>
            </div>

            <!-- 7. Open Source -->
            <div class="card p-4 sm:p-6 lg:p-8 border border-green-500/30">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4 sm:mb-6">
                    <div class="flex items-center mb-3 sm:mb-0">
                        <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-green-600 flex items-center justify-center mr-3 sm:mr-4">
                            <span class="text-white font-bold text-lg sm:text-xl">7</span>
                        </div>
                        <h3 class="text-lg sm:text-xl lg:text-2xl font-bold text-white">Leveraging Open-source Technology</h3>
                    </div>
                    <div class="badge badge-success text-base sm:text-lg px-3 sm:px-4 py-1 sm:py-2">7 Marks</div>
                </div>
                
                <div class="space-y-3 sm:space-y-4">
                    <div class="flex items-start">
                        <i class="bi bi-github text-green-400 me-2 sm:me-3 mt-1 flex-shrink-0"></i>
                        <span class="text-sm sm:text-base text-gray-300">Effective use of open-source tools or libraries that enhance the project</span>
                    </div>
                    <div class="flex items-start">
                        <i class="bi bi-heart text-green-400 me-2 sm:me-3 mt-1 flex-shrink-0"></i>
                        <span class="text-sm sm:text-base text-gray-300">Contributions to open-source projects (if applicable)</span>
                    </div>
                    <div class="flex items-start">
                        <i class="bi bi-puzzle-fill text-green-400 me-2 sm:me-3 mt-1 flex-shrink-0"></i>
                        <span class="text-sm sm:text-base text-gray-300">How well the open-source technologies fit into the project</span>
                    </div>
                </div>
            </div>

            <!-- 8. Frontend Design -->
            <div class="card p-4 sm:p-6 lg:p-8 border border-pink-500/30">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4 sm:mb-6">
                    <div class="flex items-center mb-3 sm:mb-0">
                        <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-pink-600 flex items-center justify-center mr-3 sm:mr-4">
                            <span class="text-white font-bold text-lg sm:text-xl">8</span>
                        </div>
                        <h3 class="text-lg sm:text-xl lg:text-2xl font-bold text-white">Frontend Design</h3>
                    </div>
                    <div class="badge badge-info text-base sm:text-lg px-3 sm:px-4 py-1 sm:py-2">10 Marks</div>
                </div>
                
                <div class="space-y-3 sm:space-y-4">
                    <div class="flex items-start">
                        <i class="bi bi-palette text-pink-400 me-2 sm:me-3 mt-1 flex-shrink-0"></i>
                        <span class="text-sm sm:text-base text-gray-300">Aesthetic appeal and usability of the user interface</span>
                    </div>
                    <div class="flex items-start">
                        <i class="bi bi-phone text-pink-400 me-2 sm:me-3 mt-1 flex-shrink-0"></i>
                        <span class="text-sm sm:text-base text-gray-300">Responsiveness, user flow, and accessibility</span>
                    </div>
                    <div class="flex items-start">
                        <i class="bi bi-brush text-pink-400 me-2 sm:me-3 mt-1 flex-shrink-0"></i>
                        <span class="text-sm sm:text-base text-gray-300">Use of modern frontend frameworks or libraries for a clean, functional UI</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="text-center mt-8 sm:mt-12 space-y-4 sm:space-y-6">
            @if(!$isGithubDeadlinePassed)
            <div class="space-y-3 sm:space-y-4">
                <a href="{{ route('codesprint.github.form') }}" class="btn btn-primary text-lg sm:text-xl px-6 sm:px-8 py-3 sm:py-4 inline-flex items-center">
                    <i class="bi bi-github me-2"></i>
                    Submit GitHub Repository
                </a>
                <p class="text-sm sm:text-base text-gray-400">
                    Deadline: {{ $githubDeadline->format('F j, Y \a\t g:i A') }}
                </p>
            </div>
            @endif
            
            <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 justify-center">
                <a href="{{ route('codesprint.register') }}" class="btn btn-secondary text-base sm:text-lg px-6 sm:px-8 py-3 sm:py-4">
                    <i class="bi bi-person-plus me-2"></i>
                    Register Team
                </a>
                <a href="{{ route('codesprint.rulebook') }}" class="btn btn-secondary text-base sm:text-lg px-6 sm:px-8 py-3 sm:py-4">
                    <i class="bi bi-book me-2"></i>
                    View Rulebook
                </a>
                <a href="{{ route('codesprint.stats') }}" class="btn btn-secondary text-base sm:text-lg px-6 sm:px-8 py-3 sm:py-4">
                    <i class="bi bi-graph-up me-2"></i>
                    Competition Stats
                </a>
            </div>
        </div>
    </div>

    @endif

    @include('layouts.footer')

    <script>
    @if(!$isGithubOpen)
        // Countdown functionality
        function updateCountdown() {
            // Target time: {{ $githubOpenTime->format('Y-m-d H:i:s') }} Bangladesh time
            const targetTime = new Date('{{ $githubOpenTime->toISOString() }}').getTime();
            const now = new Date().getTime();
            const timeLeft = targetTime - now;

            if (timeLeft > 0) {
                const days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
                const hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);

                document.getElementById('days').textContent = days.toString().padStart(2, '0');
                document.getElementById('hours').textContent = hours.toString().padStart(2, '0');
                document.getElementById('minutes').textContent = minutes.toString().padStart(2, '0');
                document.getElementById('seconds').textContent = seconds.toString().padStart(2, '0');
            } else {
                // Time's up! Refresh the page to show content
                location.reload();
            }
        }

        // Update current Bangladesh time
        function updateCurrentTime() {
            const now = new Date();
            // Convert to Bangladesh time (UTC+6)
            const bangladeshTime = new Date(now.getTime());
            const timeString = bangladeshTime.toLocaleString('en-US', {
                timeZone: 'Asia/Dhaka',
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                hour12: true
            });
            document.getElementById('current-time').textContent = timeString;
        }

        // Start the countdown and current time updates
        updateCountdown();
        updateCurrentTime();
        
        // Update every second
        setInterval(updateCountdown, 1000);
        setInterval(updateCurrentTime, 1000);

        // Add some animation effects
        document.addEventListener('DOMContentLoaded', function() {
            const countdownCards = document.querySelectorAll('#countdown-timer .card');
            countdownCards.forEach((card, index) => {
                card.style.animation = `fadeInUp 0.6s ease forwards`;
                card.style.animationDelay = `${index * 0.1}s`;
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
            });
        });

        // Add CSS animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes fadeInUp {
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
        `;
        document.head.appendChild(style);
        @else
        // GitHub submission opened - add smooth scrolling and animations
        document.addEventListener('DOMContentLoaded', function() {
            // Add intersection observer for animations
            const cards = document.querySelectorAll('.card');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, {
                threshold: 0.1,
                rootMargin: '50px'
            });

            cards.forEach(card => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                observer.observe(card);
            });
        });

        // Deadline countdown for GitHub submission
        @if(!$isGithubDeadlinePassed)
        function updateDeadlineCountdown() {
            const deadline = new Date('{{ $githubDeadline->toISOString() }}').getTime();
            const now = new Date().getTime();
            const timeLeft = deadline - now;

            if (timeLeft > 0) {
                const days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
                const hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
                
                console.log(`GitHub submission deadline: ${days}d ${hours}h ${minutes}m`);
            }
        }

        // Update deadline countdown every minute
        setInterval(updateDeadlineCountdown, 60000);
        updateDeadlineCountdown();
        @endif
    @endif
    </script>
</body>
</html>
