<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Why extends Model
{
    protected $table = 'why';
    protected $fillable = [
        'service_id',
        'title',
        'slug',
        'image',
        'description',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
