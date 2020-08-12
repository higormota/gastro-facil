<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entities\Report;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except(['store']);
    }

    public function store(Request $request)
    {
      $report = Report::firstOrCreate(
        [
          'user_id' => $request->user_id,//user()->id,
          'recipe_id' => $request->recipe_id,//$recipe->id
          'report' => $request->report
        ],
      );

      return response('Obrigado por reportar, sua mensagem será avaliada.', 200)
                ->header('Content-Type', 'text/plain');;
    }
}
