<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class RecipePreparation extends Model
{
    protected $fillable =  ['step'];
    protected $hidden = ['recipe_id','created_at', 'updated_at', ];

    public function recipe()
    {
      return $this->belongsTo(Recipe::class);
    }
}
