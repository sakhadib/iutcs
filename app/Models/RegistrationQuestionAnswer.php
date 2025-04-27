<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistrationQuestionAnswer extends Model
{
    use HasFactory;

    public function registrationQuestionField()
    {
        return $this->belongsTo(RegistrationQuestionField::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
