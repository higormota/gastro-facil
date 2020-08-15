<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entities\Rating;
use App\Entities\Recipe;
use App\Entities\User;
use App\Http\Resources\RatingResource;

class RatingController extends Controller
{

  /**
   * =============================
   * Method: constructor  
   * =============================
   */
  public function __construct()
  {
    /**
     * requires authentication to access routed methods.
     * "except" are used to release some methods (to test)
     */
   
    $this->middleware('auth:api')->except(['store']);
  }

  /**
   * =======================================
   * Method: create Rating, access from POST
   * Params: json request with user_id, recipe_id and rating
   * Return: Array of created Rating
   */
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
