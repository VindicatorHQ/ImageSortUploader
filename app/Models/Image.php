<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $table = "image";

    protected $fillable = [
        'id',
        'image_name'
    ];

//    public function tags()
//    {
//        return $this->hasMany(Tags::class);
//    }
}
