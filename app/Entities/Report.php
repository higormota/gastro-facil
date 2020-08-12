<?php

namespace App\Entities;
use App\Entities\User;
use App\Entities\Recipe;


use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable =  ['recipe_id','user_id','report'];

    public function recipe()
    {
      return $this->belongsTo(Recipe::class);
    }
    public function user()
    {
      return $this->belongsTo(User::class);
    }
}
