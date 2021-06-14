<?php

namespace App\Models;

use App\Http\Controllers\RankingController;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use App\Models\Game;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'firstname',
        'lastname',
        'email',
        'password',
        'avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
  
    // Relationship with rooms
    public function rooms() {
        return $this->belongsToMany(Room::class);
    }

    // Relationship with permissions
    public function permissions() {
        return $this->belongsToMany(Permission::class);
    }

    // Relationship with roles
    public function roles() {
        return $this->belongsToMany(Role::class);
    }

    // Relationship with championships
    public function championships() {
        return $this->belongsToMany(Championship::class);
    }

    // Relationship with statistics
    public function statistics() {
        return $this->hasMany(Statistic::class);
    }

    // Relationship with rankings
    public function rankings() {
        return $this->hasOne(Ranking::class);
    }

    // Verifiying if the user has role
    public function userHasRole($role_name) {
        foreach($this->roles as $role) {
            if(Str::lower($role_name) == Str::lower($role->name)) {
                return true;
            }
            return false;
        }
    }

    // Getter Function for images path
    public function getUserImageAttribute($value) {
        if (strpos($value, 'https://') !== FALSE || strpos($value, 'http://') !== FALSE) {
            return $value;
        }
        return asset('storage/' . $value);
    }

    // Getter Function for avatar
    public function getAvatarAttribute($value) {
        return asset('images/'.$value);
    }
}
