<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dukungan extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'name',
        'jabatan',
        'id_yt',
        'image'

    ];
}
