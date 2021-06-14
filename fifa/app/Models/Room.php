<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $fillable = [
        'name',
        'slug'
    ];

    public function users() {
        return $this->belongsToMany(User::class);
    }

    public function championships() {
        return $this->belongsToMany(Championship::class);
    }

    public function games() {
        return $this->belongsToMany(Game::class);
    }

    public function friendlies() {
        return $this->belongsToMany(Friendly::class);
    }
}
