<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class UserFavorites extends Model
{
    protected $fillable = ['user_id', 'recipe_id'];
    protected $hidden = ['created_at', 'updated_at', ];

    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }

    public function user()
    {
        return $this->belongsTo(Recipe::class);
    }
}
