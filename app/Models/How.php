<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class How extends Model
{
    protected $table = 'hows';

    protected $fillable = [
        'service_id',
        'title',
        'slug',
        'description',
        'imaga'

    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
