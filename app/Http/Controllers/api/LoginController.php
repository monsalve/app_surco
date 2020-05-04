<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;



class LoginController extends Controller
{
    public function login(Request $request) {
        $login = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        if( !Auth::attempt( $login)) {
            return response(['message' => 'Datos de accesos invalidos!!!']);
        }
       
        //$user =  Auth::guard('api')->user();
        //$accessToken = Auth::guard('api')->user->createToken('authToken')->accessToken;


        $user =  Auth::User();

        // Creating a token without scopes...
        $accessToken = $user->createToken('authToken')->accessToken;
        
        // Creating a token with scopes...
       // $token = $user->createToken('My Token', ['place-orders'])->accessToken;


       // return response(['user' => Auth::user(), 'access_token' => $accessToken]);

       return response(['user' => $user, 'access_token' => $accessToken]);
       
    }
}
