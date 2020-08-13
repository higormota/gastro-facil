<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entities\Report;
use App\Entities\Recipe;

class ReportController extends Controller
{
  /**
   * =============================
   * Method: constructor  
   * =============================
   */
    public function __construct()
    {
        $this->middleware('auth:api')->except(['store']);
    }

  /**
   * ==================================================================
   * Method: create Report, access from POST
   * Params: json request with user_id, recipe_id and reason to report 
   * Return: json message confirm report
   * ==================================================================
   */
    public function store(Request $request)
    {
      $report = Report::firstOrCreate(
        [
          'user_id' => $request->user_id,//user()->id,
          'recipe_id' => $request->recipe_id,//$recipe->id
          'report' => $request->report
        ],
      );

      $recipe = Recipe::find($report->recipe_id);
      if($recipe->ratings > 0){
          $recipe->ratings--;
          $recipe->save();
      }

      return response('Obrigado por reportar, sua mensagem será avaliada.', 200)
                ->header('Content-Type', 'text/plain');;
    }
}
