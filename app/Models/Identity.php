<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Identity extends Model
{
    protected $table = 'identities';

    protected $fillable = [
        'name',
        'year',
        'day_service',
        'time_service',
        'description',
        'address',
        'gmap',
        'phone',
        'email',
        'fb',
        'ig',
        'tt',
        'yt',
        'logo',
        'favicon',
    ];
}

