<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventRegistrationLog extends Model
{
    use HasFactory;
    
    protected $fillable = ['user_id', 'event_id', 'team_id', 'status'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
    
    public function team()
    {
        return $this->belongsTo(Team::class);
    }
    
    public function answers()
    {
        return $this->hasMany(EventRegQuestionAnswer::class, 'team_id', 'team_id')
                    ->where('event_id', $this->event_id)
                    ->where('user_id', $this->user_id);
    }
}
