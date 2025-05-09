<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    public function members()
    {
        return $this->hasMany(TeamMember::class);
    }
    public function teamLead()
    {
        return $this->belongsTo(User::class, 'team_lead');
    }
}
