<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    // Relationships

    public function registrationLogs()
    {
        return $this->hasMany(RegistrationLog::class);
    }

    public function registrationQuestionAnswers()
    {
        return $this->hasMany(RegistrationQuestionAnswer::class);
    }

    public function registrationQuestionAnswersForEvent($eventId)
    {
        return $this->hasMany(RegistrationQuestionAnswer::class)->where('event_id', $eventId);
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    public function events()
    {
        return $this->hasmany(Event::class);
    }

    public function userInfo()
    {
        return $this->hasOne(UserInfo::class);
    }
}
