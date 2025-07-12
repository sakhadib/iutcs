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
                    
                    <div class="card p-6 mb-6">
                        <h3 class="font-bold text-lg mb-4 text-white">Payment Instructions</h3>
                        <div class="space-y-2 text-gray-300">
                            <p><strong>Registration Fee:</strong> 150 Taka</p>
                            <p><strong>Payment Method:</strong> bKash/Nagad/Rocket</p>
                            <p><strong>Payment Number:</strong> [To be provided]</p>
                            <p class="text-sm text-gray-400">Please send money and enter the transaction ID below</p>
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium mb-2 text-gray-300" for="transaction_id">Transaction ID *</label>
                        <input type="text" id="transaction_id" name="transaction_id" value="{{ old('transaction_id') }}" 
                               class="form-input w-full" placeholder="Enter transaction ID from bKash/Nagad/Rocket" required>
                        <p class="text-sm text-gray-400 mt-1">This will be verified by our team</p>
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

        // Initialize on page load if there's an old value
        document.addEventListener('DOMContentLoaded', function() {
            const teamSize = document.getElementById('team_size').value;
            if (teamSize) {
                document.getElementById('team_size').dispatchEvent(new Event('change'));
            }
        });

        // Form validation
        document.querySelector('form').addEventListener('submit', function(e) {
            const teamSize = document.getElementById('team_size').value;
            
            if (teamSize >= 2) {
                const member2Required = ['member2_name', 'member2_email', 'member2_student_id', 'member2_department', 'member2_year'];
                for (let field of member2Required) {
                    const input = document.getElementById(field);
                    if (!input.value.trim()) {
                        e.preventDefault();
                        alert('Please fill all required fields for Member 2');
                        input.focus();
                        return;
                    }
                }
            }
            
            if (teamSize >= 3) {
                const member3Required = ['member3_name', 'member3_email', 'member3_student_id', 'member3_department', 'member3_year'];
                for (let field of member3Required) {
                    const input = document.getElementById(field);
                    if (!input.value.trim()) {
                        e.preventDefault();
                        alert('Please fill all required fields for Member 3');
                        input.focus();
                        return;
                    }
                }
            }
        });
    </script>
</body>
</html>
