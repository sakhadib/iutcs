@include('rough.iiutpc.header', ['eventName' => $eventName])

<div class="min-h-screen bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 py-12 px-4">
    <div class="container mx-auto max-w-2xl">
        <div class="text-center mb-8 animate-fade-in">
            <h1 class="text-4xl md:text-5xl font-bold header-gradient mb-4">
                Check Registration
            </h1>
            <p class="text-gray-300 text-lg">
                Enter your registration token to check your status
            </p>
        </div>

        <!-- Search Form -->
        @if(!isset($registration))
        <div class="form-card p-8 mb-6">
            <form action="{{ route('iiutpc.check.submit') }}" method="POST">
                @csrf
                <div class="space-y-6">
                    <div>
                        <label for="token" class="block text-sm font-medium text-gray-300 mb-2">
                            Registration Token <span class="text-danger">*</span>
                        </label>
                        <input type="text" 
                               id="token" 
                               name="token" 
                               value="{{ old('token') }}"
                               class="form-input w-full text-center font-mono text-lg tracking-wider" 
                               placeholder="Enter 6-character token"
                               maxlength="6"
                               style="text-transform: uppercase;"
                               required>
                        <p class="text-gray-400 text-sm mt-1">
                            Example: ABC123
                        </p>
                    </div>
                    
                    <button type="submit" class="btn btn-primary w-full">
                        <i class="bi bi-search me-2"></i>
                        Check Registration
                    </button>
                </div>
            </form>
        </div>
        @endif

        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="alert alert-success mb-6">
                <i class="bi bi-check-circle me-2"></i>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error mb-6">
                <i class="bi bi-x-circle me-2"></i>
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-error mb-6">
                <i class="bi bi-exclamation-triangle me-2"></i>
                <div>
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Registration Details -->
        @if(isset($registration))
        <div class="form-card p-8 mb-6">
            <div class="text-center mb-6">
                <h2 class="text-2xl font-bold text-white mb-2">Registration Found!</h2>
                
                <!-- Status Badge -->
                <div class="mb-4">
                    @if($registration->registration_status === 'verified')
                        <span class="badge badge-success text-lg px-4 py-2">
                            <i class="bi bi-check-circle me-2"></i>
                            Verified
                        </span>
                    @elseif($registration->registration_status === 'pending')
                        <span class="badge badge-warning text-lg px-4 py-2">
                            <i class="bi bi-clock me-2"></i>
                            Pending Verification
                        </span>
                    @else
                        <span class="badge badge-danger text-lg px-4 py-2">
                            <i class="bi bi-x-circle me-2"></i>
                            {{ ucfirst($registration->registration_status) }}
                        </span>
                    @endif
                </div>
            </div>

            <div class="space-y-6">
                <!-- Registration Token -->
                <div class="card p-6 bg-gradient-to-r from-gray-800/50 to-gray-700/50 border-gray-600/30">
                    <div class="text-center">
                        <h3 class="text-lg font-semibold text-white mb-2">Registration Token</h3>
                        <div class="font-mono text-2xl font-bold text-primary">
                            {{ $registration->registration_token }}
                        </div>
                    </div>
                </div>

                <!-- Team Information -->
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-1">Team Name</label>
                        <p class="text-white font-semibold">{{ $registration->team_name }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-1">Registered On</label>
                        <p class="text-gray-300">{{ $registration->created_at->format('F j, Y g:i A') }}</p>
                    </div>
                </div>

                <!-- Team Members -->
                <div class="space-y-4">
                    <h3 class="text-xl font-semibold text-white border-b border-gray-700 pb-2">Team Members</h3>
                    
                    <!-- Member 1 -->
                    <div class="card p-4">
                        <div class="flex items-center mb-2">
                            <i class="bi bi-person-fill text-primary me-2"></i>
                            <h4 class="font-semibold text-white">Team Lead</h4>
                        </div>
                        <div class="grid md:grid-cols-2 gap-4 text-sm">
                            <div>
                                <span class="text-gray-400">Name:</span>
                                <span class="text-white ml-2">{{ $registration->member1_name }}</span>
                            </div>
                            <div>
                                <span class="text-gray-400">Student ID:</span>
                                <span class="text-white ml-2">{{ $registration->member1_student_id }}</span>
                            </div>
                            <div>
                                <span class="text-gray-400">Department:</span>
                                <span class="text-white ml-2">{{ $registration->member1_department }}</span>
                            </div>
                            <div>
                                <span class="text-gray-400">Email:</span>
                                <span class="text-white ml-2">{{ $registration->member1_email }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Member 2 -->
                    <div class="card p-4">
                        <div class="flex items-center mb-2">
                            <i class="bi bi-person-fill text-secondary me-2"></i>
                            <h4 class="font-semibold text-white">Member 2</h4>
                        </div>
                        <div class="grid md:grid-cols-2 gap-4 text-sm">
                            <div>
                                <span class="text-gray-400">Name:</span>
                                <span class="text-white ml-2">{{ $registration->member2_name }}</span>
                            </div>
                            <div>
                                <span class="text-gray-400">Student ID:</span>
                                <span class="text-white ml-2">{{ $registration->member2_student_id }}</span>
                            </div>
                            <div>
                                <span class="text-gray-400">Department:</span>
                                <span class="text-white ml-2">{{ $registration->member2_department }}</span>
                            </div>
                            <div>
                                <span class="text-gray-400">Email:</span>
                                <span class="text-white ml-2">{{ $registration->member2_email }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Member 3 -->
                    <div class="card p-4">
                        <div class="flex items-center mb-2">
                            <i class="bi bi-person-fill text-warning me-2"></i>
                            <h4 class="font-semibold text-white">Member 3</h4>
                        </div>
                        <div class="grid md:grid-cols-2 gap-4 text-sm">
                            <div>
                                <span class="text-gray-400">Name:</span>
                                <span class="text-white ml-2">{{ $registration->member3_name }}</span>
                            </div>
                            <div>
                                <span class="text-gray-400">Student ID:</span>
                                <span class="text-white ml-2">{{ $registration->member3_student_id }}</span>
                            </div>
                            <div>
                                <span class="text-gray-400">Department:</span>
                                <span class="text-white ml-2">{{ $registration->member3_department }}</span>
                            </div>
                            <div>
                                <span class="text-gray-400">Email:</span>
                                <span class="text-white ml-2">{{ $registration->member3_email }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Payment Information -->
                <div class="card p-6 bg-gradient-to-r from-gray-800/30 to-gray-700/30 border-gray-600/30">
                    <h3 class="text-lg font-semibold text-white mb-4">Payment Information</h3>
                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <span class="text-gray-400">Transaction ID:</span>
                            <span class="text-white font-mono ml-2">{{ $registration->transaction_id }}</span>
                        </div>
                        <div>
                            <span class="text-gray-400">Amount:</span>
                            <span class="text-green-400 font-semibold ml-2">৳300</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Status Information -->
        @if($registration->registration_status === 'pending')
        <div class="alert alert-warning mb-6">
            <i class="bi bi-clock me-2"></i>
            <div>
                <strong>Payment Verification Pending</strong>
                <p class="mt-1">We are currently verifying your payment. This usually takes 24-48 hours. Check back later for updates.</p>
            </div>
        </div>
        @elseif($registration->registration_status === 'verified')
        <div class="alert alert-success mb-6">
            <i class="bi bi-check-circle me-2"></i>
            <div>
                <strong>Registration Verified!</strong>
                <p class="mt-1">Your payment has been verified and your registration is confirmed. Contest details will be shared via email.</p>
            </div>
        </div>
        @endif
        @endif

        <!-- Action Buttons -->
        <div class="flex flex-col md:flex-row gap-4 justify-center">
            <a href="{{ route('iiutpc.home') }}" class="btn btn-secondary">
                <i class="bi bi-house me-2"></i>
                Back to Home
            </a>
            
            @if(!isset($registration))
            <a href="{{ route('iiutpc.register') }}" class="btn btn-primary">
                <i class="bi bi-person-plus me-2"></i>
                New Registration
            </a>
            @else
            <button onclick="window.print()" class="btn btn-success">
                <i class="bi bi-printer me-2"></i>
                Print Details
            </button>
            @endif
        </div>
    </div>
</div>

<script>
document.getElementById('token').addEventListener('input', function(e) {
    e.target.value = e.target.value.toUpperCase();
});
</script>

@include('layouts.footer')
