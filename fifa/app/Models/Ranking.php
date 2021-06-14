<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ranking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'player_username',
        'player_firstname',
        'player_lastname',
        'winner_championships',
        'victories',
        'loses',
        'player_goals',
        'player_goals_received'
    ];

    public function users() {
        return $this->belongsTo(User::class);
    }
}
