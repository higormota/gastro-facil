<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entities\Recipe;
use App\Entities\Rating;
use App\Entities\User;
use App\Entities\RecipeImage;
use App\Http\Resources\RecipeResource;

class RecipeController extends Controller
{


  public function __construct()
    {
      $this->middleware('auth:api')->except(['index', 'show','store']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return RecipeResource::collection(Recipe::with('ratings')->paginate(25));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $recipe = Recipe::create([
            'user_id' => $request->user_id,
            'name' => $request->name,
            'yield' => $request->yield,
            'calories' => $request->calories,
            'preparation_mode' => $request->preparation_mode,
          ]);

          
        if ($request->images){
          foreach ($request->images as $image){
            $recipeImage = RecipeImage::create([
                'recipe_id' => $recipe->id,
                'uri' => $image["uri"]
          ]);
          }
        }  

        if ($request->stuffs){
          foreach ($request->stuffs as $stuff){
            $recipeStuffs = RecipeStruff::create([
                'recipe_id' =>  $recipe->id,
                'name'      =>  $stuff['name'], 
                'quantity'  =>  $stuff['quantity'],
                'metric'    =>  $stuff['metric']

          ]);
          }
        } 
    
          return new RecipeResource($recipe);
    }

    /**
     * Display the specified resource.
     *
     * @param  Recipe  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Recipe $recipe)
    {
        return new RecipeResource($recipe);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Recipe $recipe)
    {
        // check if currently authenticated user is the owner of the book
      if ($request->user()->id !== $recipe->user_id) {
        return response()->json(['error' => 'Você só pode atualizar suas receitas'], 403);
      }

      $recipe->update($request->only(['title', 'description']));

      return new RecipeResource($recipe);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recipe $recipe)
    {
        $recipe->delete();

      return response()->json(null, 204);
    }
}
