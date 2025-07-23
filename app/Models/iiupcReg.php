<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class iiupcReg extends Model
{
    use HasFactory;

    protected $fillable = [
        'team_name',
        
        // Member 1
        'member1_name',
        'member1_email',
        'member1_student_id',
        'member1_department',
        'member1_program',
        'member1_batch',
        'member1_phone',
        
        // Member 2
        'member2_name',
        'member2_email',
        'member2_student_id',
        'member2_department',
        'member2_program',
        'member2_batch',
        'member2_phone',
        
        // Member 3
        'member3_name',
        'member3_email',
        'member3_student_id',
        'member3_department',
        'member3_program',
        'member3_batch',
        'member3_phone',
        
        // Payment & Registration
        'transaction_id',
        'registration_token',
        'registration_status'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Generate a unique 6-character registration token
    public static function generateRegistrationToken()
    {
        do {
            $token = strtoupper(substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 6));
        } while (self::where('registration_token', $token)->exists());
        
        return $token;
    }

    // Check if registration is verified
    public function isVerified()
    {
        return $this->registration_status === 'verified';
    }

    // Check if registration is pending
    public function isPending()
    {
        return $this->registration_status === 'pending';
    }

    // Check if registration is removed
    public function isRemoved()
    {
        return $this->registration_status === 'removed';
    }
}
