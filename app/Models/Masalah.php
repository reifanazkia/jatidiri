<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Masalah extends Model
{
    protected $table = 'masalah';

    protected $fillable = [
        'service_id',
        'title',
        'slug',
        'description',
        'image'

    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
