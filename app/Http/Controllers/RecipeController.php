<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entities\Recipe;
use App\Entities\Rating;
use App\Entities\User;
use App\Entities\Categories;
use App\Entities\RecipeImage;
use App\Entities\RecipePreparation;
use App\Entities\RecipeStuff;
use App\Http\Resources\RecipeResource;
use App\Http\Controllers\UserController;
use App\Http\Resources\CategoriesResource;
use Illuminate\Support\Facades\DB;

class RecipeController extends Controller
{

  private $recipe_create_points = 5;
  private $search_lost_points = 5;

  /**
   * =============================
   * Method: constructor  
   * =============================
   */
  public function __construct()
    {
      $this->middleware('auth:api')->except(['index', 'show','store','getCategories','search','getRecipesOfDay']);
    }
    /**
     * ===========================================
     * Method: Display a listing of all recipes.
     * Return: array of all recipes
     * ===========================================
     */
    public function index()
    {
        return RecipeResource::collection(Recipe::all());
    }

  /**
   * =======================================================
   * Method: create Rating, access from POST
   * Params: json request with user_id, name, yield,calories, stuffs, images, categories, preparation_mode
   * Return: Array of created Recipe
   * ========================================================
   */
    public function store(Request $request)
    {
        $recipe = Recipe::create([
            'user_id' => $request->user_id,
            'name' => $request->name,
            'yield' => $request->yield,
            'calories' => $request->calories,
          ]);

        if ($request->preparation_mode){
            foreach ($request->preparation_mode as $preparation_mode){
              $recipePreparation = RecipePreparation::create([
                  'recipe_id' => $recipe->id,
                  'step' => $preparation_mode['step']
            ]);
            }
        }           


        if ($request->images){
          foreach ($request->images as $image){
            $recipeImage = RecipeImage::create([
                'recipe_id' => $recipe->id,
                'uri' => $image['uri']
          ]);
          }
        }  

        if ($request->stuffs){
          foreach ($request->stuffs as $stuff){
            $recipeStuffs = RecipeStuff::create([
                'recipe_id' =>  $recipe->id,
                'name'      =>  $stuff['name'], 
                'quantity'  =>  $stuff['quantity'],
                'metric'    =>  $stuff['metric']

          ]);
          }
        }

        
        if ($request->categories){
          foreach ($request->categories as $category){
            $recipe->categories()->attach([$category]);
          }
        }

        UserController::userPoints($request->user_id,$this->recipe_create_points,true);
    
        return new RecipeResource($recipe);
    }

    /**
     * ===============================
     * Method: Display specifc recipe.
     * Params: Recipe object or valid id of recipe
     * Return: array of the recipes
     * ===============================
     */
    public function show(Recipe $recipe)
    {
        return new RecipeResource($recipe);
    }

    /**
     * ==================================================
     * Method: Update a specific recipe, access from PUT.
     * Params: recipe to update, current user_id
     * Return: array of the recipe updated
     * ====================================================
     */
    public function update(Request $request, Recipe $recipe)
    {
        // check if currently authenticated user is the owner of the recipe
      if ($request->user()->id !== $recipe->user_id) {
        return response()->json(['error' => 'Você só pode atualizar suas receitas'], 403);
      }

      $recipe->update($request->only(['title', 'description']));

      return new RecipeResource($recipe);
    }

    /**
     * ==================================================
     * Method: Delete a specific recipe, access from DELETE.
     * Params: recipe to delete
     * Return: name of deleted recipe
     * ====================================================
     */
    public function destroy(Recipe $recipe)
    {
        $recipeDel = $recipe->name;
        $recipe->delete();

      return response()->json($recipeDel, 204);
    }


    /**
     * ======================================
     * Methot: get a json list of Categories
     * Return: Array list of all categories
     * =======================================
     */
    public function  getCategories(){
      return CategoriesResource::collection(Categories::all());
      //return response()->json(Categories::all(),200);
    }
    
    
    /**
     * =========================================
     * Methot: get a 10 randomic Recipes Of Day
     * Return: Array list of 10 randomic recipes
     * =========================================
     */
    public function getRecipesOfDay(){
      return RecipeResource::collection(Recipe::inRandomOrder()->limit(10)->get());
    }

    /**
     * =============================================
     * Method: Dinamyc search of Recipes. 
     * Params: You can pass as parameters a list of categories, 
     *         a name or recipe or list of stuffs.
     * Return: a json object with  basic recipe data
     * ===============================================
     */
    public function search(Request $request){
      $name = $request->name;
      $categories = $request->categories;
      $stuffs = $request->stuffs;

      

      if($request->lostPoints){
        if(User::find($request->user_id)->first()->points < $this->search_lost_points){
          return response()->json("Você não tem pontos suficientes", 401);
        }
        UserController::userPoints($request->user_id,$this->search_lost_points,false);
      }


      $query = DB::table('recipes');

      if($categories){
        $query = $query->join('recipe_categories', function ($join) use($categories) {
                              $join->on('recipes.id', '=', 'recipe_categories.recipe_id')
                                   ->whereIn('recipe_categories.categories_id',$categories);
                              });
      }

      if($stuffs){
        $query = $query->join('recipe_stuffs',function ($join) use($stuffs) {
                              $join->on('recipes.id', '=', 'recipe_stuffs.recipe_id')
                                   ->whereIn('recipe_stuffs.name',$stuffs);
                              });
      }

      $query =  $query->select('recipes.*');
      
      if($name){
        $query =  $query->where('recipes.name',$name);
      }

      $recipes = $query->get();
      
      return response()->json($recipes, 200);
    }


}
