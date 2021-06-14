<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Friendly extends Model
{
    use HasFactory;

    protected $fillable = [
        'firstplayer_id',
        'firstplayer_firstname',
        'firstplayer_lastname',
        'firstplayer_team',
        'firstplayer_goals',
        'secondplayer_id',
        'secondplayer_firstname',
        'secondplayer_lastname',
        'secondplayer_team',
        'secondplayer_goals',
        'match_type',
        'firstplayer_victory',
        'secondplayer_victory',
        'firstplayer_points',
        'secondplayer_points'
    ];

    public function rooms() {
        return $this->belongsToMany(Room::class);
    }
}
