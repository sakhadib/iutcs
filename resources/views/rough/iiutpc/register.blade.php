@include('rough.iiutpc.header', ['eventName' => $eventName])

<div class="min-h-screen py-12 px-4" style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #374151 100%);">
    <div class="max-w-4xl mx-auto">
        <!-- Header Section -->
        <div class="text-center mb-8 animate-fade-in">
            <h1 class="text-4xl md:text-5xl font-bold header-gradient mb-10">
                {{ $eventName }} Registration
            </h1>
            
            
            <!-- Contest Info Cards -->
            <div class="grid md:grid-cols-3 gap-6 mb-8">
                <div class="bg-gray-800/90 backdrop-blur-sm border border-gray-700 rounded-2xl p-6 hover:bg-gray-800 transition-all duration-300">
                    <div class="flex items-center justify-center mb-4">
                        <div class="w-12 h-12 bg-gray-600/30 rounded-xl flex items-center justify-center">
                            <i class="bi bi-calendar-event text-2xl text-gray-300"></i>
                        </div>
                    </div>
                    <h3 class="font-semibold text-white mb-2 text-center">Contest Date</h3>
                    <p class="text-gray-300 text-center">{{ $competitionDate->format('F j, Y') }}</p>
                    <p class="text-gray-400 text-sm text-center">{{ $competitionDate->format('g:i A') }}</p>
                </div>
                
                <div class="bg-gray-800/90 backdrop-blur-sm border border-gray-700 rounded-2xl p-6 hover:bg-gray-800 transition-all duration-300">
                    <div class="flex items-center justify-center mb-4">
                        <div class="w-12 h-12 bg-green-600/20 rounded-xl flex items-center justify-center">
                            <i class="bi bi-cash text-2xl text-green-400"></i>
                        </div>
                    </div>
                    <h3 class="font-semibold text-white mb-2 text-center">Registration Fee</h3>
                    <p class="text-2xl font-bold text-green-400 text-center">৳300</p>
                    <p class="text-gray-400 text-sm text-center">Per team</p>
                </div>
                
                <div class="bg-gray-800/90 backdrop-blur-sm border border-gray-700 rounded-2xl p-6 hover:bg-gray-800 transition-all duration-300">
                    <div class="flex items-center justify-center mb-4">
                        <div class="w-12 h-12 bg-amber-600/20 rounded-xl flex items-center justify-center">
                            <i class="bi bi-people text-2xl text-amber-400"></i>
                        </div>
                    </div>
                    <h3 class="font-semibold text-white mb-2 text-center">Team Size</h3>
                    <p class="text-2xl font-bold text-amber-400 text-center">3</p>
                    <p class="text-gray-400 text-sm text-center">Members required</p>
                </div>
            </div>
        </div>

        <!-- Registration Status -->
        @php
            $now = now();
            $isRegistrationOpen = $now->between($registrationStarts, $registrationEnds);
            $isBeforeRegistration = $now->lt($registrationStarts);
            $isAfterRegistration = $now->gt($registrationEnds);
        @endphp

        @if($isBeforeRegistration)
            <div class="alert alert-info mb-6">
                <i class="bi bi-info-circle me-2"></i>
                Registration will open on {{ $registrationStarts->format('F j, Y \a\t g:i A') }}
            </div>
        @elseif($isAfterRegistration)
            <div class="alert alert-error mb-6">
                <i class="bi bi-x-circle me-2"></i>
                Registration has ended on {{ $registrationEnds->format('F j, Y \a\t g:i A') }}
            </div>
        @else
            <div class="alert alert-success mb-6">
                <i class="bi bi-check-circle me-2"></i>
                Registration is now open! Deadline: {{ $registrationEnds->format('F j, Y \a\t g:i A') }}
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
                    <strong>Please correct the following errors:</strong>
                    <ul class="mt-2 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        @if($isRegistrationOpen)
        <!-- Registration Form -->
        <div class="bg-gray-800/95 backdrop-blur-sm border border-gray-700 rounded-2xl p-8 shadow-2xl">
            <div class="mb-8 text-center">
                <h2 class="text-2xl font-bold text-white mb-2">Team Registration Form</h2>
                <p class="text-gray-400">Please fill out all required information carefully</p>
            </div>
            
            <form action="{{ route('iiutpc.register.submit') }}" method="POST" class="space-y-10">
                @csrf
                
                <!-- Team Information -->
                <div class="bg-gray-700/30 rounded-xl p-6 border border-gray-600/50">
                    <h3 class="text-xl font-semibold text-white mb-6 flex items-center">
                        <div class="w-8 h-8 bg-gray-600/30 rounded-lg flex items-center justify-center mr-3">
                            <i class="bi bi-people-fill text-gray-300"></i>
                        </div>
                        Team Information
                    </h3>
                    
                    <div>
                        <label for="team_name" class="block text-sm font-medium text-gray-300 mb-3">
                            What would you like to name your team? <span class="text-red-400">*</span>
                        </label>
                        <input type="text" 
                               id="team_name" 
                               name="team_name" 
                               value="{{ old('team_name') }}"
                               class="w-full px-4 py-3 bg-gray-900/70 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:border-gray-400 focus:ring-1 focus:ring-gray-400 transition-all" 
                               placeholder="Enter a creative team name (e.g., Code Warriors, Debug Masters)"
                               required>
                        <p class="text-gray-400 text-xs mt-2">Choose something memorable and unique!</p>
                    </div>
                </div>

                <!-- Member 1 (Team Lead) -->
                <div class="bg-gray-700/30 rounded-xl p-6 border border-gray-600/50">
                    <h3 class="text-xl font-semibold text-white mb-6 flex items-center">
                        <div class="w-8 h-8 bg-green-600/20 rounded-lg flex items-center justify-center mr-3">
                            <i class="bi bi-person-check-fill text-green-400"></i>
                        </div>
                        Team Captain (Leader)
                    </h3>
                    <p class="text-gray-400 text-sm mb-6">The team captain will be the main point of contact</p>
                    
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label for="member1_name" class="block text-sm font-medium text-gray-300 mb-3">
                                Full Name <span class="text-red-400">*</span>
                            </label>
                            <input type="text" 
                                   id="member1_name" 
                                   name="member1_name" 
                                   value="{{ old('member1_name') }}"
                                   class="w-full px-4 py-3 bg-gray-900/70 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:border-gray-400 focus:ring-1 focus:ring-gray-400 transition-all" 
                                   placeholder="Enter your full name"
                                   required>
                        </div>
                        
                        <div>
                            <label for="member1_email" class="block text-sm font-medium text-gray-300 mb-3">
                                Email Address <span class="text-red-400">*</span>
                            </label>
                            <input type="email" 
                                   id="member1_email" 
                                   name="member1_email" 
                                   value="{{ old('member1_email') }}"
                                   class="w-full px-4 py-3 bg-gray-900/70 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:border-gray-400 focus:ring-1 focus:ring-gray-400 transition-all" 
                                   placeholder="your.email@example.com"
                                   required>
                        </div>
                        
                        <div>
                            <label for="member1_student_id" class="block text-sm font-medium text-gray-300 mb-3">
                                Student ID <span class="text-red-400">*</span>
                            </label>
                            <input type="text" 
                                   id="member1_student_id" 
                                   name="member1_student_id" 
                                   value="{{ old('member1_student_id') }}"
                                   class="w-full px-4 py-3 bg-gray-900/70 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:border-gray-400 focus:ring-1 focus:ring-gray-400 transition-all" 
                                   placeholder="e.g., 210041xxx"
                                   required>
                        </div>
                        
                        <div>
                            <label for="member1_department" class="block text-sm font-medium text-gray-300 mb-3">
                                Department <span class="text-red-400">*</span>
                            </label>
                            <input type="text" 
                                   id="member1_department" 
                                   name="member1_department" 
                                   value="{{ old('member1_department') }}"
                                   class="w-full px-4 py-3 bg-gray-900/70 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:border-gray-400 focus:ring-1 focus:ring-gray-400 transition-all" 
                                   placeholder="e.g., CSE, EEE, CEE, MPE, BTM ..."
                                   required>
                        </div>
                        
                        <div>
                            <label for="member1_program" class="block text-sm font-medium text-gray-300 mb-3">
                                Your Program <span class="text-red-400">*</span>
                            </label>
                            <input type="text" 
                                   id="member1_program" 
                                   name="member1_program" 
                                   value="{{ old('member1_program') }}"
                                   class="w-full px-4 py-3 bg-gray-900/70 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:border-gray-400 focus:ring-1 focus:ring-gray-400 transition-all" 
                                   placeholder=""
                                   required>
                        </div>
                        
                        <div>
                            <label for="member1_batch" class="block text-sm font-medium text-gray-300 mb-3">
                                Batch Year
                            </label>
                            <input type="text" 
                                   id="member1_batch" 
                                   name="member1_batch" 
                                   value="{{ old('member1_batch') }}"
                                   class="w-full px-4 py-3 bg-gray-900/70 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:border-gray-400 focus:ring-1 focus:ring-gray-400 transition-all" 
                                   placeholder="e.g., 2021, 2022">
                        </div>
                        
                        <div>
                            <label for="member1_phone" class="block text-sm font-medium text-gray-300 mb-3">
                                Phone Number
                            </label>
                            <input type="tel" 
                                   id="member1_phone" 
                                   name="member1_phone" 
                                   value="{{ old('member1_phone') }}"
                                   class="w-full px-4 py-3 bg-gray-900/70 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:border-gray-400 focus:ring-1 focus:ring-gray-400 transition-all" 
                                   placeholder="01XXXXXXXXX">
                        </div>
                    </div>
                </div>

                <!-- Member 2 -->
                <div class="bg-gray-700/30 rounded-xl p-6 border border-gray-600/50">
                    <h3 class="text-xl font-semibold text-white mb-6 flex items-center">
                        <div class="w-8 h-8 bg-gray-600/30 rounded-lg flex items-center justify-center mr-3">
                            <i class="bi bi-person-fill text-gray-300"></i>
                        </div>
                        Second Team Member
                    </h3>
                    
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label for="member2_name" class="block text-sm font-medium text-gray-300 mb-3">
                                Full Name <span class="text-red-400">*</span>
                            </label>
                            <input type="text" 
                                   id="member2_name" 
                                   name="member2_name" 
                                   value="{{ old('member2_name') }}"
                                   class="w-full px-4 py-3 bg-gray-900/70 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:border-gray-400 focus:ring-1 focus:ring-gray-400 transition-all" 
                                   placeholder="Enter full name"
                                   required>
                        </div>
                        
                        <div>
                            <label for="member2_email" class="block text-sm font-medium text-gray-300 mb-3">
                                Email Address <span class="text-red-400">*</span>
                            </label>
                            <input type="email" 
                                   id="member2_email" 
                                   name="member2_email" 
                                   value="{{ old('member2_email') }}"
                                   class="w-full px-4 py-3 bg-gray-900/70 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:border-gray-400 focus:ring-1 focus:ring-gray-400 transition-all" 
                                   placeholder="their.email@example.com"
                                   required>
                        </div>
                        
                        <div>
                            <label for="member2_student_id" class="block text-sm font-medium text-gray-300 mb-3">
                                Student ID <span class="text-red-400">*</span>
                            </label>
                            <input type="text" 
                                   id="member2_student_id" 
                                   name="member2_student_id" 
                                   value="{{ old('member2_student_id') }}"
                                   class="w-full px-4 py-3 bg-gray-900/70 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:border-gray-400 focus:ring-1 focus:ring-gray-400 transition-all" 
                                   placeholder="e.g., 210041xxx"
                                   required>
                        </div>
                        
                        <div>
                            <label for="member2_department" class="block text-sm font-medium text-gray-300 mb-3">
                                Department <span class="text-red-400">*</span>
                            </label>
                            <input type="text" 
                                   id="member2_department" 
                                   name="member2_department" 
                                   value="{{ old('member2_department') }}"
                                   class="w-full px-4 py-3 bg-gray-900/70 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:border-gray-400 focus:ring-1 focus:ring-gray-400 transition-all" 
                                   placeholder="e.g., CSE, EEE, CEE, MPE, BTM ..."
                                   required>
                        </div>
                        
                        <div>
                            <label for="member2_program" class="block text-sm font-medium text-gray-300 mb-3">
                                Your Program <span class="text-red-400">*</span>
                            </label>
                            <input type="text" 
                                   id="member2_program" 
                                   name="member2_program" 
                                   value="{{ old('member2_program') }}"
                                   class="w-full px-4 py-3 bg-gray-900/70 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:border-gray-400 focus:ring-1 focus:ring-gray-400 transition-all" 
                                   placeholder=""
                                   required>
                        </div>
                        
                        <div>
                            <label for="member2_batch" class="block text-sm font-medium text-gray-300 mb-3">
                                Batch Year
                            </label>
                            <input type="text" 
                                   id="member2_batch" 
                                   name="member2_batch" 
                                   value="{{ old('member2_batch') }}"
                                   class="w-full px-4 py-3 bg-gray-900/70 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:border-gray-400 focus:ring-1 focus:ring-gray-400 transition-all" 
                                   placeholder="e.g., 2021, 2022">
                        </div>
                        
                        <div>
                            <label for="member2_phone" class="block text-sm font-medium text-gray-300 mb-3">
                                Phone Number
                            </label>
                            <input type="tel" 
                                   id="member2_phone" 
                                   name="member2_phone" 
                                   value="{{ old('member2_phone') }}"
                                   class="w-full px-4 py-3 bg-gray-900/70 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:border-gray-400 focus:ring-1 focus:ring-gray-400 transition-all" 
                                   placeholder="01XXXXXXXXX">
                        </div>
                    </div>
                </div>

                <!-- Member 3 -->
                <div class="bg-gray-700/30 rounded-xl p-6 border border-gray-600/50">
                    <h3 class="text-xl font-semibold text-white mb-6 flex items-center">
                        <div class="w-8 h-8 bg-gray-600/30 rounded-lg flex items-center justify-center mr-3">
                            <i class="bi bi-person-fill text-gray-300"></i>
                        </div>
                        Third Team Member
                    </h3>
                    
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label for="member3_name" class="block text-sm font-medium text-gray-300 mb-3">
                                Full Name <span class="text-red-400">*</span>
                            </label>
                            <input type="text" 
                                   id="member3_name" 
                                   name="member3_name" 
                                   value="{{ old('member3_name') }}"
                                   class="w-full px-4 py-3 bg-gray-900/70 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:border-gray-400 focus:ring-1 focus:ring-gray-400 transition-all" 
                                   placeholder="Enter full name"
                                   required>
                        </div>
                        
                        <div>
                            <label for="member3_email" class="block text-sm font-medium text-gray-300 mb-3">
                                Email Address <span class="text-red-400">*</span>
                            </label>
                            <input type="email" 
                                   id="member3_email" 
                                   name="member3_email" 
                                   value="{{ old('member3_email') }}"
                                   class="w-full px-4 py-3 bg-gray-900/70 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:border-gray-400 focus:ring-1 focus:ring-gray-400 transition-all" 
                                   placeholder="their.email@example.com"
                                   required>
                        </div>
                        
                        <div>
                            <label for="member3_student_id" class="block text-sm font-medium text-gray-300 mb-3">
                                Student ID <span class="text-red-400">*</span>
                            </label>
                            <input type="text" 
                                   id="member3_student_id" 
                                   name="member3_student_id" 
                                   value="{{ old('member3_student_id') }}"
                                   class="w-full px-4 py-3 bg-gray-900/70 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:border-gray-400 focus:ring-1 focus:ring-gray-400 transition-all" 
                                   placeholder="e.g., 210041xxx"
                                   required>
                        </div>
                        
                        <div>
                            <label for="member3_department" class="block text-sm font-medium text-gray-300 mb-3">
                                Department <span class="text-red-400">*</span>
                            </label>
                            <input type="text" 
                                   id="member3_department" 
                                   name="member3_department" 
                                   value="{{ old('member3_department') }}"
                                   class="w-full px-4 py-3 bg-gray-900/70 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:border-gray-400 focus:ring-1 focus:ring-gray-400 transition-all" 
                                   placeholder="e.g., CSE, EEE, CEE, MPE, BTM ..."
                                   required>
                        </div>
                        
                        <div>
                            <label for="member3_program" class="block text-sm font-medium text-gray-300 mb-3">
                                Your Program <span class="text-red-400">*</span>
                            </label>
                            <input type="text" 
                                   id="member3_program" 
                                   name="member3_program" 
                                   value="{{ old('member3_program') }}"
                                   class="w-full px-4 py-3 bg-gray-900/70 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:border-gray-400 focus:ring-1 focus:ring-gray-400 transition-all" 
                                   placeholder=""
                                   required>
                        </div>
                        
                        <div>
                            <label for="member3_batch" class="block text-sm font-medium text-gray-300 mb-3">
                                Batch Year
                            </label>
                            <input type="text" 
                                   id="member3_batch" 
                                   name="member3_batch" 
                                   value="{{ old('member3_batch') }}"
                                   class="w-full px-4 py-3 bg-gray-900/70 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:border-gray-400 focus:ring-1 focus:ring-gray-400 transition-all" 
                                   placeholder="e.g., 2021, 2022">
                        </div>
                        
                        <div>
                            <label for="member3_phone" class="block text-sm font-medium text-gray-300 mb-3">
                                Phone Number
                            </label>
                            <input type="tel" 
                                   id="member3_phone" 
                                   name="member3_phone" 
                                   value="{{ old('member3_phone') }}"
                                   class="w-full px-4 py-3 bg-gray-900/70 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:border-gray-400 focus:ring-1 focus:ring-gray-400 transition-all" 
                                   placeholder="01XXXXXXXXX">
                        </div>
                    </div>
                </div>

                <!-- Payment Information -->
                <div class="bg-gray-700/30 rounded-xl p-6 border border-gray-600/50">
                    <h3 class="text-xl font-semibold text-white mb-6 flex items-center">
                        <div class="w-8 h-8 bg-green-600/20 rounded-lg flex items-center justify-center mr-3">
                            <i class="bi bi-credit-card text-green-400"></i>
                        </div>
                        Payment Information
                    </h3>
                    
                    <div class="bg-gradient-to-r from-green-500/10 to-gray-500/10 border border-green-500/30 rounded-xl p-6 mb-6">
                        <div class="flex items-start mb-4">
                            <div class="w-10 h-10 bg-green-500/20 rounded-lg flex items-center justify-center mr-4 flex-shrink-0 mt-1">
                                <i class="bi bi-phone text-green-400 text-lg"></i>
                            </div>
                            <div>
                                <h4 class="text-lg font-semibold text-white mb-2">How to Pay Using bKash</h4>
                                <p class="text-gray-300 text-sm">Follow these simple steps to complete your payment</p>
                            </div>
                        </div>
                        
                        <div class="space-y-3 text-gray-300">
                            <div class="flex items-start">
                                <span class="bg-green-500/20 text-green-400 text-xs font-bold px-2 py-1 rounded mr-3 mt-0.5">1</span>
                                <p>Open your bKash app and select <strong>"Send Money"</strong></p>
                            </div>
                            <div class="bg-yellow-900/60 border-l-4 border-yellow-400 rounded-lg p-3 my-2 animate-pulse">
                                <div class="flex items-center mb-2">
                                    <span class="bg-yellow-400 text-yellow-900 text-xs font-bold px-2 py-1 rounded mr-2">IMPORTANT</span>
                                </div>
                                <div class="font-semibold text-yellow-200">
                                    <div class="text-yellow-300 mb-2">You <u>MUST</u> add a reference in bKash:</div>
                                    <div class="text-sm sm:text-lg font-bold text-yellow-300 mb-2 break-all">
                                        ref → <span class="font-mono bg-yellow-100/20 text-yellow-400 px-1 py-1 rounded text-xs sm:text-sm">ahiupc_&lt;team_name&gt;</span>
                                    </div>
                                    <div class="text-yellow-200 text-xs leading-relaxed">
                                        (Replace <span class="font-mono bg-yellow-100/10 px-1 rounded">&lt;team_name&gt;</span> with your actual team name. This is required for payment verification!)
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <span class="bg-green-500/20 text-green-400 text-xs font-bold px-2 py-1 rounded mr-3 mt-0.5">2</span>
                                <p>Send exactly <span class="text-green-400 font-bold">৳300</span> to this number: <span class="text-gray-200 font-mono font-bold text-lg">01681365712</span></p>
                            </div>
                            <div class="flex items-start">
                                <span class="bg-green-500/20 text-green-400 text-xs font-bold px-2 py-1 rounded mr-3 mt-0.5">3</span>
                                <p>After payment, you'll receive a confirmation SMS with your transaction ID</p>
                            </div>
                            <div class="flex items-start">
                                <span class="bg-green-500/20 text-green-400 text-xs font-bold px-2 py-1 rounded mr-3 mt-0.5">4</span>
                                <p>Copy that transaction ID and enter it in the field below</p>
                            </div>
                        </div>
                    </div>
                    
                    <div>
                        <label for="transaction_id" class="block text-sm font-medium text-gray-300 mb-3">
                            bKash Transaction ID <span class="text-red-400">*</span>
                        </label>
                        <input type="text" 
                               id="transaction_id" 
                               name="transaction_id" 
                               value="{{ old('transaction_id') }}"
                               class="w-full px-4 py-3 bg-gray-900/70 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:border-gray-400 focus:ring-1 focus:ring-gray-400 transition-all font-mono" 
                               placeholder="Enter your transaction ID here"
                               required>
                        <p class="text-gray-400 text-xs mt-2">
                            Transaction ID usually looks like: 9A1B2C3D4E (around 10 characters)
                        </p>
                    </div>
                </div>

                <!-- Terms and Conditions -->
                <div class="bg-gray-700/30 rounded-xl p-6 border border-gray-600/50">
                    <div class="flex items-start space-x-4">
                        <input type="checkbox" 
                               id="terms_accepted" 
                               name="terms_accepted" 
                               class="mt-2 w-5 h-5 text-gray-500 bg-gray-800 border-gray-600 rounded focus:ring-gray-400 focus:ring-2" 
                               required>
                        <label for="terms_accepted" class="text-gray-300 leading-relaxed">
                            <span class="text-red-400">*</span> I confirm that all the information I have provided is accurate and truthful. I understand that:
                            <ul class="mt-2 space-y-1 text-sm text-gray-400 list-disc list-inside ml-4">
                                <li>False information may result in disqualification</li>
                                <li>The registration fee is non-refundable</li>
                                <li>I agree to follow all contest rules and regulations</li>
                                <li>Contest organizers' decisions will be final</li>
                            </ul>
                        </label>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="text-center pt-4">
                    <button type="submit" class="w-full md:w-auto px-12 py-4 bg-gradient-to-r from-gray-600 to-green-600 hover:from-gray-700 hover:to-green-700 text-white text-lg font-semibold rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                        <i class="bi bi-check-circle me-2"></i>
                        Complete Team Registration
                    </button>
                    <p class="text-gray-400 text-sm mt-3">
                        Your registration will be reviewed within 24-48 hours after payment verification
                    </p>
                </div>
            </form>
        </div>
        @endif
    </div>
</div>

@include('layouts.footer')