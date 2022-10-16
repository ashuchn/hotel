<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Hash;
use Mail;
use App\Mail\registerMail;
use Exception;
use GeneaLabs\LaravelSocialiter\Facades\Socialiter;
use Laravel\Socialite\Facades\Socialite;    

class AuthController extends Controller
{
    public function signup()
    {
        return view('auth.signup');
    }
    public function hash($password)
    {
        return Hash::make($password);
    }

    public function send_mail()
    {
        // $mail = "";
        $to_email = 'aashutosh.quantum@gmail.com';
        $to_name = 'ashutosh';
        $data = array('name'=>"beautylicious", 'body' => 'this is text message');
        
        $sent =  Mail::send('mail', $data, function($message) use ($to_name, $to_email) {
        $message->to($to_email, $to_name)
        ->subject('Test Mail');
        $message->from(env('MAIL_FROM_ADDRESS'),'Backend Dev');
        });
        // dd($sent);
       return 'Email sent Successfully';
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

    public function appleLogin()
    {
        return Socialite::driver("sign-in-with-apple")
            // ->scopes(["name", "email"])
            ->redirect();
    }

    public function appleCallback(Request $request)
    {
        // get abstract user object, not persisted
        $user = Socialite::driver("sign-in-with-apple")
            ->user();
        ddd($user);
        
        // or use Socialiter to automatically manage user resolution and persistence
        // $user = Socialiter::driver("sign-in-with-apple")
        //     ->login();
        return $user;
    }

    

}
