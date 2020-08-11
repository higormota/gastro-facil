<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Entities\Recipe;

class RecipeImage extends Model
{
    protected $fillable = ['recipe_id','uri'];

    public function recipe()
    {
      return $this->belongsTo(Recipe::class);
    }
}
