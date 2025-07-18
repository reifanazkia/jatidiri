<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $table = 'services';
    protected $fillable = [
        'name', 'slug',
        'title1', 'description1', 'image1',
        'title2', 'description2', 'image2',
        'title3', 'description3', 'image3',
        'title4', 'description4', 'image4',
    ];

    public function why()
    {
        return $this->hasMany(Why::class);
    }
}

