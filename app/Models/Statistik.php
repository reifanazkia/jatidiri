<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class statistik extends Model
{
    protected $table = 'statistik';

    protected $fillable = [

        'pengguna',
        'psikologi',
        'assesmen',
        'konsoler'
    ];
}
