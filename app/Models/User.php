<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'status'
    ];

    /*public function groups()
     {
         return $this->belongsToMany(Group::class);
     }*/
     public function groups()
        {
            return $this->belongsToMany(Group::class, 'user_groups');
        }
    public function files()
    {
        return $this->hasMany(file::class);
    }
}
