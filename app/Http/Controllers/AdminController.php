<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\UserModel;

class AdminController extends Controller
{
    //
    function dashboard()
    {
        $user=UserModel::paginate(4);
        return view('admin.dashboard')->with('user',$user);

        //$products=ProductModel::all();
        //return response()->json($products);
    }

    function search()
    {

        $search_text=$_POST['search'];
        $user=UserModel::where('First_Name','LIKE',$search_text.'%')->get();

        return view('admin.search')
                    ->with('user',$user);
    }

    function toggleStatus(Request $req)
    {
        $user=UserModel::where('Email',$req->Email)->first();
        if($user->Status=="Active")
        {
            DB::table('users')
            ->where('Email', $user->Email)
            ->update(['Status' => 'Deactive']);

            return back()->with('message','The user is deactivated');
        }
        else{
            DB::table('users')
            ->where('Email', $user->Email)
            ->update(['Status' => 'Active']);
            return back()->with('message','The user is activated');
        }
       

       
        

        //$products=ProductModel::all();
        //return response()->json($products);
    }

}
