<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Entities\Review;

class ReviewImages extends Model
{
    protected $fillable = ['uri'];
    protected $hidden = ['review_id','created_at', 'updated_at', ];

    public function review()
    {
      return $this->belongsTo(Review::class);
    }
}
