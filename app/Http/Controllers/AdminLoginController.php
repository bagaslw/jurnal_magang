<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Auth;

class AdminLoginController extends Controller
{
    public function login()
    {
    	return view('page.login');
    }

    public function post_login(Request $request)
    {
    	$condition=false;
    	$user=DB::table('ms_user')
    			->where('username',$request->get('username'))
    			->first();
    	if($user != null){
    		if($user->username == $request->get('username') && $user->password == $request->get('password')){
    			$condition = true;
    		}
    	}
    	 if ($condition) {
            Session::put('is_login', true);
            Session::put('id',$user->id_user);
            Session::put('induk',$user->no_induk);         
            Session::put('name',$user->name);
            Session::put('role',$user->role);
            
            return redirect('dashboard');
        }

        return redirect('login');	
    }

    public function logout(){
      Auth::logout();
      Session::flush();
      return redirect('login');
   }
}
