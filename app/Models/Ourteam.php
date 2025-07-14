<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ourteam extends Model
{
    use HasFactory;

    protected $fillable = [
        'ot_id',
        'title',
        'name',
        'fb',
        'ig',
        't',
        'phone',
        'email',
        'image',
    ];

    public function programs()
    {
        return $this->hasMany(Program::class, 'ourteam_id');
    }

     public function category()
    {
        return $this->belongsTo(OurteamCategory::class, 'ot_id');
    }
}

