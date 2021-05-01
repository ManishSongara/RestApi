<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    use HasFactory;

    protected $fillable = [
        'userid',
        'category',
        'img_path',
        'painter_name',
        'msg',
        'prise',
        'city',
    ];
}
