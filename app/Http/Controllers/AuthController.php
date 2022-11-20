<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Social;
use App\Models\user_verify;
use Hash;
use Mail;
use App\Mail\registerMail;
use App\Mail\sendVerifyMail;
use Exception;
use GeneaLabs\LaravelSocialiter\Facades\Socialiter;
use Laravel\Socialite\Facades\Socialite;  
use DB;  
use Session; 
use File; 
use Str;
use Illuminate\Auth\Events\Registered;
use App\Jobs\sendMailJob;


class AuthController extends Controller
{
    public function auth()
    {
        return view('auth.auth');
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
                // event(new Registered($insertUser));

                session()->put('user',$insertUser);
                return redirect()->route('profile');

        }
    }

    public function profile()
    {
        $user = session('user');
        $userId = $user->id;
        $data = User::where('id', $userId)->first();
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
        $message->from(env('MAIL_FROM_ADDRESS'),'Backend Dev Security');
        });
        // dd($sent);
        if($sent) {
            return 'Email sent Successfully';

        } else {
            dd($sent);
        }
    }

    public function sendVerifyMail()
    {

        $data = session()->get('user');
        $userId = $data->id;
        $email = $data->email;
        
        $token = Str::random(64);
        $url = url('/')."/email/verify?token=".$token."&id=".$userId;
        

        if(!isset($email)) {
            return back()->with('message', 'Something went wrong');
        }

        DB::table('users_verify')->insert([
            "user_id" => $userId,
            "token"=> $token
        ]);
        
        $dd['url'] = $url;
        $dd['email'] = $email;

        // return $dd;
        dispatch(new sendMailJob($dd));
        // Mail::to($email)->send(new sendVerifyMail($url));

        return back()->with('message', 'verification mail sent');
    }

    public function verifyEmail(Request $request)
    {
        // return $request->query();
        $token = $request->query('token');
        
        $userId = $request->query('id');

        $exists = DB::table('users_verify')
                ->where('user_id', $userId)
                ->where('token', $token)
                ->exists();
        
        if($exists) {
            $update = User::find($userId);
            $update->is_email_verified = 1;
            $update->save();

            DB::table('users_verify')->where('user_id', $userId)->delete();

            return redirect('profile')->with('message', 'Email Verified Successfully');
        } else {
            return redirect('profile')->with('message', 'Something Went Wrong');
        }
        
        
    }

    

}
