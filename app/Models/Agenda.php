<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    protected $table = 'agendas';

    protected $fillable = [
        'title',
        'slug',
        'agendacat',
        'start_date',
        'end_date',
        'start_time',
        'end_time', 
        'content',
        'location',
        'yt_link',
        'organizer',
        'register_link',
        'contact',
        'image',
    ];
}
