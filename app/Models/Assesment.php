<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assesment extends Model
{
    protected $table = 'facilities';

    protected $fillable = [

        'title',
        'slug',
        'subtitle',
        'description',
        'image'
    ];
}
