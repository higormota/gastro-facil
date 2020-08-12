<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class RecipePreparation extends Model
{
    protected $fillable =  ['recipe_id','step'];

    public function recipe()
    {
      return $this->belongsTo(Recipe::class);
    }
}
