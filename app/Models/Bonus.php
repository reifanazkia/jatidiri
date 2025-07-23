<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bonus extends Model
{
    protected $table = 'bonus';

    protected $fillable = [
        'service_id',
        'title',
        'slug',
        'image',
        'description'
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
