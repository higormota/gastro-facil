<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Entities\Recipe;
use App\Http\Resources\RatingResource;

class Rating extends Model
{
    protected $fillable = ['user_id','recipe_id','rating'];
    protected $hidden = ['created_at', 'updated_at', ];

    public function user(){
      return $this->belongsTo(User::class);
    }
    
    public function recipe()
    {
      return $this->belongsTo(Recipe::class);
    }
}
