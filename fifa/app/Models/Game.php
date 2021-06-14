<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'firstplayer_id',
        'firstplayer_username',
        'firstplayer_name',
        'firstplayer_team',
        'firstplayer_goals',
        'secondplayer_id',
        'secondplayer_username',
        'secondplayer_name',
        'secondplayer_team',
        'secondplayer_goals',
        'match_type',
        'firstplayer_victory',
        'secondplayer_victory',
        'firstplayer_points',
        'secondplayer_points'
    ];

    public function championships() {
        return $this->belongsToMany(Championship::class);
    }

    public function friendlies() {
        return $this->belongsToMany(Friendly::class);
    }

    public function rooms() {
        return $this->belongsToMany(Room::class);
    }

    public function statistics() {
        return $this->hasMany(Statistic::class);
    }

    public function users() {
        return $this->hasMany(User::class, 'firstplayer_id', 'user_id');
    }

    // public function getFirstPlayerUsernameAttribute($value) {
    //     return '@'.$value;
    // }

    // public function getSecondPlayerUsernameAttribute($value) {
    //     return '@'.$value;
    // }
}
