<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Entities\Rating;
use App\Entities\RecipeImage;
use App\Entities\RecipeStuff;
use App\Entities\User;
use App\Entities\Categories;
use App\Entities\RecipePreparation;


class Recipe extends Model
{

    protected $fillable = ['name','yield','calories','user_id'];


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

    public function preparation_mode()
    {
      return $this->hasMany(RecipePreparation::class);
    }

    public function categories()
    {
      return $this->belongsToMany(Categories::class,'recipe_categories');
    }
}
