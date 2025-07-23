<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $table = 'activities';

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
