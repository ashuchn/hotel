<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if(!$user || strcmp($request->password, $user->password)) {
            return response()->json([
                "responseCode" => 404,
                "responseMessage" => "Credentials not match"
            ], 200);
        } else {
            return response()->json([
                "responseCode"=> 200,
                "responseMessage" => "Ok",
                "token" => $user->createToken('my-app-token')->plainTextToken
            ], 200);
        }
    }

    public function profile(Request $request)
    {
        return $request->user();
    } 
    
    
    public function pro()
    {
        return "";
        // return $request->user();
    } 

}
