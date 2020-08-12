<?php

namespace App\Entities;


use Illuminate\Database\Eloquent\Model;
use App\Entities\User;
use App\Entities\Recipe;

class Review extends Model
{
    protected $fillable =  ['recipe_id','user_id','comment'];

    public function recipe()
    {
      return $this->belongsTo(Recipe::class);
    }
    
    public function user()
    {
      return $this->belongsTo(User::class);
    }

    public function ratings()
    {
      return $this->hasMany(ReviewRating::class);
    }
}
