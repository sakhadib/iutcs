<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CodeSprint 2025 - IUTCS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/codesprint-style.css') }}">
</head>
<body>
    @include('layouts.dangling_header')
    
    <div class="container mx-auto px-4 py-12 max-w-7xl">
        <!-- Hero Section -->
        <header class="text-center mb-20 pt-8">
            <div class="inline-block mb-6 px-6 py-2 bg-indigo-900/30 text-indigo-300 rounded-full text-lg font-medium border border-indigo-700/50">
                🎯 Registration Open Now!
            </div>
            <h1 class="text-6xl sm:text-7xl font-bold mb-6 header-gradient">
                IUTCS <span class="font-mono">CodeSprint 2025</span>
            </h1>
            <p class="text-2xl max-w-3xl mx-auto text-gray-300 mb-12">The Premier Coding Competition at IUT - Where Innovation Meets Excellence</p>
            
            <div class="flex flex-col sm:flex-row gap-6 justify-center">
                <a href="{{ route('codesprint.register') }}" class="btn btn-primary text-xl px-8 py-4">
                    <i class="bi bi-rocket me-2"></i>
                    Register Your Team
                </a>
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
                    <p class="text-sm text-gray-400 mt-2">Affordable for all students</p>
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
                    <div class="timeline-item">
                        <div class="card p-8">
                            <h3 class="text-2xl font-bold text-white mb-3">Registration Opens</h3>
                            <div class="text-lg font-semibold text-indigo-300 mb-2">July 13, 2025 - 6:00 PM</div>
                            <p class="text-gray-300">Team registration and payment submission begins</p>
                        </div>
                    </div>
                    
                    <div class="timeline-item">
                        <div class="card p-8">
                            <h3 class="text-2xl font-bold text-white mb-3">Competition Begins</h3>
                            <div class="text-lg font-semibold text-emerald-300 mb-2">July 16, 2025 - 6:00 PM</div>
                            <p class="text-gray-300">Project requirements published, development phase starts</p>
                        </div>
                    </div>
                    
                    <div class="timeline-item">
                        <div class="card p-8">
                            <h3 class="text-2xl font-bold text-white mb-3">GitHub Submission Deadline</h3>
                            <div class="text-lg font-semibold text-amber-300 mb-2">July 22, 2025 - 6:00 PM</div>
                            <p class="text-gray-300">Final deadline for registration and GitHub repository submission</p>
                        </div>
                    </div>
                    
                    <div class="timeline-item">
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
                    Join hundreds of talented students in the most exciting coding competition at IUT. 
                    Showcase your skills, learn new technologies, and compete for amazing prizes!
                </p>
                <div class="flex flex-col sm:flex-row gap-6 justify-center">
                    <a href="{{ route('codesprint.register') }}" class="btn btn-primary text-xl px-10 py-4">
                        <i class="bi bi-rocket me-2"></i>
                        Register Now
                    </a>
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
                const response = await fetch('{{ route("codesprint.stats") }}');
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
