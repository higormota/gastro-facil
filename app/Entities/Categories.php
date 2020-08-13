<?php

namespace App\Entities;
use App\Entities\Recipe;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $fillable = ['name'];
    protected $hidden = ['created_at', 'updated_at', ];

     
    public function recipes()
    {
        return $this->belongsToMany(Recipe::class);
    }
}
