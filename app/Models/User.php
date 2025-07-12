<?php

namespace App\Models;

use App\Notifications\CustomResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens; // jika suatu saat pakai API

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        // tambahkan kolom lain jika ada, misalnya: 'role', 'avatar', dst
    ];

    /**
     * The attributes that should be hidden for arrays (serialization).
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Automatically hash password if plain text is assigned.
     */
    public function setPasswordAttribute($value)
    {
        // Otomatis hash saat simpan
        $this->attributes['password'] = bcrypt($value);
    }

    /**
     * Relationship to posts (1 user bisa punya banyak post).
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }



    public function sendPasswordResetNotification($token)
    {
        $this->notify(new CustomResetPassword($token));
    }
}
