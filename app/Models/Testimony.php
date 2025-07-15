<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimony extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'title',
        'slug',
        'program_id',
        'description',
        'image',
        'yt_link',
        'home'
    ];

    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id');
    }
}
