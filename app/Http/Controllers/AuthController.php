<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entities\User;
use JWTAuth;
use JWTFactory;
use App\Http\Controllers\UserController;
use Illuminate\Http\RedirectResponse;
use App\Http\Resources\UserResource;

class AuthController extends Controller
{
    public function register(Request $request)
    {
      $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'password' => bcrypt($request->password),
      ]);

      $token = auth()->login($user);
      
      return new UserResource($user);

      //return redirect()->route('user',[$user]);
      //return redirect()->action('UserController@show',$user);
      //return $this->respondWithToken($token);
    }

    public function login(Request $request)
    {
      $credentials = $request->only(['email', 'password']);

  
      if (!$token = auth()->attempt($credentials)) {
        return response()->json(['error' => 'Usuário e senha não correspondem'], 401);
      }

      $user = User::where('email',$request->email)->first();
      return response()->json($user,200);
      //return $this->respondWithToken($token);
    }



    protected function respondWithToken($token)
    {
      return response()->json([
        'access_token' => $token,
        'token_type' => 'bearer',
        'expires_in' => auth()->factory()->getTTL() * 60
      ]);
    }
}
