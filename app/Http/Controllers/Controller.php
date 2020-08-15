<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * ===============================
     * Method to call user login View
     * ===============================
     */
    public function loginView(){
        return view('user.login');
    }

    /**
     * ==================================
     * Method to call user register View
     * ==================================
     */
    public function registerView(){
        return view('user.register');
    }


    public function index(){
        
    }
}
