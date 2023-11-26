<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Datetime;
use Illuminate\Support\Str;
use App\Models\AdminModel;
use App\Models\UserModel;
use Session;
use Illuminate\Auth\Events\Registered;
use Mail;
use App\Mail\EmailVerificationMail;
use Illuminate\Support\Facades\DB;

class RegistrationController extends Controller
{
    //
 

    function registration(Request $req){

        $validator = $req->validate([
            'fname'=>"required|regex:/^[a-zA-Z\s\.\-]+$/",
            'lname'=>"required|regex:/^[a-zA-Z\s\.\-]+$/",
            'email'=>"required|email|unique:admins,Email|unique:users,Email|regex:/^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,3}$/",
            'psw'=>"required", //|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/,
            'psw_repeat'=>"required|same:psw",

            'phone'=>"required|regex:/^[0-9]{11}+$/i",

            'address'=>"required",
            'type'=>"required", 
            "pro_pic"=>"required|mimes:jpg,jpeg,png"
        ],
        [
            'fname.required'=>'Provide a valid first name',
            'lname.required'=>'Provide a valid last name',
            'email.required'=>'Provide a valid email',
            'phone.required'=>'Provide your phone number',
            "phone.regex"=> "Please provide correct phone number",
            'address.required'=>'Provide your address',
            'psw.required'=>"Password must contain upper case, lower case, number and special characters, min length 8",
            'psw_repeat.required'=>'Must enter the password again',
            'psw_repeat.same'=>'Password must match with repeat password',
            'pro_pic.required'=>'Provide your profile picture'

            
        ]);

       
        $imageName = time().'_'.$req->fname.'.'.$req->pro_pic->extension();
        $req->pro_pic->move(public_path('UserImages'), $imageName);

        if($req->type == 'admin')
        {
            $user = new AdminModel();
            $user->First_Name = $req->fname;
            $user->Last_Name = $req->lname;
            $user->Email = $req->email;
            $user->Password = $req->psw_repeat;
            $user->Phone = $req->phone;
            $user->Address = $req->address;
            // $imageName = time().'_'.$req->fname.'.'.$req->pro_pic->extension();
            // $req->pro_pic->move(public_path('UserImages'), $imageName);
            $user->Image=$imageName;;
            $user->save();

            if($user){
                    event(new Registered($user));
                    session()->flash('success','Signup completed!');
                    return back();
            
            } else{
                    session()->flash('fail','Something wrong in user details');
                    return back();
            }
            // if($user){
            //        event(new Registered($user));
            //     session()->flash('success','Signup completed!');
            //     return back();
            // }else{
            //     session()->flash('fail','Something wrong in admin details');
            //     return back();
            // }
            
        }
        else{
        
            $user = new UserModel();
            $user->First_Name = $req->fname;
            $user->Last_Name = $req->lname;
            $user->Email = $req->email;
            $user->Password = $req->psw_repeat;
            $user->Phone = $req->phone;
            $user->Address = $req->address;
            // $imageName = time().'_'.$req->fname.'.'.$req->pro_pic->extension();
            // $req->pro_pic->move(public_path('UserImages'), $imageName);
            $user->Image=$imageName;
            $user->Status = "Active";
            $user->email_verification_code= Str::random(40);
            $user->save();

            if($user){
                    Mail::to($req->email)->send(new EmailVerificationMail($user));
                    session()->flash('success','Signup completed! but not verified!');
                    session()->flash('verify','A fresh verification link has been sent to your email address!');
                    // session()->flash('resend','Before proceeding, please check your email for a verification link.
                    // If you did not receive the email,click here to request another.');
                    return redirect()->route('auth.verify-email')->with('success','Signup completed! but not verified!');
                    return back();
                
            } else{
                    session()->flash('fail','Something wrong in user details');
                    return back();
            }
            
            // if($user){
            //     event(new Registered($user));
            //     session()->flash('success','Signup completed!');
            //     return back();
                
            // } else{
            //     session()->flash('fail','Something wrong in user details');
            //     return back();
            // }
            
        }
        session()->flash('fail','something wrong');
        return back();
    }
    

    // public function registered(RegisterRequest $request, $user)
    // {
    //     return $user->sendEmailVerificationNotification();
    // }


    function verifyMail(Request $req)
    {
        $user=UserModel::where('email_verification_code',$req->verification_code)->first();
        if(!$user)
        {
            return redirect()->route('auth.verify-email')->with('fail','Invalid user !');
        }
        else
        {
            if($user->email_verified_at)
            {
                return redirect()->route('auth.verify-email')->with('fail','Email Already verified !');
            }
            else
            {
                // $user->update([
                //     'email_verified_at'=>\Carbon\Carbon::now()
                // ]);
              DB::table('users')
              ->where('User_ID', $user->User_ID)
              ->update(['email_verified_at'=>\Carbon\Carbon::now()]);

                return redirect()->route('auth.verify-email')->with('verify-success','Email successfully verified !');
            }

        }
    }


    //_______________________________________________________________

    function verifyEmail()
    {
        return view('auth.verify-email');
    }
    //________________________________________________________________


    function resendMail(Request $req)
    {
        $validator = $req->validate([
            
            'email'=>"required|email|regex:/^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,3}$/",
        
        ],
        [
            
            'email.required'=>'Provide a valid email',
           

            
        ]);
        $user=UserModel::where('Email',$req->email)->first();
        if($user)
        {
            Mail::to($user->Email)->send(new EmailVerificationMail($user));
            return redirect()->route('auth.verify-email')->with('verify','A fresh verification link has been sent to your email address!');
        }
        else
        {
            return redirect()->route('auth.verify-email')->with('NotValid','Please give your correct email address!');
        }
       
    }

}
