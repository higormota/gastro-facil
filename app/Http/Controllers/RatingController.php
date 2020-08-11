<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entities\Rating;
use App\Entities\Recipe;
use App\Entities\User;
use App\Http\Resources\RatingResource;

class RatingController extends Controller
{

  public function __construct()
  {
    $this->middleware('auth:api')->except(['store']);
  }

    public function store(Request $request, Recipe $recipe)
    {
      $rating = Rating::firstOrCreate(
        [
          'user_id' => $request->user_id,//user()->id,
          'recipe_id' => $request->recipe_id,//$recipe->id
          'rating' => $request->rating
        ],
      );

      return new RatingResource($rating);
    }
}
