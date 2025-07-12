<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CodeSprint25Registration extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     */
    protected $table = 'code_sprint25_registrations';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'registration_token',
        'team_name',
        'team_size',
        'github_repo_url',
        'contact_phone',
        
        // Member 1 (Required)
        'member1_name',
        'member1_email',
        'member1_student_id',
        'member1_department',
        'member1_year',
        
        // Member 2 (Optional)
        'member2_name',
        'member2_email',
        'member2_student_id',
        'member2_department',
        'member2_year',
        
        // Member 3 (Optional)
        'member3_name',
        'member3_email',
        'member3_student_id',
        'member3_department',
        'member3_year',
        
        // Payment Information
        'transaction_id',
        'payment_amount',
        'payment_status',
        'payment_date',
        
        // Registration Status
        'registration_status',
        
        // Submission Tracking
        'github_submitted_at',
        'project_submitted_at',
        
        // Project Details
        'project_zip_path',
        'video_submission_url',
        'project_description',
        'uses_ai_ml',
        'technologies_used',
        'deployment_url',
        
        // Final Presentation
        'selected_for_presentation',
        'presentation_date',
        
        // Notes
        'admin_notes',
        'team_notes',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'team_size' => 'integer',
        'payment_amount' => 'decimal:2',
        'payment_date' => 'datetime',
        'github_submitted_at' => 'datetime',
        'project_submitted_at' => 'datetime',
        'presentation_date' => 'datetime',
        'uses_ai_ml' => 'boolean',
        'selected_for_presentation' => 'boolean',
    ];

    /**
     * The attributes that should be hidden for serialization.
     */
    protected $hidden = [
        'registration_token', // Don't expose token in JSON responses unless needed
    ];

    /**
     * Boot the model and generate registration token.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->registration_token)) {
                $model->registration_token = self::generateRegistrationToken();
            }
        });
    }

    /**
     * Generate a 6-character alphanumeric registration token.
     * Excludes confusing characters: 0, O, 1, l, I
     */
    public static function generateRegistrationToken()
    {
        $characters = '23456789ABCDEFGHJKMNPQRSTUVWXYZ';
        $token = '';
        
        do {
            $token = '';
            for ($i = 0; $i < 6; $i++) {
                $token .= $characters[random_int(0, strlen($characters) - 1)];
            }
        } while (self::where('registration_token', $token)->exists());
        
        return $token;
    }

    /**
     * Get route key name for route model binding.
     */
    public function getRouteKeyName()
    {
        return 'registration_token';
    }

    /**
     * Scope to get active registrations.
     */
    public function scopeActive($query)
    {
        return $query->where('registration_status', 'active');
    }

    /**
     * Scope to get verified payments.
     */
    public function scopeVerifiedPayment($query)
    {
        return $query->where('payment_status', 'verified');
    }

    /**
     * Scope to get teams selected for presentation.
     */
    public function scopeSelectedForPresentation($query)
    {
        return $query->where('selected_for_presentation', true);
    }

    /**
     * Check if registration is complete.
     */
    public function isComplete()
    {
        return $this->payment_status === 'verified' && 
               $this->registration_status === 'active';
    }

    /**
     * Check if GitHub repo is submitted.
     */
    public function hasGithubSubmission()
    {
        return !empty($this->github_repo_url) && !is_null($this->github_submitted_at);
    }

    /**
     * Check if final project is submitted.
     */
    public function hasFinalSubmission()
    {
        return !empty($this->project_zip_path) && !is_null($this->project_submitted_at);
    }

    /**
     * Get all team members as an array.
     */
    public function getTeamMembers()
    {
        $members = [];
        
        // Member 1 (always exists)
        $members[] = [
            'name' => $this->member1_name,
            'email' => $this->member1_email,
            'student_id' => $this->member1_student_id,
            'department' => $this->member1_department,
            'year' => $this->member1_year,
            'is_leader' => true,
        ];

        // Member 2 (if exists)
        if (!empty($this->member2_name)) {
            $members[] = [
                'name' => $this->member2_name,
                'email' => $this->member2_email,
                'student_id' => $this->member2_student_id,
                'department' => $this->member2_department,
                'year' => $this->member2_year,
                'is_leader' => false,
            ];
        }

        // Member 3 (if exists)
        if (!empty($this->member3_name)) {
            $members[] = [
                'name' => $this->member3_name,
                'email' => $this->member3_email,
                'student_id' => $this->member3_student_id,
                'department' => $this->member3_department,
                'year' => $this->member3_year,
                'is_leader' => false,
            ];
        }

        return $members;
    }

    /**
     * Get payment status badge color.
     */
    public function getPaymentStatusColor()
    {
        return match($this->payment_status) {
            'verified' => 'success',
            'rejected' => 'danger',
            'pending' => 'warning',
            default => 'secondary'
        };
    }

    /**
     * Get registration status badge color.
     */
    public function getRegistrationStatusColor()
    {
        return match($this->registration_status) {
            'active' => 'success',
            'disqualified' => 'danger',
            'withdrawn' => 'warning',
            default => 'secondary'
        };
    }

    /**
     * Get formatted registration token for display.
     */
    public function getFormattedTokenAttribute()
    {
        return strtoupper($this->registration_token);
    }

    /**
     * Check if team can still submit GitHub repo.
     */
    public function canSubmitGithub()
    {
        $deadline = now()->create(2025, 7, 22, 18, 0, 0); // July 22, 2025 6:00 PM
        return now() <= $deadline && $this->isComplete();
    }

    /**
     * Check if team can still submit final project.
     */
    public function canSubmitFinalProject()
    {
        $deadline = now()->create(2025, 7, 30, 23, 59, 0); // July 30, 2025 11:59 PM
        return now() <= $deadline && $this->isComplete();
    }
}
