<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\ReviewResource;
use App\Entities\Recipe;
use App\Entities\User;
use App\Entities\Review;


class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except(['store','index']);
    }

    public function index()
    {
        return ReviewResource::collection(Review::with('ratings')->paginate(25));
    }

    public function store(Request $request)
    {
      $review = Review::firstOrCreate(
        [
          'user_id' => $request->user_id,//user()->id,
          'recipe_id' => $request->recipe_id,//$recipe->id
          'comment' => $request->comment
        ],
      );

      return new ReviewResource($review);
    }
   
}
