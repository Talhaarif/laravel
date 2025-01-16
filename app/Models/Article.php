<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'category',
        'title',
        'image',
        'rating',
        'duration',
        'description',
        'overview',
        'language',
        'admin_name',
        'admin_role',
        'admin_image',
        'views',
    ];
}
