<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\ReviewResource;
use App\Entities\Recipe;
use App\Entities\User;
use App\Entities\Review;
use App\Entities\ReviewRating;


class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except(['store','index','flagUtil']);
    }

    public function index()
    {
        return ReviewResource::collection(Review::all());
    }

  /**
   * =======================================================
   * Method: create Review, access from POST
   * Params: json request with user_id, recipe_id, comment
   * Return: Array of created Review
   * ========================================================
   */
    public function store(Request $request)
    {
      $review = Review::firstOrCreate(
        [
          'user_id' => $request->user_id,//user()->id,
          'recipe_id' => $request->recipe_id,//$recipe->id
          'comment' => $request->comment
        ],
      );

      $recipe = Recipe::find($review->recipe_id);
      if($recipe->ratings >= 0){
          $recipe->ratings++;
          $recipe->save();
      }

      return new ReviewResource($review);
    }

  /**
   * =====================================================================
   * Method: defines review as helpful, increase points to Review and owner
   * Params: json request with user_id, recipe_id, comment
   * Return: json string successfull response
   * =====================================================================
   */
    public function flagUtil(Request $request){
     
      $reviewRating = ReviewRating::create([
              'user_id'   => $request->user_id,
              'review_id' => $request->review_id,
              'comment'   => $request->comment
      ]);

      $review = Review::find($request->review_id);
            if($review->ratings >= 0){
                $review->ratings++;                
                $review->save();
      }

      $user = User::find($review->user)->first();
      $user->points++;                
      $user->save();
      
    }
   
}
