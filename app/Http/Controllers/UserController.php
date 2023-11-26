<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;
use Illuminate\Support\Facades\DB;
use PDF;
use Mail;
use App\Mail\EmailVerificationMail;
use App\Mail\PasswordResetMail;


class UserController extends Controller
{
    //
    function dashboard()
    {
       
        return view('user.dashboard');

        //$products=ProductModel::all();
        //return response()->json($products);
    }

     //_________________________________________

     function profile()
     {
         $user=UserModel::where('User_ID',session()->get('LoggedIn'))->first();
         return view('user.profile')->with('user',$user);
     }
 
 
     //_____________________________________
 
     function updateProfile()
     {
         $user=UserModel::where('User_ID',session()->get('LoggedIn'))->first();
         
         return view('user.updateProfile')->with('user',$user);
     }
 
     //___________________________________________


    function updateProfileSubmit(Request $req)
    {

        $this->validate($req,

        [

            'fname'=>"required|regex:/^[a-zA-Z\s\.\-]+$/",
            'lname'=>"required|regex:/^[a-zA-Z\s\.\-]+$/",
            'psw'=>"required", //|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/,
            'phone'=>"required|regex:/^[0-9]{11}+$/i",
            'address'=>"required",
            "pro_pic"=>"mimes:jpg,jpeg,png"

        ],

        [

            'fname.required'=>'Provide a valid name',
            'lname.required'=>'Provide a valid name',
            'phone.required'=>'Provide your phone number',
            "phone.regex"=> "Please provide correct phone number",
            'address.required'=>'Provide your address',
            'psw.required'=>"Password must contain upper case, lower case, number and special characters, min length 8",
            'psw_repeat.required'=>'Must enter the password again',
            'pro_pic'=>'Profile pic must be in jpg,jpeg,png format'

        ]);

       
        $user=UserModel::where('User_ID',session()->get('LoggedIn'))->first();
        $imageName=$user->Image;

        if($req->pro_pic==null)
        {
            $imageName=$user->Image;   
        }
        else 
        {
            $imageName = time().'_'.$req->fname.'.'.$req->pro_pic->extension();
            $req->pro_pic->move(public_path('UserImages'), $imageName);
        }

    

        $affected = DB::table('users')
              ->where('User_ID', $user->User_ID)
              ->update(['First_Name' => $req->fname,
                        'Last_Name' => $req->lname,
                        'Password'=>$req->psw,
                        'Phone' => $req->phone,
                        'Address' => $req->address,
                        'Image'=>$imageName]);
     
       
        if($affected){
            return back()->with('profileUpdated', 'Information Updated Successfully');

        }else{
            return back()->with('profileNotUpdated', 'Information not updated');
        }
        return view('user.updateProfile')->with('user',$user);
    }

    //_______________________________________________________

    function userDetails(Request $req)
    {
        $user=UserModel::where('Email',$req->Email)->first();
        return view('user.userDetails')
                ->with('user',$user);

        // $products=ProductModel::where('p_title',$req->title)->first();
        // return response()->json($products);
    }

    //__________________________________________________________

    function downloadProfile(Request $req)
        {
           // $user=UserModel::where('User_ID',session()->get('LoggedIn'))->first();

            $user = UserModel::where('User_ID', session()->get('LoggedIn'))->first();

            // Make sure $user is an array
            //$userData = $user->toArray();

            $pdf = PDF::loadView('user.pdf', compact('user'));
            //$pdf = PDF::loadView('admin.downloadProfile', $userData);

            return $pdf->download('user.pdf');
        }

        //___________________________________________________________

        function forgotPassword()
        {
            return view('user.forgotPassword');
        }

        //__________________________________________________________

        function resetPasswordMail(Request $req)
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
                Mail::to($user->Email)->send(new PasswordResetMail($user));
                return back()->with('resetpasswordlink','A reset password link has been sent to your email address!');
            }
            else
            {
                return back()->with('NotValid','Please give your correct email address!');
            }
        }


        //_________________________________________________________


         function resetPassword(Request $req)
        {
            $user=UserModel::where('email_verification_code',$req->verification_code)->first();
            return view('user.resetPassword')->with('user',$user);
        }
       
        function resetPasswordMainPage(Request $req)
        {
            $validator = $req->validate([
               
                'psw'=>"required", //|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/,
                'psw_repeat'=>"required|same:psw",
    
            ],
            [
                
                'psw.required'=>"Password must contain upper case, lower case, number and special characters, min length 8",
                'psw_repeat.required'=>'Must enter the password again',
                'psw_repeat.same'=>'Password must match with repeat password',
    
                
            ]);
          
            $user=UserModel::where('email_verification_code',$req->verification_code)->first();
            if($user)
            {

                DB::table('users')
                ->where('User_ID', $user->User_ID)
                ->update(['Password'=>$req->psw_repeat]);
                return back()->with('success','Password reset successful !');
            }
            else
            {

                    return back()->with('fail','Invalid user !');
        
            }
        }

}
