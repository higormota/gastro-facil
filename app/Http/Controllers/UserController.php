<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Entities\User;
use App\Entities\Recipe;
use App\Entities\Review;
use App\Http\Resources\UserResource;
use App\Http\Resources\RecipeResource;
use App\Http\Resources\ReviewResource;
use App\Entities\UserFavorites;

class UserController extends Controller
{
 /**
   * =============================
   * Method: constructor  
   * =============================
   */
    public function __construct()
    {
      $this->middleware('auth:api')->except(['show','userRecipes','userFavorites','flagFavorite','userReviews']);
    }
    
    /**
     * ===========================================
     * Method: Display a listing of all users.
     * Return: nothing
     * ===========================================
     */
    public function index()
    {
        //nothing to implement
    }

    /**
     * ===========================================
     * Method: create user, access from POST
     * Return: nothing
     * ===========================================
     */
    public function store(Request $request)
    {
        //user is create on AuthController@register
    }

    /**
     * ===============================
     * Method: Display specifc user.
     * Params: User object or valid user id
     * Return: array of the recipes
     * ===============================
     */
    public function show(User $user)
    {
        return new UserResource($user);
    }

    /**
     * ==================================================
     * Method: Update a specific user, access from PUT.
     * Params: user to update, current user_id
     * Return: array of the user updated
     * ====================================================
     */
    public function update(Request $request, User $user)
    {
    // check if currently authenticated user is the owner of register user
      if ($request->user()->id !== $user->user_id) {
        return response()->json(['error' => 'Você só pode atualizar seus dados'], 403);
      }

      $user->update($request->only(['email', 'phone','name']));

      return new UserResource($user);
    }

     /**
     * ==================================================
     * Method: Delete a specific user, access from DELETE.
     * Params: user id
     * Return: nothing
     * ====================================================
     */
    public function destroy($id)
    {
        //
    }

    /**
     * ==================================================
     * Method: get a user recipes
     * Params: json request user_id, 
     * Return: json list of simple data of recipes
     * ====================================================
     */
    public function userRecipes(Request $request){

        $user_id = $request->user_id;
        $recipes = Recipe::where('user_id', $user_id)
                        ->orderBy('name', 'desc')
                        ->get();

        return response()->json($recipes,200);
    }

    /**
     * ==================================================
     * Method: get a user recipes favorites
     * Params: json request user_id, 
     * Return: json list of simple data of recipes
     * ====================================================
     */
    public function userFavorites(Request $request){
        $user = User::find($request->user_id);
        
        $recipes = [];
        foreach($user->favorites as $favorite){
            $recipes[] = Recipe::where('id',$favorite->recipe_id)
                                ->orderBy('name', 'desc')
                                ->get();

        }

        return response()->json($recipes,200);
        
    }

 /**
   * =====================================================================
   * Method: defines recipe as favorite, increase points to recipe and owner
   * Params: json request with user_id, recipe_id
   * Return: json string successfull response
   * =====================================================================
   */
    public function flagFavorite(Request $request){
        $userFavorite = UserFavorites::create([
                'user_id' => $request->user_id,
                'recipe_id' => $request->recipe_id,
              ]);

        $recipe = Recipe::find($userFavorite->recipe_id);
        if($recipe->ratings >= 0){
                $recipe->ratings++;
                $recipe->save();
        }

        $user = User::find($recipe->user)->first();
        $user->points++;                
        $user->save();        

        return response()->json("Receita adicionada aos favoritos",200);     
    }

 /**
   * =====================================================================
   * Method: get user reviews
   * Params: json request with user_id
   * Return: Array of complete data of reviews 
   * =====================================================================
   */
    public function userReviews(Request $request){
        $user = $request->user_id;

        $reviews = Review::where('user_id',$user)->get();


        return ReviewResource::collection($reviews);
    }
}
