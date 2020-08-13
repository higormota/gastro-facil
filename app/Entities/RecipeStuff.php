<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class RecipeStuff extends Model
{

    protected $fillable = ['recipe_id','name','quantity','metric'];
    protected $hidden = ['created_at', 'updated_at', ];

    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }
}
