<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Entities\Recipe;

class RecipeImage extends Model
{
    protected $fillable = ['uri'];
    protected $hidden = ['recipe_id','created_at', 'updated_at', ];

    public function recipe()
    {
      return $this->belongsTo(Recipe::class);
    }
}
