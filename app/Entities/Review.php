<?php

namespace App\Entities;


use Illuminate\Database\Eloquent\Model;
use App\Entities\User;
use App\Entities\Recipe;
use App\Entities\ReviewImages;

class Review extends Model
{
    protected $fillable =  ['recipe_id','user_id','comment','ratings'];
    protected $hidden = ['created_at', 'updated_at', ];

    public function recipe()
    {
      return $this->belongsTo(Recipe::class);
    }
    
    public function user()
    {
      return $this->belongsTo(User::class);
    }

    public function feedback()
    {
      return $this->hasMany(ReviewRating::class);
    }

    public function images()
    {
      return $this->hasMany(ReviewImages::class);
    }
}
