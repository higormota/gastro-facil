<?php

namespace App\Entities;
use App\Entities\User;
use App\Entities\Review;

use Illuminate\Database\Eloquent\Model;

class ReviewRating extends Model
{
    protected $fillable = ['user_id','review_id','comment'];
    protected $hidden = ['created_at', 'updated_at'];

    public function user(){
      return $this->belongsTo(User::class);
    }
    
    public function review()
    {
      return $this->belongsTo(Review::class);
    }
}
