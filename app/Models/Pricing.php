<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pricing extends Model
{
    protected $fillable = [
        'title',
        'description',
        'slug',
        'image',
        'program_id',
        'price',
        'diskon',
    ];

    /**
     * Relasi ke Program (satu harga hanya untuk satu program)
     */
    public function program()
    {
        return $this->belongsTo(Program::class);
    }
}
