<?php

namespace App\Entities;
use App\Entities\Recipe;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $fillable = ['name'];

     
    public function recipes()
    {
        return $this->belongsToMany(Recipe::class);
    }
}
