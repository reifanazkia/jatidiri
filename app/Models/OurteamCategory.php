<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OurteamCategory extends Model
{
    protected $fillable = ['nama'];

    public function ourteams()
    {
        return $this->hasMany(Ourteam::class, 'ot_id');
    }
}

