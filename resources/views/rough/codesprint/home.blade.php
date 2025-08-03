<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CodeSprint 2025 - IUTCS</title>
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta name="referrer" content="strict-origin-when-cross-origin">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/codesprint-style.css') }}">
    
    <!-- Modern Styles -->
    <style>
        /* Remove any legacy aggressive styles and keep it clean */
        .card {
            transition: all 0.2s ease;
        }
        
        .card:hover {
            transform: translateY(-2px);
        }
        
        /* Subtle animations only */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .fade-in {
            animation: fadeIn 0.6s ease-out;
        }
    </style>
</head>
<body>
    @include('layouts.dangling_header')
    
    <div class="container mx-auto px-4 py-12 max-w-7xl">
        <!-- Hero Section -->
        <header class="text-center mb-20 pt-8">
            @php
                $now = now();
                $registrationStart = \Carbon\Carbon::create(2025, 7, 13, 18, 0, 0); // July 13, 2025 6:00 PM
                $registrationEnd = \Carbon\Carbon::create(2025, 7, 23, 18, 0, 0);   // July 23, 2025 6:00 PM
                $competitionStart = \Carbon\Carbon::create(2025, 7, 16, 18, 0, 0);  // July 16, 2025 6:00 PM
                $projectEnd = \Carbon\Carbon::create(2025, 8, 3, 23, 59, 0);        // August 3, 2025 11:59 PM
            @endphp
            
            @if($now < $registrationStart)
                <div class="inline-block mb-6 px-6 py-2 bg-amber-900/30 text-amber-300 rounded-full text-lg font-medium border border-amber-700/50">
                    ⏰ Registration Opens {{ $registrationStart->format('M d, Y g:i A') }}
                </div>
            @elseif($now >= $registrationStart && $now < $registrationEnd)
                <div class="inline-block mb-6 px-6 py-2 bg-indigo-900/30 text-indigo-300 rounded-full text-lg font-medium border border-indigo-700/50">
                    🎯 Registration Open Now! (Closes {{ $registrationEnd->format('M d, g:i A') }})
                </div>
            @elseif($now >= $registrationEnd && $now < $competitionStart)
                <div class="inline-block mb-6 px-6 py-2 bg-emerald-900/30 text-emerald-300 rounded-full text-lg font-medium border border-emerald-700/50">
                    📋 Registration Closed - Competition Starts {{ $competitionStart->format('M d, g:i A') }}
                </div>
            @elseif($now >= $competitionStart && $now < $projectEnd)
                <div class="inline-block mb-6 px-6 py-2 bg-red-900/40 text-red-200 rounded-full text-lg font-medium border border-red-600/70 animate-pulse">
                    � FINAL SUBMISSION DAY! Deadline: {{ $projectEnd->format('M d, g:i A') }}
                </div>
            @else
                <div class="inline-block mb-6 px-6 py-2 bg-gray-900/30 text-gray-300 rounded-full text-lg font-medium border border-gray-700/50">
                    🏁 CodeSprint 2025 Completed
                </div>
            @endif
            
            <h1 class="text-6xl sm:text-7xl font-bold mb-6 header-gradient">
                IUTCS <span class="font-mono">CodeSprint 2025</span>
            </h1>
            <p class="text-2xl max-w-3xl mx-auto text-gray-300 mb-12">The Premier Coding Competition at IUT - Where Innovation Meets Excellence</p>
            
            <!-- URGENT PROJECT SUBMISSION CTA -->
            @if($now >= $competitionStart && $now < $projectEnd)
            <div class="mb-16">
                <div class="max-w-6xl mx-auto">
                    <!-- URGENT DEADLINE WARNING -->
                    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-red-900 via-red-800 to-orange-900 border-2 border-red-500/50 shadow-2xl shadow-red-500/20">
                        <!-- Animated background -->
                        <div class="absolute inset-0 bg-gradient-to-r from-red-500/10 via-transparent to-orange-500/10 animate-pulse"></div>
                        
                        <!-- Urgent indicator -->
                        <div class="absolute top-4 right-4">
                            <div class="flex items-center px-3 py-1 bg-red-500 rounded-full text-xs font-bold text-white animate-bounce">
                                🚨 URGENT
                            </div>
                        </div>
                        
                        <div class="relative p-8 lg:p-12 text-center">
                            <!-- Countdown or deadline info -->
                            <div class="mb-6">
                                <div class="inline-flex items-center px-4 py-2 bg-red-500/20 border border-red-400/40 rounded-full mb-4">
                                    <i class="bi bi-clock-fill text-red-300 mr-2"></i>
                                    <span class="text-sm font-medium text-red-200">FINAL DEADLINE TODAY</span>
                                </div>
                                <h2 class="text-4xl lg:text-6xl font-black text-white mb-4 leading-tight">
                                    🔥 SUBMIT YOUR 
                                    <span class="text-transparent bg-gradient-to-r from-yellow-400 to-red-400 bg-clip-text">
                                        FINAL PROJECT
                                    </span>
                                </h2>
                                <div class="text-2xl lg:text-3xl font-bold text-red-200 mb-2">
                                    Deadline: August 3, 2025 at 11:59 PM
                                </div>
                                <div class="text-lg text-red-300 mb-8">
                                    ⏰ Less than 24 hours remaining! Don't miss out!
                                </div>
                            </div>
                            
                            <!-- Key submission points -->
                            <div class="grid md:grid-cols-3 gap-6 mb-8 text-left">
                                <div class="bg-red-800/30 backdrop-blur-sm rounded-xl p-4 border border-red-600/30">
                                    <div class="flex items-center mb-2">
                                        <i class="bi bi-file-zip-fill text-yellow-400 text-xl mr-3"></i>
                                        <h4 class="font-bold text-white">Project ZIP</h4>
                                    </div>
                                    <p class="text-red-100 text-sm">Complete source code with documentation</p>
                                </div>
                                
                                <div class="bg-red-800/30 backdrop-blur-sm rounded-xl p-4 border border-red-600/30">
                                    <div class="flex items-center mb-2">
                                        <i class="bi bi-play-circle-fill text-yellow-400 text-xl mr-3"></i>
                                        <h4 class="font-bold text-white">Demo Video</h4>
                                    </div>
                                    <p class="text-red-100 text-sm">15-minute maximum project demonstration</p>
                                </div>
                                
                                <div class="bg-red-800/30 backdrop-blur-sm rounded-xl p-4 border border-red-600/30">
                                    <div class="flex items-center mb-2">
                                        <i class="bi bi-clipboard-check-fill text-yellow-400 text-xl mr-3"></i>
                                        <h4 class="font-bold text-white">Requirements</h4>
                                    </div>
                                    <p class="text-red-100 text-sm">All mandatory fields and documentation</p>
                                </div>
                            </div>
                            
                            <!-- CTA Buttons -->
                            <div class="flex flex-col sm:flex-row justify-center gap-4 mb-6">
                                <a href="{{ route('codesprint.project.form') }}" 
                                   class="group relative inline-flex items-center justify-center px-12 py-6 bg-gradient-to-r from-yellow-500 to-red-500 rounded-2xl font-black text-xl text-black transition-all duration-300 hover:shadow-2xl hover:shadow-yellow-500/30 hover:-translate-y-1 transform">
                                    <i class="bi bi-upload text-2xl mr-3"></i>
                                    <span>SUBMIT PROJECT NOW</span>
                                    <div class="absolute -top-2 -right-2 w-6 h-6 bg-red-500 rounded-full animate-ping"></div>
                                </a>
                                
                                <a href="{{ route('codesprint.status.lookup') }}" 
                                   class="group inline-flex items-center justify-center px-8 py-6 bg-red-800/50 border-2 border-red-500/50 rounded-2xl font-bold text-lg text-red-100 transition-all duration-300 hover:bg-red-700/50 hover:border-red-400/70">
                                    <i class="bi bi-search text-xl mr-3"></i>
                                    <span>Check Submission Status</span>
                                </a>
                            </div>
                            
                            <!-- Warning message -->
                            <div class="bg-yellow-900/40 border border-yellow-600/50 rounded-lg p-4 max-w-2xl mx-auto">
                                <div class="flex items-center justify-center text-yellow-200">
                                    <i class="bi bi-exclamation-triangle-fill text-yellow-400 text-lg mr-2"></i>
                                    <span class="font-semibold text-sm">
                                        Submissions cannot be modified after the deadline. Submit early to avoid last-minute issues!
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            
            <!-- MODERN REQUIREMENTS CTA -->
            @if($now >= $competitionStart)
            <div class="mb-16">
                <div class="max-w-5xl mx-auto">
                    <!-- Modern Card Design -->
                    <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 border border-gray-700/50 shadow-2xl">
                        <!-- Subtle accent border -->
                        <div class="absolute inset-0 bg-gradient-to-r from-purple-500/20 via-transparent to-purple-500/20 pointer-events-none"></div>
                        
                        <div class="relative p-8 lg:p-12">
                            <!-- Status Badge -->
                            <div class="flex justify-center mb-6">
                                <div class="inline-flex items-center px-4 py-2 bg-purple-500/10 border border-purple-500/20 rounded-full">
                                    <div class="w-2 h-2 bg-purple-400 rounded-full mr-2 animate-pulse"></div>
                                    <span class="text-sm font-medium text-purple-300">Competition Phase Active</span>
                                </div>
                            </div>
                            
                            <!-- Content Grid -->
                            <div class="grid lg:grid-cols-2 gap-8 lg:gap-12 items-center">
                                <!-- Left: Content -->
                                <div class="text-center lg:text-left">
                                    <h2 class="text-3xl lg:text-4xl font-bold text-white mb-4 leading-tight">
                                        Project Requirements & 
                                        <span class="text-transparent bg-gradient-to-r from-purple-400 to-pink-400 bg-clip-text">
                                            Marking Criteria
                                        </span>
                                    </h2>
                                    
                                    <p class="text-lg text-gray-300 mb-6 leading-relaxed">
                                        Essential guidelines now available. Understand the <strong class="text-white">100-mark evaluation system</strong> 
                                        and project requirements before you start coding.
                                    </p>
                                    
                                    <!-- Key Points -->
                                    <div class="space-y-3 mb-8">
                                        <div class="flex items-center text-sm text-gray-300 justify-center lg:justify-start">
                                            <svg class="w-5 h-5 text-green-400 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                            </svg>
                                            <span>8 evaluation categories breakdown</span>
                                        </div>
                                        <div class="flex items-center text-sm text-gray-300 justify-center lg:justify-start">
                                            <svg class="w-5 h-5 text-green-400 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                            </svg>
                                            <span>Complete project specifications</span>
                                        </div>
                                        <div class="flex items-center text-sm text-gray-300 justify-center lg:justify-start">
                                            <svg class="w-5 h-5 text-green-400 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                            </svg>
                                            <span>Submission guidelines & deadlines</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Right: Actions -->
                                <div class="flex flex-col space-y-4">
                                    <!-- Primary CTA -->
                                    <a href="{{ route('codesprint.requirements') }}" 
                                       class="group relative inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-purple-600 to-pink-600 rounded-xl font-semibold text-white transition-all duration-200 hover:shadow-lg hover:shadow-purple-500/25 hover:-translate-y-0.5">
                                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <span>View Requirements & Criteria</span>
                                        <svg class="w-4 h-4 ml-2 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                        </svg>
                                    </a>
                                    
                                    <!-- Secondary CTA -->
                                    <a href="{{ route('codesprint.rulebook') }}" 
                                       class="group inline-flex items-center justify-center px-8 py-4 bg-gray-800 border border-gray-600 rounded-xl font-medium text-gray-300 transition-all duration-200 hover:bg-gray-700 hover:text-white hover:border-gray-500">
                                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                        </svg>
                                        <span>Complete Rulebook</span>
                                    </a>
                                    
                                    <!-- Info Note -->
                                    <div class="flex items-center justify-center lg:justify-start text-xs text-gray-400 mt-4">
                                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                                        </svg>
                                        <span>Updated: Today at 6:00 PM</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <div class="flex flex-col sm:flex-row gap-6 justify-center">
                @if($now >= $competitionStart && $now < $projectEnd)
                    <!-- PRIORITY: Project submission -->
                    <a href="{{ route('codesprint.project.form') }}" class="btn btn-primary text-xl px-8 py-4 bg-gradient-to-r from-red-600 to-orange-600 hover:from-red-700 hover:to-orange-700 animate-pulse">
                        <i class="bi bi-upload me-2"></i>
                        🚨 SUBMIT FINAL PROJECT
                    </a>
                    <a href="{{ route('codesprint.github.form') }}" class="btn btn-outline text-xl px-8 py-4">
                        <i class="bi bi-github me-2"></i>
                        Submit GitHub Repository
                    </a>
                @elseif($now >= $registrationStart && $now < $registrationEnd)
                    <a href="{{ route('codesprint.register') }}" class="btn btn-primary text-xl px-8 py-4">
                        <i class="bi bi-rocket me-2"></i>
                        Register Your Team
                    </a>
                @elseif($now < $registrationStart)
                    <button class="btn btn-secondary text-xl px-8 py-4 opacity-50 cursor-not-allowed" disabled>
                        <i class="bi bi-clock me-2"></i>
                        Registration Not Started
                    </button>
                @elseif($now >= $registrationEnd && $now < $competitionStart)
                    <a href="{{ route('codesprint.status.lookup') }}" class="btn btn-primary text-xl px-8 py-4">
                        <i class="bi bi-search me-2"></i>
                        Check Your Status
                    </a>
                @elseif($now > \Carbon\Carbon::create(2025, 7, 23, 18, 0, 0) && $now <= \Carbon\Carbon::create(2025, 8, 3, 23, 59, 0))
                    <!-- Project submission phase -->
                    <a href="{{ route('codesprint.project.form') }}" class="btn btn-primary text-xl px-8 py-4">
                        <i class="bi bi-upload me-2"></i>
                        Submit Final Project
                    </a>
                    <a href="{{ route('codesprint.github.form') }}" class="btn btn-outline text-xl px-8 py-4">
                        <i class="bi bi-github me-2"></i>
                        Submit GitHub Repository
                    </a>
                @else
                    <a href="{{ route('codesprint.status.lookup') }}" class="btn btn-primary text-xl px-8 py-4">
                        <i class="bi bi-search me-2"></i>
                        Check Your Status
                    </a>
                @endif
                
                <a href="{{ route('codesprint.rulebook') }}" class="btn btn-secondary text-xl px-8 py-4">
                    <i class="bi bi-book me-2"></i>
                    View Rulebook
                </a>
            </div>
        </header>

        <!-- Key Highlights -->
        <section class="mb-20">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="card p-8 text-center glow">
                    <div class="w-20 h-20 mx-auto mb-6 rounded-full bg-indigo-900/30 flex items-center justify-center">
                        <i class="bi bi-calendar-event text-indigo-400 text-3xl"></i>
                    </div>
                    <h3 class="font-bold text-xl mb-3 text-white">Competition Period</h3>
                    <p class="text-gray-300">July 16 - July 30, 2025</p>
                    <p class="text-sm text-gray-400 mt-2">14 days to build your dream project</p>
                </div>
                
                <div class="card p-8 text-center">
                    <div class="w-20 h-20 mx-auto mb-6 rounded-full bg-emerald-900/30 flex items-center justify-center">
                        <i class="bi bi-people text-emerald-400 text-3xl"></i>
                    </div>
                    <h3 class="font-bold text-xl mb-3 text-white">Team Formation</h3>
                    <p class="text-gray-300">1-3 Members per Team</p>
                    <p class="text-sm text-gray-400 mt-2">Solo or collaborate with friends</p>
                </div>
                
                <div class="card p-8 text-center">
                    <div class="w-20 h-20 mx-auto mb-6 rounded-full bg-purple-900/30 flex items-center justify-center">
                        <i class="bi bi-trophy text-purple-400 text-3xl"></i>
                    </div>
                    <h3 class="font-bold text-xl mb-3 text-white">Recognition</h3>
                    <p class="text-gray-300">Top 10 Teams Present</p>
                    <p class="text-sm text-gray-400 mt-2">Onsite presentation for finalists</p>
                </div>
                
                <div class="card p-8 text-center">
                    <div class="w-20 h-20 mx-auto mb-6 rounded-full bg-amber-900/30 flex items-center justify-center">
                        <i class="bi bi-cash text-amber-400 text-3xl"></i>
                    </div>
                    <h3 class="font-bold text-xl mb-3 text-white">Registration Fee</h3>
                    <p class="text-gray-300">Only 150 Taka</p>
                    {{-- <p class="text-sm text-gray-400 mt-2">Affordable for all students</p> --}}
                </div>
            </div>
        </section>

        <!-- Timeline -->
        <section class="mb-20">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold mb-4 header-gradient">Competition Timeline</h2>
                <p class="text-xl text-gray-300">Stay updated with important dates and deadlines</p>
            </div>
            
            <div class="max-w-4xl mx-auto">
                <div class="timeline">
                    <div class="timeline-item mb-10">
                        <div class="card p-8">
                            <h3 class="text-2xl font-bold text-white mb-3">Registration Opens</h3>
                            <div class="text-lg font-semibold text-indigo-300 mb-2">July 13, 2025 - 6:00 PM</div>
                            <p class="text-gray-300">Team registration and payment submission begins</p>
                        </div>
                    </div>
                    
                    <div class="timeline-item mb-10">
                        <div class="card p-8">
                            <h3 class="text-2xl font-bold text-white mb-3">Competition Begins</h3>
                            <div class="text-lg font-semibold text-emerald-300 mb-2">July 16, 2025 - 6:00 PM</div>
                            <p class="text-gray-300">Project requirements published, development phase starts</p>
                        </div>
                    </div>
                    
                    <div class="timeline-item mb-10">
                        <div class="card p-8">
                            <h3 class="text-2xl font-bold text-white mb-3">GitHub Submission Deadline</h3>
                            <div class="text-lg font-semibold text-amber-300 mb-2">July 23, 2025 - 6:00 PM</div>
                            <p class="text-gray-300">Final deadline for registration and GitHub repository submission</p>
                        </div>
                    </div>
                    
                    <div class="timeline-item mb-10">
                        <div class="card p-8">
                            <h3 class="text-2xl font-bold text-white mb-3">Final Submission</h3>
                            <div class="text-lg font-semibold text-rose-300 mb-2">August 3, 2025 - 11:59 PM</div>
                            <p class="text-gray-300">Complete project submission with demo video</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Quick Actions -->
        <section class="mb-20">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold mb-4 header-gradient">Quick Actions</h2>
                <p class="text-xl text-gray-300">Everything you need for CodeSprint 2025</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @if($now >= $competitionStart)
                    <a href="{{ route('codesprint.requirements') }}" class="card p-8 hover:scale-105 transition-transform group border-2 border-purple-500/30 glow">
                        <div class="flex items-center mb-4">
                            <div class="icon-container">
                                <i class="bi bi-list-check text-purple-400"></i>
                            </div>
                            <h3 class="font-bold text-xl text-white">Requirements & Criteria</h3>
                        </div>
                        <p class="text-gray-300">Essential project guidelines and marking criteria (100 marks)</p>
                        <div class="mt-4 text-purple-400 group-hover:text-purple-300">
                            View Details <i class="bi bi-arrow-right ml-2"></i>
                        </div>
                    </a>
                @endif
                
                @if($now >= $registrationStart && $now < $registrationEnd)
                    <a href="{{ route('codesprint.register') }}" class="card p-8 hover:scale-105 transition-transform group">
                        <div class="flex items-center mb-4">
                            <div class="icon-container">
                                <i class="bi bi-person-plus text-indigo-400"></i>
                            </div>
                            <h3 class="font-bold text-xl text-white">Register Team</h3>
                        </div>
                        <p class="text-gray-300">Start your CodeSprint journey by registering your team</p>
                        <div class="mt-4 text-indigo-400 group-hover:text-indigo-300">
                            Get Started <i class="bi bi-arrow-right ml-2"></i>
                        </div>
                    </a>
                @elseif($now < $registrationStart)
                    <div class="card p-8 opacity-50 cursor-not-allowed">
                        <div class="flex items-center mb-4">
                            <div class="icon-container">
                                <i class="bi bi-clock text-amber-400"></i>
                            </div>
                            <h3 class="font-bold text-xl text-white">Registration Opens Soon</h3>
                        </div>
                        <p class="text-gray-300">Registration starts {{ $registrationStart->format('M d, Y g:i A') }}</p>
                        <div class="mt-4 text-amber-400">
                            Coming Soon <i class="bi bi-clock ml-2"></i>
                        </div>
                    </div>
                @else
                    <div class="card p-8 opacity-75">
                        <div class="flex items-center mb-4">
                            <div class="icon-container">
                                <i class="bi bi-x-circle text-gray-400"></i>
                            </div>
                            <h3 class="font-bold text-xl text-white">Registration Closed</h3>
                        </div>
                        <p class="text-gray-300">Registration period has ended</p>
                        <div class="mt-4 text-gray-400">
                            Closed <i class="bi bi-x-circle ml-2"></i>
                        </div>
                    </div>
                @endif
                
                <a href="{{ route('codesprint.status.lookup') }}" class="card p-8 hover:scale-105 transition-transform group">
                    <div class="flex items-center mb-4">
                        <div class="icon-container">
                            <i class="bi bi-search text-emerald-400"></i>
                        </div>
                        <h3 class="font-bold text-xl text-white">Check Status</h3>
                    </div>
                    <p class="text-gray-300">Track your registration and submission progress</p>
                    <div class="mt-4 text-emerald-400 group-hover:text-emerald-300">
                        Check Now <i class="bi bi-arrow-right ml-2"></i>
                    </div>
                </a>
                
                <a href="{{ route('codesprint.rulebook') }}" class="card p-8 hover:scale-105 transition-transform group">
                    <div class="flex items-center mb-4">
                        <div class="icon-container">
                            <i class="bi bi-book text-purple-400"></i>
                        </div>
                        <h3 class="font-bold text-xl text-white">Rulebook</h3>
                    </div>
                    <p class="text-gray-300">Read detailed rules, guidelines, and judging criteria</p>
                    <div class="mt-4 text-purple-400 group-hover:text-purple-300">
                        Read More <i class="bi bi-arrow-right ml-2"></i>
                    </div>
                </a>
            </div>
        </section>

        <!-- Statistics -->
        <section class="mb-20">
            <div class="card p-12">
                <div class="text-center mb-12">
                    <h2 class="text-4xl font-bold mb-4 header-gradient">Live Statistics</h2>
                    <p class="text-xl text-gray-300">See the competition progress in real-time</p>
                </div>
                
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                    <div class="text-center">
                        <div class="text-4xl font-bold text-indigo-400 mb-2" id="total-teams">-</div>
                        <div class="text-gray-400">Total Teams</div>
                    </div>
                    <div class="text-center">
                        <div class="text-4xl font-bold text-green-400 mb-2" id="verified-teams">-</div>
                        <div class="text-gray-400">Verified Teams</div>
                    </div>
                    <div class="text-center">
                        <div class="text-4xl font-bold text-purple-400 mb-2" id="github-submitted">-</div>
                        <div class="text-gray-400">GitHub Submitted</div>
                    </div>
                    <div class="text-center">
                        <div class="text-4xl font-bold text-amber-400 mb-2" id="projects-submitted">-</div>
                        <div class="text-gray-400">Projects Submitted</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Call to Action -->
        <section class="text-center">
            <div class="card p-12 glow">
                <h2 class="text-4xl font-bold mb-6 header-gradient">Ready to Code the Future?</h2>
                <p class="text-xl text-gray-300 mb-8 max-w-2xl mx-auto">
                    Join hundreds of talented students in an exciting coding competition at IUT. 
                    Showcase your skills, learn new technologies
                </p>
                <div class="flex flex-col sm:flex-row gap-6 justify-center">
                    @if($now >= $competitionStart && $now < $projectEnd)
                        <a href="{{ route('codesprint.project.form') }}" class="btn btn-primary text-xl px-10 py-4 bg-gradient-to-r from-red-600 to-orange-600 hover:from-red-700 hover:to-orange-700">
                            <i class="bi bi-upload me-2"></i>
                            🚨 Submit Final Project NOW
                        </a>
                    @elseif($now >= $registrationStart && $now < $registrationEnd)
                        <a href="{{ route('codesprint.register') }}" class="btn btn-primary text-xl px-10 py-4">
                            <i class="bi bi-rocket me-2"></i>
                            Register Now
                        </a>
                    @elseif($now < $registrationStart)
                        <button class="btn btn-secondary text-xl px-10 py-4 opacity-50 cursor-not-allowed" disabled>
                            <i class="bi bi-clock me-2"></i>
                            Registration Opens {{ $registrationStart->format('M d') }}
                        </button>
                    @elseif($now >= $registrationEnd && $now < $competitionStart)
                        <a href="{{ route('codesprint.status.lookup') }}" class="btn btn-primary text-xl px-10 py-4">
                            <i class="bi bi-search me-2"></i>
                            Check Your Status
                        </a>
                    @elseif($now > \Carbon\Carbon::create(2025, 7, 23, 18, 0, 0) && $now <= \Carbon\Carbon::create(2025, 8, 3, 23, 59, 0))
                        <!-- Project submission phase -->
                        <a href="{{ route('codesprint.project.form') }}" class="btn btn-primary text-xl px-10 py-4">
                            <i class="bi bi-upload me-2"></i>
                            Submit Final Project
                        </a>
                    @else
                        <a href="{{ route('codesprint.status.lookup') }}" class="btn btn-primary text-xl px-10 py-4">
                            <i class="bi bi-search me-2"></i>
                            Check Your Status
                        </a>
                    @endif
                    
                    <a href="{{ route('codesprint.status.lookup') }}" class="btn btn-secondary text-xl px-10 py-4">
                        <i class="bi bi-search me-2"></i>
                        Check Status
                    </a>
                </div>
            </div>
        </section>
    </div>

    @include('layouts.footer')

    <script>
        // Load statistics
        async function loadStatistics() {
            try {
                const response = await fetch('{{ route("codesprint.api.stats") }}');
                const stats = await response.json();
                
                document.getElementById('total-teams').textContent = stats.total || 0;
                document.getElementById('verified-teams').textContent = stats.verified || 0;
                document.getElementById('github-submitted').textContent = stats.github_submitted || 0;
                document.getElementById('projects-submitted').textContent = stats.project_submitted || 0;
            } catch (error) {
                console.log('Could not load statistics');
                // Set default values if API fails
                document.getElementById('total-teams').textContent = '0';
                document.getElementById('verified-teams').textContent = '0';
                document.getElementById('github-submitted').textContent = '0';
                document.getElementById('projects-submitted').textContent = '0';
            }
        }

        // Load statistics on page load
        document.addEventListener('DOMContentLoaded', function() {
            loadStatistics();
            // Refresh every 30 seconds
            setInterval(loadStatistics, 30000);
        });

        // Add smooth scroll animation for internal links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>
</body>
</html>
