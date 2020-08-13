<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Entities\Rating;
use App\Entities\RecipeImage;
use App\Entities\RecipeStuff;
use App\Entities\User;
use App\Entities\Categories;
use App\Entities\RecipePreparation;
use App\Entities\UserFavorites;
use Illuminate\Support\Facades\DB;


class Recipe extends Model
{

    protected $fillable = ['name','yield','calories','user_id'];
    protected $hidden = ['created_at', 'updated_at', ];

   
    public function user()
    {
      return $this->belongsTo(User::class);
    }

    public function ratings()
    {
      return $this->hasMany(UserFavorites::class);
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
