<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    public function members()
    {
        return $this->hasMany(TeamMember::class)->with('user');
    }
    public function leader()
    {
        return $this->belongsTo(User::class, 'team_lead');
    }
}
