<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Social;
use Hash;
use Mail;
use App\Mail\registerMail;
use Exception;
use GeneaLabs\LaravelSocialiter\Facades\Socialiter;
use Laravel\Socialite\Facades\Socialite;  
use DB;  
use Session; 
use File; 

class AuthController extends Controller
{
    public function auth()
    {
        return view('auth.signup');
    }
    public function hash($password)
    {
        return Hash::make($password);
    }
    public function google()
    {
        return Socialite::driver('google')->redirect();
    }
    
    public function googleCallback(Request $request)
    {
        // return $request;
        $user = Socialite::driver('google')->stateless()->user();
        $final['providerName'] = 'google';
        $final['id'] = $user->getId();
        $final['nickname'] = $user->getNickname();
        $final['name'] = $user->getName();
        $final['email'] = $user->getEmail();
        // $final['pfp'] = $user->getAvatar();

        if ($user->getAvatar()) {
            $baseurl = url('/');
            $path = "/uploads/avatar/";
            // The filename to save in the database.
            $fileContent = file_get_contents($user->getAvatar());
            File::put(public_path('/uploads/avatar') .'/'. $user->getId() . ".jpg", $fileContent);
            $imgPath = url('uploads/avatar') .'/'. $user->getId() . ".jpg";
            // $imgPath = public_path('/uploads/avatar/') . $user->getId() . ".jpg";
        }
        
        $checkUser = DB::table('users')
                    ->where('email', $final['email'])
                    ->first();
        // return $checkUser;
        if($checkUser) {
            session()->put('user',$checkUser);

            $checkCredentials = Social::where('user_id',$checkUser->id )
                                    ->where('provider_name', 'google')
                                    ->where('provider_id', $final['id'])
                                    ->exists();                
            
            if($checkCredentials) {
                return redirect()->route('profile');
            } else {
                $insertCredentials = Social::create([
                                'user_id' => $checkUser->id,
                                'provider_name' => 'google',
                                'provider_id' => $final['id']
                            ]);
                return redirect()->route('profile');
            }                                      
        } else {
            // echo $imgPath;exit;
                $insertUser =  User::create([
                    "name" => $final['name'],
                    "email" => $final['email'],
                    "password" => '231',
                    "profile_pic" => $imgPath
                ]);

                $insertCredentials =  DB::table('social_credentials')->insert([
                    "user_id" => $insertUser->id,
                    "provider_id" => $final['id'],
                    "provider_name" => $final['providerName'],
                ]);
                session()->put('user',$insertUser);
                return redirect()->route('profile');

        }
    }

    public function profile()
    {
        $data = session()->get('user');
        // return $data;
        return view('profile',['data' => $data]);
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
