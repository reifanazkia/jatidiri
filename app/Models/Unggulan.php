<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unggulan extends Model
{
    protected $fillable = [
        'title', 'slug', 'image', 'description', 'link', 'program_id', 'home'
    ];

    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id');
    }
}

