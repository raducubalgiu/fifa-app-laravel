<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Str;

class Championship extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'championship_no_of_room'];

    public function rooms() {
        return $this->belongsToMany(Room::class);
    }

    public function users() {
        return $this->belongsToMany(User::class);
    }

    public function games() {
        return $this->belongsToMany(Game::class);
    }

    public function statistics() {
        return $this->hasMany(Statistic::class);
    }
}
