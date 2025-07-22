<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Manfaat extends Model
{
    protected $table = 'manfaats';
    protected $fillable = [
        'service_id',
        'title',
        'slug',
        'description',
        'image',

    ];

     public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
