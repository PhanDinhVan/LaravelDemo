<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// import thu vien nay dung de login
use Illuminate\Support\Facades\Auth;

class UserLoginController extends Controller
{
	

    //
    function getLogin(){

    	return view('pages.login');
    }

    function postLogin(Request $request){

    	$this->validate($request,
            [
                'email'=>'required',
                'password'=>'required'
            ],
            [
                'email.required'=>'Email is not empty',
                'password.required'=>'Passwords is not empty'
            ]); 

    	if(Auth::attempt(['email'=>$request->email, 'password'=>$request->password])){

            return redirect('home');
        }else{
            return redirect('login')->with('thongbao','Login unsuccessful...!!!');
        }
    }

    function getLogout(){
    	Auth::logout();
    	return redirect('home');
    }

    function getAccount(){
    	$user = Auth::user();
    	return view('pages.account',['user'=>$user]);
    }

    function postAccount(){

    }
}
