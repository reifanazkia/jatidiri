<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alasan extends Model
{
    use HasFactory;

    protected $table = 'alasan';

    protected $fillable = ['service_id', 'title', 'slug', 'image', 'description'];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
