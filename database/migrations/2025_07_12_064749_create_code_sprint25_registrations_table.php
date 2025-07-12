<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('code_sprint25_registrations', function (Blueprint $table) {
            $table->id();
            
            // Unique Registration Token (for status checking without auth)
            $table->string('registration_token', 6)->unique(); // 6-character alphanumeric string for easy access
            
            // Team Information
            $table->string('team_name');
            $table->tinyInteger('team_size')->default(1); // 1-3 members as per rules
            $table->string('github_repo_url')->nullable(); // For repository submission
            
            // Contact Information (Primary contact - Member 1)
            $table->string('contact_phone')->nullable(); // Primary contact number
            
            // Member 1 (Required - Team Leader)
            $table->string('member1_name');
            $table->string('member1_email');
            $table->string('member1_student_id');
            $table->string('member1_department');
            $table->enum('member1_year', ['1st', '2nd']); // Only 1st and 2nd year allowed
            
            // Member 2 (Optional)
            $table->string('member2_name')->nullable();
            $table->string('member2_email')->nullable();
            $table->string('member2_student_id')->nullable();
            $table->string('member2_department')->nullable();
            $table->enum('member2_year', ['1st', '2nd'])->nullable();
            
            // Member 3 (Optional)
            $table->string('member3_name')->nullable();
            $table->string('member3_email')->nullable();
            $table->string('member3_student_id')->nullable();
            $table->string('member3_department')->nullable();
            $table->enum('member3_year', ['1st', '2nd'])->nullable();
            
            // Payment Information (150 Taka participation fee)
            $table->string('transaction_id');
            $table->decimal('payment_amount', 8, 2)->default(150.00); // Fixed amount from rulebook
            $table->enum('payment_status', ['pending', 'verified', 'rejected'])->default('pending');
            $table->timestamp('payment_date')->nullable(); // When payment was made
            
            // Registration Status
            $table->enum('registration_status', ['active', 'disqualified', 'withdrawn'])->default('active');
            
            // Important Dates Tracking
            $table->timestamp('github_submitted_at')->nullable(); // Deadline: July 22, 2025 6:00 PM
            $table->timestamp('project_submitted_at')->nullable(); // Deadline: July 30, 2025 11:59 PM
            
            // Project Submission (for final submission)
            $table->string('project_zip_path')->nullable(); // Path to uploaded project zip
            $table->text('video_submission_url')->nullable(); // Video demonstration URL (max 15 minutes)
            $table->text('project_description')->nullable(); // Brief project description
            $table->boolean('uses_ai_ml')->default(false); // AI/ML integration flag (optional but encouraged)
            $table->text('technologies_used')->nullable(); // Programming languages, frameworks, etc.
            $table->string('deployment_url')->nullable(); // Live deployment URL (optional)
            
            // Selection for Final Presentation
            $table->boolean('selected_for_presentation')->default(false); // Top 10 teams flag
            $table->timestamp('presentation_date')->nullable(); // Final presentation date (TBA)
            
            // Additional Notes
            $table->text('admin_notes')->nullable(); // For admin use
            $table->text('team_notes')->nullable(); // Team's additional notes/comments
            
            $table->timestamps();
            
            // Indexes for better performance
            $table->index('registration_token'); // For quick token lookups
            $table->index('team_name');
            $table->index('team_size');
            $table->index('payment_status');
            $table->index('registration_status');
            $table->index('selected_for_presentation');
            $table->index('github_submitted_at');
            $table->index('project_submitted_at');
            $table->index('uses_ai_ml');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('code_sprint25_registrations');
    }
};
