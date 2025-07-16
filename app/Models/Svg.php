<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Svg extends Model
{
    protected $table = 'svgs';

    protected $fillable = [
        'title1', 'title2', 'title3', 'title4',
        'data1', 'data2', 'data3', 'data4',
        'value1', 'value2', 'value3', 'value4', 'value5', 'value6',
    ];

}
