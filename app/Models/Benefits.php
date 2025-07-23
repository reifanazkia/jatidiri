<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Benefits extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'slug', 'description', 'facility_id', 'home', 'image'
    ];

    public function facility()
    {
        return $this->belongsTo(Assesment::class);
    }
}
