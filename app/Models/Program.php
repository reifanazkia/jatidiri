<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $fillable = [
        'name', 'slug', 'category', 'title1', 'description1', 'image1',
        'title2', 'description2', 'image2', 'title3', 'description3', 'image3',
        'title4', 'description4', 'image4', 'age', 'weekly', 'periode',
        'ourteam_id', 'class_size', 'time_table', 'time_table2', 'content',
        'cta', 'link_program', 'id_yt', 'brosur'
    ];

    public function facility()
    {
        return $this->belongsTo(Assesment::class);
    }

    public function ourteam()
    {
        return $this->belongsTo(Ourteam::class, 'ourteam_id');
    }

}

