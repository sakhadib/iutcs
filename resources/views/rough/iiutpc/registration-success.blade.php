@include('rough.iiutpc.header', ['eventName' => $eventName])

<div class="min-h-screen bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 py-12 px-4">
    <div class="container mx-auto max-w-3xl">
        <div class="text-center mb-8 animate-fade-in">
            <!-- Success Icon -->
            <div class="flex justify-center mb-6">
                <div class="w-20 h-20 bg-gradient-to-r from-green-400 to-green-600 rounded-full flex items-center justify-center">
                    <i class="bi bi-check-lg text-white text-3xl"></i>
                </div>
            </div>
            
            <h1 class="text-4xl md:text-5xl font-bold header-gradient mb-4">
                Registration Successful!
            </h1>
            <p class="text-gray-300 text-lg">
                Your team has been successfully registered for {{ $eventName }}
            </p>
        </div>

        <!-- Registration Details Card -->
        <div class="form-card p-8 mb-6">
            <div class="text-center mb-6">
                <h2 class="text-2xl font-bold text-white mb-2">Registration Details</h2>
                <p class="text-gray-300">Please save this information for your records</p>
            </div>

            <div class="space-y-6">
                <!-- Registration Token -->
                <div class="card p-6 bg-gradient-to-r from-gray-800/50 to-gray-700/50 border-gray-600/30">
                    <div class="text-center">
                        <h3 class="text-lg font-semibold text-white mb-2">Your Registration Token</h3>
                        <div class="font-mono text-3xl font-bold text-primary mb-2">
                            {{ $registration->registration_token }}
                        </div>
                        <p class="text-gray-300 text-sm">
                            Keep this token safe! You'll need it to check your registration status.
                        </p>
                    </div>
                </div>

                <!-- Team Information -->
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-1">Team Name</label>
                        <p class="text-white font-semibold">{{ $registration->team_name }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-1">Registration Status</label>
                        <span class="badge badge-warning">
                            <i class="bi bi-clock me-1"></i>
                            {{ ucfirst($registration->registration_status) }}
                        </span>
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

        <!-- Next Steps -->
        <div class="alert alert-info mb-6">
            <i class="bi bi-info-circle me-2"></i>
            <div>
                <strong>What's Next?</strong>
                <ul class="mt-2 list-disc list-inside">
                    <li>We will verify your payment within 24-48 hours</li>
                    <li>You will receive an email confirmation once verified</li>
                    <li>Contest details will be shared via email before the event</li>
                    <li>Use your registration token to check status anytime</li>
                </ul>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-col md:flex-row gap-4 justify-center">
            <a href="{{ route('iiutpc.home') }}" class="btn btn-secondary">
                <i class="bi bi-house me-2"></i>
                Back to Home
            </a>
            
            <a href="{{ route('iiutpc.check') }}" class="btn btn-primary">
                <i class="bi bi-search me-2"></i>
                Check Registration Status
            </a>
        </div>
    </div>
</div>

@include('layouts.footer')
