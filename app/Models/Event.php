<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    public function fest()
    {
        return $this->belongsTo(Fest::class);
    }

    public function registrationLogs()
    {
        return $this->hasMany(RegistrationLog::class);
    }

    public function registrationQuestionAnswers()
    {
        return $this->hasMany(RegistrationQuestionAnswer::class);
    }

    public function registrationQuestions()
    {
        return $this->hasMany(RegistrationQuestionField::class);
    }
}
