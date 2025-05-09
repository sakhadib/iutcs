<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventRegQuestionAnswer extends Model
{
    use HasFactory;
    
    protected $fillable = ['user_id', 'event_id', 'question_id', 'team_id', 'answer'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
    
    public function question()
    {
        return $this->belongsTo(RegistrationQuestionField::class, 'question_id');
    }
    
    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
