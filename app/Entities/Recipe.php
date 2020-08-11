<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Entities\Rating;
use App\Entities\RecipeImage;
use App\Entities\RecipeStuff;
use App\Entities\User;


class Recipe extends Model
{

    protected $fillable = ['name','yield','calories','preparation_mode','user_id'];


    public function user()
    {
      return $this->belongsTo(User::class);
    }

    public function ratings()
    {
      return $this->hasMany(Rating::class);
    }

    public function images()
    {
      return $this->hasMany(RecipeImage::class);
    }
    public function stuffs()
    {
      return $this->hasMany(RecipeStuff::class);
    }
}
