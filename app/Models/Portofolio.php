<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portofolio extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'slug', 'description', 'program_id', 'home',
        'logo', 'image1', 'image2', 'image3', 'image4', 'yt_id'
    ];

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

}
