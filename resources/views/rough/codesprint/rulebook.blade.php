<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IUTCS CodeSprint 2025 - Modern Rulebook</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #6366f1;
            --primary-light: #818cf8;
            --primary-dark: #4f46e5;
            --secondary: #10b981;
            --dark: #0f172a;
            --darker: #0b1120;
            --light: #f1f5f9;
            --card-bg: rgba(30, 41, 59, 0.7);
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, var(--darker), var(--dark));
            color: var(--light);
            min-height: 100vh;
            background-attachment: fixed;
        }
        
        .font-mono {
            font-family: 'JetBrains Mono', monospace;
        }
        
        .header-gradient {
            background: linear-gradient(90deg, var(--primary-dark), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        .card {
            background: var(--card-bg);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 16px;
            transition: all 0.3s ease;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.5);
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 35px -10px rgba(0, 0, 0, 0.5);
            border-color: rgba(99, 102, 241, 0.4);
        }
        
        .section-title {
            position: relative;
            padding-bottom: 1rem;
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 4px;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            border-radius: 2px;
        }
        
        .badge {
            display: inline-flex;
            align-items: center;
            padding: 0.35rem 0.8rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        
        .timeline {
            position: relative;
            /* Remove center placement for desktop */
        }
        .timeline::before {
            content: '';
            position: absolute;
            top: 0;
            bottom: 0;
            /* Place stick on the left for desktop */
            left: 0;
            width: 4px;
            background: linear-gradient(to bottom, var(--primary), var(--secondary));
            border-radius: 2px;
        }
        @media (max-width: 768px) {
            .timeline::before {
                left: 1.5rem;
            }
            .timeline-item {
                padding-left: 3rem;
            }
        }
        .timeline-item {
            position: relative;
            padding-left: 3rem;
            margin-bottom: 3rem;
        }
        .timeline-item::before {
            content: '';
            position: absolute;
            top: 0.5rem;
            left: -0.75rem;
            width: 1.5rem;
            height: 1.5rem;
            border-radius: 50%;
            background: var(--primary);
            border: 4px solid var(--dark);
        }
        
        .glow {
            box-shadow: 0 0 15px rgba(99, 102, 241, 0.3);
        }
        
        .icon-container {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(79, 70, 229, 0.2);
            margin-right: 1rem;
        }
        
        .nav-pill {
            transition: all 0.3s ease;
            border-radius: 9999px;
            padding: 0.5rem 1.25rem;
        }
        
        .nav-pill:hover, .nav-pill.active {
            background: rgba(99, 102, 241, 0.2);
        }
        
        .feature-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
        }
        
        .gradient-border {
            position: relative;
            border-radius: 16px;
            overflow: hidden;
        }
        
        .gradient-border::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            border: 2px solid transparent;
            background: linear-gradient(var(--dark), var(--dark)) padding-box,
                        linear-gradient(135deg, var(--primary), var(--secondary)) border-box;
            border-radius: inherit;
            z-index: -1;
        }

        body{
            color: var(--light);
            background-color: var(--darker);
        }
    </style>
</head>
<body class="text-gray-200">
    <div class="container mx-auto px-4 py-12 max-w-6xl">
        <!-- Back Navigation -->
        <div class="mb-8 pt-4">
            <a href="{{ url()->previous() ?: route('home') }}" 
               class="inline-flex items-center px-4 py-2 bg-white/10 hover:bg-white/20 backdrop-blur-sm border border-white/20 hover:border-white/30 rounded-lg text-gray-300 hover:text-white transition-all duration-200 group">
                <svg class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                <span class="font-medium">Go Back</span>
            </a>
        </div>
        
        <!-- Hero Section -->
        <header class="text-center mb-16 pt-8">

            <div class="inline-block mb-4 px-4 py-1 bg-indigo-900/30 text-indigo-300 rounded-full text-sm font-medium border border-indigo-700/50">
                July 13 - July 30, 2025
            </div>
            <h1 class="text-5xl sm:text-6xl font-bold mb-4 header-gradient">
                IUTCS <span class="font-mono">CodeSprint 2025</span>
            </h1>
            <p class="text-xl max-w-2xl mx-auto text-gray-300">Rulebook & Guidelines for the Premier Coding Competition at IUT</p>
            
            <div class="mt-10 max-w-4xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="card p-6 flex flex-col items-center text-center">
                    <div class="icon-container mb-4">
                        <i class="fas fa-users text-xl text-indigo-400"></i>
                    </div>
                    <h3 class="font-bold text-lg mb-2">Team Size</h3>
                    <p class="text-2xl font-bold text-indigo-300">1-3 Members</p>
                </div>
                
                <div class="card p-6 flex flex-col items-center text-center">
                    <div class="icon-container mb-4">
                        <i class="fas fa-trophy text-xl text-emerald-400"></i>
                    </div>
                    <h3 class="font-bold text-lg mb-2">Top Teams</h3>
                    <p class="text-2xl font-bold text-emerald-300">Onsite Presentation</p>
                    <p class="text-sm text-gray-400 mt-1">Final Presentation Date: <span class="font-bold text-yellow-300">To Be Announced</span></p>
                </div>
                
                <div class="card p-6 flex flex-col items-center text-center">
                    <div class="icon-container mb-4">
                        <i class="fas fa-laptop-code text-xl text-cyan-400"></i>
                    </div>
                    <h3 class="font-bold text-lg mb-2">Participation</h3>
                    <p class="text-2xl font-bold text-cyan-300">150 Taka</p>
                </div>
            </div>
        </header>

        <main class="space-y-20">
            <!-- 1. Event Overview & Important Dates Section -->
            <section id="overview">
                <div class="flex items-center mb-8">
                    <div class="w-12 h-12 rounded-lg bg-indigo-900/50 flex items-center justify-center mr-4">
                        <span class="text-2xl font-bold text-indigo-400">1</span>
                    </div>
                    <h2 class="text-3xl font-bold section-title">Overview & Important Dates</h2>
                </div>
                
                <div class="mt-2">
                    <div class="timeline">
                        <div class="timeline-item">
                            <div class="card p-6">
                                <div class="flex items-center mb-3">
                                    <div class="badge bg-indigo-900/30 text-indigo-300">
                                        <i class="fas fa-calendar-day mr-2"></i>Registration Opens
                                    </div>
                                </div>
                                <h3 class="text-xl font-bold text-white mb-2">July 13, 2025 (6:00 PM)</h3>
                                <p class="text-gray-300">Registration period begins for all participants</p>
                            </div>
                        </div>
                        
                        <div class="timeline-item">
                            <div class="card p-6">
                                <div class="flex items-center mb-3">
                                    <div class="badge bg-emerald-900/30 text-emerald-300">
                                        <i class="fas fa-laptop-code mr-2"></i>Competition Starts
                                    </div>
                                </div>
                                <h3 class="text-xl font-bold text-white mb-2">July 16, 2025 (6:00 PM)</h3>
                                <p class="text-gray-300">Online competition period begins</p>
                                <p class="text-sm text-gray-400 mt-2">Project requirements published</p>
                            </div>
                        </div>
                        
                        <div class="timeline-item">
                            <div class="card p-6">
                                <div class="flex items-center mb-3">
                                    <div class="badge bg-amber-900/30 text-amber-300">
                                        <i class="fas fa-hourglass-half mr-2"></i>Registration Closes
                                    </div>
                                </div>
                                <h3 class="text-xl font-bold text-white mb-2">July 22, 2025 (6:00 PM)</h3>
                                <p class="text-gray-300">Final deadline for registration and GitHub repo submission</p>
                            </div>
                        </div>
                        
                        <div class="timeline-item">
                            <div class="card p-6">
                                <div class="flex items-center mb-3">
                                    <div class="badge bg-rose-900/30 text-rose-300">
                                        <i class="fas fa-flag-checkered mr-2"></i>Competition Ends
                                    </div>
                                </div>
                                <h3 class="text-xl font-bold text-white mb-2">July 30, 2025 (11:59 PM)</h3>
                                <p class="text-gray-300">Final project submission deadline</p>
                                <p class="text-sm text-gray-400 mt-2">14 days to build your project</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- 2. Eligibility & Team Formation Section -->
            <section id="eligibility">
                <div class="flex items-center mb-8">
                    <div class="w-12 h-12 rounded-lg bg-emerald-900/50 flex items-center justify-center mr-4">
                        <span class="text-2xl font-bold text-emerald-400">2</span>
                    </div>
                    <h2 class="text-3xl font-bold section-title">Eligibility & Team Formation</h2>
                </div>
                
                <div class="feature-grid mt-6">
                    <div class="card p-6">
                        <div class="flex items-start">
                            <div class="icon-container flex-shrink-0">
                                <i class="fas fa-user-graduate text-indigo-400"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-lg mb-2 text-white">Who can participate?</h3>
                                <p>Exclusively open to current 1st and 2nd-year students of IUT.</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card p-6">
                        <div class="flex items-start">
                            <div class="icon-container flex-shrink-0">
                                <i class="fas fa-users text-cyan-400"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-lg mb-2 text-white">Team Size</h3>
                                <p>You can participate individually or in a team of up to 3 members.</p>
                                <div class="mt-3 flex space-x-2">
                                    <span class="badge bg-indigo-900/30 text-indigo-300">Solo Allowed</span>
                                    <span class="badge bg-cyan-900/30 text-cyan-300">Team Up to 3</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- 3. Technology & Project Guidelines -->
            <section id="guidelines">
                <div class="flex items-center mb-8">
                    <div class="w-12 h-12 rounded-lg bg-cyan-900/50 flex items-center justify-center mr-4">
                        <span class="text-2xl font-bold text-cyan-400">3</span>
                    </div>
                    <h2 class="text-3xl font-bold section-title">Technology & Project Guidelines</h2>
                </div>
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div class="card p-6">
                        <div class="flex items-start mb-4">
                            <div class="icon-container flex-shrink-0">
                                <i class="fas fa-lightbulb text-amber-400"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-lg mb-2 text-white">Creative Freedom</h3>
                                <p>Use any programming language, framework, or library you prefer. AI/LLM code-generators, Copilot, and no-code/frontend builders are <span class="font-bold text-emerald-400">allowed</span>.</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card p-6">
                        <div class="flex items-start mb-4">
                            <div class="icon-container flex-shrink-0">
                                <i class="fas fa-feather text-violet-400"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-lg mb-2 text-white">Project Originality</h3>
                                <p>Core logic and features must be your original work developed during the hackathon.</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card p-6">
                        <div class="flex items-start mb-4">
                            <div class="icon-container flex-shrink-0">
                                <i class="fas fa-robot text-green-400"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-lg mb-2 text-white">AI/ML Integration</h3>
                                <p>Optional but encouraged. Show us how you can leverage advanced technology!</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card p-6">
                        <div class="flex items-start mb-4">
                            <div class="icon-container flex-shrink-0">
                                <i class="fas fa-cloud-upload-alt text-sky-400"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-lg mb-2 text-white">Deployment</h3>
                                <p>Live deployment is not mandatory, but your submission must clearly demonstrate functionality through a prototype, video, or documentation.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- 4. Submission Guidelines -->
            <section id="submission">
                <div class="flex items-center mb-8">
                    <div class="w-12 h-12 rounded-lg bg-violet-900/50 flex items-center justify-center mr-4">
                        <span class="text-2xl font-bold text-violet-400">4</span>
                    </div>
                    <h2 class="text-3xl font-bold section-title">Submission Guidelines</h2>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="card p-6">
                        <div class="flex items-start mb-4">
                            <div class="icon-container flex-shrink-0">
                                <i class="fab fa-github text-purple-400"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-lg mb-2 text-white">Repository Link</h3>
                                <p>Submit your GitHub repository link by <span class="font-bold text-indigo-300">July 22, 2025, 6:00 PM</span>.</p>
                                <div class="mt-3">
                                    <span class="badge bg-purple-900/30 text-purple-300">
                                        <i class="fas fa-code-branch mr-1"></i> Commit Monitoring
                                    </span>
                                    <p class="text-sm text-gray-400 mt-2">We'll monitor your commit history. Regular commits with descriptive messages are encouraged.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card p-6">
                        <div class="flex items-start mb-4">
                            <div class="icon-container flex-shrink-0">
                                <i class="fas fa-file-archive text-amber-400"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-lg mb-2 text-white">Final Project</h3>
                                <p>Submit a zip of your complete project by <span class="font-bold text-indigo-300">July 30, 2025, 6:00 PM</span>.</p>
                                <div class="mt-3">
                                    <span class="badge bg-rose-900/30 text-rose-300">
                                        <i class="fas fa-clock mr-1"></i> Post-Deadline Commits
                                    </span>
                                    <p class="text-sm text-gray-400 mt-2">Commits pushed after the final deadline will not be considered.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card p-6 md:col-span-2">
                        <div class="flex items-start">
                            <div class="icon-container flex-shrink-0">
                                <i class="fas fa-video text-sky-400"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-lg mb-2 text-white">Video Submission</h3>
                                <p class="mb-3">Your video (max 15 minutes) must include:</p>
                                <ul class="grid grid-cols-1 md:grid-cols-2 gap-2">
                                    <li class="flex items-center">
                                        <i class="fas fa-check-circle text-emerald-400 mr-2"></i>
                                        Basic idea of the project
                                    </li>
                                    <li class="flex items-center">
                                        <i class="fas fa-check-circle text-emerald-400 mr-2"></i>
                                        The problem it solves
                                    </li>
                                    <li class="flex items-center">
                                        <i class="fas fa-check-circle text-emerald-400 mr-2"></i>
                                        Comparison with existing tools
                                    </li>
                                    <li class="flex items-center">
                                        <i class="fas fa-check-circle text-emerald-400 mr-2"></i>
                                        Full demonstration of your project
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- 5. Judging Criteria -->
            <section>
                <div class="flex items-center mb-8">
                    <div class="w-12 h-12 rounded-lg bg-rose-900/50 flex items-center justify-center mr-4">
                        <span class="text-2xl font-bold text-rose-400">5</span>
                    </div>
                    <h2 class="text-3xl font-bold section-title">Judging Criteria</h2>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                    <div class="card p-5 text-center">
                        <div class="w-12 h-12 rounded-lg bg-indigo-900/30 flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-brain text-indigo-400 text-xl"></i>
                        </div>
                        <h3 class="font-bold text-white mb-2">Innovation & Creativity</h3>
                        <p class="text-sm text-gray-300">How novel and unique is your idea?</p>
                    </div>
                    
                    <div class="card p-5 text-center">
                        <div class="w-12 h-12 rounded-lg bg-emerald-900/30 flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-code text-emerald-400 text-xl"></i>
                        </div>
                        <h3 class="font-bold text-white mb-2">Technical Implementation</h3>
                        <p class="text-sm text-gray-300">Is the code clean, functional, and robust?</p>
                    </div>
                    
                    <div class="card p-5 text-center">
                        <div class="w-12 h-12 rounded-lg bg-cyan-900/30 flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-puzzle-piece text-cyan-400 text-xl"></i>
                        </div>
                        <h3 class="font-bold text-white mb-2">Problem-Solving</h3>
                        <p class="text-sm text-gray-300">How effectively does it address the problem?</p>
                    </div>
                    
                    <div class="card p-5 text-center">
                        <div class="w-12 h-12 rounded-lg bg-amber-900/30 flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-paint-brush text-amber-400 text-xl"></i>
                        </div>
                        <h3 class="font-bold text-white mb-2">User Experience</h3>
                        <p class="text-sm text-gray-300">Is it user-friendly and aesthetically pleasing?</p>
                    </div>
                    
                    <div class="card p-5 text-center">
                        <div class="w-12 h-12 rounded-lg bg-purple-900/30 flex items-center justify-center mx-auto mb-3">
                            <i class="fas fa-chalkboard-teacher text-purple-400 text-xl"></i>
                        </div>
                        <h3 class="font-bold text-white mb-2">Presentation</h3>
                        <p class="text-sm text-gray-300">Clarity and impact of your presentation</p>
                    </div>
                </div>
            </section>

            <!-- 6. Awards -->
            <section id="awards">
                <div class="flex items-center mb-8">
                    <div class="w-12 h-12 rounded-lg bg-amber-900/50 flex items-center justify-center mr-4">
                        <span class="text-2xl font-bold text-amber-400">6</span>
                    </div>
                    <h2 class="text-3xl font-bold section-title">Awards & Recognition</h2>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="card p-8 text-center gradient-border">
                        <div class="text-5xl font-bold text-amber-400 mb-2">1st</div>
                        <div class="w-24 h-1 bg-gradient-to-r from-amber-500 to-yellow-300 mx-auto mb-6"></div>
                        <h3 class="text-xl font-bold text-white mb-3">Champion</h3>
                        <ul class="space-y-2 text-gray-300">
                            <li class="flex items-center justify-center">
                                <i class="fas fa-award text-amber-400 mr-2"></i>
                                Award Certificate
                            </li>
                            <li class="flex items-center justify-center">
                                <i class="fas fa-medal text-amber-400 mr-2"></i>
                                Championship Crest
                            </li>
                            <li class="flex items-center justify-center">
                                <i class="fas fa-trophy text-amber-400 mr-2"></i>
                                Special Recognition
                            </li>
                        </ul>
                    </div>
                    
                    <div class="card p-8 text-center gradient-border">
                        <div class="text-5xl font-bold text-gray-400 mb-2">2nd</div>
                        <div class="w-24 h-1 bg-gradient-to-r from-gray-500 to-gray-300 mx-auto mb-6"></div>
                        <h3 class="text-xl font-bold text-white mb-3">First Runner-up</h3>
                        <ul class="space-y-2 text-gray-300">
                            <li class="flex items-center justify-center">
                                <i class="fas fa-award text-gray-400 mr-2"></i>
                                Award Certificate
                            </li>
                            <li class="flex items-center justify-center">
                                <i class="fas fa-medal text-gray-400 mr-2"></i>
                                Crest
                            </li>
                        </ul>
                    </div>
                    
                    <div class="card p-8 text-center gradient-border">
                        <div class="text-5xl font-bold text-amber-800 mb-2">3rd</div>
                        <div class="w-24 h-1 bg-gradient-to-r from-amber-800 to-amber-600 mx-auto mb-6"></div>
                        <h3 class="text-xl font-bold text-white mb-3">Second Runner-up</h3>
                        <ul class="space-y-2 text-gray-300">
                            <li class="flex items-center justify-center">
                                <i class="fas fa-award text-amber-700 mr-2"></i>
                                Award Certificate
                            </li>
                            <li class="flex items-center justify-center">
                                <i class="fas fa-medal text-amber-700 mr-2"></i>
                                Crest
                            </li>
                        </ul>
                    </div>
                </div>
                
                <div class="mt-8 card p-6">
                    <div class="flex items-start">
                        <div class="icon-container flex-shrink-0">
                            <i class="fas fa-star text-yellow-400"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-lg mb-2 text-white">Top 10 Teams</h3>
                            <p>Will present their projects onsite on <span class="font-bold text-indigo-300">[Date To Be Announced]</span>. This is your chance to showcase your work to judges and peers!</p>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <script>
        // Simple smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
        
        // Add active class to nav items when scrolling
        window.addEventListener('scroll', function() {
            const sections = document.querySelectorAll('section');
            const navItems = document.querySelectorAll('.nav-pill');
            
            let current = '';
            
            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.clientHeight;
                
                if(pageYOffset >= (sectionTop - 300)) {
                    current = section.getAttribute('id');
                }
            });
            
            navItems.forEach(item => {
                item.classList.remove('active');
                if(item.getAttribute('href') === `#${current}`) {
                    item.classList.add('active');
                }
            });
        });
    </script>
</body>
</html>