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

    public function unggulans()
    {
        return $this->hasMany(Unggulan::class, 'program_id');
    }

    public function yutub()
    {
        return $this->belongsTo(Yutub::class, 'id_yt', 'id');
    }

    public function pricing()
    {
        return $this->hasMany(Pricing::class, 'program_id');
    }
}

