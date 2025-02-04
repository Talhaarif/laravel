<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
 use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
     use HasApiTokens, Notifiable;

    protected $fillable = ['name', 'username', 'email', 'password', 'profile_image'];

    protected $hidden = ['password', 'remember_token'];

    public function posts()
    {
        return $this->hasMany(Post::class); // One-to-many relationship
    }
}