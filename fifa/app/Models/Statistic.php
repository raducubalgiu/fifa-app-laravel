<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'player_username',
        'player_name',
        'player_team',
        'player_goals',
        'player_goals_received',
        'player_points',
        'player_victory',
        'player_draw',
        'player_lose',
        'match_type',
        'game_id',
        'championship_id'
    ];

    public function games() {
        return $this->belongsTo(Game::class);
    }

    // public function getPlayerUsernameAttribute($value) {
    //     return '@'.$value;
    // }
}
