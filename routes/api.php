<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * ===================================
 * Definição de rotas de autenticação 
 * ===================================
 */
Route::post('register',['as' => 'user.register','uses' => 'AuthController@register']);
Route::post('login',['as' => 'user.login','uses' => 'AuthController@login']);

/**
 * ==============================
 * Definição de rotas de usuário
 * ==============================
 */
Route::get('/userRecipes', 'UserController@userRecipes');
Route::get('/userReviews', 'UserController@userReviews');
Route::get('/favorites', 'UserController@userFavorites');
Route::post('/flagFavorite', 'UserController@flagFavorite');
Route::apiResource('user',   'UserController');

/**
 * =========================================
 * Definição de rotas de usuário de receitas
 * =========================================
 */
Route::apiResource('recipe', 'RecipeController');
Route::post('recipe/{recipe}/ratings', 'RatingController@store');
Route::get('/categories', 'RecipeController@getCategories');
Route::get('/recipeOfDay', 'RecipeController@getRecipesOfDay');

/**
 * ===========================================
 * Definição de rotas de usuário de avaliação
 * ===========================================
 */
Route::apiResource('rating', 'RatingController');
Route::apiResource('review', 'ReviewController');
Route::apiResource('report', 'ReportController');
Route::post('/flagUtil', 'ReviewController@flagUtil');

/**
 * ===========================================
 * Definição de rotas de usuário de busca
 * ===========================================
 */
Route::post('/search', 'RecipeController@search');
