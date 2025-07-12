<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Competition Statistics - CodeSprint 2025</title>
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
        <header class="text-center mb-16 pt-8">
            <div class="mb-8">
                <div class="w-24 h-24 mx-auto mb-6 rounded-full bg-indigo-900/30 flex items-center justify-center">
                    <i class="bi bi-graph-up text-indigo-400 text-5xl"></i>
                </div>
                <h1 class="text-4xl sm:text-5xl font-bold mb-4 header-gradient">
                    Competition Statistics
                </h1>
                <p class="text-xl max-w-2xl mx-auto text-gray-300">Real-time statistics for CodeSprint 2025</p>
            </div>
        </header>

        <!-- Last Updated -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center px-4 py-2 rounded-full bg-gray-800/50 border border-gray-600/30">
                <i class="bi bi-clock text-gray-400 me-2"></i>
                <span class="text-gray-300">Last updated: {{ now()->format('M d, Y H:i:s') }}</span>
            </div>
        </div>

        <!-- Main Statistics Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
            <!-- Total Registrations -->
            <div class="card p-6 text-center group hover:scale-105 transition-transform duration-300">
                <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-indigo-900/30 flex items-center justify-center group-hover:bg-indigo-800/40 transition-colors">
                    <i class="bi bi-people text-indigo-400 text-3xl"></i>
                </div>
                <div class="text-3xl font-bold text-white mb-2">{{ $stats['total'] }}</div>
                <div class="text-gray-300 font-medium">Total Teams</div>
                <div class="text-sm text-gray-400 mt-1">Registered</div>
            </div>

            <!-- Verified Payments -->
            <div class="card p-6 text-center group hover:scale-105 transition-transform duration-300">
                <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-emerald-900/30 flex items-center justify-center group-hover:bg-emerald-800/40 transition-colors">
                    <i class="bi bi-check-circle text-emerald-400 text-3xl"></i>
                </div>
                <div class="text-3xl font-bold text-white mb-2">{{ $stats['verified'] }}</div>
                <div class="text-gray-300 font-medium">Verified Teams</div>
                <div class="text-sm text-gray-400 mt-1">Payment Confirmed</div>
            </div>

            <!-- GitHub Submissions -->
            <div class="card p-6 text-center group hover:scale-105 transition-transform duration-300">
                <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-purple-900/30 flex items-center justify-center group-hover:bg-purple-800/40 transition-colors">
                    <i class="bi bi-github text-purple-400 text-3xl"></i>
                </div>
                <div class="text-3xl font-bold text-white mb-2">{{ $stats['github_submitted'] }}</div>
                <div class="text-gray-300 font-medium">GitHub Repos</div>
                <div class="text-sm text-gray-400 mt-1">Submitted</div>
            </div>

            <!-- Project Submissions -->
            <div class="card p-6 text-center group hover:scale-105 transition-transform duration-300">
                <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-amber-900/30 flex items-center justify-center group-hover:bg-amber-800/40 transition-colors">
                    <i class="bi bi-trophy text-amber-400 text-3xl"></i>
                </div>
                <div class="text-3xl font-bold text-white mb-2">{{ $stats['project_submitted'] }}</div>
                <div class="text-gray-300 font-medium">Final Projects</div>
                <div class="text-sm text-gray-400 mt-1">Submitted</div>
            </div>
        </div>

        <!-- Progress Indicators -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12">
            <!-- Payment Verification Progress -->
            <div class="card p-8">
                <div class="flex items-center mb-6">
                    <div class="icon-container">
                        <i class="bi bi-credit-card text-emerald-400"></i>
                    </div>
                    <h2 class="text-2xl font-bold section-title">Payment Verification</h2>
                </div>
                
                <div class="space-y-4">
                    @php
                        $verificationRate = $stats['total'] > 0 ? ($stats['verified'] / $stats['total']) * 100 : 0;
                        $pending = $stats['total'] - $stats['verified'];
                    @endphp
                    
                    <div class="flex justify-between items-center">
                        <span class="text-gray-300">Verification Rate</span>
                        <span class="font-bold text-emerald-400">{{ number_format($verificationRate, 1) }}%</span>
                    </div>
                    
                    <div class="w-full bg-gray-700 rounded-full h-3">
                        <div class="bg-gradient-to-r from-emerald-500 to-emerald-400 h-3 rounded-full transition-all duration-1000 ease-out" 
                             style="width: {{ $verificationRate }}%"></div>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4 text-sm">
                        <div class="text-center p-3 rounded-lg bg-emerald-900/20 border border-emerald-500/30">
                            <div class="font-bold text-emerald-400">{{ $stats['verified'] }}</div>
                            <div class="text-gray-300">Verified</div>
                        </div>
                        <div class="text-center p-3 rounded-lg bg-amber-900/20 border border-amber-500/30">
                            <div class="font-bold text-amber-400">{{ $pending }}</div>
                            <div class="text-gray-300">Pending</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submission Progress -->
            <div class="card p-8">
                <div class="flex items-center mb-6">
                    <div class="icon-container">
                        <i class="bi bi-upload text-purple-400"></i>
                    </div>
                    <h2 class="text-2xl font-bold section-title">Submission Progress</h2>
                </div>
                
                <div class="space-y-6">
                    <!-- GitHub Submissions -->
                    @php
                        $githubRate = $stats['verified'] > 0 ? ($stats['github_submitted'] / $stats['verified']) * 100 : 0;
                    @endphp
                    
                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-gray-300">GitHub Repos</span>
                            <span class="font-bold text-purple-400">{{ $stats['github_submitted'] }}/{{ $stats['verified'] }}</span>
                        </div>
                        <div class="w-full bg-gray-700 rounded-full h-2">
                            <div class="bg-gradient-to-r from-purple-500 to-purple-400 h-2 rounded-full transition-all duration-1000 ease-out" 
                                 style="width: {{ $githubRate }}%"></div>
                        </div>
                    </div>

                    <!-- Project Submissions -->
                    @php
                        $projectRate = $stats['verified'] > 0 ? ($stats['project_submitted'] / $stats['verified']) * 100 : 0;
                    @endphp
                    
                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-gray-300">Final Projects</span>
                            <span class="font-bold text-amber-400">{{ $stats['project_submitted'] }}/{{ $stats['verified'] }}</span>
                        </div>
                        <div class="w-full bg-gray-700 rounded-full h-2">
                            <div class="bg-gradient-to-r from-amber-500 to-amber-400 h-2 rounded-full transition-all duration-1000 ease-out" 
                                 style="width: {{ $projectRate }}%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Competition Timeline -->
        <div class="card p-8 mb-12">
            <div class="flex items-center mb-8">
                <div class="icon-container">
                    <i class="bi bi-calendar-event text-indigo-400"></i>
                </div>
                <h2 class="text-2xl font-bold section-title">Competition Timeline</h2>
            </div>
            
            <div class="space-y-6">
                @php
                    $now = now();
                    $registrationDeadline = \Carbon\Carbon::create(2025, 7, 22, 18, 0, 0);
                    $competitionStart = \Carbon\Carbon::create(2025, 7, 16, 18, 0, 0);
                    $githubDeadline = \Carbon\Carbon::create(2025, 7, 22, 18, 0, 0);
                    $projectDeadline = \Carbon\Carbon::create(2025, 7, 30, 23, 59, 0);
                @endphp

                <!-- Registration Phase -->
                <div class="flex items-center p-4 rounded-lg {{ $now < $registrationDeadline ? 'bg-emerald-900/20 border border-emerald-500/30' : 'bg-gray-800/50 border border-gray-600/30' }}">
                    <div class="w-12 h-12 rounded-full {{ $now < $registrationDeadline ? 'bg-emerald-600' : 'bg-gray-600' }} flex items-center justify-center mr-4">
                        <i class="bi bi-person-plus text-white text-xl"></i>
                    </div>
                    <div class="flex-1">
                        <h3 class="font-bold text-white">Registration Phase</h3>
                        <p class="text-gray-300">Open until July 22, 6:00 PM</p>
                    </div>
                    <div class="text-right">
                        @if($now < $registrationDeadline)
                            <span class="badge badge-success">Active</span>
                        @else
                            <span class="badge badge-secondary">Closed</span>
                        @endif
                    </div>
                </div>

                <!-- Competition Development -->
                <div class="flex items-center p-4 rounded-lg {{ $now >= $competitionStart && $now < $githubDeadline ? 'bg-purple-900/20 border border-purple-500/30' : 'bg-gray-800/50 border border-gray-600/30' }}">
                    <div class="w-12 h-12 rounded-full {{ $now >= $competitionStart && $now < $githubDeadline ? 'bg-purple-600' : 'bg-gray-600' }} flex items-center justify-center mr-4">
                        <i class="bi bi-code-slash text-white text-xl"></i>
                    </div>
                    <div class="flex-1">
                        <h3 class="font-bold text-white">Development Phase</h3>
                        <p class="text-gray-300">July 16, 6:00 PM - July 22, 6:00 PM</p>
                    </div>
                    <div class="text-right">
                        @if($now >= $competitionStart && $now < $githubDeadline)
                            <span class="badge badge-primary">Active</span>
                        @elseif($now < $competitionStart)
                            <span class="badge badge-warning">Upcoming</span>
                        @else
                            <span class="badge badge-secondary">Completed</span>
                        @endif
                    </div>
                </div>

                <!-- Final Submission -->
                <div class="flex items-center p-4 rounded-lg {{ $now >= $githubDeadline && $now < $projectDeadline ? 'bg-amber-900/20 border border-amber-500/30' : 'bg-gray-800/50 border border-gray-600/30' }}">
                    <div class="w-12 h-12 rounded-full {{ $now >= $githubDeadline && $now < $projectDeadline ? 'bg-amber-600' : 'bg-gray-600' }} flex items-center justify-center mr-4">
                        <i class="bi bi-upload text-white text-xl"></i>
                    </div>
                    <div class="flex-1">
                        <h3 class="font-bold text-white">Final Submission</h3>
                        <p class="text-gray-300">July 22, 6:00 PM - July 30, 11:59 PM</p>
                    </div>
                    <div class="text-right">
                        @if($now >= $githubDeadline && $now < $projectDeadline)
                            <span class="badge badge-primary">Active</span>
                        @elseif($now < $githubDeadline)
                            <span class="badge badge-warning">Upcoming</span>
                        @else
                            <span class="badge badge-secondary">Completed</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="text-center space-y-4">
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('codesprint.register') }}" class="btn btn-primary text-lg px-8 py-4">
                    <i class="bi bi-person-plus me-2"></i>
                    Register Your Team
                </a>
                <a href="{{ route('codesprint.status.lookup') }}" class="btn btn-secondary text-lg px-8 py-4">
                    <i class="bi bi-search me-2"></i>
                    Check Status
                </a>
                <a href="{{ route('codesprint.rulebook') }}" class="btn btn-secondary text-lg px-8 py-4">
                    <i class="bi bi-book me-2"></i>
                    View Rules
                </a>
            </div>
            
            <div class="flex justify-center space-x-4 text-sm text-gray-400">
                <button onclick="refreshStats()" class="flex items-center hover:text-gray-300 transition-colors">
                    <i class="bi bi-arrow-clockwise me-1"></i>
                    Refresh Stats
                </button>
                <span class="flex items-center">
                    <i class="bi bi-info-circle me-1"></i>
                    Updates every 5 minutes
                </span>
            </div>
        </div>
    </div>

    @include('layouts.footer')

    <script>
        function refreshStats() {
            window.location.reload();
        }

        // Auto-refresh every 5 minutes
        setInterval(refreshStats, 300000);

        // Animate progress bars on page load
        document.addEventListener('DOMContentLoaded', function() {
            const progressBars = document.querySelectorAll('[style*="width:"]');
            progressBars.forEach(bar => {
                const width = bar.style.width;
                bar.style.width = '0%';
                setTimeout(() => {
                    bar.style.width = width;
                }, 500);
            });
        });

        // Add hover effects to stat cards
        document.addEventListener('DOMContentLoaded', function() {
            const statCards = document.querySelectorAll('.card.group');
            statCards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'scale(1.05) translateY(-4px)';
                });
                
                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'scale(1) translateY(0)';
                });
            });
        });
    </script>

    <style>
        .card.group {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .card.group:hover {
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }
    </style>
</body>
</html>
