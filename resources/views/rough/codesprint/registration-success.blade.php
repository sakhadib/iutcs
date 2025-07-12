<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Successful - CodeSprint 2025</title>
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
        <!-- Success Header -->
        <header class="text-center mb-16 pt-8">
            <div class="mb-8">
                <div class="w-24 h-24 mx-auto mb-6 rounded-full bg-green-900/30 flex items-center justify-center">
                    <i class="bi bi-check-circle text-green-400 text-5xl"></i>
                </div>
                <h1 class="text-4xl sm:text-5xl font-bold mb-4 header-gradient">
                    Registration Successful!
                </h1>
                <p class="text-xl max-w-2xl mx-auto text-gray-300">Welcome to CodeSprint 2025! Your team has been registered.</p>
            </div>
        </header>

        <!-- Important Token Information -->
        <div class="card p-10 mb-12 text-center border-2 border-green-500/30 glow">
            <div class="mb-6">
                <i class="bi bi-exclamation-triangle text-amber-400 text-4xl mb-4"></i>
                <h2 class="text-3xl font-bold text-white mb-4">⚠️ IMPORTANT - Save Your Registration Token!</h2>
            </div>
            
            <div class="bg-gray-900/50 border border-green-500/50 rounded-2xl p-8 mb-8">
                <p class="text-lg text-gray-300 mb-4">Your unique registration token is:</p>
                <div class="text-6xl font-mono font-bold text-green-400 tracking-widest mb-4 select-all" style="letter-spacing: 0.5em;">
                    {{ $registration->registration_token }}
                </div>
                <div class="flex justify-center space-x-4 mt-4">
                    <button onclick="copyToken()" class="btn btn-secondary" id="copyBtn">
                        <i class="bi bi-clipboard me-2"></i>
                        Copy Token
                    </button>
                    <button onclick="window.print()" class="btn btn-secondary">
                        <i class="bi bi-printer me-2"></i>
                        Print This Page
                    </button>
                </div>
            </div>
            
            <div class="space-y-4 text-left">
                <div class="alert alert-warning">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    <div>
                        <strong>You MUST save this token now!</strong> This is the only way to access your registration status and submit your project later.
                    </div>
                </div>
                
                <div class="bg-amber-900/20 border border-amber-500/30 rounded-lg p-4">
                    <h3 class="font-bold text-amber-300 mb-3 flex items-center">
                        <i class="bi bi-lightbulb me-2"></i>
                        How to save your token:
                    </h3>
                    <ul class="space-y-2 text-gray-300">
                        <li class="flex items-center">
                            <i class="bi bi-check text-green-400 me-2"></i>
                            Write it down on paper and keep it safe
                        </li>
                        <li class="flex items-center">
                            <i class="bi bi-check text-green-400 me-2"></i>
                            Save this page as a bookmark in your browser
                        </li>
                        <li class="flex items-center">
                            <i class="bi bi-check text-green-400 me-2"></i>
                            Take a screenshot of this page
                        </li>
                        <li class="flex items-center">
                            <i class="bi bi-check text-green-400 me-2"></i>
                            Copy the token and save it in a secure note app
                        </li>
                        <li class="flex items-center">
                            <i class="bi bi-check text-green-400 me-2"></i>
                            Share the token with your team members
                        </li>
                    </ul>
                </div>
                
                <div class="bg-red-900/20 border border-red-500/30 rounded-lg p-4">
                    <h3 class="font-bold text-red-300 mb-3 flex items-center">
                        <i class="bi bi-shield-exclamation me-2"></i>
                        Why is this important?
                    </h3>
                    <ul class="space-y-2 text-gray-300">
                        <li class="flex items-center">
                            <i class="bi bi-x text-red-400 me-2"></i>
                            We cannot recover lost tokens
                        </li>
                        <li class="flex items-center">
                            <i class="bi bi-x text-red-400 me-2"></i>
                            No email confirmation will be sent
                        </li>
                        <li class="flex items-center">
                            <i class="bi bi-x text-red-400 me-2"></i>
                            You need this token to submit your GitHub repository
                        </li>
                        <li class="flex items-center">
                            <i class="bi bi-x text-red-400 me-2"></i>
                            You need this token to submit your final project
                        </li>
                        <li class="flex items-center">
                            <i class="bi bi-x text-red-400 me-2"></i>
                            You need this token to check your payment status
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Team Information Summary -->
        <div class="card p-8 mb-12">
            <div class="flex items-center mb-6">
                <div class="icon-container">
                    <i class="bi bi-people text-indigo-400"></i>
                </div>
                <h2 class="text-2xl font-bold section-title">Registration Summary</h2>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="font-bold text-lg mb-3 text-white">Team Details</h3>
                    <div class="space-y-2">
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
                            <span class="font-semibold">{{ $registration->created_at->format('M d, Y H:i') }}</span>
                        </div>
                        @if($registration->contact_phone)
                        <div class="flex justify-between">
                            <span class="text-gray-400">Contact Phone:</span>
                            <span class="font-semibold">{{ $registration->contact_phone }}</span>
                        </div>
                        @endif
                    </div>
                </div>
                
                <div>
                    <h3 class="font-bold text-lg mb-3 text-white">Payment Information</h3>
                    <div class="space-y-2">
                        <div class="flex justify-between">
                            <span class="text-gray-400">Transaction ID:</span>
                            <span class="font-semibold">{{ $registration->transaction_id }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-400">Amount:</span>
                            <span class="font-semibold">150 Taka</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-400">Payment Status:</span>
                            <span class="badge badge-warning">Pending Verification</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Next Steps -->
        <div class="card p-8 mb-12">
            <div class="flex items-center mb-6">
                <div class="icon-container">
                    <i class="bi bi-list-check text-emerald-400"></i>
                </div>
                <h2 class="text-2xl font-bold section-title">What's Next?</h2>
            </div>
            
            <div class="space-y-4">
                <div class="flex items-start p-4 rounded-lg" style="background: rgba(99, 102, 241, 0.1);">
                    <div class="w-8 h-8 rounded-full bg-indigo-600 flex items-center justify-center mr-4 mt-1">
                        <span class="text-white font-bold">1</span>
                    </div>
                    <div>
                        <h3 class="font-bold text-white mb-2">Payment Verification</h3>
                        <p class="text-gray-300">Our team will verify your payment within 24-48 hours. You'll see the status change when you check your registration.</p>
                    </div>
                </div>
                
                <div class="flex items-start p-4 rounded-lg" style="background: rgba(16, 185, 129, 0.1);">
                    <div class="w-8 h-8 rounded-full bg-emerald-600 flex items-center justify-center mr-4 mt-1">
                        <span class="text-white font-bold">2</span>
                    </div>
                    <div>
                        <h3 class="font-bold text-white mb-2">Competition Begins (July 16, 6:00 PM)</h3>
                        <p class="text-gray-300">Project requirements will be published and the development phase begins.</p>
                    </div>
                </div>
                
                <div class="flex items-start p-4 rounded-lg" style="background: rgba(168, 85, 247, 0.1);">
                    <div class="w-8 h-8 rounded-full bg-purple-600 flex items-center justify-center mr-4 mt-1">
                        <span class="text-white font-bold">3</span>
                    </div>
                    <div>
                        <h3 class="font-bold text-white mb-2">GitHub Submission (Deadline: July 22, 6:00 PM)</h3>
                        <p class="text-gray-300">Submit your GitHub repository link using your registration token.</p>
                    </div>
                </div>
                
                <div class="flex items-start p-4 rounded-lg" style="background: rgba(245, 158, 11, 0.1);">
                    <div class="w-8 h-8 rounded-full bg-amber-600 flex items-center justify-center mr-4 mt-1">
                        <span class="text-white font-bold">4</span>
                    </div>
                    <div>
                        <h3 class="font-bold text-white mb-2">Final Submission (Deadline: July 30, 11:59 PM)</h3>
                        <p class="text-gray-300">Submit your complete project with demo video using your registration token.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="text-center space-y-4">
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('codesprint.status', $registration->registration_token) }}" class="btn btn-primary text-lg px-8 py-4">
                    <i class="bi bi-eye me-2"></i>
                    View Registration Status
                </a>
                <a href="{{ route('codesprint.rulebook') }}" class="btn btn-secondary text-lg px-8 py-4">
                    <i class="bi bi-book me-2"></i>
                    Read Competition Rules
                </a>
            </div>
            
            <p class="text-gray-400 text-sm">
                Bookmark this page or save the URL: 
                <span class="font-mono text-indigo-400">{{ url()->current() }}</span>
            </p>
        </div>
    </div>

    @include('layouts.footer')

    <script>
        function copyToken() {
            const token = '{{ $registration->registration_token }}';
            navigator.clipboard.writeText(token).then(function() {
                const btn = document.getElementById('copyBtn');
                const originalText = btn.innerHTML;
                btn.innerHTML = '<i class="bi bi-check me-2"></i>Copied!';
                btn.classList.remove('btn-secondary');
                btn.classList.add('btn-success');
                
                setTimeout(function() {
                    btn.innerHTML = originalText;
                    btn.classList.remove('btn-success');
                    btn.classList.add('btn-secondary');
                }, 2000);
            });
        }

        // Auto-scroll to token section
        document.addEventListener('DOMContentLoaded', function() {
            // Add a slight delay to ensure page is fully loaded
            setTimeout(function() {
                const tokenSection = document.querySelector('.card.border-2');
                if (tokenSection) {
                    tokenSection.scrollIntoView({ 
                        behavior: 'smooth', 
                        block: 'center' 
                    });
                }
            }, 500);
        });

        // Prevent accidental page close
        window.addEventListener('beforeunload', function (e) {
            e.preventDefault();
            e.returnValue = 'Are you sure you want to leave? Make sure you have saved your registration token!';
        });

        // Flash the token for attention
        document.addEventListener('DOMContentLoaded', function() {
            const tokenElement = document.querySelector('.text-6xl.font-mono');
            if (tokenElement) {
                let flashCount = 0;
                const flashInterval = setInterval(function() {
                    tokenElement.style.opacity = tokenElement.style.opacity === '0.5' ? '1' : '0.5';
                    flashCount++;
                    if (flashCount >= 6) { // Flash 3 times (6 opacity changes)
                        clearInterval(flashInterval);
                        tokenElement.style.opacity = '1';
                    }
                }, 500);
            }
        });
    </script>

    <style>
        @media print {
            body * {
                visibility: hidden;
            }
            .card.border-2, .card.border-2 * {
                visibility: visible;
            }
            .card.border-2 {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
            }
        }
        
        .select-all {
            user-select: all;
            -webkit-user-select: all;
            -moz-user-select: all;
        }
    </style>
</body>
</html>
