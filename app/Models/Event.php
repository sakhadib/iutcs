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

    public function participants()
    {
        return $this->hasMany(EventRegistrationLog::class);
    }

    public function registrationQuestionAnswers()
    {
        return $this->hasMany(EventRegQuestionAnswer::class);
    }

    public function registrationQuestions()
    {
        return $this->hasMany(RegistrationQuestionField::class);
    }

    public function eventImages()
    {
        return $this->hasMany(EventImage::class)->ordered();
    }

    public function featuredImages()
    {
        return $this->hasMany(EventImage::class)->featured()->ordered();
    }
}
