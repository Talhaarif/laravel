<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MealRating extends Model
{
    use HasFactory;

    protected $table = 'meal_ratings';

    protected $fillable = ['meal_id', 'user_id', 'rating'];

    public function meal()
    {
        return $this->belongsTo(Meal::class, 'meal_id');
    }
}
