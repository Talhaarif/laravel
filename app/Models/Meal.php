<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Meal extends Model
{
    use HasFactory;

    protected $table = 'meals';

    protected $fillable = [
        'category', 'title', 'slug', 'image', 'rating',
        'duration', 'description', 'overview', 'language',
        'modules', 'admin_name', 'admin_role', 'admin_image'
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($meal) {
            $meal->slug = Str::slug($meal->title);
        });

        static::updating(function ($meal) {
            $meal->slug = Str::slug($meal->title);
        });
    }

    public function ratings()
    {
        return $this->hasMany(MealRating::class, 'meal_id');
    }
}
