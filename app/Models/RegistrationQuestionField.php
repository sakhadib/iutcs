<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistrationQuestionField extends Model
{
    use HasFactory;

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function registrationQuestionAnswers()
    {
        return $this->hasMany(EventRegQuestionAnswer::class);
    }
}
