<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SideBenner extends Model
{

    protected $table = 'sidebanners';
    
    protected $fillable = [
        'image',
        'link'

    ];
}
