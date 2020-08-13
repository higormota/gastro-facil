<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Entities\User;
use App\Entities\Recipe;
use App\Http\Resources\UserResource;
use App\Http\Resources\RecipeResource;
use App\Entities\UserFavorites;

class UserController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth:api')->except(['index', 'show','userRecipes','userFavorites','flagFavorite']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //nothing to implement
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //user is create on AuthController@register
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function userRecipes(Request $request){

        $user_id = $request->user_id;
        $recipes = Recipe::where('user_id', $user_id)
                        ->orderBy('name', 'desc')
                        ->get();

        return response()->json($recipes,200);
    }

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

    public function flagFavorite(Request $request){
        $userFavorite = UserFavorites::create([
                'user_id' => $request->user_id,
                'recipe_id' => $request->recipe_id,
              ]);
        return response()->json("Receita adicionada aos favoritos",200);     
    }
}
