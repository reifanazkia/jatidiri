<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class usp extends Model
{
    protected $table = 'usps';
    protected $fillable = [
        'Title',
        'Image',
        'Description',

    ];


}
