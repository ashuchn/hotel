<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Hash;
use Mail;
use App\Mail\registerMail;
use Exception;

class AuthController extends Controller
{
    public function signup()
    {
        return view('auth.signup');
    }

    public function signup_post(Request $request)
    {

        // $insert = new User;
        // $insert->name = $request->name;
        // $insert->email = $request->email;
        // $insert->password = Hash::make($password);
        // $insert->save();
        $mail= $request->email;
        try{
            $mailSend = Mail::to($mail)->send(new registerMail());
        } catch(\Exception $e) {
            return "exception: ".$e;
        }

        
        
    }

    

}
