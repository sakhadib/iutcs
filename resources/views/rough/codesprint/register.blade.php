<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CodeSprint 2025 - Team Registration</title>
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
        <!-- Header -->
        <header class="text-center mb-12 pt-8">
            <div class="inline-block mb-4 px-4 py-1 bg-indigo-900/30 text-indigo-300 rounded-full text-sm font-medium border border-indigo-700/50">
                Registration Deadline: July 22, 2025 6:00 PM
            </div>
            <h1 class="text-4xl sm:text-5xl font-bold mb-4 header-gradient">
                Register Your Team
            </h1>
            <p class="text-xl max-w-2xl mx-auto text-gray-300">Join the Premier Coding Competition at IUT</p>
        </header>

        <!-- Alerts -->
        @if(session('success'))
            <div class="alert alert-success animate-fade-in">
                <i class="bi bi-check-circle me-2"></i>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error animate-fade-in">
                <i class="bi bi-exclamation-triangle me-2"></i>
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-error animate-fade-in">
                <i class="bi bi-exclamation-triangle me-2"></i>
                <div>
                    <strong>Please fix the following errors:</strong>
                    <ul class="mt-2 ml-4 list-disc">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <!-- Registration Form -->
        <div class="form-card p-8 animate-fade-in">
            <!-- Security Notice for Mobile Users -->
            <div class="alert alert-info mb-6">
                <i class="bi bi-info-circle me-2"></i>
                <div>
                    <strong>Mobile Users:</strong> If you see a "form not secure" warning, you can safely click "Send data anyway" to proceed with registration. Your information will be processed securely.
                </div>
            </div>
            
            <form action="{{ route('codesprint.register.submit') }}" method="POST" class="space-y-8">
                @csrf

                <!-- Team Information -->
                <section>
                    <div class="flex items-center mb-6">
                        <div class="icon-container">
                            <i class="bi bi-people text-indigo-400"></i>
                        </div>
                        <h2 class="text-2xl font-bold section-title">Team Information</h2>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium mb-2 text-gray-300" for="team_name">Team Name *</label>
                            <input type="text" id="team_name" name="team_name" value="{{ old('team_name') }}" 
                                   class="form-input w-full" placeholder="Enter your team name" required>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium mb-2 text-gray-300" for="team_size">Team Size *</label>
                            <select id="team_size" name="team_size" class="form-select w-full" required>
                                <option value="">Select team size</option>
                                <option value="1" {{ old('team_size') == '1' ? 'selected' : '' }}>1 Member (Solo)</option>
                                <option value="2" {{ old('team_size') == '2' ? 'selected' : '' }}>2 Members</option>
                                <option value="3" {{ old('team_size') == '3' ? 'selected' : '' }}>3 Members</option>
                            </select>
                        </div>
                        
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium mb-2 text-gray-300" for="contact_phone">Contact Phone</label>
                            <input type="tel" id="contact_phone" name="contact_phone" value="{{ old('contact_phone') }}" 
                                   class="form-input w-full" placeholder="Contact number for team leader">
                        </div>
                    </div>
                </section>

                <!-- Member 1 (Team Leader) -->
                <section>
                    <div class="flex items-center mb-6">
                        <div class="icon-container">
                            <i class="bi bi-person-badge text-emerald-400"></i>
                        </div>
                        <h2 class="text-2xl font-bold section-title">Team Leader Information</h2>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium mb-2 text-gray-300" for="member1_name">Full Name *</label>
                            <input type="text" id="member1_name" name="member1_name" value="{{ old('member1_name') }}" 
                                   class="form-input w-full" placeholder="Enter full name" required>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium mb-2 text-gray-300" for="member1_email">Email Address *</label>
                            <input type="email" id="member1_email" name="member1_email" value="{{ old('member1_email') }}" 
                                   class="form-input w-full" placeholder="Enter email address" required>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium mb-2 text-gray-300" for="member1_student_id">Student ID *</label>
                            <input type="text" id="member1_student_id" name="member1_student_id" value="{{ old('member1_student_id') }}" 
                                   class="form-input w-full" placeholder="Enter student ID" required>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium mb-2 text-gray-300" for="member1_department">Department *</label>
                            <input type="text" id="member1_department" name="member1_department" value="{{ old('member1_department') }}" 
                                   class="form-input w-full" placeholder="e.g., Computer Science & Engineering" required>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium mb-2 text-gray-300" for="member1_year">Academic Year *</label>
                            <select id="member1_year" name="member1_year" class="form-select w-full" required>
                                <option value="">Select year</option>
                                <option value="1st" {{ old('member1_year') == '1st' ? 'selected' : '' }}>1st Year</option>
                                <option value="2nd" {{ old('member1_year') == '2nd' ? 'selected' : '' }}>2nd Year</option>
                            </select>
                        </div>
                    </div>
                </section>

                <!-- Member 2 (Optional) -->
                <section id="member2-section" style="display: none;">
                    <div class="flex items-center mb-6">
                        <div class="icon-container">
                            <i class="bi bi-person text-cyan-400"></i>
                        </div>
                        <h2 class="text-2xl font-bold section-title">Team Member 2</h2>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium mb-2 text-gray-300" for="member2_name">Full Name</label>
                            <input type="text" id="member2_name" name="member2_name" value="{{ old('member2_name') }}" 
                                   class="form-input w-full" placeholder="Enter full name">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium mb-2 text-gray-300" for="member2_email">Email Address</label>
                            <input type="email" id="member2_email" name="member2_email" value="{{ old('member2_email') }}" 
                                   class="form-input w-full" placeholder="Enter email address">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium mb-2 text-gray-300" for="member2_student_id">Student ID</label>
                            <input type="text" id="member2_student_id" name="member2_student_id" value="{{ old('member2_student_id') }}" 
                                   class="form-input w-full" placeholder="Enter student ID">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium mb-2 text-gray-300" for="member2_department">Department</label>
                            <input type="text" id="member2_department" name="member2_department" value="{{ old('member2_department') }}" 
                                   class="form-input w-full" placeholder="e.g., Computer Science & Engineering">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium mb-2 text-gray-300" for="member2_year">Academic Year</label>
                            <select id="member2_year" name="member2_year" class="form-select w-full">
                                <option value="">Select year</option>
                                <option value="1st" {{ old('member2_year') == '1st' ? 'selected' : '' }}>1st Year</option>
                                <option value="2nd" {{ old('member2_year') == '2nd' ? 'selected' : '' }}>2nd Year</option>
                            </select>
                        </div>
                    </div>
                </section>

                <!-- Member 3 (Optional) -->
                <section id="member3-section" style="display: none;">
                    <div class="flex items-center mb-6">
                        <div class="icon-container">
                            <i class="bi bi-person text-violet-400"></i>
                        </div>
                        <h2 class="text-2xl font-bold section-title">Team Member 3</h2>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium mb-2 text-gray-300" for="member3_name">Full Name</label>
                            <input type="text" id="member3_name" name="member3_name" value="{{ old('member3_name') }}" 
                                   class="form-input w-full" placeholder="Enter full name">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium mb-2 text-gray-300" for="member3_email">Email Address</label>
                            <input type="email" id="member3_email" name="member3_email" value="{{ old('member3_email') }}" 
                                   class="form-input w-full" placeholder="Enter email address">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium mb-2 text-gray-300" for="member3_student_id">Student ID</label>
                            <input type="text" id="member3_student_id" name="member3_student_id" value="{{ old('member3_student_id') }}" 
                                   class="form-input w-full" placeholder="Enter student ID">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium mb-2 text-gray-300" for="member3_department">Department</label>
                            <input type="text" id="member3_department" name="member3_department" value="{{ old('member3_department') }}" 
                                   class="form-input w-full" placeholder="e.g., Computer Science & Engineering">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium mb-2 text-gray-300" for="member3_year">Academic Year</label>
                            <select id="member3_year" name="member3_year" class="form-select w-full">
                                <option value="">Select year</option>
                                <option value="1st" {{ old('member3_year') == '1st' ? 'selected' : '' }}>1st Year</option>
                                <option value="2nd" {{ old('member3_year') == '2nd' ? 'selected' : '' }}>2nd Year</option>
                            </select>
                        </div>
                    </div>
                </section>

                <!-- Payment Information -->
                <section>
                    <div class="flex items-center mb-6">
                        <div class="icon-container">
                            <i class="bi bi-credit-card text-amber-400"></i>
                        </div>
                        <h2 class="text-2xl font-bold section-title">Payment Information</h2>
                    </div>
                    
                    <div class="card p-6 mb-6 border border-pink-500/30">
                        <h3 class="font-bold text-lg mb-4 text-white flex items-center">
                            <i class="bi bi-phone text-pink-400 me-2"></i>
                            bKash Payment Instructions
                        </h3>
                        <div class="space-y-3 text-gray-300">
                            <div class="flex justify-between items-center">
                                <span><strong>Registration Fee:</strong></span>
                                <span class="font-bold text-pink-400">150 Taka</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span><strong>Payment Method:</strong></span>
                                <span class="font-bold text-pink-400">bKash Send Money</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span><strong>bKash Number:</strong></span>
                                <span class="font-mono font-bold text-pink-400 text-lg">01645534121</span>
                            </div>
                            <div class="bg-pink-900/20 border border-pink-500/30 rounded-lg p-4 mt-4">
                                <p class="font-bold text-pink-300 mb-2">Reference Format:</p>
                                <p class="font-mono text-sm text-gray-300">cs_[YourTeamName]</p>
                                <p class="text-sm text-gray-400 mt-2">Your reference will be: <span class="reference-example font-mono text-pink-400">cs_YourTeamName</span></p>
                            </div>
                            <div class="text-sm text-amber-300 mt-3">
                                <i class="bi bi-info-circle me-1"></i>
                                Please use the exact reference format and enter the transaction ID below after payment
                            </div>
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium mb-2 text-gray-300" for="transaction_id">bKash Transaction ID *</label>
                        <input type="text" id="transaction_id" name="transaction_id" value="{{ old('transaction_id') }}" 
                               class="form-input w-full" placeholder="Enter bKash transaction ID (e.g., BKxxxxxxxxxx)" required>
                        <p class="text-sm text-gray-400 mt-1">Transaction ID will be verified by our team within 24-48 hours</p>
                    </div>
                </section>

                <!-- Submit Button -->
                <div class="text-center pt-6">
                    <button type="submit" class="btn btn-primary text-lg px-8 py-4">
                        <i class="bi bi-check-circle me-2"></i>
                        Register Team
                    </button>
                    <p class="text-sm text-gray-400 mt-4">
                        By registering, you agree to follow the competition rules and guidelines
                    </p>
                </div>
            </form>
        </div>

        <!-- Navigation Links -->
        <div class="text-center mt-8">
            <a href="{{ route('codesprint.rulebook') }}" class="btn btn-secondary me-4">
                <i class="bi bi-book me-2"></i>
                View Rulebook
            </a>
            <a href="{{ route('codesprint.status.lookup') }}" class="btn btn-secondary">
                <i class="bi bi-search me-2"></i>
                Check Status
            </a>
        </div>
    </div>

    @include('layouts.footer')

    <script>
        // Team size change handler
        document.getElementById('team_size').addEventListener('change', function() {
            const teamSize = this.value;
            const member2Section = document.getElementById('member2-section');
            const member3Section = document.getElementById('member3-section');
            
            // Hide all member sections first
            member2Section.style.display = 'none';
            member3Section.style.display = 'none';
            
            // Show relevant sections based on team size
            if (teamSize >= 2) {
                member2Section.style.display = 'block';
            }
            if (teamSize >= 3) {
                member3Section.style.display = 'block';
            }
        });

        // Update reference format preview when team name changes
        document.getElementById('team_name').addEventListener('input', function() {
            const teamName = this.value.trim();
            const referenceExample = document.querySelector('.reference-example');
            if (referenceExample) {
                if (teamName) {
                    referenceExample.innerHTML = `<span class="font-mono text-pink-400">cs_${teamName}</span>`;
                } else {
                    referenceExample.innerHTML = `<span class="font-mono text-pink-400">cs_YourTeamName</span>`;
                }
            }
        });

        // Initialize on page load if there's an old value
        document.addEventListener('DOMContentLoaded', function() {
            const teamSize = document.getElementById('team_size').value;
            if (teamSize) {
                document.getElementById('team_size').dispatchEvent(new Event('change'));
            }
            
            // Initialize reference preview
            const teamName = document.getElementById('team_name').value;
            if (teamName) {
                document.getElementById('team_name').dispatchEvent(new Event('input'));
            }
        });
    </script>
</body>
</html>
