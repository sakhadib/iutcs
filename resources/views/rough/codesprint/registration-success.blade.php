<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta name="referrer" content="strict-origin-when-cross-origin">
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
        <header class="text-center mb-8 sm:mb-16 pt-4 sm:pt-8">
            <div class="mb-6 sm:mb-8">
                <div class="w-16 h-16 sm:w-24 sm:h-24 mx-auto mb-4 sm:mb-6 rounded-full bg-green-900/30 flex items-center justify-center">
                    <i class="bi bi-check-circle text-green-400 text-3xl sm:text-5xl"></i>
                </div>
                <h1 class="text-2xl sm:text-4xl lg:text-5xl font-bold mb-3 sm:mb-4 header-gradient px-4">
                    Registration Successful!
                </h1>
                <p class="text-lg sm:text-xl max-w-2xl mx-auto text-gray-300 px-4">Welcome to CodeSprint 2025! Your team has been registered.</p>
            </div>
        </header>

        <!-- Important Token Information -->
        <div class="card p-4 sm:p-6 lg:p-10 mb-8 sm:mb-12 text-center border-2 border-green-500/30 glow">
            <div class="mb-4 sm:mb-6">
                <i class="bi bi-exclamation-triangle text-amber-400 text-2xl sm:text-4xl mb-3 sm:mb-4"></i>
                <h2 class="text-xl sm:text-2xl lg:text-3xl font-bold text-white mb-3 sm:mb-4 px-2">⚠️ IMPORTANT - Save Your Registration Token!</h2>
            </div>
            
            <div class="bg-gray-900/50 border border-green-500/50 rounded-2xl p-4 sm:p-6 lg:p-8 mb-6 sm:mb-8">
                <p class="text-base sm:text-lg text-gray-300 mb-3 sm:mb-4">Your unique registration token is:</p>
                <div class="text-3xl sm:text-4xl lg:text-6xl font-mono font-bold text-green-400 tracking-wider sm:tracking-widest mb-3 sm:mb-4 select-all break-all" style="letter-spacing: 0.2em;">
                    {{ $registration->registration_token }}
                </div>
                <div class="flex flex-col sm:flex-row justify-center space-y-2 sm:space-y-0 sm:space-x-4 mt-3 sm:mt-4">
                    <button onclick="copyToken()" class="btn btn-secondary text-sm sm:text-base" id="copyBtn">
                        <i class="bi bi-clipboard me-2"></i>
                        Copy Token
                    </button>
                    <button onclick="window.print()" class="btn btn-secondary text-sm sm:text-base">
                        <i class="bi bi-printer me-2"></i>
                        Print This Page
                    </button>
                </div>
            </div>
            
            <div class="space-y-3 sm:space-y-4 text-left">
                <div class="alert alert-warning">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    <div>
                        <strong>You MUST save this token now!</strong> This is the only way to access your registration status and submit your project later.
                    </div>
                </div>
                
                <div class="bg-amber-900/20 border border-amber-500/30 rounded-lg p-3 sm:p-4">
                    <h3 class="font-bold text-amber-300 mb-2 sm:mb-3 flex items-center text-sm sm:text-base">
                        <i class="bi bi-lightbulb me-2"></i>
                        How to save your token:
                    </h3>
                    <ul class="space-y-1 sm:space-y-2 text-gray-300 text-sm sm:text-base">
                        <li class="flex items-start">
                            <i class="bi bi-check text-green-400 me-2 mt-0.5 flex-shrink-0"></i>
                            <span>Write it down on paper and keep it safe</span>
                        </li>
                        <li class="flex items-start">
                            <i class="bi bi-check text-green-400 me-2 mt-0.5 flex-shrink-0"></i>
                            <span>Save this page as a bookmark in your browser</span>
                        </li>
                        <li class="flex items-start">
                            <i class="bi bi-check text-green-400 me-2 mt-0.5 flex-shrink-0"></i>
                            <span>Take a screenshot of this page</span>
                        </li>
                        <li class="flex items-start">
                            <i class="bi bi-check text-green-400 me-2 mt-0.5 flex-shrink-0"></i>
                            <span>Copy the token and save it in a secure note app</span>
                        </li>
                        <li class="flex items-start">
                            <i class="bi bi-check text-green-400 me-2 mt-0.5 flex-shrink-0"></i>
                            <span>Share the token with your team members</span>
                        </li>
                    </ul>
                </div>
                
                <div class="bg-red-900/20 border border-red-500/30 rounded-lg p-3 sm:p-4">
                    <h3 class="font-bold text-red-300 mb-2 sm:mb-3 flex items-center text-sm sm:text-base">
                        <i class="bi bi-shield-exclamation me-2"></i>
                        Why is this important?
                    </h3>
                    <ul class="space-y-1 sm:space-y-2 text-gray-300 text-sm sm:text-base">
                        <li class="flex items-start">
                            <i class="bi bi-x text-red-400 me-2 mt-0.5 flex-shrink-0"></i>
                            <span>We cannot recover lost tokens</span>
                        </li>
                        <li class="flex items-start">
                            <i class="bi bi-x text-red-400 me-2 mt-0.5 flex-shrink-0"></i>
                            <span>No email confirmation will be sent</span>
                        </li>
                        <li class="flex items-start">
                            <i class="bi bi-x text-red-400 me-2 mt-0.5 flex-shrink-0"></i>
                            <span>You need this token to submit your GitHub repository</span>
                        </li>
                        <li class="flex items-start">
                            <i class="bi bi-x text-red-400 me-2 mt-0.5 flex-shrink-0"></i>
                            <span>You need this token to submit your final project</span>
                        </li>
                        <li class="flex items-start">
                            <i class="bi bi-x text-red-400 me-2 mt-0.5 flex-shrink-0"></i>
                            <span>You need this token to check your payment status</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Team Information Summary -->
        <div class="card p-4 sm:p-6 lg:p-8 mb-8 sm:mb-12">
            <div class="flex items-center mb-4 sm:mb-6">
                <div class="icon-container">
                    <i class="bi bi-people text-indigo-400"></i>
                </div>
                <h2 class="text-xl sm:text-2xl font-bold section-title">Registration Summary</h2>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6">
                <div>
                    <h3 class="font-bold text-base sm:text-lg mb-2 sm:mb-3 text-white">Team Details</h3>
                    <div class="space-y-2">
                        <div class="flex flex-col sm:flex-row sm:justify-between">
                            <span class="text-gray-400 text-sm sm:text-base">Team Name:</span>
                            <span class="font-semibold text-sm sm:text-base break-words">{{ $registration->team_name }}</span>
                        </div>
                        <div class="flex flex-col sm:flex-row sm:justify-between">
                            <span class="text-gray-400 text-sm sm:text-base">Team Size:</span>
                            <span class="font-semibold text-sm sm:text-base">{{ $registration->team_size }} member{{ $registration->team_size > 1 ? 's' : '' }}</span>
                        </div>
                        <div class="flex flex-col sm:flex-row sm:justify-between">
                            <span class="text-gray-400 text-sm sm:text-base">Registration Date:</span>
                            <span class="font-semibold text-sm sm:text-base">{{ $registration->created_at->format('M d, Y H:i') }}</span>
                        </div>
                        @if($registration->contact_phone)
                        <div class="flex flex-col sm:flex-row sm:justify-between">
                            <span class="text-gray-400 text-sm sm:text-base">Contact Phone:</span>
                            <span class="font-semibold text-sm sm:text-base">{{ $registration->contact_phone }}</span>
                        </div>
                        @endif
                    </div>
                </div>
                
                <div>
                    <h3 class="font-bold text-base sm:text-lg mb-2 sm:mb-3 text-white">Payment Information</h3>
                    <div class="space-y-2">
                        <div class="flex flex-col sm:flex-row sm:justify-between">
                            <span class="text-gray-400 text-sm sm:text-base">Transaction ID:</span>
                            <span class="font-semibold text-sm sm:text-base break-all">{{ $registration->transaction_id }}</span>
                        </div>
                        <div class="flex flex-col sm:flex-row sm:justify-between">
                            <span class="text-gray-400 text-sm sm:text-base">Amount:</span>
                            <span class="font-semibold text-sm sm:text-base">150 Taka</span>
                        </div>
                        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center">
                            <span class="text-gray-400 text-sm sm:text-base">Payment Status:</span>
                            <span class="badge badge-{{ $registration->payment_status === 'verified' ? 'success' : ($registration->payment_status === 'rejected' ? 'danger' : 'warning') }} text-xs sm:text-sm mt-1 sm:mt-0">
                                {{ ucfirst($registration->payment_status) }}{{ $registration->payment_status === 'pending' ? ' Verification' : '' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Next Steps -->
        <div class="card p-4 sm:p-6 lg:p-8 mb-8 sm:mb-12">
            <div class="flex items-center mb-4 sm:mb-6">
                <div class="icon-container">
                    <i class="bi bi-list-check text-emerald-400"></i>
                </div>
                <h2 class="text-xl sm:text-2xl font-bold section-title">What's Next?</h2>
            </div>
            
            <div class="space-y-3 sm:space-y-4">
                <div class="flex items-start p-3 sm:p-4 rounded-lg" style="background: rgba(99, 102, 241, 0.1);">
                    <div class="w-6 h-6 sm:w-8 sm:h-8 rounded-full bg-indigo-600 flex items-center justify-center mr-3 sm:mr-4 mt-1 flex-shrink-0">
                        <span class="text-white font-bold text-sm sm:text-base">1</span>
                    </div>
                    <div>
                        <h3 class="font-bold text-white mb-1 sm:mb-2 text-sm sm:text-base">Payment Verification</h3>
                        <p class="text-gray-300 text-sm sm:text-base">Our team will verify your payment within 24-48 hours. You'll see the status change when you check your registration.</p>
                    </div>
                </div>
                
                <div class="flex items-start p-3 sm:p-4 rounded-lg" style="background: rgba(16, 185, 129, 0.1);">
                    <div class="w-6 h-6 sm:w-8 sm:h-8 rounded-full bg-emerald-600 flex items-center justify-center mr-3 sm:mr-4 mt-1 flex-shrink-0">
                        <span class="text-white font-bold text-sm sm:text-base">2</span>
                    </div>
                    <div>
                        <h3 class="font-bold text-white mb-1 sm:mb-2 text-sm sm:text-base">Competition Begins (July 16, 6:00 PM)</h3>
                        <p class="text-gray-300 text-sm sm:text-base">Project requirements will be published and the development phase begins.</p>
                    </div>
                </div>
                
                <div class="flex items-start p-3 sm:p-4 rounded-lg" style="background: rgba(168, 85, 247, 0.1);">
                    <div class="w-6 h-6 sm:w-8 sm:h-8 rounded-full bg-purple-600 flex items-center justify-center mr-3 sm:mr-4 mt-1 flex-shrink-0">
                        <span class="text-white font-bold text-sm sm:text-base">3</span>
                    </div>
                    <div>
                        <h3 class="font-bold text-white mb-1 sm:mb-2 text-sm sm:text-base">GitHub Submission (Deadline: July 22, 6:00 PM)</h3>
                        <p class="text-gray-300 text-sm sm:text-base">Submit your GitHub repository link using your registration token.</p>
                    </div>
                </div>
                
                <div class="flex items-start p-3 sm:p-4 rounded-lg" style="background: rgba(245, 158, 11, 0.1);">
                    <div class="w-6 h-6 sm:w-8 sm:h-8 rounded-full bg-amber-600 flex items-center justify-center mr-3 sm:mr-4 mt-1 flex-shrink-0">
                        <span class="text-white font-bold text-sm sm:text-base">4</span>
                    </div>
                    <div>
                        <h3 class="font-bold text-white mb-1 sm:mb-2 text-sm sm:text-base">Final Submission (Deadline: July 30, 11:59 PM)</h3>
                        <p class="text-gray-300 text-sm sm:text-base">Submit your complete project with demo video using your registration token.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="text-center space-y-3 sm:space-y-4">
            <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 justify-center">
                <a href="{{ route('codesprint.status', $registration->registration_token) }}" class="btn btn-primary text-base sm:text-lg px-6 sm:px-8 py-3 sm:py-4">
                    <i class="bi bi-eye me-2"></i>
                    View Registration Status
                </a>
                <a href="{{ route('codesprint.rulebook') }}" class="btn btn-secondary text-base sm:text-lg px-6 sm:px-8 py-3 sm:py-4">
                    <i class="bi bi-book me-2"></i>
                    Read Competition Rules
                </a>
            </div>
            
            <p class="text-gray-400 text-xs sm:text-sm px-4">
                Bookmark this page or save the URL: 
                <span class="font-mono text-indigo-400 break-all">{{ url()->current() }}</span>
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
