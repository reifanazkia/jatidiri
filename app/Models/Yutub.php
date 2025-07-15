<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Yutub extends Model
{
    protected $fillable = ['link'];

    public function programs()
    {
        return $this->hasMany(Program::class, 'id_yt', 'id');
    }
}
