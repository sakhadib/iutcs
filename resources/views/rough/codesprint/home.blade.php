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
    
    <!-- Enhanced CTA Styles -->
    <style>
        @keyframes glow-intense {
            0%, 100% { box-shadow: 0 0 20px rgba(168, 85, 247, 0.4), 0 0 40px rgba(236, 72, 153, 0.3), 0 0 60px rgba(239, 68, 68, 0.2); }
            50% { box-shadow: 0 0 40px rgba(168, 85, 247, 0.6), 0 0 60px rgba(236, 72, 153, 0.5), 0 0 80px rgba(239, 68, 68, 0.4); }
        }
        
        .glow-intense {
            animation: glow-intense 2s ease-in-out infinite alternate;
        }
        
        .btn-mega-primary {
            @apply relative px-8 py-4 rounded-xl font-bold text-xl text-white overflow-hidden transition-all duration-300 transform hover:scale-105 active:scale-95;
            background: linear-gradient(45deg, #8b5cf6, #ec4899, #ef4444);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3), 0 0 30px rgba(168, 85, 247, 0.3);
        }
        
        .btn-mega-primary:hover {
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.4), 0 0 40px rgba(168, 85, 247, 0.5);
        }
        
        .btn-secondary-glow {
            @apply px-6 py-3 rounded-lg font-semibold text-lg text-white border-2 transition-all duration-300 transform hover:scale-105;
            background: rgba(75, 85, 99, 0.5);
            border-color: rgba(168, 85, 247, 0.5);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2), 0 0 20px rgba(168, 85, 247, 0.2);
        }
        
        .btn-secondary-glow:hover {
            background: rgba(168, 85, 247, 0.3);
            border-color: rgba(168, 85, 247, 0.8);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3), 0 0 30px rgba(168, 85, 247, 0.4);
        }
        
        .border-gradient-to-r {
            border-image: linear-gradient(45deg, #8b5cf6, #ec4899, #ef4444) 1;
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
                $registrationEnd = \Carbon\Carbon::create(2025, 7, 22, 18, 0, 0);   // July 22, 2025 6:00 PM
                $competitionStart = \Carbon\Carbon::create(2025, 7, 16, 18, 0, 0);  // July 16, 2025 6:00 PM
                $projectEnd = \Carbon\Carbon::create(2025, 7, 30, 23, 59, 0);       // July 30, 2025 11:59 PM
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
                <div class="inline-block mb-6 px-6 py-2 bg-purple-900/30 text-purple-300 rounded-full text-lg font-medium border border-purple-700/50">
                    🚀 Competition Active! (Ends {{ $projectEnd->format('M d, g:i A') }})
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
            
            <!-- AGGRESSIVE REQUIREMENTS CTA - MAXIMUM PRIORITY -->
            @if($now >= $competitionStart)
            <div class="mb-12 relative">
                <!-- Animated Background Elements -->
                <div class="absolute inset-0 bg-gradient-to-r from-purple-600/20 via-pink-600/20 to-red-600/20 blur-xl animate-pulse"></div>
                <div class="absolute -inset-4 bg-gradient-to-r from-purple-600 via-pink-600 to-red-600 rounded-2xl opacity-20 animate-pulse"></div>
                
                <!-- Main CTA Card -->
                <div class="relative max-w-4xl mx-auto transform hover:scale-105 transition-all duration-300">
                    <div class="card p-8 lg:p-12 border-4 border-gradient-to-r from-purple-500 via-pink-500 to-red-500 glow-intense bg-gradient-to-br from-purple-900/50 via-pink-900/50 to-red-900/50 backdrop-blur-sm">
                        <!-- Pulsing Alert Icon -->
                        <div class="text-center mb-6">
                            <div class="relative inline-block">
                                <div class="absolute inset-0 bg-gradient-to-r from-purple-400 via-pink-400 to-red-400 rounded-full blur-lg opacity-75 animate-ping"></div>
                                <i class="bi bi-exclamation-triangle-fill text-6xl text-transparent bg-gradient-to-r from-purple-400 via-pink-400 to-red-400 bg-clip-text relative animate-bounce"></i>
                            </div>
                        </div>
                        
                        <!-- Main Headline -->
                        <div class="text-center mb-8">
                            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-black mb-4 text-transparent bg-gradient-to-r from-purple-300 via-pink-300 to-red-300 bg-clip-text animate-pulse">
                                🚨 CRITICAL: PROJECT GUIDELINES RELEASED! 🚨
                            </h2>
                            <div class="text-xl sm:text-2xl font-bold text-white mb-4 animate-pulse">
                                ⚡ 100 MARKS BREAKDOWN ⚡ EVALUATION CRITERIA ⚡
                            </div>
                            <p class="text-lg sm:text-xl text-gray-200 max-w-2xl mx-auto leading-relaxed">
                                <span class="font-bold text-yellow-300">MANDATORY READ:</span> Complete marking criteria, project requirements, and submission guidelines. 
                                <span class="font-bold text-red-300">Don't code blindly!</span>
                            </p>
                        </div>
                        
                        <!-- Dual Action Buttons -->
                        <div class="flex flex-col sm:flex-row gap-4 sm:gap-6 justify-center items-center">
                            <a href="{{ route('codesprint.requirements') }}" class="btn-mega-primary group relative overflow-hidden">
                                <div class="absolute inset-0 bg-gradient-to-r from-purple-600 via-pink-600 to-red-600 transform group-hover:scale-110 transition-transform duration-300"></div>
                                <div class="relative flex items-center px-8 py-4 text-xl font-bold text-white">
                                    <i class="bi bi-list-check me-3 text-2xl group-hover:animate-bounce"></i>
                                    VIEW REQUIREMENTS & CRITERIA
                                    <i class="bi bi-arrow-right ml-3 text-2xl group-hover:translate-x-2 transition-transform"></i>
                                </div>
                            </a>
                            
                            <a href="{{ route('codesprint.rulebook') }}" class="btn-secondary-glow group">
                                <i class="bi bi-book me-2 group-hover:animate-pulse"></i>
                                Complete Rulebook
                            </a>
                        </div>
                        
                        <!-- Urgency Indicator -->
                        <div class="mt-8 text-center">
                            <div class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-red-900/50 to-orange-900/50 border border-red-500/50 rounded-full">
                                <i class="bi bi-clock-fill text-red-400 me-2 animate-pulse"></i>
                                <span class="text-red-200 font-semibold">Competition Active - Every Mark Counts!</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <div class="flex flex-col sm:flex-row gap-6 justify-center">
                @if($now >= $registrationStart && $now < $registrationEnd)
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
                @elseif($now >= $competitionStart && $now <= \Carbon\Carbon::create(2025, 7, 22, 18, 0, 0))
                    <!-- GitHub submission phase -->
                    <a href="{{ route('codesprint.github.form') }}" class="btn btn-primary text-xl px-8 py-4">
                        <i class="bi bi-github me-2"></i>
                        Submit GitHub Repository
                    </a>
                    <a href="{{ route('codesprint.status.lookup') }}" class="btn btn-outline text-xl px-8 py-4">
                        <i class="bi bi-search me-2"></i>
                        Check Status
                    </a>
                @elseif($now > \Carbon\Carbon::create(2025, 7, 22, 18, 0, 0) && $now <= \Carbon\Carbon::create(2025, 7, 30, 23, 59, 0))
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
                            <div class="text-lg font-semibold text-amber-300 mb-2">July 22, 2025 - 6:00 PM</div>
                            <p class="text-gray-300">Final deadline for registration and GitHub repository submission</p>
                        </div>
                    </div>
                    
                    <div class="timeline-item mb-10">
                        <div class="card p-8">
                            <h3 class="text-2xl font-bold text-white mb-3">Final Submission</h3>
                            <div class="text-lg font-semibold text-rose-300 mb-2">July 30, 2025 - 11:59 PM</div>
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
                    @if($now >= $registrationStart && $now < $registrationEnd)
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
                    @elseif($now >= $competitionStart && $now <= \Carbon\Carbon::create(2025, 7, 22, 18, 0, 0))
                        <!-- GitHub submission phase -->
                        <a href="{{ route('codesprint.github.form') }}" class="btn btn-primary text-xl px-10 py-4">
                            <i class="bi bi-github me-2"></i>
                            Submit GitHub Repository
                        </a>
                    @elseif($now > \Carbon\Carbon::create(2025, 7, 22, 18, 0, 0) && $now <= \Carbon\Carbon::create(2025, 7, 30, 23, 59, 0))
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
