<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'category',
        'title',
        'slug',
        'image',
        'rating',
        'duration',
        'description',
        'overview',
        'admin_name',
        'admin_role',
        'admin_image',
        'language',
        'modules',
    ];

    public function ratings()
    {
        return $this->hasMany(CourseRating::class);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($course) {
            $course->slug = Str::slug($course->title);
        });

        static::updating(function ($course) {
            $course->slug = Str::slug($course->title);
        });
    }
}
