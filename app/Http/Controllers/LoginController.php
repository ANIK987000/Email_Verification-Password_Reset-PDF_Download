<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Datetime;
use Illuminate\Support\Str;
use App\Models\AdminModel;
use App\Models\UserModel;
use App\Models\Token;
use Session;

class LoginController extends Controller
{
    //
    function home()
    {
        return view('home');
    }

    function login(Request $req){
        $req->validate([
            'email'=>"required|email|regex:/^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,3}$/",
            'pass'=>"required" //|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/
        ],
        [
            'email.required'=>'Please enter the email',
            'email.regex'=>'Email not matched',
            'pass.required'=>'Please enter the password',
            'pass.regex'=>'Password not matched'
        ]);

        $user1 = AdminModel::where('Email', '=', $req->email)->first();
        $user2 = UserModel::where('Email', '=', $req->email)->first();
       
        // $key = Str::random(40);
        // $token = new Token();

        if($user1){
            if($req->pass == $user1->Password)
            {
                session()->put('LoggedIn',$user1->Admin_ID);
                session()->put('LoggedInFirstName',$user1->First_Name);
                session()->put('LoggedInLastName',$user1->Last_Name);

                // $token->token_key = $key;
                // $token->user_email = $user1->Email;
                // $token->created_at = new Datetime();
                // $token->save();

                return redirect()->route('admin.dashboard');

            }else
            {
                return back()->with('fail','Password incorrect');
            }

        }elseif($user2){
            if($req->pass == $user2->Password)
            {
                if($user2->email_verified_at)
                {
                    session()->put('LoggedIn',$user2->User_ID);
                    session()->put('LoggedInFirstName',$user2->First_Name);
                    session()->put('LoggedInLastName',$user2->Last_Name);
                     // $token->token_key = $key;
                // $token->user_email = $user1->Email;
                // $token->created_at = new Datetime();
                // $token->save();

                return redirect()->route('user.dashboard');
                }
                else{
                    return back()->with('fail','User is not verified');
                }
            

               

            }else
            {
                return back()->with('fail','Password incorrect');
            }
        
        }else{
            return back()->with('fail','This email is not registered');
        }

    }

    function userLogout(){
            session()->flush();
            return redirect()->route('login');
        
    }
    // function loginUserInfo(Request $req, $token){
    //     $userData = Token::where('token_key', '=', $req->token)->whereNULL('expired_at')->first();
    //     if($userData){
    //         return response()->json([$userData]);
    //     }
    //     return response()->json([$userData]);
    // }



    // function logout(Request $req)
    // {
    //     $key = $req->token;
    //     if($key){
    //         $tk = Token::where("token_key", "=", $key)->first();
    //         $tk->expired_at = new Datetime();
    //         $tk->save();
    //         session()->flush();
    //     }
    // }

}
