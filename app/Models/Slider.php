<?php

// app/Models/Slider.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = [
        'title', 'slug', 'program_id', 'image', 'description', 'align',
        'button', 'link', 'yt_id', 'home',
    ];

    public function program()
    {
        return $this->belongsTo(Program::class);
    }
}

